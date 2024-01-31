<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Http\Controllers\User\TypeController;
use App\Models\User;
use App\Models\UserPersonalData;
//use App\Http\Requests\StoreUpdateUser;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use \Illuminate\Foundation\Auth\AuthenticatesUsers; 
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public function index(){
        return response("Hello World", 200);
    }
    public function uploadProfileImage(Request $request, $userID){
        if($request->hasFile('profile_pic')){
            $storePic = Storage::disk('vue-assets')->putFileAs('/'.$request->file('profile_pic')->extension().'/'.$userID,  $request->file('profile_pic'), "user_logo.".$request->file('profile_pic')->extension());
            if($storePic){
                $personalData = UserPersonalData::where("user_id", $userID)->get()->first();
                $personalData->update(['profile_src' => "assets/".$request->file('profile_pic')->extension()."/".$userID."/user_logo.".$request->file('profile_pic')->extension()]);
            }
        }else{
            return response("not has file", 500);
        }
    }
    public function store(Request $request, User $user){
        try {
            
            $credentials = $request->all();
            $credentials['password'] = bcrypt($credentials['password']);
            if(count($user->where('email', $credentials['email'])->get()) > 0)
                return response()->json([
                    'status' => 500,
                    'data' => 'Este E-mail já foi utilizado!'
                ],500);
            $data = $user->validateData($credentials);
            if(array_key_exists('user_data', $data) ){
                $u_data = $data['user_data'];
                $p_data = null;
                if(array_key_exists('personal_data', $data)){
                    $p_data = $data['personal_data'];
                }
                return response($user->store($u_data, $p_data));
            }
            if(array_key_exists('personal_data', $data)){
                return response()->json(["msg" => "personal data verified", "data" => $data],200);
            }
            else{
                return response()->json(["msg" => "personal data not verified", "data" => $data],500);
            }
            
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'data' => 'Erro no registro de usuário - AccountController',
                'msg' => $th->getMessage()
            ], 500);
        }
    }
    public function login(Request $request, User $user){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        
        if ($validator->fails()) { 
            $response = [
                        'status' => '0',
                        'error' => $validator->errors(),
                    ];

            return response()->json([ 'validator_failed' => $response], 401);   
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = $user->where('email', $request->email)->select(['id','name', 'email', 'status'])->get()->first();
            $token = $user->createToken('eight_user_token');
            return response()->json([
                'token' => $token->plainTextToken,
                'data' =>[
                    'user' => $user
                ]
            ]);
        } else {
            // Go back on error (or do what you want)
            return response()->json([
                'msg' => 'ERROR'
            ], 401);
        }
        
    }
    public function update(Request $request, User $user, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'status' =>'boolean'
        ]);
        
        if ($validator->fails()) { 
            $response = [
                        'status' => '0',
                        'error' => $validator->errors(),
                    ];

            return response()->json([ 'validator_failed' => $response], 401);   
        }

        $user = $user->find($id);
        if (!$user) {
            return response()->json(['msg' => 'User not found'], 404);
        }

        $user->update($request->all());
        return response()->json($user);
    }
    public function delete(User $user, $id){
        $user = $user->select(['id','name', 'email', 'status'])->find($id);
        if (!$user) {
            return response()->json(['msg' => 'User not found'], 404);
        }
        if (Auth::user()->id != $id) {
            return response()->json(['msg' => 'You cannot delete other user'],403);
        }
        $deleted = $user;
        if($user->delete()){
            return response()->json(['msg' => 'User deleted successfully', 'deleted_user' => $deleted], 200);
        }
        
    }
}

import axios from 'axios';
import { useRouter } from 'vue-router';
import VueCookie from 'vue-cookie';

axios.defaults.baseURL = "http://localhost:8000/api/";
axios.defaults.headers.common['Authorization'] = `Bearer ${VueCookie.get('token')}`;
export default axios;
/* export const getUser = () =>{
  axios.get('user', {headers:{'Authorization':`Bearer ${VueCookie.get('token')}`}})
    .then(({data}) =>{
      return data;
    }).catch(err => {return false})
} */
/* export const checkToken =  async() =>{
    const router = useRouter();
    try{
        const {data} = await axios.get('user', {headers:{'Authorization':`Bearer ${VueCookie.get('token')}`}});
        if(data) return true;
      }catch(err){
        return false  
      }
} */

/* module.exports = {checkToken} */
<!--
    <i class="cam_icon"><font-awesome-icon @click="chooseFiles" class="config-icon" icon="camera"/></i>
    <img class="image" style=""  v-if="!this.url" src="@/assets/png/default_user.png">
    <img class="image" v-else :src="url" style="">
    <input @change="previewImg" type="file" id="inputFile" hidden>
-->

<template>
    <div class="container-fluid d-flex flex-column align-items-center">
        <div class="col-12 d-flex flex-column" style="background-color: red;">
            <div class="col-12 d-flex flex-row align-items-center">
                <div class="col-3 d-flex flex-column align-items-center img-div">
                    <i class="cam"><font-awesome-icon @click="chooseFiles" icon="camera" /></i>
                    <img class="image" @click="chooseFiles" v-if="!this.url" src="@/assets/png/default_user.png">
                    <img class="image" @click="chooseFiles" v-else :src="url">
                    <input @change="previewImg" type="file" id="inputFile" hidden>
                </div>
                <div class="col-9 d-flex flex-row align-items-center">
                    <h4>{{ role_act }}</h4>
                </div>
                
            </div>
        </div>
    </div>
</template>
<style lang="scss" src="./style.scss" scoped></style>
<script scoped>
import api from 'axios';
import VueCookie from 'vue-cookie';
    export default{
        async created(){
            const {data} = await api.get('/role',{headers:{Authorization: `Bearer ${VueCookie.get('token')}` }});
            if(data.includes('admin')){
                this.role_act = "ADMINISTRADOR DO CACETE"
            }else if(data.includes('user')){
                this.role_act = "USUARIO MORTAL"
            }else{
                this.role_act = "ZÉ NINGUÉM"
            }
        },
        data(){
            return{
                roles:[],
                role_act:'',
                url:null,
                data:{
                    nm_cnh: this.nm_cnh,
                    bday: this.bday,
                    cpf:this.cpf,
                    profile_src:null
                }
            }
        },
        methods:{
            previewImg(e){
                const file = e.target.files[0];
                this.data.profile_src = file;
                this.url = URL.createObjectURL(file);
                console.log(this.url);
            },
            chooseFiles(){
                document.getElementById('inputFile').click()
            }
        }
    }
</script>
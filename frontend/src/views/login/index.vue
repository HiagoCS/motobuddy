<template>
    <div class="d-flex flex-column align-items-center col-12">
        <div class="d-flex justify-content-end col-12">
            <h1 class="title">motoBuddy</h1>
        </div>
        <div class="col-6 form">
            <div class="d-flex flex-column align-items-center col-12">
                <p class="form-title">Já tem conta?</p>
                <div class="d-flex flex-column align-items-center col-12">
                    <div class="d-flex col-11 input-group">
                        <input type="text" class="form-control" v-model="user.email" required>
                        <label for="">E-mail</label>
                    </div>
                    <div class="d-flex col-11 input-group">
                        <input type="text" class="form-control" v-model="user.password" required>
                        <label for="">Senha</label>
                    </div>
                    <div class="d-grid col-6">
                        <button class="btn btn-success" @click="login">Entrar</button>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import api from 'axios'
    import { useRouter } from 'vue-router';
    import VueCookie from 'vue-cookie';
    export default{
        async created(){
            if(this.$root.isLoggedIn) await this.$router.push("/");
        },
        data(){
            return{
                user:{
                    email: this.email,
                    password: this.password,
                }
            }
        },
        methods:{
            async login(){
                try{
                    const router = useRouter();
                const {data, status} = await api.post('/user/login', this.user);
                VueCookie.set("token", data.token)
                this.$root.isLoggedIn = VueCookie.get('token');
                await this.$router.push("/")
                }catch(err){
                    console.log(err);
                }
            }
        }
    }
</script>
<style lang="scss" src="./style.scss" scoped />
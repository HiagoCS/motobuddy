<template>
    <div class="d-flex flex-column align-items-center col-12">
        <div class="d-flex justify-content-end col-12">
            <h1 class="title">motoBuddy</h1>
        </div>
        <div class="col-6 form">
            <div class="d-flex flex-column align-items-center col-12">
                <p class="form-title">Ainda não tem conta?</p>
                <div class="d-flex flex-column align-items-center col-12">
                    <div class="d-flex col-11 input-group">
                        <input type="text" class="form-control" v-model="user.name" required>
                        <label for="">Nome Completo</label>
                    </div>
                    <div class="d-flex col-11 input-group">
                        <input type="text" class="form-control" v-model="user.email" required>
                        <label for="">E-mail</label>
                    </div>
                    <div class="d-flex col-11 input-group">
                        <input type="text" class="form-control" v-model="user.phone" required>
                        <label for="">Celular</label>
                    </div>
                    <div class="d-flex col-11 input-group">
                        <input type="text" class="form-control" v-model="user.password" required>
                        <label for="">Senha</label>
                    </div>
                    <div class="d-grid col-6">
                        <button class="btn btn-primary" @click="submit">Cadastrar</button>
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
    export default{
        async created(){
            if(this.$root.isLoggedIn) await this.$router.push("/");
        },
        data(){
            return{
                user:{
                    name: this.name,
                    email: this.email,
                    password: this.password,
                }
            }
        },
        methods:{
            async submit(){
                const router = useRouter();
                await api.post('/user/store', this.user);
                await this.$router.push("login")
            }
        }
    }
</script>

<style lang="scss" src="./style.scss" scoped/>
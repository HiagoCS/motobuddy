<template>
    <div class="d-flex flex-column align-items-center col-12">
        <div class="d-flex justify-content-end col-12">
            <h1 class="title">motoBuddy</h1>
        </div>
        <div class="col-6 form">
            <UserRegisterFrm></UserRegisterFrm>
            
        </div>
    </div>
</template>

<script>
    import api from 'axios'
    import { useRouter } from 'vue-router';
    import UserRegisterFrm from "./components/forms/index.vue"
    export default{
        components:{UserRegisterFrm},
        async created(){
            if(this.$root.isLoggedIn) await this.$router.push("/");
        },
        data(){
            return{
                checkFrm:{
                    user:false,
                    addData:false
                },
                user:{
                    name: this.name,
                    email: this.email,
                    password: this.password,
                }
            }
        },
        methods:{
            async next(){
                
            },
            async submit(){
                const router = useRouter();
                await api.post('/user/store', this.user);
                await this.$router.push("login")
            }
        }
    }
</script>

<style lang="scss" src="./style.scss" scoped/>
<template>
    <div class="d-flex flex-column align-items-center col-12">
        <div class="d-flex justify-content-end col-12">
            <h1 class="title">motoBuddy</h1>
        </div>
        <div class="col-6 form">
            <UserRegisterFrm v-if="!check.user" @next="this.check.user=true"/>
            <AddDataFrm 
                v-if="check.user&&!check.addData"/>
        </div>
    </div>
</template>

<script>
    import api from 'axios'
    import { useRouter } from 'vue-router';
    import UserRegisterFrm from "./components/forms/index.vue"
    import AddDataFrm from "./components/forms/AddDataFrm/index.vue"
    export default{
        components:{UserRegisterFrm, AddDataFrm},
        async created(){
            if(this.$root.isLoggedIn) await this.$router.push("/");
        },
        data(){
            return{
                check:{
                    user:false,
                    addData:false
                },
                user:{
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    phone: this.phone
                },
                
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
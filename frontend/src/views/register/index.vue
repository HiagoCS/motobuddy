<template>
    <div class="d-flex flex-column align-items-center col-12">
        <div class="d-flex justify-content-end col-12">
            <h1 class="title">motoBuddy</h1>
        </div>
        <div class="col-6 form">
            <UserRegisterFrm v-if="!check.user" @next="(user) =>{this.check.user=true;this.user=user;}"/>
            <AddDataFrm 
                v-if="check.user&&!check.addData"
                @returnData="(addData) =>{this.user=Object.assign(addData,this.user)}"/>
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
                user:{}
                
            }
        },
        methods:{
            async submit(user){
                const router = useRouter();
                const userID = (await api.post('/user/store', user)).data.userID;
                const formData = new FormData();
                formData.append('profile_pic', this.user.profile_src)
                await api.post(`/uploadImage/${userID}`, formData);
                await this.$router.push("login")
            }
        },
        watch:{
            user(){
                if(this.user.profile_src){
                    this.submit(this.user);
                }
            }
        }
    }
</script>

<style lang="scss" src="./style.scss" scoped/>
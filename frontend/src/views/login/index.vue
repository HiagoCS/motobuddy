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
                        <input type="text" @focusout="this.emailVal.focus=false" @focusin="this.emailVal.focus=true" :style="{'border': this.valEmail.border, 'color': this.valEmail.color, 'font-family': this.valEmail.fontFamily}" class="form-control" v-model="user.email" required>
                        <label for="">E-mail</label>
                    </div>
                    <div class="d-flex col-11 input-group">
                        <input type="password" @focusout="this.passVal.focus=false" @focusin="this.passVal.focus=true" :style="{'border': this.valPass.border, 'color': this.valPass.color, 'font-family': this.valPass.fontFamily}" class="form-control" v-model="user.password" required>
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
    import {mask} from 'vue-the-mask'
    export default{
        directives:{
            mask
        },
        async created(){
            if(this.$root.isLoggedIn) await this.$router.push("/");
        },
        data(){
            return{
                user:{
                    email: this.email,
                    password: this.password,
                },
                emailVal:{
                    eValidate:true,
                    focus: false
                },
                passVal:{
                    pValidate:true,
                    focus: false
                }
            }
        },
        computed:{
                valPass(){
                    if(this.user.password){
                        if (this.user.password.length >= 8) {
                            this.passVal.pValidate = true;
                        }
                         else {this.passVal.pValidate = false; }
                    }

                    if(!this.passVal.pValidate && this.user.password && this.passVal.focus){
                        console.log("INVALIDO", this.user.password); 
                        return {
                            border:'#ff0018 solid 3px',
                            color:'#ff0018',
                            fontFamily:'Quicksand-Bold'
                        }
                    } else if(this.passVal.pValidate || !this.user.password || !this.passVal.focus){
                        console.log("VALIDO", this.user.password)

                        return {
                            border:'',
                            color:'black',
                            fontFamily:'Quicksand-Regular'
                        }
                    }
                },
                valEmail(){
                    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.user.email)) {
                        this.emailVal.eValidate = true;
                    } else {this.emailVal.eValidate = false; }

                    if(!this.emailVal.eValidate && this.user.email && this.emailVal.focus){
                        console.log("INVALIDO", this.user.email); 
                        return {
                            border:'#ff0018 solid 3px',
                            color:'#ff0018',
                            fontFamily:'Quicksand-Bold'
                        }
                    } else if(this.emailVal.eValidate || !this.user.email || !this.emailVal.focus){
                        console.log("VALIDO", this.user.email)

                        return {
                            border:'',
                            color:'black',
                            fontFamily:'Quicksand-Regular'
                        }
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
                }catch({response}){
                    if(response.data.hasOwnProperty('validator_failed')){
                        const validator = response.data.validator_failed.error;
                        const keys = Object.keys(validator);
                        console.log('validator', validator);
                        let html = "";
                        const entries = Object.entries(validator);
                        console.log(entries);
                        const keyss = [];
                        const valuess = [];
                        entries.forEach((values) =>{
                            keyss.push(values[0])
                            valuess.push(values[1][0]);
                        })
                        keyss.forEach((key) =>{
                            valuess.forEach((value) =>{
                                if(value.includes(key)){
                                    key = this.$t(`login.${key}`);
                                    if(value.includes('.')) value = value.slice(0, -1);
                                    if(value.includes(" ")) value = value.split(" ").join("_");
                                    console.log('value_antigo',value)
                                    value = this.$t(`login.${value}`) || value;
                                    console.log('value_novo',value)
                                    html = `<div style="padding-left:10%;display:flex;flex-direction:row;justify-content: space-between"><strong style='position:absolute'>${key.toUpperCase()}</strong> - <p style="color:red; margin-left: 34.5%">${value}</p></div>\n${html}`
                                    console.log(key)
                                }
                            });
                        });
                        console.log(html);
                        this.$swal({
                            title: '⛔ Erro de Validação! ⛔',
                            text: 'Os seguintes campos foram preenchidos incorretamente.',
                            html: html,
                            icon: 'error',
                            confirmButtonText: 'Cool'
                        })
                    }
                }
            }
        }
    }
</script>
<style lang="scss" src="./style.scss" scoped />
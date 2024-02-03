<script>
import { RouterLink } from 'vue-router'
import api from '@/api/axios';
import VueCookie from 'vue-cookie';
import { useRouter } from 'vue-router';
export default{
  async created(){
    const {data} = api.get('user', {headers:{'Authorization':`Bearer ${VueCookie.get('token')}`}});
    if(data){
      if(data.additional.profile_src)
        this.url = `/src/${data.additional.profile_src}`;
      else
        this.url = "/src/assets/png/default_user.png"
    }
  },
  methods:{
    loggout(){
      /* this.isLoggedIn = false; */
      this.url = "/src/assets/png/default_user.png";
      this.$emit("loggout", false);
      VueCookie.delete("token");
      this.$router.push("/");
    },
    profilePage(){
      this.$root.isLoggedIn = false;
    }
  },
  props:['items'],
  data(){
    return{
      url:null
    }
  },
  computed:{
    logo(){
      if(this.$router.currentRoute.value.name == 'my-profile'){
        this.url = "/src/assets/png/mb_logo.png";
        return {route:'/'}
      }
      else{
        if(this.$root.isLoggedIn && this.$router.currentRoute.value.name != 'my-profile') {
        api.get('user', {headers:{'Authorization':`Bearer ${VueCookie.get('token')}`}})
          .then(({data}) =>{
            console.log("data", data)
            if(data.additional.profile_src){
              this.url = `/src/${data.additional.profile_src}`;
            }
            else{
              this.url = "/src/assets/png/default_user.png"
            }
          }).catch(err => {return false})
          return {route:'/home/profile/me'}
      }
      if(!this.$root.isLoggedIn) return {route:""};
      }
    }
  }
}
</script>

<template>
    <main>
      <div class="d-flex flex-column col-12 nav-main">
        <div class="d-flex flex-row col-12 justify-content-between nav-header">
          <div class="col-6 logo-div">
            <RouterLink :to="logo ? logo.route:''">
              <img v-if="this.$root.isLoggedIn && url" :src="url" style="border-radius: 50%;">
              <img v-if="!this.$root.isLoggedIn" src="@/assets/png/mb_logo.png">
            </RouterLink>
          </div>
          <div class="d-flex col-6 justify-content-end align-items-center config-div">
            <RouterLink to="/config"><font-awesome-icon class="config-icon" icon="cog"/></RouterLink>
          </div>
        </div>
        <div class="d-flex flex-column col-12 align-items-center nav-body">
          <div class="d-flex col-12 justify-content-center nav-items" v-for="nav in this.items " :key="nav">
            <RouterLink class="item" :to="nav.route"><h1>{{ nav.title }}</h1></RouterLink>
          </div>
        </div>
        <div class="d-flex flex-column col-12 align-items-center nav-footer" v-if="this.$root.isLoggedIn">
          <div class="d-flex col-12 justify-content-center nav-items" >
              <div class="item" @click="this.loggout"><h1>Sair</h1></div>
          </div>
        </div>
      </div>
    </main>
  </template>
<style lang="scss" src="./style.scss" scoped />
  
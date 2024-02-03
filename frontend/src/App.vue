<script>
import { RouterView } from 'vue-router'
import NavPage from './views/nav-page/index.vue'
import axios from 'axios'
import VueCookie from 'vue-cookie';

export default{
  components:{
    NavPage
  },
  data(){
    return{
      items:[],
      isLoggedIn: !!VueCookie.get('token'),
      user:{}
    }
  },
  computed:{
    updateNav(){
      if(this.isLoggedIn){
        return [{
          title:'Veiculos',
          route:'/home/veiculos'
        },{
          title:'Contatos',
          route:'/home/contatos'
        }]
      }else{
        return [{
          title:'Login',
          route:'/login'
        },{
          title:'Cadastro',
          route:'/register'
        }]
      }
    }
  },
  watch:{
    isLoggedIn(newValue){
      this.items = this.updateNav;
    }
  },
  created(){
    this.items = this.updateNav;
    if(!this.$root.isLoggedIn &&
    this.$router.currentRoute.value.name != "home") this.$router.push("login");
  },
  methods:{
    async userData(){
      if(this.isLoggedIn){
        const {data} = await axios.get('user', {headers:{'Authorization':`Bearer ${VueCookie.get('token')}`}});
        this.user = data;
      }else this.user = {};
    }
  }
}
</script>

<template>
  <main>
    <div class="d-flex flex-row main-div">
      <div class="col-3 nav-div">
        <NavPage :items="items" @loggout="(value) =>{this.isLoggedIn=value}"/>
      </div>
      <div class="d-flex justify-content-center col-9 pages-div">
        <RouterView :user="user"/>
      </div>
    </div> 
  </main>
</template>

<style lang="scss" scoped>
  .main-div{
    font-family: 'Quicksand-Regular';
    background-color: $background-black;
    height: 100vh; width: 100vw;
    .nav-div{
      border-right: 1px white solid;
    }
    .pages-div{
      background: $background-black;
      background: $gradientbg-black-red;
    }
  }
</style>

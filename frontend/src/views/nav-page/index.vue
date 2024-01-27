<script>
import { RouterLink } from 'vue-router'
export default{
  props:['items'],
  computed:{
    logo(){
      if(this.$root.isLoggedIn) return {route:'/home/profile/me'};
      if(!this.$root.isLoggedIn) return {route:"/home"};
      
    }
  }
}
</script>

<template>
    <main>
      <div class="d-flex flex-column col-12 nav-main">
        <div class="d-flex flex-row col-12 justify-content-between nav-header">
          <div class="col-6 logo-div">
            <RouterLink :to="logo.route">
              <img v-if="this.$root.isLoggedIn" src="@/assets/png/default_user.png">
              <img v-else src="@/assets/png/mb_logo.png">
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
              <div class="item" @click="this.$root.loggout"><h1>Sair</h1></div>
          </div>
        </div>
      </div>
    </main>
  </template>
<style lang="scss" src="./style.scss" scoped />
  
<script>
import { RouterLink } from 'vue-router'
export default{
  props:['items'],
  computed:{
    logo(){
      if(this.$root.isLoggedIn) return './png/default_user.png';
      else return './png/mb_logo.png';
      
    }
  }
}
</script>

<template>
    <main>
      <div class="d-flex flex-column col-12 nav-main">
        <div class="d-flex flex-row col-12 justify-content-between nav-header">
          <div class="col-6 logo-div">
            <RouterLink to="/"><img :src="logo"></RouterLink>
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
      </div>
    </main>
  </template>
<style lang="scss" src="./style.scss" scoped />
  
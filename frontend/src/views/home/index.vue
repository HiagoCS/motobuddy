<template>
    <main>
      <div class="d-flex flex-column align-items-center">
        <h3 style="color: white;">Bem-vindo</h3>
      <h1 style="color: white; 'Quicksand-Bold'"> {{ user.name }}</h1>
      </div>
    </main>
  </template>

<script>
export default{
  async created(){
    if(!this.$root.isLoggedIn) await this.$router.go(-1);
    this.$root.userData();
  },
  props:['user']
}
</script>
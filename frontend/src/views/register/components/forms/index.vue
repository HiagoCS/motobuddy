<template>
    <div class="d-flex flex-column align-items-center col-12">
        <p class="form-title">Ainda não tem conta?</p>
        <div class="d-flex flex-column align-items-center col-12">
            <div class="d-flex col-11 input-group">
                <input type="text" class="form-control" v-model="this.user.name" required>
                <label for="">Nome Completo</label>
            </div>
            <div class="d-flex col-11 input-group">
                <input type="text" class="form-control" v-model="this.user.email" required>
                <label for="">E-mail</label>
            </div>
            <div class="d-flex col-11 input-group">
                <input type="text" class="form-control" v-model="this.user.phone" required>
                <label for="">Celular</label>
            </div>
            <div class="d-flex col-11 input-group">
                <input type="text" class="form-control" v-model="this.user.password" required>
                <label for="">Senha</label>
            </div>
            <div class="d-grid col-6">
                <button class="btn btn-primary" @click="if(this.check)this.$emit('next', this.user);">Proximo</button>
            </div>
            <br>
        </div>
    </div>
</template>

<script>
export default{
    computed:{
        check(){
                if(!this.user.name)
                    return false;
                if(!this.user.email)
                    return false; 
                if(!this.user.password)
                    return false;
                if(!this.user.phone)
                    return false;
                return true;
            }
    },
    data(){
        return{
            user:{
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    phone: this.phone
                }
        }
    }
}
</script>
<style lang="scss" src="./style.scss" scoped>
</style>
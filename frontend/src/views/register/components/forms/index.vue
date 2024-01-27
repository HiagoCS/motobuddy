<template>
    <div class="d-flex flex-column align-items-center col-12">
        <p class="form-title">Ainda não tem conta?</p>
        <div class="d-flex flex-column align-items-center col-12">
            <div class="d-flex col-11 input-group">
                <input type="text" class="form-control" v-model="$root.user.name" required>
                <label for="">Nome Completo</label>
            </div>
            <div class="d-flex col-11 input-group">
                <input type="text" class="form-control" v-model="$root.user.email" required>
                <label for="">E-mail</label>
            </div>
            <div class="d-flex col-11 input-group">
                <input type="text" class="form-control" v-model="$root.user.phone" required>
                <label for="">Celular</label>
            </div>
            <div class="d-flex col-11 input-group">
                <input type="text" class="form-control" v-model="$root.user.password" required>
                <label for="">Senha</label>
            </div>
            <div class="d-grid col-6">
                <button class="btn btn-primary" @click="$root.next">Proximo</button>
            </div>
            <br>
        </div>
    </div>
</template>

<style lang="scss" src="./style.scss" scoped>
</style>
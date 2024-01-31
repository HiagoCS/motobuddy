<template>
    <div class="d-flex flex-column align-items-center col-12">
        <p class="form-title">Informações adicionais</p>
        <div class="d-flex flex-column align-items-center col-12">
            <div class="d-flex flex-row col-12 form">
                <div class="d-flex align-items-center flex-column col-4">
                    <div class="d-flex justify-content-center col-12" style="background-color: white; border-radius: 50%;width: 50%;">
                        <img v-if="!this.url" src="@/assets/png/default_user.png" style="height: 100px;width: 100px;">
                        <img v-else :src="url" style="height: 100px;width: 100px;">
                        <input @change="previewImg" type="file" id="inputFile" hidden>
                    </div>
                    <br>
                    <button class="btn btn-primary" @click="chooseFiles">
                        <font-awesome-icon icon="camera"/> Enviar Foto
                    </button>
                </div>
                <div class="d-flex align-items-center flex-column col-8">
                    <div class="d-flex justify-content-center col-12 input-group">
                        <input type="text" class="form-control" v-model="this.addData.nm_cnh" required>
                        <label for="normal">Nº de registro (CNH)</label>
                    </div>
                    <div class="d-flex justify-content-center col-12 input-group">
                        <input type="text" class="form-control" v-model="this.addData.cpf" required>
                        <label for="normal">CPF</label>
                    </div>
                    <div class="d-flex justify-content-center col-12 input-group">
                        <input type="date" class="form-control" v-model="this.addData.bday" required>
                        <label for="date">Data de Nascimento</label>
                    </div>
                </div>
                
            </div>
            <div class="col-10 d-grid gap-2">
                <button class="btn btn-primary" type="button" @click="this.$emit('returnData', this.addData)">Cadastrar</button>
            </div>
            <br>
        </div>
    </div>
</template>
<script>
    export default{
        data(){
            return{
                url:null,
                addData:{
                    nm_cnh: this.nm_cnh,
                    bday: this.bday,
                    cpf:this.cpf,
                    profile_src:null
                }
            }
        },
        computed:{
            cnh(cnh_num){
                const regex = /^[0-9]{11}$/;
                if (regex.test(cnh_num)) {
                    return cnh_num;
                } else {
                    return false;
                }
            }
        },
        methods:{
            previewImg(e){
                const file = e.target.files[0];
                this.addData.profile_src = file;
                this.url = URL.createObjectURL(file);
            },
            chooseFiles(){
                document.getElementById('inputFile').click()
            }
        }
    }
</script>
<style lang="scss" scoped src="./style.scss" ></style>
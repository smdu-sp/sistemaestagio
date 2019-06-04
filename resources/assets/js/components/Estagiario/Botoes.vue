<template>
<div>
    <hr>
    <div class="form-group">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-end">
                <button class="btn btn-success">Solicitar cartão de acesso</button>
                <button type="submit" class="btn btn-primary ml-2">Cadastrar</button>
                <router-link to="/" class="btn btn-danger ml-2 mr-2" @click="sair">Sair</router-link>
            </div>
        </div>
    </div>
</div>
</template>
<script>
export default {
    data() {
        btnSair: false
    },
    sair(e) {
        if(post) {
            btnSair = true;
        }
    },
    props: ['sair']
}
</script>
<style>

</style>
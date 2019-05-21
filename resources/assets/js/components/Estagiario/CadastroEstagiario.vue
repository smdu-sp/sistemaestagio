<template>
    <div class="container">
        <div class="row">
            <div class="col-3">
                <aside-component></aside-component>
            </div>
            <div class="col-9">
                <header-component></header-component>
                        <h1 class="d-flex justify-content-center">Cadastro de Estagiário</h1>
        <form @submit.prevent="inserirEstagiario">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" class="form-control" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Nome Social</label>
                        <input type="text" class="form-control" >
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="contratadtante">Contratado Por</label>
                        <select class="form-control" id="contratante" >
                            <option></option>
                            <option>SMDU</option>
                            <option>SEL</option>
                            <option>SMUL</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Cód. Estudante</label>
                        <input type="text" class="form-control" v-model="post.cod_estudante">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Contrato CIEE</label>
                        <input type="text" class="form-control" v-model="post.contrato">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>TCE Super Estágios</label>
                        <input type="text" class="form-control" v-model="post.tc_superestagios">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="cartao">Cartão Acesso</label>
                        <select class="form-control" id="cartao" v-model="post.cartao_acesso">
                            <option v-for="cartao of cartoes">{{ cartao.id }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Historico</label>
                        <input type="text" class="form-control" v-model="post.historico">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Status</label>
                        <input type="text" class="form-control" v-model="post.status">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Anexos</label>
                        <input type="text" class="form-control" v-model="post.anexos">
                    </div>
                </div>
            </div><br />
            <div class="form-group">
                <button class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
            </div>
        </div><!-- /row -->
    </div>
</template>
<script>
export default {
    data() {
        return {
            post: {},
            cartoes: {}
        }
    },
    created() {
        let uri = 'http://localhost:8000/api/cartao';
        this.axios.get(uri).then(response => this.cartoes = response.data);
        
    },
    methods: {
        inserirEstagiario() {

        }
    }
}
</script>
<style>

</style>

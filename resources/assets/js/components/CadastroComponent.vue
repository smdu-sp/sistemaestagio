<template>
    <div class="container-fluid">
        <header-component></header-component>
        <h1 class="d-flex justify-content-center">Cadastro de Vagas</h1>
        <form @submit.prevent="inserirVaga">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>id</label>
                        <input type="text" class="form-control" v-model="post.id">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Situação</label>
                        <input type="text" class="form-control" v-model="post.situacao">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Departamento Hierárquico</label>
                        <input type="text" class="form-control" v-model="post.dep_hierarquico">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Sigla</label>
                        <input type="text" class="form-control" v-model="post.sigla">
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
</template>

<script>
    export default {
        data(){
        return {
          post:{}
        }
    },
    created() {
        let uri = 'http://localhost:8000/api/vagas';
        this.axios.get(uri).then(response => console.log(response));

    },
    methods: {
      inserirVaga(){
        let uri = 'http://localhost:8000/api/vagas';
        this.axios.post(uri, this.post)
        .then((response) => {
            console.log('ok');
        })
        .catch(function (error) {
            console.log('error');
        });
      }
    }
  }
</script>
<style scoped>
* {
    margin: 0;
    padding: 0;
}
</style>

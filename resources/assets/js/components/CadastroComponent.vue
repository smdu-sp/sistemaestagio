<template>
    <div>
        <h1 class="text-center">Cadastro de Vaga</h1>
        <b-card no-body>
        <b-tabs card>
            <b-tab title="Dados da Vaga" active>
                <b-card-text>
                    <dados-pessoais
                        <form @submit.prevent="inserirVaga">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Código da vaga</label>
                                        <input type="number" class="form-control" v-model="post.id">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Situação</label>
                                        <select class="form-control" v-model="post.situacao">
                                            <option>CANCELADA</option>
                                            <option>DISTRIBUIDA</option>
                                            <option>TRANSFERIDA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Departamento</label>
                                        <select class="form-control" v-model="post.dep_hierarquico">
                                            <option v-for="departamento of departamentos" v-if="departamento.tipo == 'PAI'">{{ departamento.sigla }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Setor</label>
                                        <select class="form-control" v-model="post.sigla">
                                            <option v-for="departamento of departamentos" v-if="departamento.tipo == 'FILHO'">{{ departamento.sigla }}</option>
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
                                        <select class="form-control" v-model="post.status">
                                            <option>CANCELADA</option>
                                            <option>EM SELEÇÃO</option>
                                            <option>LIVRE</option>
                                            <option>OCUPADA</option>
                                        </select>
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
                </b-card-text>
            </b-tab>
        </b-tabs>
    </b-card>
    </div>
</template>

<script>
import { Requisicoes } from '../classes/Requisicoes';
    export default {
        data(){
        return {
          post:{},
          departamentos: {}
        }
    },
    created() {
        let uriVagas = 'http://localhost:8000/api/vagas';
        let uriDepartamentos = 'http://localhost:8000/api/departamentos';

        let requisicao = new Requisicoes();
        requisicao.requisicaoGet(uriDepartamentos, 'departamentos');

        this.axios.get(uriVagas).then(response => console.log(''));

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
.card {
  width: 98%;
}
</style>

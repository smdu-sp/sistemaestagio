<template>
    <div>
        <h1 class="text-center">Cadastro de Vaga</h1>
        <div v-if="msg.success" class="alert alert-success">
            {{ msg.sucesso }}
        </div>
        <div v-if="msg.error" class="alert alert-danger">
            {{ msg.erro }}
        </div>
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
                                        <input type="number" class="form-control" v-model="vaga.id">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Situação</label>
                                        <select class="form-control" v-model="vaga.situacao">
                                            <option>CANCELADA</option>
                                            <option>DISTRIBUIDA</option>
                                            <option>TRANSFERIDA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Departamento</label>
                                        <select class="form-control" v-model="vaga.dep_hierarquico">
                                            <option v-for="departamento of departamentos" v-if="departamento.tipo == 'PAI'">{{ departamento.sigla }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Setor</label>
                                        <select class="form-control" v-model="vaga.sigla">
                                            <option v-for="departamento of departamentos" v-if="departamento.tipo == 'FILHO'">{{ departamento.sigla }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" v-model="vaga.status">
                                            <option>CANCELADA</option>
                                            <option>EM SELEÇÃO</option>
                                            <option>LIVRE</option>
                                            <option>OCUPADA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" v-model="vaga.anexos">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Historico</label>
                                        <textarea class="form-control" rows="5" v-model="vaga.historico"></textarea>
                                    </div>
                                </div>   
                            </div><br />
                            <botoes-component :titulo="nomeBotao = 'Cadastrar'"></botoes-component>
                            <modal-component></modal-component><!--Componente exigido pelo botoes-component-->
                        </form>
                </b-card-text>
            </b-tab>
        </b-tabs>
    </b-card>
    </div>
</template>

<script>
import { Vaga } from '../classes/Vaga';
    export default {
        data(){
        return {
          vaga: new Vaga(),
          departamentos: {},
          msg: {
              error: false,
              success: false,
              sucesso: "Vaga cadastrada com sucesso",
              erro: "Erro ao cadastrar vaga"
          }
        }
    },
    created() {
        let uriVagas = 'http://localhost:8000/api/vagas';
        let uriDepartamentos = 'http://localhost:8000/api/departamentos';

        this.requisicaoGet(uriDepartamentos, 'departamentos');

    },
    methods: {
      inserirVaga(){
        let uri = 'http://localhost:8000/api/vagas';
        this.axios.post(uri, this.vaga)
        .then(response => {
            this.msg.error = false;
            this.msg.success = true;
        })
        .catch(error => {
            this.msg.success = false;
            this.msg.error = true;
        });
      },
        requisicaoGet(uri, variavel) {
            this.axios.get(uri).then(response => {
                this[variavel] = response.data
            })
        }
    }
  }
</script>
<style scoped>
.card {
  width: 98%;
}
</style>

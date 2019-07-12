<template>
    <div>
        <h1 class="text-center">Cadastro de Vaga</h1>
        <div v-if="msg.success" class="alert alert-success">
            {{ msg.sucesso }}
        </div>
        <div v-if="msg.camposInvalidos" class="alert alert-danger">
            {{ msg.campoInvalido }}
        </div>
        <div v-if="msg.error" class="alert alert-danger">
            {{ msg.erro }}
        </div>
        <div> <!-- Exibe este modal caso o cpf já exista na base de dados -->
            <b-modal v-model="modalCodvaga" ok-only>
                <p>O código de vaga já existe na base de dados</p>
                <p>Digite outro por favor</p>
            </b-modal>
        </div>
        <b-card no-body>
        <b-tabs card>
            <b-tab title="Dados da Vaga" active>
                <b-card-text>
                    <dados-pessoais
                        <form @submit.prevent="validaCampos">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Código da vaga</label>
                                        <input 
                                            @blur="validaCodigo"
                                            @input="verificaDuplicidadeCodigo"
                                            :class="{'is-invalid': codigoValido}" 
                                            type="text" 
                                            class="form-control"
                                            maxlength="5" 
                                            v-model="vaga.id">
                                        <div v-if="codigoValido" class="invalid-feedback">
                                            Digite o código da vaga por favor
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Situação</label>
                                        <select 
                                            @blur="validaSituacao"
                                            class="form-control"
                                            :class="{'is-invalid': situacaoValida}" 
                                            v-model="vaga.situacao">
                                            <option>CANCELADA</option>
                                            <option>DISTRIBUIDA</option>
                                            <option>TRANSFERIDA</option>
                                        </select>
                                        <div v-if="situacaoValida" class="invalid-feedback">
                                            Informe a situação da vaga por favor
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Departamento</label>
                                        <select 
                                            @blur="validaDepartamento"
                                            :class="{'is-invalid': departamentoValido}" 
                                            class="form-control" 
                                            v-model="vaga.dep_hierarquico">
                                            <option v-for="departamento of departamentos" v-if="departamento.tipo == 'PAI'">{{ departamento.sigla }}</option>
                                        </select>
                                        <div v-if="departamentoValido" class="invalid-feedback">
                                            Informe o departamento por favor
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Setor</label>
                                        <select 
                                            @blur="validaSetor"
                                            :class="{'is-invalid': setorValido}" 
                                            class="form-control" 
                                            v-model="vaga.sigla">
                                            <option v-for="departamento of departamentos" v-if="departamento.tipo == 'FILHO'">{{ departamento.sigla }}</option>
                                        </select>
                                        <div v-if="setorValido" class="invalid-feedback">
                                            Informe o setor por favor
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select 
                                            @blur="validaStatus"
                                            :class="{'is-invalid': statusValido}" 
                                            class="form-control" 
                                            v-model="vaga.status">
                                            <option>CANCELADA</option>
                                            <option>EM SELEÇÃO</option>
                                            <option>LIVRE</option>
                                            <option>OCUPADA</option>
                                        </select>
                                        <div v-if="statusValido" class="invalid-feedback">
                                            Informe o status por favor
                                        </div>
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
    export default {
        data(){
        return {
          vaga: {},
          modalCodvaga: false,
          departamentos: {},
          codigoValido: false,
          situacaoValida: false,
          departamentoValido: false,
          setorValido: false,
          statusValido: false,
          camposValidacao: [],
          revisarCampos: false,
          msg: {
              error: false,
              success: false,
              camposInvalidos: false,
              sucesso: "Vaga cadastrada com sucesso",
              erro: "Erro ao cadastrar vaga",
              campoInvalido: "Revise os campos em vermelho"
          }
        }
    },
    created() {
        let uriVagas = '/api/vagas';
        let uriDepartamentos = '/api/departamentos';

        this.requisicaoGet(uriDepartamentos, 'departamentos');

    },
    methods: {
        scrollTop() { 
            window.scrollTo(0,0);
        },
        inserirVaga(){
        let uri = '/api/vagas';
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
        validaCampos() {
            this.camposValidacao = [
                {codigoValido: this.vaga.id},
                {situacaoValida: this.vaga.situacao},
                {departamentoValido: this.vaga.dep_hierarquico},
                {setorValido: this.vaga.sigla},
                {statusValido: this.vaga.status}
            ]
            
            let contadorCamposInvalidos = 0
            for(let i = 0; i <= this.camposValidacao.length; i++) {
                for(let key in this.camposValidacao[i]) {
                    if(this.camposValidacao[i][key]) {
                        this[key] = false
                        this.revisarCampos = false;
                    } else {
                        this[key] = true;
                        this.revisarCampos = true;
                        contadorCamposInvalidos++;
                    }
                }
            }

            if(contadorCamposInvalidos == 0) {
                this.msg.camposInvalidos = false;
                this.inserirVaga();
            } else {
                this.msg.camposInvalidos = true;
                this.scrollTop();
            }
        },
        requisicaoGet(uri, variavel) {
            this.axios.get(uri).then(response => {
                this[variavel] = response.data
            })
        },
        validacao(valorCampo, variavelBooleana) {
            if(!valorCampo.target.value) {
                this[variavelBooleana] = true
            } else {
                this[variavelBooleana] = false
            }
        },
        verificaDuplicidadeCodigo() {
            const uriVagas = `/api/vagas/${this.vaga.id}`;
            if(this.vaga.id.length == 5) {
                this.axios.get(uriVagas)
                .then(response => {
                    this.modalCodvaga = !this.modalCodvaga;
                    this.vaga.id = ''
                }).catch(error => {
                    console.log("Erro: "+error);
                })
            }
        },
        validaCodigo(codigo) { this.validacao(codigo, 'codigoValido') }, 
        validaSituacao(situacao) { this.validacao(situacao, 'situacaoValida') }, 
        validaDepartamento(departamento) { this.validacao(departamento, 'departamentoValido') }, 
        validaSetor(setor) { this.validacao(setor, 'setorValido') }, 
        validaStatus(status) { this.validacao(status, 'statusValido') }, 
    }
  }
</script>
<style scoped>
.card {
  width: 98%;
}
.card-body {
    height: auto;
}
b-card {
    max-width: 100%;
}
</style>

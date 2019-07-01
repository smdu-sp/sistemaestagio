<template>
    <div>
        <h1>Cadastrar Cartão de Acesso</h1>

        <div v-if="msg.error" class="alert alert-danger">
            {{ msg.erro }}
        </div>

        <div v-if="msg.camposInvalidos" class="alert alert-danger">
            {{ msg.campoInvalido }}
        </div>
        
        <div v-if="msg.success" class="alert alert-success">
            {{ msg.sucesso }}
        </div>

        <b-card no-body>
            <b-tabs card>
                <b-tab title="Dados do Cartão" active>
                    <b-card-text>
                        <form @submit.prevent="validaCampos">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Cartão Nº</label>
                                        <input 
                                            @blur="validaId"
                                            :class="{'is-invalid': idValido}"
                                            type="text" 
                                            class="form-control"
                                            placeholder="Ex: A00004404904135"
                                            v-model="cartaoAcesso.id"
                                            maxlength="15">
                                        <div v-if="idValido" class="invalid-feedback">
                                            Digite o número por favor
                                        </div>
                                    </div>
                                </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Situação</label>
                                            <select 
                                                @blur="validaSituacao"
                                                :class="{'is-invalid': situacaoValida}"
                                                class="form-control" 
                                                v-model="cartaoAcesso.situacao">
                                                <option>ATIVO</option>
                                                <option>INATIVO</option>
                                                <option>EXTRAVIADO</option>
                                                <option>COM DEFEITO</option>
                                            </select>
                                            <div v-if="situacaoValida" class="invalid-feedback">
                                                Selecione a situação por favor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Observacoes</label>
                                        <textarea rows="5" class="form-control" v-model="cartaoAcesso.observacoes"></textarea>
                                    </div>
                                </div>
                            <botoes-component :titulo="nomebotao = 'Salvar'"></botoes-component>
                        </form>
                    </b-card-text>
                </b-tab>
            </b-tabs>
        </b-card>
    </div>
</template>

<script>
export default {
    data() {
        return {
            cartaoAcesso: {},
            idValido: false,
            situacaoValida: false,
            revisarCampos: false,
            msg: {
                error: false,
                success: false,
                camposInvalidos: false,
                erro: "Erro ao cadastrar cartão de acesso",
                sucesso: "Cartão de acesso cadastrado com sucesso",
                campoInvalido: "Revise os campos em vermelho"
            },
            urlPadrao: 'http://localhost:8000/api/'
        }
    },
    methods: {
        scrollTop() { 
            window.scrollTo(0,0);
        },
        validaCampos() {
            this.camposValidacao = [
                {idValido: this.cartaoAcesso.id},
                {situacaoValida: this.cartaoAcesso.situacao}
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
                this.inserirCartaoAcesso();
            } else {
                this.msg.camposInvalidos = true
                this.scrollTop();
            }
        },
        inserirCartaoAcesso() {
            const uriCartaoAcesso = this.urlPadrao+'cartao';

            this.axios
            .post(uriCartaoAcesso, this.cartaoAcesso)
            .then(response => {
                this.msg.error = false;
                this.msg.success = true;

                for(let key in this.cartaoAcesso) {
                this.cartaoAcesso[key] = '';
            }
            })
            .catch(error => {
                this.msg.success = false;
                this.msg.error = true;
            })
        },
        validacao(valorCampo, variavelBooleana) {
            if(!valorCampo.target.value) {
                this[variavelBooleana] = true
            } else {
                this[variavelBooleana] = false
            }
        },
        validaId(id) { this.validacao(id, 'idValido') },
        validaSituacao(situacao) { this.validacao(situacao, 'situacaoValida') }
    }
}
</script>

<style>
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

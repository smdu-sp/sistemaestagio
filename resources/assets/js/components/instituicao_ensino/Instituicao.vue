<template>
    <div>
        <h1 class="text-center">Cadastro de Instituição de Ensino</h1>

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
                <b-tab title="Informações da Instituíção" active>
                    <b-card-text>
                        <form @submit.prevent="validaCampos">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="">Razão social</label>
                                        <input 
                                            @blur="validaRazaoSocial"
                                            :class="{'is-invalid': razaoSocialValida}"
                                            type="text" 
                                            maxlength="150" 
                                            class="form-control" 
                                            v-model="instituicao.razao_social">
                                        <div v-if="razaoSocialValida" class="invalid-feedback">
                                            Digite a razão social por favor
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Campus</label>
                                        <input 
                                            type="text" 
                                            @blur="validaCampus"
                                            :class="{'is-invalid': campusValido}"
                                            maxlength="150" 
                                            class="form-control" 
                                            v-model="instituicao.campus">
                                        <div v-if="campusValido" class="invalid-feedback">
                                            Digite o campus por favor
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Endereço</label>
                                        <input type="text" maxlength="150" class="form-control" v-model="instituicao.endereco">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Bairro</label>
                                        <input type="text" maxlength="50" class="form-control" v-model="instituicao.bairro">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">CEP</label>
                                        <input type="text" maxlength="11" class="form-control" v-model="instituicao.cep">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">UF</label>
                                        <select class="form-control" v-model="instituicao.uf">
                                            <option v-for="estado of estados" :key="estado.id">{{ estado.uf }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Telefone</label>
                                        <input type="text" maxlength="13" class="form-control" v-model="instituicao.telefone">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">CNPJ</label>
                                        <input type="text" maxlength="18" class="form-control" v-model="instituicao.cnpj">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Representante</label>
                                        <input type="text" maxlength="100" class="form-control" v-model="instituicao.representada_por">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Cargo</label>
                                        <input type="text" maxlength="50" class="form-control" v-model="instituicao.cargo">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Responsável pelo estágio</label>
                                        <input type="text" maxlength="100" class="form-control" v-model="instituicao.responsavel">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Cargo</label>
                                        <input type="text" maxlength="50" class="form-control" v-model="instituicao.cargo1">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <textarea  maxlength="150" cols="30" rows="5" class="form-control" v-model="instituicao.descricao">
                                    </textarea>
                                </div>
                            </div>
                            <botoes-component :titulo="nomebotao = 'Cadastrar'"></botoes-component>
                        </form>
                    </b-card-text>
                </b-tab>
            </b-tabs>
        </b-card>
    </div>
</template>

<script>
import methods from '../../mixins/methods';
export default {
    data() {
        return {
            instituicao: {},
            estados: {},
            revisarCampos: false,
            razaoSocialValida: false,
            campusValido: false,
            msg: {
                error: false,
                success: false,
                camposInvalidos: false,
                erro: "Erro ao cadastrar Instituíção de Ensino",
                sucesso: "Instituíção de Ensino cadastrada com sucesso",
                campoInvalido: "Revise os campos em vermelho"
            }
        }
    },
    beforeMount() {
        this.retornaEstados()
    },
    mixins: [methods],
    methods: {
        retornaEstados() {
            const uriEstados = '/api/estados';

            this.axios.get(uriEstados).then(response => {
                this.estados = response.data
            })
            .catch(error => {
                console.log(error)
            })
        },
        validaRazaoSocial(razaoSocial) { this.validacao(razaoSocial, 'razaoSocialValida') },
        validaCampus(campus) { this.validacao(campus, 'campusValido') },
        validaCampos() {
            this.camposValidacao = [
                {razaoSocialValida: this.instituicao.razao_social},
                {campusValido: this.instituicao.campus}
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
                this.inserirInstituicao();
            } else {
                this.msg.camposInvalidos = true
                this.scrollTop();
            }
        },
        inserirInstituicao() {
            const uriInstituicao = '/api/instituicao';

            this.axios.post(uriInstituicao, this.instituicao)
            .then(response => {
                this.msg.error = false;
                this.msg.success = true;
                this.instituicao = {}
            })
            .catch(error => {
                this.msg.success = false;
                this.msg.error = true;
            })
        }
    }
}
</script>

<style>

</style>

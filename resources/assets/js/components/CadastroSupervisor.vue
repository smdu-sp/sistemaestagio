<template>
        <div>
        <h1 class="text-center">Cadastro de Supervisor</h1>
        <div v-if="msg.error" class="alert alert-danger">
            {{msg.erro}}
        </div>
        <div v-if="msg.camposInvalidos" class="alert alert-danger">
            {{msg.campoInvalido}}
        </div>
        <div v-if="msg.success" class="alert alert-success">
            {{msg.sucesso}}
        </div>
        <b-card no-body>
        <b-tabs card>
            <b-tab title="Dados do Supervisor" active>
                <b-card-text>
                    <dados-pessoais
                        <form @submit.prevent="validaCampos">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nome</label>
                                        <input
                                            @blur="validaNome"
                                            type="text" 
                                            class="form-control" 
                                            maxlength="150"
                                            :class="{'is-invalid': nomeValido}" 
                                            placeholder="Digite o Nome Completo"
                                            v-model="supervisor.nome">
                                        <div v-if="nomeValido" class="invalid-feedback">
                                            Digite o nome por favor
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>RF</label>
                                        <input type="tel" class="form-control" maxlength="12" v-model="supervisor.rf">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>CPF</label>
                                        <input type="tel" 
                                        class="form-control" 
                                        maxlength="14" 
                                        v-b-tooltip.hover title="Somente números"
                                        @input="converteCpf"
                                        v-model="supervisor.cpf">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label>Cargo/Função</label>
                                    <select 
                                        @blur="validaCargo"
                                        :class="{'is-invalid': cargoValido}" 
                                        class="form-control" 
                                        v-model="supervisor.cargo_funcao">
                                        <option v-for="cargo of cargos" :value="cargo.codigo">{{ cargo.cargo }}</option>
                                    </select>
                                    <div v-if="cargoValido" class="invalid-feedback">
                                        Informe o cargo por favor
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Departamento</label>
                                    <select 
                                        @blur="validaDepartamento"
                                        class="form-control"
                                        :class="{'is-invalid': departamentoValido}" 
                                        v-model="supervisor.departamento">
                                        <option v-for="departamento of departamentos" v-if="departamento.tipo == 'FILHO'" :value="departamento.eh">{{ departamento.sigla }}</option>
                                    </select>
                                    <div v-if="departamentoValido" class="invalid-feedback">
                                        Informe o departamento por favor
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Formação</label>
                                    <select class="form-control" v-model="supervisor.formacao">
                                        <option v-for="curso of cursos" :value="curso.id">{{ curso.formacao }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Conselho profissional</label>
                                    <input type="text" class="form-control" v-model="supervisor.conselho_profissional">
                                </div>
                                <div class="col-md-3">
                                    <label for="">Telefone</label>
                                    <input 
                                        type="tel" 
                                        class="form-control" 
                                        v-model="supervisor.tel_contato"
                                        @input="converteFone" 
                                        maxlength="14"
                                        v-b-tooltip.hover title="Somente números">
                                </div>
                                <div class="col-md-3">
                                    <label for="">E-mail Supervisor</label>
                                    <input
                                        @blur="validaEmail"
                                        :class="{'is-invalid': emailValido}"
                                        type="email" 
                                        class="form-control" 
                                        v-model="supervisor.e_mail">
                                    <div v-if="emailValido" class="invalid-feedback">
                                        Informe o e-mail por favor
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <label for="">Situação</label>
                                    <select 
                                        @blur="validaSituacao"
                                        :class="{'is-invalid': situacaoValida}"
                                        class="form-control" 
                                        v-model="supervisor.situacao">
                                        <option>ATIVO</option>
                                        <option>INATIVO</option>
                                    </select>
                                    <div v-if="situacaoValida" class="invalid-feedback">
                                        Informe a situação por favor
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label for="">Principais atividades desenvolvidas pelo estagiário</label>
                                    <textarea cols="30" rows="10" class="form-control" v-model="supervisor.atividades_estagiario"></textarea>
                                </div>
                            </div>
                            <botoes-component :titulo="nomeBotao = 'Cadastrar'"></botoes-component>
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
        return{
            supervisor: {},
            departamentos: {},
            cargos: {},
            cursos: {},
            nomeValido: false,
            rfValido: false,
            cargoValido: false,
            departamentoValido: false,
            emailValido: false,
            situacaoValida: false,
            msg: {
                error: false,
                success: false,
                camposInvalidos: false,
                erro: "Erro ao cadastrar supervisor",
                sucesso: "Supervisor cadastrado com sucesso",
                campoInvalido: "Revise os campos em vermelho"

            },
            camposValidacao: []
        }
    },
    beforeMount() {
        let uriDepartamentos = 'http://localhost:8000/api/departamentos';
        let uriCursos = 'http://localhost:8000/api/cursos';
        let uriCargos = 'http://localhost:8000/api/cargos';
        this.requisicaoGet(uriDepartamentos, 'departamentos');
        this.requisicaoGet(uriCursos, 'cursos');
        this.requisicaoGet(uriCargos, 'cargos');
    },
    methods: {
        requisicaoGet(uri, variavel) {
            this.axios.get(uri).then(response => {
                this[variavel] = response.data
            })
        },
        validaCampos() {
            this.camposValidacao = [
                {nomeValido: this.supervisor.nome},
                {cargoValido: this.supervisor.cargo_funcao},
                {departamentoValido: this.supervisor.departamento},
                {emailValido: this.supervisor.e_mail},
                {situacaoValida: this.supervisor.situacao},
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
                this.inserirSupervisor();
            } else {
                this.msg.camposInvalidos = true
                this.scrollTop();
            }
        },
        converteCpf() {
            if(this.supervisor.cpf.length == 3 || this.supervisor.cpf.length == 7) {
                this.supervisor.cpf += '.';
            } else if(this.supervisor.cpf.length == 11) {
                this.supervisor.cpf += '-';
            }
        },
        converteFone() {
            if(this.supervisor.tel_contato.length == 1) {
                this.supervisor.tel_contato = '('+this.supervisor.tel_contato;
            } else if(this.supervisor.tel_contato.length == 3) {
                this.supervisor.tel_contato += ') ';
            } else if(this.supervisor.tel_contato.length == 9) {
                this.supervisor.tel_contato += '-';
            }
        },
        validacao(valorCampo, variavelBooleana) {
            if(!valorCampo.target.value) {
                this[variavelBooleana] = true
            } else {
                this[variavelBooleana] = false
            }
        },
        validaNome(nome) { this.validacao(nome, 'nomeValido') }, 
        validaRf(rf) { this.validacao(rf, 'rfValido') }, 
        validaCargo(cargo) { this.validacao(cargo, 'cargoValido') }, 
        validaDepartamento(departamento) { this.validacao(departamento, 'departamentoValido') }, 
        validaEmail(email) { this.validacao(email, 'emailValido') }, 
        validaSituacao(situacao) { this.validacao(situacao, 'situacaoValida') }, 
        scrollTop() { 
            window.scrollTo(0,0);
        },
        inserirSupervisor() {
            const uriSupervisor = 'http://localhost:8000/api/supervisores';
            this.axios
            .post(uriSupervisor, this.supervisor)
            .then(response => {
                this.scrollTop();
                this.msg.error = false;
                this.msg.success = true;
            })
            .catch(error => {
                this.scrollTop();
                this.msg.success = false;
                this.msg.error = true;
            })
        }
    },
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

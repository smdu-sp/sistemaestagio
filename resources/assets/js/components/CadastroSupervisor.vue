<template>
        <div>
        <h1 class="text-center">Cadastro de Supervisor</h1>
        <div v-if="msg.error" class="alert alert-danger">
            {{msg.erro}}
        </div>
        <div v-if="msg.success" class="alert alert-success">
            {{msg.sucesso}}
        </div>
        <b-card no-body>
        <b-tabs card>
            <b-tab title="Dados do Supervisor" active>
                <b-card-text>
                    <dados-pessoais
                        <form @submit.prevent="inserirSupervisor">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nome</label>
                                        <input type="text" class="form-control" maxlength="150" v-model="supervisor.nome">
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
                                        maxlength="11" 
                                        v-b-tooltip.hover title="Somente números"
                                        v-model="supervisor.cpf">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label>Cargo/Função</label>
                                    <select class="form-control" v-model="supervisor.cargo_funcao">
                                        <option v-for="cargo of cargos" :value="cargo.codigo">{{ cargo.cargo }}</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Departamento</label>
                                    <select class="form-control" v-model="supervisor.departamento">
                                        <option v-for="departamento of departamentos" v-if="departamento.tipo == 'FILHO'" :value="departamento.eh">{{ departamento.sigla }}</option>
                                    </select>
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
                                    <input type="tel" class="form-control" v-model="supervisor.tel_contato">
                                </div>
                                <div class="col-md-3">
                                    <label for="">E-mail Supervisor</label>
                                    <input type="email" class="form-control" v-model="supervisor.e_mail">
                                </div>
                                <div class="col-md-3">
                                    <label for="">Situação</label>
                                    <select class="form-control" v-model="supervisor.situacao">
                                        <option>ATIVO</option>
                                        <option>INATIVO</option>
                                    </select>
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
            msg: {
                error: false,
                success: false,
                erro: "Erro ao cadastrar supervisor",
                sucesso: "Supervisor cadastrado com sucesso"
            }
        }
    },
    methods: {
        requisicaoGet(uri, variavel) {
            this.axios.get(uri).then(response => {
                this[variavel] = response.data
            })
        },
        inserirSupervisor() {
            let uriSupervisor = 'http://localhost:8000/api/supervisores';
            this.axios
            .post(uriSupervisor, this.supervisor)
            .then(response => {
                this.msg.error = false;
                this.msg.success = true;
            })
            .catch(error => {
                this.msg.success = false;
                this.msg.error = true;
            })
        }
    },
    beforeMount() {
        let uriDepartamentos = 'http://localhost:8000/api/departamentos';
        let uriCursos = 'http://localhost:8000/api/cursos';
        let uriCargos = 'http://localhost:8000/api/cargos';
        this.requisicaoGet(uriDepartamentos, 'departamentos');
        this.requisicaoGet(uriCursos, 'cursos');
        this.requisicaoGet(uriCargos, 'cargos');
    }
}
</script>

<style>
.card {
  width: 98%;
}
</style>

<template>
    <div>
        <h1>Consulta de Vaga</h1>
        <div v-if="msg.error" class="alert alert-danger">
            {{ msg.erro }}
        </div>
        <div v-if="msg.success" class="alert alert-success">
            {{ msg.sucesso }}
        </div>
        <b-card no-body>
            <b-tabs card>
                <b-tab title="Dados da vaga" active>
                    <b-card-text>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Vaga</label>
                                <select name="" id="" class="form-control" @change="selecionaVaga" v-model="vagaSelecionada.id">
                                    <option value=""></option>
                                    <option v-for="vaga of vagasOrdenadas" :key="vaga.id">{{ vaga.id }}</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">Situação</label>
                                <select name="" id="" class="form-control" v-model="vagaSelecionada.situacao">
                                    <option>{{ vagaSelecionada.situacao }}</option>
                                    <option>NÃO DISTRIBUIDA</option>
                                    <option>CANCELADA</option>
                                    <option>DISTRIBUIDA</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">Departamento</label>
                                <select name="" id="" class="form-control" v-model="vagaSelecionada.dep_hierarquico">
                                    <option>{{ vagaSelecionada.dep_hierarquico }}</option>
                                    <option v-for="departamento of departamentosOrdenados" :key="departamento.sigla" v-if="departamento.tipo == 'PAI'">{{ departamento.sigla }}</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">Setor</label>
                                <select name="" id="" class="form-control" v-model="vagaSelecionada.sigla">
                                    <option>{{ vagaSelecionada.sigla }}</option>
                                    <option v-for="departamento of departamentosOrdenados" :key="departamento.sigla" v-if="departamento.tipo == 'FILHO'">{{ departamento.sigla }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Status</label>
                                <select name="" id="" class="form-control" v-model="vagaSelecionada.status">
                                    <option>{{ vagaSelecionada.status }}</option>
                                    <option>LIVRE</option>
                                    <option>EM SELEÇÃO</option>
                                    <option>OCUPADA</option>
                                    <option>CANCELADA</option>
                                </select>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-end">
                            <input type="button" value="Salvar" class="btn btn-primary" @click="atualizaVaga">
                        </div>
                    </b-card-text>
                </b-tab>
            </b-tabs>
        </b-card>
    </div>
</template>

<script>
import computeds from '../../mixins/computeds';
export default {
    data() {
        return {
            vagas: {},
            departamentos: {},
            msg: {
                error: false,
                success: false
            },
            vagaSelecionada: {

            }
        }
    },
    beforeMount() {
        this.retornaVagas();
        this.retornaDepartamentos();
    },
    mixins: [computeds],
    methods: {
        selecionaVaga(vaga) {
            const uriVagas = `api/vagas/${this.vagaSelecionada.id}`;

            this.axios.get(uriVagas).then(response => {
                this.vagaSelecionada = response.data;
            })
            .catch(error => {
                console.log(error);
            })
        },
        retornaDepartamentos() {
            const uriDepartamentos = '/api/departamentos';

            this.axios.get(uriDepartamentos).then(response => {
                this.departamentos = response.data;
            })
        },
        retornaVagas() {
            const uriVagas = '/api/vagas';

            this.axios.get(uriVagas).then(response => {
                this.msg.error = false;
                this.vagas = response.data;
            })
            .catch(error => {
                this.msg.error = true;
                this.msg.erro = 'Erro ao retornar vagas do banco de dados';
            })
        },
        atualizaVaga() {
            const uriVagas = `/api/vagas/${this.vagaSelecionada.id}`;

            this.axios.patch(uriVagas, this.vagaSelecionada).then(response => {
                this.msg.error = false;
                this.msg.success = true;
                this.msg.sucesso = 'Vaga atualizada com sucesso';
            })
            .catch(error => {
                this.msg.success = false;
                this.msg.error = true;
                this.msg.erro = 'Erro ao atualizar vaga';
            })
        }
    }
}
</script>

<style>

</style>

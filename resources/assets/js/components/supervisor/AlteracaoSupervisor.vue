<template>
    <div>
        <div v-if="msg.error">{{ msg.erro }}</div>
        <div v-if="msg.success">{{ msg.sucesso }}</div>
        <h1>Alteração Supervisor</h1> 
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Antigo Supervisor</label>
                    <select class="form-control" disabled="disabled" v-model="supervisorAlteracao.supervisor_antigo = post.supervisor">
                        <option>{{ post.supervisor }}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Novo Supervisor</label>
                    <select class="form-control" v-model="supervisorAlteracao.supervisor_novo">
                        <option v-for="supervisor of supervisoresOrdenados" :key="supervisor.nome">{{ supervisor.nome.toUpperCase() }}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="">Início Supervisão</label>
                <input type="date" class="form-control" v-model="supervisorAlteracao.inicio_supervisao">
            </div>
            <div class="col-md-3">
                <label for="">Fim Supervisão</label>
                <input type="date" class="form-control" v-model="supervisorAlteracao.fim_supervisao">
            </div>
            <div class="col-md-3">
                <label for="">Supervisão (dias)</label>
                <input type="text" class="form-control" disabled="disabled" v-model="duracao">
            </div>
            <div class="col-md-3">
                <label for="">Cód_estudante</label>
                <input type="text" class="form-control" disabled="disabled" v-model="supervisorAlteracao.estagiario = post.cod_estudante">
            </div>
        </div>

        <div class="row mt-2 d-flex justify-content-end">
            <div class="form-group">
                <button type="submit" @click="salvarAlteracao" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </div>
</template>

<script>
import computeds from '../../mixins/computeds';
export default {
    data() {
        return {
            supervisores: {},
            supervisorAlteracao: {},
            msg: {
                error: false,
                success: false
            }
        }
    },
    mixins: [computeds],
    beforeMount() {
        this.retornaSupervisores();
    },
    computed: {
        duracao() {
            if(this.supervisorAlteracao.inicio_supervisao && this.supervisorAlteracao.fim_supervisao) {
                const dataInicio = new Date(this.supervisorAlteracao.inicio_supervisao);
                const dataFim = new Date(this.supervisorAlteracao.fim_supervisao);
                const dataInicioFormatada = dataInicio.setDate(dataInicio.getDate());
                const dataFimFormatada = dataFim.setDate(dataFim.getDate());
                const diferenca = (dataFimFormatada - dataInicioFormatada)/86400000;
                this.supervisorAlteracao.duracao_supervisao_dias = diferenca;
                return diferenca;
            }
        }
    },
    methods: {
        salvarAlteracao() {
            const uriSupervisorAlteracao = '/api/supervisor_alteracao'

            this.axios
            .post(this.supervisorAlteracao).then(response => {
                this.msg.sucesso = 'Alteração cadastrada com sucesso';
                this.msg.success = true;
            })
        },
        retornaSupervisores() {
            const uriSupervisores = '/api/supervisores'

            this.axios.get(uriSupervisores)
            .then(response => {
                this.msg.error = false;
                this.supervisores = response.data;
            })
            .catch(error => {
                this.msg.error = true;
                this.msg.erro = 'Erro ao retornar supervisores';
            })
        }
    },
    props: ['post']
}
</script>

<style>

</style>

<template>
    <div>
        <div v-if="msg.error" class="alert alert-danger">{{ msg.erro }}</div>
        <div v-if="msg.success" class="alert alert-success">{{ msg.sucesso }}</div>
        <div v-if="msg.successEstagiario" class="alert alert-success">{{ msg.sucessoEstagiario }}</div>
        <div v-if="msg.errorEstagiario" class="alert alert-danger">{{ msg.erroEstagiario }}</div>
        <h1>Alteração Supervisor</h1> 
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Antigo Supervisor</label>
                    <select class="form-control" disabled="disabled" v-model="auxiliarSupervisorAntigo">
                        <option>{{ post.supervisor }}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Novo Supervisor</label>
                    <select class="form-control" v-model="auxiliarSupervisorNovo">
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
                <input type="text" class="form-control" disabled="disabled" v-model="supervisorAlteracao.estagiario">
            </div>
        </div>

        <div class="row mt-2 d-flex justify-content-end">
            <div class="form-group">
                <button type="submit" @click="salvarAlteracaoSupervisor" class="btn btn-primary mr-3 mt-2">Salvar</button>
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
            supervisorAlteracao: {
                estagiario: this.post.cod_estudante
            },
            msg: {
                error: false,
                success: false,
                successEstagiario: false,
                errorEstagiario: false
            },
            auxiliarSupervisorAntigo: this.post.supervisor,
            auxiliarSupervisorNovo: ''
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
        rfSupervisorAntigo() {
            for(let i in this.supervisores) {
                if(this.supervisores[i].nome.toUpperCase() == this.auxiliarSupervisorAntigo.toUpperCase()) {
                    this.supervisorAlteracao.supervisor_antigo = this.supervisores[i].rf
                }
            }
        },
        rfSupervisorNovo() {
            for(let i in this.supervisores) {
                if(this.supervisores[i].nome.toUpperCase() == this.auxiliarSupervisorNovo.toUpperCase()) {
                    this.supervisorAlteracao.supervisor_novo = this.supervisores[i].rf
                }
            }
        },
        atualizaSupervisorEstagiario() { // Atualiza o supervisor na tabela de estagiarios
            const uriEstagiarios = `/api/estagiarios/${this.post.cpf}`
            this.post.supervisor = this.auxiliarSupervisorNovo;
            this.post.houve_alteracao_supervisor = 1;

            this.axios.patch(uriEstagiarios, this.post).then(response => {
                this.msg.errorEstagiario = false;
                this.msg.successEstagiario = true;
                this.msg.sucessoEstagiario = 'Supervisor alterado no cadastro do estagiário';

                this.supervisorAlteracao = {}
                this.auxiliarSupervisorAntigo = ''
                this.auxiliarSupervisorNovo = ''
            })
            .catch(error => {
                this.msg.successEstagiario = false
                this.msg.errorEstagiario = true;
                this.msg.erroEstagiario = 'Erro ao alterar supervisor no cadastro do estagiário';
            })
        },
        converteDatas() {
        if(this.post.horario_entrada) {
            this.post.horario_entrada = this.post.horario_entrada.length == 8 ? `1899-12-30 ${this.post.horario_entrada}` : this.post.horario_entrada;
        }
        if(this.post.horario_saida) {
            this.post.horario_saida = this.post.horario_saida.length == 8 ? `1899-12-30 ${this.post.horario_saida}` : this.post.horario_saida;
        }
        if(this.post.dt_inicio) {
            this.post.dt_inicio == `${this.post.dt_inicio.substr(0,10)} 00:00:00` ? this.post.dt_inicio  : this.post.dt_inicio += ' 00:00:00';
        }
        if(this.post.dt_termino) {
            this.post.dt_termino == `${this.post.dt_termino.substr(0,10)} 00:00:00` ? this.post.dt_termino : this.post.dt_termino += ' 00:00:00';
        }
        if(this.post.dt_termino) {
            this.post.dt_termino_inicial_lauda = this.post.dt_termino;
        }
        if(this.post.dt_inicial_1) {
            this.post.dt_inicial_1 == `${this.post.dt_inicial_1.substr(0,10)} 00:00:00` ? this.post.dt_inicial_1 : this.post.dt_inicial_1 += ' 00:00:00';
        }

        if(this.post.dt_inicial_2) {
            this.post.dt_inicial_2 == `${this.post.dt_inicial_2.substr(0,10)} 00:00:00` ? this.post.dt_inicial_2 : this.post.dt_inicial_2 += ' 00:00:00';
        }

        if(this.post.dt_inicial_3) {
            this.post.dt_inicial_3 == `${this.post.dt_inicial_3.substr(0,10)} 00:00:00` ? this.post.dt_inicial_3 : this.post.dt_inicial_3 += ' 00:00:00';
        }

        if(this.post.dt_inicial_4) {
            this.post.dt_inicial_4 == `${this.post.dt_inicial_4.substr(0,10)} 00:00:00` ? this.post.dt_inicial_4 : this.post.dt_inicial_4 += ' 00:00:00';
        }

        if(this.post.dt_inicial_5) {
            this.post.dt_inicial_5 == `${this.post.dt_inicial_5.substr(0,10)} 00:00:00` ? this.post.dt_inicial_5 : this.post.dt_inicial_5 += ' 00:00:00';
        }

        if(this.post.dt_inicial_6) {
            this.post.dt_inicial_6 == `${this.post.dt_inicial_6.substr(0,10)} 00:00:00` ? this.post.dt_inicial_6 : this.post.dt_inicial_6 += ' 00:00:00';
        }

        if(this.post.dt_inicial_7) {
            this.post.dt_inicial_7 == `${this.post.dt_inicial_7.substr(0,10)} 00:00:00` ? this.post.dt_inicial_7 : this.post.dt_inicial_7 += ' 00:00:00';
        }

        if(this.post.dt_inicio_1_aditivo) {
            this.post.dt_inicio_1_aditivo == `${this.post.dt_inicio_1_aditivo.substr(0,10)} 00:00:00` ? this.post.dt_inicio_1_aditivo : this.post.dt_inicio_1_aditivo += ' 00:00:00';
        }

        if(this.post.dt_inicio_2_aditivo) {
            this.post.dt_inicio_2_aditivo == `${this.post.dt_inicio_2_aditivo.substr(0,10)} 00:00:00` ? this.post.dt_inicio_2_aditivo : this.post.dt_inicio_2_aditivo += ' 00:00:00';
        }

        if(this.post.dt_termino_1_aditivo) {
            this.post.dt_termino_1_aditivo == `${this.post.dt_termino_1_aditivo.substr(0,10)} 00:00:00` ? this.post.dt_termino_1_aditivo : this.post.dt_termino_1_aditivo += ' 00:00:00';
        }

        if(this.post.dt_termino_2_aditivo) {
            this.post.dt_termino_2_aditivo == `${this.post.dt_termino_2_aditivo.substr(0,10)} 00:00:00` ? this.post.dt_termino_2_aditivo : this.post.dt_termino_2_aditivo += ' 00:00:00';
        }

        if(this.post.dt_termino_1) {
            this.post.dt_termino_1 == `${this.post.dt_termino_1.substr(0,10)} 00:00:00` ? this.post.dt_termino_1 : this.post.dt_termino_1 += ' 00:00:00';
        }

        if(this.post.dt_termino_2) {
            this.post.dt_termino_2 == `${this.post.dt_termino_2.substr(0,10)} 00:00:00` ? this.post.dt_termino_2 : this.post.dt_termino_2 += ' 00:00:00';
        }

        if(this.post.dt_termino_3) {
            this.post.dt_termino_3 == `${this.post.dt_termino_3.substr(0,10)} 00:00:00` ? this.post.dt_termino_3 : this.post.dt_termino_3 += ' 00:00:00';
        }

        if(this.post.dt_termino_4) {
            this.post.dt_termino_4 == `${this.post.dt_termino_4.substr(0,10)} 00:00:00` ? this.post.dt_termino_4 : this.post.dt_termino_4 += ' 00:00:00';
        }

        if(this.post.dt_termino_5) {
            this.post.dt_termino_5 == `${this.post.dt_termino_5.substr(0,10)} 00:00:00` ? this.post.dt_termino_5 : this.post.dt_termino_5 += ' 00:00:00';
        }

        if(this.post.dt_termino_6) {
            this.post.dt_termino_6 == `${this.post.dt_termino_6.substr(0,10)} 00:00:00` ? this.post.dt_termino_6 : this.post.dt_termino_6 += ' 00:00:00';
        }

        if(this.post.dt_termino_7) {
            this.post.dt_termino_7 == `${this.post.dt_termino_7.substr(0,10)} 00:00:00` ? this.post.dt_termino_7 : this.post.dt_termino_7 += ' 00:00:00';
        }

        if(this.post.data_nascimento) {
            this.post.data_nascimento == `${this.post.data_nascimento.substr(0,10)} 00:00:00` ? this.post.data_nascimento : this.post.data_nascimento += ' 00:00:00';
        }

        if(this.post.desligado) {
            this.post.desligado == `${this.post.desligado.substr(0,10)} 00:00:00` ? this.post.desligado : this.post.desligado += ' 00:00:00';
        }

        this.atualizaSupervisorEstagiario()
        },
        salvarAlteracaoSupervisor() { // Registra a alteração na tabela de supervisor_alteracao
            this.rfSupervisorAntigo();
            this.rfSupervisorNovo();

            const uriSupervisorAlteracao = '/api/supervisor_alteracao'

            this.axios
            .post(uriSupervisorAlteracao, this.supervisorAlteracao).then(response => {
                this.converteDatas();
                this.msg.sucesso = 'Supervisor cadastrado no histórico de alterações';
                this.msg.success = true;
            })
            .catch(error => {
                this.msg.success = false;
                this.msg.error = true;
                this.msg.erro = 'Erro ao cadastrar supervisor no histórico de alterações';
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

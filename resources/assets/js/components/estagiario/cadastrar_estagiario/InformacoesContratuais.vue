<template>
    <form @submit.prevent="inserirEstagiario" method="post">

        <div class="row">
            <div class="col-md-3">

                <div class="row"> 
                   <div class="col-md-10">
                        <div class="form-group">
                            <label for="selectVaga">Codigo Vaga</label>
                            <select type="text" 
                                @change="selectVaga"
                                @click="carregaVaga"
                                @blur="validaVaga"
                                :class="{'is-invalid': vagaValida}" 
                                class="form-control" 
                                id="selectVaga" 
                                v-model="post.cod_vaga" 
                                >
                                <option></option>
                                <option v-for="vaga of vagasLivres">{{ vaga.id }}</option>
                            </select>
                            <div v-if="vagaValida" class="invalid-feedback">
                                Vaga não pode ser vazia
                            </div>
                        </div>
                    </div>
                    <div class="form-group d-flex flex-column align-items-baseline justify-content-end">
                        <img class="cadastraVaga" @click="abreModalVaga" src="../../../../../../public/icones/icons8-adicionar-regra-48.png" alt="Adicionar Vaga">
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
            <div class="form-group">
                <label for="inputSituacao">Situação</label>
                <select id="inputSituacao" @blur="validaSituacao" :class="{'is-invalid':situacaoValida}" class="form-control" v-model="post.situacao" required>
                    <option value="1">CONTRATADO</option>
                    <option value="5">DESLIGADO</option>
                    <option value="2">EM CONTRATAÇÃO</option>
                    <option value="3">EM DESLIGAMENTO</option>
                    <option value="4">EM RENOVAÇÃO</option>
                    <!-- <option value="6">TCE CANCELADO</option> -->
                </select>
                <div class="invalid-feedback">
                    Situação não pode ser vazia
                </div>
            </div>
        </div>

         <div class="col-md-3" style="margin-left: -12px">
                <div class="form-group">
                    <label for="inputContrato">Contrato CIEE</label>
                    <input type="text" 
                        maxlength="20"
                        class="form-control" 
                        id="inputContrato" 
                        v-model="post.contrato" >
                </div>
            </div>
            <div class="col-md-3">
            <div class="setor-estag">
                <label for="selectSetor">Setor Estagiado</label>
                <select class="form-control" @blur="validaSetor" :class="{'is-invalid':setorValido}" id="selectSetor" 
                v-model="post.setor_estagiado" required>
                    <option></option>
                    <!-- <option v-for="departamento of departamentosOrdenados" 
                        v-if="departamento.tipo == 'FILHO'">{{ departamento.sigla }}</option> -->
                        <option v-for="departamento of departamentosOrdenados" v-if="departamento.tipo == 'FILHO' || departamento.tipo == 'OUTROS' || departamento.tipo == 'PAI'">{{ departamento.sigla }}</option>
                        <!-- <option v-for="setor in depSetores">{{ setor }}</option> -->
                </select>
                <div class="invalid-feedback">
                    Setor não pode ser vazio
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-11">

            <div class="row">
                <div class="col-md-11">
                    <div class="form-group">
                        <label for="inputSupervisor">Supervisor</label>
                        <select class="form-control" @blur="validaSupervisor" @click="carregaSupervisor" :class="{'is-invalid':supervisorValido}" id="inputSupervisor" v-model="post.supervisor" required>
                            <option></option>
                            <option v-for="supervisor in supervisoresOrdenados">{{ supervisor.nome.toUpperCase() }}</option>
                        </select>
                        <div class="invalid-feedback">
                            Supervisor não pode ser vazio
                        </div>
                    </div>
                </div>

                <div class="form-group d-flex flex-column align-items-baseline justify-content-end">
                    <img class="cadastraSupervisor" @click="abreModalSupervisor" src="../../../../../../public/icones/icons8-adicionar-usuario-masculino-30.png" alt="Adicionar Supervisor">
                </div>
            </div>
            
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="inputInicio">Data Início do Estágio</label>
                    <input type="date" class="form-control" id="inputInicio" v-model="post.dt_inicio" required>

            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="inputTermino">Data Término do Contrato</label>
                    <input type="date" class="form-control" id="inputTermino" v-model="post.dt_termino" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputHorarioEntrada">Entrada do Estagiário</label>
                <input type="time" @blur="validaHorarioEntrada" :class="{'is-invalid':horarioEntradaValido}" class="form-control" id="inputHorarioEntrada" v-model="post.horario_entrada">
                <div class="invalid-feedback">
                    Horário de entrada não pode ser vazio
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputHorarioSaida">Saída do Estagiário</label>
                <input type="time" @blur="validaHorarioSaida" :class="{'is-invalid':horarioSaidaValido}" class="form-control" id="inputHorarioSaida" v-model="post.horario_saida">
                <div class="invalid-feedback">
                    Horário de saída não pode ser vazio
                </div>
            </div>
        </div>
        <div class="col-md-3 d-flex flex-column justify-content-center">
            <div class="form-group">
                <span>Horário variável</span><br>
                <input type="checkbox" v-model="post.horario_variavel">
                <div class="invalid-feedback">
                    Data de término não pode ser vazio
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="inputObs">Observações</label>
                <textarea cols="30" rows="4" class="form-control" id="inputObs" v-model="post.observacao2"></textarea>
            </div>
        </div>
    </div>
    <!-- <botoes-component :titulo="nomeBotao = 'Cadastrar'"></botoes-component> -->



    <!-- botão de teste -->
    <div>
    <hr>
    <div class="form-group">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-end">
                <slot>
                </slot> <!-- Para poder implementar botões adicionais onde o componente for importado -->
                <button type="submit" class="btn btn-primary ml-2">
                    Cadastrar
                </button>
            </div>
        </div>
    </div>
</div>

</form>
</template>
<script>
export default {
    data () {
        return {
            vagasLivres: [],
            msg: {
                error: false,
                success: false
            },
            depSetores: []
        }
    },
    beforeMount () {
        
        const uriVagas = '/api/vagas';

        this.axios.get(uriVagas).then(response => {
            this.msg.error = false;
            var vagasRetornadas = response.data;

            for (var i in vagasRetornadas) {
                if(vagasRetornadas[i].status.length === 5){
                    this.vagasLivres.push(vagasRetornadas[i]);
                }
            }
        })
        .catch(error => {
            this.msg.error = true;
            this.msg.erro = 'Erro ao retornar vagas do banco de dados';
        })
    },
    methods: {
        atualizaStatusVaga: function(e) {            
            if(this.post.situacao == '5') {
                return;
            }
            this.vagaAtualizada = {};
            

            for(let i in this.vagas){
                if(this.vagas[i].id == this.post.cod_vaga){
                    this.vagaAtualizada = this.vagas[i];
                }
            }
            
            this.vagaAtualizada.status = "OCUPADA";
        },
        atualizaSetor: function () {
            this.depSetores = [];
            var nomeDepartamento = '';
            // console.log(this.departamentos);
            for (var dep in this.departamentos) {
                if (this.departamentos[dep].sigla === this.post.dep_hierarquico) {
                    nomeDepartamento = this.departamentos[dep].departamentos;
                    break;
                }
            }

            for (var i in this.departamentos) {
                if (this.departamentos[i].departamentos === nomeDepartamento) {
                    this.depSetores.push(this.departamentos[i].sigla)
                }
            }
            // console.log(this.depSetores) 
        }
    },
    props: [
        'post', 
        'departamentos', 
        'supervisores', 
        'inserirEstagiario', 
        'alteracaoSupervisor', 
        'horarioVariavel',
        'dataModificacao',
        'horaModificacao',
        'vagas',
        'validaVaga',
        'vagaValida',
        'selectVaga',
        'statusVaga',
        'validaDepartamento', 'departamentoValido',
        'validaSetor', 'setorValido',
        'validaSupervisor', 'supervisorValido',
        'validaHorarioEntrada', 'horarioEntradaValido',
        'validaHorarioSaida', 'horarioSaidaValido',
        'validaSituacao', 'situacaoValida',
        'abreModalSupervisor', 'carregaSupervisor',
        'abreModalVaga', 'carregaVaga',
        'supervisoresOrdenados', 'vagasOrdenadas',
        'departamentosOrdenados'
    ]
}
</script>
<style>
.cadastraSupervisor {
    cursor: pointer;
}
.cadastraVaga {
    cursor: pointer;
    width: 30px;
    height: 30px;
}
</style>

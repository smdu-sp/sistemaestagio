<template>
    <form @submit.prevent="inserirEstagiario" method="post">

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="selectVaga">Codigo Vaga</label>
                    <select type="text" 
                        @change="selectVaga"
                        @blur="validaVaga"
                        :class="{'is-invalid': vagaValida}" 
                        class="form-control" 
                        id="selectVaga" 
                        v-model="post.cod_vaga" 
                        >
                        <option></option>
                        <option v-for="vaga of vagas">{{ vaga.id }}</option>
                    </select>
                    <div v-if="vagaValida" class="invalid-feedback">
                        Vaga não pode ser vazia
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="selectStatus">Status Vaga</label>
                    <select type="text" id="selectStatus" class="form-control" v-model="statusVaga.status">
                        <option default>{{ statusVaga.status }}</option>
                        <option v-if="statusVaga.status != 'OCUPADA'">OCUPADA</option>
                        <option v-if="statusVaga.status != 'EM SELEÇÃO'">EM SELEÇÃO</option>
                        <option v-if="statusVaga.status != 'LIVRE'">LIVRE</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
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
                <div class="form-group">
                    <label for="inputTceSuperEstagios">TCE Super Estágios</label>
                    <input type="text" 
                        maxlength="11" 
                        class="form-control" 
                        id="inputTceSuperEstagios" 
                        v-model="post.tc_superestagios">
                </div>
            </div>
        </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="selectDepartamento">Dep. Hierárquico</label>
                <select class="form-control" @blur="validaDepartamento" :class="{'is-invalid':departamentoValido}" id="selectDepartamento" v-model="post.dep_hierarquico" required>
                    <option></option>
                    <option v-for="departamento of departamentos" v-if="departamento.tipo == 'PAI'">{{ departamento.sigla }}</option>
                </select>
                <div class="invalid-feedback">
                    Departamento não pode ficar em branco
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="setor-estag">
                <label for="selectSetor">Setor Estagiado</label>
                <select class="form-control" @blur="validaSetor" :class="{'is-invalid':setorValido}" id="selectSetor" v-model="post.setor_estagiado" required>
                    <option></option>
                    <option v-for="departamento of departamentos" v-if="departamento.tipo == 'FILHO'">{{ departamento.sigla }}</option>
                </select>
                <div class="invalid-feedback">
                    Setor não pode ser vazio
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="inputSupervisor">Supervisor</label>
                <select class="form-control" @blur="validaSupervisor" :class="{'is-invalid':supervisorValido}" id="inputSupervisor" v-model="post.supervisor" required>
                    <option></option>
                    <option v-for="supervisor of supervisores">{{ supervisor.nome }}</option>
                </select>
                <div class="invalid-feedback">
                    Supervisor não pode ser vazio
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputInicio">Data Início</label>
                    <input type="date" class="form-control" id="inputInicio" v-model="post.dt_inicio" required>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputTermino">Data Término</label>
                    <input type="date" class="form-control" id="inputTermino" v-model="post.dt_termino" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputHorarioEntrada">Horário de Entrada</label>
                <input type="time" @blur="validaHorarioEntrada" :class="{'is-invalid':horarioEntradaValido}" class="form-control" id="inputHorarioEntrada" v-model="post.horario_entrada">
                <div class="invalid-feedback">
                    Horário de entrada não pode ser vazio
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputHorarioSaida">Horário de Saída</label>
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
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputSituacao">Situação</label>
                <select id="inputSituacao" @blur="validaSituacao" :class="{'is-invalid':situacaoValida}" class="form-control" v-model="post.situacao" required>
                    <option value="1">CONTRATADO</option>
                    <option value="5">DESLIGADO</option>
                    <option value="2">EM CONTRATAÇÃO</option>
                    <option value="3">EM DESLIGAMENTO</option>
                    <option value="4">EM RENOVAÇÃO</option>
                    <option value="6">TCE CANCELADO</option>
                </select>
                <div class="invalid-feedback">
                    Situação não pode ser vazia
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
    <botoes-component :titulo="nomeBotao = 'Cadastrar'">
        <a class="btn btn-success" href="mailto:condmart@terra.com.br?cc=vaulicino@prefeitura.sp.gov.br;kesiaavelino@prefeitura.sp.gov.br&amp;subject=Solicita%C3%A7%C3%A3o%20de%20cart%C3%A3o%20de%20acesso&amp;body=Nome%3A%20%0ARg%3A%20%0AData%20de%20In%C3%ADcio%3A%20">Solicitar cartão de acesso</a>
    </botoes-component>
</form>

</template>
<script>
export default {

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
        'validaSituacao', 'situacaoValida'
    ]

}
</script>
<style>

</style>

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
                <select class="form-control" id="selectDepartamento" v-model="post.dep_hierarquico" required>
                    <option></option>
                    <option v-for="departamento of departamentos" v-if="departamento.tipo == 'PAI'">{{ departamento.sigla }}</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="setor-estag">
                <label for="selectSetor">Setor Estagiado</label>
                <select class="form-control" id="selectSetor" v-model="post.setor_estagiado" required>
                    <option></option>
                    <option v-for="departamento of departamentos" v-if="departamento.tipo == 'FILHO'">{{ departamento.sigla }}</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="inputSupervisor">Supervisor</label>
                <select class="form-control" id="inputSupervisor" v-model="post.supervisor" required>
                    <option></option>
                    <option v-for="supervisor of supervisores">{{ supervisor.nome }}</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="inputInicio">Data Início</label>
                    <input type="date" class="form-control" id="inputInicio" v-model="post.dt_inicio" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="inputTermino">Data Término</label>
                    <input type="date" class="form-control" id="inputTermino" v-model="post.dt_termino" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="inputTerminoInicial">Data Término Inicial</label>
                    <input type="date" class="form-control" id="inputTerminoInicial" v-model="post.dt_termino_inicial_lauda">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="inputHorarioEntrada">Horário de Entrada</label>
                <input type="time" class="form-control" id="inputHorarioEntrada" v-model="post.horario_entrada">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="inputHorarioSaida">Horário de Saída</label>
                <input type="time" class="form-control" id="inputHorarioSaida" v-model="post.horario_saida">
            </div>
        </div>
        <div class="col-md-4 d-flex flex-column justify-content-center">
            <div class="form-group">
                <input type="checkbox" v-model="post.horario_variavel">Horário variável
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="inputSituacao">Situação</label>
                <select id="inputSituacao" class="form-control" v-model="post.situacao" required>
                    <option>CONTRATADO</option>
                    <option>DESLIGADO</option>
                    <option>EM CONTRATAÇÃO</option>
                    <option>EM DESLIGAMENTO</option>
                    <option>EM RENOVAÇÃO</option>
                    <option>TCE CANCELADO</option>
                </select>
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
    <botoes-component></botoes-component>
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
        'statusVaga'
    ]

}
</script>
<style>

</style>

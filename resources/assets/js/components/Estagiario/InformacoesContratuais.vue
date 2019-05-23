<template>
    <form @submit.prevent="inserirEstagiario">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="dep_hier">Dep. Hierárquico</label>
                    <select class="form-control" id="dep_hier">
                        <option></option>
                        <option v-for="departamento of departamentos" v-model="post.dep_hierarquico">{{ departamento }}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="setor-estag">
                    <label for="set_estag">Setor Estagiado</label>
                    <select class="form-control" id="setor_estag">
                        <option></option>
                        <option v-model="post.setor_estagiado"></option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="inputSupervisor">Supervisor</label>
                    <select class="form-control" id="inputSupervisor">
                        <option></option>
                        <option v-for="supervisor of supervisores" v-model="post.supervisor">{{ supervisor.nome }}</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="inputInicio">Data Início</label>
                        <input type="date" class="form-control" id="inputInicio" v-model="post.dt_inicio">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="inputTermino">Data Término</label>
                        <input type="date" class="form-control" id="inputTermino" v-model="post.dt_termino">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="inputTermino">Data Término Inicial</label>
                        <input type="date" class="form-control" id="inputTermino" v-model="post.dt_termino_inicial_lauda">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Horário de Entrada</label>
                    <input type="text" class="form-control" v-model="horario_entrada">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Horário de Saída</label>
                    <input type="text" class="form-control" v-model="horario_saida">
                </div>
            </div>
            <div class="col-md-4 d-flex flex-column justify-content-center">
                <div class="form-group">
                    <input type="checkbox" v-model="horario_variavel">Horário variável
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="situacaoid">Situação</label>
                    <select id="situacaoid" class="form-control" v-model="post.situacao">
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
                    <label for="obs">Observações</label>
                    <textarea id="obs" cols="30" rows="4" class="form-control" v-model="post.situacao"></textarea>
                </div>
            </div>
        </div>
    </form>
</template>
<script>
export default {

    props: ['post', 'departamentos', 'supervisores']

}
</script>
<style>

</style>

<template>
    <form @submit.prevent="inserirEstagiario" method="patch">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Qtd dias legais</label>
                    <input type="number" class="form-control" v-model="post.qt_dias_legais">
                </div>
            </div>
            <div class="col-md-3 ml-2">
                <div class="form-group">
                    <label for="">Qtd dias Gozados</label>
                    <input type="number" class="form-control" v-model="post.qt_dias_gozados" >
                </div>
            </div>
            <div class="col-md-3 ml-2">
                <div class="form-group">
                    <label for="">Qtd dias Restantes</label>
                    <input type="number" class="form-control" v-model="post.qt_dias_restantes" >
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">1. Qtd dias Solicitado</label>
                    <input type="number" class="form-control" v-model="post.qt_dias_solicitada_1">
                </div>
            </div>
            <div class="col-md-3 ml-2">
                <div class="form-group">
                    <label for="">1. Data Inicial</label>
                    <input type="date" class="form-control" v-model="post.dt_inicial_1">
                </div>
            </div>
            <div class="col-md-3 ml-2">
                <div class="form-group">
                    <label for="">1. Data de Término</label>
                    <input type="date" class="form-control" v-model="post.dt_termino_1">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">2. Qtd dias Solicitado</label>
                    <input type="number" class="form-control" v-model="post.qt_dias_solicitada_2">
                </div>
            </div>
            <div class="col-md-3 ml-2">
                <div class="form-group">
                    <label for="">2. Data Inicial</label>
                    <input type="date" class="form-control" v-model="post.dt_inicial_2" >
                </div>
            </div>
            <div class="col-md-3 ml-2">
                <div class="form-group">
                    <label for="">2. Data de Término</label>
                    <input type="date" class="form-control" v-model="post.dt_termino_2" >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">3. Qtd dias Solicitado</label>
                    <input type="number" class="form-control" v-model="post.qt_dias_solicitada_3">
                </div>
            </div>
            <div class="col-md-3 ml-2">
                <div class="form-group">
                    <label for="">3. Data Inicial</label>
                    <input type="date" class="form-control" v-model="post.dt_inicial_3" >
                </div>
            </div>
            <div class="col-md-3 ml-2">
                <div class="form-group">
                    <label for="">3. Data de Término</label>
                    <input type="date" class="form-control" v-model="post.dt_termino_3" >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">4. Qtd dias Solicitado</label>
                    <input type="number" class="form-control" v-model="post.qt_dias_solicitada_4">
                </div>
            </div>
            <div class="col-md-3 ml-2">
                <div class="form-group">
                    <label for="">4. Data Inicial</label>
                    <input type="date" class="form-control" v-model="post.dt_termino_4" >
                </div>
            </div>
            <div class="col-md-3 ml-2">
                <div class="form-group">
                    <label for="">4. Data de Término</label>
                    <input type="date" class="form-control" v-model="post.dt_inicial_4" >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">5. Qtd dias Solicitado</label>
                    <input type="number" class="form-control" v-model="post.qt_dias_solicitada_5">
                </div>
            </div>
            <div class="col-md-3 ml-2">
                <div class="form-group">
                    <label for="">5. Data Inicial</label>
                    <input type="date" class="form-control" v-model="post.dt_inicial_5" >
                </div>
            </div>
            <div class="col-md-3 ml-2">
                <div class="form-group">
                    <label for="">5. Data de Término</label>
                    <input type="date" class="form-control" v-model="post.dt_termino_5" >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">6. Qtd dias Solicitado</label>
                    <input type="number" class="form-control" v-model="post.qt_dias_solicitada_6">
                </div>
            </div>
            <div class="col-md-3 ml-2">
                <div class="form-group">
                    <label for="">6. Data Inicial</label>
                    <input type="date" class="form-control" v-model="post.dt_inicial_6" >
                </div>
            </div>
            <div class="col-md-3 ml-2">
                <div class="form-group">
                    <label for="">6. Data de Término</label>
                    <input type="date" class="form-control" v-model="post.dt_termino_6" >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">7. Qtd dias Solicitado</label>
                    <input type="number" class="form-control" v-model="post.qt_dias_solicitada_7">
                </div>
            </div>
            <div class="col-md-3 ml-2">
                <div class="form-group">
                    <label for="">7. Data Inicial</label>
                    <input type="date" class="form-control" v-model="post.dt_inicial_7" >
                </div>
            </div>
            <div class="col-md-3 ml-2">
                <div class="form-group">
                    <label for="">7. Data de Término</label>
                    <input type="date" class="form-control" v-model="post.dt_termino_7 ">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="textareaObservacoes3">Observações</label>
                    <textarea id="textareaObservacoes3" cols="30" rows="5" class="form-control" v-model="post.observacoes3"></textarea>
                </div>
            </div>
        </div>
        <botoes-component :titulo="nomeBotao = 'Salvar'"></botoes-component>
    </form>
</template>

<script>
export default {
    props: ['post', 'inserirEstagiario']
}
</script>

<style>

</style>

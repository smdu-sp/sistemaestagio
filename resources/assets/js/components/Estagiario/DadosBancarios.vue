<template>
    <form @submit.prevent="inserirEstagiario, alteracaoSupervisor, horarioVariavel, dataModificacao, horaModificacao" method="post">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="selectBanco">Instituição Bancária</label>
                        </div>
                        <div class="col-md-8">
                            <select class="form-control" id="selectBanco" v-model="post.instituicao_bancaria" required>
                                <option></option>
                                <option>BANCO DO BRASIL</option>
                                <option>BRADESCO</option>
                                <option>ITAU</option>
                                <option>SANTANDER</option>
                            </select>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="inputAgencia">Agência</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control" id="inputAgencia" v-model="post.agencia" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="inputConta">Conta</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control" id="inputConta" v-model="post.conta" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="inputOperacao">Operação</label>
                        </div>
                        <div class="col-md-8">
                            <select class="form-control" v-model="post.operacao" id="inputOperacao">
                                <option>CORRENTE</option>
                                <option>POUPANÇA</option>
                            </select>
                        </div>
                    </div>
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
        'inserirEstagiario', 
        'alteracaoSupervisor', 
        'horarioVariavel',
        'dataModificacao',
        'horaModificacao'
        ]
}
</script>
<style>

</style>
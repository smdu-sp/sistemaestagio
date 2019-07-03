<template>
    <form @submit.prevent="inserirEstagiario" method="post">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="selectBanco">Instituição Bancária</label>
                        </div>
                        <div class="col-md-8">
                            <select class="form-control" id="selectBanco" v-model="post.instituicao_bancaria">
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
                            <input type="number" class="form-control" id="inputAgencia" v-model="post.agencia">
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
                            <input type="tel" class="form-control" id="inputConta" v-model="post.conta">
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
        <botoes-component :titulo="nomeBotao = 'Cadastrar'">
            <a class="btn btn-success" href="mailto:condmart@terra.com.br?cc=vaulicino@prefeitura.sp.gov.br;kesiaavelino@prefeitura.sp.gov.br&amp;subject=Solicita%C3%A7%C3%A3o%20de%20cart%C3%A3o%20de%20acesso&amp;body=Nome%3A%20%0ARg%3A%20%0AData%20de%20In%C3%ADcio%3A%20">Solicitar cartão de acesso</a>
        </botoes-component>
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
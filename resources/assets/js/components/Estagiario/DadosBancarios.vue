<template>
    <form @submit.prevent="inserirEstagiario">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Instituição Bancária</label>
                        </div>
                        <div class="col-md-8">
                            <select class="form-control" v-model="post.instituicao_bancaria">
                                <option></option>
                                <option>BANCO DO BRASIL</option>
                                <option>BRADESCO</option>
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
                            <label for="">Agência</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control" v-model="post.agencia">
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
                            <label for="">Conta</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control" v-model="post.conta">
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
                            <label for="">Operação</label>
                        </div>
                        <div class="col-md-8">
                            <select class="form-control" v-model="post.operacao">
                                <option>CORRENTE</option>
                                <option>POUPANÇA</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</template>
<script>
export default {
    props: ['post']
}
</script>
<style>

</style>
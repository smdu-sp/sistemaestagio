<template>
    <div class="largura">
        <form action="http://sgu.smdu.pmsp/pdfestagio.php" method="GET" target="iframe">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="selectDepartamento">Dep. Hierárquico</label>
                        <select class="form-control" id="selectDepartamento" name="unid">
                            <option v-for="departamento of departamentos" :key="departamento.sigla">{{ departamento.sigla }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Mês</label>
                        <input type="number" class="form-control" name="mes" placeholder="ex: 07" v-model="mes">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Ano</label>
                        <input type="number" class="form-control" name="ano" placeholder="ex: 2019" v-model="ano">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label>Nome</label>
                <br>
                <input type="text" class="form-control" style="width: 30em" name="nome" placeholder="ex: João da Silva"/>

            </div>

            <div class="row">
                <div class="col-md-3 d-flex flex-column">
                    <button class="btn btn-success" @click="gerarRelatorio">Gerar</button>
                </div>
            </div>
        </form>
        <div v-if="relatorio" class="row mt-2 divIframe">
            <div class="col-md-12">
                <iframe name="iframe" class="iframe" width="100%" height="100%" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                departamentos: [],
                mes: new Date().getMonth()+1,
                ano: new Date().getFullYear(),
                relatorio: false
            }
        },
        beforeMount() {
            this.retornaDepartamentos();
        },
        methods: {
            gerarRelatorio() {
                this.relatorio = true;
            },
            retornaDepartamentos() {
                const uriDepartamentos = '/api/departamentos';

                this.axios.get(uriDepartamentos).then(response => {
                    this.departamentos = response.data;
                }).catch(error => console.log(error))
            }
        }
    }
</script>

<style>
.largura {
    width: 98%;
}
.divIframe {
    height: 500px;
}
.iframe {
    border: 1px solid #ccc;
    border-radius: 5px;
}
</style>

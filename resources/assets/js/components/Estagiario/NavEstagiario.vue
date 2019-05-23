<template>
    <div class="container">
        <div class="row">
            <div class="col-3">
                <aside-component></aside-component>
            </div>
            <div class="col-9">
                <header-component></header-component>
                <h1 class="d-flex justify-content-center">Cadastro de Estagiário</h1>
            
            <div>
            <b-card no-body>
                <b-tabs card>
                    <b-tab title="Dados Pessoais" active>
                        <b-card-text>
                                <dados-pessoais 
                                :post="post" 
                                :cartoes="cartoes"
                                :estados="estados"
                                :instituicoes="instituicoes"
                                :cursos="cursos" />
                        </b-card-text>
                    </b-tab>
                    <b-tab title="Informações Contratuais">
                        <b-card-text>
                            <informacoes-contratuais
                            :post="post"
                            :departamentos="departamentos"
                            :supervisores="supervisores" />
                        </b-card-text>
                    </b-tab>
                    <b-tab title="Dados Bancários">
                        <b-card-text>
                            <dados-bancarios 
                            :post="post"/>
                        </b-card-text>
                    </b-tab>
                    <hr>
                    <botoes-component></botoes-component>
                </b-tabs>
            </b-card>
            </div>
            
            </div>
        </div><!-- /row -->
    </div>
</template>
<script>
export default {
    data() {
        return {
            post: {},
            cartoes: {},
            estados: {},
            instituicoes: {},
            cursos: {},
            departamentos: {},
            supervisores: {}
        }
    },
    created() {
        let uriCartoes = 'http://localhost:8000/api/cartao';
        let uriEstados = 'http://localhost:8000/api/estados';
        let uriInstituicoes = 'http://localhost:8000/api/instituicao';
        let uriCursos = 'http://localhost:8000/api/cursos';
        let uriDepartamentos = 'http://localhost:8000/api/departamentos';
        let uriSupervisores = 'http://localhost:8000/api/supervisores'; 

        this.axios.get(uriCartoes).then(response => this.cartoes = response.data);
        this.axios.get(uriEstados).then(response => this.estados = response.data);
        this.axios.get(uriInstituicoes).then(response => this.instituicoes = response.data);        
        this.axios.get(uriCursos).then(response => this.cursos = response.data);
        this.axios.get(uriDepartamentos).then(response => this.departamentos = response.data);
        this.axios.get(uriSupervisores).then(response => this.supervisores = response.data);
      
    },
}
</script>
<style>
.col-3 {
    height: 100vh;
}
</style>
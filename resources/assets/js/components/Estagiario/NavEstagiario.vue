<template>
    <div class="container">
        <!--row-->
        <div class="row">
            <div class="col-3">
                <aside-component></aside-component>
            </div>
            <!--col-9-->
            <div class="col-9">
                <header-component></header-component>
                <h1 class="d-flex justify-content-center">Cadastro de Estagiário</h1>
                <!-- Formulários -->
                <b-card no-body>
                    <b-tabs card>
                        <b-tab title="Dados Pessoais">
                            <b-card-text>
                                <dados-pessoais
                                :post="post"
                                :vagas="vagas"
                                :statusVaga="statusVaga"
                                :selectVaga="selectVaga"
                                :cartoes="cartoes"
                                :estados="estados"
                                :instituicoes="instituicoes"
                                :cursos="cursos"
                                :inserirEstagiario="inserirEstagiario"
                                :alteracaoSupervisor="alteracaoSupervisor"
                                :horarioVariavel="horarioVariavel"
                                />
                            </b-card-text>
                        </b-tab>
                        <b-tab title="Informações Contratuais">
                            <b-card-text>
                                <informacoes-contratuais
                                :post="post"
                                :departamentos="departamentos"
                                :supervisores="supervisores"
                                :inserirEstagiario="inserirEstagiario"
                                :alteracaoSupervisor="alteracaoSupervisor"
                                :horarioVariavel="horarioVariavel"
                                />
                            </b-card-text>
                        </b-tab>
                        <b-tab title="Dados Bancários" active>
                            <b-card-text>
                                <dados-bancarios 
                                :post="post"
                                :inserirEstagiario="inserirEstagiario"
                                :alteracaoSupervisor="alteracaoSupervisor"
                                :horarioVariavel="horarioVariavel"
                                />
                            </b-card-text>
                        </b-tab>
                    </b-tabs>
                </b-card>
                <!-- /Formulários -->
            </div><!--/col-9-->
        </div><!-- /row -->
    </div><!--/container-->
</template>
<script>
export default {
    data() {
        return {
            post: {},
            vagas: {},
            statusVaga: {},
            cartoes: {},
            estados: {},
            instituicoes: {},
            cursos: {},
            departamentos: {},
            supervisores: {},
            dadosPessoais: {},
            informacoesContratuais: {},
            dadosBancarios: {},
            validacaoNome: false,
            msg: {}
        }
    },
    created() {
        let uriCartoes = 'http://localhost:8000/api/cartao';
        let uriEstados = 'http://localhost:8000/api/estados';
        let uriInstituicoes = 'http://localhost:8000/api/instituicao';
        let uriCursos = 'http://localhost:8000/api/cursos';
        let uriDepartamentos = 'http://localhost:8000/api/departamentos';
        let uriSupervisores = 'http://localhost:8000/api/supervisores'; 
        let uriVagas = 'http://localhost:8000/api/vagas';

        this.axios.get(uriCartoes).then(response => this.cartoes = response.data);
        this.axios.get(uriEstados).then(response => this.estados = response.data);
        this.axios.get(uriInstituicoes).then(response => this.instituicoes = response.data);        
        this.axios.get(uriCursos).then(response => this.cursos = response.data);
        this.axios.get(uriDepartamentos).then(response => this.departamentos = response.data);
        this.axios.get(uriSupervisores).then(response => this.supervisores = response.data);
        this.axios.get(uriVagas).then(response => this.vagas = response.data);
    },
    methods: {
        inserirEstagiario() {
            let uriEstagiarios = 'http://localhost:8000/api/estagiarios';
            // this.axios
            // .post(uriEstagiarios, this.post)
            // .then(response => {
            //     this.msg.sucesso = 'Estagiário Cadastrado com sucesso!';
            // })
            // .catch(e => {
            //     this.msg.erro = 'Erro ao cadastrar estagiário';
            // })
            console.log(this.post)
        },
        alteracaoSupervisor() {
            if(!this.post.houve_alteracao_supervisor) {
                this.post.houve_alteracao_supervisor = 0;
            }
        },
        horarioVariavel() {
            if(!this.post.horario_variavel) {
                this.post.horario_variavel = 0;
            } else {
                this.post.horario_variavel = 1;
            }
        }
        ,
        selectVaga() {
            let uriStatusVaga = `http://localhost:8000/api/vagas/${this.post.cod_vaga}`;
            this.axios.get(uriStatusVaga).then(response => this.statusVaga = response.data);
        }
    }
}
</script>
<style>
.col-3 {
    height: 100vh;
}

</style>
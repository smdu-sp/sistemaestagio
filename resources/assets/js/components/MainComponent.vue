<template>    
    <div>

        <b-modal ref="modalContratosVencidos" size="xl" title="Contratos a Vencer nos Próximos 90 dias" ok-only>
            <div id="printable">
                <h1 class="titulo-relatorio">Contratos a vencer nos próximos 90 dias</h1>
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">CPF</th>
                            <th scope="col">Celular</th>
                            <th scope="col">Email</th>
                            <th scope="col">Departamento</th>
                            <th scope="col">Supervisor</th>
                            <th scope="col">Vencimento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                        v-for="(estagiario, indice) of contratosAVencer" 
                        :key="estagiario.nome">
                            <th scope="row">{{ indice + 1 }}</th>
                                <td>
                                    <router-link :to="{name: 'consulta'}">
                                        <a @click="consultaEstagiario(indice)">
                                            {{ estagiario.nome.toUpperCase() }}
                                        </a>
                                    </router-link>
                                </td>
                            <td>{{ estagiario.cpf | cpfFormatado }}</td>
                            <td>{{ estagiario.fone_celular }}</td>
                            <td>{{ estagiario.email_pessoal }}</td>
                            <td>{{ estagiario.dep_hierarquico ? estagiario.dep_hierarquico : 'NÃO CADASTRADO' }}</td>
                            <td>{{ estagiario.supervisor.toUpperCase() }}</td>
                            <td>{{ estagiario.dt_termino | dataFormatada }}</td>                        
                        </tr>
                        <template v-if="!contratosAVencer.length">
                            <tr>
                                <td colspan="8" class="text-center">
                                    <h1>Não há nenhum contrato a vencer em 90 dias</h1>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </b-modal>

        <b-modal ref="modalVagasEmSelecao" size="xl" title="Estagiarios Em Seleção" ok-only>
            <div id="printable">
                <h1 class="titulo-relatorio">Estagiários em Seleção</h1>
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Celular</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Departamento</th>
                        <th scope="col">Supervisor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                        v-for="(estagiario, indice) of estagiariosEmContratacao" 
                        :key="estagiario.id">
                            <th scope="row">{{ indice + 1 }}</th>
                                <td>
                                    <router-link :to="{name: 'consulta'}">
                                        <a @click="selecionaEstagiarioEmContratacao(indice)">
                                            {{ estagiario.nome.toUpperCase() }}
                                        </a>
                                    </router-link>
                                </td>
                                <td>{{ estagiario.cpf | cpfFormatado }}</td>          
                                <td>{{ estagiario.fone_celular }}</td>           
                                <td>{{ estagiario.email_pessoal.toLowerCase() }}</td>           
                                <td>{{ estagiario.dep_hierarquico }}</td>      
                                <td>{{ estagiario.supervisor.toUpperCase() }}</td>      
                        </tr>
                        <template v-if="!estagiariosEmContratacao.length">
                            <tr>
                                <td colspan="7" class="text-center">
                                    <h1>Não há nenhum estagiário em contratação</h1>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </b-modal>

        <!--Painel Resumo-->
        <div class="row mt-5 branco">
            <!-- <div class="col-6 col-sm-4 col-md-3 mb-3">
                <div class="card bg-success" style="width: 10rem;">
                    <div class="card-body">
                        <a href="#">
                            <h1 class="card-title text-center text-white">80</h1>
                            <h6 class="card-subtitle mb-2 text-center text-white">Estagiários Ativos</h6>
                        </a>
                    </div>
                </div>
            </div> -->

            <div class="col-6 col-sm-4 col-md-3 mb-3">
                <div class="card bg-primary" style="width: 10rem;">
                    <div class="card-body">
                        <a href="#">
                            <h1 class="card-title text-center text-white" @click="exibeContratos">{{ contratosAVencer.length }}</h1>
                            <h6 class="card-subtitle mb-2 text-center text-white" @click="exibeContratos">Contratos a Vencer em 90 dias</h6>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-6 col-sm-4 col-md-3 mb-3">
                <div class="card bg-warning" style="width: 10rem;">
                    <div class="card-body">
                        <a href="#">
                            <h1 class="card-title text-center text-white" @click="exibeVagasEmSelecao">{{ estagiariosEmContratacao.length ? estagiariosEmContratacao.length : '0' }}</h1>
                            <h6 class="card-subtitle mb-2 text-center text-white">Estagiários em Seleção</h6>
                        </a>
                    </div>
                </div>
            </div>

            <!-- <div class="col-6 col-sm-4 col-md-3 mb-3">
                <div class="card bg-danger" style="width: 10rem;">
                    <div class="card-body">
                        <a href="#">
                            <h1 class="card-title text-center text-white">1</h1>
                            <h6 class="card-subtitle mb-2 text-center text-white">Contratos Vencidos</h6>
                        </a>
                    </div>
                </div>
            </div> -->
        </div> <!--/Painel Resumo -->

        <!-- Acesso Rápido -->
        <!-- <div class="container mt-5">
            <div class="row">
                <div class="col-12 linha-horizontal">
                    <span class="acesso-rapido d-flex justify-content-center">MAIS ACESSADOS</span>
                </div>
            </div>
        </div>         

        <div class="row">
            <div class="col-6 col-sm-4 col-md-3 mt-3">
                <div>
                    <div class="card-acesso-rapido" style="width: 10rem;">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <img class="img-acesso-rapido" src="../../../../public/icones/icons8-curriculo-50.png" alt="Estagiários Ativos">
                        </div>
                    </div>
                    <span class="titulo-card d-flex justify-content-center text-center mt-1">Estagiários Ativos</span>
                </div>
            </div>

            <div class="col-6 col-sm-4 col-md-3 mt-3">
                <div>
                    <div class="card-acesso-rapido" style="width: 10rem;">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <img class="img-acesso-rapido" src="../../../../public/icones/icons8-ativos-da-empresa-50.png" alt="Estagiários Ativos">
                        </div>
                    </div>
                    <span class="titulo-card d-flex justify-content-center text-center mt-1">Orçamento</span>
                </div>
            </div>

            <div class="col-6 col-sm-4 col-md-3 mt-3">
                <div>
                    <div class="card-acesso-rapido" style="width: 10rem;">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <img class="img-acesso-rapido" src="../../../../public/icones/icons8-boletim-50.png" alt="Estagiários Ativos">
                        </div>
                    </div>
                    <span class="titulo-card d-flex justify-content-center text-center mt-1">Vagas em Seleção</span>
                </div>
            </div>

            <div class="col-6 col-sm-4 col-md-3 mt-3">
                <div>
                    <div class="card-acesso-rapido" style="width: 10rem;">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <img class="img-acesso-rapido" src="../../../../public/icones/icons8-ms-excel-50.png" alt="Estagiários Ativos">
                        </div>
                    </div>
                    <span class="titulo-card d-flex justify-content-center text-center mt-1">Exportar Dados de Estagiários</span>
                </div>
            </div> -->
            
        </div>
        <!-- /Acesso Rápido -->
        
    </div>
</template>
<script>
import { mapMutations, mapActions } from 'vuex';
import { setTimeout } from 'timers';
import filtros from '../mixins/filtros';
import _ from 'lodash';
export default {
    data() {
        return {
            contratosAVencer: [],
            estagiariosEmContratacao: {}
        }
    },
    mixins: [filtros],
    computed: {
        estagiariosOrdenados() { // Todo: Ordenar supervisores em ordem alfabética utilizando esta função
            let lowerCaseEstagiarios = _.clone(this.contratosAVencer);
            if(typeof(lowerCaseEstagiarios.map) == 'undefined')
                return;
            lowerCaseEstagiarios = lowerCaseEstagiarios.map((estagiario) => {
                estagiario.nome = estagiario.nome.toLowerCase();
                return estagiario;
            });

            const sortedEstagiarios = _.orderBy(lowerCaseEstagiarios, ['nome'], ['asc']);

            return sortedEstagiarios;
        },
    },
    beforeMount() {
        if(!this.$store.state.estagiario.contratosAVencer.length) {
            this.retornaEstagiarios();
        } else {
            this.contratosAVencer = this.$store.state.estagiario.contratosAVencer;
            this.estagiariosEmContratacao = this.$store.state.estagiario.estagiariosEmContratacao;
        }
    },
    methods: {
        ...mapActions(['salvaContratosAVencer', 'salvaVagasEmSelecao', 'salvaEstagiariosEmContratacao']),
        ...mapMutations(['armazenaEstagiarios', 'armazenaEstagiariosEmContratacao', 'armazenaEstagiarioSelecionado']),
        selecionaEstagiarioEmContratacao(indice) {
            this.armazenaEstagiarioSelecionado(this.estagiariosEmContratacao[indice]);
        },
        consultaEstagiario(indice) {
            this.$store.state.estagiario.estagiarioSelecionado = this.contratosAVencer[indice];
            this.$store.state.estagiario.idCursoEstagiarioSelecionado = this.contratosAVencer[indice].curso_formacao;
        },
        exibeModalContratosVencidos() {
            this.$refs['modalContratosVencidos'].show()
        },
        escondeModalContratosVencidos() {
            this.$refs['modalContratosVencidos'].hide()
        },
        exibeModalVagasEmSelecao() {
            this.$refs['modalVagasEmSelecao'].show()
        },
        escondeModalVagasEmSelecao() {
            this.$refs['modalVagasEmSelecao'].hide()
        },
        exibeContratos() {
            this.exibeModalContratosVencidos();
        },
        exibeVagasEmSelecao() {
            this.exibeModalVagasEmSelecao();
        },
        retornaEstagiarios() {
            const uriEstagiarios = '/api/estagiarios';

            if(this.$store.state.estagiario.estagiarios.length >= 0) {
                return;
            } else {
                this.axios
                .get(uriEstagiarios)
                .then(response => {
                    this.armazenaEstagiarios(response.data)
                    this.salvaContratosAVencer();
                    this.contratosAVencer = this.$store.state.estagiario.contratosAVencer;
                    this.retornaEstagiariosEmContratacao();
                })
                .catch(error => {
                console.log(error);
                })
            }
        },
        retornaEstagiariosEmContratacao() {
            this.salvaEstagiariosEmContratacao();
            this.estagiariosEmContratacao = this.$store.state.estagiario.estagiariosEmContratacao;
        }
    }
}
</script>
<style scoped>
.card-body {
    height: 134px;
}

.card-body .card-subtitle {
    font-family: 'Roboto', sans-serif;
    font-size: 14px;
}

.card-body a:hover {
    text-decoration: none;
}

.acesso-rapido {
    font-family: 'Roboto', sans-serif;
    font-style: normal;
    font-weight: normal;
    font-size: 18px;
    line-height: 21px;
    text-align: center;
    letter-spacing: 0.42em;
    color: #828282;
}

.linha-horizontal {
    border-bottom: 1px solid #D8D8D8;
}

.card-acesso-rapido {
    box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
    background-color: #F2F2F2;
}

.img-acesso-rapido {
    width: 50px;
    height: 50px;
    margin: 0;
    padding: 0;
}

.titulo-card {
    font-family: 'Roboto', sans-serif;
    font-size: 14px;
    line-height: 19px;
    letter-spacing: 0.3em;
    text-decoration: underline;
    text-transform: uppercase;
    color: #000000;
}

.item-estagiario {
    list-style: none;
}

.titulo-relatorio {
    display: none;
}

@media print {
  body * {
    visibility: hidden;
  }
  #printable, #printable * {
    visibility: visible;
  }
  #printable {
    position: fixed;
    left: 0;
    top: 0;
  }
  .titulo-relatorio {
      display: block;
  }
}
</style>
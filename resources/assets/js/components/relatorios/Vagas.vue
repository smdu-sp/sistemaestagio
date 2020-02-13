<template>
    <div> 
        <h1 class="text-center">Relatório de vagas</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="selectStatus">Situação</label>
                    <select class="form-control" id="selectStatus" v-model="status">
                        <option value="Todas">Todas</option>
                        <option value="Livres">Livres</option>
                        <option value="Ocupadas">Ocupadas</option>
                        <option value="Em seleção">Em seleção</option>
                        <option value="Canceladas">Canceladas</option>
                        <option value="TRANSFERIDA.SMG">TRANSFERIDA.SMG</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="selectSetor">Departamento</label>
                    <select id="selectSetor" class="form-control" v-model="departamentoFiltrado">
                        <option value="">Todos</option>
                        <option  v-for="departamento of departamentosFiltrados" :key="departamento.sigla">{{ departamento.sigla }}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="selectSupervisor">Supervisor</label>
                    <select id="selectSupervisor" class="form-control" v-model="supervisorFiltrado">
                        <option value="">Todos</option>
                        <option v-for="supervisor of supervisoresSort" :key="supervisor.rf">{{ supervisor.nome }}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 d-flex flex-column justify-content-end">
                <div class="form-group">
                    <button class="btn btn-warning" @click="limparFiltro">Limpar Filtros</button>
                    <botao-imprimir-component></botao-imprimir-component>
                    <botao-excel nome='relatorio_vagas'></botao-excel>
                </div>
            </div>
        </div>

        <div v-if="status === 'Todas'">
            <h5 class="total-vagas alert alert-info">Total de vagas: {{ vagasPorDepartamento.length }}</h5>
            <div id="divTabela">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="row">#</th>
                        <th scope="row">Vaga</th>
                        <th scope="row">Status</th>
                        <th scope="row">Departamento</th>
                        <th scope="row">Supervisor</th>
                        <th scope="row">Estagiário</th>
                        <th scope="row">Observações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(vaga, indice) of vagasPorDepartamento" :key="vaga.id">
                        <td>{{ indice + 1 }}</td>
                        <td><b-link href="#" id="modalHistoricoVagas" style="cursor: pointer;" @click="abrirModalHistoricoVagas(vaga.id)">{{ vaga.id }}</b-link></td>
                        <td>{{ vaga.status }}</td>
                        <td>{{ vaga.dep_hierarquico }}</td>
                        <td>{{ vaga.supervisor }}</td>
                        <td>{{ vaga.estagiario }}</td>
                        <td>{{ vaga.historico }}</td>
                    </tr>
                </tbody>
            </table>
            </div>
            <!--Modal - Histórico da Vaga-->
           <template>
            <div>
                <b-modal ref="modalHistoricoVagas" hide-footer title="Histórico da vaga" size="lg">
                <div class="d-block text-center">
                   <h4>Vaga {{ vagaAtual }}</h4>
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="row">Cód. Vaga</th>
                                <th scope="row">Nome do Estagiário</th>
                                <th scope="row">Data início</th>
                                <th scope="row">Data fim</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(historicoEstagiarios, indice) of historicoVagas" :key="historicoEstagiarios.cpf">
                                <td>{{ historicoEstagiarios.cod_vaga }}</td>
                                <td>{{ historicoEstagiarios.nome }}</td>
                                <td>{{ new Date(historicoEstagiarios.dt_inicio).toLocaleDateString() }}</td>
                                <td>{{ new Date(historicoEstagiarios.dt_termino).toLocaleDateString() }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div v-if="historicoVagas.length === 0">
                        <h4>Não há histórico para esta vaga.</h4>
                    </div>
                </div>
                <b-button class="mt-3" variant="outline-danger" block @click="fecharModalHistoricoVagas">Fechar</b-button>
                </b-modal>
            </div>
            </template>
             </div>
        
            <div v-if="status === 'Livres'">
            <h5 class="total-vagas alert alert-info">Total de vagas: {{ vagasPorDepartamento.length }}</h5>
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="row">#</th>
                        <th scope="row">Vaga</th>
                        <th scope="row">Status</th>
                        <th scope="row">Departamento</th>
                        <th scope="row">Supervisor</th>
                        <th scope="row">Estagiário</th>
                        <th scope="row">Observações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(vagaLivre, indice) of vagasPorDepartamento" :key="vagaLivre.id">
                        <td>{{ indice + 1 }}</td>
                        <td>{{ vagaLivre.id }}</td>
                        <td>{{ vagaLivre.status }}</td>
                        <td>{{ vagaLivre.dep_hierarquico }}</td>
                        <td>{{ vagaLivre.supervisor }}</td>
                        <td>{{ vagaLivre.estagiario }}</td>
                        <td>{{ vagaLivre.historico }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div v-if="status === 'Ocupadas'">
            <h5 class="total-vagas alert alert-info">Total de vagas: {{ vagasPorDepartamento.length }}</h5>
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="row">#</th>
                        <th scope="row">Vaga</th>
                        <th scope="row">Status</th>
                        <th scope="row">Departamento</th>
                        <th scope="row">Supervisor</th>
                        <th scope="row">Estagiário</th>
                        <th scope="row">Observações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(vaga, indice) of vagasPorDepartamento" :key="vaga.id">
                        <td>{{ indice + 1 }}</td>
                        <td><a v-b-modal.modalHistoricoVagas>{{ vaga.id }}</a></td>
                        <td>{{ vaga.status }}</td>
                        <td>{{ vaga.dep_hierarquico }}</td>
                        <td>{{ vaga.supervisor }}</td>
                        <td>{{ vaga.estagiario }}</td>
                        <td>{{ vaga.historico }}</td>
                    </tr>
                </tbody>
            </table>
        </div>


        <div v-if="status === 'Em seleção'">
            <h5 class="total-vagas alert alert-info">Total de vagas: {{ vagasPorDepartamento.length }}</h5>
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="row">#</th>
                        <th scope="row">Vaga</th>
                        <th scope="row">Status</th>
                        <th scope="row">Departamento</th>
                        <th scope="row">Supervisor</th>
                        <th scope="row">Estagiário</th>
                        <th scope="row">Observações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(vagaEmSelecao, indice) of vagasPorDepartamento" :key="vagaEmSelecao.id">
                        <td>{{ indice + 1 }}</td>
                        <td>{{ vagaEmSelecao.id }}</td>
                        <td>{{ vagaEmSelecao.status }}</td>
                        <td>{{ vagaEmSelecao.dep_hierarquico }}</td>
                        <td>{{ vagaEmSelecao.supervisor }}</td>
                        <td>{{ vagaEmSelecao.estagiario }}</td>
                        <td>{{ vagaEmSelecao.historico }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div v-if="status === 'Canceladas'">
            <h5 class="total-vagas alert alert-info">Total de vagas: {{ vagasPorDepartamento.length }}</h5>
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="row">#</th>
                        <th scope="row">Vaga</th>
                        <th scope="row">Status</th>
                        <th scope="row">Departamento</th>
                        <th scope="row">Supervisor</th>
                        <th scope="row">Estagiário</th>
                        <th scope="row">Observações
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(vagaCancelada, indice) of vagasPorDepartamento" :key="vagaCancelada.id">
                        <td>{{ indice + 1 }}</td>
                        <td>{{ vagaCancelada.id }}</td>
                        <td>{{ vagaCancelada.status }}</td>
                        <td>{{ vagaCancelada.dep_hierarquico }}</td>
                        <td>{{ vagaCancelada.supervisor  }}</td>
                        <td>{{ vagaCancelada.estagiario }}</td>
                        <td>{{ vagaCancelada.historico }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div v-if="status === 'TRANSFERIDA.SMG'">
            <h5 class="total-vagas alert alert-info">Total de vagas: {{ vagasPorDepartamento.length }}</h5>
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="row">#</th>
                        <th scope="row">Vaga</th>
                        <th scope="row">Status</th>
                        <th scope="row">Departamento</th>
                        <th scope="row">Supervisor</th>
                        <th scope="row">Estagiário</th>
                        <th scope="row">Observações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(vagaTransferida, indice) of vagasPorDepartamento" :key="vagaTransferida.id">
                        <td>{{ indice + 1 }}</td>
                        <td>{{ vagaTransferida.id }}</td>
                        <td>{{ vagaTransferida.status }}</td>
                        <td>{{ vagaTransferida.dep_hierarquico }}</td>
                        <td>{{ vagaTransferida.supervisor }}</td>
                        <td>{{ vagaTransferida.estagiario }}</td>
                        <td>{{ vagaTransferida.historico }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>
    
</template>

<script>
import { setTimeout } from 'timers';
import _ from 'lodash';
import computeds from '../../mixins/computeds';
export default {
    data() {
        return  {
            status: 'Todas',
            departamentoFiltrado: '',
            supervisorFiltrado: '',
            estagiarios: {},
            supervisores: {},
            vagas: [],
            vagaAtual: '123',
            historicoVagas: [],
            departamentos: [],
            vagasOcupadas: [],
            vagasEmSelecao: [],
            vagasLivres: [],
            vagasCanceladas: [],
            vagasTransferidas: []
        }
    },
    beforeMount(){
        this.retornaSupervisores();
        this.retornaEstagiarios();
        this.retornaVagas();
        this.retornaDepartamentos();
    },
    mixins: [computeds],
    computed: {
        departamentosFiltrados() {
            let departamentosPai = this.departamentos.filter((departamento) => {
                return departamento.tipo === "PAI"
            })
            return departamentosPai
        },
        supervisoresSort() {
            return _.orderBy(this.supervisores, 'nome');
        },
        vagasPorDepartamento() {
            // filtro somente por status
            if(this.departamentoFiltrado === '' && this.supervisorFiltrado === '' && this.status === 'Todas') { 
                return this.vagas
            } else if(this.departamentoFiltrado === '' && this.supervisorFiltrado === '' && this.status === 'Livres') {
                return this.vagasLivres;
            } else if(this.departamentoFiltrado === '' && this.supervisorFiltrado === '' && this.status === 'Ocupadas') {
                return this.vagasOcupadas;
            } else if(this.departamentoFiltrado === '' && this.supervisorFiltrado === '' && this.status === 'Em seleção') {
                return this.vagasEmSelecao;
            } else if(this.departamentoFiltrado === '' && this.supervisorFiltrado === '' && this.status === 'TRANSFERIDA.SMG') {
                return this.vagasTransferidas;
            } else if(this.departamentoFiltrado === '' && this.supervisorFiltrado === '' && this.status === 'Canceladas') {
                return this.vagasCanceladas;
            } 
            
            // filtro somente por departamento
            else if(this.departamentoFiltrado != '' && this.supervisorFiltrado === '' && this.status === 'Todas') {
                let vagas = this.vagas.filter(vaga => {
                    return vaga.dep_hierarquico === this.departamentoFiltrado
                })
                return vagas;
            } 

            // filtro somente por supervisor
            else if(this.departamentoFiltrado === '' && this.supervisorFiltrado != '' && this.status === 'Todas') {
                let vagas = this.vagas.filter(vaga => {
                    return vaga.supervisor === this.supervisorFiltrado;
                })
                return vagas;
            }

            // filtro somente por supervisor e status
            else if(this.departamentoFiltrado === '' && this.supervisorFiltrado != '' && this.status === 'Ocupadas') {
                let vagas = this.vagas.filter(vaga => {
                    return vaga.supervisor === this.supervisorFiltrado && vaga.status === 'OCUPADA';
                })
                return vagas;
            } else if(this.departamentoFiltrado === '' && this.supervisorFiltrado != '' && this.status === 'Livres') {
                let vagas = this.vagas.filter(vaga => {
                    return vaga.supervisor === this.supervisorFiltrado && vaga.status === 'LIVRE';
                })
                return vagas;
            } else if(this.departamentoFiltrado === '' && this.supervisorFiltrado != '' && this.status === 'Em seleção') {
                let vagas = this.vagas.filter(vaga => {
                    return vaga.supervisor === this.supervisorFiltrado && vaga.status === 'EM SELEÇÃO';
                })
                return vagas;
            } else if(this.departamentoFiltrado === '' && this.supervisorFiltrado != '' && this.status === 'Canceladas') {
                let vagas = this.vagas.filter(vaga => {
                    return vaga.supervisor === this.supervisorFiltrado && vaga.status === 'CANCELADA';
                })
                return vagas;
            } else if(this.departamentoFiltrado === '' && this.supervisorFiltrado != '' && this.status === 'TRANSFERIDA.SMG') {
                let vagas = this.vagas.filter(vaga => {
                    return vaga.supervisor === this.supervisorFiltrado && vaga.status === 'TRANSFERIDA.SMG';
                })
                return vagas;
            }

            // filtro somente por supervisor e departamento
            else if(this.departamentoFiltrado != '' && this.supervisorFiltrado != '' && this.status === 'Todas') {
                let vagas = this.vagas.filter(vaga => {
                    return vaga.supervisor === this.supervisorFiltrado && vaga.dep_hierarquico === this.departamentoFiltrado;
                })
                return vagas;
            }

            // filtro somente por status e departamento
            else if(this.departamentoFiltrado != '' && this.supervisorFiltrado === '' && this.status === 'Livres') {
                let vagas = this.vagas.filter((vaga) => {
                    return vaga.dep_hierarquico === this.departamentoFiltrado && vaga.status === 'LIVRE';
                })
                return vagas;
            } else if(this.departamentoFiltrado != '' && this.supervisorFiltrado === '' && this.status === 'Ocupadas') {
                let vagas = this.vagas.filter((vaga) => {
                    return vaga.dep_hierarquico === this.departamentoFiltrado && vaga.status === 'OCUPADA';
                })
                return vagas;
            } else if(this.departamentoFiltrado != '' && this.supervisorFiltrado === '' && this.status === 'Em seleção') {
                let vagas = this.vagas.filter((vaga) => {
                    return vaga.dep_hierarquico === this.departamentoFiltrado && vaga.status === 'EM SELEÇÃO';
                })
                return vagas;
            } else if(this.departamentoFiltrado != '' && this.supervisorFiltrado === '' && this.status === 'Canceladas') {
                let vagas = this.vagas.filter((vaga) => {
                    return vaga.dep_hierarquico === this.departamentoFiltrado && vaga.status === 'CANCELADA';
                })
                return vagas;
            } else if(this.departamentoFiltrado != '' && this.supervisorFiltrado === '' && this.status === 'TRANSFERIDA.SMG') {
                let vagas = this.vagas.filter((vaga) => {
                    return vaga.dep_hierarquico === this.departamentoFiltrado && vaga.status === 'TRANSFERIDA.SMG';
                })
                return vagas;
            } 
            
            // filtro por departamento, supervisor e status
            else if(this.departamentoFiltrado != '' && this.supervisorFiltrado != '' & this.status === 'Livres') {
                let vagas = this.vagas.filter((vaga) => {
                    return vaga.dep_hierarquico === this.departamentoFiltrado && vaga.status === 'LIVRE' && vaga.supervisor === this.supervisorFiltrado;
                })
                return vagas;
            } else if(this.departamentoFiltrado != '' && this.supervisorFiltrado != '' & this.status === 'Ocupadas') {
                let vagas = this.vagas.filter((vaga) => {
                    return vaga.dep_hierarquico === this.departamentoFiltrado && vaga.status === 'OCUPADA' && vaga.supervisor === this.supervisorFiltrado;
                })
                return vagas;
            } else if(this.departamentoFiltrado != '' && this.supervisorFiltrado != '' & this.status === 'Em seleção') {
                let vagas = this.vagas.filter((vaga) => {
                    return vaga.dep_hierarquico === this.departamentoFiltrado && vaga.status === 'EM SELEÇÃO' && vaga.supervisor === this.supervisorFiltrado;
                })
                return vagas;
            } else if(this.departamentoFiltrado != '' && this.supervisorFiltrado != '' & this.status === 'Canceladas') {
                let vagas = this.vagas.filter((vaga) => {
                    return vaga.dep_hierarquico === this.departamentoFiltrado && vaga.status === 'CANCELADA' && vaga.supervisor === this.supervisorFiltrado;
                })
                return vagas;
            } else if(this.departamentoFiltrado != '' && this.supervisorFiltrado != '' & this.status === 'TRANSFERIDA.SMG') {
                let vagas = this.vagas.filter((vaga) => {
                    return vaga.dep_hierarquico === this.departamentoFiltrado && vaga.status === 'TRANSFERIDA.SMG' && vaga.supervisor === this.supervisorFiltrado;
                })
                return vagas;
            }
        },
    },
    methods: {
       abrirModalHistoricoVagas(idVaga) {           
        //    Atualiza informações do modal                   
        this.vagaAtual = idVaga;
        this.historicoVagas = [];
        for (let i in this.estagiarios){
            if(this.estagiarios[i].cod_vaga === this.vagaAtual){
                this.historicoVagas.push(this.estagiarios[i]);
            }
        }        

        //    Exibe modal
        this.$refs['modalHistoricoVagas'].show()
        },
        fecharModalHistoricoVagas() {
        this.$refs['modalHistoricoVagas'].hide()
      },

        limparFiltro() {
            this.status = 'Todas';
            this.departamentoFiltrado = '';
            this.supervisorFiltrado = '';
        },
        retornaSupervisores() {
            const uriSupervisores = '/api/supervisores';

            this.axios.get(uriSupervisores)
            .then(response => {
                this.supervisores = response.data;
                for(let i in this.supervisores) {
                    this.supervisores[i].nome = this.supervisores[i].nome.toUpperCase();
                }
            })
            .catch(error => {
                console.log(error)
            })
        },
        acrescentaSupervisorEEstagiarioVaga() {
            for(let i in this.estagiarios) {
                for(let k in this.vagas) {
                    if(this.estagiarios[i].cod_vaga === this.vagas[k].id && this.estagiarios[i].situacao == 1) {
                        this.vagas[k].supervisor = this.estagiarios[i].supervisor.toUpperCase();
                        this.vagas[k].estagiario = this.estagiarios[i].nome.toUpperCase();
                    }
                }
            }
        },
        retornaEstagiarios() {
            const uriEstagiarios = '/api/estagiarios';

            this.axios.get(uriEstagiarios)
            .then(response => {
                this.estagiarios = response.data;
                for(let i in this.estagiarios) {
                    this.estagiarios[i].nome = this.estagiarios[i].nome.toUpperCase()
                }
            })
            .catch(error => {
                console.log(error);
            })
        },
        vagasDistribuidas(vagas) {
            for(let i in vagas) {
                if(vagas[i].status == "OCUPADA") {
                    this.vagasOcupadas.push(vagas[i])
                } else if(vagas[i].status == "EM SELEÇÃO"){
                    this.vagasEmSelecao.push(vagas[i])
                } else if(vagas[i].status == "LIVRE") {
                    this.vagasLivres.push(vagas[i])
                } else if(vagas[i].status == "CANCELADA") {
                    this.vagasCanceladas.push(vagas[i])
                } else if(vagas[i].status == "TRANSFERIDA.SMG"){
                    this.vagasTransferidas.push(vagas[i])
                }
            }
        },
        retornaVagas() {
            const uriVagas = '/api/vagas'

            this.axios
            .get(uriVagas)
            .then(response => {
                this.vagas = response.data
                this.vagasDistribuidas(response.data)
                this.acrescentaSupervisorEEstagiarioVaga();
            })
            .catch(error => {
                console.log(error);
            })
        },
        retornaDepartamentos() {
            const uriVagas = '/api/departamentos';

            this.axios
            .get(uriVagas)
            .then(response => {
                this.departamentos = response.data;
            })
            .catch(error => {
                console.log(error);
            })
        }
    }
}
</script>

<style>
</style>

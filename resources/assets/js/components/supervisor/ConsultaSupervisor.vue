<template>
    <div>
        <h1>Consulta Supervisor</h1>


          <!--Modal ativado quando o usuário clica no nome de algum estagiário -->
    <b-modal ref="consulta-estagiario" size="lg" hide-footer title="Consulta de Estagiário">
        <div class="row">
            <div class="col-md-6">
                <b>Nome:</b> {{ estagiarioClicado.nome ? estagiarioClicado.nome.toUpperCase() : '' }}
            </div>
        </div>

      
        <div class="text-right">
            <router-link to="/consulta" class="btn btn-outline-primary mt-3">Editar dados</router-link>
            <b-button class="mt-3" variant="outline-danger" @click="escondeModalEstagiario">Cancelar</b-button>
        </div>
    </b-modal>
  <!--Modal-->

        <b-card no-body>
            <b-tabs card>
                <b-tab title="Supervisores" active>
                    <b-card-text>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Filtro:</label>
                                <input type="search" @input="filtro = $event.target.value" class="form-control" placeholder="Digite parte do nome do Supervisor">
                            </div>
                        </div>

                        
                        <div class="row mt-2 tabela">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">RF</th>
                                        <th scope="col">Departamento</th>
                                        <th scope="col">Cargo</th>
                                        <th scope="col">Formação</th>
                                        <!-- <th scope="col">Conselhor Profissional</th> -->
                                        <!-- <th scope="col">Atividades Estagiário</th> -->
                                        <th scope="col">Situação</th>
                                        <th scope="col">CPF</th>
                                        <th scope="col">Estagiários</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="supervisor of supervisoresComFiltro" :key="supervisor.nome">
                                        <th scope="row">{{ supervisor.nome.toUpperCase() }}</th>
                                        <td>{{ supervisor.rf }}</td>
                                        <td>{{ supervisor.departamento }}</td>
                                        <td>{{ supervisor.cargo_funcao }}</td>
                                        <td>{{ supervisor.formacao }}</td>
                                        <!-- <th scope="row">{{ supervisor.conselho_profissional }}</th> -->
                                        <!-- <th scope="row">{{ supervisor.atividades_estagiario }}</th> -->
                                        <td>{{ supervisor.situacao }}</td>
                                        <td>{{ supervisor.cpf }}</td>
                                        <td class="td-estagiario">
                                            <a href="" @click.prevent="consultaEstagiario" v-for="estagiario of supervisor.estagiarios" :key="estagiario" class="estagiario">
                                                <tr>
                                                    {{ estagiario }}
                                                    <span class="linha"></span>
                                                </tr>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </b-card-text>
                </b-tab>
            </b-tabs>
        </b-card>
    </div>
</template>

<script>
import { setTimeout } from 'timers';
export default {
    data() {
        return {
            nomeBuscado: '',
            supervisores: {},
            supervisorFiltrado: {},
            estagiarios: {},
            departamentos: {},
            auxiliarCpf: '', // usada para recuperar o cpf do estagiario clicado
            estagiarioClicado: {},
            cargos: {},
            filtro: ''
        }
    },
    beforeMount() {
        this.retornaSupervisores();
        this.retornaEstagiarios();
        this.retornaDepartamentos();
        this.retornaCargos();       
        this.exibeCargo(); 
    }, 
    computed: {
        supervisoresComFiltro() {
            this.supervisorFiltrado = this.supervisores
            if(this.filtro){
                let exp = new RegExp(this.filtro.trim(), 'i');
                return this.supervisorFiltrado.filter(supervisor => exp.test(supervisor.nome));
            } else {
                return this.supervisores;
            }
        },
        supervisoresOrdenados() { // Todo: Ordenar supervisores em ordem alfabética utilizando esta função
            let lowerCaseSupervisores = _.clone(this.supervisores);
            if(typeof(lowerCaseSupervisores.map) == 'undefined')
                return;
            lowerCaseSupervisores = lowerCaseSupervisores.map((supervisor) => {
                supervisor.nome = supervisor.nome.toLowerCase();
                return supervisor;
            });

            const sortedSupervisores = _.orderBy(lowerCaseSupervisores, ['nome'], ['asc']);

            return sortedSupervisores;
        }
    },
    methods: {
        exibeModalEstagiario() {
            this.$refs['consulta-estagiario'].show()
        },
        escondeModalEstagiario() {
            this.$refs['consulta-estagiario'].hide()
        },
        retornaSupervisores() {
            const uriSupervisor = '/api/supervisores';

            this.axios
            .get(uriSupervisor)
            .then(response => {
                this.supervisores = response.data;
            })
            .catch(error => {
                console.log("Erro: "+error);
            })
        },
        retornaEstagiarios() {
            const uriEstagiario = '/api/estagiarios';

            this.axios
            .get(uriEstagiario)
            .then(response => {
                this.estagiarios = response.data;
            })
            .catch(error => {
                console.log("Erro: "+error);
            })
        },
        exibeDepartamento() { // Substitui o código do departamento pela sigla do mesmo
            for(let i in this.supervisores) { 
                    for(let k in this.departamentos) {
                        if(this.supervisores[i].departamento == this.departamentos[k].eh){
                            this.supervisores[i].departamento = this.departamentos[k].sigla
                        }
                    }
                }
        },
        arrayEstagiarios() { // Cria um array de estagiarios dentro de cada supervisor
            for(let i in this.supervisores) { 
                    this.supervisores[i].estagiarios = new Array();
                }
        },
        relacionaEstagiarioAoSupervisor() { // Verifica se o estagiário pertence ao supervisor
            for(let i in this.estagiarios) { 
                for(let k in this.supervisores) {
                    if(this.supervisores[k].nome.toUpperCase() == this.estagiarios[i].supervisor.toUpperCase()) {
                        this.supervisores[k].estagiarios.push(this.estagiarios[i].nome);
                    }
                }
            }
        },
        retornaDepartamentos() {
            const uriDepartamentos = '/api/departamentos';

            this.axios
            .get(uriDepartamentos)
            .then(response => {
                this.departamentos = response.data;
                this.exibeDepartamento();
                this.arrayEstagiarios();
                this.relacionaEstagiarioAoSupervisor();                
            })
            .catch(error => {
                console.log("Erro: "+error);
            })

            

        },
        retornaCargos() {
            const uriCargos = '/api/cargos';

            this.axios
            .get(uriCargos)
            .then(response => {
                this.cargos = response.data;
            })
            .catch(error => {
                console.log("Error: "+error)
            });
        },
        exibeCargo() { // substitui o numero do cargo pelo nome do mesmo
            for(let i in this.supervisores){
                for(let k in this.cargos) {
                    console.log("idCargo: "+this.cargos[k].id);
                    console.log("idSupervisor: "+this.supervisores[k].cargo_funcao);
                }
            }
        },
        consultaEstagiario(e) {
            let textoTd = e.target.innerText.toUpperCase();
            for(let i in this.estagiarios) {
                let estagiario = this.estagiarios[i];
                let estagiarioUpperCase = this.estagiarios[i].nome.toUpperCase();
                if(textoTd == estagiarioUpperCase){
                    this.estagiarioClicado = estagiario;
                    this.exibeModalEstagiario();
                }
            }
        }
    }    
}
</script>

<style>
.tabela {
    overflow: scroll;
    height: 500px;
}
.estagiario {
    text-transform: capitalize;
    margin-bottom: 4px;
}
.td-estagiario {
    background-color: transparent!important;
}
.linha {
    display: flex;
    border: 1px solid #ccc;
}
</style>

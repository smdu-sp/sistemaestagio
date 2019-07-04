<template>
    <div>
        <h1>Consulta Supervisor</h1>

        <b-card no-body>
            <b-tabs card>
                <b-tab title="Supervisores" active>
                    <b-card-text>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Filtro:</label>
                                <input type="text" class="form-control" placeholder="Digite o nome do Supervisor">
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
                                    <tr v-for="supervisor of supervisores" :key="supervisor.nome">
                                        <th scope="row">{{ supervisor.nome }}</th>
                                        <th scope="row">{{ supervisor.rf }}</th>
                                        <th scope="row">{{ supervisor.departamento }}</th>
                                        <th scope="row">{{ supervisor.cargo_funcao }}</th>
                                        <th scope="row">{{ supervisor.formacao }}</th>
                                        <!-- <th scope="row">{{ supervisor.conselho_profissional }}</th> -->
                                        <!-- <th scope="row">{{ supervisor.atividades_estagiario }}</th> -->
                                        <th scope="row">{{ supervisor.situacao }}</th>
                                        <th scope="row">{{ supervisor.cpf }}</th>
                                        <th scope="row">{{ supervisor.estagiarios }}</th>
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
            estagiarios: {}
        }
    },
    beforeMount() {
        this.retornaSupervisores();
    },
    computed: {
        supervisoresOrdenados() {
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
        retornaSupervisores() {
            const uriSupervisor = '/api/supervisores';

            this.axios
            .get(uriSupervisor)
            .then(response => {
                this.supervisores = response.data;
                this.retornaEstagiarios();
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
                console.log(this.estagiarios);
                })
            .catch(error => {
                console.log("Erro: "+error);
            })
        },
        buscaSupervisor() {

            // for(let i = 0; i <= this.supervisores.length; i++) {
            //     if(this.nomeBuscado === this.supervisores[i].nome) {
            //         console.log(this.supervisores[i]);
            //     }
            // }

            // for(let i = 0; i <= this.supervisores.length; i++) {
                
            // }
        }
    }    
}
</script>

<style>
.tabela {
    overflow: scroll;
}
</style>

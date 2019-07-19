<template>
    <div>
        <h1>Relatório de vagas</h1>
        <div class="form-group">
            <label for="">Selecione a situação da vaga</label>
            <select class="form-control" v-model="status">
                <option value="Livres">Livres</option>
                <option value="Ocupadas">Ocupadas</option>
                <option value="Em seleção">Em seleção</option>
                <option value="Canceladas">Canceladas</option>
                <option value="TRANSFERIDA.SMG">TRANSFERIDA.SMG</option>
            </select>
        </div>
        <div v-if="status === 'Livres'">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="row">#</th>
                        <th scope="row">Vaga</th>
                        <th scope="row">Situação</th>
                        <th scope="row">Departamento</th>
                        <th scope="row">Histórico</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(vagaLivre, indice) of vagasLivres" :key="vagaLivre.id">
                        <td>{{ indice + 1 }}</td>
                        <td>{{ vagaLivre.id }}</td>
                        <td>{{ vagaLivre.situacao }}</td>
                        <td>{{ vagaLivre.dep_hierarquico }}</td>
                        <td>{{ vagaLivre.historico }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div v-if="status === 'Ocupadas'">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="row">#</th>
                        <th scope="row">Vaga</th>
                        <th scope="row">Situação</th>
                        <th scope="row">Departamento</th>
                        <th scope="row">Histórico</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(vaga, indice) of vagasOcupadas" :key="vaga.id">
                        <td>{{ indice + 1 }}</td>
                        <td>{{ vaga.id }}</td>
                        <td>{{ vaga.situacao }}</td>
                        <td>{{ vaga.dep_hierarquico }}</td>
                        <td>{{ vaga.historico }}</td>
                    </tr>
                </tbody>
            </table>
        </div>


        <div v-if="status === 'Em seleção'">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="row">#</th>
                        <th scope="row">Vaga</th>
                        <th scope="row">Situação</th>
                        <th scope="row">Departamento</th>
                        <th scope="row">Histórico</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(vagaEmSelecao, indice) of vagasEmSelecao" :key="vagaEmSelecao.id">
                        <td>{{ indice + 1 }}</td>
                        <td>{{ vagaEmSelecao.id }}</td>
                        <td>{{ vagaEmSelecao.situacao }}</td>
                        <td>{{ vagaEmSelecao.dep_hierarquico }}</td>
                        <td>{{ vagaEmSelecao.historico }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div v-if="status === 'Canceladas'">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="row">#</th>
                        <th scope="row">Vaga</th>
                        <th scope="row">Situação</th>
                        <th scope="row">Departamento</th>
                        <th scope="row">Histórico</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(vagaCancelada, indice) of vagasCanceladas" :key="vagaCancelada.id">
                        <td>{{ indice + 1 }}</td>
                        <td>{{ vagaCancelada.id }}</td>
                        <td>{{ vagaCancelada.situacao }}</td>
                        <td>{{ vagaCancelada.dep_hierarquico }}</td>
                        <td>{{ vagaCancelada.historico }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div v-if="status === 'TRANSFERIDA.SMG'">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="row">#</th>
                        <th scope="row">Vaga</th>
                        <th scope="row">Situação</th>
                        <th scope="row">Departamento</th>
                        <th scope="row">Histórico</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(vagaTransferida, indice) of vagasTransferidas" :key="vagaTransferida.id">
                        <td>{{ indice + 1 }}</td>
                        <td>{{ vagaTransferida.id }}</td>
                        <td>{{ vagaTransferida.situacao }}</td>
                        <td>{{ vagaTransferida.dep_hierarquico }}</td>
                        <td>{{ vagaTransferida.historico }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>
    
</template>

<script>
import { mapMutations, mapActions, mapGetters } from 'vuex';
import { setTimeout } from 'timers';
export default {
    data() {
        return  {
            status: 'Livres',
            vagas: {},
            vagasOcupadas: [],
            vagasEmSelecao: [],
            vagasLivres: [],
            vagasCanceladas: [],
            vagasTransferidas: []
        }
    },
    beforeMount(){
        this.retornaVagas()
    },
    methods: {
        ...mapActions(['salvaVagas']),
        ...mapGetters(['getVagas']),
        retornaVagas() {
            const uriVagas = '/api/vagas'

            this.axios
            .get(uriVagas)
            .then(response => {
                this.vagasDistribuidas(response.data)
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
                } else {
                    this.vagasTransferidas.push(vagas[i])
                }
            }
        }
    }
}
</script>

<style>

</style>

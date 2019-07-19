<template>
    <div id="printable">
        <h1>Entradas, Saídas e Renovações nos últimos 30 dias</h1>
        <div class="col-md-12">
            <div class="form-group">
                <label for="selecao">Selecione o tipo de relatório desejado</label>
                <select id="selecao" class="form-control" v-model="selecao">
                    <option default value="Entradas">Entradas</option>
                    <option value="Saídas">Saídas</option>
                    <option value="Renovação">Renovação</option>
                </select>
            </div>
            <div v-if="selecao === 'Entradas'">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Departamento</th>
                        <th scope="col">Supervisor</th>
                        <th scope="col">Início</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                        v-for="(estagiarioContratado, indice) of estagiariosContratados30Dias" 
                        :key="estagiarioContratado.nome">
                            <th scope="row">{{ indice + 1 }}</th>
                                <td>
                                    {{ estagiarioContratado.nome.toUpperCase() }}
                                </td>
                            <td>{{ estagiarioContratado.dep_hierarquico ? estagiarioContratado.dep_hierarquico : 'NÃO CADASTRADO' }}</td>
                            <td>{{ estagiarioContratado.supervisor.toUpperCase() }}</td>
                            <td>{{ estagiarioContratado.dt_inicio | dataFormatada }}</td>                        
                        </tr>
                    </tbody>
                </table>

            </div>
            <div v-if="selecao === 'Saídas'">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Departamento</th>
                        <th scope="col">Supervisor</th>
                        <th scope="col">Vencimento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                        v-for="(estagiarioDesligado, indice) of estagiariosDesligados30Dias" 
                        :key="estagiarioDesligado.nome">
                            <th scope="row">{{ indice + 1 }}</th>
                                <td>
                                    {{ estagiarioDesligado.nome.toUpperCase() }}
                                </td>
                            <td>{{ estagiarioDesligado.dep_hierarquico ? estagiarioDesligado.dep_hierarquico : 'NÃO CADASTRADO' }}</td>
                            <td>{{ estagiarioDesligado.supervisor.toUpperCase() }}</td>
                            <td>{{ estagiarioDesligado.dt_termino | dataFormatada }}</td>                        
                        </tr>
                    </tbody>
                </table>
            </div>
            <div v-if="selecao === 'Renovação'">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Departamento</th>
                            <th scope="col">Supervisor</th>
                            <th scope="col">Renovado para</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(estagiarioRenovado, indice) of estagiariosRenovados30Dias" 
                            :key="estagiarioRenovado.nome">
                            <th scope="row">{{ indice + 1}}</th>
                                <td>
                                    {{ estagiarioRenovado.nome.toUpperCase() }}
                                </td>
                            <td>{{ estagiarioRenovado.dep_hierarquico ? estagiarioRenovado.dep_hierarquico : 'NÃO CADASTRADO' }}</td>
                            <td>{{ estagiarioRenovado.supervisor.toUpperCase() }}</td>
                            <td v-if="estagiarioRenovado.dt_inicio_3_aditivo">
                                {{ estagiarioRenovado.dt_inicio_3_aditivo | dataFormatada}}
                            </td>
                            <td v-else-if="estagiarioRenovado.dt_inicio_2_aditivo">
                                {{ estagiarioRenovado.dt_inicio_2_aditivo | dataFormatada}}
                            </td>  
                            <td v-else>
                                {{ estagiarioRenovado.dt_inicio_1_aditivo | dataFormatada }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import { mapMutations, mapActions, mapGetters } from 'vuex';
import filtros from '../../mixins/filtros';
export default {
    data() {
        return {
            estagiariosContratados30Dias: {},
            estagiariosDesligados30Dias: {},
            estagiariosRenovados30Dias: {},
            selecao: 'Entradas'
        }
    },
    mixins: [filtros],
    beforeMount() { // TODO: Fazer o carregamento dos estagiarios caso o usuário aperte f5
        this.salvaEstagiariosContratados30dias();
        this.salvaEstagiariosDesligados30dias();
        this.salvaEstagiariosRenovados30dias();
        this.estagiariosContratados30Dias = this.getEstagiariosContratados30Dias();
        this.estagiariosDesligados30Dias = this.getEstagiariosDesligados30Dias();
        this.estagiariosRenovados30Dias = this.getEstagiariosRenovados30Dias();
    },
    methods: {
        ...mapActions(['salvaEstagiarios', 'salvaEstagiariosContratados30dias', 'salvaEstagiariosDesligados30dias', 'salvaEstagiariosRenovados30dias']),
        ...mapGetters(['getEstagiarios', 'getEstagiariosContratados30Dias', 'getEstagiariosDesligados30Dias', 'getEstagiariosRenovados30Dias']),
    }
}
</script>

<style>
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
}
</style>

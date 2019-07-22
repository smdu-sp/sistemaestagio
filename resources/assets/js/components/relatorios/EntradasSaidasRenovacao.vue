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
import filtros from '../../mixins/filtros';
export default {
    data() {
        return {
            estagiarios: {},
            estagiariosContratados30Dias: [],
            estagiariosDesligados30Dias: [],
            estagiariosRenovados30Dias: [],
            selecao: 'Entradas'
        }
    },
    mixins: [filtros],
    beforeMount() { // TODO: Fazer o carregamento dos estagiarios caso o usuário aperte f5
        this.salvaEstagiarios();
    },
    methods: {        salvaEstagiarios(){
            const uriEstagiarios = '/api/estagiarios'
            this.axios.get(uriEstagiarios)
            .then(response => {
                this.estagiarios = response.data;
                this.salvaEstagiariosContratados30dias();
                this.salvaEstagiariosDesligados30dias();
                this.salvaEstagiariosRenovados30dias();
            })
            .catch(error => {
                console.log("Erro: "+error)
            })
        },
        salvaEstagiariosContratados30dias() {
            let dataAtual = new Date();
            let dataAtualMenos30Dias = dataAtual.setDate(dataAtual.getDate() - 30);

            for(let i in this.estagiarios) {
                let dataEstagiario = this.estagiarios[i].dt_inicio
                let novaData = new Date(dataEstagiario);
                let novaDataFormatada = novaData.setDate(novaData.getDate());
                if(novaDataFormatada >= dataAtualMenos30Dias){
                    this.estagiariosContratados30Dias.push(this.estagiarios[i]);
                }
            }
        },
        salvaEstagiariosDesligados30dias() {
            let dataAtual = new Date();
            let dataAtualTime = dataAtual.setDate(dataAtual.getDate());
            let dataAtualMenos30Dias = dataAtual.setDate(dataAtual.getDate() - 30);

            for(let i in this.estagiarios) {
                let dataEstagiario = this.estagiarios[i].dt_termino
                let novaData = new Date(dataEstagiario);
                let novaDataFormatada = novaData.setDate(novaData.getDate());
                if(novaDataFormatada >= dataAtualMenos30Dias && novaDataFormatada <= dataAtualTime){
                    this.estagiariosDesligados30Dias.push(this.estagiarios[i]);
                }
            }
        },
        salvaEstagiariosRenovados30dias() {
            let dataAtual = new Date();
            let dataAtualMenos30Dias = dataAtual.setDate(dataAtual.getDate() - 30);

            for(let i in this.estagiarios) {
                var dataEstagiario1Aditivo = this.estagiarios[i].dt_inicio_1_aditivo;
                var dataEstagiario2Aditivo = this.estagiarios[i].dt_inicio_2_aditivo;
                var dataEstagiario3Aditivo = this.estagiarios[i].dt_inicio_3_aditivo;

                if(typeof(dataEstagiario1Aditivo) == 'null') {
                    return;
                } else {
                    var novaData1Aditivo = new Date(dataEstagiario1Aditivo);
                    var novaData1Formatada = novaData1Aditivo.setDate(novaData1Aditivo.getDate());
                }

                if(typeof(dataEstagiario2Aditivo) == 'null') {
                    var novaData2Aditivo = new Date(dataEstagiario2Aditivo);
                    var novaData2Formatada = novaData2Aditivo.setDate(novaData2Aditivo.getDate());
                }

                if(typeof(dataEstagiario3Aditivo) == 'null') {
                    return;
                } else {
                    var novaData3Aditivo = new Date(dataEstagiario3Aditivo);
                    var novaData3Formatada = novaData3Aditivo.setDate(novaData3Aditivo.getDate());
                }
                
                if(novaData1Formatada >= dataAtualMenos30Dias){
                    this.estagiariosRenovados30Dias.push(this.estagiarios[i]);
                } else if (novaData2Formatada >= dataAtualMenos30Dias) {
                    this.estagiariosRenovados30Dias.push(this.estagiarios[i]);
                } else if (novaData3Formatada >= dataAtualMenos30Dias) {
                    this.estagiariosRenovados30Dias.push(this.estagiarios[i]);
                }
            }
        }
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

<template>
  <div id="printable">
    <h1 class="d-inline-block">Estagiários Contratados</h1>
    <botao-imprimir-component></botao-imprimir-component>
    <botao-excel nome="estagiarios_contratados"></botao-excel>
    <div class="col-md-12">
      <div id="divTabela">
        <h5 class="alert alert-info">Total: {{ estagiariosContratados.length }}</h5>
        <table class="table table-bordered table-hover">
          <thead class="thead-dark">
            <tr class="centraliza-texto">
              <th scope="col">#</th>
              <th scope="col">Nome</th>
              <th scope="col">Departamento</th>
              <th scope="col">Supervisor</th>
              <th scope="col">Admissão</th>
              <th scope="col">Término de Contrato</th>
              <th scope="col">Horas Estagiadas</th>
              <th scope="col">Instituição de Ensino</th>
            </tr>
          </thead>
          <tbody :key="requisicoes">
            <tr
              v-for="(estagiario, indice) of estagiariosOrdenados"
              :key="estagiario.cod_estudante"
            >
              <td>{{ indice + 1 }}</td>
              <td>{{ estagiario.nome }}</td>
              <td>{{ estagiario.dep_hierarquico }}</td>
              <td>{{ estagiario.supervisor }}</td>
              <td>{{ estagiario.dt_inicio | dataFormatada }}</td>
              <td>{{ estagiario.dataTermino | dataFormatada }}</td>
              <td>{{ estagiario.horasEstagiadas }}</td>
              <td>{{ estagiario.instituicoes ? estagiario.instituicoes.toUpperCase() : '' }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import filtros from "../../mixins/filtros";
import _ from "lodash";

export default {
  data() {
    return {
      estagiariosContratados: [],
      requisicoes: 0,
      todosFeriados: []
    };
  },
  computed: {
    estagiariosOrdenados() {
      return _.orderBy(this.estagiariosContratados, "nome");
    }
  },
  beforeMount() {
    this.retornaEstagiarios();
  },
  mixins: [filtros],
  methods: {
    retornaEstagiarios() {
      const uriEstagiarios = "/api/estagiarios";

      this.axios
              .get("/api/feriados/all")
              .then(response => {
                this.todosFeriados = response.data;
                      this.axios
        .get(uriEstagiarios)
        .then(response => {
          for (let i in response.data) {
            if (response.data[i].desligado === null) {
              response.data[i].nome = response.data[i].nome.toUpperCase();
              this.estagiariosContratados.push(response.data[i]);
            }
          }
          for (var i in this.estagiariosContratados) {
            if (this.estagiariosContratados[i].dt_termino_3_aditivo !== null) {
              this.estagiariosContratados[i].dataTermino = this.estagiariosContratados[i].dt_termino_3_aditivo;
            } else if (
              this.estagiariosContratados[i].dt_termino_2_aditivo !== null
            ) {
              this.estagiariosContratados[i].dataTermino = this.estagiariosContratados[i].dt_termino_2_aditivo;
            } else if (
              this.estagiariosContratados[i].dt_termino_1_aditivo !== null
            ) {
              this.estagiariosContratados[i].dataTermino = this.estagiariosContratados[i].dt_termino_1_aditivo;
            } else {
              this.estagiariosContratados[i].dataTermino = this.estagiariosContratados[i].dt_termino;
            }
            this.estagiariosContratados[i].instituicoes = this.estagiariosContratados[i].instituicao_ensino;

            let inicio = this.estagiariosContratados[i].dt_inicio
              ? this.estagiariosContratados[i].dt_inicio.substring(0, 10)
              : "0000-00-00";
            let final = this.estagiariosContratados[i].dataTermino
              ? this.estagiariosContratados[i].dataTermino.substring(0, 10)
              : "0000-00-00";
            let arrIndex = i;
            
            // Calcula horas uteis de estágio (Sem recesso)
            var start = new Date(this.estagiariosContratados[i].dt_inicio).getTime();
            var end = new Date(this.estagiariosContratados[i].dt_termino).getTime();
            var diffDays = end - start;
            var amountDays = diffDays / 86400000;
            var businessDays = 0;
            var businessHours = 0;
            var verifyDays = 0;

            for(var l = 0; l < amountDays; l++){
              verifyDays = new Date(start + l * 86400000 - 10800);
              if(this.verificaDiasUteis(verifyDays)){
                businessDays++;
              }
            }
            businessHours = businessDays * 4;
            // TODO - está calculando um dia a mais //
            console.log(this.estagiariosContratados[i].nome, businessHours);

            // Calcula dias uteis em dias de recesso;
            var nome = this.estagiariosContratados[i].nome;
            var diasAVerificar;
            var diasUteis = 0;
            var horasUteisRecesso = 0;

            for (var k = 1; k <= 7; k++) { // iteração para usar nas 7 possíveis solicitações de recesso
              if (this.estagiariosContratados[i]["dt_inicial_" + k] !== null) {
                var inicioRecesso = new Date(this.estagiariosContratados[i]["dt_inicial_" + k]).getTime();
                var terminoRecesso = new Date(this.estagiariosContratados[i]["dt_termino_" + k]).getTime();

                var diffDias = terminoRecesso - inicioRecesso;
                var numDias = diffDias / 86400000; // Qtd de dias totais

                for (var j = 0; j < numDias; j++) { // iteração para contar numero de dias entre a dt_inicio até dt_termino
                  diasAVerificar = new Date(inicioRecesso + j * 86400000);
                  if (this.verificaDiasUteis(diasAVerificar)) {
                    diasUteis++;
                  }
                }
              }
            }
            horasUteisRecesso = diasUteis * 4;
            // console.log(nome, horasUteisRecesso); // saída de dados;
            this.axios
              .get("/api/feriados/periodo/" + inicio + "/" + final)
              .then(response => {
                this.estagiariosContratados[arrIndex].horasEstagiadas =
                  (parseInt(response.data) * 4);
                this.requisicoes++; // Atualiza componentkey da tabela para forçar atualização do conteúdo
              })
              .catch(err => {
                console.error(err);
              });
            }
          })
        .catch(error => {
          this.msg.success = false;
          this.msg.error = true;
          this.msg.erro = "Erro ao retornar estagiários do banco";
        });
      }) // fim feriados
    .catch(err => {
      console.error(err);
    });


    },
    verificaDiasUteis(stringDia) {
      var data = new Date(stringDia);

      // verifica se é feriado
      for (var i in this.todosFeriados){
        if (data.getTime()/1000 == this.todosFeriados[i]+10800) { // adicionado 10800 para 3 horas (UTC-3)
          return false;
        }
      }
      
      // verifica se é FDS
      if (data.getDay() == 0 || data.getDay() == 6) { // 0 para domingo e 6 para sábado
        return false;
      }
      return true;
    },

    calculoHoras(inicial, final) {
      if (inicial == null || final == null) {
        return "";
      }
      inicial = inicial.substring(0, 10);
      final = final.substring(0, 10);
      const uriFeriados = "/api/feriados/periodo/" + inicial + "/" + final;

      this.axios.get(uriFeriados).then(response => {
        return parseInt(response.data) * 4;
      });
    }
  }
};
</script>
  
<style lang="stylus">
.centraliza-texto {
  text-align: center;
}
</style>
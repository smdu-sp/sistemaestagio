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
      requisicoes: 0
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
              this.estagiariosContratados[
                i
              ].dataTermino = this.estagiariosContratados[
                i
              ].dt_termino_3_aditivo;
            } else if (
              this.estagiariosContratados[i].dt_termino_2_aditivo !== null
            ) {
              this.estagiariosContratados[
                i
              ].dataTermino = this.estagiariosContratados[
                i
              ].dt_termino_2_aditivo;
            } else if (
              this.estagiariosContratados[i].dt_termino_1_aditivo !== null
            ) {
              this.estagiariosContratados[
                i
              ].dataTermino = this.estagiariosContratados[
                i
              ].dt_termino_1_aditivo;
            } else {
              this.estagiariosContratados[
                i
              ].dataTermino = this.estagiariosContratados[i].dt_termino;
            }
            this.estagiariosContratados[
              i
            ].instituicoes = this.estagiariosContratados[i].instituicao_ensino;

            let inicio = this.estagiariosContratados[i].dt_inicio
              ? this.estagiariosContratados[i].dt_inicio.substring(0, 10)
              : "0000-00-00";
            let final = this.estagiariosContratados[i].dataTermino
              ? this.estagiariosContratados[i].dataTermino.substring(0, 10)
              : "0000-00-00";
            let arrIndex = i;

            this.axios
              .get("/api/feriados/periodo/" + inicio + "/" + final)
              .then(response => {
                this.estagiariosContratados[arrIndex].horasEstagiadas =
                  parseInt(response.data) * 4;
                this.requisicoes++; // Atualiza componentkey da tabela para forçar atualização do conteúdo
              })
              .catch(err => {
                console.error(err);
              });
            // TODO Calcular dias uteis em dias de recesso;
            // Calcula dias do recesso
            var nome = this.estagiariosContratados[i].nome;

            var diasAVerificar;
            var diasUteis = 0;
            var recessoTotal = 0;

            if (this.estagiariosContratados[i].dt_inicial_1 !== null) {
              var inicioRecesso_1 = new Date(
                this.estagiariosContratados[i].dt_inicial_1
              ).getTime();
              var terminoRecesso_1 = new Date(
                this.estagiariosContratados[i].dt_termino_1
              ).getTime();

              var diffDias = terminoRecesso_1 - inicioRecesso_1;
              var numDias = diffDias / 86400000;
              for (var j = 0; j <= numDias; j++) {
                diasAVerificar = new Date(inicioRecesso_1 + j * 86400000);
                if (this.verificaDiasUteis(diasAVerificar)) {
                  diasUteis++;
                }
              }
              recessoTotal = diasUteis;
            }
            if (this.estagiariosContratados[i].dt_inicial_2 !== null) {
              var inicioRecesso_2 = new Date(
                this.estagiariosContratados[i].dt_inicial_2
              ).getTime();
              var terminoRecesso_2 = new Date(
                this.estagiariosContratados[i].dt_termino_2
              ).getTime();

              var diffDias = terminoRecesso_2 - inicioRecesso_2;
              var numDias = diffDias / 86400000;
              for (var j = 0; j <= numDias; j++) {
                diasAVerificar = new Date(inicioRecesso_2 + j * 86400000);
                if (this.verificaDiasUteis(diasAVerificar)) {
                  diasUteis++;
                  
                }
              }
              recessoTotal = diasUteis;
            }
          if (this.estagiariosContratados[i].dt_inicial_3 !== null) {
              var inicioRecesso_3 = new Date(
                this.estagiariosContratados[i].dt_inicial_3
              ).getTime();
              var terminoRecesso_3 = new Date(
                this.estagiariosContratados[i].dt_termino_3
              ).getTime();

              var diffDias = terminoRecesso_3 - inicioRecesso_3;
              var numDias = diffDias / 86400000;
              for (var j = 0; j <= numDias; j++) {
                diasAVerificar = new Date(inicioRecesso_3 + j * 86400000);
                if (this.verificaDiasUteis(diasAVerificar)) {
                  diasUteis++;
                  
                }
              }
              recessoTotal = diasUteis;
            }
            if (this.estagiariosContratados[i].dt_inicial_4 !== null) {
              var inicioRecesso_4 = new Date(
                this.estagiariosContratados[i].dt_inicial_4
              ).getTime();
              var terminoRecesso_4 = new Date(
                this.estagiariosContratados[i].dt_termino_4
              ).getTime();

              var diffDias = terminoRecesso_4 - inicioRecesso_4;
              var numDias = diffDias / 86400000;
              for (var j = 0; j <= numDias; j++) {
                diasAVerificar = new Date(inicioRecesso_4 + j * 86400000);
                if (this.verificaDiasUteis(diasAVerificar)) {
                  diasUteis++;
                  
                }
              }
              recessoTotal = diasUteis;
            }
            if (this.estagiariosContratados[i].dt_inicial_5 !== null) {
              var inicioRecesso_5 = new Date(
                this.estagiariosContratados[i].dt_inicial_5
              ).getTime();
              var terminoRecesso_5 = new Date(
                this.estagiariosContratados[i].dt_termino_5
              ).getTime();

              var diffDias = terminoRecesso_5 - inicioRecesso_5;
              var numDias = diffDias / 86400000;
              for (var j = 0; j <= numDias; j++) {
                diasAVerificar = new Date(inicioRecesso_5 + j * 86400000);
                if (this.verificaDiasUteis(diasAVerificar)) {
                  diasUteis++;
                  
                }
              }
              recessoTotal = diasUteis;
            }
            if (this.estagiariosContratados[i].dt_inicial_6 !== null) {
              var inicioRecesso_6 = new Date(
                this.estagiariosContratados[i].dt_inicial_6
              ).getTime();
              var terminoRecesso_6 = new Date(
                this.estagiariosContratados[i].dt_termino_6
              ).getTime();

              var diffDias = terminoRecesso_6 - inicioRecesso_6;
              var numDias = diffDias / 86400000;
              for (var j = 0; j <= numDias; j++) {
                diasAVerificar = new Date(inicioRecesso_6 + j * 86400000);
                if (this.verificaDiasUteis(diasAVerificar)) {
                  diasUteis++;
                  
                }
              }
              recessoTotal = diasUteis;
            }
            if (this.estagiariosContratados[i].dt_inicial_7 !== null) {
              var inicioRecesso_7 = new Date(
                this.estagiariosContratados[i].dt_inicial_7
              ).getTime();
              var terminoRecesso_7 = new Date(
                this.estagiariosContratados[i].dt_termino_7
              ).getTime();

              var diffDias = terminoRecesso_7 - inicioRecesso_7;
              var numDias = diffDias / 86400000;
              for (var j = 0; j <= numDias; j++) {
                diasAVerificar = new Date(inicioRecesso_7 + j * 86400000);
                if (this.verificaDiasUteis(diasAVerificar)) {
                  diasUteis++;
                }
              }
              recessoTotal = diasUteis;
            }
            
            console.log(nome, recessoTotal);
          }
          
        })
        .catch(error => {
          this.msg.success = false;
          this.msg.error = true;
          this.msg.erro = "Erro ao retornar estagiários do banco";
        });
    },
    verificaDiasUteis(stringDia) {
      var data = new Date(stringDia);
      // verifica se é FDS
      if (data.getDay() == 0 || data.getDay() == 6) {
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
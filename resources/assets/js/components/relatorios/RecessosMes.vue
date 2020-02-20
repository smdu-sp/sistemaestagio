<template>
  <div>
    <h1 class="text-center">Recessos do Mês</h1>
    <div class="col-md-12">
      <div class="row">
        <div class="form-group">
          <div class="col-md-12 row">
            <div class="col-md-4 space margem row">
              <label for>Mês</label>
              <select
                name="selectMes"
                id="mesRecesso"
                class="form-control"
                v-model="mesEscolhido"
                @change="atualizaRelatorio"
              >
                <option value="0">Janeiro</option>
                <option value="1">Fevereiro</option>
                <option value="2">Março</option>
                <option value="3">Abril</option>
                <option value="4">Maio</option>
                <option value="5">Junho</option>
                <option value="6">Julho</option>
                <option value="7">Agosto</option>
                <option value="8">Setembro</option>
                <option value="9">Outubro</option>
                <option value="10">Novembro</option>
                <option value="11">Dezembro</option>
              </select>
            </div>
            <div class="col-md-4 row space separador">
              <label for>Ano</label>
              <input
                type="number"
                id="anoRecesso"
                min="2013"
                v-model="anoEscolhido"
                @change="atualizaRelatorio"
                class="form-control"
                placeholder="Digite ano"
              />
            </div>
            <div class="d-flex mb-4 space separador">
              <botao-imprimir-component class="alinha-icons"></botao-imprimir-component>
              <botao-excel nome="Recessos-do-mes" class="alinha-icons"></botao-excel>
            </div>
          </div>
          <div id="divTabela" class="space">
            <table class="table table-bordered table-hover">
              <thead class="thead-dark">
                <th scope="row" class="text-center">Nome</th>
                <th scope="row" class="text-center">Início recesso</th>
                <th scope="row" class="text-center">Término recesso</th>
                <th scope="row" class="text-center">Total de dias</th>
                <th scope="row" class="text-center">Dias úteis</th>
              </thead>
              <tbody>
                <tr v-for="estagiario in estagiariosRecessoEscolhido">
                  <td>{{ estagiario.nome.toUpperCase() }}</td>
                  <td>{{ converteData(estagiario.inicioRecesso) }}</td>
                  <td>{{ converteData(estagiario.terminoRecesso) }}</td>
                  <td>{{ calculaDias(estagiario.inicioRecesso, estagiario.terminoRecesso) }}</td>
                  <td>{{  }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      dias: [],
      estagiariosComRecesso: [],
      estagiariosRecessoEscolhido: [],
      mesEscolhido: "0",
      anoEscolhido: ""
    };
  },
  props: ["post"],
  beforeMount() {
    this.retornaEstagiarios();
  },
  mounted() {
    this.atualizaRelatorio();
  },
  methods: {
    atualizaRelatorio() {
      this.estagiariosRecessoEscolhido = [];
      for (var i in this.estagiariosComRecesso) {
        for (var j = 1; j <= 7; j++) {
          var dataRecesso = new Date(
            this.estagiariosComRecesso[i]["dt_inicial_" + j]
          );
          if (
            dataRecesso.getFullYear() == this.anoEscolhido &&
            dataRecesso.getMonth() == this.mesEscolhido
          ) {
            var novoEstagiario = {};
            novoEstagiario.nome = this.estagiariosComRecesso[i].nome;
            novoEstagiario.inicioRecesso = this.estagiariosComRecesso[i][
              "dt_inicial_" + j
            ];
            novoEstagiario.terminoRecesso = this.estagiariosComRecesso[i][
              "dt_termino_" + j
            ];
            novoEstagiario.diasSolicitados = this.estagiariosComRecesso[i][
              "qt_dias_solicitada_" + j
            ];
            if (this.estagiariosComRecesso[i]["dt_termino_" + j] == null) {
              // this.estagiariosRecessoEscolhido.pull(novoEstagiario);
              var novaData = new Date(
                  this.estagiariosComRecesso[i]["dt_inicial_" + j]).getTime() +
                  (this.estagiariosComRecesso[i]["qt_dias_solicitada_" + j] * 86400000);
                  
                  novaData = new Date(novaData).toLocaleString();

              novoEstagiario.terminoRecesso = novaData;
            }
            this.estagiariosRecessoEscolhido.push(novoEstagiario);
          }
        }
      }
    },
    calculaDias(dataInicial, dataTermino) {
      let total =
        (new Date(dataTermino) - new Date(dataInicial)) / 86400000 + 1;
      return total.toFixed(0);
    },
    converteData(dataAConverter) {
      let ano = new Date(dataAConverter).getFullYear();
      let mes = new Date(dataAConverter).getMonth() + 1;
      let dia = new Date(dataAConverter).getDate();

      let dataConvertida = dia + "/" + mes + "/" + ano;
      return dataConvertida;
    },

    retornaEstagiarios() {
      const uriEstagiarios = "/api/estagiarios";

      this.axios
        .get(uriEstagiarios)
        .then(response => {
          for (let i in response.data) {
            if (response.data[i].qt_dias_gozados > "0") {
              this.estagiariosComRecesso.push(response.data[i]);
            }
          }
        })
        .catch(error => {
          this.msg.success = false;
          this.msg.error = true;
          this.msg.erro = "Erro ao retornar estagiários do banco";
        });
    }
  }
};
</script>

<style scoped>
.space {
  margin-top: 15px;
}
.margem {
  margin-left: -8px;
}
.separador {
  margin-left: 20px;
}
.descer-elemento {
  margin-top: 30px;
}
.alinha-icons {
  margin-bottom: -20px;
  margin-top: 35px;
}
</style>
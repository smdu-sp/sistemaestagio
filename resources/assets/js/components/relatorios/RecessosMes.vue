<template>
  <div class="row">
    <div class="form-group">
      <div class="col-md-4">
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
      <div class="col-md-3">
        <label for>Ano</label>
        <input type="number" id="anoRecesso" min="2013" v-model="anoEscolhido"
          @change="atualizaRelatorio"
        />
      </div>
      <div>
        <table class="table table-bordered table-hover">
          <thead class="thead-dark">
            <th scope="row" class="text-center">Nome</th>
            <th scope="row" class="text-center">Início recesso</th>
            <th scope="row" class="text-center">Término recesso</th>
            <th scope="row" class="text-center">Total de dias</th>
          </thead>
          <tbody>
            <tr v-for="estagiario in estagiariosRecessoEscolhido">
              <td>{{ estagiario.nome }}</td>
              <td>{{ converteData(estagiario.inicioRecesso) }}</td>
              <td>{{ converteData(estagiario.terminoRecesso) }}</td>
              <td>{{ calculaDias(estagiario.inicioRecesso, estagiario.terminoRecesso) }}</td>
            </tr>
          </tbody>
        </table>
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
      mesEscolhido: "0",
      anoEscolhido: "2019",
      estagiariosRecessoEscolhido: []
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
            // var novoEstagiario = this.estagiariosComRecesso[i];
            var novoEstagiario = {};
            novoEstagiario.nome = this.estagiariosComRecesso[i].nome;            
            novoEstagiario.inicioRecesso = this.estagiariosComRecesso[i]["dt_inicial_" + j];
            novoEstagiario.terminoRecesso = this.estagiariosComRecesso[i]["dt_termino_" + j];

            this.estagiariosRecessoEscolhido.push(novoEstagiario);
          }
        }
      }
    },
    calculaDias(dataInicial, dataTermino) {
      let total =
        (new Date(dataTermino) - new Date(dataInicial)) / 86400000 + 1;
          return total;
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
</style>
<template>
  <div>
    <h1 class="text-center">Relatório de Cotas</h1>
    <div class="col-md-12">
      <div class="d-flex mb-12">
        <botao-imprimir-component></botao-imprimir-component>
        <botao-excel nome="Cotas"></botao-excel>
      </div>

      <div id="divTabela">
        <table class="table table-bordered table-hover">
          <thead class="thead-dark">
            <th class="text-center">Etnia</th>
            <th class="text-center">Gênero</th>
            <th class="text-center">Quantidade</th>
            <th class="text-center">%</th>
          </thead>
          <tbody>
            <tr>
              <td rowspan="2" class="vertical">Brancos</td>
              <td>Masculino</td>
              <td>{{ estagiariosBrancosMasculinos.length }}</td>
              <td>{{ (estagiariosBrancosMasculinos.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
            </tr>
            <tr>
              <td>Feminino</td>
              <td>{{ estagiariosBrancosFemininos.length }}</td>
              <td>{{ (estagiariosBrancosFemininos.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
            </tr>
            <tr>
              <td rowspan="2" class="vertical">Pardos</td>
              <td>Masculino</td>
              <td>{{ estagiariosPardosMasculinos.length }}</td>
              <td>{{ (estagiariosPardosMasculinos.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
            </tr>
            <tr>
              <td>Feminino</td>
              <td>{{ estagiariosPardosFemininos.length }}</td>
              <td>{{ (estagiariosPardosFemininos.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
            </tr>
            <tr>
              <td rowspan="2" class="vertical">Amarelos</td>
              <td>Masculino</td>
              <td>{{ estagiariosAmarelosMasculinos.length }}</td>
              <td>{{ (estagiariosAmarelosMasculinos.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
            </tr>
            <tr>
              <td>Feminino</td>
              <td>{{ estagiariosAmarelosFemininos.length }}</td>
              <td>{{ (estagiariosAmarelosFemininos.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
            </tr>
            <tr>
              <td rowspan="2" class="vertical">Negros</td>
              <td>Masculino</td>
              <td>{{ estagiariosPretosMasculinos.length }}</td>
              <td>{{ (estagiariosPretosMasculinos.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
            </tr>
            <tr>
              <td>Feminino</td>
              <td>{{ estagiariosPretosFemininos.length }}</td>
              <td>{{ (estagiariosPretosFemininos.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
            </tr>
            <tr>
              <td rowspan="2" class="vertical">Indígenas</td>
              <td>Masculino</td>
              <td>{{ estagiariosIndigenasMasculinos.length }}</td>
              <td>{{ (estagiariosIndigenasMasculinos.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
            </tr>
            <tr>
              <td>Feminino</td>
              <td>{{ estagiariosIndigenasFemininos.length }}</td>
              <td>{{ (estagiariosIndigenasFemininos.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
            </tr>
            <tr>
              <td rowspan="2" class="vertical">Não Definidos</td>
              <td>Masculino</td>
              <td>{{ estagiariosNaoDefinidosMasculinos.length }}</td>
              <td>{{ (estagiariosNaoDefinidosMasculinos.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
            </tr>
            <tr>
              <td>Feminino</td>
              <td>{{ estagiariosNaoDefinidosFemininos.length }}</td>
              <td>{{ (estagiariosNaoDefinidosFemininos.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
            </tr>
            <tr>
              <td>Total</td>
              <td colspan="2" class="text-center">{{ estagiariosContratados.length }}</td>
              <td>100.00</td>
            </tr>
          </tbody>
          <thead class="thead-dark">
            <th class="text-center">Deficientes</th>
            <th class="text-center">Gênero</th>
            <th class="text-center">Quantidade</th>
            <th class="text-center">%</th>
          </thead>
          <tbody>
            <tr>
              <td rowspan="2" class="vertical">Deficientes</td>
              <td>Masculino</td>
              <td>{{ estagiariosDeficientesMasculinos.length }}</td>
              <td>{{ (estagiariosDeficientesMasculinos.length / estagiariosDeficientes.length) * 100 | duasCasasDecimais }}</td>
            </tr>
            <tr>
              <td>Feminino</td>
              <td>{{ estagiariosDeficientesFemininos.length }}</td>
              <td>{{ (estagiariosDeficientesFemininos.length / estagiariosDeficientes.length) * 100 | duasCasasDecimais }}</td>
            </tr>
            <tr>
              <td>Total</td>
              <td colspan="2" class="text-center">{{ estagiariosDeficientes.length }}</td>
              <td>100</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import filtros from "../../mixins/filtros";
export default {
  data() {
    return {
      filtro: "Todas",
      estagiarios: [],
      estagiariosContratados: [],
      estagiariosBrancos: [],
      estagiariosPardos: [],
      estagiariosAmarelos: [],
      estagiariosPretos: [],
      estagiariosIndigenas: [],
      estagiariosNaoDefinidos: [],
      estagiariosDeficientes: [],
      estagiariosOrdem: [],
      estagiariosBrancosMasculinos: [],
      estagiariosBrancosFemininos: [],
      estagiariosPardosMasculinos: [],
      estagiariosPardosFemininos: [],
      estagiariosAmarelosMasculinos: [],
      estagiariosAmarelosFemininos: [],
      estagiariosPretosMasculinos: [],
      estagiariosPretosFemininos: [],
      estagiariosIndigenasMasculinos: [],
      estagiariosIndigenasFemininos: [],
      estagiariosNaoDefinidosMasculinos: [],
      estagiariosNaoDefinidosFemininos: [],
      estagiariosDeficientesMasculinos: [],
      estagiariosDeficientesFemininos: [],
      msg: {
        error: false,
        success: false
      }
    };
  },
  mixins: [filtros],
  beforeMount() {
    this.retornaEstagiarios();
  },
  filters: {
    duasCasasDecimais(numero) {
      return numero.toFixed(2);
    }
  },
  methods: {
    salvaEstagiariosContratados() {
      for (let i in this.estagiarios) {
        if (this.estagiarios[i].situacao == 1) {
          this.estagiariosContratados.push(this.estagiarios[i]);
        } else if (
          this.estagiarios[i].deficiencia == 1 &&
          this.estagiarios[i].situacao == 1
        ) {
          this.estagiariosContratados.push(this.estagiarios[i]);
        }
      }
      this.classificaEstagiarios();
    },
    classificaEstagiarios() {
      for (var i in this.estagiariosContratados) {
        if (this.estagiariosContratados[i].raca_cor == 1) {
          this.estagiariosBrancos.push(this.estagiariosContratados[i]);
        } else if (this.estagiariosContratados[i].raca_cor == 2) {
          this.estagiariosPardos.push(this.estagiariosContratados[i]);
        } else if (this.estagiariosContratados[i].raca_cor == 3) {
          this.estagiariosAmarelos.push(this.estagiariosContratados[i]);
        } else if (this.estagiariosContratados[i].raca_cor == 4) {
          this.estagiariosPretos.push(this.estagiariosContratados[i]);
        } else if (this.estagiariosContratados[i].raca_cor == 5) {
          this.estagiariosIndigenas.push(this.estagiariosContratados[i]);
        } else if (this.estagiariosContratados[i].raca_cor == 0) {
          this.estagiariosNaoDefinidos.push(this.estagiariosContratados[i]);
        }
        if (this.estagiariosContratados[i].deficiencia == 1) {
          this.estagiariosDeficientes.push(this.estagiariosContratados[i]);
        }
      }
      for (var i in this.estagiariosBrancos) {
        if (
          this.estagiariosBrancos[i].sexo == "MASCULINO" ||
          this.estagiariosBrancos[i].sexo == "Masculino"
        ) {
          this.estagiariosBrancosMasculinos.push(this.estagiariosBrancos[i]);
        } else if (
          this.estagiariosBrancos[i].sexo == "FEMININO" ||
          this.estagiariosBrancos[i].sexo == "Feminino"
        ) {
          this.estagiariosBrancosFemininos.push(this.estagiariosBrancos[i]);
        }
      }
      for (var i in this.estagiariosPardos) {
        if (
          this.estagiariosPardos[i].sexo == "MASCULINO" ||
          this.estagiariosPardos[i].sexo == "Masculino"
        ) {
          this.estagiariosPardosMasculinos.push(this.estagiariosPardos[i]);
        } else if (
          this.estagiariosPardos[i].sexo == "FEMININO" ||
          this.estagiariosPardos[i].sexo == "Feminino"
        ) {
          this.estagiariosPardosFemininos.push(this.estagiariosPardos[i]);
        }
      }
      for (var i in this.estagiariosAmarelos) {
        if (
          this.estagiariosAmarelos[i].sexo == "MASCULINO" ||
          this.estagiariosAmarelos[i].sexo == "Masculino"
        ) {
          this.estagiariosAmarelosMasculinos.push(this.estagiariosAmarelos[i]);
        } else if (
          this.estagiariosAmarelos[i].sexo == "FEMININO" ||
          this.estagiariosAmarelos[i].sexo == "Feminino"
        ) {
          this.estagiariosAmarelosFemininos.push(this.estagiariosAmarelos[i]);
        }
      }
      for (var i in this.estagiariosPretos) {
        if (
          this.estagiariosPretos[i].sexo == "MASCULINO" ||
          this.estagiariosPretos[i].sexo == "Masculino"
        ) {
          this.estagiariosPretosMasculinos.push(this.estagiariosPretos[i]);
        } else if (
          this.estagiariosPretos[i].sexo == "FEMININO" ||
          this.estagiariosPretos[i].sexo == "Feminino"
        ) {
          this.estagiariosPretosFemininos.push(this.estagiariosPretos[i]);
        }
      }
      for (var i in this.estagiariosIndigenas) {
        if (
          this.estagiariosIndigenas[i].sexo == "MASCULINO" ||
          this.estagiariosIndigenas[i].sexo == "Masculino"
        ) {
          this.estagiariosIndigenasMasculinos.push(
            this.estagiariosIndigenas[i]
          );
        } else if (
          this.estagiariosIndigenas[i].sexo == "FEMININO" ||
          this.estagiariosIndigenas[i].sexo == "Feminino"
        ) {
          this.estagiariosIndigenasFemininos.push(this.estagiariosIndigenas[i]);
        }
      }
      for (var i in this.estagiariosNaoDefinidos) {
        if (
          this.estagiariosNaoDefinidos[i].sexo == "MASCULINO" ||
          this.estagiariosNaoDefinidos[i].sexo == "Masculino"
        ) {
          this.estagiariosNaoDefinidosMasculinos.push(
            this.estagiariosNaoDefinidos[i]
          );
        } else if (
          this.estagiariosNaoDefinidos[i].sexo == "FEMININO" ||
          this.estagiariosNaoDefinidos[i].sexo == "Feminino"
        ) {
          this.estagiariosNaoDefinidosFemininos.push(
            this.estagiariosNaoDefinidos[i]
          );
        }
      }
      for (var i in this.estagiariosDeficientes) {
        if (
          this.estagiariosDeficientes[i].sexo == "MASCULINO" ||
          this.estagiariosDeficientes[i].sexo == "Masculino"
        ) {
          this.estagiariosDeficientesMasculinos.push(
            this.estagiariosDeficientes[i]
          );
        } else if (
          this.estagiariosDeficientes[i].sexo == "FEMININO" ||
          this.estagiariosDeficientes[i].sexo == "Feminino"
        ) {
          this.estagiariosDeficientesFemininos.push(
            this.estagiariosDeficientes[i]
          );
        }
      }
    },
    retornaEstagiarios() {
      const uriEstagiarios = "/api/estagiarios";

      this.axios
        .get(uriEstagiarios)
        .then(response => {
          this.estagiarios = response.data;
          this.msg.error = false;
          this.msg.success = true;
          this.salvaEstagiariosContratados();
        })
        .catch(error => {
          this.msg.success = false;
          this.msg.error = true;
        });
    }
  }
};
</script>

<style scoped>
.vertical {
  vertical-align: middle;
}
</style>

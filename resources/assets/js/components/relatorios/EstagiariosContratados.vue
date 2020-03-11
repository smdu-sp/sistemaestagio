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
            
            let inicio = this.estagiariosContratados[i].dt_inicio ? (this.estagiariosContratados[i].dt_inicio).substring(0, 10) : "0000-00-00";
            let final = this.estagiariosContratados[i].dataTermino ? (this.estagiariosContratados[i].dataTermino).substring(0, 10) : "0000-00-00";
            let arrIndex = i;
            this.axios.get("/api/feriados/periodo/"+inicio+"/"+final).then(response => {
              this.estagiariosContratados[arrIndex].horasEstagiadas = parseInt(response.data)*4;
              this.requisicoes++; // Atualiza componentkey da tabela para forçar atualização do conteúdo
            }).catch(err => {
              console.error(err);
            })
          }
        })
        .catch(error => {
          this.msg.success = false;
          this.msg.error = true;
          this.msg.erro = "Erro ao retornar estagiários do banco";
        });
    },

    calculoHoras(inicial, final) {
      if (inicial == null || final == null) {
        return '';
      }
      inicial = inicial.substring(0, 10);
      final = final.substring(0, 10);
      const uriFeriados = "/api/feriados/periodo/"+inicial+"/"+final;
      
      this.axios.get(uriFeriados).then(response => {
        return parseInt(response.data)*4;
      })     
    }
  }
};
</script>
  
<style lang="stylus">
  .centraliza-texto {
    text-align: center; 
  }
</style>
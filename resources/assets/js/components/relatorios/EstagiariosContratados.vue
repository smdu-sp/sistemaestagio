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
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nome</th>
              <th scope="col">Departamento</th>
              <th scope="col">Supervisor</th>
              <th scope="col">Admissão</th>
              <th scope="col">Término de Contrato</th>
              <th scope="col">Horas Estagiadas</th>
            </tr>
          </thead>
          <tbody>
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
      estagiariosContratados: []
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
              }
              else if (this.estagiariosContratados[i].dt_termino_2_aditivo !== null) {
                  this.estagiariosContratados[i].dataTermino = this.estagiariosContratados[i].dt_termino_2_aditivo;
              }
              else if (this.estagiariosContratados[i].dt_termino_1_aditivo !== null) {
                  this.estagiariosContratados[i].dataTermino = this.estagiariosContratados[i].dt_termino_1_aditivo;
              }
              else {
                  this.estagiariosContratados[i].dataTermino = this.estagiariosContratados[i].dt_termino;
              }
          }
        
        // if (estagiariosContratados.data[i].dt_termino_3_aditivo !== null) {
        //   this.dataTermino.push(estagiariosContratados.data[i].dt_termino_3_aditivo);
        // } else if (estagiariosContratados.data[i].dt_termino_2_aditivo !== null) {
        //   this.dataTermino.push(estagiariosContratados.data[i].dt_termino_2_aditivo);
        // } else if (estagiariosContratados.data[i].dt_termino_1_aditivo !== null) {
        //   this.dataTermino.push(estagiariosContratados.data[i].dt_termino_1_aditivo);
        // } else {
        //   this.dataTermino.push(estagiariosContratados.data[i].dt_termino);
        // }
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

<style lang="stylus"></style>
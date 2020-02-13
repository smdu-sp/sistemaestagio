<template>
  <form @submit.prevent="inserirEstagiario" method="patch">
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label for>Qtd dias legais</label>
          <input type="number" class="form-control" readonly v-model="post.diasFerias" />
        </div>
      </div>
      <div class="col-md-3 ml-2">
        <div class="form-group">
          <label for>Qtd dias Gozados</label>
          <input type="number" class="form-control" readonly v-model="post.qt_dias_gozados" />
        </div>
      </div>
      <div class="col-md-3 ml-2">
        <label for>Qtd dias Restantes</label>
        <div class="form-inline">
          <div class="form-group">
            <input type="number" class="form-control" readonly v-model="post.qt_dias_restantes" />
          </div>
        </div>
      </div>
    </div>
    <hr />
    <div class="row" v-for="i in solicitacoes">
      <div class="col-md-3">
        <div class="form-group">
          <label for>{{i}}. Qtd dias Solicitado</label>
          <input
            type="number"
            class="form-control"
            @change="atualizaInfoDias()"
            v-model="post['qt_dias_solicitada_'+i]"
          />
        </div>
      </div>
      <div class="col-md-3 ml-2">
        <div class="form-group">
          <label for>{{i}}. Data Inicial</label>
          <input
            type="date"
            class="form-control"
            @change="atualizaInfoDias()"
            :readonly="post['qt_dias_solicitada_'+i] == 0"
            v-model="post['dt_inicial_'+i]"
          />
        </div>
      </div>
      <div class="col-md-3 ml-2">
        <div class="form-group">
          <label for>{{i}}. Data de Término</label>
          <input type="date" readonly class="form-control" v-model="post['dt_termino_'+i]" />
        </div>
      </div>
      <!-- <div>GOZADOS: {{ post['diasGozados'+i] }}</div> -->
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="textareaObservacoes3">Observações</label>
          <textarea
            id="textareaObservacoes3"
            cols="30"
            rows="5"
            class="form-control"
            v-model="post.observacoes3"
          ></textarea>
        </div>
      </div>
    </div>
    <botoes-component :titulo="nomeBotao = 'Salvar'"></botoes-component>
  </form>
</template>

<script>
Date.prototype.addDays = function(days) {
  var date = new Date(this.valueOf());
  date.setDate(date.getDate() + days);
  return date;
};

export default {
  data() {
    return {
      solicitacoes: [1, 2, 3, 4, 5, 6, 7]
      // solicitacoes: [1]
    };
  },
  props: ["post", "inserirEstagiario"],
  watch: {
    post: function() {
      this.calculoDiasFerias();
      
      // Calcula término da solicitação de férias
      this.atualizaInfoDias();
    }
  },
  methods: {
    calculoDiasFerias() {
      // var date1 = new Date("10/03/2019");
      var date1 = new Date(this.post.dt_inicio);
      var date2 = new Date();
      var differenceInTime = date2.getTime() - date1.getTime();
      var differenceInDays = differenceInTime / (1000 * 3600 * 24);
      var meses = differenceInDays / 30;
      var recesso = parseInt(meses) * 2.5;
      var result = Math.round(recesso);
      this.post.diasFerias = result;
      return result;
    },
    calculoDiasGozados(dtInicial, dtFinal, diasSolicitados) { // dtInicial, dtFinal: string
      let resultado = 0;
      let dtAtual = new Date();
      dtInicial = new Date(dtInicial);
      dtFinal = new Date(dtFinal);

      // Verifica se data de término é igual à data inicial
      if(diasSolicitados === "1") {        
        return dtFinal < dtAtual ? 1 : 0;
      }

      if(dtAtual < dtInicial) {
        return 0;
      }

      if (dtAtual < dtFinal) {
        resultado = new Date(dtAtual - dtInicial).getDate();        
      }
      else {
        resultado = new Date(dtFinal - dtInicial).getDate() + 1;
      }
      
      return resultado > diasSolicitados ? 0 : resultado;
    },
    atualizaInfoDias() {      
      /** Atualiza data final **/
      // Percorre array de solicitações (7 ao todo)
      for (var i = 1; i <= this.solicitacoes.length; i++) {
        // Verifica se número de dias solicitados é 0
        if (this.post['qt_dias_solicitada_'+i] == '0'){
          this.post['dt_inicial_'+i] = null;
          this.post["dt_termino_" + i] = null;
        }
        else {
          this.post["dt_termino_" + i] = this.simplificaData(
          new Date(this.post["dt_inicial_" + i]).addDays(
            parseInt(this.post["qt_dias_solicitada_" + i])
          )
        );
        }
      }

    //   Atualiza dias gozados
    this.post["qt_dias_gozados"] = 0;    

    // Calcula dias gozados para cada solicitação de férias
      for (var i in this.solicitacoes) {
        i++;          
        this.post["diasGozados" + i] = this.calculoDiasGozados(
          this.post["dt_inicial_" + i],
          this.post["dt_termino_" + i],
          this.post["qt_dias_solicitada_" + i]
        );
        this.post.qt_dias_gozados += this.post["diasGozados" + i] >= 0 ? this.post["diasGozados" + i] : 0;  
      }
      this.post.qt_dias_restantes = this.post.diasFerias - this.post.qt_dias_gozados;
    },
    simplificaData(fullDate) {
      let ano = fullDate.getFullYear();
      let mes = fullDate.getMonth() + 1;
      if (mes < 10) {
        mes = "0" + mes;
      }
      let dia = fullDate.getDate();
      if (dia < 10) {
        dia = "0" + dia;
      }
      return ano + "-" + mes + "-" + dia;
    }
  }
};
</script>

<style>
</style>

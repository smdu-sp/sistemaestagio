<template>
  <form @submit.prevent="inserirEstagiario" method="patch">    
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label for>Qtd dias legais</label>
          <input
            type="number"
            class="form-control"
            readonly
            v-model="post.diasFerias"
          />
        </div>
      </div>
      <div class="col-md-3 ml-2">
        <div class="form-group">
          <label for>Qtd dias Gozados</label>
          <input type="number" class="form-control" v-model="post.qt_dias_gozados" />
        </div>
      </div>
      <div class="col-md-3 ml-2">
        <label for>Qtd dias Restantes</label>
        <div class="form-inline">
          <div class="form-group">
            <input type="number" class="form-control" v-model="post.qt_dias_restantes" />
          </div>
        </div>
      </div>
    </div>
    <hr />
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label for>1. Qtd dias Solicitado</label>
          <input type="number" class="form-control" @change="atualizaInfoDias()" v-model="post.qt_dias_solicitada_1" />
        </div>
      </div>
      <div class="col-md-3 ml-2">
        <div class="form-group">
          <label for>1. Data Inicial</label>
          <input type="date" class="form-control" @change="atualizaInfoDias()" v-model="post.dt_inicial_1" />
        </div>
      </div>
      <div class="col-md-3 ml-2">
        <div class="form-group">
          <label for>1. Data de Término</label>
          <input type="date" readonly class="form-control" v-model="post.dt_termino_1" />
        </div>
      </div>
      <div>GOZADOS: {{ post.diasGozados1 }}</div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label for>2. Qtd dias Solicitado</label>
          <input type="number" class="form-control" @change="atualizaInfoDias()" v-model="post.qt_dias_solicitada_2" />
        </div>
      </div>
      <div class="col-md-3 ml-2">
        <div class="form-group">
          <label for>2. Data Inicial</label>
          <input type="date" class="form-control" @change="atualizaInfoDias()" v-model="post.dt_inicial_2" />
        </div>
      </div>
      <div class="col-md-3 ml-2">
        <div class="form-group">
          <label for>2. Data de Término</label>
          <input type="date" class="form-control" v-model="post.dt_termino_2" />
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label for>3. Qtd dias Solicitado</label>
          <input type="number" class="form-control" v-model="post.qt_dias_solicitada_3" />
        </div>
      </div>
      <div class="col-md-3 ml-2">
        <div class="form-group">
          <label for>3. Data Inicial</label>
          <input type="date" class="form-control" v-model="post.dt_inicial_3" />
        </div>
      </div>
      <div class="col-md-3 ml-2">
        <div class="form-group">
          <label for>3. Data de Término</label>
          <input type="date" class="form-control" v-model="post.dt_termino_3" />
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label for>4. Qtd dias Solicitado</label>
          <input type="number" class="form-control" v-model="post.qt_dias_solicitada_4" />
        </div>
      </div>
      <div class="col-md-3 ml-2">
        <div class="form-group">
          <label for>4. Data Inicial</label>
          <input type="date" class="form-control" v-model="post.dt_termino_4" />
        </div>
      </div>
      <div class="col-md-3 ml-2">
        <div class="form-group">
          <label for>4. Data de Término</label>
          <input type="date" class="form-control" v-model="post.dt_inicial_4" />
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label for>5. Qtd dias Solicitado</label>
          <input type="number" class="form-control" v-model="post.qt_dias_solicitada_5" />
        </div>
      </div>
      <div class="col-md-3 ml-2">
        <div class="form-group">
          <label for>5. Data Inicial</label>
          <input type="date" class="form-control" v-model="post.dt_inicial_5" />
        </div>
      </div>
      <div class="col-md-3 ml-2">
        <div class="form-group">
          <label for>5. Data de Término</label>
          <input type="date" class="form-control" v-model="post.dt_termino_5" />
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label for>6. Qtd dias Solicitado</label>
          <input type="number" class="form-control" v-model="post.qt_dias_solicitada_6" />
        </div>
      </div>
      <div class="col-md-3 ml-2">
        <div class="form-group">
          <label for>6. Data Inicial</label>
          <input type="date" class="form-control" v-model="post.dt_inicial_6" />
        </div>
      </div>
      <div class="col-md-3 ml-2">
        <div class="form-group">
          <label for>6. Data de Término</label>
          <input type="date" class="form-control" v-model="post.dt_termino_6" />
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label for>7. Qtd dias Solicitado</label>
          <input type="number" class="form-control" v-model="post.qt_dias_solicitada_7" />
        </div>
      </div>
      <div class="col-md-3 ml-2">
        <div class="form-group">
          <label for>7. Data Inicial</label>
          <input type="date" class="form-control" v-model="post.dt_inicial_7" />
        </div>
      </div>
      <div class="col-md-3 ml-2">
        <div class="form-group">
          <label for>7. Data de Término</label>
          <input type="date" class="form-control" v-model="post.dt_termino_7 " />
        </div>
      </div>
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
}

export default {
  props: ["post", "inserirEstagiario"],
//   mounted: function () {
//       this.calculoDiasFerias();
//       console.log("Calculo Executado");
//   },
  watch: {
        post: function() {
            this.calculoDiasFerias();
            console.log("Calculo Executado");

            // Calcula término da solicitação de férias
            this.atualizaInfoDias();
            
            // Calcula dias gozados para cada solicitação de férias
            this.post.diasGozados1 = this.calculoDiasGozados(this.post.dt_inicial_1, this.post.dt_termino_1);
        }
  },
  methods: {
      calculoDiasFerias () {
        // var date1 = new Date("10/03/2019");
        var date1 = new Date(this.post.dt_inicio);
        var date2 = new Date();
        var differenceInTime = date2.getTime() - date1.getTime();
        var differenceInDays = differenceInTime / (1000 * 3600 * 24);
        var meses = differenceInDays / 30;
        var recesso = parseInt(meses) * 2.5;
        var result = Math.round(recesso);
        console.log('DIAS FÉRIAS: ');
        console.log(result);
        this.post.diasFerias = result;
        // return result;
      },
      calculoDiasGozados(dtInicial, dtFinal) {
        //   dtInicial, dtFinal: string
        let resultado = dtFinal - dtInicial;
        console.log(resultado);
        return resultado;
      },
      atualizaInfoDias() {
        //   Atualiza data final        
          this.post.dt_termino_1 = this.simplificaData(new Date(this.post.dt_inicial_1).addDays(parseInt(this.post.qt_dias_solicitada_1)));

        // Percorre array de solicitações (7 ao todo)
        for (var i = 1; i <= 7; i++) {
            this.post['dt_termino_'+i] = this.simplificaData(new Date(this.post['dt_inicial_'+i]).addDays(parseInt(this.post['qt_dias_solicitada_'+i])));
        }


        //   this.post.dt_termino_2 = this.simplificaData(new Date(this.post.dt_inicial_2).addDays(parseInt(this.post.qt_dias_solicitada_2)));
        //   this.post.dt_termino_3 = this.simplificaData(new Date(this.post.dt_inicial_3).addDays(parseInt(this.post.qt_dias_solicitada_3)));
        //   this.post.dt_termino_4 = this.simplificaData(new Date(this.post.dt_inicial_4).addDays(parseInt(this.post.qt_dias_solicitada_4)));
        //   this.post.dt_termino_5 = this.simplificaData(new Date(this.post.dt_inicial_5).addDays(parseInt(this.post.qt_dias_solicitada_5)));
        //   this.post.dt_termino_6 = this.simplificaData(new Date(this.post.dt_inicial_6).addDays(parseInt(this.post.qt_dias_solicitada_6)));
        //   this.post.dt_termino_7 = this.simplificaData(new Date(this.post.dt_inicial_7).addDays(parseInt(this.post.qt_dias_solicitada_7)));
      },
      simplificaData(fullDate) {
          let ano = fullDate.getFullYear();
          let mes = fullDate.getMonth() + 1;          
          if(mes < 10) {
              mes = "0" + mes;
          }
          let dia = fullDate.getDate();
          if(dia < 10) {
              dia = "0" + dia;
          }
          return ano + "-" + mes + "-" + dia;
      }
  }
};
</script>

<style>
</style>

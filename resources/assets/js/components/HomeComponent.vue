<template>
  <div class="" id="app">

    <div class="container-fluid">
      <div class="row">
        <div class="col-3">
            <aside-component :showModal="showModal"></aside-component>

          <!--Modal-->
          <div>
            <b-modal ref="my-modal" hide-footer title="Consulta de Estagiários">
              <b-form ref="form" @submit="validaCpf">
                  <label for="inputCpf">Digite o CPF do Estagiário</label>
                    <the-mask type="text"
                      @input="validacaoCpf"
                      class="form-control mt-2" 
                      maxlength="14"
                      :class="{'is-invalid': cpfInvalido, 'is-valid': cpfValido}"
                      id="inputCpf" 
                      placeholder="Ex: 000.000.000-00"
                      mask="###.###.###-##"
                      v-model="post.cpf"></the-mask>
                      <div v-if="cpfInvalido" class="invalid-feedback">
                        O CPF deve ter 11 números
                      </div>
                </b-form>
                <div class="text-right">
                  <b-button type="submit" class="mt-3" variant="outline-danger" @click="buscaEstagiario">Ok</b-button>
                  <b-button class="mt-3" variant="outline-primary" @click="hideModal">Cancelar</b-button>
                </div>
            </b-modal>
          </div>
          <!--Modal-->

        </div>
        <div class="col-9">
            <header-component></header-component>
          <template v-if="main">
            <main-component></main-component>
          </template>

          <template v-else>

            <div  v-if="msg.error" class="alert alert-danger">
                {{ msg.erro }}
            </div>
              <!-- Formulários -->
                <b-card no-body>
                    <b-tabs card>
                        <b-tab title="Dados Pessoais" active>
                            <b-card-text>
                              <dados-pessoais-atualizar
                                :post="post"
                                :inserirEstagiario="inserirEstagiario"
                                :validaNome="validaNome"
                                :nomeValido="nomeValido"
                                :validaCodEstudante="validaCodEstudante"
                                :codValido="codValido"
                                :validaContratante="validaContratante"
                                :contratanteValido="contratanteValido"
                                :validaEndereco="validaEndereco"
                                :enderecoValido="enderecoValido"
                                :validaCep="validaCep"
                                :cepValido="cepValido"
                                :validaBairro="validaBairro"
                                :bairroValido="bairroValido"
                                :validaComplemento="validaComplemento"
                                :complementoValido="complementoValido"
                                :validaEstado="validaEstado"
                                :estadoValido="estadoValido"
                                :validaCelular="validaCelular"
                                :celularValido="celularValido"
                                :validaNaturalidade="validaNaturalidade"
                                :naturalidadeValida="naturalidadeValida"
                                :validaNacionalidade="validaNacionalidade"
                                :nacionalidadeValida="nacionalidadeValida"
                                :validaRaca="validaRaca"
                                :racaValida="racaValida"
                                :validaCpf="validaCpf"
                                :cpfValido="cpfValido"
                                :validaRg="validaRg"
                                :rgValido="rgValido"
                                :validaEmail="validaEmail"
                                :emailValido="emailValido"
                                :validaInstituicao="validaInstituicao"
                                :instituicaoValida="instituicaoValida"
                                :validaCurso="validaCurso"
                                :cursoValido="cursoValido"
                                :cartoes="cartoes"
                                :estados="estados"
                                :instituicoes="instituicoes"
                                :cursos="cursos"
                                :departamentos="departamentos"
                                :supervisores="supervisores"
                                :vagas="vagas"
                                />
                            </b-card-text>
                        </b-tab>
                        <b-tab title="Informações Contratuais">
                            <b-card-text>
                                <informacoes-contratuais-atualizar
                                :post="post"
                                :departamentos="departamentos"
                                :supervisores="supervisores"
                                :inserirEstagiario="inserirEstagiario"
                                :vagas="vagas"
                                :statusVaga="statusVaga"
                                :selectVaga="selectVaga"
                                :validaVaga="validaVaga"
                                :vagaValida="vagaValida"
                                :validaDepartamento="validaDepartamento"
                                :departamentoValido="departamentoValido"
                                :validaSetor="validaSetor"
                                :setorValido="setorValido"
                                :validaSupervisor="validaSupervisor"
                                :supervisorValido="supervisorValido"
                                :validaHorarioEntrada="validaHorarioEntrada"
                                :horarioEntradaValido="horarioEntradaValido"
                                :validaHorarioSaida="validaHorarioSaida"
                                :horarioSaidaValido="horarioSaidaValido"
                                :validaSituacao="validaSituacao"
                                :situacaoValida="situacaoValida"
                                />
                            </b-card-text>
                        </b-tab>
                        <b-tab title="Dados Bancários">
                            <b-card-text>
                              <dados-bancarios 
                                :post="post"
                                :inserirEstagiario="inserirEstagiario"
                                />
                            </b-card-text>
                        </b-tab>
                    </b-tabs>
                </b-card>
                <!-- /Formulários -->
          </template>
        </div>
      </div><!-- /row -->
    </div> <!-- /container -->

  </div>
</template>

<script>
export default {
  data() {
    return {
      post: {},
      cpfValido: false,
      cpfInvalido: false,
      cpfValidoForm: false,
      statusVaga: {},
      estagiario: {},
      main: true,
      nomeValido: false,
      codValido: false,
      contratanteValido: false,
      vagaValida: false,
      enderecoValido: false,
      complementoValido: false,
      bairroValido: false,
      estadoValido: false,
      cepValido: false,
      celularValido: false,
      nacionalidadeValida: false,
      naturalidadeValida: false,
      racaValida: false,
      rgValido: false,
      emailValido: false,
      instituicaoValida: false,
      cursoValido: false,
      vagaAlterada: '',
      departamentoValido: false,
      setorValido: false,
      supervisorValido: false,
      dataInicioValida: false,
      dataFimValida: false,
      horarioEntradaValido: false,
      horarioSaidaValido: false,
      situacaoValida: false,
      cartoes: {},
      estados: {},
      instituicoes: {},
      cursos: {},
      departamentos: {},
      supervisores: {},
      vagas: {},
      msg: {
        error: false,
        success: false
      },
      auxiliarCpf: ''
    }
  },
  beforeMount() {
      let uriCartoes = 'http://localhost:8000/api/cartao';
      let uriEstados = 'http://localhost:8000/api/estados';
      let uriInstituicoes = 'http://localhost:8000/api/instituicao';
      let uriCursos = 'http://localhost:8000/api/cursos';
      let uriDepartamentos = 'http://localhost:8000/api/departamentos';
      let uriSupervisores = 'http://localhost:8000/api/supervisores'; 
      let uriVagas = 'http://localhost:8000/api/vagas';

      this.requisicaoGet(uriCartoes, 'cartoes');
      this.requisicaoGet(uriEstados, 'estados');
      this.requisicaoGet(uriInstituicoes, 'instituicoes');
      this.requisicaoGet(uriCursos, 'cursos');
      this.requisicaoGet(uriDepartamentos, 'departamentos');
      this.requisicaoGet(uriSupervisores, 'supervisores');
      this.requisicaoGet(uriVagas, 'vagas');
  },
  methods: {
    showModal() {
      this.$refs['my-modal'].show()
    },
    hideModal() {
      this.$refs['my-modal'].hide()
    },
    converteNascimento() {
      this.post.data_nascimento = this.post.data_nascimento.substr(0,10);
    },
    converteHorarioEntrada() {
      this.post.horario_entrada = this.post.horario_entrada.substr(11,19);
    },
    converteHorarioSaida() {
      this.post.horario_saida = this.post.horario_saida.substr(11,19);
    },
    converteDataInicio() {
      this.post.dt_inicio = this.post.dt_inicio.substr(0,10);
    },
    converteDataTermino() {
      this.post.dt_termino = this.post.dt_termino.substr(0,10);
    },
    validacaoCpf() { // Valida o CPF do Modal
      let cpf = this.post.cpf
        if(cpf.length < 11) {
          this.cpfInvalido = true;
          this.cpfValido = false;
        } else {
          this.cpfInvalido = false;
          this.cpfValido = true;
        }
    },
    inserirEstagiario() {
      this.converteCep();
      this.alteracaoSupervisor();
      this.horarioVariavel();
      this.dataModificacao();
      this.horaModificacao();
      this.converteCelular();
      this.converteConclusaoCurso();
      this.alteraStatusVaga();
      this.converteDatas();
      this.atualizaBanco();
    },
    buscaEstagiario() {
      this.auxiliarCpf = this.post.cpf;
      let uriEstagiario = `http://localhost:8000/api/estagiarios/${this.post.cpf}`;
      this.axios
      .get(uriEstagiario)
      .then(response => {
        this.hideModal();
        this.estagiario = response.data;
        this.post = this.estagiario;
        this.main = false;
        this.converteNascimento();
        this.converteHorarioEntrada();
        this.converteHorarioSaida();
        this.converteDataInicio();
        this.converteDataTermino();
        this.selectVaga();
        console.log(this.post);
      })
      .catch(error => {
      this.msg.error = true;
      this.msg.erro = 'A pesquisa não retornou dados';
      });
    },
      alteraStatusVaga() {
      let uriVagas = `http://localhost:8000/api/vagas/${this.statusVaga.id}`;
      this.axios.patch(uriVagas, this.statusVaga).then(response => response);
    },
    converteCep() {
      let cep = this.post.cep;
      if(cep) {
          let cep1 = cep.substr(0,5);
          let cep2 = cep.substr(5, 7);
          let cepFormatado = `${cep1}-${cep2}`;
          this.post.cep = cepFormatado;
      }
    },
    alteracaoSupervisor() {
      if(!this.post.houve_alteracao_supervisor) {
          this.post.houve_alteracao_supervisor = 0;
      }
    },
    horarioVariavel() {
      if(!this.post.horario_variavel) {
          this.post.horario_variavel = 0;
      } else {
          this.post.horario_variavel = 1;
      }
    },
    dataModificacao() {
      let date = new Date();
      let ano = date.getFullYear();
      let mes = date.getMonth() >= 10 ? date.getMonth() : `0${date.getMonth() + 1}`;
      let dia = date.getDate() >= 10 ? date.getDate() : `0${date.getDate()}`;

      let data = `${ano}-${mes}-${dia} 00:00:00`;
      this.post.data_modificacao = data
    },
    horaModificacao() {
      let date = new Date();
      let ano = date.getFullYear();
      let mes = date.getMonth() >= 10 ? date.getMonth() : `0${date.getMonth() + 1}`;
      let dia = date.getDate() >= 10 ? date.getDate() : `0${date.getDate()}`;
      let hora = date.getHours() >= 10 ? date.getHours() : `0${date.getHours()}`;
      let minuto = date.getMinutes() >= 10 ? date.getMinutes() : `0${date.getMinutes()}`;
      let segundo = date.getSeconds() >= 10 ? date.getSeconds() : `0${date.getSeconds()}`;

      let dataHora = `${ano}-${mes}-${dia} ${hora}:${minuto}:${segundo}`
      this.post.hora_modificacao = dataHora
    },
    atualizaBanco() {
      let uriEstagiarios = `http://localhost:8000/api/estagiarios/${this.auxiliarCpf}`;
      this.axios
      .patch(uriEstagiarios, this.estagiario)
      .then(response => {
          this.msg.sucesso = 'Dados atualizados com sucesso!';
          this.msg.success = true;
      })
      .catch(e => {
          this.msg.erro = 'Erro ao atualizar dados';
          this.msg.error = true;
      })
    },
    converteCelular(){
      let celular = this.post.fone_celular;
      if(celular) {
          if(celular.substr(0,1) != '(') {
              let codArea = celular.substr(0,2);
              let telParte1 = celular.substr(2,5);
              let telParte2 = celular.substr(7, celular.length);
              let celFormatado = `(${codArea}) ${telParte1}-${telParte2}`;
              this.post.fone_celular = celFormatado;
          }
      }
    },
    converteFone() {
    let fone = this.post.fone_residencial;
    if(fone) {
      if(fone.substr(0,1) != '(') {
          let codArea = fone.substr(0,2);
          let telParte1 = fone.substr(2,4);
          let telParte2 = fone.substr(6, fone.length);
          let foneFormatado = `(${codArea}) ${telParte1}-${telParte2}`;
          this.post.fone_residencial = foneFormatado;                    
      }
    }
    },
    selectVaga() {
      let uriStatusVaga = `http://localhost:8000/api/vagas/${this.post.cod_vaga}`;
      this.axios.get(uriStatusVaga).then(response => this.statusVaga = response.data);
    },
    converteConclusaoCurso() {
      let data = this.post.mes_ano_previsto_curso;
      if(data) {
          let mes = data.substr(0,2);
          let ano = data.substr(3, data.length);
          let dataFormatada = `${mes}${ano}`;
          this.post.mes_ano_previsto_curso = dataFormatada;
      }
    },
    converteDatas() {
      if(this.post.dt_inicio) {
          this.post.dt_inicio == `${this.post.dt_inicio.substr(0,10)} 00:00:00` ? this.post.dt_inicio  : this.post.dt_inicio += ' 00:00:00';
      }
      if(this.post.dt_termino) {
          this.post.dt_termino == `${this.post.dt_termino.substr(0,10)} 00:00:00` ? this.post.dt_termino : this.post.dt_termino += ' 00:00:00';
      }
      if(this.post.dt_termino) {
          this.post.dt_termino_inicial_lauda = this.post.dt_termino;
      }
      if(this.post.horario_entrada) {
          this.post.horario_entrada = this.post.horario_entrada.length == 5 ? `1899-12-30 ${this.post.horario_entrada}:00` : this.post.horario_entrada;
      }
      if(this.post.horario_saida) {
          this.post.horario_saida = this.post.horario_saida.length == 5 ? `1899-12-30 ${this.post.horario_saida}:00` : this.post.horario_saida;
      }
    },
    requisicaoGet(uri, variavel) {
      this.axios.get(uri).then(response => {
          this[variavel] = response.data
      })
    },
    validaNome(nome) { this.validacao(nome, 'nomeValido') },
    validaCodEstudante(cod) { this.validacao(cod, 'codValido') },
    validaContratante(contratante) { this.validacao(contratante, 'contratanteValido') },
    validaVaga(vaga) { this.validacao(vaga, 'vagaValida'); },
    validaEndereco(endereco) { this.validacao(endereco, 'enderecoValido') },
    validaComplemento(complemento) { this.validacao(complemento, 'complementoValido') },
    validaBairro(bairro) { this.validacao(bairro, 'bairroValido') },
    validaEstado(estado) { this.validacao(estado, 'estadoValido')},
    validaCep(cep) { this.validacao(cep, 'cepValido'); },
    validaCelular(celular) { this.validacao(celular, 'celularValido') },
    validaNacionalidade(nacionalidade) { this.validacao(nacionalidade, 'naturalidadeValida')},
    validaNaturalidade(naturalidade) { this.validacao(naturalidade, 'naturalidadeValida') },
    validaRaca(raca) { this.validacao(raca, 'racaValida') },
    validaCpf(cpf) { this.validacao(cpf, 'cpfValidoForm') }, // Valida o CPF do Formulário de Update
    validaRg(rg) { this.validacao(rg, 'rgValido') },
    validaEmail(email) { this.validacao(email, 'emailValido') },
    validaInstituicao(instituicao) { this.validacao(instituicao, 'instituicaoValida') },
    validaCurso(curso) { this.validacao(curso, 'cursoValido') },
    validaDepartamento(departamento) { this.validacao(departamento, 'departamentoValido') },
    validaSetor(setor) { this.validacao(setor, 'setorValido') },
    validaSupervisor(supervisor) { this.validacao(supervisor, 'supervisorValido') },
    validaHorarioEntrada(horaEntrada) { this.validacao(horaEntrada, 'horarioEntradaValido') },
    validaHorarioSaida(horaSaida) { this.validacao(horaSaida, 'horarioSaidaValido') },
    validaSituacao(situacao) { this.validacao(situacao, 'situacaoValida') },
    validacao(valorCampo, variavelBooleana) {
        if(!valorCampo.target.value) {
            this[variavelBooleana] = true
        } else {
            this[variavelBooleana] = false
        }
    }
  }
}
</script>

<style scoped>
aside {
  height: 100vh;
}
div .col-6 {
  background: transparent;
}

.col-3 {
  padding-right: 0;
}

.col-6 {
  background-color: gray;
}

.yellow {
  background-color: yellow;
}

aside {
    background-color: #3A4248;
}

.linha {
    width: 35px;
    height: 4px;
    background-color: #94AFB5;
    margin-bottom: 3px;
    border-radius: 2px;
}

nav ul {
    list-style: none;
}

nav ul li {
    color: #fff;
    margin-bottom: 5px;
}

.dashboard {
    background: rgba(255, 255, 255, 0.1);
}

nav ul li a {
    color: white;
}

nav ul li a:link {
    color: white;
}

nav ul li a:hover {
    text-decoration: none;
    color: white;
}

.submenu {
    background: rgba(255, 255, 255, 0.1);
    padding-right: 10px;
    padding-left: 20px;
}
</style>
<template>
<div>
  <!--Modal ativado pelo botão do componente Aside -->
    <b-modal ref="consulta-estagiario" hide-footer title="Consulta de Estagiários">

      <div v-if="msg.error" class="alert alert-danger">{{ msg.erro }}</div>

      <b-form ref="form" @submit.prevent="validaCpf" @keyup.enter="buscaEstagiario">
          <label for="inputCpf">Digite o CPF do Estagiário:</label>
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

            <p class="text-center mt-3"><b>OU</b></p>
            
            <label>Nome do Estagiário:</label>
            <input type="text" class="form-control" @input="filtro = $event.target.value">
            <div v-show="filtro">
              <ul class="ul-estagiario">
                <li class="item-estagiario" 
                  v-for="(estagiario, indice) of EstagiariosComFiltro" 
                  :key="estagiario.nome" 
                  @click="selecionaEstagiario(indice)">
                  <b>{{ estagiario.nome.toLowerCase() }}</b>
                </li>
                <li v-show="filtro" class="fim-lista"></li>
              </ul>
            </div>
        </b-form>
        <div class="text-right">
          <b-button type="submit" class="mt-3" variant="outline-primary" @click="buscaEstagiario">Ok</b-button>
          <b-button class="mt-3" variant="outline-danger" @click="escondeModalEstagiario">Cancelar</b-button>
        </div>

        <div v-if="loading" class="text-center">
          <b-spinner variant="primary" label="Spinning"></b-spinner>
          <b-spinner variant="primary" type="grow" label="Spinning"></b-spinner>
        </div>

    </b-modal>
  <!--Modal-->

  <b-modal v-model="exibeModalCartaoAcesso" size="lg" ok-only>
      <cadastro-cartao-acesso-component></cadastro-cartao-acesso-component>
  </b-modal>

  <b-modal v-model="exibeModalVaga" size="lg" ok-only>
      <cadastro-vaga-component></cadastro-vaga-component>
  </b-modal>

  <b-modal v-model="exibeModalSupervisor" size="lg" ok-only>
      <alteracao-supervisor-component :post="post"></alteracao-supervisor-component>
  </b-modal>

  <modal-component></modal-component><!--Modal acionado pelo componente Botoes.vue-->

  <template v-if="mostrarConteudoConsulta">

    <div v-if="msg.success" class="alert alert-success mt-2">
      {{ msg.sucesso }}
    </div>

    <div v-if="msg.error" class="alert alert-danger mt-2">
      {{ msg.erro }}
    </div>

    <div v-if="msg.vagaAlterada" class="alert alert-success">
      {{ msg.vagaSuccess }}
    </div>

    <div v-if="msg.vagaNaoAlterada" class="alert alert-danger">
      {{ msg.vagaError }}
    </div>

  <h1 class="text-center">Consulta</h1>
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
                  :validaNacionalidade="validaNacionalidade"
                  :nacionalidadeValida="nacionalidadeValida"
                  :validaRaca="validaRaca"
                  :racaValida="racaValida"
                  :validaCpfForm="validaCpfForm"
                  :cpfValidoForm="cpfValidoForm"
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
                  :exibeModalEstagiario="exibeModalEstagiario"
                  :carregaCartaoAcesso="carregaCartaoAcesso"
                  :cartoesOrdenados="cartoesOrdenados"
                  :cursosOrdenados="cursosOrdenados"
                  :abreModalCartaoAcesso="abreModalCartaoAcesso"
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
                  :alteraVagaParaLivre="alteraVagaParaLivre"
                  :supervisoresOrdenados="supervisoresOrdenados"
                  :vagasOrdenadas="vagasOrdenadas"
                  :departamentosOrdenados="departamentosOrdenados"
                  :carregaVaga="carregaVaga"
                  :abreModalVaga="abreModalVaga"
                  :abreModalSupervisor="abreModalSupervisor"
                  :carregaSupervisor="carregaSupervisor"
                  />
              </b-card-text>
          </b-tab>
          <b-tab title="Recesso">
              <b-card-text>
                  <recesso-atualizar
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
</template>

<script>
import computeds from '../../../mixins/computeds';
export default {
  data() {
    return {
      post: {},
      cpfValido: false,
      cpfInvalido: false,
      cpfValidoForm: false,
      statusVaga: {},
      estagiario: {},
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
        success: false,
        vagaAlterada: false,
        vagaNaoAlterada: false
      },
      auxiliarCpf: '',
      mostrarConteudoConsulta: false,
      loading: false,
      filtro: '',
      estagiarios: {},
      estagiarioFiltrado: {},
      exibeModalCartaoAcesso: false,
      exibeModalVaga: false,
      exibeModalSupervisor: false
    }
  },
  mixins: [computeds],
  computed: {
    EstagiariosComFiltro() {
        this.estagiarioFiltrado = this.estagiarios
        if(this.filtro){
            let exp = new RegExp(this.filtro.trim(), 'i');
            this.estagiarioFiltrado = this.estagiarioFiltrado.filter(estagiario => exp.test(estagiario.nome));
            return this.estagiarioFiltrado;
        } else {
            return;
        }
    }
  },
  beforeMount() {
    let uriEstagiario = '/api/estagiarios';
    let uriCartoes = '/api/cartao';
    let uriEstados = '/api/estados';
    let uriInstituicoes = '/api/instituicao';
    let uriCursos = '/api/cursos';
    let uriDepartamentos = '/api/departamentos';
    let uriSupervisores = '/api/supervisores'; 
    let uriVagas = '/api/vagas';

    this.requisicaoGet(uriCartoes, 'cartoes');
    this.requisicaoGet(uriEstados, 'estados');
    this.requisicaoGet(uriInstituicoes, 'instituicoes');
    this.requisicaoGet(uriCursos, 'cursos');
    this.requisicaoGet(uriDepartamentos, 'departamentos');
    this.requisicaoGet(uriSupervisores, 'supervisores');
    this.requisicaoGet(uriVagas, 'vagas');
    this.requisicaoGet(uriEstagiario, 'estagiarios');
  },
  mounted() {
    if(this.$store.state.estagiario.estagiarioSelecionado) {
      this.mostrarConteudoConsulta = true;
      this.post = this.$store.state.estagiario.estagiarioSelecionado;
      this.post.curso_formacao = this.$store.state.estagiario.idCursoEstagiarioSelecionado;
      this.auxiliarCpf = this.post.cpf;
      this.converteNascimento();
      this.converteHorarioEntrada();
      this.converteHorarioSaida();
      this.converteDataInicio();
      this.converteDataTermino();
      this.converteTermosAditivos();
      this.converteDataInicialLauda();
      this.converteDataDesligamento();
      this.converteSemestreDesligamento();
      this.converteRecessos();
      this.selectVaga();
    } else {
      this.exibeModalEstagiario();
    }
  },
  methods: {
    carregaSupervisor() {
        const uriSupervisores = '/api/supervisores';

        this.requisicaoGet(uriSupervisores, 'supervisores');
    },
    abreModalSupervisor() {
        this.exibeModalSupervisor = !this.exibeModalSupervisor;
    },
    abreModalVaga() {
        this.exibeModalVaga = !this.exibeModalVaga;
    },
    carregaVaga() {
        const uriVagas = '/api/vagas';

        this.requisicaoGet(uriVagas, 'vagas');
    },
    abreModalCartaoAcesso() {
        this.exibeModalCartaoAcesso = !this.exibeModalCartaoAcesso;
    },
    carregaCartaoAcesso() {
        const uriCartoes = '/api/cartao';

        this.requisicaoGet(uriCartoes, 'cartoes');
    },
    alteraVagaParaLivre(situacao) {
      if(situacao.target.value == 5) {
        this.statusVaga.status = 'LIVRE'
        document.getElementById('selectStatus').disabled = true
      }
    },
    selecionaPrimeiroDaLista() {
        if(this.filtro) {
          this.post = this.estagiarioFiltrado[0];
          this.escondeModalEstagiario();
        }
    },
    selecionaEstagiario(indice) {
      this.post = this.estagiarioFiltrado[indice];
      this.escondeModalEstagiario();
      this.auxiliarCpf = this.post.cpf;
      this.converteNascimento();
      this.converteHorarioEntrada();
      this.converteHorarioSaida();
      this.converteDataInicio();
      this.converteDataTermino();
      this.converteTermosAditivos();
      this.converteDataInicialLauda();
      this.converteDataDesligamento();
      this.converteSemestreDesligamento();
      this.converteRecessos();
      this.selectVaga();
    },
    exibeModalEstagiario() {
      this.$refs['consulta-estagiario'].show()
    },
    escondeModalEstagiario() {
      this.$refs['consulta-estagiario'].hide()
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
    requisicaoGet(uri, variavel) {
      this.axios.get(uri).then(response => {
          this[variavel] = response.data
      })
    },
    validacao(valorCampo, variavelBooleana) {
        if(!valorCampo.target.value) {
            this[variavelBooleana] = true
        } else {
            this[variavelBooleana] = false
        }
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
    validaNacionalidade(nacionalidade) { this.validacao(nacionalidade, 'nacionalidadeValida')},
    validaRaca(raca) { this.validacao(raca, 'racaValida') },
    validaCpf(cpf) { this.validacao(cpf, 'cpfValido')},// Valida o CPF do Modal
    validaCpfForm(cpf) { this.validacao(cpf, 'cpfValidoForm')},// Valida o CPF do Formulário de Update
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
    converteNascimento() {
      if(this.post.data_nascimento) {
        this.post.data_nascimento = this.post.data_nascimento.substr(0,10);
      }
    },
    converteHorarioEntrada() {
      if(this.post.horario_entrada) {
        this.post.horario_entrada = this.post.horario_entrada.substr(11,19);
      }
    },
    converteHorarioSaida() {
      if(this.post.horario_saida) {
        this.post.horario_saida = this.post.horario_saida.substr(11,19);
      }
    },
    converteDataInicio() {
      if(this.post.dt_inicio) {
        this.post.dt_inicio = this.post.dt_inicio.substr(0,10);
      }
    },
    converteDataTermino() {
      if(this.post.dt_termino) {
        this.post.dt_termino = this.post.dt_termino.substr(0,10);
      }
    },
    converteTermosAditivos() {
      if(this.post.dt_inicio_1_aditivo) { this.post.dt_inicio_1_aditivo = this.post.dt_inicio_1_aditivo.substr(0,10); }
      if(this.post.dt_inicio_2_aditivo) { this.post.dt_inicio_2_aditivo = this.post.dt_inicio_2_aditivo.substr(0,10); }
      if(this.post.dt_inicio_3_aditivo) { this.post.dt_inicio_3_aditivo = this.post.dt_inicio_3_aditivo.substr(0,10); }
      if(this.post.dt_termino_1_aditivo) { this.post.dt_termino_1_aditivo = this.post.dt_termino_1_aditivo.substr(0,10); }
      if(this.post.dt_termino_2_aditivo) { this.post.dt_termino_2_aditivo = this.post.dt_termino_2_aditivo.substr(0,10); }
      if(this.post.dt_termino_3_aditivo) { this.post.dt_termino_3_aditivo = this.post.dt_termino_3_aditivo.substr(0,10); }
    },
    converteDataInicialLauda() {
      if(this.post.dt_termino_inicial_lauda) { this.post.dt_termino_inicial_lauda = this.post.dt_termino_inicial_lauda.substr(0,10); }
    },
    converteDataDesligamento() {
      if(this.post.desligado) { this.post.desligado = this.post.desligado.substr(0,10); }
    },
    converteSemestreDesligamento() {
      if(this.post.semestre_desligamento) { this.post.semestre_desligamento = this.post.semestre_desligamento.substr(0,10); }
    },
    converteRecessos() {
      if(this.post.dt_inicial_1) { this.post.dt_inicial_1 =  this.post.dt_inicial_1.substr(0,10); }
      if(this.post.dt_inicial_2) { this.post.dt_inicial_2 =  this.post.dt_inicial_2.substr(0,10); }
      if(this.post.dt_inicial_3) { this.post.dt_inicial_3 =  this.post.dt_inicial_3.substr(0,10); }
      if(this.post.dt_inicial_4) { this.post.dt_inicial_4 =  this.post.dt_inicial_4.substr(0,10); }
      if(this.post.dt_inicial_5) { this.post.dt_inicial_5 =  this.post.dt_inicial_5.substr(0,10); }
      if(this.post.dt_inicial_6) { this.post.dt_inicial_5 =  this.post.dt_inicial_5.substr(0,10); }
      if(this.post.dt_inicial_7) { this.post.dt_inicial_7 =  this.post.dt_inicial_7.substr(0,10); }

      if(this.post.dt_termino_1) { this.post.dt_termino_1 =  this.post.dt_termino_1.substr(0,10); }
      if(this.post.dt_termino_2) { this.post.dt_termino_2 =  this.post.dt_termino_2.substr(0,10); }
      if(this.post.dt_termino_3) { this.post.dt_termino_3 =  this.post.dt_termino_3.substr(0,10); }
      if(this.post.dt_termino_4) { this.post.dt_termino_4 =  this.post.dt_termino_4.substr(0,10); }
      if(this.post.dt_termino_5) { this.post.dt_termino_5 =  this.post.dt_termino_5.substr(0,10); }
      if(this.post.dt_termino_6) { this.post.dt_termino_6 =  this.post.dt_termino_6.substr(0,10); }
      if(this.post.dt_termino_7) { this.post.dt_termino_7 =  this.post.dt_termino_7.substr(0,10); }
    },
    buscaEstagiario() {
      this.loading = true;
      this.auxiliarCpf = this.post.cpf;
      let uriEstagiario = `/api/estagiarios/${this.post.cpf}`;
      this.axios
      .get(uriEstagiario)
      .then(response => {
        this.msg.error = false;
        this.loading = false;
        this.escondeModalEstagiario();
        this.mostrarConteudoConsulta = true;
        this.estagiario = response.data;
        this.post = this.estagiario;
        this.converteNascimento();
        this.converteHorarioEntrada();
        this.converteHorarioSaida();
        this.converteDataInicio();
        this.converteDataTermino();
        this.selectVaga();
        this.converteTermosAditivos();
        this.converteDataInicialLauda();
        this.converteDataDesligamento();
        this.converteSemestreDesligamento();
        this.converteRecessos();
        this.post.cpf = this.auxiliarCpf;
      })
      .catch(error => {
        if(!this.loading) {
          setTimeout(() => {
            this.loading = true;
          }, 3000);
        }
      this.loading = false;
      this.msg.error = true;
      this.msg.erro = 'A pesquisa não retornou dados';
      this.post.cpf = this.auxiliarCpf;
      });
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
    converteConclusaoCurso() {
      let data = this.post.mes_ano_previsto_curso;
      if(data) {
          let mes = data.substr(0,2);
          let ano = data.substr(3, data.length);
          let dataFormatada = `${mes}${ano}`;
          this.post.mes_ano_previsto_curso = dataFormatada;
      }
    },
    alteraStatusVaga() {
      let uriVagas = `/api/vagas/${this.statusVaga.id}`;
      this.axios.patch(uriVagas, this.statusVaga).then(response => {
        this.msg.vagaAlterada = true
        if(this.post.situacao == 5) {
          this.msg.vagaSuccess = `O status da vaga ${this.statusVaga.id} foi alterado para LIVRE`;
        } else {
          this.msg.vagaSuccess = `O status da vaga ${this.statusVaga.id} foi atualizado`;
        }
      })
      .catch(error => {
        this.msg.vagaNaoAlterada = true
        this.msg.vagaError = `Erro ao alterar o status da vaga ${this.statusVaga.id} para LIVRE`;
      })
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
    converteDatas() {
      if(this.post.horario_entrada) {
          this.post.horario_entrada = this.post.horario_entrada.length == 8 ? `1899-12-30 ${this.post.horario_entrada}` : this.post.horario_entrada;
      }
      if(this.post.horario_saida) {
          this.post.horario_saida = this.post.horario_saida.length == 8 ? `1899-12-30 ${this.post.horario_saida}` : this.post.horario_saida;
      }
      if(this.post.dt_inicio) {
          this.post.dt_inicio == `${this.post.dt_inicio.substr(0,10)} 00:00:00` ? this.post.dt_inicio  : this.post.dt_inicio += ' 00:00:00';
      }
      if(this.post.dt_termino) {
          this.post.dt_termino == `${this.post.dt_termino.substr(0,10)} 00:00:00` ? this.post.dt_termino : this.post.dt_termino += ' 00:00:00';
      }
      if(this.post.dt_termino) {
          this.post.dt_termino_inicial_lauda = this.post.dt_termino;
      }
      if(this.post.dt_inicial_1) {
        this.post.dt_inicial_1 == `${this.post.dt_inicial_1.substr(0,10)} 00:00:00` ? this.post.dt_inicial_1 : this.post.dt_inicial_1 += ' 00:00:00';
      }

      if(this.post.dt_inicial_2) {
        this.post.dt_inicial_2 == `${this.post.dt_inicial_2.substr(0,10)} 00:00:00` ? this.post.dt_inicial_2 : this.post.dt_inicial_2 += ' 00:00:00';
      }

      if(this.post.dt_inicial_3) {
        this.post.dt_inicial_3 == `${this.post.dt_inicial_3.substr(0,10)} 00:00:00` ? this.post.dt_inicial_3 : this.post.dt_inicial_3 += ' 00:00:00';
      }

      if(this.post.dt_inicial_4) {
        this.post.dt_inicial_4 == `${this.post.dt_inicial_4.substr(0,10)} 00:00:00` ? this.post.dt_inicial_4 : this.post.dt_inicial_4 += ' 00:00:00';
      }

      if(this.post.dt_inicial_5) {
        this.post.dt_inicial_5 == `${this.post.dt_inicial_5.substr(0,10)} 00:00:00` ? this.post.dt_inicial_5 : this.post.dt_inicial_5 += ' 00:00:00';
      }

      if(this.post.dt_inicial_6) {
        this.post.dt_inicial_6 == `${this.post.dt_inicial_6.substr(0,10)} 00:00:00` ? this.post.dt_inicial_6 : this.post.dt_inicial_6 += ' 00:00:00';
      }

      if(this.post.dt_inicial_7) {
        this.post.dt_inicial_7 == `${this.post.dt_inicial_7.substr(0,10)} 00:00:00` ? this.post.dt_inicial_7 : this.post.dt_inicial_7 += ' 00:00:00';
      }

      if(this.post.dt_inicio_1_aditivo) {
        this.post.dt_inicio_1_aditivo == `${this.post.dt_inicio_1_aditivo.substr(0,10)} 00:00:00` ? this.post.dt_inicio_1_aditivo : this.post.dt_inicio_1_aditivo += ' 00:00:00';
      }

      if(this.post.dt_inicio_2_aditivo) {
        this.post.dt_inicio_2_aditivo == `${this.post.dt_inicio_2_aditivo.substr(0,10)} 00:00:00` ? this.post.dt_inicio_2_aditivo : this.post.dt_inicio_2_aditivo += ' 00:00:00';
      }

      if(this.post.dt_termino_1_aditivo) {
        this.post.dt_termino_1_aditivo == `${this.post.dt_termino_1_aditivo.substr(0,10)} 00:00:00` ? this.post.dt_termino_1_aditivo : this.post.dt_termino_1_aditivo += ' 00:00:00';
      }

      if(this.post.dt_termino_2_aditivo) {
        this.post.dt_termino_2_aditivo == `${this.post.dt_termino_2_aditivo.substr(0,10)} 00:00:00` ? this.post.dt_termino_2_aditivo : this.post.dt_termino_2_aditivo += ' 00:00:00';
      }

      if(this.post.dt_termino_1) {
        this.post.dt_termino_1 == `${this.post.dt_termino_1.substr(0,10)} 00:00:00` ? this.post.dt_termino_1 : this.post.dt_termino_1 += ' 00:00:00';
      }

      if(this.post.dt_termino_2) {
        this.post.dt_termino_2 == `${this.post.dt_termino_2.substr(0,10)} 00:00:00` ? this.post.dt_termino_2 : this.post.dt_termino_2 += ' 00:00:00';
      }

      if(this.post.dt_termino_3) {
        this.post.dt_termino_3 == `${this.post.dt_termino_3.substr(0,10)} 00:00:00` ? this.post.dt_termino_3 : this.post.dt_termino_3 += ' 00:00:00';
      }

      if(this.post.dt_termino_4) {
        this.post.dt_termino_4 == `${this.post.dt_termino_4.substr(0,10)} 00:00:00` ? this.post.dt_termino_4 : this.post.dt_termino_4 += ' 00:00:00';
      }

      if(this.post.dt_termino_5) {
        this.post.dt_termino_5 == `${this.post.dt_termino_5.substr(0,10)} 00:00:00` ? this.post.dt_termino_5 : this.post.dt_termino_5 += ' 00:00:00';
      }

      if(this.post.dt_termino_6) {
        this.post.dt_termino_6 == `${this.post.dt_termino_6.substr(0,10)} 00:00:00` ? this.post.dt_termino_6 : this.post.dt_termino_6 += ' 00:00:00';
      }

      if(this.post.dt_termino_7) {
        this.post.dt_termino_7 == `${this.post.dt_termino_7.substr(0,10)} 00:00:00` ? this.post.dt_termino_7 : this.post.dt_termino_7 += ' 00:00:00';
      }

      if(this.post.data_nascimento) {
        this.post.data_nascimento == `${this.post.data_nascimento.substr(0,10)} 00:00:00` ? this.post.data_nascimento : this.post.data_nascimento += ' 00:00:00';
      }

      if(this.post.desligado) {
        this.post.desligado == `${this.post.desligado.substr(0,10)} 00:00:00` ? this.post.desligado : this.post.desligado += ' 00:00:00';
      }

    },
    scrollTop() { 
        window.scrollTo(0,0);
    },
    inserirEstagiario() {
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
    atualizaBanco() {
      let uriEstagiarios = `/api/estagiarios/${this.auxiliarCpf}`;
      this.auxiliarCpf = this.post.cpf;   
      this.axios
      .patch(uriEstagiarios, this.post)
      .then(response => {
        this.converteNascimento();
        this.converteRecessos();
        if(this.post.dt_inicio) {
          this.post.dt_inicio = this.post.dt_inicio.substr(0,10);
        }
        if(this.post.dt_termino) {
          this.post.dt_termino = this.post.dt_termino.substr(0,10);
        }
        if(this.post.dt_termino_inicial_lauda) {
          this.post.dt_termino_inicial_lauda = this.post.dt_termino_inicial_lauda.substr(0,10);
        }
        if(this.post.dt_inicio_1_aditivo) {
          this.post.dt_inicio_1_aditivo = this.post.dt_inicio_1_aditivo.substr(0,10);
        }
        if(this.post.dt_termino_1_aditivo) {
          this.post.dt_termino_1_aditivo = this.post.dt_termino_1_aditivo.substr(0,10);
        }
        if(this.post.dt_inicio_2_aditivo) {
          this.post.dt_inicio_2_aditivo = this.post.dt_inicio_2_aditivo.substr(0,10);
        }
        if(this.post.dt_termino_2_aditivo) {
          this.post.dt_termino_2_aditivo = this.post.dt_termino_2_aditivo.substr(0,10);
        }
        if(this.post.dt_inicio_3_aditivo) {
          this.post.dt_inicio_3_aditivo = this.post.dt_inicio_3_aditivo.substr(0,10);
        }
        if(this.post.dt_termino_3_aditivo) {
          this.post.dt_termino_3_aditivo = this.post.dt_termino_3_aditivo.substr(0,10);
        }
        if(this.post.desligado) {
          this.post.desligado = this.post.desligado.substr(0,10);
        }
        this.converteHorarioEntrada();
        this.converteHorarioSaida();
        this.msg.success = true;
        this.msg.sucesso = 'Dados atualizados com sucesso!';
        this.scrollTop();
      })
      .catch(e => {
        this.converteNascimento();
        this.converteRecessos();
        if(this.post.dt_inicio) {
          this.post.dt_inicio = this.post.dt_inicio.substr(0,10);
        }
        if(this.post.dt_termino) {
          this.post.dt_termino = this.post.dt_termino.substr(0,10);
        }
        if(this.post.dt_termino_inicial_lauda) {
          this.post.dt_termino_inicial_lauda = this.post.dt_termino_inicial_lauda.substr(0,10);
        }
        if(this.post.dt_inicio_1_aditivo) {
          this.post.dt_inicio_1_aditivo = this.post.dt_inicio_1_aditivo.substr(0,10);
        }
        if(this.post.dt_termino_1_aditivo) {
          this.post.dt_termino_1_aditivo = this.post.dt_termino_1_aditivo.substr(0,10);
        }
        if(this.post.dt_inicio_2_aditivo) {
          this.post.dt_inicio_2_aditivo = this.post.dt_inicio_2_aditivo.substr(0,10);
        }
        if(this.post.dt_termino_2_aditivo) {
          this.post.dt_termino_2_aditivo = this.post.dt_termino_2_aditivo.substr(0,10);
        }
        if(this.post.dt_inicio_3_aditivo) {
          this.post.dt_inicio_3_aditivo = this.post.dt_inicio_3_aditivo.substr(0,10);
        }
        if(this.post.dt_termino_3_aditivo) {
          this.post.dt_termino_3_aditivo = this.post.dt_termino_3_aditivo.substr(0,10);
        }
        if(this.post.desligado) {
          this.post.desligado = this.post.desligado.substr(0,10);
        }
        this.converteHorarioEntrada();
        this.converteHorarioSaida();
        this.msg.error = true;
        this.msg.erro = 'Erro ao atualizar dados';
        this.scrollTop();
      })
    },
    selectVaga() {
      if(this.post.cod_vaga) {
        let uriStatusVaga = `/api/vagas/${this.post.cod_vaga}`;
        this.axios.get(uriStatusVaga).then(response => this.statusVaga = response.data);
      }
    }
  }
}
</script>

<style scoped>
.ul-estagiario {
  margin: 0;
  padding: 0;
  border: 1px solid #ccc;
  border-radius: 0px 0px 20px 20px;
}
.ul-estagiario .item-estagiario {
  list-style: none;
  margin-left: 10px;
  cursor:pointer;
}
.fim-lista {
  margin-top: 20px;
  list-style: none;
}
.card {
  width: 98%;
}
.card-body {
  height: 100%;
}
</style>
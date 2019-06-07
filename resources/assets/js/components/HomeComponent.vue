<template>
  <div class="" id="app">

    <div class="container-fluid">
      <div class="row">
        <div class="col-3">
            <aside-component :showModal="showModal"></aside-component>

          <div>
            <b-modal ref="my-modal" hide-footer title="Consulta de Estagiários">
              <b-form ref="form" @submit="validaCpf" action="/teste">
                  <label for="inputCpf">Digite o CPF do Estagiário</label>
                    <the-mask type="text"
                      @input="validaCpf"
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
                            <b-card-text id="dado">
                              <dados-pessoais
                                :post="post"
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
      cpfValido: false,
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
      }
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
    validaCpf() {
      let cpf = this.post.cpf
        if(cpf.length < 11) {
          this.cpfInvalido = true;
          this.cpfValido = false;
        } else {
          this.cpfInvalido = false;
          this.cpfValido = true;
        }
    },
    buscaEstagiario() {
      let uriEstagiario = `http://localhost:8000/api/estagiarios/${this.post.cpf}`;
      this.axios
      .get(uriEstagiario)
      .then(response => {
        this.hideModal();
        this.estagiario = response.data;
        this.post = this.estagiario;
        this.main = false;
        console.log(this.estagiario);
      })
      .catch(error => {
      this.msg.error = true;
      this.msg.erro = 'A pesquisa não retornou dados';
      });
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
    validaCpf(cpf) { this.validacao(cpf, 'cpfValido') },
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
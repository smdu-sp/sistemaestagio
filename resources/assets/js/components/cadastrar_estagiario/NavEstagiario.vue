<template>
<div>
    <h1 class="d-flex justify-content-center">Cadastro de Estagiário</h1>

    <div  v-if="msg.error" class="alert alert-danger">
        {{ msg.erro }}
    </div>
    <div v-if="msg.success" class="alert alert-success">
        {{ msg.sucesso }}
    </div>

    <div v-if="revisarCampos" class="alert alert-danger" id="revisar">
        Revise os campos em vermelho
    </div>

    <modal-component></modal-component><!-- Modal acionado pelo componente Botoes.vue -->

   <!-- Exibe este modal caso o usuario clique no botao de cadastrar supervisor -->
    <b-modal v-model="exibeModalSupervisor" size="lg" ok-only>
        <cadastro-supervisor-component></cadastro-supervisor-component>
    </b-modal>

    <b-modal v-model="exibeModalCartaoAcesso" size="lg" ok-only>
        <cadastro-cartao-acesso-component></cadastro-cartao-acesso-component>
    </b-modal>

    <b-modal v-model="exibeModalVaga" size="lg" ok-only>
        <cadastro-vaga-component></cadastro-vaga-component>
    </b-modal>

    <div> <!-- Exibe este modal caso o cpf já exista na base de dados -->
        <b-modal v-model="modalCpf" ok-only>
            <p>O CPF inserido já existe na base de dados</p>
            <p>Digite outro por favor</p>
        </b-modal>
    </div>

    <div> <!-- Exibe este modal caso o cod de estudante já exista na base de dados -->
        <b-modal v-model="modalCodEstudante" ok-only>
            <p>O Código de estudante inserido já existe na base de dados</p>
            <p>Digite outro por favor</p>
        </b-modal>
    </div>

    <!-- Formulários -->
    <b-card no-body>
        <b-tabs card>
            <b-tab title="Dados Pessoais" active>
                <b-card-text>
                    <dados-pessoais
                    :post="post"
                    :cartoes="cartoes"
                    :estados="estados"
                    :instituicoes="instituicoes"
                    :cursos="cursos"
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
                    :abreModalCartaoAcesso="abreModalCartaoAcesso"
                    :carregaCartaoAcesso="carregaCartaoAcesso"
                    />
                </b-card-text>
            </b-tab>
            <b-tab title="Informações Contratuais">
                <b-card-text>
                    <informacoes-contratuais
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
                    :abreModalSupervisor="abreModalSupervisor"
                    :carregaSupervisor="carregaSupervisor"
                    :abreModalVaga="abreModalVaga"
                    :carregaVaga="carregaVaga"
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
    </div>
</template>
<script>
export default {
    data() {
        return {
            post: {},
            vagas: {},
            statusVaga: {},
            cartoes: {},
            estados: {},
            instituicoes: {},
            cursos: {},
            departamentos: {},
            supervisores: {},
            dadosPessoais: {},
            informacoesContratuais: {},
            dadosBancarios: {},
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
            msg: {
                error: false,
                success: false,
            },
            arrayCamposInvalidos: [],
            revisarCampos: false,
            camposValidacao: [],
            modalShow: false,
            modalCpf: false,
            modalCodEstudante: false,
            exibeModalSupervisor: false,
            contadorCadastro: 0,
            exibeModalCartaoAcesso: false,
            exibeModalVaga: false,
            urlPadrao: 'http://localhost:8000/api/'
        }
    },
    beforeMount() {
        const uriCartoes = this.urlPadrao+'cartao';
        const uriEstados = this.urlPadrao+'estados';
        const uriInstituicoes = this.urlPadrao+'instituicao';
        const uriCursos = this.urlPadrao+'cursos';
        const uriDepartamentos = this.urlPadrao+'departamentos';
        const uriSupervisores = this.urlPadrao+'supervisores'; 
        const uriVagas = this.urlPadrao+'vagas';

        this.requisicaoGet(uriCartoes, 'cartoes');
        this.requisicaoGet(uriEstados, 'estados');
        this.requisicaoGet(uriInstituicoes, 'instituicoes');
        this.requisicaoGet(uriCursos, 'cursos');
        this.requisicaoGet(uriDepartamentos, 'departamentos');
        this.requisicaoGet(uriSupervisores, 'supervisores');
        this.requisicaoGet(uriVagas, 'vagas');
    },
    methods: {
        abreModalVaga() {
            this.exibeModalVaga = !this.exibeModalVaga;
        },
        carregaVaga() {
            const uriVagas = this.urlPadrao+'vagas';

            this.requisicaoGet(uriVagas, 'vagas');
        },
        abreModalCartaoAcesso() {
            this.exibeModalCartaoAcesso = !this.exibeModalCartaoAcesso;
        },
        carregaCartaoAcesso() {
            const uriCartoes = this.urlPadrao+'cartao';

            this.requisicaoGet(uriCartoes, 'cartoes');
        },
        carregaSupervisor() {
            const uriSupervisores = this.urlPadrao+'supervisores';

            this.requisicaoGet(uriSupervisores, 'supervisores');
        },
        abreModalSupervisor() {
            this.exibeModalSupervisor = !this.exibeModalSupervisor;
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
            let uriVagas = `${this.urlPadrao}vagas/${this.statusVaga.id}`;
            this.axios.patch(uriVagas, this.statusVaga).then(response => response);
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
        cadastraBanco() {
            let uriEstagiarios = this.urlPadrao+'estagiarios';
            this.axios
            .post(uriEstagiarios, this.post)
            .then(response => {
                this.msg.sucesso = 'Estagiário Cadastrado com sucesso!';
                this.msg.success = true;

                for(let key in this.post) {
                    this.post[key] = '';
                }
            })
            .catch(e => {
                this.msg.erro = 'Erro ao cadastrar estagiário';
                this.msg.error = true;
            })
        },
        scrollTop() { 
            window.scrollTo(0,0);
        },
        validaCampos() {
            this.camposValidacao = [
                {nomeValido: this.post.nome},
                {codValido: this.post.cod_estudante},
                {vagaValida: this.post.cod_vaga},
                {contratanteValido: this.post.contratado_por},
                {enderecoValido: this.post.endereco},
                {complementoValido: this.post.nro},
                {bairroValido: this.post.bairro},
                {estadoValido: this.post.estado},
                {cepValido: this.post.cep},
                {celularValido: this.post.fone_celular},
                {nacionalidadeValida: this.post.nacionalidade},
                {naturalidadeValida: this.post.naturalidade},
                {racaValida: this.post.raca_cor},
                {cpfValido: this.post.cpf},
                {rgValido: this.post.rg},
                {emailValido: this.post.email_pessoal},
                {instituicaoValida: this.post.instituicao_ensino},
                {cursoValido: this.post.curso_formacao},
                {departamentoValido: this.post.dep_hierarquico},
                {setorValido: this.post.setor_estagiado},
                {supervisorValido: this.post.supervisor},
                {dataInicioValida: this.post.dt_inicio},
                {dataFimValida: this.post.dt_inicio},
                {horarioEntradaValido: this.post.horario_entrada},
                {horarioSaidaValido: this.post.horario_saida},
                {situacaoValida: this.post.situacao}
            ]
            
            let contadorCamposInvalidos = 0
            for(let i = 0; i <= this.camposValidacao.length; i++) {
                for(let key in this.camposValidacao[i]) {
                    if(this.camposValidacao[i][key]) {
                        this[key] = false
                        this.revisarCampos = false;
                    } else {
                        this[key] = true;
                        this.revisarCampos = true;
                        contadorCamposInvalidos++;
                    }
                }
            }

            if(contadorCamposInvalidos == 0) {
                this.cadastraBanco();
            } else {
                this.scrollTop();
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
            this.validaCampos();
        },
        requisicaoGet(uri, variavel) {
            this.axios.get(uri).then(response => {
                this[variavel] = response.data
            })
        },
        selectVaga() {
            let uriStatusVaga = `${this.urlPadrao}vagas/${this.post.cod_vaga}`;
            this.axios.get(uriStatusVaga).then(response => this.statusVaga = response.data);
        },
        validacao(valorCampo, variavelBooleana) {
            if(!valorCampo.target.value) {
                this[variavelBooleana] = true
            } else {
                this[variavelBooleana] = false
            }
        },
        verificaDuplicidadeCpf() {
            if(this.post.cpf.length == 11) {
                const uriCpf = `${this.urlPadrao}estagiarios/${this.post.cpf}`;

                this.axios
                .get(uriCpf)
                .then(response => {
                    this.modalCpf = !this.modalCpf;
                    this.cpfValido = true;
                    this.post.cpf = '';
                })
                .catch(error => {

                })
            }
        },
        verificaDuplicidadeCodEstudante() {
            if(this.post.cod_estudante) {
                const uriCodEstudante = `${this.urlPadrao}cod/${this.post.cod_estudante}`;

                this.axios
                .get(uriCodEstudante)
                .then(response => {
                    this.modalCodEstudante = !this.modalCodEstudante;
                    this.codValido = true;
                    this.post.cod_estudante = '';
                })
                .catch(error => {

                })
            }
        },
        validaNome(nome) { this.validacao(nome, 'nomeValido') },
        validaCodEstudante(cod) { 
            this.validacao(cod, 'codValido');
            this.verificaDuplicidadeCodEstudante();
        },
        validaContratante(contratante) { this.validacao(contratante, 'contratanteValido') },
        validaVaga(vaga) { this.validacao(vaga, 'vagaValida'); },
        validaEndereco(endereco) { this.validacao(endereco, 'enderecoValido') },
        validaComplemento(complemento) { this.validacao(complemento, 'complementoValido') },
        validaBairro(bairro) { this.validacao(bairro, 'bairroValido') },
        validaEstado(estado) { this.validacao(estado, 'estadoValido')},
        validaCep(cep) { this.validacao(cep, 'cepValido'); },
        validaCelular(celular) { this.validacao(celular, 'celularValido') },
        validaNacionalidade(nacionalidade) { this.validacao(nacionalidade, 'nacionalidadeValida')},
        validaNaturalidade(naturalidade) { this.validacao(naturalidade, 'naturalidadeValida') },
        validaRaca(raca) { this.validacao(raca, 'racaValida') },
        validaCpf(cpf) { 
            this.validacao(cpf, 'cpfValido');
            this.verificaDuplicidadeCpf();            
        },
        validaRg(rg) { this.validacao(rg, 'rgValido') },
        validaEmail(email) { this.validacao(email, 'emailValido') },
        validaInstituicao(instituicao) { this.validacao(instituicao, 'instituicaoValida') },
        validaCurso(curso) { this.validacao(curso, 'cursoValido') },
        validaDepartamento(departamento) { this.validacao(departamento, 'departamentoValido') },
        validaSetor(setor) { this.validacao(setor, 'setorValido') },
        validaSupervisor(supervisor) { this.validacao(supervisor, 'supervisorValido') },
        validaHorarioEntrada(horaEntrada) { this.validacao(horaEntrada, 'horarioEntradaValido') },
        validaHorarioSaida(horaSaida) { this.validacao(horaSaida, 'horarioSaidaValido') },
        validaSituacao(situacao) { this.validacao(situacao, 'situacaoValida') }
    }
}

</script>
<style>
.col-3 {
    margin: 0;
    padding: 0;
}
.col-2 {
    margin: 0;
    padding: 0;
}
b-card {
    max-width: 100%;
}
.container-fluid {
    margin: 0;
    padding: 0;
}
.card-body {
    height: auto;
}
.card {
  width: 98%;
}
.white {
    width: 100%;
    background-color: white;
    height: 323px;
}
</style>
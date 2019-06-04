<template>
    <div class="container">
        <!--row-->
        <div class="row">
            <div class="col-3">
                <aside-component></aside-component>
            </div>
            <!--col-9-->
            <div class="col-9">
                <header-component></header-component>
                <h1 class="d-flex justify-content-center">Cadastro de Estagiário</h1>

                <div  v-if="msg.error" class="alert alert-danger">
                    {{ msg.erro }}
                </div>
                <div v-if="msg.success" class="alert alert-success">
                    {{ msg.sucesso }}
                </div>

                <!-- Formulários -->
                <b-card no-body>
                    <b-tabs card>
                        <b-tab title="Dados Pessoais" active>
                            <b-card-text id="dado">
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
            </div><!--/col-9-->
        </div><!-- /row -->
    </div><!--/container-->
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
        inserirEstagiario() {
            this.converteCep();
            this.alteracaoSupervisor();
            this.horarioVariavel();
            this.dataModificacao();
            this.horaModificacao();
            this.converteCelular();
            this.converteFone();
            this.converteConclusaoCurso();
            this.alteraStatusVaga();
            this.converteDatas();
            this.cadastraBanco();
        },
        requisicaoGet(uri, variavel) {
            this.axios.get(uri).then(response => {
                this[variavel] = response.data
            })
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
        cadastraBanco() {
            let uriEstagiarios = 'http://localhost:8000/api/estagiarios';
            this.axios
            .post(uriEstagiarios, this.post)
            .then(response => {
                this.msg.sucesso = 'Estagiário Cadastrado com sucesso!';
                this.msg.success = true;
            })
            .catch(e => {
                this.msg.erro = 'Erro ao cadastrar estagiário';
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
        validaNome(nome) { this.validacao(nome, 'nomeValido') },
        validaCodEstudante(cod) { this.validacao(cod, 'codValido') },
        validaContratante(contratante) { this.validacao(contratante, 'contratanteValido') },
        validaVaga(vaga) { this.validacao(vaga, 'vagaValida'); },
        validaEndereco(endereco) { this.validacao(endereco, 'enderecoValido') },
        validaComplemento(complemento) { this.validacao(complemento, 'complementoValido') },
        validaBairro(bairro) { this.validacao(bairro, 'bairroValido') },
        validaEstado(estado) { this.validacao(estado, 'estadoValido')},
        validaCep(cep) { this.validacao(cep, 'cepValido'); },
        validaFone(fone) { this.validacao(fone, 'foneValido') },
        validaCelular(celular) { this.validacao(celular, 'celularValido') },
        validaNacionalidade(nacionalidade) { this.validacao(nacionalidade, 'nacionalidadeValida') },
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
        validaHorarioSaida(HoraSaida) { this.validacao(HoraSaida, 'horarioSaidaValido') },
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
<style>
.card-body {
    height: auto;
}
aside{
    height: 100%;
}
.white {
    width: 100%;
    background-color: white;
    height: 323px;
}
</style>
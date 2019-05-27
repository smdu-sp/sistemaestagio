<template>
    <div class="container">
        <div class="row">
            <div class="col-3">
                <aside-component></aside-component>
            </div>
            <div class="col-9">
                <header-component></header-component>
                <h1 class="d-flex justify-content-center">Cadastro de Estagiário</h1>
            <div>
        </div>

                <!--box-->
                <div class="box">
                    <!--início box formulários-->
                    <div class="col-md-12">
                        <div class="row">
                            <div class="d-flex arredondado pt-1">
                                <a @click="botao = 'dadosPessoais'" class="aba ml-2 d-flex flex-column justify-content-center align-items-center">
                                    Dados Pessoais
                                </a>

                                <a @click="botao = 'infoContratuais'" class="aba d-flex flex-column justify-content-center align-items-center">
                                    Informações Contratuais
                                </a>

                                <a @click="botao = 'dadosBancarios'" class="aba d-flex flex-column justify-content-center align-items-center">
                                    Dados Bancários
                                </a>
                            </div>
                        </div>

                        <!--Dados Pessoais-->
                        <div class="col-12 p-3" v-show="botao == 'dadosPessoais'">
                            <form @submit="inserirEstagiario" method="post">
                                <!--row-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="inputNome">Nome</label>
                                            <input type="text" class="form-control" id="inputNome" placeholder="Digite o Nome Completo" required>
                                            <div class="invalid-feedback">
                                                Por favor, digite o nome do estagiário.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Nome Social</label>
                                            <input type="text" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="selectContratante">Contratado Por</label>
                                            <select class="form-control" id="selectContratante" v-model="post.contratado_por" required>
                                                <option></option>
                                                <option>SMDU</option>
                                                <option>SEL</option>
                                                <option>SMUL</option>
                                            </select>
                                        </div>
                                    </div>
                                </div><!--/row-->

                                <!--row-->
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="inputEstudante">Cód. Estudante</label>
                                            <input type="text" class="form-control" id="inputEstudante" v-model="post.cod_estudante" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="inputContrato">Contrato CIEE</label>
                                            <input type="text" class="form-control" id="inputContrato" v-model="post.contrato" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="inputTceSuperEstagios">TCE Super Estágios</label>
                                            <input type="text" class="form-control" id="inputTceSuperEstagios" v-model="post.tc_superestagios">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="selectCartao">Cartão Acesso</label>
                                            <select class="form-control" id="selectCartao" v-model="post.cartao_acesso">
                                                <option></option>
                                                <option v-for="cartao of cartoes">{{ cartao.id }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="inputEndereco">Endereço</label>
                                            <input type="text" class="form-control" id="inputEndereco" v-model="post.endereco" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="inputComplemento">nº / Complemento</label>
                                            <input type="text" class="form-control" id="inputComplemento" v-model="post.nro" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="inputBairro">Bairro</label>
                                            <input type="text" class="form-control" id="inputBairro" v-model="post.bairro" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="selectEstado">Estado</label>
                                            <select class="form-control" id="selectEstado" v-model="post.estado" required>
                                                <option></option>
                                                <option v-for="estado of estados" :value="estado.estado">{{ estado.estado }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div><!--/row-->

                                <!--row-->
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="inputCep">CEP</label>
                                            <input type="text" class="form-control" id="inputCep" v-model="post.cep" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="inputFone">Fone Res.</label>
                                            <input type="text" class="form-control"  id="inputFone" v-model="post.fone_residencial">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="inputCel">Fone celular</label>
                                            <input type="text" class="form-control" id="inputCel" v-model="post.fone_celular">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="inputNascimento">Nascimento</label>
                                            <input type="date" class="form-control" id="inputNascimento" v-model="post.data_nascimento" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="inputIdade">Idade</label>
                                            <input type="text" class="form-control" id="inputIdade" v-model="post.idade" required>
                                        </div>
                                    </div>
                                </div><!--/row-->

                                <!--row-->
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="inputNaturalidade">Naturalidade</label>
                                            <input type="text" class="form-control" id="inputNaturalidade" v-model="post.naturalidade">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="inputNacionalidade">Nacionalidade</label>
                                            <input type="text" class="form-control" id="inputNacionalidade" v-model="post.nacionalidade" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="inputRaca">Raça/Cor</label>
                                            <select class="form-control" id="inputRaca" v-model="post.raca_cor" required>
                                                <option value="0">Não Definido</option>
                                                <option value="1">Branco(a)</option>
                                                <option value="2">Pardo(a)</option>
                                                <option value="3">Amarelo(a)</option>
                                                <option value="4">Preto(a)</option>
                                                <option value="5">Indígena</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="selectSexo">Sexo</label>
                                            <select class="form-control" id="selectSexo" v-model="post.sexo" required>
                                                <option>Masculino</option>
                                                <option>Feminino</option>
                                            </select>
                                        </div>
                                    </div>
                                </div><!--/row-->

                                <!--row-->
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="inputCpf">CPF</label>
                                            <input type="text" class="form-control" id="inputCpf" v-model="post.cpf" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="inputRg">RG</label>
                                            <input type="text" class="form-control" id="inputRg" v-model="post.rg" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="selectOrgao">Órgão exp.</label>
                                            <select class="form-control" id="selectOrgao" v-model="post.orgao_expedidor_rg" required>
                                                <option>SSP</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="selectEstadoRg">UF/RG</label>
                                            <select class="form-control" id="selectEstadoRg" v-model="post.uf_rg" required>
                                                <option v-for="estado of estados" :value="estado.estado">{{ estado.uf }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="inputRne">RNE</label>
                                            <input type="text" class="form-control" v-model="post.rne">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="selectEstadoCivil">Estado Civil</label>
                                            <select type="text" class="form-control" id="selectEstadoCivil" v-model="post.estado_civil" required>
                                                <option>Solteiro(a)</option>
                                                <option>Casado(a)</option>
                                                <option>Divorciado(a)</option>
                                                <option>Viúvo(a)</option>
                                                <option>Separado(a)</option>
                                                <option>Companheiro(a)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div><!--/row-->

                                <!--row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputMae">Nome da Mãe</label>
                                            <input type="text" class="form-control" id="inputMae" v-model="post.nome_mae">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputPai">Nome do Pai</label>
                                            <input type="text" class="form-control" id="inputPai" v-model="post.nome_pai">
                                        </div>
                                    </div>
                                </div><!--/row-->

                                <!--row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputEmailPessoal">E-mail pessoal</label>
                                            <input type="email" class="form-control" id="inputEmailPessoal" v-model="post.email_pessoal" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputEmailCorporativo">E-mail corporativo</label>
                                            <input type="email" class="form-control" id="inputEmailCorporativo" v-model="post.email_corporativo">
                                        </div>
                                    </div>
                                </div><!--/row-->

                                <!--row-->
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="selectInstituicao">Instituíção de Ensino</label>
                                            <select class="form-control" id="selectInstituicao" v-model="post.instituicao_ensino" required>
                                                <option v-for="instituicao of instituicoes" :value="instituicao.razao_social">{{ instituicao.razao_social }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="selectCurso">Curso/Formação</label>
                                            <select class="form-control" id="selectCurso" v-model="post.curso_formacao" required>
                                                <option v-for="curso of cursos" :value="curso.id">{{ curso.formacao }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="selectAno">Ano/Semestre</label>
                                            <select class="form-control" id="selectAno" v-model="post.ano_semestre" required>
                                                <option>1º/1º</option>
                                                <option>1º/2º</option>
                                                <option>2º/1º</option>
                                                <option>2º/2º</option>
                                                <option>3º/1º</option>
                                                <option>3º/2º</option>
                                                <option>4º/1º</option>
                                                <option>4º/2º</option>
                                                <option>5º/1º</option>
                                                <option>5º/2º</option>
                                            </select>
                                        </div>
                                    </div>
                                </div><!--/row-->
                                
                                <!--row-->
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="selectPeriodo">Período</label>
                                            <select class="form-control" id="selectPeriodo" v-model="post.periodo" required>
                                                <option>Manhã</option>
                                                <option>Tarde</option>
                                                <option>Noite</option>
                                                <option>Variável</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="inputHorario">Horário</label>
                                            <input type="text" class="form-control" id="inputHorario" v-model="post.horario">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="inputDuracaoCurso">Duração do Curso</label>
                                            <input type="number" class="form-control" id="inputDuracaoCurso" maxlength="2" v-model="post.duracao_curso">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="inputMesConclusao">Mês/Ano de Conclusão</label>
                                            <input type="text" class="form-control" id="inputMesConclusao" v-model="post.mes_ano_previsto_curso" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="inputMatricula">Matrícula</label>
                                            <input type="text" class="form-control" id="inputMatricula" v-model="post.matricula">
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="textareaObservacoes">Observações</label>
                                            <textarea rows="4" class="form-control" id="textareaObservacoes" v-model="post.observacoes1"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <botoes-component></botoes-component>
                        </form>

                        </div><!--/Dados Pessoais-->


                        <!--Informações contratuais-->
                        <div class="col-12 p-3" v-show="botao == 'infoContratuais'">
                            <form @submit="inserirEstagiario" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="selectDepartamento">Dep. Hierárquico</label>
                                        <select class="form-control" id="selectDepartamento" v-model="post.dep_hierarquico" required>
                                            <option></option>
                                            <option v-for="departamento of departamentos">{{ departamento }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="setor-estag">
                                        <label for="selectSetor">Setor Estagiado</label>
                                        <select class="form-control" id="selectSetor" v-model="post.setor_estagiado" required>
                                            <option></option>
                                            <option v-model="post.setor_estagiado"></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputSupervisor">Supervisor</label>
                                        <select class="form-control" id="inputSupervisor" v-model="post.supervisor" required>
                                            <option></option>
                                            <option v-for="supervisor of supervisores">{{ supervisor.nome }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputInicio">Data Início</label>
                                            <input type="date" class="form-control" id="inputInicio" v-model="post.dt_inicio" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputTermino">Data Término</label>
                                            <input type="date" class="form-control" id="inputTermino" v-model="post.dt_termino" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputTerminoInicial">Data Término Inicial</label>
                                            <input type="date" class="form-control" id="inputTerminoInicial" v-model="post.dt_termino_inicial_lauda">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputHorarioEntrada">Horário de Entrada</label>
                                        <input type="text" class="form-control" id="inputHorarioEntrada" v-model="post.horario_entrada">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputHorarioSaida">Horário de Saída</label>
                                        <input type="text" class="form-control" id="inputHorarioSaida" v-model="post.horario_saida">
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex flex-column justify-content-center">
                                    <div class="form-group">
                                        <input type="checkbox" v-model="post.horario_variavel">Horário variável
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputSituacao">Situação</label>
                                        <select id="inputSituacao" class="form-control" v-model="post.situacao" required>
                                            <option>CONTRATADO</option>
                                            <option>DESLIGADO</option>
                                            <option>EM CONTRATAÇÃO</option>
                                            <option>EM DESLIGAMENTO</option>
                                            <option>EM RENOVAÇÃO</option>
                                            <option>TCE CANCELADO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputObs">Observações</label>
                                        <textarea cols="30" rows="4" class="form-control" id="inputObs" v-model="post.situacao"></textarea>
                                    </div>
                                </div>
                            </div>
                            <botoes-component></botoes-component>
                        </form>

                        </div><!--/Informações contratuais-->

                        <!--Dados Bancários-->
                        <div class="col-12 p-3" v-show="botao == 'dadosBancarios'">
                                <form @submit.prevent="inserirEstagiario" method="post">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="selectBanco">Instituição Bancária</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="form-control" id="selectBanco" v-model="post.instituicao_bancaria" required>
                                                        <option></option>
                                                        <option>BANCO DO BRASIL</option>
                                                        <option>BRADESCO</option>
                                                        <option>ITAU</option>
                                                        <option>SANTANDER</option>
                                                    </select>
                                                </div>
                                            </div>                    
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="inputAgencia">Agência</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="number" class="form-control" id="inputAgencia" v-model="post.agencia" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="inputConta">Conta</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="number" class="form-control" id="inputConta" v-model="post.conta" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="inputOperacao">Operação</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="form-control" v-model="post.operacao" id="inputOperacao">
                                                        <option>CORRENTE</option>
                                                        <option>POUPANÇA</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <botoes-component></botoes-component>
                            </form>

                        </div><!--/Dados Bancários-->
                    </div><!--fim box formulários-->
                </div><!--/box-->
            </div>
        </div><!-- /row -->
    </div><!--/container-->
</template>
<script>
export default {
    data() {
        return {
            post: {},
            cartoes: {},
            estados: {},
            instituicoes: {},
            cursos: {},
            departamentos: {},
            supervisores: {},
            botao: 'dadosPessoais',
            dadosPessoais: {},
            informacoesContratuais: {},
            dadosBancarios: {},
            validacaoNome: false,
            erro: {}
        }
    },
    created() {
        let uriCartoes = 'http://localhost:8000/api/cartao';
        let uriEstados = 'http://localhost:8000/api/estados';
        let uriInstituicoes = 'http://localhost:8000/api/instituicao';
        let uriCursos = 'http://localhost:8000/api/cursos';
        let uriDepartamentos = 'http://localhost:8000/api/departamentos';
        let uriSupervisores = 'http://localhost:8000/api/supervisores'; 

        this.axios.get(uriCartoes).then(response => this.cartoes = response.data);
        this.axios.get(uriEstados).then(response => this.estados = response.data);
        this.axios.get(uriInstituicoes).then(response => this.instituicoes = response.data);        
        this.axios.get(uriCursos).then(response => this.cursos = response.data);
        this.axios.get(uriDepartamentos).then(response => this.departamentos = response.data);
        this.axios.get(uriSupervisores).then(response => this.supervisores = response.data);
      
    },
    methods: {
        inserirEstagiario() {
            let uriEstagiarios = 'http://localhost:8000/api/estagiarios';
            this.axios
            .post(uriEstagiarios, this.post)
            .then(response => {
                this.erro.msg = 'Sucesso'
                console.log(this.post)
            })
            .catch(e => {
                this.erro.message = 'Erro'
                console.log(this.post)
            })
        }
    }
}
</script>
<style>
.col-3 {
    height: 100vh;
}
.box {
    width: 100%;
    height: auto;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.box .arredondado a {
    height: 35px;
    padding: 5px;
    color: #007bff;
    margin-right: 2px;
    margin-top: 10px;
    cursor: pointer;
}

.box .arredondado a:link {

}

.box .arredondado a:visited {

}

.box .arredondado a:hover {
    color: #0056b3;
    border: 1px solid #ccc;
    border-radius: 5px 5px 0px 0px;
    border-bottom: none;
}

.box .arredondado a:active {
    border-radius: 5px 5px 0 0;
    height: 35px;
    border-left: 1px solid #ccc;
    border-top: 1px solid #ccc;
    border-right: 1px solid #ccc;
    border-bottom: 1px solid #fff;
    padding: 5px;
    color: #007bff;
    margin-right: 2px;
    background-color: white;
    margin-top: 10px;
}


button {
    
}

/* button:hover {
    color: #007bff;
} */

.arredondado {
    width: 100%;
    border-radius: 5px 5px 0px 0px;
    border-bottom: 1px solid #dee2e6;
    background-color: #f8f9fa;
}
</style>
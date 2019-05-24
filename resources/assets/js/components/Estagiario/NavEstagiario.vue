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

                <!--quadrado-->
                <div class="quadrado">
                    <!--início box formulários-->
                    <div class="col-md-12">
                        <div class="row">
                            <button @click="botao = 'dadosPessoais'" class="aba d-flex flex-column justify-content-center align-items-center">
                                Dados Pessoais
                            </button>

                            <button @click="botao = 'infoContratuais', gravaDadosPesoais() || gravaDadosBancarios()" class="aba d-flex flex-column justify-content-center align-items-center">
                                Informações Contratuais
                            </button>

                            <button @click="botao = 'dadosBancarios', gravaInformacoesContratuais() || gravaDadosPesoais()" class="aba d-flex flex-column justify-content-center align-items-center">
                                Dados Bancários
                            </button>
                        </div>

                    {{ botao }}

                        <!--Dados Pessoais-->
                        <div class="col-12 p-3" v-if="botao == 'dadosPessoais'">
                            <form @submit="inserirEstagiario" method="post">
                                <!--row-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nome</label>
                                            <input type="text" class="form-control" >
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
                                            <label for="contratadtante">Contratado Por</label>
                                            <select class="form-control" id="contratante" >
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
                                            <label>Cód. Estudante</label>
                                            <input type="text" class="form-control" v-model="post.cod_estudante">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Contrato CIEE</label>
                                            <input type="text" class="form-control" v-model="post.contrato">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>TCE Super Estágios</label>
                                            <input type="text" class="form-control" v-model="post.tc_superestagios">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="cartao">Cartão Acesso</label>
                                            <select class="form-control" id="cartao" v-model="post.cartao_acesso">
                                                <option></option>
                                                <option v-for="cartao of cartoes">{{ cartao.id }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Endereço</label>
                                            <input type="text" class="form-control" v-model="post.endereco">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>nº / Complemento</label>
                                            <input type="text" class="form-control" v-model="post.nro">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Bairro</label>
                                            <input type="text" class="form-control" v-model="post.bairro">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="estado">Estado</label>
                                            <select class="form-control" id="estado" v-model="post.estado">
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
                                            <label>CEP</label>
                                            <input type="text" class="form-control" v-model="post.cep">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Fone Res.</label>
                                            <input type="text" class="form-control" v-model="post.fone_residencial">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Fone celular</label>
                                            <input type="text" class="form-control" v-model="post.fone_celular">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="data_nascimento">Nascimento</label>
                                            <input type="date" class="form-control" id="data_nascimento" v-model="post.data_nascimento">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Idade</label>
                                            <input type="text" class="form-control" v-model="post.idade">
                                        </div>
                                    </div>
                                </div><!--/row-->

                                <!--row-->
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Naturalidade</label>
                                            <input type="text" class="form-control" v-model="post.naturalidade">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Nacionalidade</label>
                                            <input type="text" class="form-control" v-model="post.nacionalidade">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Raça/Cor</label>
                                            <select class="form-control" v-model="post.raca_cor">
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
                                            <label>Sexo</label>
                                            <select class="form-control" v-model="post.sexo">
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
                                            <label>CPF</label>
                                            <input type="text" class="form-control" v-model="post.cpf">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>RG</label>
                                            <input type="text" class="form-control" v-model="post.rg">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Órgão exp.</label>
                                            <select class="form-control" v-model="post.orgao_expedidor_rg">
                                                <option>SSP</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>UF/RG</label>
                                            <select class="form-control" id="estado" v-model="post.uf_rg">
                                                <option v-for="estado of estados" :value="estado.estado">{{ estado.uf }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>RNE</label>
                                            <input type="text" class="form-control" v-model="post.rne">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Estado Civil</label>
                                            <select type="text" class="form-control" v-model="post.estado_civil">
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
                                            <label>Nome da Mãe</label>
                                            <input type="text" class="form-control" v-model="post.nome_mae">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nome do Pai</label>
                                            <input type="text" class="form-control" v-model="post.nome_pai">
                                        </div>
                                    </div>
                                </div><!--/row-->

                                <!--row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>E-mail pessoal</label>
                                            <input type="email" class="form-control" v-model="post.email_pessoal">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>E-mail corporativo</label>
                                            <input type="email" class="form-control" v-model="post.email_corporativo">
                                        </div>
                                    </div>
                                </div><!--/row-->

                                <!--row-->
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Instituíção de Ensino</label>
                                            <select class="form-control" v-model="post.instituicao_ensino">
                                                <option v-for="instituicao of instituicoes" :value="instituicao.razao_social">{{ instituicao.razao_social }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Curso/Formação</label>
                                            <select class="form-control" v-model="post.curso_formacao">
                                                <option v-for="curso of cursos" :value="curso.id">{{ curso.formacao }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Ano/Semestre</label>
                                            <select class="form-control" v-model="post.ano_semestre">
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
                                            <label>Período</label>
                                            <select class="form-control" v-model="post.periodo">
                                                <option>Manhã</option>
                                                <option>Tarde</option>
                                                <option>Noite</option>
                                                <option>Variável</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Horário</label>
                                            <input type="text" class="form-control" v-model="post.horario">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Duração do Curso</label>
                                            <input type="number" class="form-control" maxlength="2" v-model="post.duracao_curso">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Mês/Ano de Conclusão</label>
                                            <input type="text" class="form-control" v-model="post.mes_ano_previsto_curso">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Matrícula</label>
                                            <input type="text" class="form-control" v-model="post.matricula">
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Observações</label>
                                            <textarea rows="4" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                        </form>

                        </div><!--/Dados Pessoais-->


                        <!--Informações contratuais-->
                        <div class="col-12 p-3" v-if="botao == 'infoContratuais'">
                            <form @submit="inserirEstagiario" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dep_hier">Dep. Hierárquico</label>
                                        <select class="form-control" id="dep_hier">
                                            <option></option>
                                            <option v-for="departamento of departamentos" v-model="post.dep_hierarquico">{{ departamento }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="setor-estag">
                                        <label for="set_estag">Setor Estagiado</label>
                                        <select class="form-control" id="setor_estag">
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
                                        <select class="form-control" id="inputSupervisor">
                                            <option></option>
                                            <option v-for="supervisor of supervisores" v-model="post.supervisor">{{ supervisor.nome }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputInicio">Data Início</label>
                                            <input type="date" class="form-control" id="inputInicio" v-model="post.dt_inicio">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputTermino">Data Término</label>
                                            <input type="date" class="form-control" id="inputTermino" v-model="post.dt_termino">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputTermino">Data Término Inicial</label>
                                            <input type="date" class="form-control" id="inputTermino" v-model="post.dt_termino_inicial_lauda">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Horário de Entrada</label>
                                        <input type="text" class="form-control" v-model="post.horario_entrada">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Horário de Saída</label>
                                        <input type="text" class="form-control" v-model="post.horario_saida">
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
                                        <label for="situacaoid">Situação</label>
                                        <select id="situacaoid" class="form-control" v-model="post.situacao">
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
                                        <label for="obs">Observações</label>
                                        <textarea id="obs" cols="30" rows="4" class="form-control" v-model="post.situacao"></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>

                        </div><!--/Informações contratuais-->

                        <!--Dados Bancários-->
                        <div class="col-12 p-3" v-if="botao == 'dadosBancarios'">
                                <form @submit.prevent="inserirEstagiario" method="post">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="">Instituição Bancária</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="form-control" v-model="post.instituicao_bancaria">
                                                        <option></option>
                                                        <option>BANCO DO BRASIL</option>
                                                        <option>BRADESCO</option>
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
                                                    <label for="">Agência</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="number" class="form-control" v-model="post.agencia">
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
                                                    <label for="">Conta</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="number" class="form-control" v-model="post.conta">
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
                                                    <label for="">Operação</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select class="form-control" v-model="post.operacao">
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
                </div><!--/quadrado-->
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
            dadosBancarios: {}
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
            this.post = this.dadosPessoais + this.informacoesContratuais + this.dadosBancarios;
            console.log(this.post)
            // this.axios.post(uriEstagiarios).then(uriEstagiarios, )
        },
        gravaDadosPesoais() {
            this.dadosPessoais = this.post;
            console.log(this.dadosPessoais);
        },
        gravaInformacoesContratuais() {
            this.informacoesContratuais = this.post;
            console.log(this.informacoesContratuais);
        },
        gravaDadosBancarios() {
            this.dadosBancarios = this.post;
            console.log(this.dadosBancarios);
        }
    }
}
</script>
<style>
.col-3 {
    height: 100vh;
}
.quadrado {
    width: 100%;
    height: auto;
    border: 1px solid #ccc;
    border-radius: 5px;
}
.aba {
    border-radius: 5px 0 0 0;
    width: max-content;
    height: 35px;
    border-bottom: 1px solid #ccc;
    border-right: 1px solid #ccc;
    padding: 10px;
    color: #495057;
}
</style>
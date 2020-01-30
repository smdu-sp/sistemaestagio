<template>
    <form @submit.prevent="inserirEstagiario" method="post">

    <!--ROW Campos Não preenchiveis -->
    <div class="row">
        <input type="hidden" v-model="post.foto">
        <input type="hidden" v-model="post.campus">
        <input type="hidden" v-model="post.aditivo1">
        <input type="hidden" v-model="post.aditivo2">
        <input type="hidden" v-model="post.aditivo3">
        <input type="hidden" v-model="post.qt_horas_estagiada">
    </div>

    <!--row-->
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="inputNome">Nome</label>
                <input type="text" 
                    @blur="validaNome" 
                    maxlength="170" 
                    :class="{'is-invalid': nomeValido}" 
                    class="form-control" 
                    id="inputNome" 
                    placeholder="Digite o Nome Completo" 
                    v-model="post.nome" >
                <div v-if="nomeValido" class="invalid-feedback">
                    Digite o nome por favor
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Nome Social</label>
                <input type="text" class="form-control" maxlength="170" v-model="post.nome_social">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Portador de deficiência?</label>
                <input type="text" :value="post.deficiencia?'SIM':'NÃO'" class="form-control" disabled="disabled">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputEstudante">Cód. Estudante</label>
                <input type="text" 
                    @blur="validaCodEstudante" 
                    maxlength="20" 
                    :class="{'is-invalid': codValido}" 
                    class="form-control" 
                    id="inputEstudante" 
                    v-model="post.cod_estudante" 
                    >
                <div v-if="nomeValido" class="invalid-feedback">
                    Código não pode ser vazio
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="selectContratante">Contratante</label>
                <select class="form-control" 
                    @blur="validaContratante" 
                    :class="{'is-invalid': contratanteValido}" 
                    id="selectContratante" 
                    v-model="post.contratado_por" >
                    <option></option>
                    <option>SMDU</option>
                    <option>SEL</option>
                    <option>SMUL</option>
                </select>
                <div v-if="contratanteValido" class="invalid-feedback">
                    Contratante não pode ser vazio
                </div>
            </div>
        </div>
        <!-- <div class="col-md-3">
            <div class="form-group">
                <label for="inputLogin">Login</label>
                <input type="text" class="form-control" maxlength="7" id="inputLogin" v-model="post.login" placeholder="Ex: x455214">
            </div>
        </div> -->
        
    </div><!--/row-->

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="inputEndereco">Endereço</label>
                <input type="text" 
                    @blur="validaEndereco" 
                    maxlength="150" 
                    :class="{'is-invalid': enderecoValido}" 
                    class="form-control" 
                    id="inputEndereco" 
                    v-model="post.endereco" 
                    placeholder="Ex: Rua São Bento">
                <div v-if="enderecoValido" class="invalid-feedback">
                    Contratante não pode ser vazio
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputComplemento">Nº / Comp.</label>
                <input type="text"
                    @blur="validaComplemento" 
                    maxlength="20" 
                    :class="{'is-invalid': complementoValido}"
                    class="form-control" 
                    id="inputComplemento" 
                    v-model="post.nro"
                    placeholder="Ex: 102 Apto 3" >
                <div v-if="complementoValido" class="invalid-feedback">
                    nº não pode ser vazio
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputBairro">Bairro</label>
                <input type="text" 
                    @blur="validaBairro"
                    maxlength="70" 
                    :class="{'is-invalid': bairroValido}"
                    class="form-control" 
                    id="inputBairro" 
                    v-model="post.bairro" >
                <div v-if="bairroValido" class="invalid-feedback">
                    Bairro não pode ser vazio
                </div>
            </div>
        </div>
    </div>
    <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="inputCep">CEP</label>
                    <the-mask type="tel" 
                        @blur="validaCep"
                        maxlength="10" 
                        :class="{'is-invalid': cepValido}"
                        class="form-control" 
                        id="inputCep" 
                        v-model="post.cep" 
                        :mask="['#####-###']"
                        placeholder="Ex: 02010-050"></the-mask>
                    <div v-if="cepValido" class="invalid-feedback">
                        CEP não pode ser vazio
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="selectEstado">Estado</label>
                    <select class="form-control" 
                        @blur="validaEstado"
                        :class="{'is-invalid': estadoValido}"
                        id="selectEstado" 
                        v-model="post.estado" >
                        <option></option>
                        <option v-for="estado of estados" :value="estado.estado">{{ estado.estado }}</option>
                    </select>
                    <div v-if="estadoValido" class="invalid-feedback">
                        Estado não pode ser vazio
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="inputFone">Fone Res.</label>
                    <the-mask type="tel" 
                        maxlength="15" 
                        class="form-control" 
                        id="inputFone" 
                        v-model="post.fone_residencial"
                        mask="(##) ####-####"
                        placeholder="Ex: (11) 2222-0000"></the-mask>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="inputCel">Fone celular</label>
                    <the-mask type="tel" 
                        @blur="validaCelular"
                        maxlength="16" 
                        :class="{'is-invalid': celularValido}"
                        class="form-control" 
                        id="inputCel" 
                        v-model="post.fone_celular"
                        :mask="['(##) ####-####', '(##) #####-####']"
                        placeholder="Ex: (11) 22222-0000"></the-mask>
                    <div v-if="celularValido" class="invalid-feedback">
                        Celular não pode ser vazio
                    </div>
                </div>
            </div>
        </div>
    </div><!--/row-->

    <!--row-->
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputNascimento">Nascimento</label>
                <input type="date" style="font-size: 0.95rem" class="form-control" id="inputNascimento" v-model="post.data_nascimento" >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputNaturalidade">Naturalidade</label>
                <input type="text" 
                class="form-control" 
                maxlength="30" 
                id="inputNaturalidade" 
                v-model="post.naturalidade"
                placeholder="Ex: São Paulo - SP">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputNacionalidade">Nacionalidade</label>
                <input type="text"
                    @blur="validaNacionalidade"
                    maxlength="20"
                    :class="{'is-invalid': nacionalidadeValida}"
                    class="form-control"
                    id="inputNacionalidade"
                    v-model="post.nacionalidade">
                    <div v-if="nacionalidadeValida" class="invalid-feedback">
                        Nacionalidade não pode ser vazia
                    </div>             
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputRaca">Raça/Cor</label>
                <select class="form-control" 
                    @blur="validaRaca"
                    :class="{'is-invalid': racaValida}"
                    id="inputRaca" 
                    v-model="post.raca_cor" >
                    <option value="0">Não Definido</option>
                    <option value="1">Branco(a)</option>
                    <option value="2">Pardo(a)</option>
                    <option value="3">Amarelo(a)</option>
                    <option value="4">Preto(a)</option>
                    <option value="5">Indígena</option>
                </select>
                <div v-if="racaValida" class="invalid-feedback">
                    Raça não pode ser vazio
                </div>
            </div>
        </div>
    </div><!--/row-->

    <!--row-->
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="selectSexo">Sexo</label>
                <select class="form-control" id="selectSexo" v-model="post.sexo" >
                    <option>{{ post.sexo }}</option>
                    <option>{{ post.sexo == 'MASCULINO' ? 'FEMININO' : 'MASCULINO'}}</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputCpf">CPF</label>
                <input type="tel"
                    @blur="validaCpfForm"
                    maxlength="14" 
                    :class="{'is-invalid': cpfValidoForm}"
                    class="form-control"
                    id="inputCpf" 
                    placeholder="Ex: 000.000.000-00"
                    v-b-tooltip.hover title="Somente números"
                    v-model="post.cpf">
                    <div v-if="cpfValidoForm" class="invalid-feedback">
                        CPF não pode ser vazio
                    </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="inputRg">RG</label>
                <input type="text" 
                    @blur="validaRg"
                    maxlength="13" 
                    :class="{'is-invalid': rgValido}"
                    class="form-control" 
                    id="inputRg" 
                    v-model="post.rg" >
                    <div v-if="rgValido" class="invalid-feedback">
                        RG não pode ser vazio
                    </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="selectOrgao">Órgão exp.</label>
                <select class="form-control" id="selectOrgao" v-model="post.orgao_expedidor_rg" >
                    <option>SSP</option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="selectEstadoRg">UF/RG</label>
                <select class="form-control" id="selectEstadoRg" v-model="post.uf_rg" >
                    <option v-for="estado of estados" :value="estado.estado">{{ estado.uf }}</option>
                </select>
            </div>
        </div>
    </div><!--/row-->

    <!--row-->
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputRne">RNE</label>
                <input type="text" class="form-control" maxlength="30" v-model="post.rne">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="selectEstadoCivil">Estado Civil</label>
                <select type="text" class="form-control" id="selectEstadoCivil" v-model="post.estado_civil" >
                    <option>Solteiro(a)</option>
                    <option>Casado(a)</option>
                    <option>Divorciado(a)</option>
                    <option>Viúvo(a)</option>
                    <option>Separado(a)</option>
                    <option>Companheiro(a)</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="inputMae">Nome da Mãe</label>
                <input type="text" class="form-control" maxlength="170" id="inputMae" v-model="post.nome_mae">
            </div>
        </div>
    </div><!--/row-->

    <!--row-->
    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <label for="inputEmailPessoal">E-mail pessoal</label>
                <input type="email" 
                    @blur="validaEmail"
                    maxlength="100" 
                    :class="{'is-invalid': emailValido}"
                    class="form-control" 
                    id="inputEmailPessoal" 
                    v-model="post.email_pessoal" >
                    <div v-if="emailValido" class="invalid-feedback">
                        E-mail não pode ser vazio
                    </div>
            </div>
        </div>
    </div><!--/row-->
    <!--row-->
    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <label for="selectInstituicao">Instituíção de Ensino</label>
                <select class="form-control" 
                    @blur="validaInstituicao"
                    :class="{'is-invalid': instituicaoValida}"
                    id="selectInstituicao" 
                    v-model="post.instituicao_ensino" >
                    <option :value="post.instituicao_ensino">{{ post.instituicao_ensino }}</option>
                    <option v-for="instituicao of instituicoes">{{ instituicao.razao_social }}</option>
                </select>
                <div v-if="instituicaoValida" class="invalid-feedback">
                    Instituição não pode ser vazia
                </div>
            </div>
        </div>
    </div><!--/row-->

    <!--row-->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="selectCurso">Curso/Formação</label>
                <select class="form-control" 
                    @blur="validaCurso"
                    :class="{'is-invalid':cursoValido}"
                    id="selectCurso" 
                    v-model="post.curso_formacao" >
                    <option v-for="curso of cursosOrdenados" :value="curso.id" :key="curso.id">{{ curso.formacao }}</option>
                </select>
                <div v-if="cursoValido" class="invalid-feedback">
                    Curso não pode ser vazio
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="selectAno">Ano/Semestre</label>
                <select class="form-control" id="selectAno" v-model="post.ano_semestre">
                    <option>{{ post.ano_semestre }}</option>
                    <option>1º/1º</option>
                    <option>1º/1º</option>
                    <option>1º/2º</option>
                    <option>2º/3º</option>
                    <option>2º/4º</option>
                    <option>3º/5º</option>
                    <option>3º/6º</option>
                    <option>4º/7º</option>
                    <option>4º/8º</option>
                    <option>5º/9º</option>
                    <option>5º/10º</option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="selectPeriodo">Período</label>
                <select class="form-control" id="selectPeriodo" v-model="post.periodo" >
                    <option>{{ post.periodo }}</option>
                    <option>Manhã</option>
                    <option>Tarde</option>
                    <option>Noite</option>
                    <option>Variável</option>
                </select>
            </div>
        </div>

    </div><!--/row-->
    
    <!--row-->
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputHorario">Horário de estudo</label>
                <the-mask type="text" class="form-control" v-b-tooltip.hover title="Somente números" id="inputHorario" v-model="post.horario" mask="##:## às ##:##"></the-mask>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputMesConclusao">Mês/Ano de Conclusão</label>
                <the-mask type="text" 
                    class="form-control"
                    id="inputMesConclusao"
                    v-model="post.mes_ano_previsto_curso" 
                    placeholder="Ex: 12/2022"
                    v-b-tooltip.hover title="Somente números"
                    mask="##/####"></the-mask>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="inputMatricula">Matrícula</label>
                <input type="text" class="form-control" maxlength="20" id="inputMatricula" v-model="post.matricula">
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
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
            </div>
        </div>
    </div>
    <botoes-component :titulo="nomeBotao = 'Salvar'"></botoes-component>

</form>

</template>
<script>
export default {
    props: [
        'post', 
        'cartoes', 
        'estados', 
        'instituicoes', 
        'cursos', 
        'inserirEstagiario', 
        'alteracaoSupervisor', 
        'horarioVariavel',
        'dataModificacao',
        'horaModificacao',
        'validaNome','nomeValido',
        'validaCodEstudante','codValido',
        'validaContratante','contratanteValido',
        'validaEndereco','enderecoValido',
        'validaEstado','estadoValido',
        'validaCep','cepValido',
        'validaBairro', 'bairroValido',
        'validaComplemento', 'complementoValido',
        'validaCelular','celularValido',
        'validaNacionalidade','nacionalidadeValida',
        'validaRaca','racaValida',
        'cpfValidoForm','validaCpfForm',
        'validaRg','rgValido',
        'validaEmail','emailValido',
        'validaInstituicao','instituicaoValida',
        'validaCurso','cursoValido',
        'converteCep', 'showModal', 'carregaCartaoAcesso',
        'cartoesOrdenados', 'cursosOrdenados', 'abreModalCartaoAcesso'
    ]
}
</script>
<style>
</style>

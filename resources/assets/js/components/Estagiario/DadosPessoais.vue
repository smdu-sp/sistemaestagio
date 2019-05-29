<template>
    <form @submit.prevent="inserirEstagiario(), alteracaoSupervisor(), horarioVariavel(), dataModificacao(), horaModificacao()" method="post">
    <!--row-->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="inputNome">Nome</label>
                <input type="text" @blur="validaNome" maxlength="170" :class="{'is-invalid': nomeValido}" class="form-control" id="inputNome" placeholder="Digite o Nome Completo" v-model="post.nome" >
                <div v-if="nomeValido" class="invalid-feedback">
                    Digite o nome por favor
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Nome Social</label>
                <input type="text" class="form-control" maxlength="170" mav-model="post.nome_social">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputEstudante">Cód. Estudante</label>
                <input type="text" @blur="validaCodEstudante" class="form-control" maxlength="20" :class="{'is-invalid': codValido}" id="inputEstudante" v-model="post.cod_estudante" max="20">
                <div v-if="nomeValido" class="invalid-feedback">
                    Código não pode ser vazio
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputContrato">Contrato CIEE</label>
                <input type="text" @blur="validaContrato" :class="{'is-invalid': codValido}" class="form-control" maxlength="20" id="inputContrato" v-model="post.contrato" >
                <div v-if="contratoValido" class="invalid-feedback">
                    Contrato não pode ser vazio
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputTceSuperEstagios">TCE Super Estágios</label>
                <input type="text" class="form-control" maxlength="11" id="inputTceSuperEstagios" v-model="post.tc_superestagios">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="selectContratante">Contratado Por</label>
                <select class="form-control" @blur="validaContratante" :class="{'is-invalid': contratanteValido}" id="selectContratante" v-model="post.contratado_por" >
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
    </div><!--/row-->

    <!--row-->
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="selectVaga">Codigo Vaga</label>
                <select type="text" class="form-control" id="selectVaga" :class="{'is-invalid': vagaValida}" v-model="post.cod_vaga" @click="selectVaga" @blur="validaVaga">
                    <option></option>
                    <option v-for="vaga of vagas">{{ vaga.id }}</option>
                </select>
                <div v-if="vagaValida" class="invalid-feedback">
                    Vaga não pode ser vazia
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="selectStatus">Status Vaga</label>
                <input type="text" :value="statusVaga.situacao" id="selectStatus" class="form-control" disabled>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputLogin">Login</label>
                <input type="text" class="form-control" maxlength="7" id="inputLogin" v-model="post.login">
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
                <input type="text" @blur="validaEndereco" :class="{'is-valid': enderecoValido}" class="form-control" maxlength="150" id="inputEndereco" v-model="post.endereco" >
                <div v-if="contratanteValido" class="invalid-feedback">
                    Contratante não pode ser vazio
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputComplemento">nº / Complemento</label>
                <input type="text" class="form-control" maxlength="20" id="inputComplemento" v-model="post.nro" >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputBairro">Bairro</label>
                <input type="text" class="form-control" maxlength="70" id="inputBairro" v-model="post.bairro" >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="selectEstado">Estado</label>
                <select class="form-control" id="selectEstado" v-model="post.estado" >
                    <option></option>
                    <option v-for="estado of estados" :value="estado.estado">{{ estado.estado }}</option>
                </select>
            </div>
        </div>
    </div><!--/row-->

    <!--row-->
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputCep">CEP</label>
                <input type="text" class="form-control" maxlength="10" id="inputCep" v-model="post.cep" >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputFone">Fone Res.</label>
                <input type="text" class="form-control"  maxlength="15" id="inputFone" v-model="post.fone_residencial">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputCel">Fone celular</label>
                <input type="text" class="form-control" maxlength="16" id="inputCel" v-model="post.fone_celular">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputNascimento">Nascimento</label>
                <input type="date" class="form-control" id="inputNascimento" v-model="post.data_nascimento" >
            </div>
        </div>
    </div><!--/row-->

    <!--row-->
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputNaturalidade">Naturalidade</label>
                <input type="text" class="form-control" maxlength="30" id="inputNaturalidade" v-model="post.naturalidade">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputNacionalidade">Nacionalidade</label>
                <input type="text" class="form-control" maxlength="20" id="inputNacionalidade" v-model="post.nacionalidade" >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputRaca">Raça/Cor</label>
                <select class="form-control" id="inputRaca" v-model="post.raca_cor" >
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
                <select class="form-control" id="selectSexo" v-model="post.sexo" >
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
                <input type="text" class="form-control" maxlength="15" id="inputCpf" v-model="post.cpf" >
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="inputRg">RG</label>
                <input type="text" class="form-control" maxlength="13" id="inputRg" v-model="post.rg" >
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
        <div class="col-md-2">
            <div class="form-group">
                <label for="inputRne">RNE</label>
                <input type="text" class="form-control" maxlength="30" v-model="post.rne">
            </div>
        </div>
        <div class="col-md-2">
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
    </div><!--/row-->

    <!--row-->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="inputMae">Nome da Mãe</label>
                <input type="text" class="form-control" maxlength="170" id="inputMae" v-model="post.nome_mae">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="inputPai">Nome do Pai</label>
                <input type="text" class="form-control" maxlength="170" id="inputPai" v-model="post.nome_pai">
            </div>
        </div>
    </div><!--/row-->

    <!--row-->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="inputEmailPessoal">E-mail pessoal</label>
                <input type="email" class="form-control" maxlength="100" id="inputEmailPessoal" v-model="post.email_pessoal" >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="inputEmailCorporativo">E-mail corporativo</label>
                <input type="email" class="form-control" maxlength="100" id="inputEmailCorporativo" v-model="post.email_corporativo">
            </div>
        </div>
    </div><!--/row-->

    <!--row-->
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="selectInstituicao">Instituíção de Ensino</label>
                <select class="form-control" id="selectInstituicao" v-model="post.instituicao_ensino" >
                    <option v-for="instituicao of instituicoes" :value="instituicao.razao_social">{{ instituicao.razao_social }}</option>
                </select>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="selectCurso">Curso/Formação</label>
                <select class="form-control" id="selectCurso" v-model="post.curso_formacao" >
                    <option v-for="curso of cursos" :value="curso.id">{{ curso.formacao }}</option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="selectAno">Ano/Semestre</label>
                <select class="form-control" id="selectAno" v-model="post.ano_semestre" >
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
                <select class="form-control" id="selectPeriodo" v-model="post.periodo" >
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
                <label for="inputDuracaoCurso">
                    Duração do Curso (em semestres)
                </label>
                <input type="number" class="form-control" id="inputDuracaoCurso" v-model="post.duracao_curso">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputMesConclusao">Mês/Ano de Conclusão</label>
                <input type="text" class="form-control" id="inputMesConclusao" v-model="post.mes_ano_previsto_curso" >
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
    <botoes-component></botoes-component>
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
        'vagas', 
        'statusVaga', 
        'selectVaga', 
        'alteracaoSupervisor', 
        'horarioVariavel',
        'dataModificacao',
        'horaModificacao',
        'validaNome',
        'validaCodEstudante',
        'codValido',
        'nomeValido',
        'contratoValido',
        'validaContrato',
        'validaContratante',
        'contratanteValido',
        'validaVaga',
        'vagaValida',
        'validaEndereco',
        'enderecoValido'
    ]
}
</script>
<style>
</style>

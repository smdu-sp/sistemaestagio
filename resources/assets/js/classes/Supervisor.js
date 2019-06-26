export default class Supervisor {
    constructor(nome, rf, cargo, departamento, e_mail, situacao, cpf = null, tel_contato = null, formacao = null, conselho_profissional = null, atividades_estagiario = null) {
        this.nome = nome;
        this.rf = rf;
        this.cargo = cargo;
        this.departamento = departamento;
        this.e_mail = e_mail;
        this.situacao = situacao;
        this.cpf = cpf;
        this.tel_contato = tel_contato;
        this.formacao = formacao;
        this.conselho_profissional = conselho_profissional;
        this.atividades_estagiario = atividades_estagiario;
    }
}
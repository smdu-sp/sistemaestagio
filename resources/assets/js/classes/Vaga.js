export class Vaga {
    constructor(codigo, situacao, departamentoHierarquico, sigla, status, historico = null, anexos = null) {
        this.codigo = codigo;
        this.situacao = situacao;
        this.departamentoHierarquico = departamentoHierarquico;
        this.sigla = sigla;
        this.status = status;
        this.historico = historico;
        this.anexos = anexos;
    }
}
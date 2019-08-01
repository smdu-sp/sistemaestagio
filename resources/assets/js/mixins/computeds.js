import _ from 'lodash'; // importar este módulo onde for usar qualquer destes computed
export default {
    computed: {
        supervisoresOrdenados() {
            let lowerCaseSupervisores = _.clone(this.supervisores);
            if(typeof(lowerCaseSupervisores.map) == 'undefined')
                return;
            lowerCaseSupervisores = lowerCaseSupervisores.map((supervisor) => {
                supervisor.nome = supervisor.nome.toLowerCase();
                return supervisor;
            });

            const sortedSupervisor = _.orderBy(lowerCaseSupervisores, ['nome'], ['asc']);

            return sortedSupervisor;
        },
        cartoesOrdenados() {
            return _.orderBy(this.cartoes, 'id');
        },
        cursosOrdenados() {
            return _.orderBy(this.cursos, 'formacao');
        },
        vagasOrdenadas() {
            return _.orderBy(this.vagas, 'id');
        },
        departamentosOrdenados() {
            return _.orderBy(this.departamentos, 'sigla');
        },
        instituicoesOrdenadas() {
            let lowerCaseInstituicoes = _.clone(this.instituicoes);

            if(lowerCaseInstituicoes.length < 1){
                return;
            } else {
                lowerCaseInstituicoes = lowerCaseInstituicoes.map(instituicao => {
                    instituicao.razao_social = instituicao.razao_social.toLowerCase();
                    return instituicao;
                });
    
                return lowerCaseInstituicoes
            } 
    
                // const sortedInstituicoes = _.orderBy(lowerCaseInstituicoes, ['razao_social'], ['asc']);
    
                // return lowerCaseInstituicoes;
            
        }
    }
}
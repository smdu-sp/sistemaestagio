import _ from 'lodash';
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
        }
    }
}

// supervisoresOrdenados() {
//     let lowerCaseSupervisores = _.clone(this.supervisores);
//     if(typeof(lowerCaseSupervisores.map) == 'undefined')
//         return;
//     lowerCaseSupervisores = lowerCaseSupervisores.map((supervisor) => {
//         supervisor.nome = supervisor.nome.toLowerCase();
//         return supervisor;
//     });

//     const sortedSupervisor = _.orderBy(lowerCaseSupervisores, ['nome'], ['asc']);

//     return sortedSupervisor;
// },
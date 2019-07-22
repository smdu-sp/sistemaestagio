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
        }
    }
}
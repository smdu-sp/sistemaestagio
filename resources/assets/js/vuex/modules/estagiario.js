export default {
    state: {
        estagiarioSelecionado: {},
        idCursoEstagiarioSelecionado: '',
        estagiarios: {},
        contratosAVencer: []
    },
    getters: {
        getEstagiarioSelecionado(state) {
            return state.estagiarioSelecionado;
        },
        getEstagiarios(state) {
            return state.estagiarios;
        }
    },
    mutations: {
        armazenaEstagiarioSelecionado(state, estagiario) {
            state.estagiarioSelecionado = estagiario;
        },
        armazenaEstagiarios(state, estagiarios) {
            state.estagiarios = estagiarios
        },
        armazenaIdCurso(state, idCurso) {
            state.idCursoEstagiarioSelecionado = idCurso;
        },
        armazenaContratosVencer(state, estagiario) {
            state.contratosAVencer.push(estagiario)
        },
    },
    actions: {
        salvaContratosAVencer(context) {
            const estagiarios = context.state.estagiarios;

            let dataAtual = new Date();
            let dataAtualFormatada = dataAtual.setDate(dataAtual.getDate())
            let dataAtualMais90Dias = dataAtual.setDate(dataAtual.getDate() + 90);

            for(let i in estagiarios) {
                let dataEstagiario = estagiarios[i].dt_termino;
                let novaData = new Date(dataEstagiario);
                let novaDataFormatada = novaData.setDate(novaData.getDate());      
                if(novaDataFormatada >= dataAtualFormatada && novaDataFormatada <= dataAtualMais90Dias){
                    context.commit('armazenaContratosVencer', estagiarios[i]);
                }
            }


        }
    }
}
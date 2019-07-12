export default {
    state: {
        estagiarioSelecionado: {},
        idCursoEstagiarioSelecionado: '',
        estagiarios: {}
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
        }
    }
}
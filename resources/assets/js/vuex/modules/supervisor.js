const uriSupervisor = '/api/supervisores';

export default {
    state: {
        supervisores: {}
    },
    getters: {
        getSupervisores(state) {
            return state.supervisores;
        }
    },
    mutations: {
        armazenaSupervisores(state, supervisores) {
            state.supervisores = supervisores
        }
    },
    actions: {
        requisicaoSupervisores({commit}) {
            axios.get(uriSupervisor).then(response => {
                commit('armazenaSupervisores', response.data);
            })
            .catch(error => {
                console.log("Erro: "+error);
            })
        }
    }
}
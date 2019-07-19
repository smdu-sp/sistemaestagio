const uriVagas = '/api/vagas';

export default {
    state: {
        vagas: {}
    },
    getters: {
        getVagas(state) {
            return state.vagas;
        }
    },
    mutations: {
        armazenaVagas(state, vagas) {
            state.vagas = vagas;
        }
    }, 
    actions: {
        salvaVagas({commit}){
            axios.get(uriVagas).then(response => {
                commit('armazenaVagas', response.data);
            })
            .catch(error => {
                console.log("Erro: "+error)
            })
        }
    }
}
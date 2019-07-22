const uridepartamentos = '/api/departamentos';
export default {
    state: {
        departamentos: {}
    },
    getters: {
        getDepartamentos(state) {
            return state.departamentos;
        }
    },
    mutations: {
        armazenaDepartamentos(state, departamentos) {
            state.departamentos = departamentos
        }
    },
    actions: {
        requisicaoDepartamentos({commit}) {
            axios.get(uridepartamentos).then(response => {
                commit('armazenaDepartamentos', response.data);
            })
            .catch(error => {
                console.log("Erro: "+error);
            })
        }
    }
}
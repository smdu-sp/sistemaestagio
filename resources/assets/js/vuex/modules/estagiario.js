import Vue from 'vue';
import axios from 'axios';
Vue.use(axios);

const uriEstagiarios = '/api/estagiarios'

export default {
    state: {
        estagiarioSelecionado: {},
        idCursoEstagiarioSelecionado: '',
        estagiarios: {},
        contratosAVencer: [],
        vagas: [],
        vagasEmSelecao: [],
        estagiariosEmContratacao: [],
        estagiariosContratados30dias: []
    },
    getters: {
        getEstagiarioSelecionado(state) {
            return state.estagiarioSelecionado;
        },
        getEstagiarios(state) {
            return state.estagiarios;
        },
        getEstagiariosContratados30Dias(state) {
            return state.estagiariosContratados30dias;
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
        armazenaVagas(state, vagas) {
            state.vagas = vagas;
        },
        armazenaVagasEmSelecao(state, vaga) {
            state.vagasEmSelecao.push(vaga)
        },
        armazenaEstagiariosEmContratacao(state, estagiario) {
            state.estagiariosEmContratacao.push(estagiario)
        },
        armazenaEstagiariosContratados(state, estagiario) {
            state.estagiariosContratados30dias.push(estagiario)
        }
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
        },
        salvaVagasEmSelecao(context, vagas) {            
            vagas = context.state.vagas
            for(let i in vagas) {
                if(vagas[i].status === "EM SELEÇÃO") {
                    context.commit('armazenaVagasEmSelecao', vagas[i]);
                }
            }
        },
        salvaEstagiariosEmContratacao(context, estagiarios) {
            estagiarios = context.state.estagiarios;
            for(let i in estagiarios) {
                if(estagiarios[i].situacao === 2) {
                    context.commit('armazenaEstagiariosEmContratacao', estagiarios[i]);
                }
            }
        },
        salvaEstagiarios({commit}){
            axios.get(uriEstagiarios)
            .then(response => {
                commit('armazenaEstagiarios', response.data);
            })
            .catch(error => {
                console.log(error)
            })
        },
        salvaEstagiariosContratados(context, estagiarios) {
            estagiarios = context.state.estagiarios;

            let dataAtual = new Date();
            let dataAtualMenos60Dias = dataAtual.setDate(dataAtual.getDate() - 60);

            for(let i in estagiarios) {
                let dataEstagiario = estagiarios[i].dt_inicio
                let novaData = new Date(dataEstagiario);
                let novaDataFormatada = novaData.setDate(novaData.getDate());
                if(novaDataFormatada >= dataAtualMenos60Dias){
                    context.commit('armazenaEstagiariosContratados', estagiarios[i]);
                }
            }
        }

    }
}
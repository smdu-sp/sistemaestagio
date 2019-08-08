// import Vue from 'vue';
// import VueAxios from 'vue-axios';
// import axios from 'axios';
// Vue.use(VueAxios, axios);

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
        estagiariosContratados30dias: [],
        estagiariosDesligados30dias: [],
        estagiariosRenovados30dias: []
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
        },
        getEstagiariosDesligados30Dias(state) {
            return state.estagiariosDesligados30dias;
        },
        getEstagiariosRenovados30Dias(state) {
            return state.estagiariosRenovados30dias;
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
        armazenaEstagiariosContratados30dias(state, estagiario) {
            state.estagiariosContratados30dias.push(estagiario)
        },
        armazenaEstagiariosDesligados30dias(state, estagiario) {
            state.estagiariosDesligados30dias.push(estagiario)
        },
        armazenaEstagiariosRenovados30dias(state, estagiario) {
            state.estagiariosRenovados30dias.push(estagiario)
        }
    },
    actions: {
        salvaContratosAVencer(context) {
            const estagiarios = context.state.estagiarios;

            let dataAtual = new Date();
            let dataAtualFormatada = dataAtual.setDate(dataAtual.getDate())
            let dataAtualMais90Dias = dataAtual.setDate(dataAtual.getDate() + 90);

            for(let i in estagiarios) {
                if(estagiarios[i].dt_inicio_3_aditivo) {
                    let dataEstagiario = estagiarios[i].dt_inicio_3_aditivo;
                    let novaData = new Date(dataEstagiario);
                    let novaDataFormatada = novaData.setDate(novaData.getDate());      
                    if(novaDataFormatada >= dataAtualFormatada && novaDataFormatada <= dataAtualMais90Dias){
                        context.commit('armazenaContratosVencer', estagiarios[i]);
                    }
                } else if(estagiarios[i].dt_inicio_2_aditivo) {
                    let dataEstagiario = estagiarios[i].dt_inicio_2_aditivo;
                    let novaData = new Date(dataEstagiario);
                    let novaDataFormatada = novaData.setDate(novaData.getDate());      
                    if(novaDataFormatada >= dataAtualFormatada && novaDataFormatada <= dataAtualMais90Dias){
                        context.commit('armazenaContratosVencer', estagiarios[i]);
                    }
                } else if(estagiarios[i].dt_inicio_1_aditivo) {
                    let dataEstagiario = estagiarios[i].dt_inicio_1_aditivo
                    let novaData = new Date(dataEstagiario);
                    let novaDataFormatada = novaData.setDate(novaData.getDate());      
                    if(novaDataFormatada >= dataAtualFormatada && novaDataFormatada <= dataAtualMais90Dias){
                        context.commit('armazenaContratosVencer', estagiarios[i]);
                    }
                } else {
                    let dataEstagiario = estagiarios[i].dt_termino;
                    let novaData = new Date(dataEstagiario);
                    let novaDataFormatada = novaData.setDate(novaData.getDate());      
                    if(novaDataFormatada >= dataAtualFormatada && novaDataFormatada <= dataAtualMais90Dias){
                        context.commit('armazenaContratosVencer', estagiarios[i]);
                    }
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
                console.log("Erro: "+error)
            })
        },
        salvaEstagiariosContratados30dias(context, estagiarios) {
            estagiarios = context.state.estagiarios;

            let dataAtual = new Date();
            let dataAtualMenos30Dias = dataAtual.setDate(dataAtual.getDate() - 30);

            for(let i in estagiarios) {
                let dataEstagiario = estagiarios[i].dt_inicio
                let novaData = new Date(dataEstagiario);
                let novaDataFormatada = novaData.setDate(novaData.getDate());
                if(novaDataFormatada >= dataAtualMenos30Dias){
                    context.commit('armazenaEstagiariosContratados30dias', estagiarios[i]);
                }
            }
        },
        salvaEstagiariosDesligados30dias(context, estagiarios) {
            estagiarios = context.state.estagiarios;

            let dataAtual = new Date();
            let dataAtualTime = dataAtual.setDate(dataAtual.getDate());
            let dataAtualMenos30Dias = dataAtual.setDate(dataAtual.getDate() - 30);

            for(let i in estagiarios) {
                let dataEstagiario = estagiarios[i].dt_termino
                let novaData = new Date(dataEstagiario);
                let novaDataFormatada = novaData.setDate(novaData.getDate());
                if(novaDataFormatada >= dataAtualMenos30Dias && novaDataFormatada <= dataAtualTime){
                    context.commit('armazenaEstagiariosDesligados30dias', estagiarios[i]);
                }
            }
        },
        salvaEstagiariosRenovados30dias(context, estagiarios) {
            estagiarios = context.state.estagiarios;

            let dataAtual = new Date();
            let dataAtualMenos30Dias = dataAtual.setDate(dataAtual.getDate() - 30);

            for(let i in estagiarios) {
                var dataEstagiario1Aditivo = estagiarios[i].dt_inicio_1_aditivo;
                var dataEstagiario2Aditivo = estagiarios[i].dt_inicio_2_aditivo;
                var dataEstagiario3Aditivo = estagiarios[i].dt_inicio_3_aditivo;

                if(typeof(dataEstagiario1Aditivo) == 'null') {
                    return;
                } else {
                    var novaData1Aditivo = new Date(dataEstagiario1Aditivo);
                    var novaData1Formatada = novaData1Aditivo.setDate(novaData1Aditivo.getDate());
                }

                if(typeof(dataEstagiario2Aditivo) == 'null') {
                    var novaData2Aditivo = new Date(dataEstagiario2Aditivo);
                    var novaData2Formatada = novaData2Aditivo.setDate(novaData2Aditivo.getDate());
                }

                if(typeof(dataEstagiario3Aditivo) == 'null') {
                    return;
                } else {
                    var novaData3Aditivo = new Date(dataEstagiario3Aditivo);
                    var novaData3Formatada = novaData3Aditivo.setDate(novaData3Aditivo.getDate());
                }

                
                if(novaData1Formatada >= dataAtualMenos30Dias){
                    context.commit('armazenaEstagiariosRenovados30dias', estagiarios[i]);
                } else if (novaData2Formatada >= dataAtualMenos30Dias) {
                    context.commit('armazenaEstagiariosRenovados30dias', estagiarios[i]);
                } else if (novaData3Formatada >= dataAtualMenos30Dias) {
                    context.commit('armazenaEstagiariosRenovados30dias', estagiarios[i]);
                }
            }
        }
    }
}
/* Vuex */
import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

import departamento from './modules/departamento';
import estagiario from './modules/estagiario';
import supervisor from './modules/supervisor';

export default  new Vuex.Store({
    modules: { estagiario, departamento, supervisor}
})

// state: {
//     estagiarioSelecionado: {},
//     idCursoEstagiarioSelecionado: '',
//     estagiarios: {},
//     supervisores: {}
// },
// getters: {
//     getEstagiarioSelecionado(state) {
//         return state.estagiarioSelecionado;
//     },
//     getSupervisores(state) {
//         return state.supervisores;
//     },
//     getEstagiarios() {
//         return state.estagiarios;
//     }
// },
// mutations: {
//     armazenaEstagiarioSelecionado(state, estagiario) {
//         state.estagiarioSelecionado = estagiario;
//     },
//     armazenaEstagiarios(state, estagiarios) {
//         state.estagiarios = estagiarios
//     },
//     armazenaSupervisores(state, supervisores) {
//         state.supervisores = supervisores
//     },
//     armazenaIdCurso(state, idCurso) {
//         state.idCursoEstagiarioSelecionado = idCurso;
//     }
// }
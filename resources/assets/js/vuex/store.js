/* Vuex */
import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

import departamento from './modules/departamento';
import estagiario from './modules/estagiario';
import supervisor from './modules/supervisor';
import vaga from './modules/vaga';

export default  new Vuex.Store({
    modules: { estagiario, departamento, supervisor, vaga}
})
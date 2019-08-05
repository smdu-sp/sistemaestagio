
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/* Vue Router */
import VueRouter from 'vue-router';
Vue.use(VueRouter);

/* Vue-axios */
import VueAxios from 'vue-axios';
import axios from 'axios';
import App from './App.vue';
Vue.use(VueAxios, axios);

/* Bootstrap-vue */
import PortalVue from 'portal-vue';
import BootstrapVue from 'bootstrap-vue';
Vue.use(BootstrapVue);
Vue.use(PortalVue);

/* Vue the-mask */
import vueTheMask from 'vue-the-mask';
Vue.use(vueTheMask);

import store from './vuex/store';
// import Vuex from 'vuex';
// Vue.use(Vuex);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import HomeComponent from './components/HomeComponent.vue';
import AsideComponent from './components/AsideComponent.vue';
import HeaderComponent from './components/HeaderComponent.vue';
import MainComponent from './components/MainComponent.vue';
import CadastroVaga from './components/vaga/CadastroVaga.vue';
import DadosPessoais from './components/estagiario/cadastrar_estagiario/DadosPessoais.vue';
import NavEstagiario from './components/estagiario/cadastrar_estagiario/NavEstagiario.vue';
import InformacoesContratuais from './components/estagiario/cadastrar_estagiario/InformacoesContratuais.vue';
import DadosBancarios from './components/estagiario/cadastrar_estagiario/DadosBancarios.vue';
import Botoes from './components/estagiario/cadastrar_estagiario/Botoes.vue';
import Modal from './components/ModalConsulta.vue';
import DadosPessoaisAtualizar from './components/estagiario/atualizar_estagiario/DadosPessoais.vue';
import InformacoesContratuaisAtualizar from './components/estagiario/atualizar_estagiario/InformacoesContratuais.vue';
import RecessoAtualizar from './components/estagiario/atualizar_estagiario/Recesso.vue';
import DadosBancariosAtualizar from './components/estagiario/atualizar_estagiario/DadosBancarios.vue';
import FormAtualizacao from './components/estagiario/atualizar_estagiario/FormAtualizacao.vue';
import ConsultaEstagiario from './components/estagiario/atualizar_estagiario/ConsultaEstagiario.vue';
import ModalConsultaCpf from './components/ModalConsultaCpf.vue';
import CadastroSupervisor from './components/supervisor/CadastroSupervisor.vue';
import ConsultaSupervisor from './components/supervisor/ConsultaSupervisor.vue';
import CadastroCartaoAcesso from './components/cartao_acesso/CadastroCartaoAcesso';
import BotaoEmail from './components/BotaoEmail.vue';
import BotaoImprimir from './components/BotaoImprimir.vue';
import SupervisorAlteracao from './components/supervisor/AlteracaoSupervisor.vue';
import InstituicaoEnsino from './components/instituicao_ensino/Instituicao.vue';

Vue.component('aside-component', AsideComponent);
Vue.component('home-component', HomeComponent);
Vue.component('header-component', HeaderComponent);
Vue.component('main-component', MainComponent);
Vue.component('cadastro-vaga-component', CadastroVaga);
Vue.component('dados-pessoais', DadosPessoais);
Vue.component('nav-estagiario', NavEstagiario);
Vue.component('informacoes-contratuais', InformacoesContratuais);
Vue.component('dados-bancarios', DadosBancarios);
Vue.component('botoes-component', Botoes);
Vue.component('modal-component', Modal);
Vue.component('dados-pessoais-atualizar', DadosPessoaisAtualizar);
Vue.component('informacoes-contratuais-atualizar', InformacoesContratuaisAtualizar);
Vue.component('recesso-atualizar', RecessoAtualizar);
Vue.component('form-atualizacao', FormAtualizacao);
Vue.component('consulta-estagiario', ConsultaEstagiario);
Vue.component('dados-bancarios-atualizar', DadosBancariosAtualizar);
Vue.component('modal-consulta-cpf', ModalConsultaCpf);
Vue.component('cadastro-supervisor-component', CadastroSupervisor);
Vue.component('cadastro-cartao-acesso-component', CadastroCartaoAcesso);
Vue.component('botao-email-component', BotaoEmail);
Vue.component('consulta-supervisor-component', ConsultaSupervisor);
Vue.component('botao-imprimir-component', BotaoImprimir);
Vue.component('alteracao-supervisor-component', SupervisorAlteracao);
Vue.component('cadastro-instituicao-component', InstituicaoEnsino);

import { routes } from './routes.js';

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

new Vue({
    el: '#app',
    store,
    router: router
});

// const app = new Vue({
//     store,
//     el: '#app'
// })

// const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');

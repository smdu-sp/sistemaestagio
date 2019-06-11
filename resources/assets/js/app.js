
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';

import App from './App.vue';
Vue.use(VueAxios, axios);

import PortalVue from 'portal-vue';
import BootstrapVue from 'bootstrap-vue';
Vue.use(BootstrapVue);
Vue.use(PortalVue);

import vueTheMask from 'vue-the-mask';
Vue.use(vueTheMask);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import HomeComponent from './components/HomeComponent.vue';
import AsideComponent from './components/AsideComponent.vue';
import HeaderComponent from './components/HeaderComponent.vue';
import MainComponent from './components/MainComponent.vue';
import CadastroComponent from './components/CadastroComponent.vue';
import DadosPessoais from './components/cadastrar_estagiario/DadosPessoais.vue';
import NavEstagiario from './components/cadastrar_estagiario/NavEstagiario.vue';
import InformacoesContratuais from './components/cadastrar_estagiario/InformacoesContratuais.vue';
import DadosBancarios from './components/cadastrar_estagiario/DadosBancarios.vue';
import Botoes from './components/cadastrar_estagiario/Botoes.vue';
import Modal from './components/ModalConsulta.vue';
import DadosPessoaisAtualizar from './components/atualizar_estagiario/DadosPessoais.vue';
import InformacoesContratuaisAtualizar from './components/atualizar_estagiario/InformacoesContratuais.vue';
import RecessoAtualizar from './components/atualizar_estagiario/Recesso.vue';
import FormAtualizacao from './components/atualizar_estagiario/FormAtualizacao.vue';

Vue.component('aside-component', AsideComponent);
Vue.component('home-component', HomeComponent);
Vue.component('header-component', HeaderComponent);
Vue.component('main-component', MainComponent);
Vue.component('cadastro-component', CadastroComponent);
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

import { routes } from './routes.js';

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');

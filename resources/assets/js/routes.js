import NavEstagiario from './components/cadastrar_estagiario/NavEstagiario.vue';
import Consulta from './components/atualizar_estagiario/ConsultaEstagiario.vue';
import Main from './components/MainComponent.vue';
import CadastroVaga from './components/CadastroVaga.vue';
import CadastroSupervisor from './components/CadastroSupervisor.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Main
    },
    {
        name: 'cadastroEstagiario',
        path: '/cadastroestagiario',
        component: NavEstagiario
    },
    {
        name: 'consulta',
        path: '/consulta',
        component: Consulta
    },
    {
        name: 'cadastroVaga',
        path: '/cadastrovaga',
        component: CadastroVaga
    },
    {
        name: 'cadastroSupervisor',
        path: '/cadastrosupervisor',
        component: CadastroSupervisor
    }
];
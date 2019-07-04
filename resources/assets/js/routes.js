import NavEstagiario from './components/estagiario/cadastrar_estagiario/NavEstagiario.vue';
import Consulta from './components/estagiario/atualizar_estagiario/ConsultaEstagiario.vue';
import Main from './components/MainComponent.vue';
import CadastroVaga from './components/vaga/CadastroVaga.vue';
import CadastroSupervisor from './components/supervisor/CadastroSupervisor.vue';
import CadastroCartaoAcesso from './components/cartao_acesso/CadastroCartaoAcesso.vue';
import ConsultaSupervisor from './components/supervisor/ConsultaSupervisor.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Main
    },
    {
        name: 'Cadastro de Estagiários',
        path: '/cadastroestagiario',
        component: NavEstagiario
    },
    {
        name: 'Consulta de Estagiários',
        path: '/consulta',
        component: Consulta
    },
    {
        name: 'Cadastro de Vagas',
        path: '/cadastrovaga',
        component: CadastroVaga
    },
    {
        name: 'Cadastro de Supervisores',
        path: '/cadastrosupervisor',
        component: CadastroSupervisor
    },
    {
        name: 'Cadastro de Cartão de Acesso',
        path: '/cadastrocartaoacesso',
        component: CadastroCartaoAcesso
    },
    {
        name: 'Consulta de Supervisor',
        path: '/consultasupervisor',
        component: ConsultaSupervisor
    }
];
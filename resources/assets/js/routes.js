import NavEstagiario from './components/cadastrar_estagiario/NavEstagiario.vue';
import Teste from './components/teste.vue';
import Consulta from './components/atualizar_estagiario/ConsultaEstagiario.vue';

export const routes = [
    {
        name: 'cadastro',
        path: '/cadastro',
        component: NavEstagiario
    },
    {
        name: 'teste',
        path: '/teste',
        component: Teste
    },
    {
        name: 'consulta',
        path: '/consulta',
        component: Consulta
    }
];
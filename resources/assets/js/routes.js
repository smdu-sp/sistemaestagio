import HomeComponent from './components/HomeComponent.vue';
import NavEstagiario from './components/cadastrar_estagiario/NavEstagiario.vue';
import Teste from './components/teste.vue';
import Consulta from './components/consulta';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: HomeComponent
    },
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
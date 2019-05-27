import HomeComponent from './components/HomeComponent.vue';
import NavEstagiario from './components/Estagiario/NavEstagiario.vue';

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
    }
];
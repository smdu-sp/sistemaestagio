<template>    
    <!-- aside -->
    <aside class="col-3" id="menu-lateral">        

        <div class="d-flex justify-content-center dashboard align-items-center">
            <span>
                <img class="img-dashboard" src="../../../../public/icones/icons8-velocidade-50.png" alt="Dashboard">
            </span>
            <span class="text-white ml-2">Dashboard</span>
        </div>

        <nav class="row mt-4 ml-1">
            <ul>
                <li>
                    <li>
                        <img src="../../../../public/icones/icons8-velocidade-50.png" alt="Home" style="width: 20px;">
                        <router-link to="/">Home</router-link>
                    </li>
                <li>
                <li>
                    <li @click="mostrarMenuConsulta">
                        <i class="fas fa-chevron-down mr-2"></i>
                        Consulta
                    </li>
                    <transition name="fade">
                        <ul v-if="menuConsulta">
                            <li id="show-btn" @click="showModal"> <!-- Ativa modal -->
                                <router-link to="/consulta">Estagiario</router-link>
                            </li>
                        </ul>
                    </transition>
                <li>
                    <li>
                        <li @click="mostrarMenuCadastro">
                            <i class="fas fa-chevron-down mr-2"></i>
                            Cadastro
                        </li>
                        <transition name="fade">
                            <ul v-if="menuCadastro">
                                <li>
                                    <router-link to="/cadastroestagiario">Estagiario</router-link>
                                </li>
                                <li>
                                    <router-link to="/cadastrocartaoacesso">Cartão de Acesso</router-link>
                                </li>
                                <li>
                                    <router-link to="/cadastrosupervisor">Supervisor</router-link>
                                </li>
                                <li>
                                    <router-link to="/cadastrovaga">Vaga</router-link>
                                </li>
                            </ul>
                        </transition>
                    </li>
                </li>
            </ul>                    
        </nav><!--/nav-->
    </aside>
    <!--/aside -->
</template>
<script>
export default {
    props: ['showModal', 'menuCadastro', 'mostrarMenuCadastro', 'menuConsulta', 'mostrarMenuConsulta']
}
</script>
<style>
.fade-enter-active, .fade-leave-active {
  transition: opacity .2s;
}

div .col-6 {
  background: transparent;
}

.col-3 {
  padding-right: 0;
}

.col-6 {
  background-color: gray;
}


#menu-lateral{
    background-color: #3A4248;
    position: fixed;
    height: 100%;
}
nav ul {
    list-style: none;
    width: 95%;
}

nav ul li {
    color: #fff;
    margin-bottom: 5px;
    cursor: pointer;
}

.dashboard {
    background: rgba(255, 255, 255, 0.1);
}

nav ul li a {
    color: white;
}

nav ul li a:link {
    color: white;
}

nav ul li a:hover {
    text-decoration: none;
    color: white;
}

.img-dashboard {
    height: 46px;
}
</style>
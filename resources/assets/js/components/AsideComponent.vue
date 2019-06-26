<template>    
    <!-- aside -->
    <aside>
        <div>
            <a href="#" class="mt-3 mb-3 mr-2">
                <div class="d-flex justify-content-end">
                    <span class="linha"></span>
                </div>

                <div class="d-flex justify-content-end">
                    <span class="linha"></span>
                </div>

                <div class="d-flex justify-content-end">
                    <span class="linha"></span>
                </div>
            </a>
        </div>
        

        <div class="d-flex justify-content-center dashboard align-items-center">
            <span>
                <img src="../../../../public/icones/icons8-velocidade-50.png" alt="Dashboard">
            </span>
            <span class="text-white ml-2">Dashboard</span>
        </div>

        

        <nav class="row mt-4 ml-4">
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
                        <ul v-if="menuConsulta" class="ml-4">
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
                            <ul v-if="menuCadastro" class="ml-4">
                                <li>
                                    <router-link to="/cadastroestagiario">Estagiario</router-link>
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

aside {
    background-color: #3A4248;
}

.linha {
    width: 35px;
    height: 4px;
    background-color: #94AFB5;
    margin-bottom: 3px;
    border-radius: 2px;
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

/* nav ul li:hover {
    background-color: #f2f2f2;
    color: #262626;
} */

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
</style>
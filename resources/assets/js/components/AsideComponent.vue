<template>    
    <!-- aside -->
    <aside class="d-flex flex-column">

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
        

        <div class="d-flex justify-content-center dashboard align-items-center">
            <span>
                <img src="../../../../public/icones/icons8-velocidade-50.png" alt="Dashboard">
            </span>
            <span class="text-white ml-2">Dashboard</span>
        </div>

        

        <nav class="row mt-4">
            <ul>
                <li>
                    <a href="#">
                        <i class="fas fa-chevron-down mr-2"></i>
                        Consulta
                    </a>
                    <ul>
                        <li>
                            <a href="#">
                                Estagiários
                            </a>
                        </li>
                    </ul>
                    
                    <ul class="submenu d-flex flex-column">
                        <li>Ativos</li>
                        <li>Solicitação de Login</li>
                        <li>Em renovação</li>
                    </ul>

                    <ul>
                        <li>
                            <a href="#">
                                Vagas
                            </a>
                        </li>
                    </ul>

                    <ul>
                        <li>
                            <a href="#">
                                Supervisores
                            </a>
                        </li>
                    </ul>

                </li>
                <li>
                    <i class="fas fa-chevron-down mr-2"></i>
                    <router-link to="/cadastro">Cadastro</router-link>
                </li>
                <li>
                    <i class="fas fa-chevron-down mr-2"></i>
                    Relatórios
                </li>
                <li>
                    <i class="fas fa-chevron-down mr-2"></i>
                    Exportar
                </li>
            </ul>                    
        </nav><!--/nav-->
    </aside>
    <!--/aside -->
</template>
<script>
export default {
    
}
</script>
<style>
div .col-6 {
  background: transparent;
}

.col-3 {
  padding-right: 0;
}

.container {
  max-width: 1100px;
}

.col-6 {
  background-color: gray;
}

.yellow {
  background-color: yellow;
}

aside {
    background-color: #3A4248;
    height: 100vh;
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
}

nav ul li {
    color: #fff;
    margin-bottom: 5px;
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

.submenu {
    background: rgba(255, 255, 255, 0.1);
    padding-right: 10px;
    padding-left: 20px;
}
</style>
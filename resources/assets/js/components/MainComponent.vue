<template>    
    <div>
        <!--Painel Resumo-->
        <div class="row mt-5 branco">
            <div class="col-6 col-sm-4 col-md-3 mb-3">
                <div class="card bg-success" style="width: 10rem;">
                    <div class="card-body">
                        <a href="#">
                            <h1 class="card-title text-center text-white">80</h1>
                            <h6 class="card-subtitle mb-2 text-center text-white">Estagiários Ativos</h6>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-6 col-sm-4 col-md-3 mb-3">
                <div class="card bg-primary" style="width: 10rem;">
                    <div class="card-body">
                        <a href="#">
                            <h1 class="card-title text-center text-white">10</h1>
                            <h6 class="card-subtitle mb-2 text-center text-white">Contratos a Vencer em 90 dias</h6>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-6 col-sm-4 col-md-3 mb-3">
                <div class="card bg-warning" style="width: 10rem;">
                    <div class="card-body">
                        <a href="#">
                            <h1 class="card-title text-center text-white">2</h1>
                            <h6 class="card-subtitle mb-2 text-center text-white">Vagas em seleção</h6>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-6 col-sm-4 col-md-3 mb-3">
                <div class="card bg-danger" style="width: 10rem;">
                    <div class="card-body">
                        <a href="#">
                            <h1 class="card-title text-center text-white">1</h1>
                            <h6 class="card-subtitle mb-2 text-center text-white">Contratos Vencidos</h6>
                        </a>
                    </div>
                </div>
            </div>
        </div> <!--/Painel Resumo -->

        <!-- Acesso Rápido -->
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 linha-horizontal">
                    <span class="acesso-rapido d-flex justify-content-center">MAIS ACESSADOS</span>
                </div>
            </div>
        </div>         

        <div class="row">
            <div class="col-6 col-sm-4 col-md-3 mt-3">
                <div>
                    <div class="card-acesso-rapido" style="width: 10rem;">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <img class="img-acesso-rapido" src="../../../../public/icones/icons8-curriculo-50.png" alt="Estagiários Ativos">
                        </div>
                    </div>
                    <span class="titulo-card d-flex justify-content-center text-center mt-1">Estagiários Ativos</span>
                </div>
            </div>

            <div class="col-6 col-sm-4 col-md-3 mt-3">
                <div>
                    <div class="card-acesso-rapido" style="width: 10rem;">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <img class="img-acesso-rapido" src="../../../../public/icones/icons8-ativos-da-empresa-50.png" alt="Estagiários Ativos">
                        </div>
                    </div>
                    <span class="titulo-card d-flex justify-content-center text-center mt-1">Orçamento</span>
                </div>
            </div>

            <div class="col-6 col-sm-4 col-md-3 mt-3">
                <div>
                    <div class="card-acesso-rapido" style="width: 10rem;">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <img class="img-acesso-rapido" src="../../../../public/icones/icons8-boletim-50.png" alt="Estagiários Ativos">
                        </div>
                    </div>
                    <span class="titulo-card d-flex justify-content-center text-center mt-1">Vagas em Seleção</span>
                </div>
            </div>

            <div class="col-6 col-sm-4 col-md-3 mt-3">
                <div>
                    <div class="card-acesso-rapido" style="width: 10rem;">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <img class="img-acesso-rapido" src="../../../../public/icones/icons8-ms-excel-50.png" alt="Estagiários Ativos">
                        </div>
                    </div>
                    <span class="titulo-card d-flex justify-content-center text-center mt-1">Exportar Dados de Estagiários</span>
                </div>
            </div>
            
        </div>
        <!-- /Acesso Rápido -->
        
    </div>
</template>
<script>
export default {
    
}
</script>
<style>
.card-body {
    height: 134px;
}

.card-body .card-subtitle {
    font-family: 'Roboto', sans-serif;
    font-size: 14px;
}

.card-body a:hover {
    text-decoration: none;
}

.acesso-rapido {
    font-family: 'Roboto', sans-serif;
    font-style: normal;
    font-weight: normal;
    font-size: 18px;
    line-height: 21px;
    text-align: center;
    letter-spacing: 0.42em;
    color: #828282;
}

.linha-horizontal {
    border-bottom: 1px solid #D8D8D8;
}

.card-acesso-rapido {
    box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
    background-color: #F2F2F2;
}

.img-acesso-rapido {
    width: 50px;
    height: 50px;
    margin: 0;
    padding: 0;
}

.titulo-card {
    font-family: 'Roboto', sans-serif;
    font-size: 14px;
    line-height: 19px;
    letter-spacing: 0.3em;
    text-decoration: underline;
    text-transform: uppercase;
    color: #000000;
}

</style>
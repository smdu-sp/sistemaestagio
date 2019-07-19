<template>    
    <!-- Header -->
    <div class="d-flex flex-column">
        <!--row-->
        <div class="row">
            <div class="col-12">
                <header class="d-flex justify-content-between align-items-center flex-row">
                    <img src="../../../../public/logo/licenciamento.png" alt="Prefeitura de São Paulo" class="img-licenciamento"/>
                    <span class="titulo">Sistema de Controle de Estagiários</span>
                    <div class="d-flex flex-row mr-4">
                        <!--<div class="mr-2 mt-2">
                            <span alt="Lembrete" class="badge1" data-badge="8">
                                <img class="icone-lembrete" src="../../../../public/icones/icons8-lembrete-de-compromissos-50.png" />
                            </span>
                        </div>
                        <div class="fundo-usuario mr-2">
                            <img src="../../../../public\icones\user-regular.svg" class="icone-usuario" alt="">
                        </div>
                        <span class="flex-column">
                            <span class="msg-user">Olá!</span>
                            <span class="msg-user nome-user">Michael</span>
                        </span> 
                        <span class="mt-3 ml-2">
                            <p class="seta seta-direita"></p>
                        </span>-->
                    </div>
                </header>
            </div>
        </div> <!--/row-->
        <!-- row -->
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><router-link :to="{name: 'home'}">Home</router-link></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ this.$route.name == 'home' ? '' : this.$route.name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--/row-->
    </div>
    <!--/ Header -->

    

</template>
<script>
export default {
    
}
</script>
<style>
div .col-12 {
    padding-left: 0;
    padding-right: 0;
}

header {
    border-bottom: 1px solid #94AFB5;
}
.img-licenciamento {
    width: 126px;
    height: 45.38px;
    padding: 3px;
    margin-left: 10px;
}

.titulo {
    display: inline;
    font-family: "Montserrat", sans-serif;
    width: 260px;
    float: left;
    position: absolute;
    margin-left: 34%;
}

.icone-lembrete {
    width: 25px;
    height: 25px;
    position: relative;
}

.badge1 {
   position:relative;
}

.badge1[data-badge]:after {
   content:attr(data-badge);
   position:absolute;
   top:-7px;
   right:-1px;
   font-size:.7em;
   background:#F86C6B;
   color:white;
   width:16px;height:16px;
   text-align:center;
   line-height:18px;
   border-radius:50%;
   box-shadow:0 0 1px #333;
}

.icone-usuario {
    width: 30px;
    height: 32px;
    margin-top: 2px;
}

.fundo-usuario {
    background: rgba(23, 162, 184, 0.3);
    opacity: 30%;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    text-align: center;
    display: inline-block;
}

.msg-user {
    font-family: "Montserrat", sans-serif;
    font-size: 16px;
    display: block;
}

.nome-user {
    font-weight: bold;
    margin-top: -7px;
    font-size: 16px;
}

.seta {
  padding: 6px; /* Arrow size */
  box-shadow: 1px -1px 0 1px black inset;
  -webkit-box-shadow: 2px -2px black inset;
  border: solid transparent;
}

.seta-direita { transform:rotate(-45deg) }

.pagina-atual {
    border-bottom: 1px solid #94AFB5;
}

.home {
    display: block;
    margin-top: 10px;
}

.breadcrumb {
    width: 98%;
    margin-left: 2px;
}
</style>
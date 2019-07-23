<template>
    <img @click="imprimir" v-b-tooltip.hover title="Imprimir Relatório" class="img-imprimir" src="../../../../public/images/icons8-enviar-para-a-impressora-30.png" alt="Imprimir Relatório">
</template>

<script>
export default {
    methods: {
        imprimir(){
            document.getElementsByClassName("col-12")[0].style.visibility = 'hidden';
            document.getElementsByClassName("col-12")[1].style.visibility = 'hidden';
            document.getElementById("menu-lateral").parentElement.style.display = "none";
            document.getElementsByClassName('col-9')[0].classList.add('col-11');
            window.print();
            window.setTimeout(function(){
                document.getElementById("menu-lateral").parentElement.style.display = "block";
                document.getElementsByClassName('col-9')[0].classList.remove('col-11');
                document.getElementsByClassName("col-12")[0].style.visibility = 'visible';
                document.getElementsByClassName("col-12")[1].style.visibility = 'visible';
                }, 100);
            }
    }
}
</script>

<style>

</style>

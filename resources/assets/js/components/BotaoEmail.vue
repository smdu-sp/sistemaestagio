<template>
    <a class="btn btn-success" :href="'mailto:condmart@terra.com.br?cc=vaulicino@prefeitura.sp.gov.br;kesiaavelino@prefeitura.sp.gov.br&amp;subject=Solicita%C3%A7%C3%A3o%20de%20cart%C3%A3o%20de%20acesso&amp;body=Nome%3A%20'+post.nome+'%0ARg%3A%20'+post.rg+'%0AData%20de%20In%C3%ADcio%3A%20'+post.dt_inicio">Solicitar cartão de acesso</a>    

    <!--
        Formatar data:
        +post.dt_inicio.substring(8,10)+'/'+post.dt_inicio.substring(5,7)+'/'+post.dt_inicio.substring(0,4) 
    -->
</template>

<script>
export default {
    props: ['post'],
    data() {
        return{
            nome: ''
        }
    }
}
</script>

<style>

</style>

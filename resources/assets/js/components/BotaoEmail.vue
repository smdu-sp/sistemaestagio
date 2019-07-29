<template>
    <a class="btn btn-success" :href="'mailto:condmart@terra.com.br?cc=vaulicino@prefeitura.sp.gov.br;kesiaavelino@prefeitura.sp.gov.br&amp;subject=Solicita%C3%A7%C3%A3o%20de%20cart%C3%A3o%20de%20acesso&amp;body=Nome%3A%20'+nome+'%0ARg%3A%20'+rg+'%0AData%20de%20In%C3%ADcio%3A%20'+data_inicio">Solicitar cartão de acesso</a>    
</template>

<script>
export default {
    props: ['post'],
    computed: {
        nome() {
            if(!this.post.nome) {
                return ''
            } else {
                return this.post.nome
            }
        },
        rg() {
            if(!this.post.rg) {
                return ''
            } else {
                return this.post.rg
            }
        },
        data_inicio() {
            if(!this.post.dt_inicio) {
                return ''
            } else {
                return this.post.dt_inicio.substring(8,10)+'/'+this.post.dt_inicio.substring(5,7)+'/'+this.post.dt_inicio.substring(0,4)
            }
        }
    }
}
</script>

<style>

</style>

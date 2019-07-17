<template>
    <h1>Entradas, Saídas e Renovação</h1>
</template>

<script>
import { mapMutations, mapActions, mapGetters } from 'vuex'
export default {
    data() {
        return {
            estagiariosContratados30Dias: {}
        }
    },
    beforeMount() {
        this.salvaEstagiarios();
        this.salvaEstagiariosContratados();
        this.estagiariosContratados30Dias = this.getEstagiariosContratados30Dias();
        console.log(this.estagiariosContratados30Dias)
    },
    methods: {
        ...mapActions(['salvaEstagiarios', 'salvaEstagiariosContratados']),
        ...mapGetters(['getEstagiarios', 'getEstagiariosContratados30Dias'])
    }
}
</script>

<style>

</style>

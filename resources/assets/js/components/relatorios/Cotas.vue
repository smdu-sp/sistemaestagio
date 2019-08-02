<template>
    <div>
        <h1 class="text-center">Relatório de Cotas</h1>
        <div class="col-md-12">
            <div class="d-flex mb-2">
                <h4 class="mr-2">Cotas Raciais</h4> 
                <botao-imprimir-component></botao-imprimir-component>
            </div>
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <th class="text-center">Tipo</th>
                    <th class="text-center">Quantidade</th>
                    <th class="text-center">%</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Brancos</td>
                        <td>{{ estagiariosBrancos.length }}</td>
                        <td>{{ (estagiariosBrancos.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
                    </tr>
                    <tr>
                        <td>Pardos</td>
                        <td>{{ estagiariosPardos.length }}</td>
                        <td>{{ (estagiariosPardos.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
                    </tr>
                    <tr>
                        <td>Amarelos</td>
                        <td>{{ estagiariosAmarelos.length }}</td>
                        <td>{{ (estagiariosAmarelos.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
                    </tr>
                    <tr>
                        <td>Negros</td>
                        <td>{{ estagiariosPretos.length }}</td>
                        <td>{{ (estagiariosPretos.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
                    </tr>
                    <tr>
                        <td>Indígenas</td>
                        <td>{{ estagiariosIndígenas.length }}</td>
                        <td>{{ (estagiariosIndígenas.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>{{ estagiariosContratados.length }}</td>
                        <td>100</td>
                    </tr>
                </tbody>
            </table>
            <h4>Cotas PCD (Portadores de deficiência)</h4>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <th class="text-center">Tipo</th>
                    <th class="text-center">Quantidade</th>
                    <th class="text-center">%</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Deficientes</td>
                        <td>{{ estagiariosDeficientes.length }}</td>
                        <td>{{ (estagiariosDeficientes.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import filtros from '../../mixins/filtros';
export default {
    data() {
        return {
            filtro: 'Todas',
            estagiarios: [],
            estagiariosContratados: [],
            estagiariosOrdem: [],
            estagiariosBrancos: [],
            estagiariosPardos: [],
            estagiariosAmarelos: [],
            estagiariosPretos: [],
            estagiariosIndígenas: [],
            estagiariosDeficientes: [],
            msg: {
                error: false,
                success: false
            }
        }
    },
    mixins: [filtros],
    beforeMount() {
        this.retornaEstagiarios()
    },
    filters: {
        duasCasasDecimais(numero) {
            return numero.toFixed(2)
        }
    },
    methods: {
        salvaEstagiariosContratados() {
            for(let i in this.estagiarios) {
                if(this.estagiarios[i].situacao === 1) {
                    this.estagiariosContratados.push(this.estagiarios[i])
                }
            }
            this.classificaEstagiarios();
        },
        classificaEstagiarios() {
            for(let i in this.estagiariosContratados) {
                if(this.estagiariosContratados[i].deficiencia) {
                    this.estagiariosDeficientes.push(this.estagiariosContratados[i])
                } else if(this.estagiariosContratados[i].raca_cor === 1) {
                    this.estagiariosBrancos.push(this.estagiarios[i])
                } else if(this.estagiariosContratados[i].raca_cor === 2) {
                    this.estagiariosPardos.push(this.estagiarios[i])
                } else if(this.estagiariosContratados[i].raca_cor === 3) {
                    this.estagiariosAmarelos.push(this.estagiarios[i])
                } else if(this.estagiariosContratados[i].raca_cor === 4) {
                    this.estagiariosPretos.push(this.estagiarios[i])
                } else if(this.estagiariosContratados[i].raca_cor === 5) {
                    this.estagiariosIndígenas.push(this.estagiarios[i])
                } 
            }
        },
        retornaEstagiarios() {
            const uriEstagiarios = '/api/estagiarios';

            this.axios.get(uriEstagiarios)
            .then(response => {
                this.estagiarios = response.data;
                this.msg.error = false;
                this.msg.success = true;
                this.salvaEstagiariosContratados();
            })
            .catch(error => {
                this.msg.success = false;
                this.msg.error = true;
            })
        }
    }
}
</script>

<style scoped>

</style>

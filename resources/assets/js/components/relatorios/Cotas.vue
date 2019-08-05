<template>
    <div>
        <h1 class="text-center">Relatório de Cotas</h1>
        <div class="col-md-12">
            <div class="d-flex mb-2">
                <botao-imprimir-component></botao-imprimir-component>
            </div>
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <th class="text-center">Tipo</th>
                    <th class="text-center">Gênero</th>
                    <th class="text-center">Quantidade</th>
                    <th class="text-center">%</th>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="2" class="vertical">Brancos</td>
                        <td>Masculino</td>
                        <td>{{ estagiariosBrancosMasculinos.length }}</td>
                        <td>{{ (estagiariosBrancosMasculinos.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
                    </tr>
                    <tr>
                        <td>Feminino</td>
                        <td>{{ estagiariosBrancosFemininos.length }}</td>
                        <td>{{ (estagiariosBrancosFemininos.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
                    </tr>
                    <tr>
                        <td rowspan="2" class="vertical">Pardos</td>
                        <td>Masculino</td>
                        <td>{{ estagiariosPardosMasculinos.length }}</td>
                        <td>{{ (estagiariosPardosMasculinos.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
                    </tr>
                    <tr>
                        <td>Feminino</td>
                        <td>{{ estagiariosPardosFemininos.length }}</td>
                        <td>{{ (estagiariosPardosFemininos.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
                    </tr>
                    <tr>
                        <td rowspan="2" class="vertical">Amarelos</td>
                        <td>Masculino</td>
                        <td>{{ estagiariosAmarelosMasculinos.length }}</td>
                        <td>{{ (estagiariosAmarelosMasculinos.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
                    </tr>
                    <tr>
                        <td>Feminino</td>
                        <td>{{ estagiariosAmarelosFemininos.length }}</td>
                        <td>{{ (estagiariosAmarelosFemininos.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
                    </tr>
                    <tr>
                        <td rowspan="2" class="vertical">Negros</td>
                        <td>Masculino</td>
                        <td>{{ estagiariosPretosMasculinos.length }}</td>
                        <td>{{ (estagiariosPretosMasculinos.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
                    </tr>
                    <tr>
                        <td>Feminino</td>
                        <td>{{ estagiariosPretosFemininos.length }}</td>
                        <td>{{ (estagiariosPretosFemininos.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
                    </tr>
                    <tr>
                        <td rowspan="2" class="vertical">Indígenas</td>
                        <td>Masculino</td>
                        <td>{{ estagiariosIndigenasMasculinos.length }}</td>
                        <td>{{ (estagiariosIndigenasMasculinos.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
                    </tr>
                    <tr>
                        <td>Feminino</td>
                        <td>{{ estagiariosIndigenasFemininos.length }}</td>
                        <td>{{ (estagiariosIndigenasFemininos.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
                    </tr>
                    <tr>
                        <td rowspan="2" class="vertical">Deficientes</td>
                        <td>Masculino</td>
                        <td>{{ estagiariosDeficientesMasculinos.length }}</td>
                        <td>{{ (estagiariosDeficientesMasculinos.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
                    </tr>
                    <tr>
                        <td>Feminino</td>
                        <td>{{ estagiariosDeficientesFemininos.length }}</td>
                        <td>{{ (estagiariosDeficientesFemininos.length / estagiariosContratados.length) * 100 | duasCasasDecimais }}</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td colspan="2" class="text-center">{{ estagiariosContratados.length }}</td>
                        <td>100</td>
                    </tr>
                </tbody>
            </table>
            <!-- <h4>Cotas PCD (Portadores de deficiência)</h4>
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
            </table> -->
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
            estagiariosBrancosMasculinos: [],
            estagiariosBrancosFemininos: [],
            estagiariosPardosMasculinos: [],
            estagiariosPardosFemininos: [],
            estagiariosAmarelosMasculinos: [],
            estagiariosAmarelosFemininos: [],
            estagiariosPretosMasculinos: [],
            estagiariosPretosFemininos: [],
            estagiariosIndigenasMasculinos: [],
            estagiariosIndigenasFemininos: [],
            estagiariosDeficientesMasculinos: [],
            estagiariosDeficientesFemininos: [],
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
                    if(this.estagiariosContratados[i].sexo === 'MASCULINO') {
                        this.estagiariosDeficientesMasculinos.push(this.estagiarios[i])
                    } else {
                        this.estagiariosDeficientesFemininos.push(this.estagiarios[i])
                    }
                    this.estagiariosDeficientes.push(this.estagiariosContratados[i])
                } else if(this.estagiariosContratados[i].raca_cor === 1) {
                    if(this.estagiariosContratados[i].sexo === 'MASCULINO') {
                        this.estagiariosBrancosMasculinos.push(this.estagiarios[i])
                    } else {
                        this.estagiariosBrancosFemininos.push(this.estagiarios[i])
                    }
                } else if(this.estagiariosContratados[i].raca_cor === 2) {
                    if(this.estagiariosContratados[i].sexo === 'MASCULINO') {
                        this.estagiariosPardosMasculinos.push(this.estagiarios[i])
                    } else {
                        this.estagiariosPardosFemininos.push(this.estagiarios[i])
                    }
                } else if(this.estagiariosContratados[i].raca_cor === 3) {
                    if(this.estagiariosContratados[i].sexo === 'MASCULINO') {
                        this.estagiariosAmarelosMasculinos.push(this.estagiarios[i])
                    } else {
                        this.estagiariosAmarelosFemininos.push(this.estagiarios[i])
                    }
                } else if(this.estagiariosContratados[i].raca_cor === 4) {
                    if(this.estagiariosContratados[i].sexo === 'MASCULINO') {
                        this.estagiariosPretosMasculinos.push(this.estagiarios[i])
                    } else {
                        this.estagiariosPretosFemininos.push(this.estagiarios[i])
                    }
                } else if(this.estagiariosContratados[i].raca_cor === 5) {
                    if(this.estagiariosContratados[i].sexo === 'MASCULINO') {
                        this.estagiariosIndigenasMasculinos.push(this.estagiarios[i])
                    } else {
                        this.estagiariosIndigenasFemininos.push(this.estagiarios[i])
                    }
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
.vertical {
    vertical-align: middle;
}
</style>

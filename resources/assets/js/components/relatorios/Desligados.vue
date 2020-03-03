<template>
    <div id="printable">
        <h1 class="d-inline-block">Estagiários desligados</h1>
        <botao-imprimir-component></botao-imprimir-component>
        <botao-excel nome="estagiarios_desligados"></botao-excel>
        <div v-if="msg.error" class="alert alert-danger">
            {{ msg.erro }}
        </div>
        <div class="col-md-12">
            <div id="divTabela">
                <h5 class="alert alert-info">Total: {{ estagiariosDesligados.length }}</h5>
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Departamento</th>
                            <th scope="col">Supervisor</th>
                            <th scope="col">Admissão</th>
                            <th scope="col">Desligamento</th>
                            <th scope="col">Horas Estagiadas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(estagiario, indice) of estagiariosOrdenados" :key="estagiario.cod_estudante">
                            <td>{{ indice + 1 }}</td>
                            <td>{{ estagiario.nome }}</td>
                            <td>{{ estagiario.dep_hierarquico }}</td>
                            <td>{{ estagiario.supervisor }}</td>
                            <td>{{ estagiario.dt_inicio | dataFormatada }}</td>
                            <td>{{ estagiario.desligado | dataFormatada }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import filtros from '../../mixins/filtros';
import _ from 'lodash';
export default {
    data() {
        return {
            estagiariosDesligados: [],
            msg: {
                error: false,
                success: false
            }
        }
    },
    computed: {
        estagiariosOrdenados() {
            return _.orderBy(this.estagiariosDesligados, 'nome');
        }
    },
    beforeMount() {
        this.retornaEstagiarios();
    },
    mixins: [filtros],
    methods: {
        retornaEstagiarios() {
            const uriEstagiarios = '/api/estagiarios';

            this.axios.get(uriEstagiarios).then(response => {
                for(let i in response.data) {
                    if(response.data[i].desligado) {
                        response.data[i].nome = response.data[i].nome.toUpperCase();
                        this.estagiariosDesligados.push(response.data[i]);
                    }
                }
            })
            .catch(error => {
                this.msg.success = false;
                this.msg.error = true;
                this.msg.erro = 'Erro ao retornar estagiários do banco';
            })
        }
    }
}
</script>

<style>

</style>

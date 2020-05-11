<template>
<div id="printable" :key="requisicoes">
    <h1 class="d-inline-block">Estagiários desligados</h1>
    <botao-imprimir-component></botao-imprimir-component>
    <botao-excel nome="estagiarios_desligados"></botao-excel>
    <div v-if="msg.error" class="alert alert-danger">{{ msg.erro }}</div>
    <div class="col-md-12">
        <div id="divTabela">
            <h5 class="alert alert-info">Total: {{ estagiariosDesligados.length }} </h5>
            <h5 class="alert alert-warning" v-if="estagiariosDesligados.length > requisicoes">A calcular: {{ estagiariosDesligados.length - requisicoes }}</h5>
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
                        <td>{{ estagiario.horasEstagiadas ? estagiario.horasEstagiadas : "Calculando..." }} </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</template>

<script>
import filtros from "../../mixins/filtros";
import _ from "lodash";

export default {
    data() {
        return {
            estagiariosDesligados: [],
            requisicoes: 0,
            todosFeriados: [],
            msg: {
                error: false,
                success: false
            }
        };
    },
    computed: {
        estagiariosOrdenados() {
            return _.orderBy(this.estagiariosDesligados, "nome");
        }
    },
    beforeMount() {
        this.retornaEstagiarios();
    },
    mixins: [filtros],
    methods: {
        retornaEstagiarios() {
            const uriEstagiarios = "/api/estagiarios";

            this.axios.get("/api/feriados/all").then(response => {
                    this.todosFeriados = response.data;

                    this.axios.get(uriEstagiarios).then(response => {
                            for (let i in response.data) {
                                if (response.data[i].desligado) {
                                    response.data[i].nome = response.data[i].nome.toUpperCase();
                                    this.estagiariosDesligados.push(response.data[i]);
                                }
                            }
                            for (var i in this.estagiariosDesligados) {
                                if (this.estagiariosDesligados[i].dt_termino_3_aditivo !== null) {
                                    this.estagiariosDesligados[i].dataTermino = this.estagiariosDesligados[i].dt_termino_3_aditivo;
                                } else if (this.estagiariosDesligados[i].dt_termino_2_aditivo !== null) {
                                    this.estagiariosDesligados[i].dataTermino = this.estagiariosDesligados[i].dt_termino_2_aditivo;
                                } else if (this.estagiariosDesligados[i].dt_termino_1_aditivo !== null) {
                                    this.estagiariosDesligados[i].dataTermino = this.estagiariosDesligados[i].dt_termino_1_aditivo;
                                } else {
                                    this.estagiariosDesligados[i].dataTermino = this.estagiariosDesligados[i].dt_termino;
                                }

                                let inicio = this.estagiariosDesligados[i].dt_inicio ?
                                    this.estagiariosDesligados[i].dt_inicio.substring(0, 10) : "0000-00-00";
                                let final = this.estagiariosDesligados[i].dataTermino ?
                                    this.estagiariosDesligados[i].dataTermino.substring(0, 10) : "0000-00-00";
                                let arrIndex = i;

                                // Calcula dias uteis em dias de recesso;
                                var nome = this.estagiariosDesligados[i].nome;
                                var diasAVerificar;
                                var diasUteis = 0;
                                var horasUteisRecesso = 0;

                                for (var k = 1; k <= 7; k++) {
                                    // iteração para usar nas 7 possíveis solicitações de recesso
                                    if (this.estagiariosDesligados[i]["dt_inicial_" + k] !== null) {
                                        var inicioRecesso = new Date(
                                            this.estagiariosDesligados[i]["dt_inicial_" + k]
                                        ).getTime();
                                        var terminoRecesso = new Date(
                                            this.estagiariosDesligados[i]["dt_termino_" + k]
                                        ).getTime();

                                        var diffDias = terminoRecesso - inicioRecesso;
                                        var numDias = diffDias / 86400000; // Qtd de dias totais

                                        for (var j = 0; j < numDias; j++) {
                                            // iteração para contar numero de dias entre a dt_inicio até dt_termino
                                            diasAVerificar = new Date(inicioRecesso + j * 86400000);
                                            if (this.verificaDiasUteis(diasAVerificar)) {
                                                diasUteis++;
                                            }
                                        }
                                    }
                                }
                                horasUteisRecesso = diasUteis * 4;
                                // console.log(nome, horasUteisRecesso); // saída de dados;

                                

                                this.axios.get("/api/feriados/periodo/" + inicio + "/" + final).then(response => {
                                        this.estagiariosDesligados[arrIndex].horasEstagiadas =
                                            parseInt(response.data) * 4;
                                            if (this.estagiariosDesligados[arrIndex].horasEstagiadas < 100) {
                                                console.log(this.estagiariosDesligados[arrIndex]);

                                            }
                                        this.requisicoes++; // Atualiza componentkey da tabela para forçar atualização do conteúdo
                                        
                                    })
                                    .catch(err => {
                                        console.error(err);
                                    });
                            }
                        })
                        .catch(error => {
                            this.msg.success = false;
                            this.msg.error = true;
                            this.msg.erro = "Erro ao retornar estagiários do banco";
                        });
                }) // fim feriados
                .catch(err => {
                    console.error(err);
                });
        },
        verificaDiasUteis(stringDia) {
            var data = new Date(stringDia);

            // verifica se é feriado
            for (var i in this.todosFeriados) {
                if (data.getTime() / 1000 == this.todosFeriados[i] + 10800) {
                    // adicionado 10800 para 3 horas (UTC-3)
                    return false;
                }
            }

            // verifica se é FDS
            if (data.getDay() == 0 || data.getDay() == 6) {
                // 0 para domingo e 6 para sábado
                return false;
            }
            return true;
        },
        calculoHoras(inicial, final) {
            if (inicial == null || final == null) {
                return "";
            }
            inicial = inicial.substring(0, 10);
            final = final.substring(0, 10);
            const uriFeriados = "/api/feriados/periodo/" + inicial + "/" + final;

            this.axios.get(uriFeriados).then(response => {
                return parseInt(response.data) * 4;
            });
        }
    }
};
</script>

<style>
</style>

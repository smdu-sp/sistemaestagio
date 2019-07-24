<template>
    <div>
        <h1>Relatório de Cotas</h1>
        <div class="col-md-12">
            <div class="form-group">
                <label for="selecao">Selecione o tipo de relatório desejado</label>
                <select id="selecao" class="form-control" v-model="filtro">
                    <option value="Todas">Todas</option>
                    <option value="1">Branco(a)</option>
                    <option value="2">Pardo(a)</option>
                    <option value="3">Amarelo(a)</option>
                    <option value="4">Preto(a)</option>
                    <option value="5">Indígena</option>
                </select>
            </div>
            <div>
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Raça</th>
                        <th scope="col">Departamento</th>
                        <th scope="col">Supervisor</th>
                        <th scope="col">Início</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(estagiario, indice) of filtrarCota" :key="estagiario.nome">
                            <td>{{ indice + 1 }}</td>
                            <td>{{ estagiario.nome }}</td>
                            <td>{{ estagiario.raca_cor | cor }}</td>
                            <td>{{ estagiario.dep_hierarquico ? estagiario.dep_hierarquico : 'NÃO CADASTRADO' }}</td>
                            <td>{{ estagiario.supervisor.toUpperCase() }}</td>
                            <td>{{ estagiario.dt_inicio | dataFormatada }}</td>                        
                        </tr>
                    </tbody>
                </table>
            </div>
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
            estagiariosOrdem: []
        }
    },
    mixins: [filtros],
    beforeMount() {
        this.retornaEstagiarios()
    },
    filters: {
        cor(cor) {
            if(cor === 0) {
                return 'Não Cadastrado'
            } else if(cor === 1) {
                return 'Branco'
            } else if(cor === 2) {
                return 'Pardo'
            } else if(cor === 3) {
                return 'Amarelo';
            } else if(cor === 4) {
                return 'Preto';
            } else if(cor === 5) {
                return 'Indígena';
            }
        }
    },
    computed: {
        filtrarCota() {
            if(this.filtro == 'Todas') {
                return this.estagiariosOrdem;
            } else {
                let estagiario = this.estagiariosOrdem.filter(estagiario => {
                    return estagiario.raca_cor == this.filtro;
                })
                return estagiario;
            }
        }
    },
    methods: {
        salvaEstagiariosContratados() {
            for(let i in this.estagiarios) {
                if(this.estagiarios[i].situacao === 1) {
                    this.estagiariosContratados.push(this.estagiarios[i])
                }
            }
        },
        estagiariosOrdenados() { 
            let lowerCaseEstagiarios = _.clone(this.estagiariosContratados);
            if(typeof(lowerCaseEstagiarios.map) == 'undefined')
                return;
            lowerCaseEstagiarios = lowerCaseEstagiarios.map((estagiario) => {
                estagiario.nome = estagiario.nome.toUpperCase();
                return estagiario;
            });

            const sortedEstagiarios = _.orderBy(lowerCaseEstagiarios, ['nome'], ['asc']);

            this.estagiariosOrdem = sortedEstagiarios;
        },
        retornaEstagiarios() {
            const uriEstagiarios = '/api/estagiarios';

            this.axios.get(uriEstagiarios)
            .then(response => {
                this.estagiarios = response.data;
                this.salvaEstagiariosContratados();
                this.estagiariosOrdenados();
            })
            .catch(error => {
                console.log(error)
            })
        }
    }
}
</script>

<style scoped>

</style>

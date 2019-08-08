<template>
    <div>
        <h1>Cadastro de Curso</h1>
        <div v-if="msg.success" class="alert alert-success">
            {{ msg.sucesso }}
        </div>
        <div v-if="msg.error" class="alert alert-danger">
            {{ msg.erro }}
        </div>
            <b-card no-body>
                <b-tabs card>
                    <b-tab title="Dados do curso" active>
                        <b-card-text>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">
                                        Curso
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input 
                                        type="text" 
                                        @blur="validaCurso"
                                        :class="{'is-invalid': cursoValido}"
                                        class="form-control" 
                                        v-model="curso.formacao">
                                    <div v-if="cursoValido" class="invalid-feedback">
                                        O curso não pode ser vazio
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <input type="button" value="Cadastrar" @click="validaCadastro" class="btn btn-primary">
                                </div>
                            </div>
                        </b-card-text>
                    </b-tab>
                </b-tabs>
            </b-card>
        </div>
</template>

<script>
import methods from '../../mixins/methods';
export default {
    data() {
        return {
            curso: {},
            msg: {
                success: false,
                error: false
            },
            cursoValido: false
        }
    },
    mixins: [methods],
    methods: {
        validaCurso(curso) { this.validacao(curso, 'cursoValido') },
        cadastrar() {
            const uriCursos = '/api/cursos';

            this.axios.post(uriCursos, this.curso).then(response => {
                this.msg.error = false;
                this.msg.success = true;
                this.msg.sucesso = 'Curso cadastrado com sucesso'
            })
            .catch(error => {
                this.msg.success = false;
                this.msg.error = true;
                this.msg.erro = 'Erro ao cadastrar curso'
            })
        },
        validaCadastro() {
            if(!this.curso.formacao) {
                this.cursoValido = true;
                this.msg.error = true;
                this.msg.erro = 'Revise o campo em vermelho';
            } else {
                this.cursoValido = false;
                this.msg.error = false;
                this.cadastrar();
                this.curso = {}
            }
        }
        
    }
}
</script>

<style>

</style>

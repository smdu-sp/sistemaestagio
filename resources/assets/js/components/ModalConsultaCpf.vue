<template>
    <!--Modal ativado pelo botão do componente Aside -->
    <b-modal ref="my-modal" hide-footer title="Consulta de Estagiários">

      <div v-if="msg.error" class="alert alert-danger">{{ msg.erro }}</div>

      <b-form ref="form" @submit="validaCpf">
          <label for="inputCpf">Digite o CPF do Estagiário</label>
            <the-mask type="text"
              @input="validacaoCpf"
              class="form-control mt-2" 
              maxlength="14"
              :class="{'is-invalid': cpfInvalido, 'is-valid': cpfValido}"
              id="inputCpf" 
              placeholder="Ex: 000.000.000-00"
              mask="###.###.###-##"
              v-model="post.cpf"></the-mask>
              <div v-if="cpfInvalido" class="invalid-feedback">
                O CPF deve ter 11 números
              </div>
        </b-form>
        <div class="text-right">
          <b-button type="submit" class="mt-3" variant="outline-primary" @click="buscaEstagiario">Ok</b-button>
          <b-button class="mt-3" variant="outline-danger" @click="hideModal">Cancelar</b-button>
        </div>

        <div v-if="loading" class="text-center">
          <b-spinner variant="primary" label="Spinning"></b-spinner>
          <b-spinner variant="primary" type="grow" label="Spinning"></b-spinner>
        </div>

    </b-modal>
  <!--Modal-->
</template>

<script>
export default {

}
</script>

<style>

</style>

<template>
  <div>
    <b-modal id="bv-modal-example" hide-footer>
        <div class="d-block text-center">
        <h3>Tem certeza que deseja sair?</h3>
        </div>
        <div class="d-flex justify-content-end mt-4">
            <router-link :to="{name: 'home'}" class="btn btn-outline-primary mt-3" flex>Sim</router-link>
            <b-button class="mt-3" flex @click="$bvModal.hide('bv-modal-example')" variant="outline-danger ml-2">Cancelar</b-button>
        </div>
    </b-modal>
  </div>
</template>

<script>
  export default {
  }
</script>
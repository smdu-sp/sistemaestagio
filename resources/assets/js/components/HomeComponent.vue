<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-3">
        <aside-component 
        :showModal="showModal" 
        :menuCadastro="menuCadastro" 
        :mostrarMenuCadastro="mostrarMenuCadastro"
        :mostrarMenuConsulta="mostrarMenuConsulta"
        :menuConsulta="menuConsulta"></aside-component>
      </div>
        <div class="col-9 d-flex flex-column">
          <header-component></header-component>
          <router-view></router-view>
        </div><!--/col-9-->
      </div><!--/col-3-->
    </div><!-- /row -->
  </div> <!-- /container-fluid -->
</template>

<script>
export default {
  data() {
    return {
      menuCadastro: false,
      menuConsulta: false
    }
  },
  methods: {
    showModal() {
      this.$children[2].$refs['my-modal'].show(); // TODO: Criar vínculo consistente com o component Consulta
    },
    hideModal() {
      this.$children[2].$refs['my-modal'].hide();
    },
    mostrarMenuCadastro() {
      this.menuConsulta = false;
      this.menuCadastro = !this.menuCadastro;
    },
    mostrarMenuConsulta() {
      this.menuCadastro = false;
      this.menuConsulta = !this.menuConsulta;
    }
  }
}
</script>

<style>
body
{
  overflow-x: hidden;
}

.container-fluid .col-3 {
  padding-right: 0;
}

.col-6 {
  background-color: gray;
}
</style>
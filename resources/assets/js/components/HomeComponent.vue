<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-3">
        <aside-component 
          :exibeModalEstagiario="exibeModalEstagiario"
          :menuCadastro="menuCadastro" 
          :mostrarMenuCadastro="mostrarMenuCadastro"
          :menuConsulta="menuConsulta"
          :mostrarMenuConsulta="mostrarMenuConsulta"
          :menuRelatorios="menuRelatorios"
          :mostrarMenuRelatorios="mostrarMenuRelatorios"></aside-component>
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
      menuConsulta: false,
      menuRelatorios: false
    }
  },
  methods: {
    exibeModalEstagiario() {
      this.$children[2].$refs['consulta-estagiario'].show(); // TODO: Criar vínculo consistente com o component Consulta
    },
    escondeModalEstagiario() {
      this.$children[2].$refs['consulta-estagiario'].hide();
    },
    mostrarMenuCadastro() {
      this.menuConsulta = false;
      this.menuRelatorios = false;
      this.menuCadastro = !this.menuCadastro;
    },
    mostrarMenuConsulta() {
      this.menuCadastro = false;
      this.menuRelatorios = false;
      this.menuConsulta = !this.menuConsulta;
    },
    mostrarMenuRelatorios() {
      this.menuCadastro = false;
      this.menuConsulta = false;
      this.menuRelatorios = !this.menuRelatorios;
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
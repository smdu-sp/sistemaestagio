<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-3">
        <aside-component :showModal="showModal"></aside-component>
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
  methods: {
    showModal() {
      this.$refs['my-modal'].show()
    },
    hideModal() {
      this.$refs['my-modal'].hide()
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
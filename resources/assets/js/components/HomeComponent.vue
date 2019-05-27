<template>
  <div class="" id="app">

    <div class="container">
      <div class="row">
        <div class="col-3">
            <aside-component></aside-component>
        </div>
        <div class="col-9">
            <header-component></header-component>
            <main-component></main-component>
        </div>
      </div><!-- /row -->
    </div> <!-- /container -->

  </div>
</template>

<script>
import { routes } from '../routes.js';
export default {

}
</script>

<style scoped>
aside {
  height: 100vh;
}
</style>
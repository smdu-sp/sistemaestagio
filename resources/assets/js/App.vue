<template>
    <div class="container-fluid">
        <div>
            <transition name="fade">
                <router-view></router-view>
            </transition>
        </div>
    </div>
</template>

<style>

    .fade-enter-active, .fade-leave-active {
      transition: opacity .5s
    }
    .fade-enter, .fade-leave-active {
      opacity: 0
    }

    .container-fluid {
        margin: 0;
        padding: 0;
    }
    .col-3 {
    margin: 0;
    padding-left: 0;
    }

</style>

<script>
export default{
}
</script>
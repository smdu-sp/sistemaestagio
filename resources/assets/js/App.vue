<template>
    <div class="container-fluid">
        <div>
            <transition name="fade">
                <home-component></home-component>
            </transition>
        </div>
    </div>
</template>

<style>

    html, body {
        height: 100%;
        width: 100%;
    }

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
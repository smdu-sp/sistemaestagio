<template>
<div>
    <hr>
    <div class="form-group">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-end">
                <slot></slot> <!-- Para poder implementar botões adicionais onde o componente for importado -->
                <button type="submit" class="btn btn-primary ml-2" :titulo="nomeBotao">
                    {{titulo}}
                </button>
            </div>
        </div>
    </div>
</div>
</template>
<script>
export default {
    props: ['titulo', 'nomeBotao']
}
</script>
<style>

</style>
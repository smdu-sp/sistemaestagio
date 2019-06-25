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
                <b-button id="show-btn" @click="$bvModal.show('bv-modal-example')" class="btn btn-danger ml-2">Sair</b-button>
                <!--Em toda pagina que o componente botoes-component for chamado, deve-se chamar também o modal-component -->
                <modal-component></modal-component>
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
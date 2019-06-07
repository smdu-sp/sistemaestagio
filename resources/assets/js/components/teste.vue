<template>
    <div class="container-fluid">
        <!--row-->
        <div class="row">
            <div class="col-3">
                <aside-component></aside-component>
            </div>
            <!--col-9-->
            <div class="col-9">
                <header-component></header-component>
                <h1 class="d-flex justify-content-center">Cadastro de Estagiário</h1>

                <!-- Formulários -->
                <b-card no-body>
                    <b-tabs card>
                        <b-tab title="Dados Pessoais" active>
                            <b-card-text id="dado">
                            </b-card-text>
                        </b-tab>
                        <b-tab title="Informações Contratuais">
                            <b-card-text>
                            </b-card-text>
                        </b-tab>
                        <b-tab title="Dados Bancários">
                            <b-card-text>
                            </b-card-text>
                        </b-tab>
                    </b-tabs>
                </b-card>
                <!-- /Formulários -->
            </div><!--/col-9-->
        </div><!-- /row -->
    </div><!--/container-->
</template>
<script>
export default {
}
</script>
<style>

</style>

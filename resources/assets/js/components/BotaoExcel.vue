<template>
  <img
    @click="exportarXLS(nome)"
    class="img-exportar-excel"
    src="../../../../public/icones/icons8-excel.png"
    alt="Exportar Relatório"
  />
</template>

<script>
export default {
  props: ["nome", "trocaNome"],
  methods: {
    exportarXLS(nomeTabela = "Tabela") {
      // e.preventDefault();
      var table_div = document.getElementById("divTabela");
      var blobData = new Blob(["\ufeff" + table_div.outerHTML], {
        type: "application/vnd.ms-excel"
      });
      var url = window.URL.createObjectURL(blobData);
      var a = document.createElement("a");
      a.href = url;
      let nomeArquivo =
        nomeTabela +
        "_" +
        new Date().getDate() +
        "-" +
        (new Date().getMonth() + 1) +
        "-" +
        new Date().getFullYear();
      a.download = nomeArquivo;
      a.click();
    }
  }
};
</script>

<style>
.img-exportar-excel {
  cursor: pointer;
  width: 45px;
}
</style>
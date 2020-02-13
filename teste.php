<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="tg-wrap" id="divTabela">
        <table>
            <tr>
                <th>Etnia</th>
                <th>Gênero</th>
                <th>Quantidade</th>
                <th>%</th>
            </tr>
            <tr>
                <td>Brancos</td>
                <td>Masculino</td>
                <td>27</td>
                <td>24.32</td>
            </tr>
            <tr>
                <td>Feminino</td>
                <td>59</td>
                <td>53.15</td>
                <td></td>
            </tr>
            <tr>
                <td>Pardos</td>
                <td>Masculino</td>
                <td>6</td>
                <td>5.41</td>
            </tr>
            <tr>
                <td>Feminino</td>
                <td>7</td>
                <td>6.31</td>
                <td></td>
            </tr>
            <tr>
                <td>Amarelos</td>
                <td>Masculino</td>
                <td>3</td>
                <td>2.70</td>
            </tr>
            <tr>
                <td>Feminino</td>
                <td>2</td>
                <td>1.80</td>
                <td></td>
            </tr>
            <tr>
                <td>Negros</td>
                <td>Masculino</td>
                <td>2</td>
                <td>1.80</td>
            </tr>
            <tr>
                <td>Feminino</td>
                <td>3</td>
                <td>2.70</td>
                <td></td>
            </tr>
            <tr>
                <td>Indígenas</td>
                <td>Masculino</td>
                <td>1</td>
                <td>0.90</td>
            </tr>
            <tr>
                <td>Feminino</td>
                <td>0</td>
                <td>0.00</td>
                <td></td>
            </tr>
            <tr>
                <td>Não Definidos</td>
                <td>Masculino</td>
                <td>0</td>
                <td>0.00</td>
            </tr>
            <tr>
                <td>Feminino</td>
                <td>1</td>
                <td>0.90</td>
                <td></td>
            </tr>
            <tr>
                <td>Total</td>
                <td colspan="2">111</td>
                <td>100.00</td>
                <td></td>
            </tr>
        </table>
    </div>
    <button id="btnExport" onclick="exportarXLS(event, 'Cotas')">Exportar para Excel</button>

    <script>
        const exportarXLS = function(e, nomeTabela) {
            e.preventDefault();
            var table_div = document.getElementById('divTabela');
            var blobData = new Blob(["\ufeff" + table_div.outerHTML], {
                type: "application/vnd.ms-excel"
            });
            var url = window.URL.createObjectURL(blobData);
            var a = document.createElement("a");
            a.href = url;
            let nomeArquivo = nomeTabela + "_" + new Date().getDate() + "-" + (new Date().getMonth() + 1) + "-" + new Date().getFullYear();
            a.download = nomeArquivo;
            a.click();
        }
    </script>

</body>

</html>
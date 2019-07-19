export default {
    filters: {
        dataFormatada(data) {
            const ano = data.substring(0,4);
            const mes = data.substring(5,7);
            const dia = data.substring(8,10);
    
            data = `${dia}/${mes}/${ano}`;
    
            return data;
        },
        cpfFormatado(cpf) {
            return `${cpf.substring(0,3)}.${cpf.substring(3,6)}.${cpf.substring(6,9)}-${cpf.substring(9,11)}`;
        }
    }
}
export default {
    methods: {
        converteData(data, estagiario, array) {
            const dataAtual = new Date();
            const anoAtual = dataAtual.getFullYear();
            const mesAtual = dataAtual.getMonth();
            const diaAtual = dataAtual.getDate();

            const dataEstagiario = data;
            const anoEstagiario = dataEstagiario.substring(0,4);
            const mesEstagiario = dataEstagiario.substring(5,7);
            const diaEstagiario = dataEstagiario.substring(8,11);

            dataAtual.setDate(dataAtual.getDate() - 90);
            if(anoAtual == anoEstagiario && mesEstagiario >= dataAtual.getMonth()) {
                array.push(estagiario);
            }
        }
    }
}
export class Requisicoes {

    constructor() {

    }

    requisicaoGet(uri, variavel) {
        this.axios.get(uri).then(response => {
            this[variavel] = response.data
        })
    }
}
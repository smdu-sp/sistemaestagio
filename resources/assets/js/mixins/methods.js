export default {
  methods: {
    validacao(valorCampo, variavelBooleana) {
      if (!valorCampo.target.value) {
        this[variavelBooleana] = true;
      } else {
        this[variavelBooleana] = false;
      }
    },
    scrollTop() {
      window.scrollTo(0, 0);
    }
  }
};

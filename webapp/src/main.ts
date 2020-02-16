import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import axios from 'axios'
import VueAxios from 'vue-axios'

import 'bootstrap/dist/css/bootstrap.css';

Vue.use(VueAxios, axios);
Vue.config.productionTip = false;

Vue.filter('moneyFilter', function (value: string) {
  if (!value || value == '0') return '';

  return `${value} MKD`;
});

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount("#app");

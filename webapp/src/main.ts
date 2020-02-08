import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";

import 'bootstrap/dist/css/bootstrap.css';


Vue.config.productionTip = false;

Vue.filter('moneyFilter', function (value: string) {
  if (!value) return '';

  return `${value} MKD`;
});

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount("#app");

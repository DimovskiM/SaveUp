import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../components/home.vue";
import Product from "../components/product.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/product/:id",
    name: 'product',
    component: Product,
    props: true
  },
  {
    path: "/",
    name: 'home',
    component: Home
  }
];

const router = new VueRouter({
  routes
});

export default router;

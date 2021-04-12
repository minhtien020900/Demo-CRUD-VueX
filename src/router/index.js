import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const routes = [
  {
    path: "/list-product",
    name: "Products",
    component: () => import("../components/products/ListProduct")
  },
  {
    path: "/list-category",
    name: "Categories",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () =>
      import(/* webpackChunkName: "about" */ "../components/categories/ListCategory"),
  },
];

const router = new VueRouter({
  routes,
});

export default router;

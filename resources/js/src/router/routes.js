import store from "@/store/index.js";
import _auth from "@/router/_auth.js";
import _cabinet from "@/router/_cabinet.js";
import BlankLayout from "@/views/layouts/BlankLayout.vue";
import MainLayout from "@/views/layouts/MainLayout.vue";
import Home from "@/views/pages/Home.vue";

const routes = [
  {
    path: '/',
    component: () => BlankLayout,
    children: [
      {
        path: '',
        name: 'main',
        component: () => Home,
      },
    ]
  },
  {
    path: '/auth',
    component: () => BlankLayout,
    beforeEnter(to, from, next) {
      if (store.getters["user_module/LOGGED"]) return next({path: '/'})
      next()
    },
    children: _auth,
  },
  {
    path: '/cabinet',
    component: () => MainLayout,
    meta: {requiredAuth: true},
    children: _cabinet
  },
];

export default routes;
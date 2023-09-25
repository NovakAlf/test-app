import { createRouter, createWebHistory } from 'vue-router';
import routes from './routes.js';
import store from "@/store/index.js";

const router = createRouter({
  base: window.location.pathName,
  history: createWebHistory(),
  linkActiveClass: 'active',
  routes,
});

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiredAuth)) {
    if (store.getters['user_module/LOGGED']) return next()
    next('/auth')
  } else {
    next()
  }
})

export default router;
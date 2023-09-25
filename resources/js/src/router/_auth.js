import Login from "@/views/pages/Login.vue";
import Register from "@/views/pages/Register.vue";

export default [
  {
    path: '',
    name: 'login',
    component: () => Login,
  },
  {
    path: 'register',
    name: 'register',
    component: () => Register,
  },
]
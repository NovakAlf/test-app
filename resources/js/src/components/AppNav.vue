<template>
  <nav class="navbar navbar-expand navbar-white navbar-light">
    <ul v-if="logged" class="navbar-nav ml-auto">
      <li class="nav-item d-none d-sm-inline-block">
        <router-link :to="{name: 'cabinet'}"
                     class="nav-link"
                     v-text="'Кабинет'"
        />
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <LogoutButton/>
      </li>
    </ul>
    <ul v-else class="navbar-nav ml-auto">
      <li class="nav-item d-none d-sm-inline-block">
        <router-link :to="{name: 'login'}"
                     class="nav-link"
                     v-text="'Вход'"
        />
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <router-link :to="{name: 'register'}"
                     class="nav-link"
                     v-text="'Регистрация'"
        />
      </li>
    </ul>
  </nav>
</template>

<script>
import {mapGetters} from "vuex";
import LogoutButton from "@/components/LogoutButton.vue";

export default {
  name: "AppNav",
  components: {LogoutButton},
  computed:{
    ...mapGetters({
      logged: 'user_module/LOGGED'
    })
  }
}
</script>

<style scoped>

</style>
<template>
  <nav class="main-header navbar navbar-expand navbar-white navbar-light mb-5">
    <ul class="navbar-nav">
      <li class="nav-item d-none d-sm-inline-block">
        <router-link to="/"
                     class="nav-link"
                     v-text="'Главная'"
        />
      </li>
    </ul>
    <LogoutButton/>
  </nav>
</template>

<script>
import LogoutButton from "@/components/LogoutButton.vue";
export default {
  name: "CabinetNav",
  components: {LogoutButton},
}
</script>

<style scoped>

</style>
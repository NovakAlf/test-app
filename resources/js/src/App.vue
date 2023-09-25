<template>
  <router-view/>
</template>

<script>

export default {
  name: "App",
  mounted() {
    this.$store.commit('user_module/setLogged', window.auth_user);
  }
}
</script>

<style>
.warning {
  color: #ef4444;
  font-weight: bolder;
  text-align: center;
}
.content-wrapper {
  background-color: white!important;
}
</style>
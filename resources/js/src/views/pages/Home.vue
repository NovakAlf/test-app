<template>
  <div>
    <AppNav/>
    <div class="login-page" style="margin-top: -56px">
      <h1>Test App</h1>
      <h4>тестовое задание</h4>
    </div>
  </div>
</template>

<script>
import AppNav from '@/components/AppNav.vue'

export default {
  name: "Home",
  components: {
    AppNav
  }
}
</script>

<style scoped>

</style>
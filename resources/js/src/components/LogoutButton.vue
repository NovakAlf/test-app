<template>
  <button @click="clickHandler"
          class="ml-auto btn btn-danger"
          v-text="'Выйти'"
  />
</template>

<script>
export default {
  name: "LogoutButton",
  methods:{
    clickHandler(){
      this.$store.dispatch('user_module/logout').then(()=>this.$router.push('/'))
    }
  }
}
</script>

<style scoped>

</style>
<template>
  <div class="hold-transition login-page">
    <div class="login-box">
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <router-link to="/"
                       class="h1"
                       v-text="'Test App'"
          />
        </div>
        <div class="card-body">
          <form @submit="submitHandler">
            <div class="input-group mb-3">
              <input v-model="user.first_name"
                     type="text"
                     class="form-control"
                     placeholder="Имя"
                     required
              >
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"/>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input v-model="user.last_name"
                     type="text"
                     class="form-control"
                     placeholder="Фамилия"
                     required
              >
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"/>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input v-model="user.birthday"
                     type="date"
                     class="form-control"
                     placeholder="Дата рождения"
              >
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-calendar"/>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input v-model="user.username"
                     type="text"
                     class="form-control"
                     placeholder="Логин"
                     required
              >
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-key"/>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input v-model="user.password"
                     type="password"
                     class="form-control"
                     placeholder="Пароль"
                     required
              >
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <input type="submit"
                   class="btn btn-primary btn-block"
                   :value="'Регистрация'"
            />
            <p class="mb-0">
              <router-link :to="{name: 'login'}"
                           class="text-center"
                           v-text="'Уже есть аккаунт'"
              />
            </p>
          </form>
        </div>
      </div>
    </div>
    <Modal v-if="!!error"
           @close="error = null"
    >
      {{ error }}
    </Modal>
  </div>
</template>

<script>
import Modal from "@/components/Modal.vue";

export default {
  name: "Register",
  components: {Modal},
  data() {
    return {
      user: {
        first_name: null,
        last_name: null,
        birthday: null,
        username: null,
        password: null,
      },
      error: null
    }
  },
  methods: {
    submitHandler(e) {
      e.preventDefault()
      this.$store.dispatch('user_module/register', this.user).then(
        () => this.$router.push({path: '/cabinet'}),
        error => this.errorHandler(error)
      )
    },
    errorHandler(error) {
      this.error = error
      setTimeout(() => this.error = null, 2500);
    }
  }
}
</script>

<style scoped>

</style>
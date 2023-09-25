<template>
  <div>
    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-8 mx-auto">
            <div class="card">
              <div class="card-header">
                <h3 v-text="'Профиль'"/>
              </div>
              <div class="card-body">
                <ul class="nav nav-pills nav-sidebar flex-column">
                  <li v-for="option in options"
                      v-text="option + ': ' + user[option]"
                      class="nav-item"
                  />
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
  name: "Profile",
  computed: {
    ...mapGetters({
      user: 'user_module/USER'
    }),
    options() {
      if (this.user) return Object.keys(this.user)
    },
  }
}
</script>

<style scoped>

</style>
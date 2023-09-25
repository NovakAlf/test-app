<template>
  <div>
    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-8 mx-auto">
            <div class="card">
              <div class="card-body">
                <h3 v-text="item.title"/>
                <p v-text="item.text"/>
                <p v-text="item.created_at"/>
                <h5 class="nav-header" v-text="'Участники'"/>
                <ul class="nav nav-pills flex-column">
                  <li v-for="(user, i) in users"
                      :key="i"
                      class="nav-item"
                      v-text="user.first_name + ' ' + user.last_name"
                      @click="modal_message = user"
                      style="cursor: pointer"
                  />
                </ul>
              </div>
              <div class="card-footer">
                <button @click="toggle"
                        :class="['btn', isParticipant ? 'btn-secondary' : 'btn-success']"
                        v-text="isParticipant ? 'Отклонить' : 'Участвовать'"
                />
                <button @click="remove"
                        class="btn btn-danger ml-3"
                        v-text="'Удалить'"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <Modal v-if="!!modal_message"
           @close="modal_message = null"
    >
      {{ modal_message }}
    </Modal>
  </div>
</template>

<script>
import Modal from "@/components/Modal.vue";
import {getUsers} from "@/services/index.js";
import {mapGetters} from "vuex";

export default {
  name: "EventPage",
  components: {Modal},
  data() {
    return {
      users: [],
      modal_message: null
    }
  },
  computed: {
    ...mapGetters({
      events: 'event_module/EVENTS',
      user: 'user_module/USER'
    }),
    isParticipant(){
      return (this.users.find(e => e.id === this.user.id))
    },
    item(){
      return this.events.find(e => e.id === Number(this.url_id))
    },
    url_id() {
      return this.$route.params.id
    }
  },
  methods: {
    getUsers() {
      this.users = []
      getUsers(this.url_id).then(
        response => {
          if (response.data.error) return this.errorHandler(response.data.error)
          return this.users = response.data.result
        },
        error => this.errorHandler(error.response.data.message)
      )
    },
    errorHandler(error) {
      this.modal_message = error
      setTimeout(() => this.error = null, 2500);
    },
    toggle(){
      this.$store.dispatch('event_module/checkEvent', this.item.id).then(
        () => this.getUsers(),
        error => this.errorHandler(error)
      )
    },
    remove(){
      this.$store.dispatch('event_module/deleteEvent', this.item.id).then(
        () => {
          clearInterval(this.timer)
          this.$router.push({name: 'cabinet'})
        },
        error => this.errorHandler(error)
      )
    }
  },
  watch: {
    url_id: {
      handler() {
        this.getUsers()
      }
    }
  },
  mounted: function () {
    this.getUsers()
    this.timer = setInterval(() => this.getUsers(), 30000)
  },
  beforeDestroy() {
    clearInterval(this.timer)
  },
  beforeRouteLeave(){
    clearInterval(this.timer)
  }
}
</script>

<style scoped>

</style>
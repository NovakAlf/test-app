<template>
  <div>
    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-8 mx-auto">
            <div class="card">
              <div class="card-header">
                <h3 v-text="'Добавить событие'"/>
              </div>
              <form @submit="submitHandler">
                <div class="card-body">
                  <div class="input-group mb-3">
                    <input v-model="event.title"
                           type="text"
                           class="form-control"
                           placeholder="Наименование"
                           required
                    >
                  </div>
                  <div class="input-group mb-3">
                    <textarea v-model="event.text"
                              rows="10"
                              class="form-control"
                              placeholder="Текст"
                              required
                    ></textarea>
                  </div>
                  <input type="submit"
                         class="btn btn-primary btn-block"
                         :value="'Создать'"
                  />
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
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
  name: "AddEvent",
  components: {Modal},
  data() {
    return {
      event: {
        title: null,
        text: null,
      },
      error: null
    }
  },
  methods: {
    submitHandler(e) {
      e.preventDefault()
      this.$store.dispatch('event_module/addEvent', this.event).then(
        response => this.$router.push({name: 'event', params: {id: response}}),
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
<template>
  <div class="modal"
       id="myModal"
       style="display: block;"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body warning">
          <slot/>
        </div>
        <div class="modal-footer">
          <button type="button"
                  @click="$emit('close')"
                  class="btn btn-danger btn-small"
                  data-dismiss="modal"
                  v-text="'Закрыть'"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
name: "Modal"
}
</script>

<style scoped>

</style>
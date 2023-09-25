<template>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info" >
          <router-link :to="{name: 'cabinet'}"
                       class="d-block"
                       v-text="userName"
          />
        </div>
      </div>
      <router-link :to="{name: 'add-event'}"
                   class="btn btn-block btn-success"
                   v-text="'Добавить событие'"
      />
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-header" v-text="'ВСЕ СОБЫТИЯ'"/>
          <li class="nav-item" v-for="event in events">
            <router-link :to="{name: 'event', params:{id: event.id}}"
                         class="nav-link"
                         v-text="event.title"
                         exact
            />
          </li>
        </ul>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-header" v-text="'МОИ СОБЫТИЯ'"/>
          <li class="nav-item" v-for="event in myEvents">
            <router-link :to="{name: 'event', params:{id: event.id}}"
                         class="nav-link"
                         v-text="event.title"
            />
          </li>
        </ul>
      </nav>
    </div>
  </aside>
</template>

<script>
import {mapGetters} from "vuex";

export default {
  name: "CabinetSidebar",
  computed: {
    ...mapGetters({
      user: 'user_module/USER',
      events: 'event_module/EVENTS'
    }),
    userName() {
      if (this.user) return this.user.first_name + ' ' + this.user.last_name
    },
    myEvents(){
      return this.events.filter(e => e.author === this.user.id)
    }
  },
}
</script>

<style scoped>

</style>
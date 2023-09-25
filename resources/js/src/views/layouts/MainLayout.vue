<template>
  <div>
    <CabinetNav/>
    <CabinetSidebar/>
    <div class="content-wrapper">
      <router-view/>
    </div>
  </div>
</template>

<script>
import CabinetNav from '@/components/CabinetNav.vue'
import CabinetSidebar from '@/components/CabinetSidebar.vue'
export default {
  name: "MainLayout",
  components:{
    CabinetNav,
    CabinetSidebar
  },
  methods:{
    getEvents(){
      this.$store.dispatch('event_module/getEvents')
    }
  },
  mounted: function () {
    this.getEvents()
    this.timer = setInterval(() => this.getEvents(), 30000)
  },
  beforeDestroy() {
    clearInterval(this.timer)
  },
  created() {
    this.$store.dispatch('user_module/getUserData')
  }
}
</script>

<style scoped>

</style>
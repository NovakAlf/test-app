import {addEvent, checkEvent, deleteEvent, getEvents} from "@/services/index.js";

export default {
  namespaced: true,

  state() {
    return {
      events:[]
    }
  },
  actions: {
    getEvents({commit}){
      return getEvents().then(
        response => {
          if (response.data.error) return Promise.reject(response.data.message)
          commit('setEvents', response.data.result);
          return Promise.resolve(response);
        },
        error => Promise.reject(error.response.data.message)
      )
    },
    addEvent({commit}, event){
      return addEvent(event).then(
        response => {
          if (response.data.error) return Promise.reject(response.data.message)
            commit('addEvent', response.data.result);
            return Promise.resolve(response.data.result.id);
        },
        error => Promise.reject(error.response.data.message)
      )
    },
    deleteEvent({commit}, id){
      return deleteEvent(id).then(
        response => {
          if (response.data.error) return Promise.reject(response.data.message)
          commit('delEvent', response.data.result.id);
          return Promise.resolve(response);
        },
        error => Promise.reject(error.response.data.message)
      )
    },
    checkEvent({commit}, id){
      return checkEvent(id)
    }
  },
  mutations: {
    setEvents(state, data){
      state.events = data
    },
    addEvent(state, data){
      state.events.unshift(data)
    },
    delEvent(state, id){
      let index = state.events.findIndex(e => e.id === id);
      state.events.splice(index, 1)
    }
  },
  getters:{
    EVENTS(state){
      return state.events
    }
  }
}
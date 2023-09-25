import {getUser, loginUser, logoutUser, registerUser} from "@/services/index.js";

export default {
  namespaced: true,

  state() {
    return {
      logged:false,
      user: null
    }
  },
  actions: {
    register({commit}, user) {
      return registerUser(user).then(
        response => Promise.resolve(response.data.message),
        error => Promise.reject(error.response.data.message)
      )
    },
    login({commit}, user) {
      return loginUser(user).then(
        response => {
          if (response.data.success) {
            commit('setLogged', true);
            return Promise.resolve(response.data.message);
          } else return Promise.reject(response.data.message)
        },
        error => Promise.reject(error.response.data.message)
      )
    },
    logout({commit}) {
      return logoutUser().then(
        response => {
          commit('removeUser');
          return Promise.resolve(response.data.message);
        },
        error => Promise.reject(error.response.data.message)
      )
    },
    getUserData({commit}){
      return getUser().then(
        response => {
          commit('setUser', response.data.user);
          return Promise.resolve(response);
        },
        error => Promise.reject(error.response.data.message)
      )
    }
  },
  mutations: {
    setUser(state, data) {
      state.user = data
    },
    removeUser(state) {
      state.user = null
      state.logged = false
    },
    setLogged(state, value){
      state.logged = value
    }
  },
  getters: {
    USER(state) {
      return state.user
    },
    LOGGED(state){
      return state.logged
    }
  }
}
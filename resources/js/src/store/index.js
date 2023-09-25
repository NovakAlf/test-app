import { createStore } from 'vuex';
import user_module from "@/store/user_module.js";
import event_module from "@/store/event_module.js";

const store = createStore({
  modules: {
    user_module,
    event_module
  }
});

export default store;
import { createStore } from 'vuex';
import routes from './Routes/index';
import complaints from './Complaints/index';
import sugestions from './Sugestions/index';

export default createStore({
  state: {
    login: false,
    url: "",
    apiKey: "f3ba042a-23cc-4c4b-9bd3-c7785576f04e",
  },
  mutations: {
    setUrl(state, value){
      state.url = value;
    }
  },
  actions: {
    setUrl({ commit }, value){
      commit('setUrl', value);
    }
  },
  modules: {
    routes,
    complaints,
    sugestions,
  }
})

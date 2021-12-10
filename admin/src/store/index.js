import { createStore } from 'vuex';

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
    
  }
})

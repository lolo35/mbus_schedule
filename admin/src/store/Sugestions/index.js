export default {
    namespaced: true,
    state: {
        sugestions: []
    },
    mutations: {
        setSugestions(state, value){
            state.sugestions = value;
        }
    },
    actions: {
        setSugestions({ commit }, value){
            commit('setSugestions', value);
        }
    }
}
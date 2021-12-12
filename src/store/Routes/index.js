export default {
    namespaced: true,
    state: {
        routes: [],
    },
    mutations: {
        setRoutes(state, value){
            state.routes = value;
        }
    },
    actions: {
        setRoutes({ commit }, value){
            commit('setRoutes', value);
        }
    }
}
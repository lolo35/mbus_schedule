export default {
    namespaced: true,
    state: {
        complaints: [],
    },
    mutations: {
        setComplaints(state, value){
            state.complaints = value;
        }
    },
    actions: {
        setComplaints({ commit }, value){
            commit('setComplaints', value);
        }
    }
}
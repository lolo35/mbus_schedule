export default {
    namespaced: true,
    state: {
        modalIsOpen: false,
        routes: [],
        showRoutes: false,
        searchTerm: "",
        page: 0,
        routesDisplayed: 5,
    },
    mutations: {
        setModalIsOpen(state, value){
            state.modalIsOpen = value;
        },
        setRoutes(state, value){
            state.routes = value;
        },
        addToRoutes(state, value){
            state.routes.push(value);
        },
        setShowRoutes(state, value){
            state.showRoutes = value;
        },
        setSearchTerm(state, value){
            state.searchTerm = value;
        },
        incPageNumber(state){
            let totalPages = Math.ceil(state.routes.length / state.routesDisplayed);
            if(state.page + 1 < totalPages){
                state.page++;
            }
        },
        decPageNumber(state){
            if(state.page + 1 > 1){
                state.page--;
            }
        },
        removeRoute(state, value){
            state.routes.splice(value, 1);
        }
    },
    actions: {
        setSearchTerm({commit}, value){
            commit('setSearchTerm', value);
        },
        setModalIsOpen({ commit }, value){
            commit('setModalIsOpen', value);
        },
        setRoutes({ commit }, value){
            commit('setRoutes', value);
        },
        addToRoutes({ commit }, value){
            commit("addToRoutes", value);
        },
        setShowRoutes({ commit }, value){
            commit("setShowRoutes", value);
        },
        incPageNumber({ commit }){
            commit('incPageNumber');
        },
        decPageNumber({ commit }){
            commit('decPageNumber');
        },
        removeRoute({ commit }, value){
            commit('removeRoute', value);
        }
    },
    getters: {
        routeData(state, getters){
            if(state.searchTerm.length > 0){
                return state.routes.filter(element => {
                    const route = element.route.toString().toLowerCase();
                    const search = state.searchTerm.toString().toLowerCase();
                    return route.includes(search);
                })
            }else{
                //console.log(getters);
                return state.routes.slice(getters.sliceIndex, (getters.sliceIndex + state.routesDisplayed) + 1);
                //return state.routes;
            }
        },
        sliceIndex(state){
            return state.page * state.routesDisplayed;
        },
        currentPage(state){
            return state.page + 1;
        },
        totalPages(state){
            return Math.ceil(state.routes.length / state.routesDisplayed);
        }
    }
}
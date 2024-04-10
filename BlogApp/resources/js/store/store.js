import { createStore } from "vuex"

const store = createStore({
    state (){
        return {
            activeUserID: 0,
        };
    },
    mutations:{
        setActiveUserID(state,value){
            state.activeUserID = value;
        },
    },
    actions:{
        setActiveUserID({commit},value){
            this.commit("setActiveUserID",value)
        },
    },
    getters:{
        getActiveUserID: state => state.activeUserID,
    },
});


export default store;

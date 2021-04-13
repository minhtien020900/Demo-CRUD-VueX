import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
import VueAxios from "vue-axios";
Vue.use(VueAxios, axios);
Vue.use(Vuex);

export const store = new Vuex.Store({
  state: {
    catList: [],
    urlApi: "http://127.0.0.1:8000/api/categories/",
  },
  getters: {
    getCatList: (state) => {
      return state.catList;
    },
    getUrlApi: (state) => {
      return state.urlApi;
    },
  },
  mutations: {
    setCatList(state, payload) {
      state.catList = payload;
    },
    // addCat(state, payload) {
    //   axios.post(state.urlApi, payload);
    // },
  },
  actions: {
    fetchCatList({ commit, state }) {
      axios
        .get(state.urlApi)
        .then((data) => {
          commit("setCatList", data.data.data);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    // addCat({ commit }, payload) {
    //   commit("addCat", payload).then(() => {
    //     commit("setCatList");
    //   });
    // },
    addCat({ state, dispatch }, payload) {
      axios
        .post(state.urlApi, payload)
        .then(() => {
          dispatch("fetchCatList");
        })
        .catch((err) => {
          console.log(err);
        });
    },
    editCat({ state, dispatch }, payload) {
      axios
        .post(state.urlApi + payload.id, payload.data)
        .then(() => {
          dispatch("fetchCatList");
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  modules: {},
});

import Vue from "vue";
import Vuex from "vuex";
import VuexPersist from "vuex-persist";

import questions from "./modules/questions";
import exams from "./modules/exams";
Vue.use(Vuex);
const debug = process.env.NODE_ENV !== "production";

const VuexPersists = new VuexPersist({
    key: "alferp",
    reducer: state => ({ user: state.user }),
    storage: window.localStorage
});

export const strict = false;

export default new Vuex.Store({
    modules: {
        questions,
        exams,
    },
    plugins: [VuexPersists.plugin],
    strict: debug
});

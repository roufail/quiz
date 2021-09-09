import state from './state';
import getters from './getters.js';
import actions from './actions.js';
import mutations from './mutations';

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};

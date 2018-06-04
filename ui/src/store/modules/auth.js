const state = {
    token: localStorage.getItem('access-token') || '',
    refreshToken: localStorage.getItem('refresh-token') || '',
    status: ''
};

const getters = {
    isAuthenticated: state => !!state.token,
    authStatus: state => state.status
};

const actions = {
    login: ({commit, dispatch}, payload) => {
        return new Promise((resolve, reject) => {
            commit('authRequest');
            payload.vue.axios({url: 'oauth/token', data: payload.user, method: 'POST'})
                .then(response => {
                    localStorage.setItem('access-token', response.data.access_token);
                    localStorage.setItem('refresh-token', response.data.refresh_token);
                    commit('authSuccess', response.data.access_token, response.data.refresh_token);
                    resolve(response);
                })
                .catch(err => {
                    commit('authError');
                });
        });
    },
    logout: ({commit, dispatch}) => {
        return new Promise((resolve, reject) => {
            localStorage.removeItem('access-token');
            localStorage.removeItem('refresh-token');
            resolve();
        });
    }
};

const mutations = {
    authLogout: (state) => {
        state.status = '';
    },
    authRequest: (state) => {
        state.status = 'loading';
    },
    authSuccess: (state, token, refreshToken) => {
        state.status = 'success';
        state.token = token;
        state.refreshToken = refreshToken;
    },
    authError: (state) => {
        state.status = 'error';
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
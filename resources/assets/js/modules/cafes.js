import CafeApi from '../api/cafe';
export const cafes = {
    state: {
        cafes: [],
        cafesLoadStatus: 0,
        cafe: {},
        cafeLoadStatus: 0,
        cafeAddStatus: 0,
    },
    actions: {
        loadCafes({
            commit
        }) {
            commit('setCafesLoadStatus', 1);
            CafeApi.getCafes()
                .then((response) => {
                    commit('setCafes', response.data);
                    commit('setCafesLoadStatus', 2);
                }).catch(() => {
                    commit('setCafes', []);
                    commit('setCafesLoadStatus', 3);
                });
        },
        loadCafe({
            commit
        }, data) {
            commit('setCafesLoadStatus', 1);
            CafeApi.getCafe(data.id)
                .then((response) => {
                    commit('setCafe', response.data);
                    commit('setCafesLoadStatus', 2);
                }).catch(() => {
                    commit('setCafe', {});
                    commit('setCafesLoadStatus', 3);
                });
        },
        addCafe({
            commit,
            state,
            dispatch
        }, data) {
            //状态1表示开始添加
            commit('setCafeAddStatus', 1);
            CafeApi.postAddNewCafe(data.name, data.address, data.city, data.state, data.zip)
                .then((response) => {
                    //状态2表示添加成功
                    commit('setCafeAddStatus', 2);
                    dispatch('loadCafes');
                })
                .catch(() => {
                    //状态3表示添加失败
                    commit('setCafeAddStatus', 3);
                });
        }
    },
    mutations: {
        setCafesLoadStatus(state, status) {
            state.cafesLoadStatus = status;
        },
        setCafes(state, cafes) {
            state.cafes = cafes;
        },
        setCafeLoadStatus(state, status) {
            state.cafeLoadStatus = status;
        },
        setCafe(state, cafe) {
            state.cafe = cafe;
        },
        setCafeAddStatus(state, status) {
            state.cafeAddStatus = status;
        },
    },
    getters: {
        getCafesLoadStatus(state) {
            return state.cafesLoadStatus;
        },
        getCafes(state) {
            return state.cafes;
        },

        getCafeLoadStatus(state) {
            return state.cafeLoadStatus;
        },

        getCafe(state) {
            return state.cafe;
        },
        getCafeAddStatus(state) {
            return state.cafeAddStatus;
        }
    }
}

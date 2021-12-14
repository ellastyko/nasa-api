import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        events: [],
        events_count: 0,
        categories: []
    },
    getters: {
        getEvents(state) {
            return state.events
        },
        getCategories(state) {
            return state.categories
        },
        getEventsCount(state) {
            return state.events_count
        }
    },
    mutations: {
        SET_EVENTS ( state, payload ) {
            state.events = payload
        },

        SET_EVENTS_COUNT ( state, payload ) {
            state.events_count = payload
        },

        SET_CATEGORIES ( state, payload ) {
            state.categories = payload
        },
    },
    actions: {
        async loadEvents({ commit }, payload) {

            let categories = ''

            if (payload.categories) {

                for (let c of payload.categories)
                    categories += `&category=${c.id}`
            }

            const result = await fetch(`/api/events?limit=${payload.limit}&page=${payload.current}` + categories)
            const response = await result.json()

            commit('SET_EVENTS', response.events.data)
            commit('SET_EVENTS_COUNT', response.count)
        },

        async loadCategories({ commit }) {

            const result = await fetch('api/categories')
            const categories = await result.json()

            commit('SET_CATEGORIES', categories)
        }
    }
})

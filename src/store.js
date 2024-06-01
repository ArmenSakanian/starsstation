// store.js
import { createStore } from 'vuex'

export default createStore({
  state: {
    currentLanguage: localStorage.getItem('language') || 'en'  // Язык по умолчанию
  },
  mutations: {
    setLanguage(state, language) {
      state.currentLanguage = language;
      localStorage.setItem('language', language); // Сохраняем выбранный язык в localStorage
    }
  },
  actions: {
    updateLanguage({ commit }, language) {
      commit('setLanguage', language);
    }
  },
  getters: {
    currentLanguage: state => state.currentLanguage
  }
})

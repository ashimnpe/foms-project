import axios from 'axios'
import { baseUrl, currentUser, isAuthGuardActive } from '../../constants/config'
import {setCurrentUser, getCurrentUser} from '../../utils'

export default {
  state: {
    currentUser: isAuthGuardActive ? getCurrentUser() : currentUser,
    loginError: null,
    processing: false,
    forgotMailSuccess: null,
    resetPasswordSuccess: null,
    token: null,
    isAuthGuardActive: false,
  },
  getters: {
    currentUser: state => state.currentUser,
    processing: state => state.processing,
    loginError: state => state.loginError,
    forgotMailSuccess: state => state.forgotMailSuccess,
    resetPasswordSuccess: state => state.resetPasswordSuccess,
    isAuthGuardActive: state => state.isAuthGuardActive,
  },
  mutations: {
    SET_TOKEN: (state, token) => {
      state.token = token
    },
    SET_USER(state, payload) {
      state.currentUser = payload
      state.processing = false
      state.loginError = null
    },
    SET_AUTHGUARD(state, payload) {
      state.isAuthGuardActive = payload
    },
    setLogout(state) {
      state.currentUser = null
      state.processing = false
      state.loginError = null
    },
    setProcessing(state, payload) {
      state.processing = payload
      state.loginError = null
    },
    setError(state, payload) {
      state.loginError = payload
      state.currentUser = null
      state.processing = false
    },
    setForgotMailSuccess(state) {
      state.loginError = null
      state.currentUser = null
      state.processing = false
      state.forgotMailSuccess = true
    },
    setResetPasswordSuccess(state) {
      state.loginError = null
      state.currentUser = null
      state.processing = false
      state.resetPasswordSuccess = true
    },
    clearError(state) {
      state.loginError = null
    }
  },
  actions: {
    login({ commit }, payload) {
      commit('clearError')
      commit('setProcessing', true)
      return new Promise((resolve, reject) => {
        axios.post(baseUrl + 'login', {
          email: payload.email,
          password: payload.password,
        }).then(response => {
          const result = response.data.result
          
          const token = window.btoa(result.token)
          localStorage.setItem('ACCESS_TOKEN', token)
          
          setCurrentUser(result.user)
          commit('SET_USER', result.user)
          commit('SET_TOKEN', result.token)
          commit('SET_AUTHGUARD', true)
          resolve()
        }).catch(error => {
          commit('setError', error.response)
          reject(error)
        })
      })
    },
    forgotPassword({ commit }, payload) {
      commit('clearError')
      commit('setProcessing', true)
      firebase
        .auth()
        .sendPasswordResetEmail(payload.email)
        .then(
          user => {
            commit('clearError')
            commit('setForgotMailSuccess')
          },
          err => {
            commit('setError', err.message)
            setTimeout(() => {
              commit('clearError')
            }, 3000)
          }
        )
    },
    resetPassword({ commit }, payload) {
      commit('clearError')
      commit('setProcessing', true)
      firebase
        .auth()
        .confirmPasswordReset(payload.resetPasswordCode, payload.newPassword)
        .then(
          user => {
            commit('clearError')
            commit('setResetPasswordSuccess')
          },
          err => {
            commit('setError', err.message)
            setTimeout(() => {
              commit('clearError')
            }, 3000)
          }
        )
    },


    signOut({ commit }) {
      commit('setLogout')
      setCurrentUser(null)
      localStorage.removeItem('ACCESS_TOKEN')
    }
  }
}

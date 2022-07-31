import axios from 'axios'
import { baseUrl } from '../constants/config'
import store from '@/store'

// Create axios instance
const request = axios.create({
  baseURL: baseUrl,
  timeout: 10000 // Request timeout
})
const token = window.atob(localStorage.getItem('ACCESS_TOKEN'))
// Exception interception handler
const errorHandler = (error) => {
  if (error.response) {
    const data = error.response.data
    // Get token from localstorage
    if (error.response.status === 403) {
      alert(data.message)
      // this.$notify("error", "Forbidden", data.message, {
      //   duration: 3000,
      //   permanent: false,
      // });
    }
    if (error.response.status === 401) {
      alert('Unauthorized')
      // this.$notify("error", "Unauthorized", 'Authorization verification failed', {
      //   duration: 3000,
      //   permanent: false,
      // });
      if (token) {
        store.dispatch('signOut').then(() => {
          setTimeout(() => {
            window.location.reload()
          }, 1500)
        })
      }
    }
  }
  return Promise.reject(error)
}

// request interceptor
request.interceptors.request.use(config => {
  // If token exists
  // Let each request carry a custom token, please modify it according to the actual situation
  if (token) {
    // This Did not worked
    // config.headers['Access-Token'] = token
    // This will work
    config.headers.Authorization = `Bearer ${token}`
  }
  return config
}, errorHandler)

// response interceptor
request.interceptors.response.use((response) => {
  return response.data
}, errorHandler)

export default request

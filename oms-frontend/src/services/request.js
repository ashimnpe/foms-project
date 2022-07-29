import axios from 'axios'
// import store from '@/store'
// import storage from 'store'

// Create axios instance
const request = axios.create({
  // API Default prefix requested
  baseURL: process.env.VUE_APP_API_BASE_URL,
  // baseURL: 'http://freedom.test/api',
  // baseURL: 'http://mlogics.com.np/api',
  timeout: 10000 // Request timeout
})
// Exception interception handler
const errorHandler = (error) => {
  if (error.response) {
    const data = error.response.data
    // Get token from localstorage
    const token = localStorage.getItem('ACCESS_TOKEN')
    if (error.response.status === 403) {
      notification.error({
        message: 'Forbidden',
        description: data.message
      })
    }
    if (error.response.status === 401) {
      notification.error({
        message: 'Unauthorized',
        description: 'Authorization verification failed'
      })
      if (token) {
        store.dispatch('Logout').then(() => {
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
  const token = storage.get(ACCESS_TOKEN)
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

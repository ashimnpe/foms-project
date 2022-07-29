import store from '../store/index'
import { setCurrentUser } from '.'
import { isAuthGuardActive } from '../constants/config'

export default (to, from, next) => {
  if (to.matched.some(record => record.meta.loginRequired)) {
    if (isAuthGuardActive) {
      const user = store.getters.currentUser
      const role = localStorage.getItem('USER_ROLE')
      if (user && role) {
        const roleArrayHierarchic = to.matched.filter(x => x.meta.roles).map(x => x.meta.roles);
        if (roleArrayHierarchic.every(x => x.includes(role))) {
          next();
        } else {
          next('/unauthorized')
        }
      } else {
        setCurrentUser(null);
        localStorage.setItem('USER_ROLE')
        localStorage.setItem('ACCESS_TOKEN')
        next('/user/login')
      }
    } else {
      next();
    }
  } else {
    next()
  }
}

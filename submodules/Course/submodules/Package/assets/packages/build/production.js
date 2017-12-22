import Component from '../src/Component.vue'
import VueResource from 'vue-resource'

Vue.use(VueResource)

Component.install = function install (Vue) {
  Vue.component(Component.name, Component)
}

export default Component

if (typeof window !== 'undefined' && window.Vue) {
  Vue.use(Component)
}

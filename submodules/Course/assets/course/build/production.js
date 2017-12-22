import Component from '../src/Component.vue'

Component.install = function install (Vue) {
  Vue.component(Component.name, Component)
}

export default Component

if (typeof window !== 'undefined' && window.Vue) {
  Vue.use(Component)
}

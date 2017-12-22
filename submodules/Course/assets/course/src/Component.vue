<template>
  <v-container fluid class="pa-0">
    <cover :resource="dResource" :height="height">
      <template slot="cover.toolbar">
        <slot name="cover.toolbar"></slot>
      </template>
      <template slot="cover.card" scope="{prop}">
        <slot name="cover.card" :prop="prop"></slot>
      </template>
    </cover>

    <v-container fluid grid-list-lg>
      asd
    </v-container>
  </v-container>
</template>

<script>
  import Cover from './Components/Cover.vue'

  export default {
    name: 'yggdrasil-course',
    components: {
      Cover,
    },
    props: {
      options: {
        type: Object
      },
      resource: {
        type: [Object, Array]
      },
      height: {
        type: String,
        default: '240'
      }
    },
    data () {
      return {
        dResource: {}
      }
    },
    methods: {
      mResource () {
        let self = this

        return {
          mounted () {
            self.dResource = self.resource
          }
        }
      }
    },
    mounted () {
      this.mResource().mounted()
    },
    watch: {
      'resource': (value) => {
        this.dResource = value
      }
    }
  }
</script>

<style lang="scss" scoped>
  //
</style>

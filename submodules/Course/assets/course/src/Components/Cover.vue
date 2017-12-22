<template>
  <v-parallax class="elevation-1 mb-3" :src="resource.backdrop" :height="height">
    <v-layout row wrap align-end justify-center>
      <v-flex md8 xs12 pa-0>
        <v-card tile flat class="mt-5">

          <slot name="cover.toolbar"></slot>
          <slot name="cover.card" :prop="resource"></slot>

        </v-card>
      </v-flex>
    </v-layout>
  </v-parallax>
</template>

<script>
  export default {
    name: 'cover',
    props: {
      resource: {
        type: Object
      },
      height: {
        type: String,
        default: '350'
      }
    },
    data () {
      return {
        dResource: {}
      }
    },
    watch: {
      'resource': (value) => {
        this.dResource = value
      }
    }
  }
</script>

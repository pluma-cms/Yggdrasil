<template>
  <div>
    <v-toolbar dark class="brown elevation-1">
      <v-toolbar-title v-html="title"></v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn icon ripple @click="bulk.upload.model = !bulk.upload.model" v-model="bulk.upload.model"><v-icon>cloud_upload</v-icon></v-btn>
      <v-btn icon v-tooltip:left="{html: bulk.toggleview.model ? 'View as Grid' : 'View as Table'}" @click="bulk.toggleview.model = !bulk.toggleview.model">
        <v-icon small v-if="bulk.toggleview.model">view_module</v-icon>
        <v-icon small v-else>list</v-icon>
      </v-btn>
      <v-menu>
        <v-btn class=""></v-btn>
      </v-menu>
    </v-toolbar>
    <v-container fluid grid-list-lg>
      <v-slide-y-transition>
        <v-layout row wrap v-show="bulk.upload.model">
          <v-flex md12>
            <v-card flat class="transparent">
              <v-dropzone
                :options="dropzoneOptions"
                :params="dropzone.params"
                auto-remove-files
                @complete="mDropzone().complete($event)"
                @sending="mDropzone().sending($event)"
              ></v-dropzone>
            </v-card>
          </v-flex>
        </v-layout>
      </v-slide-y-transition>
      <v-layout row wrap>
        <v-flex md12>
          <v-dataset
            :headers="headers"
            :items="dataset.items"
            :pagination.sync="dataset.pagination"
            :total-items="dataset.pagination.total"
            :table="bulk.toggleview.model"
            :card="!bulk.toggleview.model"
            item-key="id"
            v-model="dataset.selected"
            sm6
            @pagination="mDataset().pagination($event)"
          >
            <template slot="items" scope="{prop}">
              <tr role="button" :active="prop.selected" @click="prop.selected = !prop.selected">
                <td v-if="bulk.selection.model">
                  <v-checkbox
                    color="primary"
                    primary
                    hide-details
                    :input-value="prop.selected"
                  ></v-checkbox>
                </td>
                <td v-html="prop.item.id"></td>
                <td>
                  <v-avatar size="35px">
                    <img :src="prop.item.thumbnail">
                  </v-avatar>
                  <span v-html="prop.item.name"></span>
                </td>
                <td>
                  <v-icon class="brown--text" v-html="prop.item.icon"></v-icon>
                </td>
                <td v-html="prop.item.filesize"></td>
                <td v-html="prop.item.created"></td>
                <td v-html="prop.item.modified"></td>
              </tr>
            </template>
            <template slot="card" scope="{prop}">
              <v-card flat class="white">
                <v-card-media class="white" height="250px" :src="prop.item.thumbnail"></v-card-media>
                <v-card-title primary-title class="subheading white brown--text" v-html="prop.item.originalname"></v-card-title>
                <v-card-text class="px-2 white brown--text">
                  <p><v-icon left class="brown--text" v-html="prop.item.icon"></v-icon><span v-html="prop.item.mimetype"></span></p>
                  <p><span v-html="prop.item.mime"></span></p>
                  <p><span v-html="prop.item.filesize"></span></p>
                </v-card-text>
                <slot name="card.actions" :prop="prop.item"></slot>
              </v-card>
            </template>
          </v-dataset>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
  import VuetifyDataset from 'vuetify-dataset'
  import 'vuetify-dropzone/dist/vuetify-dropzone.min.js'

  export default {
    name: 'pluma-packages',
    components: {
      'v-dataset': VuetifyDataset,
    },
    model: {
      prop: 'selected'
    },
    props: {
      title: {
        type: String
      },
      url: {
        type: [Object, Array]
      },
      headers: {
        type: [Object, Array]
      },
      items: {
        type: [Object, Array]
      },
      selected: {
        type: [Object, Array]
      },
      dropzoneOptions: {
        type: Object
      },
      dropzoneParams: {
        type: Object
      },
      token: {
        type: String
      },
      catalogue: {
        type: String
      }
    },
    data () {
      return {
        bulk: {
          toggleview: {
            model: false
          },
          selection: {
            model: false
          },
          upload: {
            model: false
          }
        },
        dataset: {
          headers: [],
          items: [],
          selected: [],
          pagination: {
            page: 1,
            total: 0,
            rowsPerPage: 10
          }
        },
        dropzone: {
          options: {
            autoProcessQueue: true,
            parallelUploads: 1,
            timeout: '120s',
          },
          params: {}
        }
      }
    },
    methods: {
      mDataset () {
        let self = this

        return {
          mounted () {
            self.dataset.items = self.items.data
            self.dataset.selected = self.selected
            self.dataset.pagination = Object.assign(self.dataset.pagination, {
              page: self.items.current_page,
              totalItems: self.items.total
            })
          },

          pagination (pagination) {
            const { sortBy, descending, page, rowsPerPage } = pagination
            // console.log(pagination)
            let query = {
              descending: descending ? descending : false,
              page: page,
              sort: sortBy ? sortBy : 'id',
              take: rowsPerPage > 0 ? rowsPerPage : null
            }

            self.api().get(self.url.GET, query).then(response => {
              self.dataset.items = response.items.data ? response.items.data : response.items
              self.dataset.pagination.totalItems = response.items.total ? response.items.total : response.total
              // console.log('pagination', self.dataset.items)
            })
          }
        }
      },

      mDropzone () {
        let self = this

        return {
          mounted () {
            // self.dropzone.options.url = self.url.UPLOAD
            self.dropzone.params = Object.assign(self.dropzone.params, self.dropzoneParams)
          },
          complete (file) {
            setTimeout(() => {
              self.mDataset().pagination(self.dataset.pagination)
            }, 1800)
          },
          sending ({file, xhr, formData}) {
            self.dropzone.params.originalname = file.upload.filename;
            self.dropzone.params.catalogue = self.catalogue
          }
        }
      },
    },
    mounted () {
      this.mDataset().mounted()
      this.mDropzone().mounted()
    },
    watch: {
      'dataset.pagination': {
        handler: function () {
          //
        },
        deep: true
      },

      'headers': function (value) {
        this.dataset.headers = value
      },
      'selected': function (value) {
        this.dataset.selected = value
      },

      'dropzoneParams': function (value) {
        this.dropzone.params = Object.assign(this.dropzone.params, value)
      },

      'dataset.selected': function (value) {
        this.$emit('input', value)
      }
    }
  }
</script>

<style lang="scss">
  @import "~vuetify-dropzone/dist/vuetify-dropzone.min.css";

  .application--light .pagination__item--active {
    background: #795548!important;
    border-color: #795548!important;
  }
</style>

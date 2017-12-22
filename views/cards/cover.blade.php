<v-card class="mb-3 elevation-1">
    <v-toolbar card dense class="transparent">
        <v-icon class="accent--text">landscape</v-icon>
        <v-toolbar-title class="subheading accent--text">{{ __('Cover Image') }}</v-toolbar-title>
    </v-toolbar>

    <v-mediabox
        :categories="resource.feature.catalogues"
        :dropzone-options="{url:'{{ route('api.library.upload') }}', autoProcessQueue: true}"
        :dropzone-params="{_token: '{{ csrf_token() }}'}"
        :multiple="false"
        :old="resource.item.cover ? [resource.item.cover] : []"
        auto-remove-files
        close-on-click
        dropzone
        toolbar-icon="landscape"
        toolbar-label="{{ __('Cover Image') }}"
        v-model="resource.cover.model"
        @selected="value => { resource.item.cover = value[0] }"
        @category-change="val => resource.feature.current = val"
        @sending="({file, params}) => { params.catalogue_id = resource.feature.current.id; params.originalname = file.upload.filename}"
    >
        <template slot="dropzone">
            <span class="caption">{{ __('Uploads will be catalogued as ') }}<em>@{{ resource.feature.current ? resource.feature.current.name : 'Uncategorized' }}</em></span>
            {{-- <v-card-text>
                <span v-if="resource.feature.current" v-html="`Currently uploading ${resource.feature.current}`"></span>
            </v-card-text> --}}
        </template>
        <template slot="media" scope="props">
            <v-card transition="scale-transition" class="accent" :class="props.item.active?'elevation-10':'elevation-1'">
                <v-card-media height="380px" :src="props.item.thumbnail">
                    <v-container fill-height class="pa-0 white--text">
                        <v-layout fill-height wrap column>
                            <v-spacer></v-spacer>
                            <v-slide-y-transition>
                                <v-icon ripple class="display-4 pa-1 text-xs-center white--text" v-show="props.item.active">check</v-icon>
                            </v-slide-y-transition>
                            <v-spacer></v-spacer>
                        </v-layout>
                    </v-container>
                </v-card-media>
                <v-card-title primary-title class="subheading white--text" v-html="props.item.originalname"></v-card-title>
                <v-card-actions class="px-2 white--text">
                    <v-icon class="white--text" v-html="props.item.icon"></v-icon>
                    <span v-html="props.item.mimetype"></span>
                    <v-spacer></v-spacer>
                    <span v-html="props.item.mime"></span>
                    <span v-html="props.item.filesize"></span>
                </v-card-actions>
            </v-card>
        </template>
    </v-mediabox>

    <v-card-text v-if="!Object.keys(resource.item.cover?resource.item.cover:{}).length" class="text-xs-center">
        <v-fade-transition>
            <div v-show="!resource.item.cover" class="my-2">
                <v-icon x-large class="grey--text text--lighten-2">perm_media</v-icon>
                <p class="ma-0 caption grey--text text--lighten-2">{{ __('No Image') }}</p>
            </div>
        </v-fade-transition>
    </v-card-text>

    <v-card-media
        v-else
        :src="resource.item.cover ? resource.item.cover.thumbnail : ''"
        height="280px"
        role="button"
        @click.stop="resource.cover.model = !resource.cover.model">
        <v-container fill-height fluid class="pa-0 white--text">
            <v-layout column>
                <v-card-title class="pa-0 subheading">
                    <v-spacer></v-spacer>
                    <v-btn dark icon @click.stop="resource.item.cover = null"><v-icon>close</v-icon></v-btn>
                    <input type="hidden" name="cover_obj" :value="JSON.stringify(resource.item.cover)">
                    <input type="hidden" name="backdrop" :value="resource.item.cover ? resource.item.cover.thumbnail : ''">
                </v-card-title>
            </v-layout>
        </v-container>
    </v-card-media>

    <v-card-actions>
        <v-btn v-if="resource.item.cover" flat ripple @click.stop="resource.item.cover = null">{{ __('Remove') }}</v-btn>
        <v-spacer></v-spacer>
        <v-btn flat ripple @click.stop="resource.cover.model = !resource.cover.model"><span v-html="resource.item.cover ? '{{ __('Change') }}' : '{{ __('Browse') }}'"></span></v-btn>
    </v-card-actions>
</v-card>

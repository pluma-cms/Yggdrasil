<v-card flat class="white">
    <v-toolbar card class="white sticky">
        <v-icon left class="yellow--text text--darken-2">fa-file</v-icon>
        <v-toolbar-title class="subheading yellow--text text--darken-2">{{ __('Content') }}</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn icon class="grey--text" v-tooltip:left="{'html': '{{ __('Add Content') }}'}" @click.native.stop="addSection(draggable.sections)"><v-icon>add</v-icon></v-btn>
        {{-- <v-btn icon class="grey--text" v-tooltip:left="{'html': '{{ __('Toggle Bulk Commands') }}'}"><v-icon>check_box_outline_blank</v-icon></v-btn> --}}
    </v-toolbar>
    <v-card-text>
        <template v-if="!draggable.sections.length">
            <v-card-text
                class="text-xs-center grey--text grey lighten-4 py-5"
                role="button"
                @click.stop="addSection(draggable.sections)">
                <v-icon x-large>note_add</v-icon>
                <p v-if="resource.errors[`lessons.${key}.contents`]" class="caption error--text" v-html="resource.errors[`lessons.${key}.contents`].join(', ')"></p>
                <p class="caption text-xs-center">{{ __('no contents yet') }}</p>
            </v-card-text>
        </template>
        <template v-else>
            <draggable v-show="draggable.sections && draggable.sections.length" class="sortable-container pa-1" v-model="draggable.sections" :options="{animation: 150, handle: '.sortable-handle', group: 'contents', draggable: '.draggable-child', forceFallback: true}">
                <transition-group>
                    <v-card
                        class="draggable-child mb-2 elevation-1"
                        tile
                        v-for="(content, c) in draggable.sections"
                        :key="c">
                        {{-- head --}}
                        <div class="amber lighten-4" style="height: 3px;"></div>
                        <v-toolbar card role="button" class="sortable-handle white" dense @click.native.stop="content.active = !content.active">
                            <v-icon>drag_handle</v-icon>
                            {{-- <v-checkbox hide-details color="yellow" v-model="content.model"></v-checkbox> --}}
                            <v-spacer></v-spacer>
                            <v-toolbar-title class="subheading">@{{ content.resource.title }}</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-icon>@{{ content.active ? 'keyboard_arrow_up' : 'keyboard_arrow_down' }}</v-icon>
                            <v-btn icon @click.native.stop="draggable.sections.splice(c, 1)"><v-icon>close</v-icon></v-btn>
                        </v-toolbar>

                        {{-- Content --}}
                        {{-- <v-slide-y-transition> --}}
                        <div v-show="content.active" transition="slide-y-transition">
                            <v-card-text>
                                <input v-if="content.resource.id" type="hidden" :name="`lessons[${key}][contents][${c}][id]`" :value="content.resource.id">
                                <input type="hidden" :name="`lessons[${key}][contents][${c}][sort]`" :value="c">
                                <v-text-field
                                    :name="`lessons[${key}][contents][${c}][title]`"
                                    label="{{ __('Content Title') }}"
                                    :error-messages="resource.errors[`lessons.${key}.contents.${c}.title`]"
                                    v-model="content.resource.title"
                                ></v-text-field>
                            </v-card-text>

                            {{-- Quill --}}
                            <v-quill :id="`lessons-${key}-contents-${c}-editor`" v-model="content.resource.quill" class="mb-3 white" :options="{placeholder: '{{ __('Describe this content...') }}'}">
                                <template>
                                    <input type="hidden" :name="`lessons[${key}][contents][${c}][body]`" :value="content.resource.quill.html">
                                    <input type="hidden" :name="`lessons[${key}][contents][${c}][delta]`" :value="JSON.stringify(content.resource.quill.delta)">
                                </template>
                            </v-quill>
                            {{-- /Quill --}}

                            {{-- Interactive Content --}}
                            <v-card-text class="grey lighten-4">
                                <p class="subheading grey--text" @click.stop="content.mediabox = !content.mediabox">{{ __('Interactive Content') }}</p>
                                <input type="hidden" :name="`lessons[${key}][contents][${c}][interactive]`" :value="JSON.stringify(content.resource.interactive)">
                                <input type="hidden" :name="`lessons[${key}][contents][${c}][library_id]`" :value="content.resource.interactive && content.resource.interactive.length ? content.resource.interactive[0].id : null">
                                <template v-if="!content.resource.interactive.length">
                                    <v-card-text
                                        class="grey lighten-3 text-xs-center grey--text py-5"
                                        ripple
                                        role="button"
                                        @click.stop="content.mediabox = !content.mediabox">
                                        <v-icon x-large>movie</v-icon>
                                        <p v-if="resource.errors[`lessons.${key}.contents.${c}.library_id`]" class="caption error--text" v-html="resource.errors[`lessons.${key}.contents.${c}.library_id`].join(', ')"></p>
                                        <p class="text-xs-center ma-0">{{ __('add interactive content') }}</p>
                                    </v-card-text>
                                </template>
                                {{-- Preview --}}
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-scale-transition>
                                        <v-card class="mt-3" v-show="content.resource.interactive.length" :key="i" v-for="(o, i) in content.resource.interactive" @click.stop="content.mediabox = true" role="button">
                                            <v-card-media :src="o.thumbnail" height="380px">
                                                <v-layout column wrap>
                                                    <v-toolbar flat class="transparent">
                                                        <v-spacer></v-spacer>
                                                        <v-btn class="red white--text" light icon @click.stop="content.resource.interactive = []"><v-icon class="white--text">close</v-icon></v-btn>
                                                    </v-toolbar>
                                                </v-layout>
                                            </v-card-media>
                                            <v-card-title class="white subheading">
                                                <div v-html="o.name"></div>
                                                <v-spacer></v-spacer>
                                            </v-card-title>
                                            <v-card-actions class="px-2 grey--text">
                                                <v-icon light class="grey--text" v-html="o.icon"></v-icon>
                                                <span class="grey--text" v-html="o.mimetype"></span>
                                                <v-spacer></v-spacer>
                                                <span v-html="o.filesize"></span>
                                            </v-card-actions>
                                        </v-card>
                                    </v-scale-transition>
                                    <v-spacer></v-spacer>
                                </v-card-actions>
                                {{-- /Preview --}}
                            </v-card-text>
                            <v-card-actions class="grey lighten-4">
                                <v-spacer></v-spacer>
                                <v-mediabox
                                    :categories="mediabox.catalogues"
                                    :dropzone-options="{url:'{{ route('api.library.upload') }}', autoProcessQueue: true}"
                                    :dropzone-params="{_token: '{{ csrf_token() }}'}"
                                    :multiple="false"
                                    :old="content.resource.interactive.length?content.resource.interactive:[]"
                                    auto-remove-files
                                    close-on-click
                                    dropzone
                                    v-model="content.mediabox"
                                    @selected="value => { content.resource.interactive = value }"
                                    @category-change="val => resource.feature.current = val"
                                    @sending="({file, params}) => { params.catalogue_id = resource.feature.current.id; params.originalname = file.upload.filename; params.extract = true}"
                                >
                                    <template slot="dropzone">
                                        <span class="caption">{{ __('Uploads will be catalogued as ') }}<em>@{{ resource.feature.current ? resource.feature.current.name : 'Uncategorized' }}</em></span>
                                        {{-- <v-card-text>
                                            <span v-if="resource.feature.current" v-html="`Currently uploading ${resource.feature.current}`"></span>
                                        </v-card-text> --}}
                                    </template>
                                    <template slot="media" scope="prop">
                                        <v-card transition="scale-transition" class="accent" :class="prop.item.active?'elevation-10':'elevation-1'">
                                            <v-card-media class="white" height="380px" :src="prop.item.thumbnail">
                                                <v-container fill-height class="pa-0 white--text">
                                                    <v-layout fill-height wrap column>
                                                        <v-spacer></v-spacer>
                                                        <v-slide-y-transition>
                                                            <v-icon ripple class="display-4 pa-1 text-xs-center white--text" v-show="prop.item.active">check</v-icon>
                                                        </v-slide-y-transition>
                                                        <v-spacer></v-spacer>
                                                    </v-layout>
                                                </v-container>
                                            </v-card-media>
                                            <v-card-title primary-title class="subheading white accent--text" v-html="prop.item.originalname"></v-card-title>
                                            <v-card-actions class="px-2 white accent--text">
                                              <v-icon class="accent--text" v-html="prop.item.icon"></v-icon>
                                              <span v-html="prop.item.mimetype"></span>
                                              <v-spacer></v-spacer>
                                              <span v-html="prop.item.mime"></span>
                                              <span v-html="prop.item.filesize"></span>
                                            </v-card-actions>
                                        </v-card>
                                    </template>
                                </v-mediabox>
                            </v-card-actions>
                            {{-- Interactive Content --}}
                        </div>
                        {{-- </v-slide-y-transition> --}}

                    </v-card>
                </transition-group>
            </draggable>
        </template>
    </v-card-text>
</v-card>


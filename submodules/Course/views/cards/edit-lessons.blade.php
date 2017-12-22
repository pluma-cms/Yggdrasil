<template>
    <v-card class="elevation-0 grey lighten-4" :class="lessons.toolbar.modes.distraction.model?'mode-distraction-free mb-0':'mb-3'">
        <v-toolbar card class="white lighten-3 sticky" :class="lessons.toolbar.modes.distraction.model?'mode-distraction-free--toolbar elevation-3':''">
            <v-icon class="green--text text--darken-3">fa-leaf</v-icon>
            <v-toolbar-title class="subheading green--text text--darken-3">{{ __('Lessons') }}</v-toolbar-title>
            <v-spacer></v-spacer>
            <template>
                {{-- Add --}}
                <v-btn
                    icon
                    v-tooltip:left="{'html': '{{ __('Add Lesson') }}'}"
                    @click.native.stop="addSection(draggables.items)"
                >
                    <v-icon>add</v-icon>
                </v-btn>

                {{-- Expand --}}
                <v-btn
                    ripple
                    icon
                    v-tooltip:left="{'html': lessons.toolbar.expand.model?'{{ __('Expand All') }}':'{{ __('Compress All') }}'}"
                    @click="toolbar().expand().toggle(draggables.items, lessons.toolbar.expand.model)"
                >
                    <v-icon small>@{{ lessons.toolbar.expand.model ? 'fa-expand' : 'fa-compress'}}</v-icon>
                </v-btn>
            </template>
            <template>
                <v-btn
                    icon
                    v-model="lessons.toolbar.modes.distraction.model"
                    v-tooltip:left="{'html': '{{ __('Toggle Distraction-Free Mode') }}'}"
                    @click.native.stop="lessons.toolbar.modes.distraction.model = !lessons.toolbar.modes.distraction.model"
                >
                    <v-icon>@{{ lessons.toolbar.modes.distraction.model ? 'fullscreen_exit' : 'fullscreen' }}</v-icon>
                </v-btn>
            </template>
        </v-toolbar>

        <v-card-text :class="lessons.toolbar.modes.distraction.model?'pa-5 mt-5':''">
            <template v-if="!draggables.items.length">
                <v-card-text role="button" v-tooltip:top="{'html': '{{ __('Add lesson') }}'}" class="text-xs-center grey--text my-5" @click="addSection(draggables.items)">
                    <v-icon x-large>fa-leaf</v-icon>
                    <p v-if="resource.errors.lessons" class="caption error--text" v-html="resource.errors.lessons.join(', ')"></p>
                    <p v-else class="subheading text-xs-center ma-0">{{ __('no lessons planned yet') }}</p>
                </v-card-text>
            </template>
            <draggable v-if="draggables.items.length" class="sortable-container" v-model="draggables.items" :options="{animation: 150, handle: '.parent-handle', group: 'lessons', draggable: '.draggable-lesson', forceFallback: true}">
                <transition-group>
                    <v-card
                        :key="key"
                        class="draggable-lesson elevation-1 mb-3"
                        tile
                        v-for="(draggable, key) in draggables.items"
                        v-model="draggable.active"
                    >
                        {{-- head --}}
                        <div class="green lighten-4" style="height: 3px;"></div>
                        <v-toolbar card slot="header" class="sortable-handle parent-handle white lighten-3" dense @click.native.stop="draggable.active = !draggable.active">
                            <v-icon>drag_handle</v-icon>
                            <span v-if="draggable.resource.lockable" v-tooltip:right="{html:'{{ __('This Lesson is lockable') }}'}"><v-icon>lock</v-icon></span>
                            <v-spacer></v-spacer>
                            <v-toolbar-title v-tooltip:left="{html:`{{ __("Sort order: ") . v('key', true) }}`}" class="subheading">@{{ draggable.resource.title }}</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-icon>@{{ draggable.active ? 'keyboard_arrow_up' : 'keyboard_arrow_down' }}</v-icon>
                            <v-btn icon @click.native.stop="draggables.items.splice(key, 1)"><v-icon>close</v-icon></v-btn>
                        </v-toolbar>

                        {{-- lessons --}}
                        {{-- <v-scale-transition> --}}
                            <v-card flat tile v-show="draggable.active" transition="slide-y-transition">
                                <v-card dark flat class="grey lighten-4 mb-3">
                                    <v-toolbar dense card class="grey lighten-4">
                                        <v-toolbar-title class="grey--text text--darken-1 subheading">{{ __("Lesson Banner") }}</v-toolbar-title>
                                    </v-toolbar>
                                    <v-card-media class="grey lighten-3" v-if="draggable.resource.feature" height="200px" :src="draggable.resource.feature.thumbnail"></v-card-media>
                                    <v-mediabox
                                        :categories="resource.feature.catalogues"
                                        :dropzone-options="{url:'{{ route('api.library.upload') }}', autoProcessQueue: true}"
                                        :dropzone-params="{_token: '{{ csrf_token() }}'}"
                                        :multiple="false"
                                        :old="draggable.resource.feature ? [draggable.resource.feature] : []"
                                        auto-remove-files
                                        close-on-click
                                        dropzone
                                        search="mime:image"
                                        toolbar-icon="perm_media"
                                        toolbar-label="{{ __('Lesson Banner') }}"
                                        v-model="draggable.options.feature.model"
                                        @selected="value => { draggable.resource.feature = value[0] }"
                                        @category-change="val => draggable.options.feature.current = val"
                                        @sending="({file, params}) => { params.catalogue_id = draggable.options.feature.current.id; params.originalname = file.upload.filename}"
                                    ></v-mediabox>
                                    <v-card-actions>
                                        <v-btn v-if="draggable.resource.feature" flat ripple @click="draggable.resource.feature = null">{{ __("Remove") }}</v-btn>
                                        <v-spacer></v-spacer>
                                        <v-btn flat ripple @click="draggable.options.feature.model = !draggable.options.feature.model">{{ __("Browse") }}</v-btn>
                                    </v-card-actions>
                                </v-card>
                                <input v-if="draggable.resource.feature" type="hidden" :name="`lessons[${key}][feature]`" :value="draggable.resource.feature.thumbnail">

                                <v-divider></v-divider>

                                <v-layout row wrap>
                                    <v-flex sm12>
                                        <v-card-text>
                                            <input type="hidden" :name="`lessons[${key}][id]`" :value="draggable.resource.id">
                                            <input type="hidden" :name="`lessons[${key}][sort]`" :value="key">
                                            <input type="hidden" :name="`lessons[${key}][icon]`" :value="draggable.resource.icon">
                                            <v-menu
                                                v-model="draggable.icon"
                                                max-width="290px"
                                                min-width="290px"
                                                offset-x
                                                full-width
                                            >
                                                <v-text-field
                                                    slot="activator"
                                                    label="{{ __('Lesson Title') }}"
                                                    :prepend-icon="draggable.resource.icon"
                                                    :append-icon-cb="() => { draggable.icon = !draggable.icon }"
                                                    append-icon="fa-ellipsis-h"
                                                    :name="`lessons[${key}][title]`"
                                                    :error-messages="resource.errors[`lessons.${key}.title`]"
                                                    v-model="draggable.resource.title"
                                                ></v-text-field>
                                                <v-card>
                                                    <v-list>
                                                        <v-list-tile v-for="item in draggables.icons.items" :key="item.name" @click="draggable.resource.icon = item.value">
                                                            <v-list-tile-action>
                                                                <v-icon>@{{ item.value }}</v-icon>
                                                            </v-list-tile-action>
                                                            <v-list-tile-title>@{{ item.name }}</v-list-tile-title>
                                                        </v-list-tile>
                                                    </v-list>
                                                </v-card>
                                            </v-menu>
                                        </v-card-text>

                                        {{-- Quill --}}
                                        <v-quill :id="`lessons-${key}-editor`" v-model="draggable.resource.quill" class="mb-3 white" :fonts="['Montserrat', 'Roboto']" :options="{placeholder: '{{ __('Describe this lesson...') }}'}">
                                            <template>
                                                <input type="hidden" :name="`lessons[${key}][body]`" :value="draggable.resource.quill?draggable.resource.quill.html:''">
                                                <input type="hidden" :name="`lessons[${key}][delta]`" :value="draggable.resource.quill?JSON.stringify(draggable.resource.quill.delta):''">
                                            </template>
                                        </v-quill>
                                        {{-- /Quill --}}

                                    </v-flex>
                                </v-layout>

                                {{-- Content Card --}}
                                <v-divider></v-divider>
                                @include("Course::cards.contents")
                                {{-- /Content Card --}}

                                {{-- Assignment Card --}}
                                <v-divider></v-divider>
                                @include("Course::cards.assignment")
                                {{-- /Assignment Card --}}

                                {{-- Meta Card --}}
                                <v-divider></v-divider>
                                @include("Course::cards.meta")
                                {{-- /Meta Card --}}
                            </v-card>
                        {{-- </v-scale-transition> --}}
                    </v-card>
                </transition-group>
            </draggable>
        </v-card-text>
    </v-card>
</template>

@push('css')
    <link rel="stylesheet" href="{{ assets('frontier/vuetify-mediabox/dist/vuetify-mediabox.min.css') }}">
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/draggable/sortable.min.js') }}"></script>
    <script src="{{ assets('frontier/vendors/vue/draggable/draggable.min.js') }}"></script>
    <script src="{{ assets('frontier/vuetify-mediabox/dist/vuetify-mediabox.min.js') }}"></script>
    {{-- <script src="http://localhost:8080/dist/vuetify-mediabox.min.js"></script> --}}
    <script>
        mixins.push({
            data () {
                return {
                    lessons: {
                        toolbar: {
                            modes: {
                                distraction: {
                                    model: false,
                                },
                            },
                            expand: {
                                model: false,
                            }
                        },
                    },
                    draggables: {
                        icons: {
                            model: false,
                            items: [
                                {name: 'None', value: ''},
                                {name: 'Edit', value: 'fa-edit'},
                                {name: 'Media', value: 'perm_media'},
                                {name: 'Face', value: 'face'},
                                {name: 'Tag Faces', value: 'tag_faces'},
                                {name: 'Collections', value: 'collections'},
                            ],
                        },
                        items: [],
                        old: [],
                    },
                    mediabox: {
                        model: false,
                        output: null,
                        catalogues: JSON.parse(JSON.stringify({!! json_encode($catalogues) !!})),
                    }
                };
            },

            events: {
                //
            },

            watch: {
                'content.resource.interactive': function (val) {
                   //
                }
            },

            methods: {
                toolbar () {
                    let self = this;
                    return {
                        expand () {
                            return {
                                toggle (togglables, value) {
                                    self.lessons.toolbar.expand.model = !value;
                                    for (var i = 0; i < togglables.length; i++) {
                                        let current = togglables[i];
                                        current.active = value;
                                    }
                                }
                            }
                        }
                    }
                },

                addSection (sections) {
                    let c = {
                        id: sections.length + 1,
                        name: '{{ __('Lesson') }}',
                        active: true,
                        icon: false,
                        resource: {
                            id: '',
                            title: 'Untitled #' + (sections.length + 1),
                            icon: '',
                            code: '',
                            quill: {},
                            interactive: [],
                            feature: null,
                            lockable: false,
                            assignment: {
                                title: '', code: '', quill: {}, attachment: null,
                                deadline: '',
                            },
                        },
                        mediabox: false,
                        assignment: {
                            view: false,
                            model: false,
                            deadline: false,
                        },
                        options: {
                            view: false,
                            model: false,
                            feature: {
                                model: false,
                                current: null,
                            },
                        },
                        sections: [],
                    }
                    sections.push(c);
                },

                updateSection (sections, values) {
                    sections.push({
                        id: values.id,
                        name: values.name,
                        active: true,
                        icon: false,
                        resource: {
                            id: values.id ? values.id : '',
                            title: values.title,
                            code: values.code,
                            icon: values.icon,
                            quill: {
                                html: values.body,
                                delta: JSON.parse(values.delta),
                            },
                            feature: values.feature ? {
                                thumbnail: values.feature
                            } : null,
                            oldInteractive: values.library ? [values.library] : [],
                            interactive: values.library ? [values.library] : [],
                            lockable: values.lockable,
                            assignment: {
                                title: values.assignment ? values.assignment.title : '',
                                code: values.assignment ? values.assignment.code : '',
                                deadline: values.assignment ? values.assignment.deadline : '',
                                quill: {
                                    html: values.assignment ? values.assignment.body : '',
                                    delta: values.assignment ? JSON.parse(values.assignment.delta) : '',
                                },
                            },
                        },
                        mediabox: false,
                        assignment: {
                            view: false,
                            model: false,
                            deadline: false,
                        },
                        options: {
                            view: false,
                            model: false,
                            feature: {
                                model: false,
                                current: null,
                            },
                        },
                        sections: [],
                    });
                },

                close (origin, options) {
                    // console.log("mediabox-origin", origin);
                },

                old () {
                    let olds = {!! json_encode($resource->lessons()->with('contents')->get()) !!};
                    if (olds) {
                        for (var i = 0; i < olds.length; i++) {
                            let current = olds[i];
                            this.updateSection(this.draggables.items, current);

                            if (current.contents) {
                                for (var j = 0; j < current.contents.length; j++) {
                                    let c = current.contents[j];
                                    this.updateSection(this.draggables.items[i].sections, c);
                                }
                            }
                        }
                    }
                },

                getMediaboxOutput (content, value) {
                    // console.log('GMO', content, value)
                }
            },

            mounted () {
                this.old();
            },
        });
    </script>
@endpush

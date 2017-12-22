<v-card flat class="white lighten-4">
    <v-toolbar card class="white sticky">
        <v-icon left class="pink--text">fa-edit</v-icon>
        <v-toolbar-title class="subheading pink--text">{{ __('Assignment') }}</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn icon @click.native.stop="draggable.assignment.view = !draggable.assignment.view">
            <v-icon>@{{ draggable.assignment.view ? 'keyboard_arrow_up' : 'keyboard_arrow_down' }}</v-icon>
        </v-btn>
    </v-toolbar>

    <v-slide-y-transition>
    <v-card-text v-show="draggable.assignment.view">
        {{-- Title --}}
        <v-text-field
            :error-messages="resource.errors[`lessons.${key}.assignment.title`]"
            :name="`lessons[${key}][assignment][title]`"
            label="{{ __('Assignment Title') }}"
            v-model="draggable.resource.assignment.title"
            @input="(val) => { draggable.resource.assignment.title = val }"
        ></v-text-field>
        {{-- /Title --}}

        {{-- Code --}}
        <v-text-field
            :error-messages="resource.errors[`lessons.${key}.assignment.code`]"
            :name="`lessons[${key}][assignment][code]`"
            :value="draggable.resource.assignment.title ? draggable.resource.assignment.title : '' | slugify"
            label="{{ __('Assignment Code') }}"
        ></v-text-field>
        {{-- /Code --}}

        {{-- Deadline --}}
        <v-menu
            lazy
            v-model="menu"
            transition="scale-transition"
            offset-y
            full-width
            :nudge-right="40"
            max-width="290px"
            min-width="290px"
        >
            <v-text-field
                label="{{ __('Deadline') }}"
                :name="`lessons[${key}][assignment][deadline]`"
                prepend-icon="event"
                readonly
                slot="activator"
                v-model="draggable.resource.assignment.deadline"
            ></v-text-field>
            <v-date-picker v-model="draggable.resource.assignment.deadline" no-title scrollable actions></v-date-picker>
        </v-menu>
        {{-- /Deadline --}}

        {{-- Body / Delta --}}
        <v-quill v-model="draggable.resource.assignment.quill" class="mb-3 white" :fonts="['Montserrat', 'Roboto']" :options="{placeholder: '{{ __('Describe this assignment...') }}'}">
            <template>
                <input type="hidden" :name="`lessons[${key}][assignment][body]`" :value="draggable.resource.assignment.quill?draggable.resource.assignment.quill.html:''">
                <input type="hidden" :name="`lessons[${key}][assignment][delta]`" :value="draggable.resource.assignment.quill?JSON.stringify(draggable.resource.assignment.quill.delta):''">
            </template>
        </v-quill>
        {{-- /Body / Delta --}}

        {{-- Attachment --}}
        <template v-if="!draggable.resource.assignment.attachment">
            <v-card-text class="text-xs-center grey--text grey lighten-4 py-5" role="button" v-tooltip:top="{'html': '{{ __('Attach File') }}'}"
                @click.stop="draggable.assignment.model = !draggable.assignment.model">
                <v-icon x-large>fa-edit</v-icon>
                <p v-if="resource.errors.assignment" class="caption error--text" v-html="resource.errors.assignment.join(', ')"></p>
                <p v-else class="caption text-xs-center">{{ __('no file attachment') }}</p>
            </v-card-text>
        </template>
        <template v-else>
            {{-- Preview --}}
            <v-card role="button" flat class="pink elevation-1" dark @click.stop="draggable.assignment.model = !draggable.assignment.model">
                <v-card-media :src="draggable.resource.assignment.attachment.thumbnail" height="250px">
                    <v-container fluid fill-height>
                        <v-layout wrap column fill-height>
                            <v-card-title class="subheading">
                                <div v-html="draggable.resource.assignment.attachment.name"></div>
                                <v-spacer></v-spacer>
                                <v-btn dark icon @click.stop="draggable.resource.assignment.attachment = null"><v-icon>close</v-icon></v-btn>
                            </v-card-title>
                            <v-spacer></v-spacer>
                            <v-card-actions class="px-2 white--text">
                                <v-icon class="white--text" v-html="draggable.resource.assignment.attachment.icon"></v-icon>
                                <v-spacer></v-spacer>
                                <span v-html="draggable.resource.assignment.attachment.mime"></span>
                                <span v-html="draggable.resource.assignment.attachment.filesize"></span>
                                {{-- field --}}
                                <input type="hidden" :name="`lessons[${key}][assignment][library]`" :value="JSON.stringify(draggable.resource.assignment.attachment)">
                                <input type="hidden" :name="`lessons[${key}][assignment][library_id]`" :value="draggable.resource.assignment.attachment.id">
                                {{-- /field --}}
                            </v-card-actions>
                        </v-layout>
                    </v-container>
                </v-card-media>
            </v-card>
            {{-- /Preview --}}
        </template>
        {{-- /Attachment --}}
    </v-card-text>
    </v-slide-y-transition>
    <v-mediabox :multiple="false" close-on-click :categories="mediabox.catalogues" v-model="draggable.assignment.model" @selected="value => { draggable.resource.assignment.attachment = value[0] }">
        <template slot="media" scope="props">
            <v-card transition="scale-transition" class="accent" :class="props.item.active?'elevation-10':'elevation-1'">
                <v-card-media height="250px" :src="props.item.thumbnail">
                    <v-container fill-height class="pa-0 white--text">
                        <v-layout fill-height wrap column>
                            <v-card-title class="subheading" v-html="props.item.name"></v-card-title>
                            <v-slide-y-transition>
                                <v-icon ripple class="display-4 pa-1 text-xs-center white--text" v-show="props.item.active">check</v-icon>
                            </v-slide-y-transition>
                            <v-spacer></v-spacer>
                            <v-card-actions class="px-2 white--text">
                                <v-icon class="white--text" v-html="props.item.icon"></v-icon>
                                <v-spacer></v-spacer>
                                <span v-html="props.item.mime"></span>
                                <span v-html="props.item.filesize"></span>
                            </v-card-actions>
                        </v-layout>
                    </v-container>
                </v-card-media>
            </v-card>
        </template>
    </v-mediabox>
</v-card>

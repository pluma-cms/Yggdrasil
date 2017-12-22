<v-card flat class="white lighten-4">
    <v-toolbar card class="white sticky">
        <v-icon left class="teal--text">details</v-icon>
        <v-toolbar-title class="subheading teal--text">{{ __('Options') }}</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn icon @click.native.stop="draggable.options.view = !draggable.options.view">
            <v-icon>@{{ draggable.options.view ? 'keyboard_arrow_up' : 'keyboard_arrow_down' }}</v-icon>
        </v-btn>
    </v-toolbar>

    <v-card-text v-show="draggable.options.view">
        {{-- Lockable --}}
        <v-switch persistent-hint hint="{{ __('Recommended set to false if this is the first Lesson in the Course.') }}" label="{{ __('Lock from users until previous lesson is finished') }}" v-model="draggable.resource.lockable" :value="1"></v-switch>
        <input type="hidden" :name="`lessons[${key}][lockable]`" :value="draggable.resource.lockable?draggable.resource.lockable:false">
        <span v-if="resource.errors[`lessons.${key}.lockable`]" class="caption" v-html="resource.errors[`lessons.${key}.lockable`]"></span>
        {{-- <span v-html="draggable.resource.lockable"></span> --}}
        {{-- /Lockable --}}
    </v-card-text>
</v-card>

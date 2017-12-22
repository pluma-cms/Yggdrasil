<v-card class="elevation-1">
    <v-toolbar class="elevation-0 transparent">
        <v-toolbar-title>{{ __("Progress") }}</v-toolbar-title>
    </v-toolbar>
    <v-divider></v-divider>
    <v-card-text class=" text-xs-center">
        <div class="text-xs-center">
            <v-progress-circular
                v-bind:size="150"
                v-bind:width="20"
                v-bind:value="value"
                class="indigo--text text--lighten-2"
                >
                @{{ value }}
            </v-progress-circular>
        </div>
    </v-card-text>
    <v-card-text class="text-xs-center indigo lighten-1">
        <div>
            <v-subheading class="white--text">Lesson Complete:</v-subheading>
        </div>
        <div >
            <v-subheading class="white--text">0/2</v-subheading>
        </div>
    </v-card-text>
</v-card>

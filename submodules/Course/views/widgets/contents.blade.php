<v-container-fluid list-grid-lg>
    <v-card class="elevation-1">
        <v-toolbar class="elevation-1 purple lighten-3" dark>
            <v-toolbar-title>{{ __("Course Content") }}</v-toolbar-title>
            <v-spacer></v-spacer>
        </v-toolbar>
        <v-divider></v-divider>

        <v-card-text>
            <v-card class="elevation-0">
                <v-toolbar class="elevation-0 transparent">
                    <v-toolbar-title>{{ __("PS 1") }}</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-chip label class="elevation-0 green lighten-2" dark><v-icon class="white--text">face</v-icon></v-chip>
                </v-toolbar>
                <v-card-text>
                    <div class="grey--text text--darken-2 mb-3">
                        This is a face-to-face class. For inquries and other details, please contact your Trainer.
                    </div>
                </v-card-text>
            </v-card>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-text>
            <v-card class="elevation-0">
                <v-toolbar class="elevation-0 transparent">
                    <v-toolbar-title>{{ __("PS 2") }}</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-chip label class="elevation-0 green lighten-2 white--text">0/10</v-chip>
                </v-toolbar>
                <v-card-text>
                    <div class="grey--text text--darken-2 mb-3">
                        Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.
                    </div>

                    {{-- dialog --}}
                    @include("Course::widgets.lessons")
                </v-card-text>
            </v-card>
        </v-card-text>
        {{-- <v-card height="15px" class="elevation-1 purple lighten-3"> --}}
        </v-card>
    </v-card>
</v-container-fluid>

@push('css')
    <style>
        .weight-600 {
            font-weight: 600 !important;
        }
    </style>
@endpush
@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        mixins.push({
            data () {
                return {
                    start: false,
                    notifications: false,
                    sound: true,
                    widgets: false,
                };
            },
            beforeDestroy () {
                clearInterval(this.interval)
            },
        })
    </script>
@endpush

<v-card class="elevation-1">
    <v-card-media src="{{ assets('course/images/polygon.jpg') }}">
        <div class="overlay-bg"></div>
        <v-layout column class="media">
            <v-card-title class="pa-0">
                <v-spacer></v-spacer>
                <v-btn dark icon tooltip:left="{ html: 'More Actions' }">
                    <v-icon>more_vert</v-icon>
                </v-btn>
            </v-card-title>
            <v-spacer></v-spacer>
            <v-card-text class="white--text text-xs-center pt-0">
                <div class="display-3 white--text">4</div>
                <div class="headline white--text">students</div>
                <div class="body-1 white--text">are currently enrolled in this course</div>
            </v-card-text>
        </v-layout>
    </v-card-media>
    <v-divider></v-divider>
    <v-card-text class="pa-0">
        <v-list subheader>
            <v-subheader class="">List of students and their progress:</v-subheader>
            <v-list-tile avatar v-for="item in students" v-bind:key="item.title" @click="" ripple>
                <v-list-tile-avatar>
                    <img v-bind:src="item.avatar"/>
                </v-list-tile-avatar>
                <v-list-tile-content>
                    <v-list-tile-title v-html="item.title"></v-list-tile-title>
                </v-list-tile-content>
                <v-list-tile-action class="grey--text">
                    @{{ item.course }}
                </v-list-tile-action>
            </v-list-tile>
        </v-list>
    </v-card-text>
</v-card>

@push('css')
    <style>
        .overlay-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(204, 96, 96, 0.64);
            z-index: 0;
        }
        .media .card__text {
            z-index: 1;
        }
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
                    students: [
                        { title: 'Jason Oner', avatar: 'https://placeimg.com/640/480/any/grayscale/1', course: '12%' },
                        { title: 'Ranee Carlson', avatar: 'https://placeimg.com/640/480/any/grayscale/2', course: '26%' },
                        { title: 'Cindy Baker', avatar: 'https://placeimg.com/640/480/any/grayscale/3', course: '33%' },
                        { title: 'Ali Connors', avatar: 'https://placeimg.com/640/480/any/grayscale/4', course: '42%' },
                    ],
                }
            }
        })
    </script>
@endpush

@extends("Theme::layouts.admin")

@section("head-title", __($resource->title))
@section("utilitybar", '')
@section("content")
    <v-parallax jumbotron class="elevation-1 mb-3" :src="resource.backdrop" height="350">
        <v-layout row wrap align-end justify-center>
            <v-flex md8 xs12 pa-0>
                <v-card tile flat class="mt-5">
                    <v-toolbar dense card class="white">
                        <v-spacer></v-spacer>

                        <v-chip v-if="resource.enrolled" small class="ml-0 green white--text">{{ __('Enrolled') }}</v-chip>

                        <form v-if="resource.bookmarked" action="{{ route('courses.bookmark.unbookmark', $resource->id) }}" method="POST">
                            {{ csrf_field() }}
                            <v-btn type="submit" icon ripple v-tooltip:left="{ html: 'Remove from Bookmarked' }">
                                <v-icon light class="red--text">bookmark</v-icon>
                            </v-btn>
                        </form>

                        <v-menu full-width bottom left>
                            <v-btn slot="activator" icon><v-icon>more_vert</v-icon></v-btn>
                            <v-list>
                                @can('bookmark-course')
                                <v-list-tile avatar v-if="!resource.bookmarked" ripple @click="post(route(urls.courses.bookmark, resource.id), {_token: '{{ csrf_token() }}'})">
                                    <v-list-tile-avatar>
                                        <v-icon class="red--text">bookmark_outline</v-icon>
                                    </v-list-tile-avatar>
                                    <v-list-tile-title>{{ __('Bookmark this Course') }}</v-list-tile-title>
                                </v-list-tile>
                                <v-list-tile avatar v-else ripple @click="post(route(urls.courses.unbookmark, resource.id), {_token: '{{ csrf_token() }}'})">
                                    <v-list-tile-avatar>
                                        <v-icon class="red--text">bookmark</v-icon>
                                    </v-list-tile-avatar>
                                    <v-list-tile-title>{{ __('Remove from Bookmarked') }}</v-list-tile-title>
                                </v-list-tile>
                                @endcan
                            </v-list>
                            @can('edit-course')
                            @endcan
                        </v-menu>
                    </v-toolbar>
                    <v-card-text>
                        <v-container fluid grid-list-lg>
                            <v-flex sm12>
                                <v-layout row wrap>
                                    <v-flex md3 sm2 v-if="resource.feature">
                                        <img :src="resource.feature" width="100%" height="auto">
                                        {{-- <v-card-media ripple :src="resource.feature" height="150px" cover class="elevation-1"></v-card-media> --}}
                                    </v-flex>
                                    <v-flex :class="{'md9 sm10': resource.feature, 'md12': !resource.feature}">
                                        <v-card-title primary-title class="pa-0">
                                            <strong class="headline td-n accent--text" v-html="resource.title"></strong>
                                        </v-card-title>

                                        <v-avatar size="30px">
                                            <img :src="resource.user.avatar" :alt="resource.user.fullname">
                                        </v-avatar>
                                        <v-chip label small class="pl-0 caption transparent grey--text elevation-0">
                                            <a :href="route(urls.profile.show, resource.user.handlename)" v-html="resource.user.displayname"></a>
                                        </v-chip>

                                        <v-footer class="transparent">
                                            <v-chip label small class="pl-0 ml-0 caption transparent grey--text elevation-0"><v-icon left small class="subheading">fa-tasks</v-icon>&nbsp;<span v-html="`${resource.lessons.length} ${resource.lessons.length>1?'{{ __('Parts') }}':'{{ __('Part') }}'}`"></span></v-chip>

                                            <v-chip label small class="pl-0 ml-0 caption transparent grey--text elevation-0"><v-icon left small class="subheading">class</v-icon><span v-html="resource.code"></span></v-chip>

                                            <v-chip v-if="resource.category" label class="pl-0 ml-0 caption transparent grey--text elevation-0"><v-icon left small class="subheading">label</v-icon><span v-html="resource.category.name"></span></v-chip>

                                            <v-chip label small class="pl-0 ml-0 caption transparent grey--text elevation-0"><v-icon left small class="subheading">fa-clock-o</v-icon><span v-html="resource.created"></span></v-chip>
                                        </v-footer>
                                    </v-flex>
                                </v-layout>
                            </v-flex>
                        </v-container>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-parallax>
    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex flex md3 xs12 order-lg1>
                <v-card class="elevation-1">
                    <v-toolbar card class="transparent">
                        <v-toolbar-title class="accent--text">{{ __('Overview') }}</v-toolbar-title>
                    </v-toolbar>
                    <v-divider></v-divider>
                    <v-card-text class="grey--text text--darken-2" v-html="resource.body"></v-card-text>
                </v-card>
            </v-flex>
            <v-flex flex md6 xs12 order-lg2>
                <v-card class="elevation-1">
                    <v-toolbar class="purple lighten-3 white--text transparent elevation-1">
                        <v-toolbar-title class="white--text">{{ __('Course Content') }}</v-toolbar-title>
                    </v-toolbar>
                    <template v-if="!resource.lessons.length">
                        <v-card-text class="text-xs-center pa-5">
                            <div><v-icon class="display-4 purple--text text--lighten-4">fa-leaf</v-icon></div>
                            <div class="purple--text text--lighten-4">{{ __('No lessons available yet') }}</div>
                        </v-card-text>
                    </template>
                    {{-- Lessons --}}
                    <template v-for="(lesson, i) in lessons">
                        <v-card-text :class="{'grey lighten-4': lesson.locked}">
                            <v-card flat tile class="transparent elevation-0" :key="i">
                                <v-toolbar card class="transparent">
                                    <v-icon left v-if="!resource.enrolled && lesson.locked">lock</v-icon>
                                    <v-toolbar-title class="accent--text" :class="{'grey--text': lesson.locked}">
                                        <span v-html="lesson.title"></span>
                                    </v-toolbar-title>
                                    <v-spacer></v-spacer>
                                    <v-chip label class="success white--text" v-if="lesson.icon"><v-icon class="white--text" v-html="lesson.icon"></v-icon></v-chip>
                                    <v-chip label class="success white--text" v-else v-html="`${lesson.progress}/${lesson.contents.length}`"></v-chip>
                                </v-toolbar>
                                <v-card-text class="grey--text text--darken-2" v-html="lesson.body"></v-card-text>
                                <v-card-actions v-if="lesson.contents.length">
                                    <v-spacer></v-spacer>
                                    {{-- v-if="lesson.unlocked" --}}
                                    <v-dialog lazy v-model="lesson.dialog" fullscreen transition="dialog-bottom-transition" :overlay=false>
                                        <v-btn v-if="lesson.unlocked" slot="activator" round outline class="success success--text">{{ __('Start') }}</v-btn>
                                        <v-btn v-else slot="activator" round outline class="success success--text">{{ __('View') }}</v-btn>
                                        <v-card flat tile class="bg--light">
                                            <v-parallax jumbotron class="elevation-0" src="http://source.unsplash.com/1000x600?nature" height="400">
                                                <div class="media-overlay"></div>
                                                <v-layout row wrap>
                                                    <v-spacer></v-spacer>
                                                    <v-btn dark flat ripple @click.stop="lesson.dialog = !lesson.dialog">{{ __('Done') }}</v-btn>
                                                </v-layout>
                                                <v-layout column wrap align-center justify-center>
                                                    <v-flex sm12>
                                                        <v-card flat class="transparent">
                                                            <v-card-text class="white--text text-xs-center mb-5">
                                                                <div><strong class="display-2" v-html="lesson.title"></strong></div>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-flex>
                                                    <v-spacer></v-spacer>
                                                </v-layout>
                                                <v-spacer></v-spacer>
                                            </v-parallax>

                                            <v-container fluid grid-list-lg class="theme--light pb-5">
                                                <v-layout row wrap>
                                                    <v-flex order-lg1 order-md1 order-sm3 order-xs3 md3 xs12>
                                                        <v-card class="elevation-1 card--filed-on-top">
                                                            <v-toolbar card class="transparent">
                                                                <v-toolbar-title class="accent--text">{{ __('Assignment') }}</v-toolbar-title>
                                                                <v-spacer></v-spacer>
                                                                <v-btn icon ripple v-if="lesson.assignment"><v-icon>file_download</v-icon></v-btn>
                                                            </v-toolbar>
                                                            <v-divider></v-divider>
                                                            <v-card-text v-if="! lesson.assignment" class="pa-5">
                                                                <v-layout row wrap justify-center>
                                                                    <img height="auto" src="http://192.168.1.213/pluma/~assets/frontier/images/placeholder/empty_assignment.jpg" alt="">
                                                                </v-layout>
                                                                <div label class="body-1 text-xs-center red--text text--lighten-3">{{ __('No assignment for this lesson.') }}</div>
                                                            </v-card-text>
                                                            <template v-else>
                                                                <v-card-text class="pa-3 grey--text text--darken-2">
                                                                    <div class="mb-4"><strong v-html="lesson.assignment.title"></strong></div>
                                                                    <div v-html="lesson.assignment.body"></div>
                                                                    <div class="text-xs-right"><v-icon left class="subheading">fa-edit</v-icon>Deadline: October 30, 2017</div>
                                                                    <v-card flat tile>
                                                                        llasd
                                                                    </v-card>
                                                                </v-card-text>
                                                                <v-card-actions>
                                                                    <v-spacer></v-spacer>
                                                                    <v-btn dark class="red lighten-3 elevation-1">{{ __('Submit your assignment') }}</v-btn>
                                                                    <v-spacer></v-spacer>
                                                                </v-card-actions>
                                                            </template>
                                                        </v-card>
                                                    </v-flex>

                                                    <v-flex order-lg2 order-md2 order-sm1 order-xs1 md6 xs12>
                                                        <v-card class="elevation-1 card--filed-on-top">
                                                            <v-toolbar card class="deep-purple lighten-2">
                                                                <v-toolbar-title class="white--text">{{ __('Lesson Content') }}</v-toolbar-title>
                                                            </v-toolbar>
                                                            <v-divider></v-divider>
                                                            <v-card-text>
                                                                <v-card class="elevation-1 mb-3" v-for="(content, i) in lesson.contents" :key="i">
                                                                    <span v-html="content.order"></span>
                                                                    <v-list two-line subheader class="pb-0">
                                                                        <v-list-tile avatar :ripple="content.unlocked" :href="content.unlocked?content.url:null" target="__blank" >
                                                                            <v-list-tile-avatar>
                                                                                <v-icon v-if="content.current" primary>play_circle_outline</v-icon>
                                                                                <v-icon v-else-if="content.completed" success>check</v-icon>
                                                                                <v-icon v-else class="grey--text">lock</v-icon>
                                                                            </v-list-tile-avatar>
                                                                            <v-list-tile-content :class="{'grey--text': content.locked}">
                                                                                <v-list-tile-title class="title" v-html="content.title"></v-list-tile-title>
                                                                                <v-list-tile-sub-title class="caption">
                                                                                    <span v-if="content.current">{{ __('Continue') }}</span>
                                                                                    <span v-else-if="content.completed">{{ __('Finished') }}</span>
                                                                                    <span v-else>{{ __('Locked') }}</span>
                                                                                </v-list-tile-sub-title>
                                                                            </v-list-tile-content>
                                                                            <v-list-tile-action v-if="content.unlocked">
                                                                                <v-icon class="grey--text text--lighten-1">chevron_right</v-icon>
                                                                            </v-list-tile-action>
                                                                        </v-list-tile>
                                                                    </v-list>
                                                                </v-card>
                                                            </v-card-text>


                                                        </v-card>
                                                    </v-flex>

                                                    <v-flex order-lg3 order-md3 order-sm2 order-xs2 md3 xs12>
                                                        <v-card class="elevation-1 card--filed-on-top">
                                                            <v-toolbar card class="transparent">
                                                                <v-toolbar-title class="accent--text">{{ __('Progress') }}</v-toolbar-title>
                                                                <v-spacer></v-spacer>
                                                            </v-toolbar>
                                                            <v-divider></v-divider>
                                                            <v-card-actions>
                                                                <v-spacer></v-spacer>
                                                                <v-progress-circular
                                                                    v-if="lesson.contents.length"
                                                                    :size="150"
                                                                    :width="20"
                                                                    :value="lesson.progress"
                                                                    class="deep-purple--text text--lighten-2"
                                                                >
                                                                    @{{ lesson.progress }}
                                                                </v-progress-circular>
                                                                <v-spacer></v-spacer>
                                                            </v-card-actions>
                                                            <v-card-text class="deep-purple--text text--lighten-2 text-xs-center">
                                                                <div>{{ __('Content Completed:') }}</div>
                                                                <div>@{{ lesson.completed }}</div>
                                                            </v-card-text>
                                                        </v-card>
                                                    </v-flex>
                                                </v-layout>
                                            </v-container>

                                        </v-card>
                                    </v-dialog>
                                    <v-spacer></v-spacer>
                                </v-card-actions>
                            </v-card>
                        </v-card-text>
                        <v-divider></v-divider>
                    </template>
                    {{-- /Lessons --}}
                </v-card>
            </v-flex>
            <v-flex flex md3 xs12 order-lg3>
                <v-card class="elevation-1">
                    <v-toolbar card class="transparent">
                        <v-toolbar-title class="accent--text">{{ __('Progress') }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>
                    <v-divider></v-divider>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-progress-circular
                            :size="150"
                            :width="20"
                            :value="resource.percentage"
                            class="purple--text text--lighten-4"
                        >
                            <span v-html="resource.percentage"></span>
                        </v-progress-circular>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                    <v-card-text class="purple--text text--lighten-4 text-xs-center">
                        <div>{{ __('Lesson Completed:') }}</div>
                        <div v-html="resource.percentage"></div>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('css')
    <style>
        .media-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.09);
        }
    </style>
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    resource: {!! json_encode($resource) !!},
                    lessons: {!! json_encode($resource->lessons) !!},
                    urls: {
                        courses: {
                            unbookmark: '{{ route('api.courses.bookmark.unbookmark', 'null') }}',
                            bookmark: '{{ route('api.courses.bookmark.bookmark', 'null') }}',
                        },
                        profile: {
                            show: '{{ route('profile.show', 'null') }}'
                        }
                    },
                    {{-- resource: {!! json_encode($resource->with(['lessons', 'lessons.contents'])->first()->toArray()) !!} --}}
                }
            },

            methods: {
                post (url, query) {
                    let self = this;
                    this.api().post(url, query).then(response => {
                        self.resource.bookmarked = !self.resource.bookmarked;
                    });
                },
            },

            mounted () {
                //
            }
        });
    </script>
@endpush

@extends("Theme::layouts.admin")

@section("content")
    <v-toolbar dark class="mb-3 elevation-1 info sticky">
        <v-menu transition="slide-y-transition">
            <v-btn flat slot="activator" class="white--text">
                <v-icon left>perm_media</v-icon>
                <span>All</span>
                <v-icon right>arrow_drop_down</v-icon>
            </v-btn>
        </v-menu>

        <v-spacer></v-spacer>
        <template>
            <v-text-field
                :append-icon-cb="() => {bulk.searchform.model = !bulk.searchform.model}"
                :prefix="bulk.searchform.prefix"
                :prepend-icon="bulk.searchform.prepend"
                append-icon="search"
                light solo hide-details single-line
                placeholder="Search"
                v-model="bulk.searchform.query"
                v-show="bulk.searchform.model"
            ></v-text-field>
            <v-btn v-show="!bulk.searchform.model" icon v-tooltip:left="{html:'{{ __('Search') }}'}" @click.stop="bulk.searchform.model = !bulk.searchform.model"><v-icon>search</v-icon></v-btn>
        </template>
        <v-btn icon v-tooltip:left="{html:'{{ __('Sort') }}'}"><v-icon>sort</v-icon></v-btn>
        <v-btn icon v-tooltip:left="{html:bulk.gridlist.model?'{{ __('Grid View') }}':'{{ __('List View') }}'}" @click.stop="bulk.gridlist.model = !bulk.gridlist.model"><v-icon v-html="bulk.gridlist.model?'apps':'list'"></v-icon></v-btn>
        <v-btn icon v-tooltip:left="{html:'{{ __('Filter') }}'}"><v-icon>fa-filter</v-icon></v-btn>
    </v-toolbar>

    <v-container fluid grid-list-lg>
        <v-layout row wrap fill-height>
            <v-flex
                lg3 md4
                v-for="(card, i) in dataset.items"
                :key="card.id">
                <v-card ripple class="elevation-1 flex pa-0" height="100%">

                    <v-layout column wrap fill-height class="ma-0">
                        <v-card-media class="accent lighten-3" :src="card.backdrop" height="250px" style="max-width:100%">
                            <v-container fill-height fluid class="pa-0 white--text">
                                <v-layout column>
                                    <v-card-actions>
                                        {{-- If Bookmarked --}}
                                        <v-btn icon v-if="card.bookmarked" class="red darken-1" v-tooltip:right="{html:'{{ __('Remove from Bookmarked') }}'}" @click="post(route(urls.unbookmark, (card.id)), {_token: '{{ csrf_token() }}'})"><v-icon small class="white--text">fa-bookmark</v-icon></v-btn>
                                        {{-- /If Bookmarked --}}
                                        <v-spacer></v-spacer>
                                        @can('bookmark-course')
                                        <v-menu full-width bottom left>
                                            <v-btn slot='activator' dark icon><v-icon>more_vert</v-icon></v-btn>
                                            <v-card>
                                                <v-list>
                                                    @can('bookmark-course')
                                                    <v-list-tile avatar v-if="!card.bookmarked" ripple @click="post(route(urls.bookmark, (card.id)), {_token: '{{ csrf_token() }}'})">
                                                        <v-list-tile-avatar>
                                                            <v-icon class="red--text">bookmark_outline</v-icon>
                                                        </v-list-tile-avatar>
                                                        <v-list-tile-title>{{ __('Bookmark this course') }}</v-list-tile-title>
                                                    </v-list-tile>
                                                    <v-list-tile avatar v-else ripple @click="post(route(urls.unbookmark, (card.id)), {_token: '{{ csrf_token() }}'})">
                                                        <v-list-tile-avatar>
                                                            <v-icon class="red--text">bookmark</v-icon>
                                                        </v-list-tile-avatar>
                                                        <v-list-tile-title>{{ __('Remove from Bookmarked') }}</v-list-tile-title>
                                                    </v-list-tile>
                                                    @endcan
                                                    @can('edit-course')
                                                    <v-list-tile avatar ripple :href="route(urls.edit, (card.id))">
                                                        <v-list-tile-avatar>
                                                            <v-icon>edit</v-icon>
                                                        </v-list-tile-avatar>
                                                        <v-list-tile-title>{{ __('Edit Course') }}</v-list-tile-title>
                                                    </v-list-tile>
                                                    @endcan

                                                    @can('delete-course')
                                                    <v-list-tile avatar ripple @click="destroy(route(urls.destroy, (card.id)), {_token: '{{ csrf_token() }}'})">
                                                        <v-list-tile-avatar>
                                                            <v-icon class="warning--text">delete</v-icon>
                                                        </v-list-tile-avatar>
                                                        <v-list-tile-title>{{ __('Move to Trash') }}</v-list-tile-title>
                                                    </v-list-tile>
                                                    @endcan
                                                </v-list>
                                            </v-card>
                                        </v-menu>
                                        @endcan
                                    </v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-card-actions>
                                        <v-avatar v-if="card.feature" size="80px">
                                            <img v-if="card.feature" :src="card.feature" :alt="card.title">
                                        </v-avatar>

                                        <v-spacer></v-spacer>
                                        {{-- If Enrolled --}}
                                        <v-chip v-if="card.enrolled" small class="ml-0 green white--text">{{ __('Enrolled') }}</v-chip>
                                        {{-- /If Enrolled --}}
                                    </v-card-actions>
                                </v-layout>
                            </v-container>
                        </v-card-media>

                        <v-card-title primary-title class="pb-0">
                            <a v-if="!card.enrolled" :href="route(urls.show, card.slug)" class="accent--text td-n"><strong class="title accent--text" v-html="card.title"></strong></a>
                            <a v-else :href="route(urls.enrolled, card.slug)" class="accent--text td-n"><strong class="title accent--text" v-html="card.title"></strong></a>
                        </v-card-title>

                        <v-card-actions>
                            <v-avatar v-if="card.user.avatar" size="30px">
                                <img v-if="card.user.avatar" :src="card.user.avatar" :alt="card.user.handlename">
                            </v-avatar>
                            <a :href="`{{ url('/admin/profile/' . v('card.user.handlename', true)) }}`" class="caption grey--text td-n" v-html="card.user.fullname"></a>
                        </v-card-actions>

                        <v-card-actions class="transparent">

                            <span class="text-xs-center caption pa-1 grey--text">
                                <v-icon class="caption" left>class</v-icon>
                                <span v-html="card.code"></span>
                            </span>
                            <span class="text-xs-center caption pa-1 grey--text">
                                <v-icon class="caption" left>fa-tasks</v-icon>
                                <span v-html="`${card.lessons.length} ${(card.lessons.length <= 1 ? '{{ __('Part') }}' : '{{ __('Parts') }}')}`"></span>
                            </span>
                            <span v-if="card.category" class="caption pa-1 grey--text">
                                <v-icon class="caption" left>label</v-icon>
                                <span v-html="card.category.name"></span>
                            </span>
                            <span class="text-xs-center caption pa-1 grey--text">
                                <v-icon class="caption" left>fa-clock-o</v-icon>
                                <span v-html="card.created"></span>
                            </span>
                        </v-card-actions>

                        <v-card-text class="grey--text text--darken-1" v-html="card.excerpt"></v-card-text>

                        <v-spacer></v-spacer>

                        <v-card-actions>
                            <v-spacer></v-spacer>

                            @can('show-course')
                            <v-btn v-if="!card.enrolled" flat primary ripple :href="route(urls.show, card.slug)">{{ __('Learn More') }}</v-btn>
                            @endcan

                            @can('enroll-course')
                            {{-- if user is not enrolled yet, let user have the option
                            to enroll --}}
                            <v-btn v-if="!card.enrolled" flat primary ripple @click="">{{ __('Enroll') }}</v-btn>
                            <v-btn v-else flat primary ripple :href="route(urls.enrolled, card.slug)">{{ __('Learn More') }}</v-btn>
                            @endcan
                        </v-card-actions>
                    </v-layout>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>

    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    bulk: {
                        destroy: {
                            model: false,
                        },
                        gridlist: {
                            model: true,
                        },
                        searchform: {
                            model: false,
                        },
                    },
                    urls: {
                        unbookmark: '{{ route('api.courses.bookmark.unbookmark', 'null') }}',
                        bookmark: '{{ route('api.courses.bookmark.bookmark', 'null') }}',
                        show: '{{ route('courses.show', 'null') }}',
                        edit: '{{ route('courses.edit', 'null') }}',
                        destroy: '{{ route('api.courses.destroy', 'null') }}',
                        enrolled: '{{ route('courses.enrolled.show', 'null') }}',
                    },
                    dataset: {
                        headers: [
                            { text: '{{ __("ID") }}', align: 'left', value: 'id' },
                            { text: '{{ __("Name") }}', align: 'left', value: 'name' },
                            { text: '{{ __("Alias") }}', align: 'left', value: 'alias' },
                            { text: '{{ __("Code") }}', align: 'left', value: 'code' },
                            { text: '{{ __("Grants") }}', align: 'left', value: 'grants' },
                            { text: '{{ __("Last Modified") }}', align: 'left', value: 'updated_at' },
                            { text: '{{ __("Actions") }}', align: 'center', sortable: false, value: 'updated_at' },
                        ],
                        items: [],
                        loading: true,
                        pagination: {
                            rowsPerPage: 5,
                            totalItems: 0,
                            page: 1,
                        },
                        searchform: {
                            model: false,
                            query: '',
                        },
                        selected: [],
                        totalItems: 0,
                    },
                }
            },
            methods: {
                get () {
                    const { sortBy, descending, page, rowsPerPage } = this.dataset.pagination;
                    let query = {
                        descending: descending ? descending : null,
                        page: page,
                        sort: sortBy ? sortBy : null,
                        take: rowsPerPage,
                    };
                    this.api().get('{{ route('api.courses.all') }}', query)
                        .then((data) => {
                            this.dataset.items = data.items.data ? data.items.data : data.items;
                            this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                            this.dataset.loading = false;
                        });
                },

                post (url, query) {
                    this.api().post(url, query).then(response => {
                        this.get();
                    });
                },

                destroy (url, query) {
                    this.api().delete(url, query).then(response => {
                        this.get();
                    });
                }
            },

            mounted () {
                this.dataset.items = {!! json_encode($resources->toArray()) !!}
                // this.get();
            },
        })
    </script>
@endpush

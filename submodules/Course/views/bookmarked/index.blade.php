@extends("Theme::layouts.admin")

@section("content")
    <v-toolbar dark class="elevation-1 info sticky" :class="{'mb-0': !dataset.items.length, 'mb-3': dataset.items.length}">
        <v-toolbar-title>{{ __('Bookmarked Courses') }}</v-toolbar-title>

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

    <v-container v-if="!dataset.items.length" fluid grid-list-lg class="pa-0">
        {{-- Empty --}}
        <v-card flat class="grey lighten-4 text-xs-center">
            <v-card-actions class="white">
                <v-spacer></v-spacer>
                <img src="{{ assets('course/images/no-courses.png') }}" width="500px" height="auto">
                <v-spacer></v-spacer>
            </v-card-actions>
            <div class="headline mt-4 text-xs-center grey--text text--darken-1"><strong>{{ __('No Bookmarks...') }}</strong></div>
            <v-card-text class="pa-4 grey--text">
                <p class="subheading"><strong>{{ __("Courses you bookmarked will appear here.") }}</strong></p>
                <p><v-btn dark class="blue elevation-1" href="{{ route('courses.index') }}">{{ __('Browse Courses') }}</v-btn></p>
            </v-card-text>
        </v-card>
        {{-- /Empty --}}
    </v-container>
    <v-container fluid grid-list-lg>
        <v-layout row wrap>

            <template>
                <v-flex
                    md4
                    v-for="(card, i) in dataset.items"
                    :key="card.id">
                    <v-card class="elevation-1">
                        <v-card-media :src="card.backdrop" height="250px">
                            <v-container fill-height fluid class="pa-0 white--text">
                                <v-layout column>
                                    <v-card-actions>
                                        {{-- If Bookmarked --}}
                                        <v-btn icon v-if="card.bookmarked" class="red darken-1" v-tooltip:right="{html:'{{ __('Remove from Bookmarked') }}'}" @click="post(route(urls.unbookmark, (card.id)), {_token: '{{ csrf_token() }}'})"><v-icon small class="white--text">fa-bookmark</v-icon></v-btn>
                                        {{-- /If Bookmarked --}}

                                        <v-spacer></v-spacer>
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
                                                    <v-list-tile avatar :href="route(urls.edit, (card.id))">
                                                        <v-list-tile-avatar>
                                                            <v-icon>edit</v-icon>
                                                        </v-list-tile-avatar>
                                                        <v-list-tile-title>{{ __('Edit') }}</v-list-tile-title>
                                                    </v-list-tile>
                                                    @endcan

                                                    @can('delete-course')
                                                    <v-list-tile avatar @click="">
                                                        <v-list-tile-avatar>
                                                            <v-icon class="warning--text">delete</v-icon>
                                                        </v-list-tile-avatar>
                                                        <v-list-tile-title>{{ __('Move to Trash') }}</v-list-tile-title>
                                                    </v-list-tile>
                                                    @endcan
                                                </v-list>
                                            </v-card>
                                        </v-menu>
                                    </v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-card-actions>
                                        <v-avatar v-if="card.feature" size="80px">
                                            <img :src="card.feature" :alt="card.title">
                                        </v-avatar>

                                        <v-spacer></v-spacer>
                                        {{-- If Enrolled --}}
                                        <v-chip v-if="card.enrolled" small class="ml-0 green white--text">{{ __('Enrolled') }}</v-chip>
                                        {{-- /If Enrolled --}}
                                    </v-card-actions>
                                </v-layout>
                            </v-container>
                        </v-card-media>

                        <v-card-title primary-title>
                            <strong class="title td-n accent--text" v-html="card.title"></strong>
                        </v-card-title>

                        <v-card-actions class="transparent">
                            <span class="text-xs-center caption pa-1 grey--text">
                                <v-icon class="caption" left>class</v-icon>
                                <span v-html="card.code"></span>
                            </span>
                            <span class="text-xs-center caption pa-1 grey--text">
                                <v-icon class="caption" left>fa-tasks</v-icon>
                                <span v-html="`${card.lessons.length} Parts`"></span>
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


                        <v-card-actions>
                            <v-spacer></v-spacer>

                            @can('show-course')
                            <v-btn flat primary :href="route(urls.show, card.slug)">{{ __('Learn More') }}</v-btn>
                            @endcan

                            @can('edit-course')
                            <v-btn flat success :href="route(urls.edit, card.id)">{{ __('Edit') }}</v-btn>
                            @endcan
                        </v-card-actions>
                    </v-card>
                </v-flex>
            </template>

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
                    this.api().get('{{ route('api.courses.enrolled.index') }}', query)
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
                }
            },

            mounted () {
                this.dataset.items = {!! json_encode($resources->toArray()) !!}
                // this.get();
            },
        })
    </script>
@endpush

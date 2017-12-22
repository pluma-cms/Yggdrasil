<v-card
    class="white--text elevation-1 purple lighten-2"
    style="background: linear-gradient(141deg, #007888 0%, #00BCD4 51%, rgb(20, 146, 162) 75%);">
    <div class="insert-overlay" style="background: rgba(0, 0, 0, 0.38); position: absolute; width: 100%; height: 100%; z-index: 0;"></div>
    <v-layout row wrap>
        <v-flex sm8>
            <v-card-text>
                <v-layout row wrap class="media pb-2">
                    <div class="title">Develop Personal Effectiveness At Supervisory Level</div>
                </v-layout>
                <v-layout row wrap class="media">
                    <div class="body-1">2 lessons</div>
                </v-layout>
                    <v-btn outline class="white white--text mt-3 ml-0">
                        Continue
                    </v-btn>
            </v-card-text>
        </v-flex>
        <v-flex xs4>
            <v-card-text class="text-xs-center">
                <v-progress-circular
                    v-bind:size="100"
                    v-bind:width="10"
                    v-bind:value="value"
                    class="cyan--text text--lighten-3 ma-0"
                    >
                    @{{ value }}
                </v-progress-circular>
            </v-card-text>
        </v-flex>
    </v-layout>
</v-card>


@push('css')
    <style>
        .overlay-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
        }
        .media .card__text,
        .media div {
            z-index: 1;
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
                    year: [
                        { title: 'Daily' },
                        { title: 'Weekly' },
                        { title: 'Monthly' },
                        { title: 'Yearly' }
                    ],
                    interval: {},
                    value: 30,
                    rotate: 30,
                }
            },
            beforeDestroy () {
                clearInterval(this.interval)
            },
        })
    </script>
@endpush


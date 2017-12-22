<div class="text-xs-center">
    <v-dialog v-model="start" fullscreen transition="dialog-bottom-transition" :overlay=false>
        <v-btn round outline lighten-2 class="green--text text--lighten-1" slot="activator">Start</v-btn>
        <v-card class="grey lighten-4">
            <v-app class="application--light">

                <v-parallax class="elevation-0" src="{{ assets('frontier/images/placeholder/gradient.png') }}" height="400">
                    <v-layout row wrap align-center justify-center>
                        <div class="overlay-bg-black"></div>
                        <v-layout column class="media">
                            <v-card-title class="pa-0">
                                <v-spacer></v-spacer>
                                <v-btn dark flat @click.native="start = false">
                                    Done
                                </v-btn>
                            </v-card-title>
                            <v-card-text class="white--text text-xs-center mb-5">
                                <div class="display-2 pb-3">PS 2</div>
                                <div class="subheading mb-5">
                                    <v-flex md6 offset-md3>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</v-flex></div>
                            </v-card-text>
                            <v-card>
                        </v-layout>
                    </v-layout>
                </v-parallax>

                <v-container fluid grid-list-lg>
                    <v-layout row wrap>
                        <v-flex md3 order-lg1 order-md1 order-sm3 order-xs3 xs12>
                            <v-card class="elevation-1 card--flex-toolbar">
                                <v-toolbar light class="elevation-0 transparent">
                                    <v-toolbar-title light>Assignment</v-toolbar-title>
                                    <v-spacer></v-spacer>
                                    <v-btn icon class="grey--text text--darken-2" v-tooltip:left="{html: 'Download'}">
                                        <v-icon>file_download</v-icon>
                                    </v-btn>
                                    <v-btn icon class="grey--text text--darken-2" v-tooltip:left="{html: 'More Actions'}">
                                        <v-icon>more_vert</v-icon>
                                    </v-btn>
                                </v-toolbar>
                                <v-divider></v-divider>
                                {{-- <v-card-text class="text-xs-center" height ="200px">
                                        <img src="{{ assets('frontier/images/placeholder/empty_assignment.jpg') }}" height="170px" alt="">
                                        <div class="body-1 grey--text text-lighten-1">No assignment found in this lesson.</div>
                                        <br>
                                    <div class="mt-3">
                                        <v-btn
                                            dark
                                            fab
                                            small
                                            class="red lighten-2"
                                            elevation-0
                                            >
                                            <v-icon>add</v-icon>
                                        </v-btn>
                                    </div>
                                </v-card-text> --}}

                                <v-card-text>
                                    <div class="subheading mb-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos provident libero ea repellendus maxime totam aspernatur commodi qui vel nihil. Autem id harum itaque fugit mollitia saepe earum quis voluptatibus.</div>
                                    {{-- <div class="text-xs-right">Deadline: October 30, 2017</div> --}}
                                </v-card-text>
                                <v-toolbar class="grey lighten-4 elevation-0">
                                    <v-toolbar-title class="body-1">Deadline: 09/10/17</v-toolbar-title>
                                    <v-btn
                                        class="red lighten-2"
                                        dark
                                        small
                                        absolute
                                        top
                                        right
                                        fab
                                        v-tooltip:left="{ html: 'Add' }"
                                        >
                                        <v-icon>add</v-icon>
                                    </v-btn>
                                </v-toolbar>
                                <v-divider></v-divider>
                                <v-list two-line subheader>
                                    <v-subheader class="grey--text">List of students submitted</v-subheader>
                                    <v-list-tile ripple @click="">
                                        <v-list-tile-avatar>
                                            <img src="https://placeimg.com/640/480/any/grayscale/1" alt="">
                                        </v-list-tile-avatar>
                                        <v-list-tile-content>
                                            <v-list-tile-title>Georgina Scott</v-list-tile-title>
                                            <v-list-tile-sub-title class="green--text">Submitted: 09/09/2017</v-list-tile-sub-title>
                                        </v-list-tile-content>
                                        <v-list-tile-action>
                                            <v-icon class="green--text text--lighten-1 white--text">check_circle</v-icon>
                                        </v-list-tile-action>
                                    </v-list-tile>
                                    <v-divider inset></v-divider>

                                    <v-list-tile ripple @click="">
                                        <v-list-tile-avatar>
                                            <img src="https://placeimg.com/640/480/any/grayscale/2" alt="">
                                        </v-list-tile-avatar>
                                        <v-list-tile-content>
                                            <v-list-tile-title>Wendy</v-list-tile-title>
                                            <v-list-tile-sub-title>no date found</v-list-tile-sub-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                    <v-divider inset></v-divider>
                                    <v-list-tile ripple @click="">
                                        <v-list-tile-avatar>
                                            <img src="https://placeimg.com/640/480/any/grayscale/3" alt="">
                                        </v-list-tile-avatar>
                                        <v-list-tile-content>
                                            <v-list-tile-title>Michael Brook</v-list-tile-title>
                                            <v-list-tile-sub-title class="green--text">Submitted: 09/09/2017</v-list-tile-sub-title>
                                        </v-list-tile-content>
                                        <v-list-tile-action>
                                            <v-icon class="green--text text--lighten-1 white--text">check_circle</v-icon>
                                        </v-list-tile-action>
                                    </v-list-tile>
                                </v-list>
                            </v-card>
                        </v-flex>

                        <v-flex md6 order-lg2 order-md2 order-sm1 order-xs1 xs12>
                            <v-card class="elevation-1 card--flex-toolbar">
                                <v-toolbar dark class="elevation-0 deep-purple lighten-2">
                                    <v-toolbar-title>{{ __("Lesson Content") }}</v-toolbar-title>
                                </v-toolbar>
                                <v-divider></v-divider>
                                <v-card-text class="pb-0">
                                    <v-card class="elevation-1">
                                        <v-list two-line subheader class="pb-0">
                                            <v-list-tile avatar ripple href="http://clips.vorwaerts-gmbh.de/big_buck_bunny.mp4" target="__blank">
                                                <v-list-tile-avatar>
                                                    <v-icon success>check</v-icon>
                                                </v-list-tile-avatar>
                                                <v-list-tile-content>
                                                    <v-list-tile-title class="title">Introduction</v-list-tile-title>
                                                    <v-list-tile-sub-title>Finished</v-list-tile-sub-title>
                                                </v-list-tile-content>
                                                <v-list-tile-action>
                                                    <v-icon class="grey--text text--lighten-1">chevron_right</v-icon>
                                                </v-list-tile-action>
                                            </v-list-tile>
                                        </v-list>
                                    </v-card>
                                </v-card-text>
                                <v-card-text class="pb-0">
                                    <v-card class="elevation-1">
                                        <v-list two-line subheader class="pb-0">
                                            <v-list-tile avatar ripple href="\tests/show" target="__blank">
                                                <v-list-tile-avatar>
                                                    <v-icon warning>play_circle_outline</v-icon>
                                                </v-list-tile-avatar>
                                                <v-list-tile-content>
                                                    <v-list-tile-title class="title">Assessment</v-list-tile-title>
                                                    <v-list-tile-sub-title>Continue</v-list-tile-sub-title>
                                                </v-list-tile-content>
                                                <v-list-tile-action>
                                                    <v-icon class="grey--text text--lighten-1">chevron_right</v-icon>
                                                </v-list-tile-action>
                                            </v-list-tile>
                                        </v-list>
                                    </v-card>
                                </v-card-text>

                                <v-card-text class="pb-0">
                                    <v-card class="elevation-1">
                                        <v-list two-line subheader class="pb-0">
                                            <v-list-tile avatar ripple @click="">
                                                <v-list-tile-avatar>
                                                    <v-icon grey>lock</v-icon>
                                                </v-list-tile-avatar>
                                                <v-list-tile-content>
                                                    <v-list-tile-title class="title">Interaction</v-list-tile-title>
                                                    <v-list-tile-sub-title>Locked</v-list-tile-sub-title>
                                                </v-list-tile-content>
                                                {{-- <v-list-tile-action>
                                                    <v-icon class="grey--text text--lighten-1">chevron_right</v-icon>
                                                </v-list-tile-action> --}}
                                            </v-list-tile>
                                        </v-list>
                                    </v-card>
                                </v-card-text>

                                <v-card-text class="pb-0">
                                    <v-card class="elevation-1">
                                        <v-list two-line subheader class="pb-0">
                                            <v-list-tile avatar ripple @click="">
                                                <v-list-tile-avatar>
                                                    <v-icon grey>lock</v-icon>
                                                </v-list-tile-avatar>
                                                <v-list-tile-content>
                                                    <v-list-tile-title class="title">Animation</v-list-tile-title>
                                                    <v-list-tile-sub-title>Locked</v-list-tile-sub-title>
                                                </v-list-tile-content>
                                                {{-- <v-list-tile-action>
                                                    <v-icon class="grey--text text--lighten-1">chevron_right</v-icon>
                                                </v-list-tile-action> --}}
                                            </v-list-tile>
                                        </v-list>
                                    </v-card>
                                </v-card-text>

                                <v-card-text>
                                    <v-card class="elevation-1">
                                        <v-list two-line subheader class="pb-0">
                                            <v-list-tile avatar ripple @click="">
                                                <v-list-tile-avatar>
                                                    <v-icon grey>lock</v-icon>
                                                </v-list-tile-avatar>
                                                <v-list-tile-content>
                                                    <v-list-tile-title class="title">Scenario</v-list-tile-title>
                                                    <v-list-tile-sub-title>Locked</v-list-tile-sub-title>
                                                </v-list-tile-content>
                                                {{-- <v-list-tile-action>
                                                    <v-icon class="grey--text text--lighten-1">chevron_right</v-icon>
                                                </v-list-tile-action> --}}
                                            </v-list-tile>
                                        </v-list>
                                    </v-card>
                                </v-card-text>
                            </v-card>
                        </v-flex>

                        <v-flex md3 order-lg-3 order-md3 order-sm2 order-xs2 xs12>
                            <v-card class="elevation-1 card--flex-toolbar">
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
                                            class="deep-purple--text text--lighten-2"
                                            >
                                            @{{ value }}
                                        </v-progress-circular>
                                    </div>
                                </v-card-text>
                                <v-card-text class="text-xs-center deep-purple lighten-2">
                                    <div>
                                        <v-subheading class="white--text">Content Complete:</v-subheading>
                                    </div>
                                    <div >
                                        <v-subheading class="white--text">0/10</v-subheading>
                                    </div>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-app>
        </v-card>
    </v-dialog>
</div>

@push('css')
    <style>
        .overlay-bg-black {
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.30) !important;
            z-index: 0;
        }
        .media .card__text {
            z-index: 1;
        }
        .card--flex-toolbar {
          margin-top: -80px;
          margin-bottom: 80px;
        }
    </style>
@endpush

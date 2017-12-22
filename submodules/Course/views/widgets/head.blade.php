<v-parallax class="elevation-1" src="{{ assets('frontier/images/placeholder/gradient.png') }}" height="300">
    <v-layout row wrap align-end justify-center>
        <v-flex md8 xs12 pa-0>
            <v-toolbar class="white elevation-0">
                <v-spacer></v-spacer>
                <v-chip small class="ml-0 green white--text ml-0"> Enrolled </v-chip>
                <v-btn icon ripple v-tooltip:left="{ html: 'Add to Bookmark' }">
                    <v-icon light>bookmark_border</v-icon>
                </v-btn>
                <v-menu bottom left>
                    <v-btn icon ripple slot="activator" v-tooltip:left="{ html: 'More Actions' }">
                        <v-icon light>more_vert</v-icon>
                    </v-btn>
                    <v-list>
                        <v-list-tile @click="" ripple>
                            <v-list-tile-action>
                                <v-icon accent>edit</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-title>
                                    {{ __('Edit') }}
                                </v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile @click="" ripple>
                            <v-list-tile-action>
                                <v-icon warning>delete</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-title>
                                    {{ __('Move to Trash') }}
                                </v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    </v-list>
                </v-menu>
            </v-toolbar>
            <v-card class="elevation-0">
                <v-card-text class="pt-0">
                    <v-container fluid grid-list-lg>
                        <v-layout row wrap>
                            <v-flex md3 sm2>
                                <v-card-media
                                    src="{{ assets('frontier/images/placeholder/course-avatar.png') }}"
                                    height="125px"
                                    cover
                                    class="elevation-2"
                                    >
                                </v-card-media>
                            </v-flex>
                            <v-flex md9 sm10>
                                <div>
                                    <div class="headline">Develop Personal Effectiveness At Supervisory Level</div>
                                    <v-footer class="transparent">
                                        <v-chip label small class="pl-0 ml-0 caption transparent grey--text elevation-0">
                                            <v-icon left small class="subheading">fa-tasks</v-icon>&nbsp;
                                            <span v-html="`3 Parts`"></span>
                                        </v-chip>

                                        <v-chip label class="pl-0 ml-0 caption transparent grey--text elevation-0">
                                            <v-icon left small class="subheading">label</v-icon>
                                            <span>DPE</span>
                                        </v-chip>

                                        <v-chip label small class="pl-0 ml-0 caption transparent grey--text elevation-0">
                                            <v-icon left small class="subheading">fa-clock-o</v-icon>
                                            <span>2 days ago</span>
                                        </v-chip>
                                    </v-footer>
                                </div>
                            </v-flex>
                        </v-layout>
                    </v-container fluid grid-list-lg>
                </v-card-text>
            </v-card>
        </v-flex>
    </v-layout>
</v-parallax>

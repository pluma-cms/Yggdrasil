@extends("Theme::layouts.master")

@section("pre-container", "")

@section("root")
    @yield("content")
@endsection

@section("post-content")
    {{-- @include("Theme::partials.rightsidebar") --}}
@endsection

@section("endnote")
    <v-container fluid grid-list-lg class="pa-0">
        <v-layout row wrap>
            <v-flex xs6>
                <small>{{ $application->site->copyright }}</small>
            </v-flex>
            <v-flex xs6 class="text-xs-right">
                <small>{{ $application->version }}</small>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

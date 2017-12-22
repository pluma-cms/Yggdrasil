@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid class="pa-0">
        <pluma-packages
            :headers="[
                {text: '{{ __('ID') }}', value: 'id', align: 'left'},
                {text: '{{ __('Name') }}', value: 'name', align: 'left'},
                {text: '{{ __("File Type") }}', value: 'mimetype', align: 'left'},
                {text: '{{ __("File Size") }}', value: 'size', align: 'left'},
                {text: '{{ __("Uploaded") }}', value: 'created_at', align: 'left'},
                {text: '{{ __("Modified") }}', value: 'updated_at', align: 'left'},
            ]"
            :url="{
                GET: '{{ route('api.packages.paginated') }}',
                UPLOAD: '{{ route('api.packages.upload') }}',
            }"
            :dropzone-options="{url: '{{ route('api.packages.upload') }}', timeout: '120s', autoProcessQueue: true, parallelUploads: 1, acceptedFiles: 'application/zip,application/rar,application/octet-stream,application/x-rar-compressed,application/x-zip-compressed'}"
            :dropzone-params="{_token: '{{ csrf_token() }}'}"
            :items="{{ json_encode($resources->toArray()) }}"
            catalogue="package"
            title="{{ __('Packages') }}"
        >
            <template slot="card.actions" scope="{prop}">
                <v-card-actions class="brown--text">
                    <v-spacer></v-spacer>
                    <v-dialog full-width max-width="90vw" width="50vw">
                        <v-btn slot="activator" class="brown white--text"><v-icon left class="white--text">delete</v-icon>{{ __("Trash") }}</v-btn>
                        <v-card class="error white--text">
                            <v-card-title primary-title class="white--text"><v-icon class="display-2" left>warning</v-icon>{{ __('Moving the file to Archived!') }}</v-card-title>
                            <v-card-text class="white--text">
                                <p><strong>{{ __("Course or courses using this file will not be able to display it's contents properly.") }}</strong></p>
                                <p><strong>{{ __("It is recommended not to move this to archive if an existing course is using it.") }}</strong></p>
                                <p><strong>{{ __("Are you sure you want to proceed? (Click outside to cancel)") }}</strong></p>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <form action="{{ route('packages.many.destroy') }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <input type="hidden" name="packages[]" :value="prop.id">
                                    <v-btn type="submit" class="white error--text">{{ __("Yes, archive this file") }}</v-btn>
                                </form>
                                {{-- <v-btn class="white success--text" @click="dialog = !dialog">{{ __('Cancel') }}</v-btn> --}}
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-card-actions>
            </template>
        </pluma-packages>
    </v-container>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ assets('package/packages/dist/packages.min.css') }}">
@endpush

@push('pre-scripts')
    <script src="{{ assets('package/packages/dist/packages.min.js') }}"></script>
@endpush

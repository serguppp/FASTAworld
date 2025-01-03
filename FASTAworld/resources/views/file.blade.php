<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <br/>
                    <form id="uploadForm" action="{{ route('file.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <x-grid-component :header="'Input sequence'">
                                <input type="file" name="file" accept=".fasta, .fa">

                            @if ($errors->any())
                                <div>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </x-grid-component>

                        <br/>
                    
                        <x-grid-component :header="'Sequence type'">
                            <label for="dna" class="inline-flex items-center">
                                <input type="radio" id="dna" name="sequence_type" value="dna" class="form-radio text-indigo-600">
                                <span class="ml-2">DNA</span>
                            </label>

                            <label for="rna" class="inline-flex items-center">
                                <input type="radio" id="rna" name="sequence_type" value="rna" class="form-radio text-indigo-600">
                                <span class="ml-2">RNA</span>
                            </label>

                            <label for="protein" class="inline-flex items-center">
                                <input type="radio" id="protein" name="sequence_type" value="protein" class="form-radio text-indigo-600">
                                <span class="ml-2">Protein</span>
                            </label>

                        </x-grid-component>

                        <br/>

                    </div>

                    <x-button class="bg-indigo-600 text-white hover:bg-indigo-500 focus:ring-indigo-500" id="upload_button" type="submit">
                        Upload
                    </x-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="{{ asset('js/fileupload.js') }}"></script>

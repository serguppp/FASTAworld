<x-app-layout>
    <x-slot name="header">
        <div class="grid grid-cols-1 lg:grid-cols-[1fr_5fr] gap-4">
            <div>             
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $file->name}}
                </h2>
                <h3 class ="font-semibold text-l text-gray-600 leading-tight">
                    {{ $file -> filename}}
                </h3>
            </div>
            <div>
            <button type="button" class="text-green-600 hover:underline" onclick="window.location.href='/files/{{ $file->id }}/download'">Download FASTA</button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <x-grid-component :header="'ID'">
                        
                        @foreach ($analysis as $record)
                                <p>{{ $record['id'] }}</p>
                        @endforeach

                    </x-grid-component>

                    <br/>

                    <x-grid-component :header="'Description'">
                        
                        @foreach ($analysis as $record)
                                <p>{{ $record['description'] }}</p>
                        @endforeach

                    </x-grid-component>

                    <br/>

                    <x-grid-component :header="'Sequence'">
                        
                        @foreach ($analysis as $record)
                                <p>{{ $record['sequence'] }}</p>
                        @endforeach

                    </x-grid-component>
                    
                    <br/>

                    <x-grid-component :header="'Length'">
                        
                        @foreach ($analysis as $record)
                                <p>{{ $record['length'] }}bp</p>
                        @endforeach

                    </x-grid-component>

                    <br/>

                    <x-grid-component :header="'GC content'">
                        @foreach ($analysis as $record)
                            <p> {{ $record['GC']}}% </p>
                        @endforeach
                    </x-grid-component>

                    <br/>


                    <a href="{{ route('files') }}" class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Back to File List
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            File Details - {{ $file->filename }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">File Analysis</h3>

                    <p><strong>GC Content:</strong> {{ $gcContent }}%</p>
                    <h4 class="mt-4 mb-2 font-semibold">Nucleotide Counts:</h4>
                    <ul>
                        @foreach ($nucleotideCounts as $base => $count)
                            <li>{{ $base }}: {{ $count }}</li>
                        @endforeach
                    </ul>

                    <a href="{{ route('files.index') }}" class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Back to File List
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

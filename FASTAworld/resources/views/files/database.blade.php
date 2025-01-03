<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Database') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Uploaded Files</h3>

                    @if (session('success'))
                        <div class="mb-4 text-green-600">
                            {{ session('success') }}
                        </div>
                    @elseif (session('error'))
                        <div class="mb-4 text-red-600">
                            {{ session('error') }}
                        </div>
                    @endif

                    <table class="table-auto w-full border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2 text-left">Filename</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Type</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">User</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Uploaded At</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($files as $file)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">{{ $file->filename }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $file->type }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $file->user }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $file->created_at->format('Y-m-d H:i') }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">
                                        <a href="{{ route('files.show', $file->id) }}" class="text-blue-600 hover:underline">View</a>
                                    
                                    @if (Auth::user()->name == $file->user)
                                            <a href="{{ route('files.edit', $file->id) }}" class="text-green-600 hover:underline">Edit</a>
                                            <a href="{{ route('files.delete', $file->id) }}" class="text-red-600 hover:underline">Delete</a>
                                    @endif
                                    
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="border border-gray-300 px-4 py-2 text-center">No files found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <br/>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="{{ asset('js/fileupload.js') }}"></script>

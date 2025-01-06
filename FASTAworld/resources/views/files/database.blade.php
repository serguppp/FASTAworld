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
                                <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Type</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Author</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Uploaded At</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($files as $file)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $file->name }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2">{{ $file->type }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $file->user }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $file->created_at->format('Y-m-d H:i') }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <a href="{{ route('files.show', $file->id) }}" class="text-blue-600 hover:underline">View</a>

                                    @if (Auth::id() == $file->user_id)
                                    <button type="button" class="text-green-600 hover:underline" onclick="hnsToggle('edit-row', {{ $file->id }} )">Edit</button>
                                    <a href="{{ route('files.delete', $file->id) }}" class="text-red-600 hover:underline">Delete</a>
                                    @endif

                                </td>

                            </tr>

                            <tr id="edit-row-{{ $file->id }}" class="hidden">
                                <td colspan="5" class="border border-gray-300 px-4 py-2">
                                    <form action=" {{ route('files.update', $file->id)  }}" method="POST" class="flex items-center gap-4">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="filename" placeholder="name" class="border-gray-300 rounded px-2 py-1">
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

                                        <button type="submit" class="bg-green-500 text-white px-4 py-1 rounded hover:bg-green-600">Save</button>
                                        <button type="button" class="bg-gray-500 text-white px-4 py-1 rounded hover:bg-gray-600" onclick="hnsToggle('edit-row', {{ $file->id }})">Cancel</button>
                                        </form>
                                    </td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="4" class="border border-gray-300 px-4 py-2 text-center">No files found.</td>
                            </tr>

                            @endforelse

                        </tbody>
                    </table>

                    <br />

                </div>
            </div>
        </div>
    </div>

</x-app-layout>


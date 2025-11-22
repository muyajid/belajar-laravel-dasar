<x-admin.dash-layout :title="$title">
    {{-- Header --}}
    <div class="flex justify-between items-center mt-10 mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Classroom List</h1>

        <button 
            data-modal-target="addSubjectModal" 
            data-modal-toggle="addSubjectModal"
            class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
            + Add Subject
        </button>
    </div>

    {{-- Tabel Data Subject --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Nama Subject</th>
                    <th scope="col" class="px-6 py-3">Description</th>
                    <th scope="col" class="px-6 py-3">Guru Pengampu</th>
                    <th scope="col" class="px-6 py-3">created_at</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($subject as $i => $sub)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">{{ $i + 1 }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $sub->name }}</td>
                        <td class="px-6 py-4">{{ $sub->description }}</td>
                        <td class="px-6 py-4">
                        @if ($sub->teacher)
                            <li>{{ $sub->teacher->name }}</li>
                        @else
                            <li class="text-gray-500 italic">Belum ada guru pengampu</li>
                        @endif
                        </td>
                        <td class="px-6 py-4">{{ $sub->created_at }}</td>
                        <td class="px-6 py-4">
                            <button 
                                data-modal-target="updateSubjectroomModal-{{$sub->id}}" 
                                data-modal-toggle="updateSubjectroomModal-{{$sub->id}}"
                                class="text-white bg-blue-500 hover:bg-blue-800 font-medium rounded-lg text-sm px-2 py-2 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                                Update
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500 dark:text-gray-400">
                            Belum ada data subject.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    {{-- Modal Tambah Subject --}}
    <div id="addSubjectModal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black/50">
        <div class="relative p-4 w-full max-w-md">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Add Subject</h3>
                    <button type="button" data-modal-hide="addSubjectModal"
                        class="text-gray-400 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center">
                        ✕
                    </button>
                </div>

                <form action="{{ route('admin.subject.store') }}" method="POST" class="p-6 space-y-4">
                    @csrf
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Subject</label>
                        <input type="text" name="name" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <input type="text" name="description" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" data-modal-hide="addSubjectModal"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach($subject as $sub)
    {{-- Modal Update Classroom --}}
    <div id="updateSubjectroomModal-{{$sub->id}}" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black/50">
        <div class="relative p-4 w-full max-w-md">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Update Classroom</h3>
                    <button type="button" data-modal-hide="updateSubjectroomModal-{{$sub->id}}"
                        class="text-gray-400 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center">
                        ✕
                    </button>
                </div>

                <form action="{{ route('admin.subject.update', $sub->id) }}" method="POST" class="p-6 space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Subject</label>
                        <input type="text" name="name" required value="{{$sub->name}}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <input type="text" name="description" required value="{{$sub->description}}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" data-modal-hide="updateSubjectroomModal-{{$sub->id}}"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</x-admin.dash-layout>

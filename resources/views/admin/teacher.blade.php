<x-admin.dash-layout :title="$title">
    {{-- Header dan Tombol Tambah --}}
    <div class="flex justify-between items-center mt-10 mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Teacher List</h1>

        <button 
            data-modal-target="addTeachModal" 
            data-modal-toggle="addTeachModal"
            class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
            + Tambah Teacher Dan Subject
        </button>
    </div>

    {{-- Tabel Data Teacher --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Subject</th>
                    <th scope="col" class="px-6 py-3">Subject Description</th>
                    <th scope="col" class="px-6 py-3">Phone</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Addres</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($teacher as $i => $teach)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">{{ $i + 1 }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $teach->name }}</td>
                        <td class="px-6 py-4">{{ $teach->subject->name }}</td>
                        <td class="px-6 py-4">{{ $teach->subject->description }}</td>
                        <td class="px-6 py-4">{{ $teach->phone }}</td>
                        <td class="px-6 py-4">{{ $teach->email }}</td>
                        <td class="px-6 py-4">{{ $teach->address }}</td>
                        <td class="px-6 py-4">
                            @php
                                $dropdownId = 'teacher-dropdown-' . $teach->id;
                                $buttonId = $dropdownId . '-button';
                            @endphp

                            <button 
                                id="{{ $buttonId }}" 
                                data-dropdown-toggle="{{ $dropdownId }}" 
                                class="inline-flex items-center p-0.5 text-sm text-gray-500 hover:text-gray-800 rounded-lg">
                                <svg class="w-5 h-5" fill="currentColor">
                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"/>
                                </svg>
                            </button>

                            <div id="{{ $dropdownId }}" 
                                class="hidden z-10 w-44 bg-white rounded divide-y shadow dark:bg-gray-700">

                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                                    <li>
                                        <a href="#" 
                                            data-modal-target="updateTeachModal-{{ $teach->id }}" 
                                            data-modal-toggle="updateTeachModal-{{ $teach->id }}"
                                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            Edit
                                        </a>
                                    </li>
                                </ul>

                                <div class="py-1">
                                    <a href="#" 
                                        data-modal-target="deleteTeachModal-{{ $teach->id }}" 
                                        data-modal-toggle="deleteTeachModal-{{ $teach->id }}"
                                        class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200">
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500 dark:text-gray-400">
                            Belum ada data guru.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modal Tambah Teacher --}}
    <div id="addTeachModal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black/50">
        <div class="relative p-4 w-full max-w-md">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tambah Teacher</h3>
                    <button type="button" data-modal-hide="addTeachModal"
                        class="text-gray-400 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center">
                        ✕
                    </button>
                </div>

                <form action="{{ route('admin.teacher.store') }}" method="POST" class="p-6 space-y-4">
                    @csrf
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Teacher</label>
                        <input type="text" name="name" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subject</label>
                        <input type="text" name="subject_name" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subject Description</label>
                        <input type="text" name="subject_description" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                        <input type="text" name="phone" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                    </div>
                    
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                        <input type="text" name="address" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button" data-modal-hide="addTeachModal"
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

     @foreach ($teacher as $teach)
        <div id="updateTeachModal-{{ $teach->id }}" tabindex="-1" aria-hidden="true"
            class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black/50">

            <div class="relative p-4 w-full max-w-md">
                <div class="bg-white rounded-lg shadow dark:bg-gray-700">

                    <div class="flex justify-between p-4 border-b dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-white">Update Student</h3>
                        <button data-modal-hide="updateTeachModal-{{ $teach->id }}" class="text-gray-400 w-8 h-8">✕</button>
                    </div>

                    <form action="{{ route('admin.teacher.update', $teach->id) }}" method="POST" class="p-6 space-y-4">
                        @csrf
                        @method('PUT')

                        <input type="text" name="name" value="{{ $teach->name }}" required
                            class="bg-gray-50 border rounded-lg w-full p-2.5">

                        <input type="text" name="subject_name" value="{{ $teach->subject->name }}" required
                            class="bg-gray-50 border rounded-lg w-full p-2.5">

                        <input type="text" name="subject_description" value="{{ $teach->subject->description }}" required
                            class="bg-gray-50 border rounded-lg w-full p-2.5">

                        <input type="text" name="phone" value="{{ $teach->phone }}" required
                            class="bg-gray-50 border rounded-lg w-full p-2.5">

                        <input type="email" name="email" value="{{ $teach->email }}" required
                            class="bg-gray-50 border rounded-lg w-full p-2.5">

                        <input type="text" name="address" value="{{ $teach->address }}" required
                            class="bg-gray-50 border rounded-lg w-full p-2.5">

                        <div class="flex justify-end gap-2">
                            <button type="button" data-modal-hide="updateStudentModal-{{ $teach->id }}"
                                class="px-4 py-2 bg-gray-200 rounded-lg">Batal</button>

                            <button type="submit" class="px-4 py-2 bg-blue-700 text-white rounded-lg">Update</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    @endforeach

    {{-- MODAL DELETE PER-STUDENT --}}
    @foreach ($teacher as $teach)
        <div id="deleteTeachModal-{{ $teach->id }}" tabindex="-1" aria-hidden="true"
            class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black/50">

            <div class="relative p-4 w-full max-w-md">
                <div class="bg-white rounded-lg shadow dark:bg-gray-700">

                    <div class="p-4 border-b">
                        <h3 class="text-lg font-semibold text-white">Hapus Teacher Dan Subject?</h3>
                    </div>

                    <form action="{{ route('admin.teacher.destroy', $teach->id) }}" method="POST" class="p-6">
                        @csrf
                        @method('DELETE')

                        <p class="mb-4 text-gray-700">
                            Yakin ingin menghapus Teacher :  <b>{{ $teach->name }}</b>? dan Subject :  <b>{{ $teach->subject->name }}</b>
                        </p>

                        <div class="flex justify-end gap-2">
                            <button type="button" data-modal-hide="deleteTeachModal-{{ $teach->id }}"
                                class="px-4 py-2 bg-gray-200 rounded-lg">Batal</button>

                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg">Hapus</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    @endforeach
</x-admin.dash-layout>

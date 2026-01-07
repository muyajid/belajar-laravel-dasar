<x-admin.dash-layout :title="$title">

    {{-- Header --}}
    <div class="flex justify-between items-center mt-10 mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Student List</h1>

        <button 
            data-modal-target="addStudentModal" 
            data-modal-toggle="addStudentModal"
            class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5">
            + Tambah Student
        </button>
    </div>

    {{-- Table --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <form method="GET" class="mb-4">
    <div class="flex gap-2">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}"
            placeholder="Cari nama, email, alamat siswa...."
            class="w-full px-4 py-2 border rounded-lg text-sm"
        >
        <button 
            type="submit"
            class="px-4 py-2 bg-blue-700 text-white rounded-lg text-sm">
            Search
        </button>
    </div>
</form>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Alamat</th>
                    <th class="px-6 py-3">Kelas</th>
                    <th class="px-6 py-3">Tanggal Lahir</th>
                    <th class="px-6 py-3">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($students as $i => $student)
                    <tr class="bg-white border-b hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-600">

                        <td class="px-6 py-4">
    {{ $students->firstItem() + $i }}
</td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $student->nama }}</td>
                        <td class="px-6 py-4">{{ $student->email }}</td>
                        <td class="px-6 py-4">{{ $student->alamat }}</td>
                        <td class="px-6 py-4">{{ $student->classroom->name ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $student->tanggal_lahir }}</td>

                        <td class="px-6 py-4">
                            @php
                                $dropdownId = 'student-dropdown-' . $student->id;
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
                                            data-modal-target="updateStudentModal-{{ $student->id }}" 
                                            data-modal-toggle="updateStudentModal-{{ $student->id }}"
                                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            Edit
                                        </a>
                                    </li>
                                </ul>

                                <div class="py-1">
                                    <a href="#" 
                                        data-modal-target="deleteStudentModal-{{ $student->id }}" 
                                        data-modal-toggle="deleteStudentModal-{{ $student->id }}"
                                        class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200">
                                        Delete
                                    </a>
                                </div>

                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-500 dark:text-gray-400">
                            Belum ada data siswa.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
    {{ $students->links() }}
</div>
    </div>

    {{-- MODAL TAMBAH --}}
    <div id="addStudentModal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black/50">

        <div class="relative p-4 w-full max-w-md">
            <div class="bg-white rounded-lg shadow dark:bg-gray-700">

                <div class="flex justify-between p-4 border-b dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-white">Tambah Student</h3>
                    <button data-modal-hide="addStudentModal" class="text-gray-400 w-8 h-8">✕</button>
                </div>

                <form action="{{ route('admin.student.store') }}" method="POST" class="p-6 space-y-4">
                    @csrf

                    <input type="text" name="nama" placeholder="Nama" required
                        class="bg-gray-50 border rounded-lg w-full p-2.5">

                    <input type="email" name="email" placeholder="Email" required
                        class="bg-gray-50 border rounded-lg w-full p-2.5">

                    <input type="text" name="alamat" placeholder="Alamat" required
                        class="bg-gray-50 border rounded-lg w-full p-2.5">

                    <input type="date" name="tanggal_lahir" required
                        class="bg-gray-50 border rounded-lg w-full p-2.5">

                    <select name="class_rooms_id" required class="bg-gray-50 border rounded-lg w-full p-2.5">
                        <option value="">PIlih Classroom</option>
                        @foreach ($classrooms as $classroom)
                            <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                        @endforeach
                    </select>

                    <div class="flex justify-end gap-2">
                        <button type="button" data-modal-hide="addStudentModal"
                            class="px-4 py-2 bg-gray-200 rounded-lg">Batal</button>

                        <button type="submit" class="px-4 py-2 bg-blue-700 text-white rounded-lg">Simpan</button>
                    </div>

                </form>

            </div>
        </div>
    </div>


    {{-- MODAL UPDATE PER-STUDENT --}}
    @foreach ($students as $student)
        <div id="updateStudentModal-{{ $student->id }}" tabindex="-1" aria-hidden="true"
            class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black/50">

            <div class="relative p-4 w-full max-w-md">
                <div class="bg-white rounded-lg shadow dark:bg-gray-700">

                    <div class="flex justify-between p-4 border-b dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-white">Update Student</h3>
                        <button data-modal-hide="updateStudentModal-{{ $student->id }}" class="text-gray-400 w-8 h-8">✕</button>
                    </div>

                    <form action="{{ route('admin.student.update', $student->id) }}" method="POST" class="p-6 space-y-4">
                        @csrf
                        @method('PUT')

                        <input type="text" name="nama" value="{{ $student->nama }}" required
                            class="bg-gray-50 border rounded-lg w-full p-2.5">

                        <input type="email" name="email" value="{{ $student->email }}" required
                            class="bg-gray-50 border rounded-lg w-full p-2.5">

                        <input type="text" name="alamat" value="{{ $student->alamat }}" required
                            class="bg-gray-50 border rounded-lg w-full p-2.5">

                        <input type="date" name="tanggal_lahir" value="{{ $student->tanggal_lahir }}" required
                            class="bg-gray-50 border rounded-lg w-full p-2.5">

                        <select name="class_rooms_id" required class="bg-gray-50 border rounded-lg w-full p-2.5">
                            @foreach ($classrooms as $classroom)
                                <option value="{{ $classroom->id }}"
                                    {{ $student->class_rooms_id == $classroom->id ? 'selected' : '' }}>
                                    {{ $classroom->name }}
                                </option>
                            @endforeach
                        </select>

                        <div class="flex justify-end gap-2">
                            <button type="button" data-modal-hide="updateStudentModal-{{ $student->id }}"
                                class="px-4 py-2 bg-gray-200 rounded-lg">Batal</button>

                            <button type="submit" class="px-4 py-2 bg-blue-700 text-white rounded-lg">Update</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    @endforeach


    {{-- MODAL DELETE PER-STUDENT --}}
    @foreach ($students as $student)
        <div id="deleteStudentModal-{{ $student->id }}" tabindex="-1" aria-hidden="true"
            class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black/50">

            <div class="relative p-4 w-full max-w-md">
                <div class="bg-white rounded-lg shadow dark:bg-gray-700">

                    <div class="p-4 border-b">
                        <h3 class="text-lg font-semibold text-white">Hapus Student?</h3>
                    </div>

                    <form action="{{ route('admin.student.destroy', $student->id) }}" method="POST" class="p-6">
                        @csrf
                        @method('DELETE')

                        <p class="mb-4 text-gray-700">
                            Yakin ingin menghapus <b>{{ $student->nama }}</b>?
                        </p>

                        <div class="flex justify-end gap-2">
                            <button type="button" data-modal-hide="deleteStudentModal-{{ $student->id }}"
                                class="px-4 py-2 bg-gray-200 rounded-lg">Batal</button>

                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg">Hapus</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    @endforeach

</x-admin.dash-layout>

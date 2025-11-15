<x-admin.dash-layout :title="$title">
    {{-- Header dan Tombol Tambah --}}
    <div class="flex justify-between items-center mt-10 mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Guardians List</h1>

        <button 
            data-modal-target="addGuardiansModal" 
            data-modal-toggle="addGuardiansModal"
            class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
            + Add Guardians
        </button>
    </div>

    {{-- Tabel Data --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Job</th>
                    <th scope="col" class="px-6 py-3">Phone</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Action</th>
            </thead>
            <tbody>
                @forelse ($guardians as $i => $guard)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">{{ $i + 1 }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $guard->name }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $guard->job }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $guard->phone }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $guard->email }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            @php
                                $dropdownId = 'guardians-dropdown-' . $guard->id;
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
                                            data-modal-target="updateGuardiansModal-{{ $guard->id }}" 
                                            data-modal-toggle="updateGuardiansModal-{{ $guard->id }}"
                                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            Edit
                                        </a>
                                    </li>
                                </ul>

                                <div class="py-1">
                                    <a href="#" 
                                        data-modal-target="deleteGuardiansModal-{{ $guard->id }}" 
                                        data-modal-toggle="deleteGuardiansModal-{{ $guard->id }}"
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
                            Belum ada data guardians.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- MODAL TAMBAH --}}
    <div id="addGuardiansModal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black/50">

        <div class="relative p-4 w-full max-w-md">
            <div class="bg-white rounded-lg shadow dark:bg-gray-700">

                <div class="flex justify-between p-4 border-b dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-white">Tambah Guardians</h3>
                    <button data-modal-hide="addGuardiansModal" class="text-gray-400 w-8 h-8">✕</button>
                </div>

                <form action="{{ route('admin.guardians.store') }}" method="POST" class="p-6 space-y-4">
                    @csrf

                    <input type="text" name="name" placeholder="Nama" required
                        class="bg-gray-50 border rounded-lg w-full p-2.5">

                    <input type="text" name="job" placeholder="Job" required
                        class="bg-gray-50 border rounded-lg w-full p-2.5">

                    <input type="text" name="phone" placeholder="Phone" required
                        class="bg-gray-50 border rounded-lg w-full p-2.5">

                    <input type="email" name="email" placeholder="Email" required
                        class="bg-gray-50 border rounded-lg w-full p-2.5">

                    <div class="flex justify-end gap-2">
                        <button type="button" data-modal-hide="addGuardiansModal"
                            class="px-4 py-2 bg-gray-200 rounded-lg">Batal</button>

                        <button type="submit" class="px-4 py-2 bg-blue-700 text-white rounded-lg">Simpan</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    {{-- MODAL UPDATE PER-GUARDIANS --}}
    @foreach ($guardians as $guard)
        <div id="updateGuardiansModal-{{ $guard->id }}" tabindex="-1" aria-hidden="true"
            class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black/50">

            <div class="relative p-4 w-full max-w-md">
                <div class="bg-white rounded-lg shadow dark:bg-gray-700">

                    <div class="flex justify-between p-4 border-b dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-white">Update Guardians</h3>
                        <button data-modal-hide="updateGuardiansModal-{{ $guard->id }}" class="text-gray-400 w-8 h-8">✕</button>
                    </div>

                    <form action="{{ route('admin.guardians.update', $guard->id) }}" method="POST" class="p-6 space-y-4">
                        @csrf
                        @method('PUT')

                        <input type="text" name="name" value="{{ $guard->name }}" required
                            class="bg-gray-50 border rounded-lg w-full p-2.5">

                        <input type="text" name="job" value="{{ $guard->job }}" required
                            class="bg-gray-50 border rounded-lg w-full p-2.5">

                        <input type="text" name="phone" value="{{ $guard->phone }}" required
                            class="bg-gray-50 border rounded-lg w-full p-2.5">

                        <input type="text" name="email" value="{{ $guard->email }}" required
                            class="bg-gray-50 border rounded-lg w-full p-2.5">

                        <div class="flex justify-end gap-2">
                            <button type="button" data-modal-hide="updateGuardiansModal-{{ $guard->id }}"
                                class="px-4 py-2 bg-gray-200 rounded-lg">Batal</button>

                            <button type="submit" class="px-4 py-2 bg-blue-700 text-white rounded-lg">Update</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    @endforeach

    {{-- MODAL DELETE PER-STUDENT --}}
    @foreach ($guardians as $guard)
        <div id="deleteGuardiansModal-{{ $guard->id }}" tabindex="-1" aria-hidden="true"
            class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black/50">

            <div class="relative p-4 w-full max-w-md">
                <div class="bg-white rounded-lg shadow dark:bg-gray-700">

                    <div class="p-4 border-b">
                        <h3 class="text-lg font-semibold text-white">Hapus Guardians?</h3>
                    </div>

                    <form action="{{ route('admin.guardians.destroy', $guard->id) }}" method="POST" class="p-6">
                        @csrf
                        @method('DELETE')

                        <p class="mb-4 text-gray-700">
                            Yakin ingin menghapus <b>{{ $guard->name }}</b>?
                        </p>

                        <div class="flex justify-end gap-2">
                            <button type="button" data-modal-hide="deleteGuardiansModal-{{ $guard->id }}"
                                class="px-4 py-2 bg-gray-200 rounded-lg">Batal</button>

                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg">Hapus</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    @endforeach

</x-admin.dash-layout>
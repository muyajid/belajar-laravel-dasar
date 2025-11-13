<x-admin.dash-layout :title="$title">
    {{-- Header --}}
    <div class="flex justify-between items-center mt-10 mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Subject List</h1>
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
</x-admin.dash-layout>

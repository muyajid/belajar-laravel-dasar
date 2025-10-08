<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="w-full max-w-4xl mx-auto bg-white shadow-lg rounded-2xl p-6 mt-6">
        <h1 class="text-2xl font-bold mb-4 text-gray-700">{{ $title }}</h1>

        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse border border-gray-300 rounded-5">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="border border-gray-300 px-4 py-2">No</th>
                        <th class="border border-gray-300 px-4 py-2">Nama</th>
                        <th class="border border-gray-300 px-4 py-2">Subject Name</th>
                        <th class="border border-gray-300 px-4 py-2">Phone</th>
                        <th class="border border-gray-300 px-4 py-2">Addres</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600">
                    @foreach ($data as $teacher)
                        <tr class="hover:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $teacher->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $teacher->subject->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $teacher->phone }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $teacher->address }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>

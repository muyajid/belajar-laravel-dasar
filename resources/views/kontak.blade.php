<x-layout>
      <x-slot:title>{{ $title}}</x-slot:title>
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white shadow-lg rounded-2xl p-8 flex items-center gap-6 max-w-lg w-full">
            <!-- Avatar -->
            <div class="flex-shrink-0">
                <img 
                    src="https://png.pngtree.com/png-vector/20220709/ourmid/pngtree-businessman-user-avatar-wearing-suit-with-red-tie-png-image_5809521.png" 
                    alt="avatar"
                    class="w-28 h-28 rounded-full border-4 border-gray-200 shadow"
                >
            </div>

            <!-- Info -->
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-3">Hubungi Saya</h1>
                <ul class="space-y-2 text-gray-600">
                    <li><span class="font-semibold">No Hp:</span> {{ $noHp }}</li>
                    <li><span class="font-semibold">Email:</span> {{ $email }}</li>
                </ul>
            </div>
        </div>
    </div>
</x-layout>

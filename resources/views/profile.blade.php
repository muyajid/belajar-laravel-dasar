<x-layout>
      <x-slot:title>{{ $title}}</x-slot:title>
    <div class="container mx-auto mt-10 p-6 rounded-lg text-center">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Profile Pribadi</h1>
        
        <img 
            src="https://png.pngtree.com/png-vector/20220709/ourmid/pngtree-businessman-user-avatar-wearing-suit-with-red-tie-png-image_5809521.png" 
            alt="Profile Avatar" 
            width="200"
            class="mx-auto rounded-full border-4 border-gray-300 shadow-md mb-6"
        >

        <div class="text-left max-w-md mx-auto">
            <ul class="space-y-3 text-lg text-gray-700">
                <li><span class="font-semibold">Nama Lengkap</span> : {{ $nama }}</li>
                <li><span class="font-semibold">Tanggal Lahir</span> : {{ $tanggalLahir }}</li>
                <li><span class="font-semibold">Asal Daerah</span> : {{ $asalDaerah }}</li>
                <li><span class="font-semibold">Kelas</span> : {{ $kelas }}</li>
                <li><span class="font-semibold">Sekolah</span> : {{ $sekolah }}</li>
            </ul>
        </div>
    </div>
</x-layout>

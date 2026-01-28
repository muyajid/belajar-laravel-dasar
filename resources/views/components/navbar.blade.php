<div>
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">

                <!-- Logo & Desktop Links -->
                <div class="flex items-center">
                    <div class="shrink-0">
                        <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" 
                             alt="Your Company" 
                             class="h-8 w-8" />
                    </div>

                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <x-nav-link href="/" :active="request()->is('home')">Home</x-nav-link>
                            <x-nav-link href="/kontak" :active="request()->is('kontak')">Kontak</x-nav-link>
                            <x-nav-link href="/profile" :active="request()->is('profile')">Profile</x-nav-link>
                            <x-nav-link href="/guardians" :active="request()->is('guardians')">Guardians</x-nav-link>
                            <x-nav-link href="/datasiswa" :active="request()->is('datasiswa')">Data Siswa</x-nav-link>
                            <x-nav-link href="/classroom" :active="request()->is('classroom')">Class Room</x-nav-link>
                            <x-nav-link href="/subject" :active="request()->is('subject')">Subject</x-nav-link>
                            <x-nav-link href="/teacher" :active="request()->is('teacher')">Teacher</x-nav-link>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Profile / Login -->
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                        @if(Auth::check())
                            <!-- User logged in -->
                            <el-dropdown>
                                <button class="relative flex max-w-xs items-center rounded-full focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                                    <span class="sr-only">Open user menu</span>
                                    <img src="{{ 'https://upload.wikimedia.org/wikipedia/commons/4/49/Jefri_Nichol_in_2019.png' }}" 
                                         alt="{{ Auth::user()->name }}" 
                                         class="h-8 w-8 rounded-full outline outline-white/10 -outline-offset-1" />
                                </button>

                                <el-menu anchor="bottom end" popover class="w-48 origin-top-right rounded-md bg-white py-1 shadow-lg">
                                    <a href="/admin" class="block px-4 py-2 text-sm text-gray-700">Admin</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700">Settings</a>
                                    <form action="{{ route('admin.logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700">Sign out</button>
                                    </form>
                                </el-menu>
                            </el-dropdown>
                        @else
                            <!-- User not logged in -->
                            <a href="{{ route('login') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Login</a>
                        @endif
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="-mr-2 flex md:hidden">
                    <button type="button" command="--toggle" commandfor="mobile-menu" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-white/5 hover:text-white focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6 in-aria-expanded:hidden" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg class="h-6 w-6 not-in-aria-expanded:hidden" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <el-disclosure id="mobile-menu" hidden class="md:hidden">
            <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
                <x-nav-link href="/" :active="request()->is('home')">Home</x-nav-link>
                <x-nav-link href="/kontak" :active="request()->is('kontak')">Kontak</x-nav-link>
                <x-nav-link href="/profile" :active="request()->is('profile')">Profile</x-nav-link>
                <x-nav-link href="/guardians" :active="request()->is('guardians')">Guardians</x-nav-link>
                <x-nav-link href="/datasiswa" :active="request()->is('datasiswa')">Data Siswa</x-nav-link>
                <x-nav-link href="/classroom" :active="request()->is('classroom')">Class Room</x-nav-link>
                <x-nav-link href="/subject" :active="request()->is('subject')">Subject</x-nav-link>
                <x-nav-link href="/teacher" :active="request()->is('teacher')">Teacher</x-nav-link>
            </div>

            <div class="border-t border-white/10 pt-4 pb-3">
                <div class="px-5">
                    @if(Auth::check())
                        <div class="flex items-center">
                            <img src="{{ Auth::user()->profile_photo_url ?? 'https://via.placeholder.com/150' }}" class="h-10 w-10 rounded-full outline outline-white/10 -outline-offset-1" />
                            <div class="ml-3">
                                <div class="text-base font-medium text-white">{{ Auth::user()->name }}</div>
                                <div class="text-sm font-medium text-gray-400">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                        <div class="mt-3 space-y-1">
                            <a href="#" class="block px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white">Your profile</a>
                            <a href="#" class="block px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white">Settings</a>
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block w-full text-left px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white">Sign out</button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700">Login</a>
                    @endif
                </div>
            </div>
        </el-disclosure>
    </nav>
</div>

<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
</head>
<body class="antialiased bg-gray-50 dark:bg-gray-900">

<section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

        <div class="w-full bg-white rounded-lg shadow dark:border sm:max-w-md dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 sm:p-8">

                <h1 class="text-xl font-bold text-gray-900 dark:text-white">
                    Admin Login
                </h1>

                {{-- ERROR MESSAGE --}}
                @if ($errors->any())
                    <div class="text-sm text-red-600 bg-red-100 p-3 rounded">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.process') }}" class="space-y-4">
                    @csrf

                    {{-- EMAIL --}}
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Email
                        </label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            required
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg w-full p-2.5
                                   dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="admin@example.com"
                        >
                    </div>

                    {{-- PASSWORD --}}
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Password
                        </label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            required
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg w-full p-2.5
                                   dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="••••••••"
                        >
                    </div>

                    <button
                        type="submit"
                        class="w-full text-white bg-blue-600 hover:bg-blue-700
                               font-medium rounded-lg text-sm px-5 py-2.5">
                        Login
                    </button>
                </form>

            </div>
        </div>

    </div>
</section>

</body>
</html>

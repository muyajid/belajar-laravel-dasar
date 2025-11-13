<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'Admin Dashboard' }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
</head>
<body class="antialiased bg-gray-50 dark:bg-gray-900">
  <x-admin.dash-navbar />
  <x-admin.dash-sidebar />
  <main class="p-4 md:ml-64 h-auto pt-20">
    {{ $slot }}
  </main>
</body>
</html>
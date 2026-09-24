<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bike Lights | @yield('title', 'default')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css"
        integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite('resources/css/app.css')
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body>
    <div class="w-full min-h-screen bg-gray-200 relative">

        @include('adminpanel.common.header')

        <!-- Sidebar -->
        <div class="w-[250px] h-screen bg-white fixed left-0 top-0 shadow-lg py-5 flex flex-col gap-4">
            <img src="" alt="Login" class="mx-5">

            <hr class="w-full border-gray-300">

            @include('adminpanel.common.sidebar')
        </div>

        <!-- Main Content -->
        <div class="ml-[250px] pt-[80px] min-h-screen p-5">
            @include('adminpanel.common.breadcrumb', [
                'title' => $title,
            ])
            @yield('content')
        </div>

    </div>
    @stack('scripts')
</body>

</html>

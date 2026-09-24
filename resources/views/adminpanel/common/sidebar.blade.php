<aside class="w-full h-screen flex flex-col gap-2 justify-start items-start p-2">
    <a href="{{ route('admin.dashboard') }}"
        class=" hover:bg-zinc-200 transition-all duration-150 cursor-pointer rounded-md w-full px-4 py-2 text-md font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-zinc-200' : 'bg-zinc-200/25' }}"><i
            class="fa-regular fa-house"></i> Dashboard</a>
    <a href="{{ route('users') }}"
        class=" hover:bg-zinc-200 transition-all duration-150 cursor-pointer rounded-md w-full px-4 py-2 text-md font-medium {{ request()->routeIs('users') ? 'bg-zinc-200' : 'bg-zinc-200/25' }}"><i
            class="fa-solid fa-users"></i> Users</a>

    <a href="{{ route('products.list') }}"
        class=" hover:bg-zinc-200 transition-all duration-150 cursor-pointer rounded-md w-full px-4 py-2 text-md font-medium {{ request()->routeIs('products.list') ? 'bg-zinc-200' : 'bg-zinc-200/25' }}">
        <i class="fa-brands fa-opencart"></i> Products</a>
</aside>

<nav class="flex items-center text-sm text-gray-500 mb-5" aria-label="Breadcrumb">

    <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-900 transition">
        Dashboard
    </a>

    @if (!request()->routeIs('admin.dashboard'))
        <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>

        <span class="font-medium text-gray-800">
            {{ $title ?? ucfirst(str_replace('-', ' ', request()->segment(2))) }}
        </span>
    @endif

</nav>

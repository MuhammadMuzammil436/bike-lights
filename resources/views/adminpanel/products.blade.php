@extends('adminpanel.common.layout')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div class="w-full bg-white rounded-xl shadow-lg p-5">
        @if (session('success'))
            <div class="mb-4 rounded-lg bg-green-100 px-4 py-3 text-sm font-medium text-green-700">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="mb-4 rounded-lg bg-red-100 px-4 py-3 text-sm font-medium text-red-700">
                {{ session('error') }}
            </div>
        @endif
        {{-- All errors --}}
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-md">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif
        <button id="openProductModal" type="button"
            class="inline-flex items-center gap-2 rounded-lg
           bg-zinc-900 px-4 py-2.5
           text-sm font-semibold text-white
           shadow-sm
           transition-all duration-200
           hover:bg-zinc-800 hover:-translate-y-0.5 hover:shadow-md
           active:translate-y-0
           focus:outline-none focus:ring-2
           focus:ring-zinc-400 focus:ring-offset-2 cursor-pointer">
            {{-- <i class="fa-solid fa-plus text-xs"></i> --}}
            <i class="fa-solid fa-cart-plus text-xs"></i>
            Create New Product
        </button>
        <div id="userModal" class="fixed inset-0 z-50 hidden items-center justify-center">
            {{-- Overlay --}}
            <div id="modalOverlay" class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>

            {{-- Modal --}}
            <div id="modalContent"
                class="relative w-full max-w-lg mx-4
               rounded-xl bg-white shadow-2xl
               opacity-0 scale-95
               transition-all duration-200">

                {{-- Header --}}
                <div class="flex items-center justify-between
                    border-b border-zinc-200 px-6 py-4">

                    <div>
                        <h2 class="text-lg font-semibold text-zinc-900">
                            Create New Product
                        </h2>

                        <p class="mt-1 text-sm text-zinc-500">
                            Add a new product to your catalog. Enter the product details, pricing, and stock information
                            below.
                        </p>
                    </div>

                    <button id="closeProductModal" type="button"
                        class="flex h-8 w-8 items-center justify-center
                       rounded-lg text-zinc-400
                       hover:bg-zinc-100 hover:text-zinc-700
                       transition cursor-pointer">
                        <i class="fa-solid fa-xmark"></i>
                    </button>

                </div>

                {{-- Body --}}
                <form action="{{ route('products.add') }}" method="POST" class="p-6">
                    @csrf

                    <div class="space-y-4">

                        {{-- Name --}}
                        <div>
                            <label for="product name" class="mb-1.5 block text-sm font-medium text-zinc-700">
                                product name
                            </label>

                            <input type="text" id="product-name" name="product_name" placeholder="product name"
                                class="w-full rounded-lg border border-zinc-300
                               bg-white px-3 py-2.5 text-sm
                               text-zinc-900 outline-none
                               transition
                               focus:border-zinc-900
                               focus:ring-2 focus:ring-zinc-900/10">
                        </div>

                        {{-- Email --}}

                        <div>
                            <label for="description" class="mb-1.5 block text-sm font-medium text-zinc-700">
                                Description
                            </label>

                            <textarea id="description" name="description" rows="5" placeholder="Enter product description..."
                                class="w-full rounded-lg border border-zinc-300
               bg-white px-3 py-2.5 text-sm
               text-zinc-900 outline-none
               transition resize-none
               focus:border-zinc-900
               focus:ring-2 focus:ring-zinc-900/10">{{ old('description') }}</textarea>

                            @error('description')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>


                        {{-- Price --}}
                        <div>
                            <label for="price" class="mb-1.5 block text-sm font-medium text-zinc-700">
                                Price
                            </label>

                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-sm text-zinc-500">
                                    PKR
                                </span>

                                <input type="number" id="price" name="price" value="{{ old('price') }}"
                                    placeholder="0.00" min="0" step="0.01"
                                    class="w-full rounded-lg border border-zinc-300
                                    bg-white py-2.5 pl-12 pr-3 text-sm
                                    text-zinc-900 outline-none
                                    transition
                                    focus:border-zinc-900
                                    focus:ring-2 focus:ring-zinc-900/10
                                    @error('price') border-red-500 @enderror">
                            </div>

                            @error('price')
                                <p class="mt-1 text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        {{-- Compare at Price --}}
                        <div>
                            <label for="compare_at_price" class="mb-1.5 block text-sm font-medium text-zinc-700">
                                Compare at Price
                            </label>

                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-sm text-zinc-500">
                                    PKR
                                </span>

                                <input type="number" id="compare_at_price" name="compare_at_price"
                                    value="{{ old('compare_at_price') }}" placeholder="0.00" min="0" step="0.01"
                                    class="w-full rounded-lg border border-zinc-300
                   bg-white py-2.5 pl-12 pr-3 text-sm
                   text-zinc-900 outline-none
                   transition
                   focus:border-zinc-900
                   focus:ring-2 focus:ring-zinc-900/10
                   @error('compare_at_price') border-red-500 @enderror">
                            </div>

                            <p class="mt-1 text-xs text-zinc-500">
                                Original price before any discount.
                            </p>

                            @error('compare_at_price')
                                <p class="mt-1 text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>



                        {{-- Stock Alert Quantity --}}
                        <div>
                            <label for="stock_alert_quantity" class="mb-1.5 block text-sm font-medium text-zinc-700">
                                Stock Alert Quantity
                            </label>

                            <input type="number" id="stock_alert_quantity" name="stock_alert_quantity"
                                value="{{ old('stock_alert_quantity', 5) }}" placeholder="5" min="0" step="1"
                                class="w-full rounded-lg border border-zinc-300
               bg-white px-3 py-2.5 text-sm
               text-zinc-900 outline-none
               transition
               focus:border-zinc-900
               focus:ring-2 focus:ring-zinc-900/10
               @error('stock_alert_quantity') border-red-500 @enderror">

                            @error('stock_alert_quantity')
                                <p class="mt-1 text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>



                    </div>

                    {{-- Footer --}}
                    <div class="mt-6 flex justify-end gap-3">

                        <button type="button" id="cancelProductModal"
                            class="rounded-lg border border-zinc-300
                           bg-white px-4 py-2.5
                           text-sm font-medium text-zinc-700
                           hover:bg-zinc-50 transition cursor-pointer">
                            Cancel
                        </button>

                        <button type="submit"
                            class="inline-flex items-center gap-2
                           rounded-lg bg-zinc-900
                           px-4 py-2.5
                           text-sm font-semibold text-white
                           hover:bg-zinc-800
                           transition cursor-pointer">
                            <i class="fa-solid fa-check text-xs"></i>
                            Create User
                        </button>

                    </div>

                </form>

            </div>
        </div>

        <div class="mt-5 overflow-hidden rounded-xl border border-zinc-200 bg-white shadow-sm">

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-zinc-600">
                    {{-- Table Header --}}
                    <thead class="bg-zinc-50 text-xs uppercase tracking-wider text-zinc-500">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-semibold">
                                #
                            </th>

                            <th scope="col" class="px-6 py-4 font-semibold">
                                Name
                            </th>

                            <th scope="col" class="px-6 py-4 font-semibold">
                                Email
                            </th>

                            <th scope="col" class="px-6 py-4 font-semibold">
                                Status
                            </th>

                            <th scope="col" class="px-6 py-4 text-right font-semibold">
                                Action
                            </th>
                        </tr>
                    </thead>

                    {{-- Table Body --}}
                    <tbody class="divide-y divide-zinc-100">

                        {{-- @forelse($users as $user)
                            <tr class="transition-colors duration-150 hover:bg-zinc-50">
                                <td class="px-6 py-4">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-6 py-4 font-medium text-zinc-900">
                                    {{ $user->name }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $user->email }}
                                </td>

                                <td class="px-6 py-4">
                                    @if ($user->is_active)
                                        <span
                                            class="rounded-full bg-green-100 px-2.5 py-1
                                 text-xs font-medium text-green-700">
                                            Active
                                        </span>
                                    @else
                                        <span
                                            class="rounded-full bg-red-100 px-2.5 py-1
                                 text-xs font-medium text-red-700">
                                            Inactive
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <a href="" class="mr-2 text-sm font-medium text-blue-600 hover:underline">
                                        Edit
                                    </a>

                                    <form action="" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="rounded-lg bg-red-50 px-3 py-2
                                                    text-xs font-semibold text-red-600
                                                    hover:bg-red-100">
                                            <i class="fa-solid fa-trash mr-1 text-[11px]"></i>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-zinc-500">
                                    No users found.
                                </td>
                            </tr>
                        @endforelse --}}

                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        const openButton = document.getElementById('openProductModal');
        const closeButton = document.getElementById('closeProductModal');
        const cancelButton = document.getElementById('cancelProductModal');
        const overlay = document.getElementById('modalOverlay');

        const modal = document.getElementById('userModal');
        const modalContent = document.getElementById('modalContent');

        function openModal() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            document.body.classList.add('overflow-hidden');

            setTimeout(() => {
                modalContent.classList.remove('opacity-0', 'scale-95');
                modalContent.classList.add('opacity-100', 'scale-100');
            }, 10);
        }

        function closeModal() {
            modalContent.classList.remove('opacity-100', 'scale-100');
            modalContent.classList.add('opacity-0', 'scale-95');

            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');

                document.body.classList.remove('overflow-hidden');
            }, 200);
        }

        openButton.addEventListener('click', openModal);

        closeButton.addEventListener('click', closeModal);

        cancelButton.addEventListener('click', closeModal);

        overlay.addEventListener('click', closeModal);

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });
    </script>
@endpush

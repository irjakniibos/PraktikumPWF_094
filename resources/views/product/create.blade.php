<x-app-layout>
    <div class="min-h-screen bg-slate-950 py-10 text-slate-100">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-3xl border border-white/10 bg-slate-900/90 shadow-2xl shadow-black/30">
                <div class="absolute -top-20 right-0 h-56 w-56 rounded-full bg-indigo-500/10 blur-3xl"></div>
                <div class="relative p-6 sm:p-8 lg:p-10">
                    <div class="flex items-start gap-4">
                        <a href="{{ route('product.index') }}"
                            class="mt-1 inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-white/10 bg-white/5 text-slate-300 transition hover:border-white/20 hover:bg-white/10 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                        <div class="flex-1">
                            <p class="inline-flex items-center rounded-full border border-indigo-400/25 bg-indigo-400/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-indigo-200">
                                Create Product
                            </p>
                            <h2 class="mt-4 text-3xl font-semibold tracking-tight text-white">Add Product</h2>
                            <p class="mt-2 text-sm leading-6 text-slate-300">Fill in the product details. Admin can assign ownership, while user data is attached to the logged-in account automatically.</p>
                        </div>
                    </div>

                    <form action="{{ route('product.store') }}" method="POST" class="mt-8 space-y-6">
                        @csrf

                        {{-- Name --}}
                        <div class="space-y-2">
                            <label for="name"
                                class="block text-sm font-medium text-slate-200">
                                Product Name <span class="text-rose-400">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                placeholder="e.g. Wireless Headphones"
                                class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder:text-slate-500 outline-none transition focus:border-indigo-400/40 focus:bg-white/10 focus:ring-4 focus:ring-indigo-500/10">
                            @error('name')
                                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Category --}}
                        <div class="space-y-2">
                            <label for="category_id"
                                class="block text-sm font-medium text-slate-200">
                                Category <span class="text-rose-400">*</span>
                            </label>
                            <select id="category_id" name="category_id"
                                class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white outline-none transition focus:border-indigo-400/40 focus:bg-white/10 focus:ring-4 focus:ring-indigo-500/10">
                                <option value="" style="color:#0f172a; background-color:#e2e8f0;">-- Select Category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        style="color:#0f172a; background-color:#f8fafc;"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Quantity & Price --}}
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="space-y-2">
                                <label for="quantity"
                                    class="block text-sm font-medium text-slate-200">
                                    Quantity <span class="text-rose-400">*</span>
                                </label>
                                <input type="number" id="quantity" name="quantity" value="{{ old('quantity') }}"
                                    placeholder="0" min="0"
                                    class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder:text-slate-500 outline-none transition focus:border-indigo-400/40 focus:bg-white/10 focus:ring-4 focus:ring-indigo-500/10">
                                @error('quantity')
                                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="price"
                                    class="block text-sm font-medium text-slate-200">
                                    Price (Rp) <span class="text-rose-400">*</span>
                                </label>
                                <input type="number" id="price" name="price" value="{{ old('price') }}"
                                    placeholder="0" min="0" step="0.01"
                                    class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder:text-slate-500 outline-none transition focus:border-indigo-400/40 focus:bg-white/10 focus:ring-4 focus:ring-indigo-500/10">
                                @error('price')
                                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- User --}}
                        <div class="space-y-2">
                            <label for="user_id"
                                class="block text-sm font-medium text-slate-200">
                                Owner <span class="text-rose-400">*</span>
                            </label>
                            @if(auth()->user()->role === 'admin')
                                <select id="user_id" name="user_id"
                                    class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white outline-none transition focus:border-indigo-400/40 focus:bg-white/10 focus:ring-4 focus:ring-indigo-500/10">
                                    <option value="" style="color:#0f172a; background-color:#e2e8f0;">-- Select Owner --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            style="color:#0f172a; background-color:#f8fafc;"
                                            {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            @else
                                <input type="text" value="{{ auth()->user()->name }} (You)" disabled
                                    class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-slate-300" />
                            @endif
                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center justify-end gap-3 border-t border-white/10 pt-6">
                            <a href="{{ route('product.index') }}"
                                class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm font-semibold text-slate-200 transition hover:bg-white/10">
                                Cancel
                            </a>
                            <button type="submit"
                                class="rounded-2xl bg-gradient-to-r from-indigo-500 to-cyan-500 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/20 transition hover:-translate-y-0.5">
                                Save Product
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
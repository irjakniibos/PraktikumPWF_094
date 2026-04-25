<x-app-layout>
    <div class="min-h-screen bg-slate-950 py-6 sm:py-8 text-slate-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-2xl border border-slate-700/80 bg-slate-800/90 shadow-2xl shadow-black/30">
                <div class="absolute -top-20 right-0 h-56 w-56 rounded-full bg-cyan-500/10 blur-3xl"></div>
                <div class="relative p-6 sm:p-8">
                    <div class="flex flex-col gap-6 sm:flex-row sm:items-start sm:justify-between">
                        <div class="flex items-start gap-4">
                            <a href="{{ route('product.index') }}"
                                class="mt-0.5 inline-flex h-9 w-9 items-center justify-center text-slate-400 transition hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>
                            <div>
                                <h2 class="text-3xl font-semibold tracking-tight text-white">Product Detail</h2>
                                <p class="mt-2 text-sm text-slate-400">Viewing product #{{ $product->id }}</p>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-3">
                            @can('update', $product)
                                <x-edit-product :url="route('product.edit', $product)" :label="'Edit'" />
                            @endcan

                            @can('delete', $product)
                                <x-delete-product
                                    :action="route('product.delete', $product->id)"
                                    :label="'Delete'"
                                    :confirm-message="'Are you sure you want to delete this product?'"
                                />
                            @endcan
                        </div>
                    </div>

                    <div class="mt-8 overflow-hidden rounded-2xl border border-slate-700/80 bg-slate-800/40 backdrop-blur">
                        <dl class="divide-y divide-slate-700/80">
                            <div class="grid gap-3 px-6 py-6 sm:grid-cols-[210px_1fr] sm:items-center">
                                <dt class="text-lg font-medium text-slate-400">Product Name</dt>
                                <dd class="text-base font-semibold text-white">{{ $product->name }}</dd>
                            </div>

                            <div class="grid gap-3 px-6 py-6 sm:grid-cols-[210px_1fr] sm:items-center">
                                <dt class="text-lg font-medium text-slate-400">Quantity</dt>
                                <dd>
                                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $product->qty > 10 ? 'bg-emerald-500/15 text-emerald-300 ring-1 ring-emerald-400/20' : 'bg-rose-500/15 text-rose-300 ring-1 ring-rose-400/20' }}">
                                        {{ $product->qty }} {{ $product->qty > 10 ? 'In Stock' : 'Low Stock' }}
                                    </span>
                                </dd>
                            </div>

                            <div class="grid gap-3 px-6 py-6 sm:grid-cols-[210px_1fr] sm:items-center">
                                <dt class="text-lg font-medium text-slate-400">Price</dt>
                                <dd class="text-base font-semibold text-white">Rp {{ number_format($product->price, 0, ',', '.') }}</dd>
                            </div>

                            <div class="grid gap-3 px-6 py-6 sm:grid-cols-[210px_1fr] sm:items-center">
                                <dt class="text-lg font-medium text-slate-400">Owner</dt>
                                <dd class="flex items-center gap-3 text-white">
                                    <div class="flex h-9 w-9 items-center justify-center rounded-2xl bg-indigo-500/15 text-sm font-semibold text-indigo-200 ring-1 ring-indigo-400/20">
                                        {{ substr($product->user->name ?? '?', 0, 1) }}
                                    </div>
                                    <span>{{ $product->user->name ?? '-' }}</span>
                                </dd>
                            </div>

                            <div class="grid gap-3 px-6 py-6 sm:grid-cols-[210px_1fr] sm:items-center">
                                <dt class="text-lg font-medium text-slate-400">Category</dt>
                                <dd class="text-white">{{ $product->category->name ?? '-' }}</dd>
                            </div>

                            <div class="grid gap-3 px-6 py-6 sm:grid-cols-[210px_1fr] sm:items-center">
                                <dt class="text-lg font-medium text-slate-400">Created At</dt>
                                <dd class="text-slate-200">{{ $product->created_at->format('d M Y, H:i') }}</dd>
                            </div>

                            <div class="grid gap-3 px-6 py-6 sm:grid-cols-[210px_1fr] sm:items-center">
                                <dt class="text-lg font-medium text-slate-400">Updated At</dt>
                                <dd class="text-slate-200">{{ $product->updated_at->format('d M Y, H:i') }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
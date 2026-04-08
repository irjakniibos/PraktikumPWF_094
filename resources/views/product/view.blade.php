<x-app-layout>
    <div class="min-h-screen bg-slate-950 py-10 text-slate-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-3xl border border-white/10 bg-slate-900/90 shadow-2xl shadow-black/30">
                <div class="absolute -top-20 right-0 h-56 w-56 rounded-full bg-cyan-500/10 blur-3xl"></div>
                <div class="relative p-6 sm:p-8 lg:p-10">
                    <div class="flex flex-col gap-6 sm:flex-row sm:items-start sm:justify-between">
                        <div class="flex items-start gap-4">
                            <a href="{{ route('product.index') }}"
                                class="mt-1 inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-white/10 bg-white/5 text-slate-300 transition hover:border-white/20 hover:bg-white/10 hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>
                            <div>
                                <p class="inline-flex items-center rounded-full border border-cyan-400/25 bg-cyan-400/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-cyan-200">
                                    Product Detail
                                </p>
                                <h2 class="mt-4 text-3xl font-semibold tracking-tight text-white">{{ $product->name }}</h2>
                                <p class="mt-2 text-sm text-slate-400">Viewing product #{{ $product->id }}</p>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-3">
                            @can('update', $product)
                                <a href="{{ route('product.edit', $product) }}"
                                    class="inline-flex items-center gap-2 rounded-2xl border border-amber-400/20 bg-amber-400/10 px-4 py-2.5 text-sm font-semibold text-amber-200 transition hover:bg-amber-400/20">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </a>
                            @endcan

                            @can('delete', $product)
                                <form action="{{ route('product.delete', $product->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center gap-2 rounded-2xl border border-rose-400/20 bg-rose-400/10 px-4 py-2.5 text-sm font-semibold text-rose-200 transition hover:bg-rose-400/20">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>

                    <div class="mt-8 overflow-hidden rounded-3xl border border-white/10 bg-white/5 backdrop-blur">
                        <dl class="divide-y divide-white/10">
                            <div class="grid gap-3 px-5 py-5 sm:grid-cols-[180px_1fr] sm:items-center">
                                <dt class="text-sm uppercase tracking-[0.18em] text-slate-400">Product Name</dt>
                                <dd class="text-base font-semibold text-white">{{ $product->name }}</dd>
                            </div>

                            <div class="grid gap-3 px-5 py-5 sm:grid-cols-[180px_1fr] sm:items-center">
                                <dt class="text-sm uppercase tracking-[0.18em] text-slate-400">Quantity</dt>
                                <dd>
                                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $product->qty > 10 ? 'bg-emerald-500/15 text-emerald-300 ring-1 ring-emerald-400/20' : 'bg-rose-500/15 text-rose-300 ring-1 ring-rose-400/20' }}">
                                        {{ $product->qty }} {{ $product->qty > 10 ? 'In Stock' : 'Low Stock' }}
                                    </span>
                                </dd>
                            </div>

                            <div class="grid gap-3 px-5 py-5 sm:grid-cols-[180px_1fr] sm:items-center">
                                <dt class="text-sm uppercase tracking-[0.18em] text-slate-400">Price</dt>
                                <dd class="text-base font-semibold text-white">Rp {{ number_format($product->price, 0, ',', '.') }}</dd>
                            </div>

                            <div class="grid gap-3 px-5 py-5 sm:grid-cols-[180px_1fr] sm:items-center">
                                <dt class="text-sm uppercase tracking-[0.18em] text-slate-400">Owner</dt>
                                <dd class="flex items-center gap-3 text-white">
                                    <div class="flex h-9 w-9 items-center justify-center rounded-2xl bg-indigo-500/15 text-sm font-semibold text-indigo-200 ring-1 ring-indigo-400/20">
                                        {{ substr($product->user->name ?? '?', 0, 1) }}
                                    </div>
                                    <span>{{ $product->user->name ?? '-' }}</span>
                                </dd>
                            </div>

                            <div class="grid gap-3 px-5 py-5 sm:grid-cols-[180px_1fr] sm:items-center">
                                <dt class="text-sm uppercase tracking-[0.18em] text-slate-400">Created At</dt>
                                <dd class="text-slate-200">{{ $product->created_at->format('d M Y, H:i') }}</dd>
                            </div>

                            <div class="grid gap-3 px-5 py-5 sm:grid-cols-[180px_1fr] sm:items-center">
                                <dt class="text-sm uppercase tracking-[0.18em] text-slate-400">Updated At</dt>
                                <dd class="text-slate-200">{{ $product->updated_at->format('d M Y, H:i') }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
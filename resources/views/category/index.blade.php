<x-app-layout>
    <div class="min-h-screen bg-slate-900 py-10 text-slate-100">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-slate-700 bg-slate-800/90 p-6 shadow-2xl shadow-black/20 sm:p-8">
                <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                    <div>
                        <h2 class="text-3xl font-bold text-slate-100">Category List</h2>
                        <p class="mt-1 text-sm text-slate-400">Manage product categories and see the number of products in each category.</p>
                    </div>

                    @can('manage-category')
                        <a href="{{ route('category.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-cyan-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/20 transition hover:-translate-y-0.5">
                            <span class="text-lg leading-none">+</span>
                            Add Category
                        </a>
                    @endcan
                </div>

                @if (session('success'))
                    <div class="mb-4 rounded-xl border border-emerald-500/40 bg-emerald-500/10 px-4 py-2 text-sm text-emerald-200">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-hidden rounded-xl border border-slate-700">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-700 text-sm text-slate-200">
                            <thead class="bg-slate-700/70 text-xs uppercase tracking-wider text-slate-300">
                                <tr>
                                    <th class="px-6 py-4 text-left">#</th>
                                    <th class="px-6 py-4 text-left">Name</th>
                                    <th class="px-6 py-4 text-left">Total Product</th>
                                    <th class="px-6 py-4 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-700 bg-slate-800/60">
                                @forelse ($categories as $category)
                                    <tr class="hover:bg-slate-700/40">
                                        <td class="px-6 py-4 text-slate-400">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 font-semibold text-slate-100">{{ $category->name }}</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex rounded-full bg-cyan-500/15 px-2.5 py-0.5 text-xs font-semibold text-cyan-300">
                                                {{ $category->products_count }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-center gap-2">
                                                @can('manage-category')
                                                    <a href="{{ route('category.edit', $category) }}" class="rounded-lg border border-amber-400/40 px-3 py-1.5 text-xs font-semibold text-amber-300 transition hover:bg-amber-500/10">
                                                        Edit
                                                    </a>

                                                    <form action="{{ route('category.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="rounded-lg border border-rose-500/40 px-3 py-1.5 text-xs font-semibold text-rose-300 transition hover:bg-rose-500/10">
                                                            Delete
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-xs text-slate-500">View only</span>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-10 text-center text-slate-400">No categories found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
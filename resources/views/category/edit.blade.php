<x-app-layout>
    <div class="min-h-screen bg-slate-950 py-10 text-slate-100">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-3xl border border-white/10 bg-slate-900/90 shadow-2xl shadow-black/30">
                <div class="absolute -top-20 left-0 h-56 w-56 rounded-full bg-amber-500/10 blur-3xl"></div>
                <div class="relative p-6 sm:p-8 lg:p-10">
                    <div class="flex items-start gap-4">
                        <a href="{{ route('category.index') }}"
                            class="mt-1 inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-white/10 bg-white/5 text-slate-300 transition hover:border-white/20 hover:bg-white/10 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                        <div class="flex-1">
                            <p class="inline-flex items-center rounded-full border border-amber-400/25 bg-amber-400/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-amber-200">
                                Edit Category
                            </p>
                            <h2 class="mt-4 text-3xl font-semibold tracking-tight text-white">Update Category</h2>
                            <p class="mt-2 text-sm leading-6 text-slate-300">Update the category name carefully so existing products stay organized.</p>
                        </div>
                    </div>

                    <form action="{{ route('category.update', $category) }}" method="POST" class="mt-8 space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-medium text-slate-200">
                                Category Name <span class="text-rose-400">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}"
                                placeholder="e.g. Elektronik"
                                class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder:text-slate-500 outline-none transition focus:border-indigo-400/40 focus:bg-white/10 focus:ring-4 focus:ring-indigo-500/10">
                            @error('name')
                                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end gap-3 border-t border-white/10 pt-6">
                            <a href="{{ route('category.index') }}"
                                class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm font-semibold text-slate-200 transition hover:bg-white/10">
                                Cancel
                            </a>
                            <button type="submit"
                                class="rounded-2xl bg-gradient-to-r from-indigo-500 to-cyan-500 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/20 transition hover:-translate-y-0.5">
                                Update Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
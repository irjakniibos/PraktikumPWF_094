<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-gray-800">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="text-sm uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">Account Role</p>
                    <p class="mt-2 text-2xl font-semibold text-slate-900 dark:text-white">
                        Role: {{ Auth::user()->role === 'admin' ? 'Admin' : 'User' }}
                    </p>
                    <p class="mt-3 text-sm text-slate-600 dark:text-slate-300">
                        {{ Auth::user()->role === 'admin' ? 'You can manage products and categories.' : 'You can view products and categories, while write access remains limited.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
	<div class="min-h-screen bg-slate-900 py-10">
		<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
			<div class="rounded-2xl border border-slate-700 bg-slate-800/90 p-6 sm:p-8">
				<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
					<div>
						<h2 class="text-3xl font-bold text-slate-100">Product List</h2>
						<p class="mt-1 text-sm text-slate-400">Manage your product inventory</p>
					</div>
					<div class="flex flex-wrap gap-3">
						@can('manage-products')
							<x-add-product :url="route('product.create')" :name="'Product'" />
						@endcan
						@can('export-product')
							<a href="{{ route('product.export') }}" class="inline-flex items-center gap-2 rounded-xl border border-emerald-400 px-4 py-2.5 text-sm font-semibold text-emerald-300 hover:bg-emerald-500/10">
								<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
								</svg>
								Export
							</a>
						@endcan
						@can('create', \App\Models\Product::class)
							<x-add-product :url="route('product.create')" :name="'Product'" />
						@endcan
					</div>
				</div>

				<div class="mb-4 rounded-xl border border-slate-600 bg-slate-700/50 px-4 py-2 text-sm text-slate-200">
					Role: {{ Auth::user()->role === 'admin' ? 'Admin' : 'User' }}. {{ Auth::user()->role === 'admin' ? 'You can edit and delete any product.' : 'You can edit and delete only your own product.' }}
				</div>

				@if (session('success'))
					<div class="mb-4 rounded-xl border border-emerald-500/40 bg-emerald-500/10 px-4 py-2 text-sm text-emerald-200">
						{{ session('success') }}
					</div>
				@endif

				@if (session('error'))
					<div class="mb-4 rounded-xl border border-rose-500/40 bg-rose-500/10 px-4 py-2 text-sm text-rose-200">
						{{ session('error') }}
					</div>
				@endif

				<div class="overflow-hidden rounded-xl border border-slate-700">
					<div class="overflow-x-auto">
						<table class="min-w-full divide-y divide-slate-700 text-sm text-slate-200">
							<thead class="bg-slate-700/70 text-xs uppercase tracking-wider text-slate-300">
								<tr>
									<th class="px-6 py-4 text-left">#</th>
									<th class="px-6 py-4 text-left">Name</th>
									<th class="px-6 py-4 text-left">Quantity</th>
									<th class="px-6 py-4 text-left">Price</th>
									<th class="px-6 py-4 text-left">Category</th>
									<th class="px-6 py-4 text-left">Owner</th>
									<th class="px-6 py-4 text-center">Actions</th>
								</tr>
							</thead>
							<tbody class="divide-y divide-slate-700 bg-slate-800/60">
								@forelse ($products as $product)
									<tr class="hover:bg-slate-700/40">
										<td class="px-6 py-4 text-slate-400">{{ $loop->iteration }}</td>
										<td class="px-6 py-4 font-semibold text-slate-100">
											{{ $product->name }}
											@if($product->user_id === Auth::id())
												<span class="ml-2 inline-flex rounded-full border border-indigo-400/40 bg-indigo-500/10 px-2 py-0.5 text-xs text-indigo-200">Milikmu</span>
											@endif
										</td>
										<td class="px-6 py-4">
											<span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $product->qty > 10 ? 'bg-emerald-500/20 text-emerald-300' : 'bg-rose-500/20 text-rose-300' }}">{{ $product->qty }}</span>
										</td>
										<td class="px-6 py-4 font-medium text-slate-100">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
										<td class="px-6 py-4 text-slate-300">{{ $product->category->name ?? '-' }}</td>
										<td class="px-6 py-4 text-slate-300">{{ $product->user->name ?? '-' }}</td>
										<td class="px-6 py-4">
											<div class="flex items-center justify-center gap-2">
												<a href="{{ route('product.show', $product->id) }}" class="text-slate-300 hover:text-white" title="View">
													<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
														<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
														<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
													</svg>
												</a>
												@can('update', $product)
													<a href="{{ route('product.edit', $product) }}" class="text-slate-300 hover:text-amber-300" title="Edit">
														<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
															<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
														</svg>
													</a>
												@endcan
												@can('delete', $product)
													<form action="{{ route('product.delete', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
														@csrf
														@method('DELETE')
														<button type="submit" class="text-slate-300 hover:text-rose-300" title="Delete">
															<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
																<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
															</svg>
														</button>
													</form>
												@endcan
											</div>
										</td>
									</tr>
								@empty
									<tr>
										<td colspan="7" class="px-6 py-10 text-center text-slate-400">No products found.</td>
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
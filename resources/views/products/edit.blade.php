@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('shop.product.edit_form.title', ['name' => $product->name]) }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                            @csrf

													<div class="row mb-3">
															<label for="name" class="col-md-4 col-form-label text-md-end">{{ __('shop.product.product_form.name') }}</label>

														<div class="col-md-6">
																<input id="name" type="text" maxlength="500"
																		class="form-control @error('name') is-invalid @enderror" name="name"
																		value="{{ $product->name }}" required autocomplete="name" autofocus>

																@error('name')
																		<span class="invalid-feedback" role="alert">
																				<strong>{{ $message }}</strong>
																		</span>
																@enderror
														</div>
												</div>

												<div class="row mb-3">
													<label for="description" class="col-md-4 col-form-label text-md-end">{{ __('shop.product.product_form.description') }}</label>

													<div class="col-md-6">
															<textarea id="description" required minlength="10" maxlength="1500" 
																class="form-control @error('description') is-invalid @enderror" name="description" autofocus>{{ $product->description }}</textarea>
														@error('description')
																	<span class="invalid-feedback" role="alert">
																		<strong>{{ $message }}</strong>
																	</span>
														@enderror
											</div>
							</div>

							<div class="row mb-3">
								<label for="amount" class="col-md-4 col-form-label text-md-end">{{ __('shop.product.product_form.amount') }}</label>

								<div class="col-md-6">
									<input id="amount" type="number" min="0"
										class="form-control @error('amount') is-invalid @enderror" name="amount"
										value="{{ $product->amount }}" required autocomplete="amount" autofocus>

									@error('amount')
        								<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
									@enderror
								</div>
							</div>


							<div class="row mb-3">
								<label for="price" class="col-md-4 col-form-label text-md-end">{{ __('shop.product.product_form.price') }}</label>

								<div class="col-md-6">
									<input id="price" type="number" step="0.01" min="0"
										class="form-control @error('price') is-invalid @enderror" name="price"
										value="{{ $product->price }}" required autocomplete="price">

									@error('price')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>

							<div class="row mb-3">
								<label for="image" class="col-md-4 col-form-label text-md-end">{{ __('shop.product.product_form.image') }}</label>

								<div class="col-md-6">
									<input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image">
									
									@error('image')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>

							<div class="row mb-3 justify-content-center">
								<div class="col-md-6">
									@if (!is_null($product->image_path))
										<img src="{{ asset('storage/' . $product->image_path) }}" 
											alt="Zdjęcie produktu" 
											style="width: 300px; height: auto;">
									@endif
								</div>
							</div>

							<div class="row mb-0">
								<div class="col-md-6 offset-md-4">
									<button type="submit" class="btn btn-primary">
										{{ __('shop.button.save') }}
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

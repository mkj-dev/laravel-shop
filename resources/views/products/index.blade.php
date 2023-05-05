@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6 text-start">
                <h1>Lista produktów</h1>
            </div>
            <div class="col-6 text-end">
                <a href="{{ route('products.create') }}">
					<button type="button" class="btn btn-primary">Dodaj</button>
				</a>
            </div>
        </div>
        <div class="row">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nazwa</th>
                        <th scope="col">Opis</th>
                        <th scope="col">Ilość</th>
                        <th scope="col">Cena</th>
                        <th scope="col">Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <th scope="row">{{ $product->id }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->amount }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
								<a href="{{ route('products.show', $product->id) }}" class="btn btn-primary btn-sm">Podgląd</a>
								<a href="{{ route('products.edit', $product->id) }}" class="btn btn-success btn-sm">Edytuj</a>
                                <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $product->id }}">X</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $products->links() }}
    </div>
@endsection
@section('javascript')
<script>
	window.addEventListener("load", function() {
		const buttons = document.getElementsByClassName('btn-delete');

		for (button of buttons) {
			button.addEventListener('click', function() {
				const productId = this.getAttribute('data-id');

				const swalWithBootstrapButtons = Swal.mixin({
					customClass: {
						confirmButton: 'btn btn-success',
						cancelButton: 'btn btn-danger'
					},
					buttonsStyling: false
				})

				swalWithBootstrapButtons.fire({
					title: 'Czy na pewno chcesz usunąć rekord?',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonText: 'Tak',
					cancelButtonText: 'Nie',
					reverseButtons: true
				}).then((result) => {
					if (result.isConfirmed) {
						// Send an AJAX request to the server to delete the user
						const xhr = new XMLHttpRequest();
						xhr.onreadystatechange = function() {
							if (xhr.readyState === XMLHttpRequest.DONE) {
								if (xhr.status === 200) {
									// Reload the page to update the user list
									location.reload();
								} else {
									console.log('Błąd:', xhr.response, 'Kod statusu:', xhr
										.status);
									Swal.fire({
										icon: 'error',
										title: 'Oops...',
										text: `Coś poszło nie tak!`,
									})
								}
							}
						};
						xhr.open('DELETE', '{{ url('products') }}/' + productId);
						xhr.send();
					}
				})
			});
		}
	});
</script>
@endsection

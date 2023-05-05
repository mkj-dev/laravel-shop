@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Email</th>
                    <th scope="col">Imię</th>
                    <th scope="col">Nazwisko</th>
                    <th scope="col">Numer telefonu</th>
                    <th scope="col">Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->surname }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>
                            <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $user->id }}">X</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
@endsection
@section('javascript')
    <script>
        window.addEventListener("load", function() {
            const buttons = document.getElementsByClassName('btn-delete');

            for (button of buttons) {
                button.addEventListener('click', function() {
                    const userId = this.getAttribute('data-id');

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
                            xhr.open('DELETE', '{{ url('users') }}/' + userId);
                            xhr.send();
                        }
                    })
                });
            }
        });
    </script>
@endsection

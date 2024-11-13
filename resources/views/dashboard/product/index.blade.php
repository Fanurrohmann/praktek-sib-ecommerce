@extends('layouts.dashboard')

@section('content')
    <p>Body Products</p>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Launch demo modal
    </button>

    <div id="product-list" class="row">
        @foreach ($products as $product)
            <div class="col-md-3 m-2">
                <div class="card" style="width: 18rem;">
                    {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
                    <div class="card-body">
                        <h5 class="card-title">{{ $product['name'] }}</h5>
                        <span class="badge badge-primary"> {{ $product->category->name }} </span>
                        <p class="card-text">{{ $product['description'] }}</p>
                        {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                        <div class="d-flex">
                            <button class="btn btn-warning">Edit</button>
                            <button class="btn btn-danger"
                                onclick="deleteProduct('{{ route('products.destroy', $product['id']) }}')">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="product-form" action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="product-name" class="col-form-label">Nama Produk:</label>
                            <input type="text" class="form-control" id="product-name" name="name">

                            <label for="category" class="col-form-label">Nama Kategori:</label>
                            <select name="category_id" id="category" class="form-control">
                                <option value="" selected disabled>Pilih kategori produk</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>

                            <label for="product-description" class="col-form-label">Deskripsi:</label>
                            <textarea class="form-control" id="product-description" name="description"></textarea>

                            <label for="product-price" class="col-form-label">Harga:</label>
                            <input type="text" class="form-control" id="product-price" name="price">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="submitForm()">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#category').select2({
                dropdownParent: $('#exampleModal')
            });
        })

        function submitForm() {
            let form = document.getElementById('product-form');
            let data = new FormData(form);

            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                data: data,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#exampleModal').modal('hide');
                    window.location.reload();
                },
                error: function(response) {
                    if (response.status == 422) {
                        let errors = response.responseJSON.errors;
                        let message = '';
                        for (let key in errors) {
                            $(`[name=${key}]`).addClass('is-invalid');
                        }
                    }
                }
            });
        }

        function deleteProduct(url) {
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    window.location.reload();
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }
    </script>
@endpush

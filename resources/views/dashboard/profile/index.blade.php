@extends('layouts.dashboard')

@section('content')
    <form action="">
        <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $profile->name }}">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $profile->email }}">
        </div>
        @if ($profile->avatar)
            <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Avatar" style="width: 100px; height: 100px;">
        @endif
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="inputGroupFile01" name="avatar">
            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
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

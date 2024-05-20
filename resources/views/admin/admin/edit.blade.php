@extends('layouts.app')
@section('title')
    Edit Admin
@endsection
@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"
        integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .dropify-message p {
            font-size: 26px;
        }
    </style>
@endpush

@section('content')
    @include('layouts.breadcrumb', [
        'main_page_name' => 'Admins',
        'main_page_url' => route('admin.index'),
        'sub_page_name' => 'Edit Admin',
        'page_btn' => '',
    ])

    <div class="row">
        <div class="col-12 mx-auto">

            <div class="card">
                <div class="card-body p-4">
                    <form action="{{ route('admin.update', ['admin' => $admin->id]) }}" method="POST" class="row g-3"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                            <input type="text" name="name"
                                class="form-control  @error('name')
                            is-invalid
                        @enderror"
                                id="name" placeholder="Enter name" value="{{ old('name', $admin->name) }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                            <input type="email" name="email"
                                class="form-control @error('email')
                            is-invalid
                        @enderror"
                                id="email" placeholder="Enter email" value="{{ old('email', $admin->email) }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone<span class="text-danger">*</span></label>
                            <input type="text" name="phone"
                                class="form-control @error('phone')
                            is-invalid
                        @enderror"
                                id="phone" placeholder="Enter phone" value="{{ old('phone', $admin->phone) }}">
                            @error('phone')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                            <input type="text" name="address"
                                class="form-control @error('address')
                            is-invalid
                        @enderror"
                                id="address" placeholder="Enter address" value="{{ old('address', $admin->address) }}">
                            @error('address')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="dob" class="form-label">DOB</label>
                            <input type="date" name="dob"
                                class="form-control @error('dob')
                            is-invalid
                        @enderror "
                                id="dob" placeholder="Date of Birth" value="{{ old('dob', $admin->dob) }}">
                            @error('dob')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password')
                            is-invalid
                        @enderror"
                                id="password" placeholder="Enter password">
                            @error('password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" name="photo"
                                data-default-file="{{ asset('uploads/profile') }}/{{ $admin->photo }}"
                                class="form-control dropify @error('photo')
                            is-invalid
                        @enderror"
                                id="photo" placeholder="Enter photo">
                            @error('photo')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-primary px-4">Update</button>
                                <button type="reset" class="btn btn-light px-4">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        });
    </script>
@endpush

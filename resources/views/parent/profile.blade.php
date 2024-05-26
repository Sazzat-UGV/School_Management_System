@extends('layouts.app')
@section('title')
    My Profile
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
        'main_page_name' => 'Profile',
        'main_page_url' => '#',
        'sub_page_name' => 'My Profile',
        'page_btn' => '',
    ])
    <div class="row">
        <div class="col-12 mx-auto">

            <div class="card">
                <div class="card-body p-4">
                    <form action="{{ route('parentProfileUpdate') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">First Name<span class="text-danger">*</span></label>
                            <input type="text" name="first_name"
                                class="form-control  @error('first_name')
                            is-invalid
                        @enderror"
                                id="first_name" placeholder="Enter first name" value="{{ old('first_name',Auth::user()->name) }}">
                            @error('first_name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Last Name<span class="text-danger">*</span></label>
                            <input type="text" name="last_name"
                                class="form-control  @error('last_name')
                            is-invalid
                        @enderror"
                                id="last_name" placeholder="Enter last name" value="{{ old('last_name',Auth::user()->last_name) }}">
                            @error('last_name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="gender" class="form-label">Gender<span class="text-danger">*</span></label>
                            <select
                                class="form-select mb-3  @error('gender')
                            is-invalid
                            @enderror"
                                aria-label="Default select example" name="gender">
                                <option value="Male" @if (old('gender',Auth::user()->gender) == 'Male') selected @endif>Male</option>
                                <option value="Female" @if (old('gender',Auth::user()->gender) == 'Female') selected @endif>Female</option>
                            </select>
                            @error('gender')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="occupation" class="form-label">Occupation</label>
                            <input type="text" name="occupation"
                                class="form-control  @error('occupation')
                            is-invalid
                        @enderror"
                                id="occupation" placeholder="Enter occupation" value="{{ old('occupation',Auth::user()->occupation) }}">
                            @error('occupation')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="mobile_number" class="form-label">Mobile Number<span class="text-danger">*</span></label>
                            <input type="text" name="mobile_number"
                                class="form-control  @error('mobile_number')
                            is-invalid
                        @enderror"
                                id="mobile_number" placeholder="Enter mobile number" value="{{ old('mobile_number',Auth::user()->phone) }}">
                            @error('mobile_number')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                            <input type="text" name="address"
                                class="form-control @error('address')
                            is-invalid
                        @enderror"
                                id="address" placeholder="Enter address" value="{{ old('address',Auth::user()->address) }}">
                            @error('address')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                            <input type="email" name="email"
                                class="form-control @error('email')
                            is-invalid
                        @enderror"
                                id="email" placeholder="Enter email" value="{{ old('email',Auth::user()->email) }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" name="photo" data-default-file="{{ asset('uploads/profile') }}/{{ Auth::user()->photo }}"
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

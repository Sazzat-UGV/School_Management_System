@extends('layouts.app')
@section('title')
    Change Password
@endsection
@push('style')
@endpush

@section('content')

@section('content')
    @include('layouts.breadcrumb', [
        'main_page_name' => 'Profile',
        'main_page_url' => '#',
        'sub_page_name' => 'Change Password',
        'page_btn' => '',
    ])

    <div class="row">
        <div class="col-12 mx-auto">

            <div class="card">
                <div class="card-body p-4">
                    <form action="{{ route('changePassword') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                        @csrf

                        <div class="col-12">
                            <label for="old_password" class="form-label">Old Password<span
                                    class="text-danger">*</span></label>
                            <input type="password" name="old_password"
                                class="form-control @error('old_password')
                            is-invalid
                        @enderror"
                                id="old_password" placeholder="Enter old password">
                            @error('old_password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="new_password" class="form-label">New Password<span
                                    class="text-danger">*</span></label>
                            <input type="password" name="new_password"
                                class="form-control @error('new_password')
                            is-invalid
                        @enderror"
                                id="new_password" placeholder="Enter new password">
                            @error('new_password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="retype_password" class="form-label">Retype Password<span
                                    class="text-danger">*</span></label>
                            <input type="password" name="retype_password"
                                class="form-control @error('retype_password')
                            is-invalid
                        @enderror"
                                id="retype_password" placeholder="Enter retype password">
                            @error('retype_password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-primary px-4">Change</button>
                                <button type="reset" class="btn btn-light px-4">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@endsection

@push('script')
@endpush

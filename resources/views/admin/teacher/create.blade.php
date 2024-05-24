@extends('layouts.app')
@section('title')
    Add Teacher
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
        'main_page_name' => 'Teachers',
        'main_page_url' => route('teacher.index'),
        'sub_page_name' => 'Add Teacher',
        'page_btn' => '',
    ])

    <div class="row">
        <div class="col-12 mx-auto">

            <div class="card">
                <div class="card-body p-4">
                    <form action="{{ route('teacher.store') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">First Name<span class="text-danger">*</span></label>
                            <input type="text" name="first_name"
                                class="form-control  @error('first_name')
                            is-invalid
                        @enderror"
                                id="first_name" placeholder="Enter first name" value="{{ old('first_name') }}">
                            @error('first_name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" name="last_name"
                                class="form-control  @error('last_name')
                            is-invalid
                        @enderror"
                                id="last_name" placeholder="Enter last name" value="{{ old('last_name') }}">
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
                                <option value="" @if (old('') == '') selected @endif>Select Gender
                                </option>
                                <option value="Male" @if (old('gender') == 'Male') selected @endif>Male</option>
                                <option value="Female" @if (old('gender') == 'Female') selected @endif>Female</option>
                            </select>
                            @error('gender')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="date_of_birth" class="form-label">Date of Birth<span
                                    class="text-danger">*</span></label>
                            <input type="date" name="date_of_birth"
                                class="form-control  @error('date_of_birth')
                            is-invalid
                        @enderror"
                                id="date_of_birth" placeholder="Enter date of birth" value="{{ old('date_of_birth') }}">
                            @error('date_of_birth')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="date_of_joining" class="form-label">Date of Joining<span
                                    class="text-danger">*</span></label>
                            <input type="date" name="date_of_joining"
                                class="form-control  @error('date_of_joining')
                            is-invalid
                        @enderror"
                                id="date_of_joining" placeholder="Enter date of joining"
                                value="{{ old('date_of_joining') }}">
                            @error('date_of_joining')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="mobile_number" class="form-label">Mobile Number<span
                                    class="text-danger">*</span></label>
                            <input type="text" name="mobile_number"
                                class="form-control  @error('mobile_number')
                            is-invalid
                        @enderror"
                                id="mobile_number" placeholder="Enter mobile number" value="{{ old('mobile_number') }}">
                            @error('mobile_number')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="marital_status" class="form-label">Marital Status<span
                                    class="text-danger">*</span></label>
                            <input type="text" name="marital_status"
                                class="form-control  @error('marital_status')
                            is-invalid
                        @enderror"
                                id="marital_status" placeholder="Enter marital status" value="{{ old('marital_status') }}">
                            @error('marital_status')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="status" class="form-label">Status<span class="text-danger">*</span></label>
                            <select
                                class="form-select mb-3  @error('status')
                            is-invalid
                            @enderror"
                                aria-label="Default select example" name="status">
                                <option value="" @if (old('') == '') selected @endif>Select Status
                                </option>
                                <option value="1" @if (old('status') == 1) selected @endif>Active</option>
                                <option value="0" @if (old('status') == 0) selected @endif>Inactive</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="current_address" class="form-label">Current Address<span
                                    class="text-danger">*</span></label>
                            <textarea name="current_address"
                                class="form-control @error('current_address')
                            is-invalid
                        @enderror"
                                cols="30" rows="3" id="current_address" placeholder="Enter current address">{{ old('current_address') }}</textarea>
                            @error('current_address')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="permanent_address" class="form-label">Permanent Address<span
                                    class="text-danger">*</span></label>
                            <textarea name="permanent_address"
                                class="form-control @error('permanent_address')
                            is-invalid
                        @enderror"
                                cols="30" rows="3" id="permanent_address" placeholder="Enter permanent address">{{ old('permanent_address') }}</textarea>
                            @error('permanent_address')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="qualification" class="form-label">Qualification<span
                                    class="text-danger">*</span></label>
                            <textarea name="qualification"
                                class="form-control @error('qualification')
                            is-invalid
                        @enderror"
                                cols="30" rows="3" id="qualification" placeholder="Enter qualification">{{ old('qualification') }}</textarea>
                            @error('qualification')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="work_experience" class="form-label">Work Experience<span
                                    class="text-danger">*</span></label>
                            <textarea name="work_experience"
                                class="form-control @error('work_experience')
                            is-invalid
                        @enderror"
                                cols="30" rows="3" id="work_experience" placeholder="Enter work experience">{{ old('work_experience') }}</textarea>
                            @error('work_experience')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="note" class="form-label">Note</label>
                            <textarea name="note"
                                class="form-control @error('note')
                            is-invalid
                        @enderror"
                                cols="30" rows="3" id="note" placeholder="Enter note">{{ old('note') }}</textarea>
                            @error('note')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                            <input type="email" name="email"
                                class="form-control @error('email')
                            is-invalid
                        @enderror"
                                id="email" placeholder="Enter email" value="{{ old('email') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
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
                                <button type="submit" class="btn btn-primary px-4">Save</button>
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

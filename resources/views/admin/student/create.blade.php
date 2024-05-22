@extends('layouts.app')
@section('title')
    Add Student
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
        'main_page_name' => 'Students',
        'main_page_url' => route('student.index'),
        'sub_page_name' => 'Add Student',
        'page_btn' => '',
    ])

    <div class="row">
        <div class="col-12 mx-auto">

            <div class="card">
                <div class="card-body p-4">
                    <form action="{{ route('student.store') }}" method="POST" class="row g-3" enctype="multipart/form-data">
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
                            <label for="admission_number" class="form-label">Admission Number</label>
                            <input type="text" name="admission_number"
                                class="form-control  @error('admission_number')
                            is-invalid
                        @enderror"
                                id="admission_number" placeholder="Enter admission number" value="{{ old('admission_number') }}">
                            @error('admission_number')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="roll_number" class="form-label">Roll Number<span class="text-danger">*</span></label>
                            <input type="text" name="roll_number"
                                class="form-control  @error('roll_number')
                            is-invalid
                        @enderror"
                                id="roll_number" placeholder="Enter roll number" value="{{ old('roll_number') }}">
                            @error('roll_number')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="class" class="form-label">Class<span class="text-danger">*</span></label>
                            <select
                                class="form-select mb-3  @error('class')
                            is-invalid
                            @enderror"
                                aria-label="Default select example" name="class">
                                <option value="" @if (old('') == '') selected @endif>Select Class</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}" @if (old('class') == $class->id) selected @endif>
                                        {{ $class->name }}</option>
                                @endforeach
                            </select>
                            @error('class')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="gender" class="form-label">Gender<span class="text-danger">*</span></label>
                            <select
                                class="form-select mb-3  @error('gender')
                            is-invalid
                            @enderror"
                                aria-label="Default select example" name="gender">
                                <option value="" @if (old('') == '') selected @endif>Select Gender</option>
                                <option value="Male" @if (old('gender') == 'Male') selected @endif>Male</option>
                                <option value="Female" @if (old('gender') == 'Female') selected @endif>Female</option>
                            </select>
                            @error('gender')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="date_of_birth" class="form-label">Date of Birth<span class="text-danger">*</span></label>
                            <input type="date" name="date_of_birth"
                                class="form-control @error('date_of_birth')
                            is-invalid
                        @enderror "
                                id="date_of_birth" placeholder="Date of Birth" value="{{ old('date_of_birth') }}">
                            @error('date_of_birth')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="caste" class="form-label">Caste</label>
                            <input type="text" name="caste"
                                class="form-control  @error('caste')
                            is-invalid
                        @enderror"
                                id="caste" placeholder="Enter caste" value="{{ old('caste') }}">
                            @error('caste')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="religion" class="form-label">Religion<span class="text-danger">*</span></label>
                            <input type="text" name="religion"
                                class="form-control  @error('religion')
                            is-invalid
                        @enderror"
                                id="religion" placeholder="Enter religion" value="{{ old('religion') }}">
                            @error('religion')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="mobile_number" class="form-label">Mobile Number<span class="text-danger">*</span></label>
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
                            <label for="admission_date" class="form-label">Admission Date<span class="text-danger">*</span></label>
                            <input type="date" name="admission_date"
                                class="form-control @error('admission_date')
                            is-invalid
                        @enderror "
                                id="admission_date" placeholder="admission date" value="{{ old('admission_date') }}">
                            @error('admission_date')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="blood_group" class="form-label">Blood Group</label>
                            <select
                                class="form-select mb-3  @error('blood_group')
                            is-invalid
                            @enderror"
                                aria-label="Default select example" name="blood_group">
                                <option value="" @if (old('') == '') selected @endif>Select Blood Group</option>
                                <option value="A+" @if (old('blood_group') == 'A+') selected @endif>A+</option>
                                <option value="A-" @if (old('blood_group') == 'A-') selected @endif>A-</option>
                                <option value="B+" @if (old('blood_group') == 'B+') selected @endif>B+</option>
                                <option value="B-" @if (old('blood_group') == 'B-') selected @endif>B-</option>
                                <option value="O+" @if (old('blood_group') == 'O+') selected @endif>O+</option>
                                <option value="O-" @if (old('blood_group') == 'O-') selected @endif>O-</option>
                                <option value="AB+" @if (old('blood_group') == 'AB+') selected @endif>AB+</option>
                                <option value="AB-" @if (old('blood_group') == 'AB-') selected @endif>AB+</option>
                            </select>
                            @error('blood_group')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="height" class="form-label">Height</label>
                            <input type="text" name="height"
                                class="form-control  @error('height')
                            is-invalid
                        @enderror"
                                id="height" placeholder="Enter height" value="{{ old('height') }}">
                            @error('height')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="weight" class="form-label">Weight</label>
                            <input type="text" name="weight"
                                class="form-control  @error('weight')
                            is-invalid
                        @enderror"
                                id="weight" placeholder="Enter weight" value="{{ old('weight') }}">
                            @error('weight')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status<span class="text-danger">*</span></label>
                            <select
                                class="form-select mb-3  @error('status')
                            is-invalid
                            @enderror"
                                aria-label="Default select example" name="status">
                                <option value="" @if (old('') == '') selected @endif>Select Status</option>
                                <option value="1" @if (old('status') == 1) selected @endif>Active</option>
                                <option value="0" @if (old('status') == 0) selected @endif>Inactive</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                            <input type="text" name="address"
                                class="form-control @error('address')
                            is-invalid
                        @enderror"
                                id="address" placeholder="Enter address" value="{{ old('address') }}">
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

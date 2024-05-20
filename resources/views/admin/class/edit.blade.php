@extends('layouts.app')
@section('title')
    Edit Class
@endsection
@push('style')
@endpush

@section('content')
    @include('layouts.breadcrumb', [
        'main_page_name' => 'Classes',
        'main_page_url' => route('class.index'),
        'sub_page_name' => 'Edit Class',
        'page_btn' => '',
    ])

    <div class="row">
        <div class="col-12 mx-auto">

            <div class="card">
                <div class="card-body p-4">
                    <form action="{{ route('class.update', ['class' => $class->id]) }}" method="POST" class="row g-3"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12">
                            <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                            <input type="text" name="name"
                                class="form-control  @error('name')
                            is-invalid
                            @enderror"
                                id="name" placeholder="Enter name" value="{{ old('name', $class->name) }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="status" class="form-label">Status<span class="text-danger">*</span></label>
                            <select
                                class="form-select mb-3  @error('status')
                            is-invalid
                            @enderror"
                                aria-label="Default select example" name="status">
                                <option value="1" @if (old('status', $class->status) == 1) selected @endif>Active</option>
                                <option value="0" @if (old('status', $class->status) == 0) selected @endif>Inactive</option>
                            </select>
                            @error('status')
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
@endpush

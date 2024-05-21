@extends('layouts.app')
@section('title')
Subject Class
@endsection
@push('style')
@endpush

@section('content')
    @include('layouts.breadcrumb', [
        'main_page_name' => 'Subjects',
        'main_page_url' => route('subject.index'),
        'sub_page_name' => 'Add Subject',
        'page_btn' => '',
    ])

    <div class="row">
        <div class="col-12 mx-auto">

            <div class="card">
                <div class="card-body p-4">
                    <form action="{{ route('subject.store') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                            <input type="text" name="name"
                                class="form-control  @error('name')
                            is-invalid
                            @enderror"
                                id="name" placeholder="Enter name" value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>


                        <div class="col-md-6">
                            <label for="type" class="form-label">Type<span class="text-danger">*</span></label>
                            <select
                                class="form-select mb-3  @error('type')
                            is-invalid
                            @enderror"
                                aria-label="Default select example" name="type">
                                <option value="Theory" @if (old('type')=='Theory') selected @endif>Theory</option>
                                <option value="Practical" @if (old('type')=='Practical') selected @endif>Practical</option>
                            </select>
                            @error('type')
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
                                <option value="1" @if (old('status')==1) selected @endif>Active</option>
                                <option value="0" @if (old('status')==0) selected @endif>Inactive</option>
                            </select>
                            @error('status')
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
@endpush

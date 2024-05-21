@extends('layouts.app')
@section('title')
    Assign Edit
@endsection
@push('style')
@endpush

@section('content')
    @include('layouts.breadcrumb', [
        'main_page_name' => 'Assign Subject',
        'main_page_url' => route('assign.index'),
        'sub_page_name' => 'Assign Edit',
        'page_btn' => '',
    ])

    <div class="row">
        <div class="col-12 mx-auto">

            <div class="card">
                <div class="card-body p-4">
                    <form action="{{ route('assign.update', ['assign' => $assign->id]) }}" method="POST" class="row g-3"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12">
                            <label for="class_name" class="form-label">Class Name<span class="text-danger">*</span></label>
                            <select
                                class="form-select mb-3  @error('class_name')
                            is-invalid
                            @enderror"
                                aria-label="Default select example" name="class_name">
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}"
                                        @if (old('class_name') == $class->id) selected @elseif($class->id == $assign->class_id) selected @endif>
                                        {{ $class->name }}</option>
                                @endforeach
                            </select>
                            @error('class_name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="multiple-select-custom-field" class="form-label">Subject Name<span
                                    class="text-danger">*</span></label>
                            <select
                                class="form-select mb-3  @error('subject_name')
                            is-invalid
                            @enderror"
                                aria-label="Default select example" name="subject_name">
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}"
                                        @if (old('subject_name') == $subject->id) selected @elseif($subject->id == $assign->subject_id) selected @endif>
                                        {{ $subject->name }}</option>
                                @endforeach
                            </select>
                            @error('subject_name')
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
                                <option value="1" @if (old('status', $assign->status) == 1) selected @endif>Active</option>
                                <option value="0" @if (old('status', $assign->status) == 0) selected @endif>Inactive</option>
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

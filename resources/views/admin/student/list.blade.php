@extends('layouts.app')
@section('title')
    Student List
@endsection
@push('style')
    <style>
        .wrap {
            white-space: normal !important;
            word-wrap: break-word;
        }

        .btn-group .dropdown-toggle::after {
            display: none;
        }

        .btn-group .btn:focus,
        .btn-group .btn:active {
            outline: none;
            box-shadow: none;
        }

        @media (max-width: 767.98px) {
            .table thead {
                display: none;
            }

            .table,
            .table tbody,
            .table tr,
            .table td {
                display: block;
                width: 100%;
            }

            .table tr {
                margin-bottom: 1rem;
            }

            .table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            .table td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 1rem;
                text-align: left;
                font-weight: bold;
            }

            .table img.user-img {
                max-width: 100px;
            }
        }
    </style>
@endpush
@section('content')
    @include('layouts.breadcrumb', [
        'main_page_name' => 'Students',
        'main_page_url' => route('student.index'),
        'sub_page_name' => 'Student List',
        'page_btn' =>
            '<div class="ms-auto">
                                                                            <div class="btn-group"><a href="' .
            route('student.create') .
            '" class="btn btn-primary px-4"><i class="bx bx-plus-circle mr-1"></i>Add Student</a>
                               </div>
                               </div>
                      </div>',
    ])

    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('student.index') }}" method="get">
                            @csrf
                            <div class="row d-flex align-items-center">
                                <div class="col-12 col-sm-6 col-md-2 mb-3">
                                    <label for="name" class="form-label">First Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="col-12 col-sm-6 col-md-2 mb-3">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" name="last_name" class="form-control">
                                </div>
                                <div class="col-12 col-sm-6 col-md-2 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                                <div class="col-12 col-sm-6 col-md-2 mb-3">
                                    <label for="admission_number" class="form-label">Admission Number</label>
                                    <input type="text" name="admission_number" class="form-control">
                                </div>
                                <div class="col-12 col-sm-6 col-md-2 mb-3">
                                    <label for="roll_number" class="form-label">Roll Number</label>
                                    <input type="text" name="roll_number" class="form-control">
                                </div>
                                <div class="col-12 col-sm-6 col-md-2 mb-3">
                                    <label for="class" class="form-label">Class</label>
                                    <select class="form-select" aria-label="Default select example" name="class">
                                        <option value="">Select Class</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6 col-md-2 mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" aria-label="Default select example" name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="Male" @if (old('gender') == 'Male') selected @endif>Male
                                        </option>
                                        <option value="Female" @if (old('gender') == 'Female') selected @endif>Female
                                        </option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6 col-md-2 mb-3">
                                    <label for="religion" class="form-label">Religion</label>
                                    <input type="text" name="religion" class="form-control">
                                </div>
                                <div class="col-12 col-sm-6 col-md-2 mb-3">
                                    <label for="phone" class="form-label">Mobile Number</label>
                                    <input type="text" name="phone" class="form-control">
                                </div>
                                <div class="col-12 col-sm-6 col-md-2 mb-3">
                                    <label for="blood_group" class="form-label">Blood Group</label>
                                    <select class="form-select" aria-label="Default select example" name="blood_group">
                                        <option value="">Select Blood Group</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB+</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6 col-md-2 mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" aria-label="Default select example" name="status">
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6 col-md-2 mb-3">
                                    <label for="dob" class="form-label">Date of Birth</label>
                                    <input type="date" name="dob" class="form-control">
                                </div>
                                <div class="col-12 col-sm-6 col-md-2 mb-3">
                                    <label for="admission_date" class="form-label">Admission Date</label>
                                    <input type="date" name="admission_date" class="form-control">
                                </div>
                                <div class="col-12 col-sm-6 col-md-3 mt-2 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary px-4 me-2">Search</button>
                                    <button type="reset" class="btn btn-light px-4">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0 table-hover">
                                <thead class="table-secondary">
                                    <tr>
                                        <th class="wrap" scope="col">#</th>
                                        <th class="wrap" scope="col">Photo</th>
                                        <th class="wrap" scope="col">Name</th>
                                        <th class="wrap" scope="col">Email</th>
                                        <th class="wrap" scope="col">Admission Number</th>
                                        <th class="wrap" scope="col">Roll Number</th>
                                        <th class="wrap" scope="col">Class</th>
                                        <th class="wrap" scope="col">Gender</th>
                                        <th class="wrap" scope="col">Date of Birth</th>
                                        <th class="wrap" scope="col">Religion</th>
                                        <th class="wrap" scope="col">Mobile Number</th>
                                        <th class="wrap" scope="col">Admission Date</th>
                                        <th class="wrap" scope="col">Blood Group</th>
                                        <th class="wrap" scope="col">Height</th>
                                        <th class="wrap" scope="col">Weight</th>
                                        <th class="wrap" scope="col">Status</th>
                                        <th class="wrap" scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $index => $student)
                                        <tr>
                                            <td class="wrap" data-label="#"> {{ $index + 1 }} </td>
                                            <td class="wrap" data-label="Photo">
                                                <img style="margin: 0; padding: 0;"
                                                    src="{{ asset('uploads/profile') }}/{{ $student->photo }}"
                                                    alt="image" class="user-img">
                                            </td>
                                            <td class="wrap" data-label="Name"> {{ $student->name }}
                                                {{ $student->last_name }} </td>
                                            <td class="wrap" data-label="Email"> {{ $student->email }} </td>
                                            <td class="wrap" data-label="Admission_Number">
                                                {{ $student->admission_number }} </td>
                                            <td class="wrap" data-label="Roll_Number"> {{ $student->roll_number }}
                                            </td>
                                            <td class="wrap" data-label="Class"> {{ $student->class->name }} </td>
                                            <td class="wrap" data-label="Gender"> {{ $student->gender }} </td>
                                            <td class="wrap" data-label="DOB">
                                                {{ date('d-m-Y', strtotime($student->dob)) }} </td>
                                            <td class="wrap" data-label="Religion"> {{ $student->religion }} </td>
                                            <td class="wrap" data-label="Mobile_Number"> {{ $student->phone }} </td>
                                            <td class="wrap" data-label="Admission_Date">
                                                {{ date('d-m-Y', strtotime($student->admission_date)) }} </td>
                                            <td class="wrap" data-label="Blood_Group"> {{ $student->blood_group }}
                                            </td>
                                            <td class="wrap" data-label="Height"> {{ $student->height }} </td>
                                            <td class="wrap" data-label="Weight"> {{ $student->weight }} </td>
                                            <td class="wrap" data-label="Status">
                                                @if ($student->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="wrap" data-label="Action">
                                                <div class="d-flex order-actions">
                                                    <a href="{{ route('student.edit', ['student' => $student->id]) }}"
                                                        class="bg-warning p-1">
                                                        <i class="bx bxs-edit"></i>
                                                    </a>
                                                    <form
                                                        action="{{ route('student.destroy', ['student' => $student->id]) }}"
                                                        method="POST" class="m-0 ms-3 show_confirm">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="bg-transparent border-0 px-2 py-1 bg-danger rounded">
                                                            <i class="bx bxs-trash" style="font-size: 16px"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $students->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.show_confirm').on('click', function(event) {
                event.preventDefault();
                let form = $(this).closest('form');
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });
                        form.submit();
                    } else {
                        Swal.fire({
                            title: "Canceled!",
                        });
                    }
                });
            });
        });
    </script>
@endpush

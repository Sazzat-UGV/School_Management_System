@extends('layouts.app')
@section('title')
    Parent List
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
        'main_page_name' => 'Parents',
        'main_page_url' => route('parent.index'),
        'sub_page_name' => 'Parent List',
        'page_btn' =>
            '<div class="ms-auto">                  <div class="btn-group"><a href="' .
            route('parent.create') .
            '" class="btn btn-primary px-4"><i class="bx bx-plus-circle mr-1"></i>Add Parent</a>
                 </div>
                 </div>
        </div>',
    ])

    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('parent.index') }}" method="get">
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
                                    <label for="occupation" class="form-label">Occupation</label>
                                    <input type="text" name="occupation" class="form-control">
                                </div>
                                <div class="col-12 col-sm-6 col-md-2 mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control">
                                </div>
                                <div class="col-12 col-sm-6 col-md-2 mb-3">
                                    <label for="phone" class="form-label">Mobile Number</label>
                                    <input type="text" name="phone" class="form-control">
                                </div>
                                <div class="col-12 col-sm-6 col-md-2 mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" aria-label="Default select example" name="status">
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
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
                                        <th scope="col">#</th>
                                        <th scope="col">Photo</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Mobile Number</th>
                                        <th scope="col">Occupation</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($parents as $index => $parent)
                                        <tr>
                                            <td data-label="#"> {{ $index + 1 }} </td>
                                            <td data-label="Photo">
                                                <img style="margin: 0; padding: 0;"
                                                    src="{{ asset('uploads/profile') }}/{{ $parent->photo }}" alt="image"
                                                    class="user-img">
                                            </td>
                                            <td data-label="Name"> {{ $parent->name }} {{ $parent->last_name }}</td>
                                            <td data-label="Email"> {{ $parent->email }} </td>
                                            <td data-label="Gender"> {{ $parent->gender }} </td>
                                            <td data-label="Phone"> {{ $parent->phone }} </td>
                                            <td data-label="Occupation"> {{ $parent->occupation }} </td>
                                            <td data-label="Address"> {{ $parent->address }} </td>
                                            <td class="wrap" data-label="Status">
                                                @if ($parent->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td data-label="Action">
                                                <div class="d-flex order-actions">
                                                    <a href="{{ route('parent.edit', ['parent' => $parent->id]) }}"
                                                        class="bg-warning p-1">
                                                        <i class="bx bxs-edit"></i>
                                                    </a>
                                                    <form action="{{ route('parent.destroy', ['parent' => $parent->id]) }}"
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
                            {{ $parents->links() }}
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

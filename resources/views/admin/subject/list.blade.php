@extends('layouts.app')
@section('title')
    Subject List
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
        'main_page_name' => 'Subjects',
        'main_page_url' => route('subject.index'),
        'sub_page_name' => 'Subject List',
        'page_btn' =>
            '<div class="ms-auto">
                                                            <div class="btn-group"><a href="' .
            route('subject.create') .
            '" class="btn btn-primary px-4"><i class="bx bx-plus-circle mr-1"></i>Add Subject</a>
                                                    </div>
                                                    </div>
                                           </div>',
    ])

    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('subject.index') }}" method="get">
                            @csrf
                            <div class="row d-flex align-items-center">
                                <div class="col-12 col-sm-6 col-md-3 mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="col-12 col-sm-6 col-md-3 mb-3">
                                    <label for="type" class="form-label">Type</label>
                                    <select class="form-select"
                                        aria-label="Default select example" name="type">
                                        <option value="">Select Type</option>
                                        <option value="Theory" @if (old('type')=='Theory') selected @endif>Theory</option>
                                        <option value="Practical" @if (old('type')=='Practical') selected @endif>Practical</option>
                                    </select>
                                </div>

                                <div class="col-12 col-sm-6 col-md-3 mb-3">
                                    <label for="date" class="form-label">Date</label>
                                    <input type="date" name="date" class="form-control">
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
                                        <th scope="col">Date</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Created By</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subjects as $index => $subject)
                                        <tr>
                                            <td data-label="#"> {{ $index + 1 }} </td>
                                            <td data-label="Date"> {{ $subject->created_at->format('d-M-Y') }} </td>
                                            <td data-label="Name"> {{ $subject->name }} </td>
                                            <td data-label="Name"> {{ $subject->type }} </td>
                                            <td data-label="Created By"> {{ $subject->user->name }} </td>
                                            <td data-label="Status">
                                                @if ($subject->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td data-label="Action">
                                                <div class="d-flex order-actions">
                                                    <a href="{{ route('subject.edit', ['subject' => $subject->id]) }}"
                                                        class="bg-warning p-1">
                                                        <i class="bx bxs-edit"></i>
                                                    </a>
                                                    <form action="{{ route('subject.destroy', ['subject' => $subject->id]) }}"
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
                            {{ $subjects->links() }}
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

@extends('layouts.admin')

@section('content')
    {{-- @section('title')
    {{ $title }}
@endsection --}}

@section('css')
@endsection

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="row py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1 col-xl-6">
                    <h4 class="fs-18 fw-semibold m-0">Quản lý khuyến mãi</h4>
                </div>
                <div class="col-xl-6 text-end">
                    <a href="{{ route('admins.promotions.create') }}" class="btn btn-primary"><i
                            data-feather="file-plus"></i>Thêm Mới</a>
                </div>
            </div>


            <!-- Striped Rows -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Quản lý khuyến mãi</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive">

                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show " role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Code</th>
                                            <th>Description</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Discount Amount</th>
                                            <th>Active</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($promotions as $promotion)
                                            <tr>
                                                <td>{{ $promotion->id }}</td>
                                                <td>{{ $promotion->code }}</td>
                                                <td>{{ $promotion->description }}</td>
                                                <td>{{ $promotion->start_date }}</td>
                                                <td>{{ $promotion->end_date }}</td>
                                                <td>{{ $promotion->discount_amount }}</td>
                                                <td>{{ $promotion->is_active ? 'Yes' : 'No' }}</td>
                                                <td>
                                                    <a href="{{ route('admins.promotions.edit', $promotion) }}"
                                                        class="btn btn-warning">Edit</a>
                                                    <form action="{{ route('admins.promotions.destroy', $promotion) }}"
                                                        method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div> <!-- container-fluid -->
    </div> <!-- content -->
@endsection

@section('js')
@endsection

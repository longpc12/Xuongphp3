


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

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Thêm Mới khuyến mãi</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            {{-- <h5 class="card-title mb-0">{{ $title }}</h5> --}}
                        </div><!-- end card header -->

                        <div class="card-body">
                            <form action="{{ route('admins.promotions.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="code">Code</label>
                                    <input type="text" name="code" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" name="start_date" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input type="date" name="end_date" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="discount_amount">Discount Amount</label>
                                    <input type="number" step="0.01" name="discount_amount" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="is_active">Active</label>
                                    <select name="is_active" class="form-control" required>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                     
                        </div>

                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div> <!-- content -->
@endsection

@section('js')

@endsection

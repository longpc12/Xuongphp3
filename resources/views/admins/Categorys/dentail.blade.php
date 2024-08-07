@extends('layouts.admin')

@section('content')

@section('title')
    {{ $title }}
@endsection

@section('css')
@endsection

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="row py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1 col-xl-6">
                    <h4 class="fs-18 fw-semibold m-0">Quản Lý Danh Mục Sản Phẩm</h4>
                </div>
                <div class="col-xl-6 text-end">
                    <a href="{{ route('admins.category.create') }}" class="btn btn-primary"><i
                            data-feather="file-plus"></i>Thêm Mới</a>
                </div>
            </div>


            <!-- Striped Rows -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ $title }}</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tên</th>
                                            <th scope="col">Hình ảnh</th>
                                            <th scope="col">Trạng Thái</th>
                                 
                                        </tr>
                                    </thead>
                                    <tbody>

                                            <tr>

                                                <th scope="row">{{ $category->id }}</th>
                                                <td>{{ $category->name_category }}</td>
                                                <td><img src="{{ Storage::url($category->thumbnail_category) }}"
                                                        alt="" width="100px"></td>
                                                <td
                                                    class=" {{ $category->status == true ? 'text-success' : 'text-danger' }}">
                                                    {{ $category->status == true ? 'Hiển Thị' : 'ẩn' }}

                                                </td>
                                               
                                            </tr>
                                
                                    </tbody>
                                </table>
                             
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xl-6">
                <a href="{{ route('admins.category.index') }}" class="btn btn-primary"><i
                        data-feather="arrow-left"></i>Quay Lại</a>
            </div>

        </div> <!-- container-fluid -->
    </div> <!-- content -->
@endsection

@section('js')
@endsection

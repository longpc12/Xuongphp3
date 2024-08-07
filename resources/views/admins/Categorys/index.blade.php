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

                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show " role="alert">
                                    {{session('success')}}
                                 <button type="button"  class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                              
                                    
                                @endif
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tên</th>
                                            <th scope="col">Hình ảnh</th>
                                            <th scope="col">Trạng Thái</th>
                                            <th scope="col">Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listCategory as $index => $category)
                                            <tr>

                                                <th scope="row">{{ $index + 1 }}</th>
                                                <td>{{ $category->name_category }}</td>
                                                <td><img src="{{ Storage::url($category->thumbnail_category) }}"
                                                        alt="" width="100px"></td>
                                                <td
                                                    class=" {{ $category->status == true ? 'text-success' : 'text-danger' }}">
                                                    {{ $category->status == true ? 'Hiển Thị' : 'ẩn' }}

                                                </td>
                                                <td>
                                                    <a href="{{ route('admins.category.edit', $category->id) }}"><i
                                                            class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i></a>
                                                    <form action="{{ route('admins.category.destroy', $category->id) }}"
                                                        method="POST" class="d-inline" onsubmit="return confirm('bạn có đồng ý muốn xóa không')">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="border-0 bg-white">
                                                       <i
                                                                    class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"></i>
                                                        </button>

                                                    </form>
                                                    <a href="{{ route('admins.category.show', $category->id) }}"><i
                                                        class="mdi mdi-eye text-muted fs-18 rounded-2 border p-1 me-1"></i></a>
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

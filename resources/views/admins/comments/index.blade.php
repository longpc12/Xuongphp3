
@extends('layouts.admin')

@section('content')

@section('title')

@endsection

@section('css')
@endsection

<div class="content-page">
    <div class="content">
  
        <!-- Start Content-->
        <div class="container-xxl">

            <div class="row py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1 col-xl-6">
                    <h4 class="fs-18 fw-semibold m-0">Quản Lý Bình Luận</h4>
                </div>
            </div>


            <!-- Striped Rows -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                          
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
                                            <th>ID</th>
                                            <th>Người Dùng</th>
                                            <th>Sản Phẩm</th>
                                            <th>Nội dung</th>
                                            <th>Ngày bình luận</th>
                                            <th>Hàng Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($comments as $comment)
                                            <tr>
                                                <td>{{ $comment->id }}</td>
                                                <td>{{ $comment->user->name }}</td>
                                                <td>{{ $comment->product->name_product }}</td>
                                                <td>{{ $comment->content }}</td>
                                                <td>{{ $comment->commentDate }}</td>
                                                <td>
                                                    <a href="{{ route('admins.comments.show', $comment->id) }}" class="btn btn-info">View</a>
                                                 
                                                    <form action="{{ route('admins.comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
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

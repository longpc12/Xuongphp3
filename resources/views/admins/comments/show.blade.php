



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
                    <h4 class="fs-18 fw-semibold m-0">Chi Tiết Bình Luận</h4>
                </div>
           
            </div>


            <!-- Striped Rows -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                  
                        </div><!-- end card header -->
                        <div class="container">
                            <h1>Chi tiết bình luận</h1>
                            <p><strong>Người Dùng:</strong> {{ $comment->user->name }}</p>
                            <p><strong>Sản Phẩm:</strong> {{ $comment->product->name_product }}</p>
                            <p><strong>Nội dung:</strong> {{ $comment->content }}</p>
                            <p><strong>Ngày bình luận:</strong> {{ $comment->commentDate }}</p>
                    
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xl-6">
                <a href="{{ route('admins.comments.index') }}" class="btn btn-primary"><i
                        data-feather="arrow-left"></i>Quay Lại</a>
            </div>

        </div> <!-- container-fluid -->
    </div> <!-- content -->
@endsection

@section('js')
@endsection

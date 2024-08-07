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

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Sửa danh mục  </h4>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ $title }}</h5>
                        </div><!-- end card header -->

                        <div class="card-body">

                            <form action="{{ route('admins.category.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                   
                                    <div class="col-lg-6">

                                        <div class="mb-3">
                                            <label for="name_category" class="form-label">Tên Danh Mục</label>
                                            <input type="text" id="name_category" name="name_category" is-invalid
                                                class="form-control @error('name_category') @enderror"
                                                value="{{ $category->name_category}}" placeholder="Tên Danh Mục">
                                            @error('name_category')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="imgae" class="form-label">imgae</label>
                                            <input type="file" id="image" name="image" is-invalid
                                                class="form-control " onchange="showImage(event)">
                                                <img id="img_category" src="{{Storage::url($category->thumbnail_category)}}" alt="Hình ảnh sản phẩm" style="width:150px;">
                                         
                                        </div>
                                    </div>

                                    <div class="col-sm-10 d-flex gap-2 mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status"
                                                id="gridRadios1" value="{{$category->status == true ? 'checked' : ''}}" checked>
                                            <label class="form-check-label text-success" for="gridRadios1">
                                                Hiển Thị
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status"
                                                id="gridRadios2" value="{{$category->status == false ? 'checked' : ''}}">
                                            <label class="form-check-label text-danger" for="gridRadios2">
                                               ẩn
                                            </label>
                                        </div>
                           
                                    </div>


                             


                                </div>

                                <div class="d-flex">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div> <!-- content -->
@endsection

@section('js')
<script>
    function showImage(event) {
        const imgCategory = document.querySelector('#img_category');
        // console.log(imgCategory);
        const file = event.target.files[0];
        const reader = new FileReader();
    
        reader.onload = function() {
            imgCategory.src = reader.result;
            imgCategory.style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
    </script>
    
@endsection

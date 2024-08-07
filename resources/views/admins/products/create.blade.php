@extends('layouts.admin')

@section('content')

@section('title')
    {{ $title }}
@endsection

@section('css')
    <link href="{{ asset('assets/admin/assets/libs/quill/quill.core.js') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/assets/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/assets/libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css')}}/" />
@endsection

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Thêm Mới Sản Phẩm</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ $title }}</h5>
                        </div><!-- end card header -->

                        <div class="card-body">

                            <form action="{{ route('admins.products.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="slug" class="form-label">Mã Sản phẩm</label>
                                            <input type="text" id="slug" name="slug" is-invalid
                                                class="form-control @error('slug') @enderror"
                                                value="{{ old('slug') }}" placeholder="mã sản phẩm">
                                            @error('slug')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3">
                                            <label for="name_product" class="form-label">Tên Sản phẩm</label>
                                            <input type="text" id="name_product" name="name_product" is-invalid
                                                class="form-control @error('name_product') @enderror"
                                                value="{{ old('name_product') }}" placeholder="Tên sản phẩm">
                                            @error('name_product')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3">
                                            <label for="price_regular" class="form-label">giá Sản phẩm</label>
                                            <input type="number" id="price_regular" name="price_regular" is-invalid
                                                class="form-control @error('price_regular') @enderror"
                                                value="{{ old('price_regular') }}" placeholder="giá sản phẩm">
                                            @error('price_regular')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>




                                        <div class="mb-3">
                                            <label for="price_sale" class="form-label">giá Sale</label>
                                            <input type="text" id="price_sale" name="price_sale" is-invalid
                                                class="form-control @error('price_sale') @enderror"
                                                value="{{ old('price_sale') }}" placeholder="giá giảm">
                                            @error('price_sale')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>



                                        <div class="mb-3">
                                            <label for="category_id" class="form-label">Danh mục </label>
                                            <select name="category_id" id=""
                                                class="form-control @error('category_id') @enderror">
                                                <option value="">--Chọn danh mục --</option>
                                                @foreach ($listCate as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('category_id') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name_category }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3">
                                            <label for="quantity" class="form-label">Số lương </label>
                                            <input type="number" id="quantity" name="quantity" is-invalid
                                                class="form-control @error('quantity') @enderror"
                                                value="{{ old('quantity') }}" placeholder="số lượng">
                                            @error('quantity')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3">
                                            <label for="input_day" class="form-label">Ngày nhập</label>
                                            <input type="date" id="input_day" name="input_day" is-invalid
                                                class="form-control @error('input_day') @enderror"
                                                value="{{ old('input_day') }}" placeholder="ngày nhập">
                                            @error('input_day')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3">
                                            <label for="description" class="form-label">Mổ Tả ngắn</label>
                                            <textarea name="description" id="description" rows="3" class="form-control"{{ old('description') }}
                                                placeholder="Mô tả ngắn"></textarea>
                                            @error('description')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3">
                                            <label for="thumbnail_url" class="form-label">imgae</label>
                                            <input type="file" id="image" name="thumbnail_url" is-invalid
                                                class="form-control " onchange="showImage(event)">
                                            <img id="img_category" src="" alt="Hình ảnh sản phẩm"
                                                style="width:150px; display:none">

                                        </div>
                                        <label for="" class="form-lable">Tùy CHỈNH KHÁC</label>
                                        <div class=" form-switch ps-3 mb-2 d-flex justify-content-between">

                                            <div class="form-check">
                                                <input class="form-check-input bg-primary" type="checkbox"
                                                    role="switch" id="is_new" name="is_new" checked>
                                                <label class="form-check-label " for="is_new">IS NEW</label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input bg-danger" type="checkbox"
                                                    role="switch" id="is_hot" name="is_hot" checked>
                                                <label class="form-check-label " for="is_hot">IS HOT</label>
                                            </div>



                                            <div class="form-check">
                                                <input class="form-check-input bg-warning" type="checkbox"
                                                    role="switch" id="is_hot_deal" name="is_hot_deal" checked>
                                                <label class="form-check-label  " for="is_hot_deal">IS HOT
                                                    DEAL</label>
                                            </div>


                                            <div class="form-check">
                                                <input class="form-check-input bg-success" type="checkbox"
                                                    role="switch" id="is_show_home" name="is_show_home" checked>
                                                <label class="form-check-label" for="is_show_home">IS SHOW
                                                    HOME</label>
                                            </div>
                                        </div>

                                        <div class="col-sm-10 d-flex gap-2 mb-3">
                                            <label for="is_type" class="form-label">Status</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="	is_type"
                                                    id="gridRadios1" value="1" checked>
                                                <label class="form-check-label text-success" for="gridRadios1">
                                                    Hiển Thị
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="	is_type"
                                                    id="gridRadios2" value="0">
                                                <label class="form-check-label text-danger" for="gridRadios2">
                                                    ẩn
                                                </label>
                                            </div>

                                        </div>



                                    </div>

                                    <div class="col-lg-8">
                                        <div class="mb-3">
                                            <label for="" class="form-lable">Mô tả chi tiết sản phẩm</label>
                                            <div id="quill-editor" style="height: 400px;">
                                                <h1>Nhập mô tả sản phẩm</h1>

                                            </div>
                                            <textarea name="content" id="content_content" class="d-none"></textarea>
                                        </div>

                                        <div class="mb-3">

                                            <label for="imgae" class="form-label">Album hình ảnh
                                                <i id="add-row"
                                                    class="mdi mdi-plus text-muted fs-18 rounded-2 border ms-3 p-1"
                                                    style="cursor: pointer"></i>
                                                <table class="table align-middle table-nowrap mb-0">
                                                    <tbody class="image-table-body">
                                                        <tr>
                                                            <td class="d-flex align-items-center">
                                                                <img id="preview_0"
                                                                    src="https://tse4.mm.bing.net/th?id=OIP.vvw2IUQiW28Dy1tgcFDFNgHaHa&pid=Api&P=0&h=220"
                                                                    alt="Hình ảnh sản phẩm" style="width:50px"
                                                                    class="me-3">
                                                                <input type="file" id="image"
                                                                    name="list_image[id_0]" is-invalid
                                                                    class="form-control "
                                                                    onchange="previewImage(this, 0)">

                                                            </td>
                                                            <td>
                                                                    <i class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1" style="cursor: pointer"></i>

                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
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
    <script src="{{ asset('assets/admin/assets/libs/quill/quill.core.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/libs/quill/quill.min.js') }}"></script>
    {{-- <script src="{{asset('assets/admin/assets/js/pages/quilljs.init.js')}}"></script> --}}

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var quill = new Quill("#quill-editor", {
                theme: "snow",
            })
            // hiển thị nội dung cũ
            var old_contnent = `{!! old('content') !!}`;
            quill.root.innerHTML = old_contnent
            //cập nhật lại textarea ẩn khi nội dung của quill-editor thay đổi
            quill.on('text-change', function() {
                var html = quill.root.innerHTML;
                document.querySelector('#content_content').value = html;
            })
        })
    </script>

    {{--   thêm anbum ảnh --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var rowCount = 1;

            document.getElementById('add-row').addEventListener('click', function() {
                var tableBody = document.querySelector('.image-table-body');
            var newRow = document.createElement('tr');

            newRow.innerHTML = `
                    <td class="d-flex align-items-center">
                        <img id="preview_${rowCount}" src="https://tse4.mm.bing.net/th?id=OIP.vvw2IUQiW28Dy1tgcFDFNgHaHa&pid=Api&P=0&h=220" alt="Hình ảnh sản phẩm" style="width:50px" class="me-3">
                        <input type="file" id="image_${rowCount}" name="list_image[id_${rowCount}]" class="form-control" onchange="previewImage(this, ${rowCount})">
                    </td>
                    <td>
                        <i class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1" style="cursor: pointer" onclick="removeRow(this)"></i>
                    </td>
                `;
                tableBody.appendChild(newRow);
                rowCount ++;
            })

        })

        function previewImage(input, rowIndex) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById(`preview_${rowIndex}`).setAttribute('src',e.target.result) 
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeRow(element) {
            var row = element.closest('tr');
            row.parentNode.removeChild(row);
        }
    </script>
@endsection

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
                    <h4 class="fs-18 fw-semibold m-0">Quản lý đơn hàng</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ $title }}</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                  <th>Thôn tin tài khoản đặt hàng</th>
                                  <th>Thôn tin tin người nhận hàng</th>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>
                                        <ul>
                                            <li>tên tài khoản: <b>{{$donhang->user->name}}</b></li>
                                            <li>tên tài khoản: <b>{{$donhang->user->email}}</b></li>
                                            <li>tên tài khoản: <b>{{$donhang->user->phone}}</b></li>
                                            <li>tên tài khoản: <b>{{$donhang->user->address}}</b></li>
                                            <li>tên tài khoản: <b>{{$donhang->user->role}}</b></li>
                                        </ul>
                                    </td>
                                  <td>

                                    <p>Tên người nhận: <strong>{{ $donhang->name_receiver }}</strong></p>
                                    <p>số điện thoại: <strong>{{ $donhang->phone_receiver }}</strong></p>
                                    <p>Email: <strong>{{ $donhang->email_receiver }}</strong></p>
                                    <p>Địa chỉ: <strong>{{ $donhang->Address }}</strong></p>
                                    <p>Trạng thái đơn hàng: <strong>{{ $trangThaiDonHang[$donhang->status_bill] }}</strong></p>
                                    <p>Trạng thái thanh toán:
                                        <strong>{{ $trangThaiThanhToan[$donhang->status_payment] }}</strong></p>
                                    <p>Ngày đặt hàng: <strong>{{ $donhang->created_at->format('d-m-Y') }}</strong></p>
                                    <p>Ghi chú: <strong>{{ $donhang->note }}</strong></p>
                                    <p>Tổng tiền: <strong>{{ number_format($donhang->subtotal, 0, '', '.') }}đ</strong></p>
                                    <p>phí ship: <strong>{{ number_format($donhang->shipping, 0, '', '.') }}đ</strong></p>
                                    <h3>Thành tiền: <strong class="text-danger">{{ number_format($donhang->total, 0, '', '.') }}đ</strong></h3>
                                  </td>
                                </tr>
                                </tbody>
                            </table>
           
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">sản phẩm của đơn hàng</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Hình ảnh</th>
                                        <th>Mã sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Đơn giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($donhang->billDentail as $item)
                                        @php
                                            $itemProduct = $item->product;
                                        @endphp
                                        <tr>
                                            <td>
                                                <img src="{{ Storage::url($itemProduct->thumbnail_url) }}"
                                                    alt="" width="75px">
                                            </td>
                                            <td>{{ $itemProduct->slug }}</td>
                                            <td>{{ $itemProduct->name_product }}</td>
                                            <td>{{ number_format($item->don_gia, 0, '', '.') }}đ</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ number_format($item->total_amount, 0, '', '.') }}đ</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
           
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

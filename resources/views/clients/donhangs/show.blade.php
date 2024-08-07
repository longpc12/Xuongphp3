@extends('layouts.client')

@section('css')
    <style>

    </style>
@endsection

@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="shop.html">shop</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Chi tiết đơn hàng</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cart-main-wrapper section-padding">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="myaccount-content">
                            <h5>Thông tin đơn hàng: <span>{{ $donhang->code_orders }}</span></h5>
                            <div class="welcome">
                                <p>Tên người nhận: <strong>{{ $donhang->name_receiver }}</strong></p>
                                <p>số điện thoại: <strong>{{ $donhang->phone_receiver }}</strong></p>
                                <p>Email: <strong>{{ $donhang->email_receiver }}</strong></p>
                                <p>Địa chỉ: <strong>{{ $donhang->Address }}</strong></p>
                                <p>Trạng thái đơn hàng: <strong>{{ $trangThaiDonHang[$donhang->status_bill] }}</strong></p>
                                <p>Trạng thái thanh toán:
                                    <strong>{{ $trangThaiThanhToan[$donhang->status_payment] }}</strong></p>
                                <p>Tổng tiền: <strong>{{ number_format($donhang->subtotal, 0, '', '.') }}đ</strong></p>
                                <p>phí ship: <strong>{{ number_format($donhang->shipping, 0, '', '.') }}đ</strong></p>
                                <p>Thành tiền: <strong>{{ number_format($donhang->total, 0, '', '.') }}đ</strong></p>
                                <p>Ngày đặt hàng: <strong>{{ $donhang->created_at->format('d-m-Y') }}</strong></p>
                                <p>Ghi chú: <strong>{{ $donhang->note }}</strong></p>

                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="myaccount-content">
                            <h5>Sản phẩm</h5>
                            <div class="myaccount-table table-responsive text-center">
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

            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection

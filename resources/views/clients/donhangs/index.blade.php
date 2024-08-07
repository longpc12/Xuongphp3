@extends('layouts.client')

@section('css')
    <style>

    </style>
@endsection

@section('content')
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="shop.html">shop</a></li>
                                <li class="breadcrumb-item active" aria-current="page">My Order</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- cart main wrapper start -->
    <div class="cart-main-wrapper section-padding">
        <div class="container">
            <div class="section-bg-color">
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                {{session('error')}}
             <button type="button"  class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>           
            @endif

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show " role="alert">
            {{session('success')}}
             <button type="button"  class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>           
            @endif
                <div class="row">
                    <div class="col-lg-12">
                     
                            <!-- Cart Table Area -->
                            <div class="cart-table table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="pro-thumbnail">Mã Đơn hàng</th>
                                            <th class="pro-title">Ngày đặt</th>
                                            <th class="pro-price">Trạng thái</th>
                                            <th class="pro-quantity">tổng tiền</th>
                                            <th class="pro-subtotal">Hành Động</th>
                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($donHang as $item)
                                            <tr>
                                                <th class="text-center">
                                              <a href="{{route('user.oders.show', $item->id)}}" >
                                                    {{$item->code_orders}}
                                                      </a> 
                                                </th>

                                                <td>
                                                    {{$item->created_at->format('d-m-Y')}}
                                                </td>

                                                <td>
                                                    {{$trangThaiDonHang[$item->status_bill]}}
                                                </td>

                                                <td>
                                                    {{ number_format($item->total, 0, '', '.') }}
                                                </td>

                                                <td>
                                                    <a href="{{route('user.oders.show', $item->id)}}" class="btn btn-sqr">
                                                        View
                                                    </a>

                                                    <form action="{{route('user.oders.update', $item->id)}}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        
                                                        @if ($item->status_bill === $type_cho_xac_nhan)
                                                        <input type="hidden" name="cho_xac_nhan" value="1">
                                                        <button type="submit" class="btn btn-sqr bg-danger"
                                                         onclick="return confirm('bạn có xác nhận hủy đơn không?')">Hủy</button>
                                                            
                                                          @elseif ($item->status_bill === $type_dang_van_chuyen)
                                                          <input type="hidden" name="dang_van_chuyen" value="1">
                                                          <button type="submit" class="btn btn-sqr bg-success"
                                                           onclick="return confirm('Xác nhận đã nhận hàng')">Đã nhận hàng</button>
                                                        @endif
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Cart Update Option -->
                            <div class="cart-update-option d-block d-md-flex justify-content-end">
                                {{-- <div class="apply-coupon-wrapper">
                                    <form action="#" method="post" class="d-block d-md-flex">
                                        <input type="text" placeholder="Enter Your Coupon Code" required />
                                        <button class="btn btn-sqr">Apply Coupon</button>
                                    </form>
                                </div> --}}
                                <div class="cart-update">
                                    <button type="submit" class="btn btn-sqr">Update Cart</button>

                                </div>
                            </div>
                     
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-lg-5 ml-auto">
                        <!-- Cart Calculation Area -->
                        <div class="cart-calculator-wrapper">
                            <div class="cart-calculate-items">
                                <h6>Cart Totals</h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td>Sub Total</td>
                                            <td class="sub-total">{{ number_format($subTotal, 0, '', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Shipping</td>
                                            <td class="shipping">{{ number_format($shipping, 0, '', '.') }}</td>
                                        </tr>
                                        <tr class="total">
                                            <td>Total</td>
                                            <td class="total-amount">{{ number_format($total, 0, '', '.') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <a href="{{route('user.oders.create')}}" class="btn btn-sqr d-block">Proceed Checkout</a>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- cart main wrapper end -->
@endsection

@section('js')

@endsection

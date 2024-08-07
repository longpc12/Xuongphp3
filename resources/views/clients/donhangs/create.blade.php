@extends('layouts.client')

@section('css')
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
                                <li class="breadcrumb-item active" aria-current="page">Đặt Hàng</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- checkout main wrapper start -->
    <div class="checkout-page-wrapper section-padding">
        <div class="container">
            <div class="row">
                <!-- Checkout Billing Details -->
                <div class="col-lg-6">
                    <div class="checkout-billing-details-wrap">
                        <h5 class="checkout-title">Thông tin người nhận hàng</h5>
                        <div class="billing-form-wrap">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="single-input-item">
                                <label for="name_receiver" class="required">Tên người nhận</label>
                                <input type="text" name="name_receiver" placeholder="nhập tên người nhận" value="{{ Auth::user()->name }}" />
                            </div>
                            @error('name_receiver')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <div class="single-input-item">
                                <label for="email_receiver" class="required">Email Address</label>
                                <input type="email_receiver" name="email_receiver" placeholder="nhập email người nhận" value="{{ Auth::user()->email }}" />
                            </div>
                            @error('email_receiver')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <div class="single-input-item">
                                <label for="phone_receiver" class="required">Số điện thoại</label>
                                <input type="phone_receiver" name="phone_receiver" placeholder="nhập số điện thoại người nhận" value="{{ Auth::user()->phone }}" />
                            </div>
                            @error('phone_receiver')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <div class="single-input-item">
                                <label for="address" class="required">Địa chỉ</label>
                                <input type="address" name="Address" placeholder="nhập địa chỉ người nhận" value="{{ Auth::user()->address }}" />
                            </div>
                            @error('address')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <div class="single-input-item">
                                <label for="note">Ghi chú</label>
                                <textarea name="note" id="note" cols="30" rows="3" placeholder="nhập ghi chú"></textarea>
                            </div>
                            @error('note')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- Order Summary Details -->
                <div class="col-lg-6">
                    <div class="order-summary-details">
                        <h5 class="checkout-title">Thông tin đơn hàng</h5>
                        <div class="order-summary-content">
                            <!-- Order Summary Table -->
                            <div class="order-summary-table table-responsive text-center">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Products</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carts as $key => $item)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('user.product.detail', $key) }}">
                                                        {{ $item['ten_san_pham'] }} <strong> × {{ $item['so_luong'] }}</strong>
                                                    </a>
                                                </td>
                                                <td>{{ number_format($item['gia'] * $item['so_luong'], 0, '', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>Sub Total</td>
                                            <td><strong>{{ number_format($subTotal, 0, '', '.') }}</strong></td>
                                            <input type="hidden" name="subtotal" value="{{ $subTotal }}">
                                        </tr>
                                        <tr>
                                            <td>Shipping</td>
                                            <td class="d-flex justify-content-center">
                                                <ul class="shipping-type">
                                                    <strong>{{ number_format($shipping, 0, '', '.') }}</strong>
                                                    <input type="hidden" name="shipping" value="{{ $shipping }}">
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total Amount</td>
                                            <td><b>{{ number_format($total, 0, '', '.') }}</b></td>
                                            <input type="hidden" name="total" value="{{ $total }}">
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- Order Payment Method -->
                            <div class="order-payment-method">
                                <div class="single-payment-method">
                                    <div class="payment-method-name">
                                        <button type="submit" form="cash-form" class="btn btn-sqr">Thanh toán khi giao hàng</button>
                                    </div>
                                </div>
                                <div class="single-payment-method">
                                    <div class="payment-method-name">
                                        <button type="submit" form="vnpay-form" class="btn btn-sqr" name="redirect">Thanh toán qua VNPAY</button>
                                    </div>
                                    <div class="payment-method-details" data-method="vnpay">
                                        <label for="bank_code">Chọn ngân hàng</label>
                                        <select name="bank_code" id="bank_code" class="form-control">
                                            <option value="">Không chọn</option>
                                            <option value="NCB">Ngân hàng NCB</option>
                                            <!-- Thêm các ngân hàng khác tại đây -->
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hidden Forms for Submission -->
                <form id="cash-form" action="{{ route('user.oders.store') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="name_receiver" value="{{ Auth::user()->name }}">
                    <input type="hidden" name="email_receiver" value="{{ Auth::user()->email }}">
                    <input type="hidden" name="phone_receiver" value="{{ Auth::user()->phone }}">
                    <input type="hidden" name="Address" value="{{ Auth::user()->address }}">
                    <input type="hidden" name="note" id="cash-note">
                    <input type="hidden" name="subtotal" value="{{ $subTotal }}">
                    <input type="hidden" name="shipping" value="{{ $shipping }}">
                    <input type="hidden" name="total" value="{{ $total }}">
                    <input type="hidden" name="payment_method" value="cash">
                </form>

                <form id="vnpay-form" action="{{ route('vnpay.payment') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="name_receiver" value="{{ Auth::user()->name }}">
                    <input type="hidden" name="email_receiver" value="{{ Auth::user()->email }}">
                    <input type="hidden" name="phone_receiver" value="{{ Auth::user()->phone }}">
                    <input type="hidden" name="Address" value="{{ Auth::user()->address }}">
                    <input type="hidden" name="note" id="vnpay-note">
                    <input type="hidden" name="subtotal" value="{{ $subTotal }}">
                    <input type="hidden" name="shipping" value="{{ $shipping }}">
                    <input type="hidden" name="total" value="{{ $total }}">
                    <input type="hidden" name="payment_method" value="vnpay">
                    <input type="hidden" name="bank_code" id="vnpay-bank-code" value="NCB"> <!-- Đặt giá trị mặc định cho bank_code -->
                </form>
                
            </div>
        </div>
    </div>
    <!-- checkout main wrapper end -->
@endsection

@section('js')
<script>
    $(document).ready(function() {
        // Copy note value to hidden forms on submit
        $('#cash-form').submit(function() {
            $('#cash-note').val($('#note').val());
        });

        $('#vnpay-form').submit(function() {
            $('#vnpay-note').val($('#note').val());
            $('#vnpay-bank-code').val($('#bank_code').val() || 'NCB');
        });
    });
</script>
@endsection

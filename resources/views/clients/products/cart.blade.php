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
                                <li class="breadcrumb-item active" aria-current="page">cart</li>
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
                @if (session('error'))
                    <div class="alert alert-error alert-dismissible fade show " role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-12">
                        <form action="{{ route('user.product.updateCart') }}" method="POST">
                            @csrf
                            <!-- Cart Table Area -->
                            <div class="cart-table table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="pro-thumbnail">Thumbnail</th>
                                            <th class="pro-title">Product</th>
                                            <th class="pro-price">Price</th>
                                            <th class="pro-quantity">Quantity</th>
                                            <th class="pro-subtotal">Total</th>
                                            <th class="pro-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart as $key => $item)
                                            <tr>
                                                <td class="pro-thumbnail"><a href="#">
                                                        <img class="img-fluid" src="{{ Storage::url($item['hinh_anh']) }}"
                                                            alt="Product" /></a>
                                                    <input type="hidden" name="cart[{{ $key }}][hinh_anh]"
                                                        value="{{ $item['hinh_anh'] }}">
                                                </td>
                                                <td class="pro-title">
                                                    <a href="{{ route('user.product.detail', $key) }}">{{ $item['ten_san_pham'] }}
                                                    </a>
                                                    <input type="hidden" name="cart[{{ $key }}][ten_san_pham]"
                                                        value="{{ $item['ten_san_pham'] }}">

                                                </td>
                                                <td class="pro-price">
                                                    <span>{{ number_format($item['gia'], 0, '', '.') }}đ</span>
                                                    <input type="hidden" name="cart[{{ $key }}][gia]"
                                                        value="{{ $item['gia'] }}">

                                                </td>
                                                <td class="pro-quantity">
                                                    <div class="pro-qty">

                                                        <input type="text" value="{{ $item['so_luong'] }}"
                                                            id="quantityInput" class="quantityInput"
                                                            data-price="{{ $item['gia'] }}"
                                                            name=" cart[{{ $key }}][so_luong]">

                                                    </div>
                                                </td>
                                                <td class="pro-subtotal">
                                                    <span
                                                        class="subtotal">{{ number_format($item['gia'] * $item['so_luong'], 0, '', '.') }}
                                                    </span>
                                                </td>
                                                <td class="pro-remove"><a href="#"><i class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Cart Update Option -->
                            <div class="cart-update-option d-block d-md-flex justify-content-end">
                                <div class="apply-coupon-wrapper">
                                    <input type="text" name="voucher_code" id="voucher_code" placeholder="Enter Your Voucher Code"  />
                                    <button type="button" class="btn btn-sqr" id="applyVoucher">Apply Voucher</button>
                                </div>
                                <div class="cart-update">
                                    <button type="submit" class="btn btn-sqr">Update Cart</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 ml-auto">
                        <!-- Cart Calculation Area -->
                        <div class="cart-calculator-wrapper">
                            <div class="cart-calculate-items">
                                <h6>Cart Totals</h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td>Sub Total</td>
                                            <td class="sub-total">{{ number_format($subTotal, 0, '', '.') }}đ</td>
                                        </tr>
                                        <tr>
                                            <td>Shipping</td>
                                            <td class="shipping">{{ number_format($shipping, 0, '', '.') }}đ</td>
                                        </tr>
                                        <tr class="total">
                                            <td>Total</td>
                                            <td class="total-amount">{{ number_format(($subTotal + $shipping), 0, '', '.') }}đ</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <a href="{{ route('user.oders.create') }}" class="btn btn-sqr d-block">Proceed Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart main wrapper end -->
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Thêm nút tăng giảm vào ô nhập số lượng
            $('.pro-qty').prepend('<span class="dec qtybtn">-</span>');
            $('.pro-qty').append('<span class="inc qtybtn">+</span>');

            // Hàm cập nhật tổng giỏ hàng
            function updateTotal(subTotal, shipping) {
                var total = shipping + subTotal;
                $('.sub-total').text(subTotal.toLocaleString('vi-VN') + 'đ');
                $('.total-amount').text(total.toLocaleString('vi-VN') + 'đ');
            }

            // Xử lý sự kiện khi nhấn nút tăng hoặc giảm
            $('.qtybtn').on('click', function() {
                var $button = $(this);
                var $input = $button.siblings('input'); // Lấy ô nhập số lượng
                var oldValue = parseInt($input.val(), 10); // Chuyển đổi giá trị thành số nguyên

                var newValue;
                if ($button.hasClass('inc')) {
                    newValue = oldValue + 1;
                } else if ($button.hasClass('dec')) {
                    newValue = oldValue - 1;
                    // Không cho phép giảm số lượng dưới 1
                    if (newValue < 1) {
                        newValue = 1;
                    }
                }

                $input.val(newValue); // Cập nhật giá trị của ô nhập

                // Cập nhật lại giá trị của subtotal
                var price = parseFloat($input.data('price'));
                var subtotalElements = $input.closest('tr').find('.subtotal');
                var newSubtotal = newValue * price;
                subtotalElements.text(newSubtotal.toLocaleString('vi-VN') + 'đ');

                // Tính lại tổng giỏ hàng
                var subTotal = 0;
                $('.quantityInput').each(function() {
                    var $input = $(this);
                    var price = parseFloat($input.data('price'));
                    var quantity = parseFloat($input.val());
                    subTotal += price * quantity;
                });

                var shipping = parseFloat($('.shipping').text().replace(',', ''));
                updateTotal(subTotal, shipping);
            });

            // Xử lý khi người dùng nhập số âm hoặc không hợp lệ
            $('.quantityInput').on('change blur', function() {
                var value = parseInt($(this).val(), 10);
                if (isNaN(value) || value < 1) {
                    alert('Số lượng phải lớn hơn hoặc bằng 1');
                    $(this).val(1); // Đặt lại giá trị nếu nhập số âm hoặc không phải số
                }
                var price = parseFloat($(this).data('price'));
                var subtotalElements = $(this).closest('tr').find('.subtotal');
                var newSubtotal = value * price;
                subtotalElements.text(newSubtotal.toLocaleString('vi-VN') + 'đ');

                // Tính lại tổng giỏ hàng
                var subTotal = 0;
                $('.quantityInput').each(function() {
                    var $input = $(this);
                    var price = parseFloat($input.data('price'));
                    var quantity = parseFloat($input.val());
                    subTotal += price * quantity;
                });

                var shipping = parseFloat($('.shipping').text().replace(',', ''));
                updateTotal(subTotal, shipping);
            });

            // Xử lý xóa sản phẩm trong giỏ hàng
            $('.pro-remove').on('click', function(event) {
                event.preventDefault(); // Chặn thao tác mặc định của thẻ a
                var $row = $(this).closest('tr'); // Lấy đối tượng tr chứa sản phẩm
                $row.remove(); // Xóa hàng

                // Tính lại tổng giỏ hàng
                var subTotal = 0;
                $('.quantityInput').each(function() {
                    var $input = $(this);
                    var price = parseFloat($input.data('price'));
                    var quantity = parseFloat($input.val());
                    subTotal += price * quantity;
                });

                var shipping = parseFloat($('.shipping').text().replace(',', ''));
                updateTotal(subTotal, shipping);
            });

            // Xử lý sự kiện khi nhấn nút "Apply Voucher"
            $('#applyVoucher').on('click', function() {
                var voucherCode = $('#voucher_code').val();
                if (voucherCode) {
                    $.ajax({
                        url: '{{ route("user.product.applyVoucher") }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            voucher_code: voucherCode
                        },
                        success: function(response) {
                            if (response.success) {
                                var subTotal = response.subTotal;
                                var shipping = response.shipping;
                                updateTotal(subTotal, shipping);
                                alert('Voucher applied successfully!');
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function() {
                            alert('Failed to apply voucher. Please try again.');
                        }
                    });
                } else {
                    alert('Please enter a voucher code.');
                }
            });

            // Khởi tạo lại tổng giỏ hàng khi tải trang
            var subTotal = 0;
            $('.quantityInput').each(function() {
                var $input = $(this);
                var price = parseFloat($input.data('price'));
                var quantity = parseFloat($input.val());
                subTotal += price * quantity;
            });

            var shipping = parseFloat($('.shipping').text().replace(',', ''));
            updateTotal(subTotal, shipping);
        });
    </script>
@endsection

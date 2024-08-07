@component('mail::message')
    # Xác nhận đơn hàng

    xin chào {{$donHang->name_receiver}},

    Cảm ơn bạn đã đặt hàng của HL_SHOP. Đây là thông tin đơn hàng của bạn

    *** Mã đơn hàng ** {{$donHang->code_orders}}

    
    *** Sản Phẩm đã đặt **

    @foreach ($donHang->billDentail as $chiTiet )
        
    -  {{$chiTiet->product->name_receiver}} x {{$chiTiet->quantity}}: {{number_format($chiTiet->total_amount)}}VND
    @endforeach

    *** Tổng Tiền **

    {{number_format($donHang->total)}}VND

    Cảm ơn Bạn đã lựa chọn HL_SHOP chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất để xác nhận đơn hàng!
    Trân trọng cảm ơn!
@endcomponent
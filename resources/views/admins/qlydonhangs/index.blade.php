@extends('layouts.admin')

@section('content')

@section('title')
    {{ $title }}
@endsection

@section('css')

<style>
    .table th, .table td {
        vertical-align: middle;
    }
    .qr-code {
   
        justify-content: center;
        align-items: center;
    }
</style>
@endsection

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="row py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1 col-xl-6">
                    <h4 class="fs-18 fw-semibold m-0">Quản Lý Đơn Hàng</h4>
                </div>
            </div>

            <!-- Striped Rows -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ $title }}</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive">

                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show " role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show " role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <table class="table table-striped mb-0 text-center">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="pro-thumbnail">Mã Đơn hàng</th>
                                            <th class="pro-title">Ngày đặt</th>
                                            <th class="pro-price">Trạng thái Thanh Toán</th>
                                            <th class="pro-price">Hình thức thanh toán</th>
                                            <th class="pro-quantity">Tổng tiền</th>
                                            <th class="pro-quantity">Điều Chỉnh Trạng Thái</th>
                                            <th class="pro-subtotal">Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listDonHang as $item)
                                            <tr>
                                                <td class="text-center">
                                                    <a href="{{ route('admins.qlydonhangs.show', $item->id) }}">
                                                        {{ $item->code_orders }}
                                                    </a>
                                                </td>

                                                <td>
                                                    {{ $item->created_at->format('d-m-Y') }}
                                                </td>

                                                <td>
                                                    @if ($item->status_payment === $da_thanh_toan)
                                                    {{ $trangThaiThanhToan[$item->status_payment] }}
                                                    @else
                                                    {{ $trangThaiThanhToan[$item->status_payment] }}
                                                    @endif
                                                </td>

                                                <td class="qr-code">
                                                    @if ($item->pay_status == 0)
                                                     
                                                        <div>
                                                            {!! QrCode::size(100)->generate($item->code_orders) !!}
                                                        </div>
                                                    @else
                                                        Tiền mặt
                                                    @endif
                                                </td>

                                                <td>
                                                    {{ number_format($item->total, 0, '', '.') }}
                                                </td>

                                                <td>
                                                    @if ($type_huy_don_hang === $item->status_bill)
                                                        <button type="button" class="btn btn-danger btn-sm text-center" disabled> {{ $trangThaiDonHang[$item->status_bill] }}</button>
                                                    @else
                                                        <form action="{{ route('admins.qlydonhangs.update', $item->id) }}" class="text-center" method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <select name="trang_thai_don_hang" class="form-select w-75 text-center" 
                                                            id="" onchange="confirmSubmit(this)" data-default-value="{{ $item->status_bill }}">
                                                                @foreach ($trangThaiDonHang as $key => $value)
                                                                    <option value="{{ $key }}" {{ $key === $item->status_bill ? 'selected' : '' }}>
                                                                        {{ $value }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </form>
                                                    @endif
                                                </td>

                                                <td>
                                                    <a href="{{ route('admins.qlydonhangs.show', $item->id) }}"><i class="mdi mdi-eye text-muted fs-18 rounded-2 border p-1 me-1"></i></a>
                                                    @if ($item->status_bill === $type_huy_don_hang)
                                                        <form action="{{ route('admins.qlydonhangs.destroy', $item->id) }}" 
                                                            method="POST" class="d-inline"
                                                             onsubmit="return confirm('Bạn có đồng ý muốn xóa không?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="border-0 bg-white">
                                                                <i class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"></i>
                                                            </button>
                                                        </form>
                                                    @endif
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
<script>
    function confirmSubmit(selectElement) {
        var form = selectElement.form;
        var selectedOption = selectElement.options[selectElement.selectedIndex].text;
        var defaultValue = selectElement.getAttribute('data-default-value');

        if (confirm('Bạn có chắc chắn thay đổi đơn hàng thành "' + selectedOption + '" không?')) {
            form.submit();
        } else {
            selectElement.value = defaultValue;
        }
    }
</script>
@endsection

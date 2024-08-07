@extends('layouts.client')

@section('css')
    <style>
        .tab-one{
            img{
                max-width: 250px;
            }
        }
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
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="">shop</a></li>
                            <li class="breadcrumb-item active" aria-current="page">product details</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->

<!-- page main wrapper start -->
<div class="shop-main-wrapper section-padding pb-0">
    <div class="container">
        <div class="row">
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
            {{session('error')}}
         <button type="button"  class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>           
        @endif
            <!-- product details wrapper start -->
            <div class="col-lg-12 order-1 order-lg-2">
                <!-- product details inner end -->
                <div class="product-details-inner">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="product-large-slider">
                                <div class="pro-large-img img-zoom">
                                    <img src="{{ Storage::url($dentailProduct->thumbnail_url) }}" alt="product-details" />
                                </div>
                                @foreach ($dentailProduct->ProductImage as $item)
                                    <div class="pro-large-img img-zoom">
                                        <img src="{{ Storage::url($item->image) }}" alt="product-details" />
                                    </div>
                                @endforeach
                            </div>
                            <div class="pro-nav slick-row-10 slick-arrow-style">
                                <div class="pro-nav-thumb">
                                    <img src="{{ Storage::url($dentailProduct->thumbnail_url) }}" alt="product-details" />
                                </div>
                                @foreach ($dentailProduct->ProductImage as $item)
                                    <div class="pro-nav-thumb">
                                        <img src="{{ Storage::url($item->image) }}" alt="product-details" />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="product-details-des">
                                <div class="manufacturer-name">
                                    <a href="#">HasTech</a>
                                </div>
                                <h3 class="product-name">{{ $dentailProduct->name_product }}</h3>
                                <div class="ratings d-flex">
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <div class="pro-review">
                                        <span>{{ $dentailProduct->view }}</span>
                                    </div>
                                </div>
                                <div class="price-box">
                                    <span class="price-regular">{{ number_format($dentailProduct->price_sale, 0, '', '.') }}đ</span>
                                    <span class="price-old"><del>{{ number_format($dentailProduct->price_regular, 0, '', '.') }}đ</del></span>
                                </div>
                                <h5 class="offer-text"><strong>Hurry up</strong>! offer ends in:</h5>
                                <div class="product-countdown" data-countdown="2022/12/20"></div>
                                <div class="availability">
                                    <i class="fa fa-check-circle"></i>
                                    <span>Số Lượng : {{ $dentailProduct->quantity }}</span>
                                </div>
                                <p class="pro-desc">{{ $dentailProduct->description }}</p>
                                <form action="{{ route('user.product.addToCart') }}" method="POST">
                                    @csrf
                                    <div class="quantity-cart-box d-flex align-items-center">
                                        <h6 class="option-title">qty:</h6>
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <span class="dec qtybtn">-</span>
                                                <input type="text" value="1" name="quantity" id="quantityInput">
                                                <span class="inc qtybtn">+</span>
                                            </div>
                                            <input type="hidden" name="product_id" value="{{ $dentailProduct->id }}">
                                        </div>
                                        <div class="action_link">
                                            <button type="submit" class="btn btn-cart2">Add to cart</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="useful-links">
                                    <a href="#" data-bs-toggle="tooltip" title="Compare"><i class="pe-7s-refresh-2"></i>compare</a>
                                    <a href="#" data-bs-toggle="tooltip" title="Wishlist"><i class="pe-7s-like"></i>wishlist</a>
                                </div>
                                <div class="like-icon">
                                    <a class="facebook" href="#"><i class="fa fa-facebook"></i>like</a>
                                    <a class="twitter" href="#"><i class="fa fa-twitter"></i>tweet</a>
                                    <a class="pinterest" href="#"><i class="fa fa-pinterest"></i>save</a>
                                    <a class="google" href="#"><i class="fa fa-google-plus"></i>share</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product details inner end -->

                <!-- product details reviews start -->
                <div class="product-details-reviews section-padding pb-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product-review-info">
                                <ul class="nav review-tab">
                                    <li>
                                        <a class="active" data-bs-toggle="tab" href="#tab_one">description</a>
                                    </li>
                                    <li>
                                        <a data-bs-toggle="tab" href="#tab_two">information</a>
                                    </li>
                                    <li>
                                        <a data-bs-toggle="tab" href="#tab_three">reviews ({{ $comments->count() }})</a>
                                    </li>
                                </ul>
                                <div class="tab-content reviews-tab">
                                    <div class="tab-pane fade show active" id="tab_one">
                                        <div class="tab-one">
                                            <p>{{!! $dentailProduct->content !!}}</p>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab_two">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>color</td>
                                                    <td>black, blue, red</td>
                                                </tr>
                                                <tr>
                                                    <td>size</td>
                                                    <td>L, M, S</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="tab_three">
                                        @foreach ($comments as $comment)
                                            <div class="total-reviews">
                                                <div class="rev-avatar">
                                                    <img src="{{ asset('assets/client/assets/img/about/avatar.jpg') }}" alt="">
                                                </div>
                                                <div class="review-box">
                                                    <div class="ratings">
                                                        @for ($i = 0; $i < 5; $i++)
                                                            <span class="{{ $i < $comment->rating ? 'good' : '' }}"><i class="fa fa-star"></i></span>
                                                        @endfor
                                                    </div>
                                                    <div class="post-author">
                                                        <p><span>{{ $comment->user->name }} -</span> {{ $comment->created_at->format('d M, Y') }}</p>
                                                    </div>
                                                    <p>{{ $comment->content }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                        @if($hasPurchased)
                                            <form action="{{ route('comments.store') }}" method="POST" class="review-form">
                                                @csrf
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="col-form-label"><span class="text-danger">*</span> Your Review</label>
                                                        <textarea class="form-control" name="content" required></textarea>
                                                        <input type="hidden" name="product_id" value="{{ $dentailProduct->id }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="col-form-label"><span class="text-danger">*</span> Rating</label>
                                                        &nbsp;&nbsp;&nbsp; Bad&nbsp;
                                                        <input type="radio" value="1" name="rating">
                                                        &nbsp;
                                                        <input type="radio" value="2" name="rating">
                                                        &nbsp;
                                                        <input type="radio" value="3" name="rating">
                                                        &nbsp;
                                                        <input type="radio" value="4" name="rating">
                                                        &nbsp;
                                                        <input type="radio" value="5" name="rating" checked>
                                                        &nbsp;Good
                                                    </div>
                                                </div>
                                                <div class="buttons">
                                                    <button class="btn btn-sqr" type="submit">Submit</button>
                                                </div>
                                            </form>
                                        @else
                                            <p>Bạn cần mua sản phẩm này để có thể viết đánh giá.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product details reviews end -->
            </div>
            <!-- product details wrapper end -->
        </div>
    </div>
</div>
<!-- page main wrapper end -->

<!-- related products area start -->
<section class="related-products section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- section title start -->
                <div class="section-title text-center">
                    <h2 class="title">Related Products</h2>
                    <p class="sub-title">Add related products to weekly lineup</p>
                </div>
                <!-- section title start -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                    @foreach ($listProduct as $item)
                        <!-- product item start -->
                        <div class="product-item">
                            <figure class="product-thumb">
                                <a href="{{ route('user.product.detail', $item->id) }}">
                                    <img class="pri-img" src="{{ Storage::url($item->thumbnail_url) }}" alt="product">
                                    <img class="sec-img" src="{{ Storage::url($item->thumbnail_url) }}" alt="product">
                                </a>
                                <div class="product-badge">
                                    <div class="product-label new">
                                        <span>new</span>
                                    </div>
                                    <div class="product-label discount">
                                        <span>10%</span>
                                    </div>
                                </div>
                                <form action="{{ route('user.product.addToCart') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="product_id" value="{{ $item->id }}">
                                    <div class="cart-hover">
                                        <button class="btn btn-cart">Add to cart</button>
                                    </div>
                                </form>
                            </figure>
                            <div class="product-caption text-center">
                                <div class="product-identity">
                                    <p class="manufacturer-name"><a href="product-details.html">{{ $item->category->name_category }}</a></p>
                                </div>
                                <h6 class="product-name">
                                    <a href="product-details.html">{{ $item->name_product }}</a>
                                </h6>
                                <div class="price-box">
                                    <span class="price-regular">{{ number_format($item->price_sale, 0, '', '.') }}đ</span>
                                    <span class="price-old"><del>{{ number_format($item->price_regular, 0, '', '.') }}đ</del></span>
                                </div>
                            </div>
                        </div>
                        <!-- product item end -->
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- related products area end -->
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('.pro-qty').each(function() {
            // Kiểm tra nếu các nút đã tồn tại, nếu có thì không thêm nữa
            if (!$(this).find('.dec').length) {
                $(this).prepend('<span class="dec qtybtn">-</span>');
            }
            if (!$(this).find('.inc').length) {
                $(this).append('<span class="inc qtybtn">+</span>');
            }
        });

        // Xử lý sự kiện khi nhấn nút tăng hoặc giảm
        $('.qtybtn').on('click', function() {
            var $button = $(this);
            var $input = $button.parent().find('input');
            var oldValue = parseFloat($input.val());

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

            $input.val(newValue);
        });

        // Xử lý khi người dùng nhập số lượng trực tiếp
        $('#quantityInput').on('change', function() {
            var value = parseInt($(this).val(), 10);
            if (isNaN(value) || value < 1) {
                alert('Số lượng phải lớn hơn hoặc bằng 1');
                $(this).val(1);
            }
        });
    });
</script>
@endsection

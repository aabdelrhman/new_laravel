@extends('frontLayouts.master')
@section('title')
    {{ __('messages.Home') }}
@endsection
@section('main')
@php
$brands = App\Models\Brand::selectBrandBlade()->get();
$sections = App\Models\Section::selection()->get();
$data = array() ;
    if(isset($products)){
        $data = $products ;
    }elseif (isset($brand)) {
        $data = $brand->products ;
    }elseif (isset($section)) {
        $data = $section->products ;
    }
@endphp

<div class="wrap-breadcrumb">
    <ul>
        <li class="item-link"><a href="#" class="link">home</a></li>
        <li class="item-link"><span>Digital & Electronics</span></li>
    </ul>
</div>
<div class="row">

    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">

        <div class="banner-shop">
            <a href="#" class="banner-link">
                <figure><img src="{{asset('frontAssets/assets/images/shop-banner.jpg')}}" alt=""></figure>
            </a>
        </div>

        <div class="wrap-shop-control">

            <h1 class="shop-title">Products</h1>

        </div><!--end wrap shop control-->

        <div class="row">

            <ul class="product-list grid-products equal-container" id="product">
                @if (isset($data))
                    @foreach ($data as $product)
                        <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                            <div class="product product-style-3 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                        <figure><img src="{{asset('/images/Product/'.$product->photos[0])}}" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                    </a>
                                    <div class="group-flash">
                                        @if (isset($product->offer))
                                            <span class="flash-item sale-label">{{$product->offer->offer_ratio}}% OFFER</span>
                                            @php
                                                $price       = (int)$product->price;  //Price befor offer
                                                $offer_ratio = (int)$product->offer->offer_ratio;  //offer ratio
                                                $discount    = round($price/$offer_ratio , 2) ;  //Discount offer
                                                $new_price   = $price - $discount ;  //new price after discount
                                            @endphp
                                        @endif
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name"><span>{{$product->desc}}</span></a>
                                    @if (isset($product->offer))
                                                <div class="wrap-price">
                                                    <ins>
                                                        <p class="product-price">${{$new_price}}</p>
                                                    </ins>
                                                    <del>
                                                        <p class="product-price">${{$product->price}}</p>
                                                    </del>
                                                </div>
                                            @else
                                                <div class="wrap-price">
                                                    <ins>
                                                        <p class="product-price">${{$product->price}}</p>
                                                    </ins>
                                                </div>
                                            @endif
                                            <form action="{{ Route('addCart') }}" method="post" class="addCart">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$product->id}}">
                                                <input type="submit" class="btn btn-danger btn-block" value="Add To Cart">
                                            </form>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>

        </div>
    </div><!--end main products area-->

    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
        <div class="widget mercado-widget categories-widget">
            <h2 class="widget-title">All Categories</h2>
            <div class="widget-content">
                <ul class="list-category">
                    @foreach ($sections as $section)
                        <li class="category-item">
                            <a href="{{Route('Front.shop.section' , $section->id)}}" class="cate-link">{{$section->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div><!-- Categories widget-->

        <div class="widget mercado-widget filter-widget brand-widget">
            <h2 class="widget-title">Brand</h2>
            <div class="widget-content">
                <ul class="list-style vertical-list list-limited">
                    {{-- <li class="list-item"><a class="filter-link active" href="#">Fashion Clothings</a></li> --}}
                    @foreach ($brands as $brand)
                    <li class="list-item"><a class="filter-link " href="{{Route('Front.shop.brand' , $brand->id)}}">{{$brand->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div><!-- brand widget-->

        <div class="widget mercado-widget filter-widget price-filter">
            <h2 class="widget-title">Price</h2>
            <form action="{{ Route('Front.price.limit') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Start</label>
                    <input type="number" name="start" id="" class="form-control" value="{{ old('start') }}">
                    @error('start')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">End</label>
                    <input type="number" name="end" id="" class="form-control" value="{{ old('end') }}">
                    @error('end')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button class="btn btn-danger btn-block" type="submit">Filter</button>

            </form>
        </div><!-- Price-->

    </div><!--end sitebar-->

</div><!--end row-->
@endsection
@section('js')
<script>
    $(document).ready(function(){

         $(".addCart").submit(function(e){
            e.preventDefault();
            $.ajaxSetup({
                statusCode: {
                    401: function(){
                        confirm('You must login or register first');
                    },
                    404: function(){
                        alert('This product not found');
                    }
                }
            });
            $.ajax({
                type:"POST",
                url:"/addCart",
                data : $(this).serialize(),
                dataType: "json",
                success:function(response) {
                    alert(response.msg) ;
                    if(response.msg == 'success massage'){
                        var cart = parseInt($('#cart').html());
                        cart++;
                        $('#cart').empty();
                        $('#cart').append(cart+' Items');
                    }

                },
            });
        });
    });
 </script>
@endsection

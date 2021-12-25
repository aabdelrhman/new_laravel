@extends('frontLayouts.master')
@section('title')
    {{ __('messages.Home') }}
@endsection
@section('main')
    <!--MAIN SLIDE-->
			<div class="wrap-main-slide">
				<div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">
					<div class="item-slide">
						<img src="{{asset('FrontAssets/assets/images/main-slider-1-1.jpg')}}" alt="" class="img-slide">
						<div class="slide-info slide-1">
							<h2 class="f-title">Kid Smart <b>Watches</b></h2>
							<span class="subtitle">Compra todos tus productos Smart por internet.</span>
							<p class="sale-info">Only price: <span class="price">$59.99</span></p>
							<a href="#" class="btn-link">Shop Now</a>
						</div>
					</div>
					<div class="item-slide">
						<img src="{{asset('FrontAssets/assets/images/main-slider-1-2.jpg')}}" alt="" class="img-slide">
						<div class="slide-info slide-2">
							<h2 class="f-title">Extra 25% Off</h2>
							<span class="f-subtitle">On online payments</span>
							<p class="discount-code">Use Code: #FA6868</p>
							<h4 class="s-title">Get Free</h4>
							<p class="s-subtitle">TRansparent Bra Straps</p>
						</div>
					</div>
					<div class="item-slide">
						<img src="{{asset('FrontAssets/assets/images/main-slider-1-3.jpg')}}" alt="" class="img-slide">
						<div class="slide-info slide-3">
							<h2 class="f-title">Great Range of <b>Exclusive Furniture Packages</b></h2>
							<span class="f-subtitle">Exclusive Furniture Packages to Suit every need.</span>
							<p class="sale-info">Stating at: <b class="price">$225.00</b></p>
							<a href="#" class="btn-link">Shop Now</a>
						</div>
					</div>
				</div>
			</div>

			<!--BANNER-->
			<div class="wrap-banner style-twin-default">
				<div class="banner-item">
					<a href="#" class="link-banner banner-effect-1">
						<figure><img src="{{asset('FrontAssets/assets/images/home-1-banner-1.jpg')}}" alt="" width="580" height="190"></figure>
					</a>
				</div>
				<div class="banner-item">
					<a href="#" class="link-banner banner-effect-1">
						<figure><img src="{{asset('FrontAssets/assets/images/home-1-banner-2.jpg')}}" alt="" width="580" height="190"></figure>
					</a>
				</div>
			</div>

			<!--On Sale-->
			<div class="wrap-show-advance-info-box style-1 has-countdown">
				<h3 class="title-box">Offer</h3>
				<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="4" data-loop="false" data-nav="true" data-dots="false" data-responsive=''>

				@forelse ($offers as $offer)
                <div class="product product-style-2 equal-elem ">
				    <div class="wrap-countdown timer" data-expire="{{$offer->offer_end}}"></div>
                    <div class="product-thumnail">
                        <div class="group-flash">
                            <span class="flash-item sale-label">{{$offer->offer_ratio}}% OFFER</span>
                        </div>

                        <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                            <figure><img src="{{asset('images/Product/'.$offer->product->photos[0])}}" width="800" height="800" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                        </a>

                        <div class="wrap-btn">
                            <a href="#" class="function-link">quick view</a>
                        </div>
                    </div>
                    <div class="product-info">
                        <a href="#" class="product-name"><span>{{$offer->product->desc}}</span></a>
                        @php
                            $price       = (int)$offer->product->price;  //Price befor offer
                            $offer_ratio = (int)$offer->offer_ratio;  //offer ratio
                            $discount    = round($price/$offer_ratio , 2) ;  //Discount offer
                            $new_price   = $price - $discount ;  //new price after discount
                        @endphp
                        <div class="wrap-price">
                            <ins>
                                <p class="product-price">${{$new_price}}</p>
                            </ins>
                            <del>
                                <p class="product-price">${{$offer->product->price}}</p>
                            </del>
                        </div>
                    </div>
                </div>
                @empty

                @endforelse

				</div>
			</div>

			<!--Latest Products-->
			<div class="wrap-show-advance-info-box style-1">
				<h3 class="title-box">Latest Products</h3>
				<div class="wrap-top-banner">
					<a href="#" class="link-banner banner-effect-2">
						<figure><img src="{{asset('FrontAssets/assets/images/digital-electronic-banner.jpg')}}" width="1170" height="240" alt=""></figure>
					</a>
				</div>
				<div class="wrap-products">
					<div class="wrap-product-tab tab-style-1">
						<div class="tab-contents">
							<div class="tab-content-item active" id="digital_1a">
								<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='' >
                                    @forelse ($products as $product)
                                    <div class="product product-style-2 equal-elem ">
										<div class="product-thumnail">
											<a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
												<figure><img src="{{asset('images/Product/'.$product->photos[0])}}" width="800" height="800" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
											</a>
											<div class="group-flash">
												<span class="flash-item new-label">new</span>
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
											<div class="wrap-btn">
												<a href="#" class="function-link">quick view</a>
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
										</div>
									</div>
                                    @empty

                                    @endforelse
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!--Product Categories-->
			<div class="wrap-show-advance-info-box style-1">
				<h3 class="title-box">Product Categories</h3>
				<div class="wrap-top-banner">
					<a href="#" class="link-banner banner-effect-2">
						<figure><img src="{{asset('frontAssets/assets/images/fashion-accesories-banner.jpg')}}" width="1170" height="240" alt=""></figure>
					</a>
				</div>
				<div class="wrap-products">
					<div class="wrap-product-tab tab-style-1">
						<div class="tab-control">
                            @forelse ($sections as $index=>$section)
                                <a href="#{{$section->id}}" class="tab-control-item @if ($index++ == 0)
                                    active
                                @endif">{{$section->name}}</a>
                            @empty

                            @endforelse
						</div>
						<div class="tab-contents">
                            @forelse ($sections as $index=>$section)
                                <div class="tab-content-item @if ($index++ == 0)
                                active
                            @endif" id="{{$section->id}}">
                                    <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >
                                        @forelse ($section->products as $product)
                                            <div class="product product-style-2 equal-elem ">
                                                <div class="product-thumnail">
                                                    <a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                                        <figure><img src="{{asset('images/Product/'.$product->photos[0])}}" width="800" height="800" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
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
                                                    <div class="wrap-btn">
                                                        <a href="#" class="function-link">quick view</a>
                                                    </div>
                                                </div>
                                                <div class="product-info">
                                                    <a href="#" class="product-name"><span>{{$product->desc_en}}</span></a>
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
                                                </div>
                                            </div>
                                        @empty

                                        @endforelse
                                    </div>
                                </div>
                            @empty

                            @endforelse


						</div>
					</div>
				</div>
			</div>
@endsection

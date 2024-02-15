@extends('layouts.headerFooter')

@section('content')
		<!-- End Header/Navigation -->

		<!-- Start Hero Section -->
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Modern Interior <span clsas="d-block">Design Studio</span></h1>
								<p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.</p>
								<p><a href="" class="btn btn-secondary me-2">Shop Now</a><a href="#" class="btn btn-white-outline">Explore</a></p>
							</div>
						</div>
						<div class="col-lg-7">
							<div class="hero-img-wrap">
								<img src="{{ asset('assets/images/couch.png')}}" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		<!-- Start Product Section -->
		<div class="product-section">
			<div class="container">
				<div class="row">

					<!-- Start Column 1 -->
					<div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
						<h2 class="mb-4 section-title">Crafted with excellent material.</h2>
						<p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. </p>
						<p><a href="{{route('shop')}}" class="btn">Explore</a></p>
					</div> 
					<!-- End Column 1 -->

					<!-- Start Column 2 -->
					@foreach($product as $data)
    				<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
			        <form method="post" action="{{ route('add-to-cart', ['id' => $data->id]) }}">
			            @csrf
			            <input type="hidden" name="product_id" value="{{ $data->id }}">
			            
			            <div class="product-item">
			                <img src="{{ asset('assets/images/product-1.png')}}" class="img-fluid product-thumbnail">
			                <h3 class="product-title">{{ $data->product_name }}</h3>
			                <strong class="product-price">{{ $data->price }}</strong>

			                <button type="submit" class="icon-cross btn btn-link">
			                    <img src="{{ asset('assets/images/cross.svg')}}" class="img-fluid" alt="Add to Cart">
			                </button>
			            </div>
			        </form>
			    </div> 
				@endforeach

					<!-- End Column 2 -->

				
				</div>
			</div>
		</div>
@endsection
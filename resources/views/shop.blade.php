@extends('layouts.headerFooter')

@section('content')

<div class="untree_co-section product-section before-footer-section">
		    <div class="container">
		      	<div class="row">

		      		<!-- Start Column 1 -->
		      		@foreach($productData as $data)
    				<div class="col-12 col-md-4 col-lg-3 mb-5">
        				<form method="post" action="{{ route('add-to-cart', ['id' => $data->id]) }}">
            				@csrf
            				<input type="hidden" name="product_id" value="{{ $data->id }}">

			            <a class="product-item" href="#">
			                <img src="{{ asset('assets/images/product-3.png')}}" class="img-fluid product-thumbnail">
			                <h3 class="product-title">{{ $data->product_name }}</h3>
			                <strong class="product-price">{{ $data->price }}</strong>

			                <button type="submit" class="icon-cross btn btn-link">
			                    <img src="{{ asset('assets/images/cross.svg')}}" class="img-fluid" alt="Add to Cart">
			                </button>
			            </a>
			        </form>
			    	</div> 
				@endforeach

					<!-- End Column 1 -->
		      	</div>
		    </div>
		</div>

		@endsection
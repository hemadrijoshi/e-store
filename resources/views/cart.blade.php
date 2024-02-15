@extends('layouts.headerFooter')

@section('content')
<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Cart</h1>
							</div>
						</div>
						<div class="col-lg-7">
							
						</div>
					</div>
				</div>
			</div>

			<div class="untree_co-section before-footer-section">
            <div class="container">
              <div class="row mb-5">
                <form class="col-md-12" method="post">
                  <div class="site-blocks-table">
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="product-name">Product</th>
                          <th class="product-price">Price</th>
                          <th class="product-quantity">Quantity</th>
                          <th class="product-total">Total</th>
                          <th class="product-remove">Remove</th>
                        </tr>
                      </thead>
                      <tbody>
                                @php $total = 0 @endphp
                                @foreach(session('basket') as $id => $data)
                                @php $total += $data['price'] * $data['no_of_pc'];
                                @endphp
                                <tr class="cart_item cart_item_raw" id="cart_item_raw_{{ $loop->iteration }}">
                                    <input type="hidden" name="product_id" class="product_id" value="{{ $id }}">
                                    {{-- <td class="cart-product-remove">
                                        <a href="#" class="remove cart-remove" data-id="{{ $id }}" title="Remove this item"><i class="icon-trash2"></i></a>
                                    </td> --}}

                                    <td class="cart-product-name">
                                        <a href="#">{{$data['product_name']}}</a>
                                    </td>

                                   
                                    <td class="cart-product-price">
                                        <span>₹</span><span class="amount per_unit_price">{{$data['price']}}</span>
                                    </td>

                                    <td class="cart-product-quantity">
                          
                                        <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                                          <div class="input-group-prepend">
                                            <button class="btn btn-outline-black decrease" type="button">&minus;</button>
                                          </div>
                                          <input type="text" class="form-control text-center quantity-amount" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                          <div class="input-group-append">
                                            <button class="btn btn-outline-black increase" type="button">&plus;</button>
                                          </div>
                                        </div>
                                    </td>

                                    <td class="cart-product-subtotal">
                                       <span>₹</span> <span class="amount total_amount">{{intval($data['no_of_pc']) * intval($data['price'])}}</span>
                                    </td>
                                
                         ] <td><a href="#" class="btn btn-black btn-sm">X</a></td>
                        </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                  </div>
                </form>
              </div>
        
              <div class="row">
                <div class="col-md-6">
                  <div class="row mb-5">
                    <div class="col-md-6 mb-3 mb-md-0">
                      <button class="btn btn-black btn-sm btn-block">Update Cart</button>
                    </div>
                    {{-- <div class="col-md-6">
                      <button class="btn btn-outline-black btn-sm btn-block">Continue Shopping</button>
                    </div> --}}
                  </div>
                  {{-- <div class="row">
                    <div class="col-md-12">
                      <label class="text-black h4" for="coupon">Coupon</label>
                      <p>Enter your coupon code if you have one.</p>
                    </div>
                    <div class="col-md-8 mb-3 mb-md-0">
                      <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
                    </div>
                    <div class="col-md-4">
                      <button class="btn btn-black">Apply Coupon</button>
                    </div>
                  </div> --}}
                </div>
                <div class="col-md-6 pl-5">
                  <div class="row justify-content-end">
                    <div class="col-md-7">
                      <div class="row">
                        <div class="col-md-12 text-right border-bottom mb-5">
                          <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-md-6">
                          <span class="text-black">Subtotal</span>
                        </div>
                        <div class="col-md-6 text-right">
                          <strong class="text-black">$230.00</strong>
                        </div>
                      </div>
                      <div class="row mb-5">
                        <div class="col-md-6">
                          <span class="text-black">Total</span>
                        </div>
                        <div class="col-md-6 text-right">
                          <strong class="text-black">$230.00</strong>
                        </div>
                      </div>
        
                      {{-- <div class="row">
                        <div class="col-md-12">
                          <button class="btn btn-black btn-lg py-3 btn-block" onclick="window.location='checkout.html'">Proceed To Checkout</button>
                        </div>
                      </div> --}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
		@endsection
    @section('script')
    <!-- Include jQuery library -->

<script>
  $(document).ready(function() {
    // Remove item from cart
    $('.cart-remove').on('click', function(e) {
      e.preventDefault();
      var productId = $(this).data('id');

      // Make an Ajax request to remove the item from the server
      $.ajax({
        url: '/remove-from-cart', // Update with your server endpoint
        method: 'POST',
        data: { product_id: productId },
        success: function(response) {
          // Update the cart UI or handle the response accordingly
          $('#cart_item_raw_' + productId).remove();
          updateTotal(); // You might need to implement this function
        },
        error: function(error) {
          console.log(error);
        }
      });
    });

    // Update quantity
    $('.increase, .decrease').on('click', function() {

      var quantityInput = $(this).closest('.quantity-container').find('.quantity-amount');
      
      var currentQuantity = parseInt(quantityInput.val());
      alert(currentQuantity);
      if ($(this).hasClass('increase')) {
        quantityInput.val(currentQuantity + 1);
      } else {
        quantityInput.val(Math.max(1, currentQuantity - 1));
      }

      updateTotal(); // You might need to implement this function
    });

    // Function to update the total amount
    function updateTotal() {
      // Implement the logic to calculate and display the updated total
      // This might involve iterating through all items in the cart and summing up their totals
    }
  });
</script>

    @endsection
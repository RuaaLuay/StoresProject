@extends('WebSiteViews.Layouts.WebSiteMainLayout')

@section('tittle')
    <title>My cart</title>
@stop

    @section('body')
{{--    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog modal-lg" role="document">--}}
{{--            <div class="w-100 pt-1 mb-5 text-right">--}}
{{--                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--            </div>--}}
{{--            <form action="{{URL('website/products/search/'.$store->id)}}" method="get" class="modal-content modal-body border-0 p-0">--}}
{{--                <div class="input-group mb-2">--}}
{{--                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ...">--}}
{{--                    <button type="submit" class="input-group-text bg-success text-light">--}}
{{--                        <i class="fa fa-fw fa-search text-white"></i>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}


    <!-- Start Content -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3">
{{--                <h1 class="h2 pb-4">{{$store->name}}</h1><br>--}}
{{--                <div >--}}
{{--                    <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">--}}
{{--                        <div class="input-group">--}}
{{--                            <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">--}}
{{--                            <div class="input-group-text">--}}
{{--                                <i class="fa fa-fw fa-search"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal" data-bs-target="#templatemo_search">--}}
{{--                        <span class="text-success logo h4 align-self-center" >Search for product</span><i class="fa fa-fw fa-search text-dark mr-2"></i>--}}
{{--                    </a>--}}
{{--                </div>--}}
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-6">
{{--                        <ul class="list-inline shop-top-menu pb-3 pt-1">--}}
{{--                            <li class="list-inline-item">--}}
{{--                                <a class="h3 text-dark text-decoration-none mr-3" href="#">All</a>--}}
{{--                            </li>--}}
{{--                            <li class="list-inline-item">--}}
{{--                                <a class="h3 text-dark text-decoration-none mr-3" href="#">Men's</a>--}}
{{--                            </li>--}}
{{--                            <li class="list-inline-item">--}}
{{--                                <a class="h3 text-dark text-decoration-none" href="#">Women's</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
                    </div>
                    <div class="col-md-6 pb-4">
{{--                        <div class="d-flex">--}}
{{--                            <select class="form-control">--}}
{{--                                <option>Featured</option>--}}
{{--                                <option>A to Z</option>--}}
{{--                                <option>Item</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="row ">
                    @if(Auth::guard('customer')->check())
                        <form method="post" class="tm-logout-icon" action="{{route('customer-logout')}}">
                            @csrf
                            <button class="btn btn-success text-white mt-2">
                                LOGOUT</button>
                        </form>
                        @foreach($cartItems as $cartItem)
                        <div class="col-md-4 cartItem-data">
                            <p class="h3 text-success align-content-center">Name: {{$cartItem->product->name}}</p>
                            <div class="card mb-4 product-wap rounded-0">
                                <div class="card rounded-0">
                                    <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                        <li class="pt-2">
                                            <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                                            <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                                            <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                                            <span class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                                            <span class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                                        </li>
                                    </ul>
                                    <ul class="list-unstyled d-flex justify-content-center mb-1">
                                        <li>
                                            <i class="text-warning fa fa-star"></i>
                                            <i class="text-warning fa fa-star"></i>
                                            <i class="text-warning fa fa-star"></i>
                                            <i class="text-muted fa fa-star"></i>
                                            <i class="text-muted fa fa-star"></i>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card rounded-0">
                                    <p>Description: {{$cartItem->product->description}}</p>
                                    <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                        <ul class="list-unstyled">
                                            <li >
                                                <form method="delete" class="remove" data-action="{{ url("cart/delete/".$cartItem->id)}}">
                                                    @csrf
                                                    <input type="hidden"  class="cartItem_id" name ="cartItem_id" value="{{$cartItem->id}}">
{{--                                                    <input type="hidden"  name ="product_price" value="{{  $product->flag ?  $product->discount_price : $product->base_price}}">--}}
                                                    <button class="btn btn-success RemoveFromCart text-white mt-2">
                                                        <i class="bi bi-trash2"></i></button>
                                                </form>
                                            </li>
{{--                                            <li >--}}
{{--                                                <form method="post" data-action="{{ url("cart/delete") }}">--}}
{{--                                                    @csrf--}}
{{--                                                    <input type="hidden"  class="cartItem_id" name ="cartItem_id" value="{{$cartItem->id}}">--}}
{{--                                                    --}}{{--                                                    <input type="hidden"  name ="product_price" value="{{  $product->flag ?  $product->discount_price : $product->base_price}}">--}}
{{--                                                    <button class="btn btn-success RemoveFromCart text-white mt-2">--}}
{{--                                                        <i class="fas fa-cart-plus"></i></button>--}}
{{--                                                </form>--}}
{{--                                            </li>--}}
                                            <li>
                                                    <div class="input-group">
                                                         <span class="input-group-btn">
                                                              <button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="">
                                                                  <span class="glyphicon glyphicon-minus"></span>
                                                              </button>
                                                         </span>
                                                        <input type="text" id="quantity" name="quantity" class="form-control quantity input-number" value="{{$cartItem->product_quantity}}" min="1" max="100">
                                                        <span class="input-group-btn">
                                                             <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
                                                                 <span class="glyphicon glyphicon-plus"></span>
                                                             </button>
                                                        </span>
                                                        <span>
                                                            <form method="post" class="update_cart" data-action="{{ url("cart/update") }}">
                                                                @csrf
                                                                  <input type="hidden"  class="cartItem_id" name ="cartItem_id" value="{{$cartItem->id}}">
{{--                                                                  <input type="hidden"  name ="product_price" value="{{  $product->flag ?  $product->discount_price : $product->base_price}}">--}}
                                                                        <button class="btn btn-success update_cart text-white mt-2">
                                                                  <i class="fas fa-cart-plus"></i></button>
                                                            </form>
                                                        </span>
                                                    </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @elseif(@session('cart'))
                        @foreach(@session('cart') as $id =>$details)
                            <div class="col-md-4 cartItem-data">
                                <p class="h3 text-success align-content-center">Name: {{$details['name']}}</p>
                                <div class="card mb-4 product-wap rounded-0">
                                    <div class="card rounded-0">
                                        <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                            <li class="pt-2">
                                                <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                                                <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                                                <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                                                <span class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                                                <span class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                                            </li>
                                        </ul>
                                        <ul class="list-unstyled d-flex justify-content-center mb-1">
                                            <li>
                                                <i class="text-warning fa fa-star"></i>
                                                <i class="text-warning fa fa-star"></i>
                                                <i class="text-warning fa fa-star"></i>
                                                <i class="text-muted fa fa-star"></i>
                                                <i class="text-muted fa fa-star"></i>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card rounded-0">
                                        <p>Description: {{$details['description']}}</p>
                                        <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                            <ul class="list-unstyled">
                                                <li >
                                                    <form method="delete" class="remove" data-action="{{ url("cart/delete/".$id)}}">
                                                        @csrf
                                                        <input type="hidden"  class="cartItem_id" name ="cartItem_id" value="{{$id}}">
                                                        {{--                                                    <input type="hidden"  name ="product_price" value="{{  $product->flag ?  $product->discount_price : $product->base_price}}">--}}
                                                        <button class="btn btn-success RemoveFromCart text-white mt-2">
                                                            <i class="bi bi-trash2"></i></button>
                                                    </form>
                                                </li>
                                                {{--                                            <li >--}}
                                                {{--                                                <form method="post" data-action="{{ url("cart/delete") }}">--}}
                                                {{--                                                    @csrf--}}
                                                {{--                                                    <input type="hidden"  class="cartItem_id" name ="cartItem_id" value="{{$cartItem->id}}">--}}
                                                {{--                                                    --}}{{--                                                    <input type="hidden"  name ="product_price" value="{{  $product->flag ?  $product->discount_price : $product->base_price}}">--}}
                                                {{--                                                    <button class="btn btn-success RemoveFromCart text-white mt-2">--}}
                                                {{--                                                        <i class="fas fa-cart-plus"></i></button>--}}
                                                {{--                                                </form>--}}
                                                {{--                                            </li>--}}
                                                <li>
                                                    <div class="input-group">
                                                         <span class="input-group-btn">
                                                              <button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="">
                                                                  <span class="glyphicon glyphicon-minus"></span>
                                                              </button>
                                                         </span>
                                                        <input type="text" id="quantity" name="quantity" class="form-control quantity input-number" value="{{$details['product_quantity']}}" min="1" max="100">
                                                        <span class="input-group-btn">
                                                             <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
                                                                 <span class="glyphicon glyphicon-plus"></span>
                                                             </button>
                                                        </span>
                                                        <span>
                                                            <form method="post" class="update_cart" data-action="{{ url("cart/update") }}">
                                                                @csrf
                                                                  <input type="hidden"  class="cartItem_id" name ="cartItem_id" value="{{$id}}">
{{--                                                                  <input type="hidden"  name ="product_price" value="{{  $product->flag ?  $product->discount_price : $product->base_price}}">--}}
                                                                        <button class="btn btn-success update_cart text-white mt-2">
                                                                  <i class="fas fa-cart-plus"></i></button>
                                                            </form>
                                                        </span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    @endif
                </div>
                @if(Auth::guard('customer')->check())
                <div div="row">
                    <ul class="pagination pagination-lg justify-content-end">
                        {{ $cartItems->links() }}
                    </ul>
                </div>
                @endif
            </div>

        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.RemoveFromCart').click(function (e) {
                e.preventDefault();
                var cartItem_id = $(this).closest('.cartItem-data').find('.cartItem_id').val();
                var url = $(this).find('.remove').attr('data-action');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "delete",
                    url : "/cart/delete/" + cartItem_id,
                    data: {
                    },
                    success: function (response) {
                        window.location.reload();
                        // alert(response.success);
                    },
                    error: function (response) {
                        console.log(response.responseText);
                    }

                })
            })

            $('.quantity-right-plus').click(function(e){
                e.preventDefault();
                var quantity =parseInt($(this).closest('.cartItem-data').find('.quantity').val());
                $(this).closest('.cartItem-data').find('.quantity').val(quantity + 1);

                // Stop acting like a button
                // Get the field name
                // var quantity = $(this).closest('.cartItem-data').find('.quantity').val();
                // If is not undefined
                // quantity = quantity+1;
                // Increment

            });
            $('.quantity-left-minus').click(function(e){
                e.preventDefault();
                var quantity =parseInt($(this).closest('.cartItem-data').find('.quantity').val());
                // Stop acting like a button

                // Get the field name
                //var quantity = parseInt($('#quantity').val());

                // If is not undefined

                // Increment
                if(quantity>1){
                    $(this).closest('.cartItem-data').find('.quantity').val(quantity - 1);
                }
            });
            $('.update_cart').click(function(e){
                e.preventDefault();
                var quantity =parseInt($(this).closest('.cartItem-data').find('.quantity').val());
                var cartItem_id = $(this).closest('.cartItem-data').find('.cartItem_id').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "post",
                    url : "/cart/update/" + cartItem_id,
                    data: {
                        "product_quantity" : quantity
                    },
                    success: function (response) {
                        alert("cart updated");
                    },
                    error: function (response) {
                        //console.log(response.responseText);
                    }

                })
            });


        })

    </script>

    @include('WebSiteViews.includes.brands')
    @stop


@extends('WebSiteViews.Layouts.WebSiteMainLayout')

@section('tittle')
    <title>Zay Shop - Product Listing Page</title>
@stop

    @section('body')
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{URL('website/products/search/'.$store->id)}}" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ...">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>


    <!-- Start Content -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3">
                <h1 class="h2 pb-4">{{$store->name}}</h1><br>
                <div >
                    <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                            <div class="input-group-text">
                                <i class="fa fa-fw fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal" data-bs-target="#templatemo_search">
                        <span class="text-success logo h4 align-self-center" >Search for product</span><i class="fa fa-fw fa-search text-dark mr-2"></i>
                    </a>
                </div>
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
                    @foreach($products as $product)
                        <div class="col-md-4 product-data">
                            <p class="h3 text-success align-content-center">Name: {{$product->name}}</p>
                            <p class="h3 text-success align-content-center">Name: {{$product->name}}</p>
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
                                    @if($product->flag == 0)
                                        <p class="text-center mb-0">base price: {{$product->base_price}}$</p>
                                    @else
                                        <p class="text-center mb-0">discount price: {{$product->discount_price}}$</p>
                                    @endif
                                </div>
                                <div class="card rounded-0">
                                    <p>Description: {{$product->description}}</p>
                                    <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                        <ul class="list-unstyled">
                                            <li >
                                                <form method="post" data-action="{{ url("cart/store") }}">
                                                    @csrf
                                                    <input type="hidden"  class="product_id" name ="product_id" value="{{$product->id}}">
                                                    <input type="hidden"  name ="product_price" value="{{  $product->flag ?  $product->discount_price : $product->base_price}}">
                                                    <button class="btn btn-success addToCart text-white mt-2">
                                                        <i class="fas fa-cart-plus"></i></button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div div="row">
                    <ul class="pagination pagination-lg justify-content-end">
                        {{ $products->links() }}
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.addToCart').click(function (e) {
                e.preventDefault();
                var product_id = $(this).closest('.product-data').find('.product_id').val();
                var url = $(this).attr('data-action');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "post",
                    url : "{{URL("cart/store/")}}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "product_id" : product_id
                    },
                    success: function (response) {
                        alert("added to cart");
                    },
                    error: function (response) {
                        console.log(response.responseText);
                    }

                })
            })
        })

    </script>

    @include('WebSiteViews.includes.brands')
    @stop


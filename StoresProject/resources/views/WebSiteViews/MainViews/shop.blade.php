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
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
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
                <h1 class="h2 pb-4">Stores</h1>

            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6 pb-4">
                        <div class="d-flex">

                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($stores as $store)
                        <div class="col-md-4">
                            <div class="card mb-4 product-wap rounded-0">
                                <div class="card rounded-0">
                                    @if(file_exists('storage/'.$store->Logo_path))
                                        <img class="card-img rounded-0 img-fluid" height="200" width="400" src="{{url('storage/'.$store->Logo_path)}}">
                                    @else
                                        <img class="card-img rounded-0 img-fluid" src="{{url('storage/uploads/Logos/no_logo.png')}}">
                                    @endif

{{--                                    <img class="card-img rounded-0 img-fluid" src = "{{asset('assets/img')}}/{{$store->Logo_path}}">--}}
                                    <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                        <ul class="list-unstyled">
                                            <li><a class="btn btn-success text-white mt-2" href="{{URL('website/stores/products/'.$store->id)}}"><i class="far fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <a href="shop-single.html" class="h3 text-decoration-none">Name: {{$store->name}}</a>
                                    <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                        <li>Address: {{$store->address}}</li>
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
                            </div>
                        </div>
                    @endforeach
                </div>

                <div div="row">
                    <ul class="pagination pagination-lg justify-content-end">
                        {{ $stores->links() }}
                    </ul>
                </div>
            </div>

        </div>
    </div>

    @include('WebSiteViews.includes.brands')
    @stop


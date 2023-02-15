@extends('DashboardViews.ManagerDashboardViews.Layout')
@section('tittle')
    <title>Product Page - Admin HTML Template</title>
@stop
@section('body')
    <div class="container mt-5">
        <h1 class="tm-site-title mb-0">PRODUCTS PAGE</h1><br>
        <div class="row tm-content-row">
            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 tm-block-col">
                <div class="tm-bg-primary-dark tm-block tm-block-product-categories">
                    <form action="{{url('mystore/product/deleteSelected')}}" method="post" class="tm-edit-product-form" id="items-form">
                        @csrf
                        <div class="tm-product-table-container">
                            <table class="table table-hover tm-table-small tm-product-table">
                                <thead>
                                <tr>
                                    <th scope="col">&nbsp;</th>
                                    <th scope="col">PRODUCT NAME</th>
                                    <th scope="col">STORE NAME</th>
                                    <th scope="col">BASE PRICE</th>
                                    <th scope="col">DISCOUNT PRICE</th>
                                    <th scope="col">DELETE</th>
                                    <th scope="col">EDIT</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <th scope="row">
                                            <input type="checkbox" id="selectedItems" name='DeleteProducts[]'
                                                   value="{{$product->id}}"/></th>
                                        <td class="tm-product-name">{{$product->name}}</td>
                                        <td>{{ $product->store->name ?? 'none' }}</td>
                                        <td>
                                            @if($product->flag == 0)
                                                {{$product->base_price}} <i class="fas fa-sharp fa-solid fa-check"></i>
                                            @else
                                                {{$product->base_price}}
                                            @endif</td>
                                        <td>
                                            @if($product->flag == 1)
                                                {{$product->discount_price}} <i class="fas fa-sharp fa-solid fa-check">
                                            @else
                                                {{$product->discount_price}}
                                            @endif
                                        </td>
                                        <td>
                                                <form action="{{ URL('mystore/product/delete/'.$product->id) }}" method="POST">
                                                    @csrf

                                                    <button type="submit" formaction="{{ URL('mystore/product/delete/'.$product->id) }}"
                                                            class="tm-product-delete-link btn-outline-light">
                                                        <i class="far fa-trash-alt tm-product-delete-icon"></i>
                                                    </button>
                                                </form>
                                        </td>
                                        <td>
                                            <a href="{{ URL('mystore/product/edit/'.$product->id)}}"
                                               class="tm-product-delete-link">
                                                <i class="far fa-duotone fa-pen-to-square "></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a href="{{url('mystore/product/create/'.$store->id)}}" class="btn btn-primary btn-block text-uppercase mb-3">Add new product</a>
                        <button type="submit" formaction="{{url('mystore/product/deleteSelected')}}"
                                class="btn btn-primary btn-block text-uppercase mb-3"
                        >Delete selected products
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 tm-block-col">
                <div class="tm-bg-primary-dark tm-block tm-block-product-categories">
                    <form action="{{url('mystore/product/restoreSelected')}}" method="post" class="tm-edit-product-form" id="items-form">
                        @csrf
                    <h2 class= "tm-block-title">DELETED PRODUCTS</h2>
                    <div class="tm-product-table-container">
                        <table class="table tm-table-small tm-product-table">
                            <thead>
                            <tr>
                                <th scope="col">&nbsp;</th>
                                <th scope="row">NAME</th>
                                <th scope="row">RESTORE</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($trashedProducts as $trashedProduct)
                                <tr>
                                    <th scope="row">
                                        <input type="checkbox" id="selectedItems" name='RestoreProducts[]'
                                               value="{{$trashedProduct->id}}"/></th>
                                    <td class="tm-product-name">{{$trashedProduct->name}}</td>
                                    <td>
                                        <form action="{{ URL('mystore/product/restore/'.$trashedProduct->id) }}"
                                              method="POST">
                                            @csrf
                                            <button type="submit" formaction="{{ URL('mystore/product/restore/'.$trashedProduct->id) }}" class="tm-product-delete-link btn-outline-light">
                                                <i class="far fa-trash-alt tm-product-delete-icon"></i>
                                            </button> </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" formaction="{{url('mystore/product/restoreSelected')}}"
                            class="btn btn-primary btn-block text-uppercase mb-3">Restore selected products
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>



@stop

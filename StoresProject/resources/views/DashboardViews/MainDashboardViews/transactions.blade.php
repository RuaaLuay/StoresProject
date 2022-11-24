@extends('DashboardViews.Layouts.DashboareMainLayout')
@section('tittle')
<title>Transactions</title>
@stop
@section('body')
<div class="container mt-5">
    <h1 class="tm-site-title mb-0">TRANSACTIONS PAGE</h1><br>
    <div class="row tm-content-row">
        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 tm-block-col">
            <div class="tm-bg-primary-dark tm-block tm-block-products">
                <div class="tm-product-table-container">
                    <table class="table table-hover tm-table-small tm-product-table">
                        <thead>
                        <tr>
                            <th scope="col">PRODUCT NAME</th>
                            <th scope="col">STORE NAME</th>
                            <th scope="col">PURCHASE PRICE</th>
                            <th scope="col">TIMESTAMP</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                            <tr>
                                <td class="tm-product-name">{{$transaction->product->name}}</td>
                                <td>{{$transaction->product->store->name ?? 'none' }}</td>
                                <td>{{$transaction->purchase_price}}</td>
                                <td>{{$transaction->created_at}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 tm-block-col">
            <div class="tm-bg-primary-dark tm-block tm-block-product-categories">
                <h2 class="tm-block-title">Total of purchases for each product</h2>
                <div class="tm-product-table-container">
                    <table class="table tm-table-small tm-product-table">
                       <thead>
                        <tr>
                            <th scope="row">PRODUCT NAME
                            </th>
                            <th scope="row">TOTAL PURCHASE PRICE
                            </th>
                        </tr>
                       </thead>
                            <tbody>
                            @foreach ($totalTransactions as $totalTransaction)
                        <tr>
                            <td class="tm-product-name">{{$totalTransaction->product->name}}</td>
                            <td>
                                {{$totalTransaction->sum}}
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- table container -->

            </div>
        </div>
    </div>
</div>
@stop

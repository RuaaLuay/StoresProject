@extends('DashboardViews.Layouts.DashboareMainLayout')
@section('tittle')
    <title>Add Product - Dashboard</title>
@stop
@section('body')
    <div class="container tm-mt-big tm-mb-big">
        <div class="row">
            <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
                <div class="messagePrinter tm-bg-primary-dark"></div>
                <br>
                <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="tm-block-title d-inline-block">Add store</h2>
                            @foreach($errors->all() as $message)
                                <div class="alert alert-danger">{{$message}}</div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row tm-edit-product-row">
                        <form action="{{URL('dashboard/store/store')}}" method="post" class="tm-edit-product-form row tm-edit-product-row" enctype="multipart/form-data">
                            @csrf
                        <div class="col-xl-6 col-lg-6 col-md-12">
                                <div class="form-group mb-3">
                                    <label for="name">store Name</label>
                                    <input id="name" name="name" type="text" class="form-control validate" required/>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="address">Address</label>
                                    <input id="address" name="address" type="text" class="form-control validate" required/>
                                </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">
                            <div class="tm-product-img-dummy mx-auto">
                                <i class="fas fa-cloud-upload-alt tm-upload-icon"
                                   onclick="document.getElementById('image').click();"></i>
                            </div>
                            <div class="custom-file mt-3 mb-3">
                                <input id="image" name="image"  type="file" style="display:none;"/>
                                <input type="button" class="btn btn-primary btn-block mx-auto"
                                       value="UPLOAD STORE LOGO"
                                       onclick="document.getElementById('image').click();"/>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block text-uppercase">Add Store Now
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


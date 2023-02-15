@extends('DashboardViews.ManagerDashboardViews.Layout')
    @section('tittle')
     <title>Edit Product - Dashboard</title>
    @stop
    @section('body')
    <div class="container tm-mt-big tm-mb-big">
      <div class="row">
        <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
          <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
            <div class="row">
              <div class="col-12">
                <h2 class="tm-block-title d-inline-block">Edit Product</h2>
                  @foreach($errors->all() as $message)
                      <div class="alert alert-danger">{{$message}}</div>
                  @endforeach
              </div>
            </div>
            <div class="row tm-edit-product-row">
              <div class="col-xl-6 col-lg-6 col-md-12">
                <form action="{{URL('mystore/product/update/'.$product->id)}}" method="post" class="tm-edit-product-form">
                  @csrf
                  <div class="form-group mb-3">
                    <label for="name">Product Name</label>
                    <input id="name" name="name" type="text" value="{{$product->name}}" class="form-control validate" required/>
                  </div>
                  <div class="form-group mb-3">
                    <label for="description">Description</label>
                    <textarea class="form-control validate tm-small" name= "desc" rows="5" required>{{$product->description}}</textarea>
                  </div>
                  <div class="form-group mb-3">
                    <label for="store">Store</label>
                      <input  value="{{$store->id}}" name="store" type="hidden" />
                      <input id="store" value="{{$store->name}}" disabled = "disabled"  type="text" class="form-control validate"/>
                  </div>
                  <div class="row">
                      <div class="form-group mb-3 col-xs-12 col-sm-6">
                          <label for="base_price">base price
                          </label>
                          <input id="base_price" name="base_price" type="integer" min="0" value="{{$product->base_price}}" class="form-control validate" data-large-mode="true"/>
                        </div>
                        <div class="form-group mb-3 col-xs-12 col-sm-6">
                          <label for="discount price">discount price
                          </label>
                          <input id="discount price" name="discount price" type="integer" min="0" value="{{$product->discount_price}}" class="form-control validate"/>
                        </div>
                      <div class="form-group mb-3 col-xs-12 col-sm-6">
                          <select class="custom-select tm-select-accounts" id="flag" name="flag">
                              <option value="0" {{ $product->flag == 0 ? 'selected' : ''}}> base price </option>
                              <option value="1" {{ $product->flag == 1 ? 'selected' : ''}}> discount price </option>
                          </select>
                      </div>
                  </div>
                    <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block text-uppercase">Update Now</button>
                    </div>
                </form>
              </div>
{{--              <div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">--}}
{{--                <div class="tm-product-img-edit mx-auto">--}}
{{--                  <img src="{{asset('assets/img')}}/{{$Product->image}}" alt="Product image" class="img-fluid d-block mx-auto">--}}
{{--                  <i class="fas fa-cloud-upload-alt tm-upload-icon" onclick="document.getElementById('fileInput').click();"></i>--}}
{{--                </div>--}}
{{--                <div class="custom-file mt-3 mb-3">--}}
{{--                  <input id="fileInput" name="fileInput" type="file" style="display:none;" />--}}
{{--                  <input--}}
{{--                    name="fileInput"--}}
{{--                    type="button"--}}
{{--                    class="btn btn-primary btn-block mx-auto"--}}
{{--                    value="CHANGE IMAGE NOW"--}}
{{--                    onclick="document.getElementById('fileInput').click();"/>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--              <div class="col-12">--}}

            </div>
          </div>
        </div>
      </div>
    </div>
    @stop




@extends('DashboardViews.Layouts.DashboareMainLayout')
@section('tittle')
    <title>Store Page - Admin HTML Template</title>
@stop
@section('body')
    <div class="container mt-5">
        <h1 class="tm-site-title mb-0">STORES PAGE</h1><br>
        <div class="row tm-content-row">
            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 tm-block-col">
                <div class="tm-bg-primary-dark tm-block tm-block-product-categories">
                    <form action="{{url('dashboard/store/deleteSelected')}}" method="post" class="tm-edit-product-form" id="items-form">
                        @csrf
                    <div class="tm-product-table-container">
                        <table class="table table-hover tm-table-small tm-product-table">
                            <thead>
                            <tr>
                                <th scope="col">&nbsp;</th>
                                <th scope="row">NAME</th>
                                <th scope="row">ADDRESS</th>
                                <th scope="row">LOGO</th>
                                <th scope="row">DELETE</th>
                                <th scope="row">EDIT</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($stores as $store)
                                <tr>
                                    <th scope="row">
                                        <input type="checkbox" id="selectedItems" name='DeleteStores[]'
                                               value="{{$store->id}}"/></th>
                                    <td class="tm-product-name">{{$store->name}}</td>
                                    <td class="tm-product-name">{{$store->address}}</td>
                                    @if(file_exists('storage/'.$store->Logo_path))
                                        <td class="tm-product-name"> <img src="{{url('storage/'.$store->Logo_path)}}" style="border-radius: 50%;" alt="store logo" height="50" width="50" border-radius="20px">
                                        </td>
                                    @else
                                        <td class="tm-product-name"> <img src="{{url('storage/uploads/Logos/no_logo.png')}}" style="border-radius: 50%;" alt="store logo" height="50" width="50">
                                        </td>
                                    @endif

                                    <td>
                                        <form action="{{ URL('dashboard/store/delete/'.$store->id) }}"
                                              method="POST">
                                            @csrf
                                            <button type="submit" class="tm-product-delete-link btn-outline-light">
                                                <i class="far fa-trash-alt tm-product-delete-icon"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ URL('dashboard/store/edit/'.$store->id)}}"
                                           class="tm-product-delete-link">
                                            <i class="far fa-duotone fa-pen-to-square "></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{url('dashboard/store/create')}}"
                       class="btn btn-primary btn-block text-uppercase mb-3">Add new store
                    </a>
                    <button type="submit"
                            class="btn btn-primary btn-block text-uppercase mb-3">Delete selected stores
                    </button>
                    </form>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 tm-block-col">
                <div class="tm-bg-primary-dark tm-block tm-block-product-categories">
                    <form action="{{url('dashboard/store/restoreSelected')}}" method="post" class="tm-edit-product-form" id="items-form">
                        @csrf
                        <h2 class= "tm-block-title">DELETED STORES</h2>
                    <div class="tm-product-table-container">
                        <table class="table table-hover tm-table-small tm-product-table">
                            <thead>
                            <tr>
                                <th scope="col">&nbsp;</th>
                                <th scope="row">NAME</th>
                                <th scope="row">RESTORE</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($trashedStores as $trashedStore)
                                <tr>
                                    <th scope="row">
                                        <input type="checkbox" id="selectedItems" name='RestoreStores[]'
                                               value="{{$trashedStore->id}}"/></th>
                                    <td class="tm-product-name">{{$trashedStore->name}}</td>
                                    <td>
                                        <form action="{{ URL('dashboard/store/restore/'.$store->id) }}"
                                              method="POST">
                                            @csrf
                                            <button type="submit" class="tm-product-delete-link btn-outline-light">
                                                <i class="fa-light fa-trash-can-arrow-up"></i>                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button type="submit"
                            class="btn btn-primary btn-block text-uppercase mb-3">Restore selected stores
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

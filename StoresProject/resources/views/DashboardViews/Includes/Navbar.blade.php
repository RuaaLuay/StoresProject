
    <nav class="navbar navbar-expand-xl">
            <div class="container h-100">
                <a class="navbar-brand" href="{{URL('dashboard')}}">
                    <h1 class="tm-site-title mb-0">Stores Admin</h1>
                    <a class="navbar-brand"  href="{{URL('/')}}">PUBLIC WEBSITE</a>
                </a>
                <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars tm-nav-icon"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto h-100">
                        <li class="nav-item">
                            <a class="nav-link" href="{{URL('dashboard')}}">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href={{url('admin/dashboard/products')}}>
                                <i class="fas fa-shopping-cart"></i>
                                Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{URL('dashboard/stores')}}">
                                 <i class="fas fa-store"></i>
                                stores
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{URL('dashboard/transactions')}}">
                                <i class="fas fa-flag"></i>
                                transactions
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                        <form method="post" action="{{ route('admin-logout') }}">
                            @csrf
                            <button class="nav-item ml-auto mr-0" type="submit"
                                    aria-controls="navbarSupportedContent"
                            >
                                    {{ @Auth::guard('admin')->user()->name }},
                                <b>Logout</b></button>
                        </form>
                        </li>
                    </ul>
                </div>
            </div>

    </nav>

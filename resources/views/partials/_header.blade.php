<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('product.index') }}">Larashop</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('product.shoppingCart') }}">
                    <i class="fa fa-cart-arrow-down"></i>
                    Shopping Cart
                    <span class="badge bg-primary text-white">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span>
                    </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user-circle"></i> User Management <span class="caret"></span>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @if (Auth::check())
                        <a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a>
                    @else
                        <a class="dropdown-item" href="{{ route('user.signup') }}">Signup</a>
                        <a class="dropdown-item" href="{{ route('user.signin') }}">Signin</a>
                    @endif
                </div>
            </li>
        </ul>
    </div>
</nav>

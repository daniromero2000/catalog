<div class="dropdown-menu dropdown-menu-lg dropdown-menu-dark bg-default dropdown-menu-right">
    <div class="row shortcuts px-4">
        <a href="{{ route('admin.customers.index')}}" class="col-4 shortcut-item">
            <span class="shortcut-media avatar rounded-circle bg-gradient-red">
                <i class="ni ni-user"></i>
            </span>
            <small>Clientes</small>
        </a>
        <a href="{{ route('admin.orders.index')}}" class="col-4 shortcut-item">
            <span class="shortcut-media avatar rounded-circle bg-gradient-info">
                <i class="ni ni-credit-card"></i>
            </span>
            <small>Ordenes</small>
        </a>
        <a href="{{ route('admin.checkouts.index')}}" class="col-4 shortcut-item">
            <span class="shortcut-media avatar rounded-circle bg-gradient-green">
                <i class="ni ni-books"></i>
            </span>
            <small>Checkouts</small>
        </a>
        <a href="{{ route('admin.products.index')}}" class="col-4 shortcut-item">
            <span class="shortcut-media avatar rounded-circle bg-gradient-yellow">
                <i class="ni ni-basket"></i>
            </span>
            <small>Productos</small>
        </a>
        <a href="{{ route('admin.wishlists.index')}}" class="col-4 shortcut-item">
            <span class="shortcut-media avatar rounded-circle bg-gradient-yellow">
                <i class="fas fa-heart"></i>
            </span>
            <small>Wishlist</small>
        </a>
    </div>
</div>
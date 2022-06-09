<div class="wrapper mt-5">
    <div id="content ">
        <div class="container-reset">
            <div class="row mx-auto">
                <div class="col-lg-3">
                    <nav class="navbar navbar-expand-lg navbar-light mb-2 btn-sm">
                        <div class="container-fluid mb-3">
                            <button type="button" class="btn button-reset" id="sidebarCollapse">
                                <i class="fas fa-align-left"></i>
                                Opciones
                            </button>
                        </div>
                    </nav>
                    <nav id="sidebar">
                        <div id="dismiss">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="sidebar-header">
                        </div>
                        @include('ecommerce::front.categories.layouts.sidebars.sidebar_category_option_one')
                    </nav>
                    <div class="sidebar-responsive">
                        @include('ecommerce::front.categories.layouts.sidebars.sidebar_category_option_one',
                        ['attributes' => $attributes])
                    </div>
                </div>
                <div class="col-lg-9 px-1 mx-auto">
                    @if(!empty($products) && !collect($products)->isEmpty())
                    @include('ecommerce::front.categories.layouts.pagination')
                    @include('layouts.front.products.list_products', ['products' => $products])
                    @include('ecommerce::front.categories.layouts.pagination')
                    @else
                    <p class="alert alert-warning">No hay productos aún</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
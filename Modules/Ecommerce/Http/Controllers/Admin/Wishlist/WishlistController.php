<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\Wishlist;

use Modules\Ecommerce\Entities\Wishlists\Repositories\Interfaces\WishlistRepositoryInterface;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class WishlistController extends Controller
{
    private $wishlistRepo, $toolsInterface;

    public function __construct(
        WishlistRepositoryInterface $wishlistInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->wishlistRepo   = $wishlistInterface;
        $this->toolsInterface = $toolRepositoryInterface;
        $this->module         = 'Wishlists';
    }

    public function index(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->has('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->wishlistRepo->searchWishlists(request()->input('q'), $skip * 10);
            $paginate = $this->wishlistRepo->countWishlists(request()->input('q'), '');
            $request->session()->flash('message', config('messaging.searching'));
        } else if ((request()->has('t') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->wishlistRepo->searchWishlists(request()->input('q'), $skip * 10, $from, $to);
            $paginate = $this->wishlistRepo->countWishlists(request()->input('q'), $from, $to);
            $request->session()->flash('message', config('messaging.searching'));
        } else {
            $paginate = $this->wishlistRepo->countWishlists(null);
            $list     = $this->wishlistRepo->list($skip * 10);
        }

        //dd($list);

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);
        return view('ecommerce::admin.wishlist.list', [
            'wishlist'      => $list,
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module,
            'skip'          => $skip,
            'headers'       => ['Nombre de cliente', 'Producto deseado', 'Fecha de registro', 'Acciones'],
            'paginate'      => $getPaginate['paginate'],
            'position'      => $getPaginate['position'],
            'page'          => $getPaginate['page'],
            'limit'         => $getPaginate['limit']
        ]);
    }

    public function create()
    {
        return view('ecommerce::admin.wishlist.create', [
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module
        ]);
    }

    public function store(Request $request)
    {
        if (!is_null(auth()->user())) {
            $data = [
                'product_id' => $request->input('id'),
                'customer_id' => auth()->user()->id
            ];

            return $this->wishlistRepo->createWishlist($data);
        }
    }
}

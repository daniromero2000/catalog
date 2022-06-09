<?php

namespace Modules\Ecommerce\Entities\Wishlists\Repositories;

use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\Ecommerce\Entities\Products\Exceptions\WishlistCreateErrorException;
use Modules\Ecommerce\Entities\Wishlists\Repositories\Interfaces\WishlistRepositoryInterface;
use Modules\Ecommerce\Entities\Wishlists\Wishlist;

class WishlistRepository implements WishlistRepositoryInterface
{
    protected $model;
    private $columns = [
        'product_id',
        'customer_id',
        'moved_to_cart',
        'shared',
        'time_of_moving',
        'created_at'
    ];

    public function __construct(
        Wishlist $Wishlist
    ) {
        $this->model = $Wishlist;
    }

    public function listWishList($id): Collection
    {
        return $this->model->with('product')->where('customer_id', $id)
            ->where('moved_to_cart', null)->orderBy('created_at', 'desc')
            ->get($this->columns);
    }

    public function createWishlist(array $data): Wishlist
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new WishlistCreateErrorException($e->getMessage());
        }
    }

    public function deleteWishlist($id)
    {
        $data = $this->model->findOrFail($id);
        return  $data->delete();
    }

    public function moveToCartWishlist($id)
    {
        $data = $this->model->findOrFail($id);
        $date = ['moved_to_cart' => date("Y-m-d")];
        return  $data->update($date);
    }

    public function listWishListAdmin(): Collection
    {
        return $this->model->with(['product', 'customer'])->orderBy('created_at', 'desc')
            ->get($this->columns);
    }

    public function searchWishlists(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->list($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model
                ->searchWishlists($text)
                ->skip($totalView)->take(10)->get($this->columns);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->skip($totalView)->take(10)->get($this->columns);
        }

        return $this->model->searchWishlists($text)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('created_at', 'desc')->skip($totalView)->take(10)
            ->get($this->columns);
    }

    public function countWishlists(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return count($this->model->get(['id']));
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return count($this->model->searchWishlists($text)
                ->get(['id']));
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return count($this->model->whereBetween('created_at', [$from, $to])
                ->get(['id']));
        }

        return count($this->model->searchWishlists($text)
            ->whereBetween('created_at', [$from, $to])->get(['id']));
    }

    public function list(int $totalView): Collection
    {
        return $this->model->with(['product', 'customer'])->orderBy('created_at', 'desc')->skip($totalView)->take(10)
            ->get($this->columns);
    }
}

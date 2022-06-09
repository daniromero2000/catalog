<?php

namespace Modules\Ecommerce\Entities\Wishlists\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\Ecommerce\Entities\Wishlists\Wishlist;

interface WishlistRepositoryInterface
{
    public function listWishList($id): Collection;

    public function createWishlist(array $wishlist): Wishlist;

    public function deleteWishlist($id);

    public function moveToCartWishlist($id);

    public function listWishlistAdmin(): Collection;

    public function searchWishlists(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countWishlists(string $text = null,  $from = null, $to = null);

    public function list(int $totalView): Collection;
}

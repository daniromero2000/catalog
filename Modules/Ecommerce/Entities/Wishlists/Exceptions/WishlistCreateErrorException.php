<?php

namespace Modules\Ecommerce\Entities\Wishlists\Exceptions;

use Modules\Generals\Entities\Tools\ToolRepository;


class WishlistCreateErrorException extends \Exception
{
    protected $errors;

    public function __construct($e)
    {
        $this->errors = $e;
        ToolRepository::logException($this->errors);
    }
}

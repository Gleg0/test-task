<?php

namespace App\Exception;

use RuntimeException;
use Symfony\Component\HttpFoundation\Response;


class CollectionNotFoundException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct("collection not found",Response::HTTP_NOT_FOUND,null);
    }
}

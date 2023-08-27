<?php

namespace App\Exception;

use RuntimeException;
use Symfony\Component\HttpFoundation\Response;


class ContributorNotFoundException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct("contribution not found",Response::HTTP_NOT_FOUND,null);
    }
}

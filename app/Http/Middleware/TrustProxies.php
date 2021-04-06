<?php

namespace App\Http\Middleware;

use Fideloper\Proxy\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array|string|null
     */
//    protected $proxies
    protected $proxies = '*'; // workaround for failed assets loading on heroku


    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
//    protected $headers = Request::HEADER_X_FORWARDED_FOR | Request::HEADER_X_FORWARDED_HOST | Request::HEADER_X_FORWARDED_PORT | Request::HEADER_X_FORWARDED_PROTO | Request::HEADER_X_FORWARDED_AWS_ELB;
    protected $headers = Request::HEADER_X_FORWARDED_AWS_ELB; // second part of workaround for heroku
    // this piece of shit must be removed before deployment on another server
}

<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Fideloper\Proxy\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    protected $proxies = '*';                                // trust all proxies
    protected $headers  = Request::HEADER_X_FORWARDED_ALL;   // respect X-Forwarded-Proto
}

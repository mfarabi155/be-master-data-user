<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Authenticate
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        return $next($request);
    }

    protected function authenticate(Request $request, array $guards)
    {
        if (Auth::guard('api')->guest()) {
            // Mengembalikan response JSON jika token tidak valid atau user tidak terautentikasi
            throw new UnauthorizedHttpException('Bearer', 'Invalid token or unauthorized access');
        }
    }
}


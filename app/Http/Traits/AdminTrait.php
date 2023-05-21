<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Auth;

trait AdminTrait
{
    protected $users;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            return $next($request);
        });
    }
}

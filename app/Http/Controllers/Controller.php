<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Arr;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function saveSearchSession($_KEY, $value)
    {
        session()->put($_KEY, $value);
    }

    public function clearSession($_KEY)
    {
        $arraySession = [
            'users','position','department','access_right',
            'timekeeping','reward_and_discipline','salary','list_users'
        ];
        $filtered = Arr::except($arraySession, [$_KEY]);
        session()->forget($filtered);
    }
}

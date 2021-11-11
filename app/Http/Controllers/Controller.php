<?php

namespace App\Http\Controllers;

use DevcorpIt\ResponseCode\Http\Controllers\ResponseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
//use Illuminate\Routing\Controller as BaseController;

class Controller extends ResponseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){
        parent::__construct();
        auth()->setDefaultDriver('api');
    }
}

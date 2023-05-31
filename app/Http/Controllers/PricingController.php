<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class PricingController extends BaseController
{

    public function __construct(Request $request)
    {
        //parent::__construct($request);
    }

    protected function index()
    {
        return view('pricing');
    }
}

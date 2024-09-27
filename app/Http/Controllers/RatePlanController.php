<?php

namespace App\Http\Controllers;

use App\Repositories\RatePlan\RatePlanRepository;
use Illuminate\Http\Request;

class RatePlanController extends Controller
{
    protected $repositoryRatePlan;
    public function __construct(RatePlanRepository $repositoryRatePlan){
        $this->repositoryRatePlan = $repositoryRatePlan;
    }

    public function index(){

    }

    public function create(Request $request){}
}

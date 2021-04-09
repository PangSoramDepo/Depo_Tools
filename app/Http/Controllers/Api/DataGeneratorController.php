<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Euser;

class DataGeneratorController extends Controller
{
    public function data()
    {
        $startFrom = request('startFrom');
        $inserts = [];
        for($i=$startFrom; $i< $startFrom + 10000; $i++) {
            array_push($inserts,array(
                'username'  => 85519000000 + $i,
                'password'  => 'tsungloadtest',
                'iterationcount'    => 0
            ));
        }
        return Euser::insert($inserts);
    }

    public function count()
    {
        return Euser::count();
    }

    public function last()
    {
        return Euser::where('password','tsungloadtest')->orderBy('username','DESC')->take(5)->get();
    }
}

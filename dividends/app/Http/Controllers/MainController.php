<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestModel;

class MainController extends Controller
{
    public function main(){

        return view('test', ['data' => TestModel::all()]);

        //return 'OK';
    }
}

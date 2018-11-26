<?php
namespace ModuleEx\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ExController extends Controller {

    public function __construct(){

    }

    public function index(Request $request){
        return view('ModuleEx::index');
    }
}
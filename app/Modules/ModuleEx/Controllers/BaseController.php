<?php
namespace ModuleEx\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class BaseController extends Controller {

    protected $viewData = array();

    public function __construct() {

    }

    public function getView($view) {
        return view('ModuleEx::' . $view, $this->viewData);
    }
}
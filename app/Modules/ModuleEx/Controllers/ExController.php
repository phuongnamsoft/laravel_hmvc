<?php
namespace ModuleEx\Controllers;

use Illuminate\Http\Request;
use ModuleEx\Repositories\ExRepository;

class ExController extends BaseController {

    private $exRepository;

    public function __construct(ExRepository $exRepository){
        $this->exRepository = $exRepository;
    }

    public function index(Request $request) {
        $this->viewData['data'] = $this->exRepository->showIndex();
        return parent::getView('index');
    }
}
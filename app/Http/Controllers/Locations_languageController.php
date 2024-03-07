<?php

namespace App\Http\Controllers;

use App\Modules\App\Services\Locations_languageService;
use Illuminate\Http\Request;

class Locations_languageController extends Controller
{
    private $_service;

    public function __construct(Locations_languageService $service)
    {
        $this->_service = $service;
    }

    public function add(Request $request)
    {
        $data = $request->all();
        $locationLanguage = $this->_service->add($data);
        if($this->_service->hasErrors()) {
            return ["errors"=>$this->_service->getErrors()];
        }
        return ["data"=>$locationLanguage];
    }
}

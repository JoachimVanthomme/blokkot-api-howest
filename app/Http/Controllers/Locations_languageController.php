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

    public function update($id, Request $request)
    {
        $data = $request->all();
        $locationLanguage = $this->_service->update($id, $data);
        if($this->_service->hasErrors()) {
            return ["errors"=>$this->_service->getErrors()];
        }
        return ["data"=>$locationLanguage];
    }

    public function delete($location_id)
    {
        $locationLanguage = $this->_service->delete($location_id);
        if($this->_service->hasErrors()) {
            return ["errors"=>$this->_service->getErrors()];
        }
        return ["data"=>$locationLanguage];
    }
}

<?php

namespace App\Http\Controllers;

use App\Modules\App\Services\LocationService;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    private $_service;
    //private Locations_languageController $locations_languageController;

    public function __construct(LocationService $service)
    {
        $this->_service = $service;
    }

    public function all(Request $request)
    {
        $pages = $request->get("pages", 10);
        return $this->_service->all($pages);
    }

    public function find($id) : array
    {
        $location = $this->_service->find($id);
        return ["data"=>$location];
    }

    public function findByCity(Request $request) : array
    {
        $data = $request->all();
        $data = $this->_service->findByCity($data['city']);
        return ["data"=>$data];
    }

    public function add(Request $request) : array
    {
        //$data = $request->all();
        //$location = $this->_service->add($data);
        //$locations_languageController = $this->locations_languageController->add($request);
        //if($this->_service->hasErrors() || $locations_languageController->hasErrors()) {
        //    return ["Location errors"=>$this->_service->getErrors(), "Language erros"=>$locations_languageController->getErrors()];
        //}
        //return ["data"=>$location];

        $data = $request->all();
        $location = $this->_service->add($data);
        if($this->_service->hasErrors()) {
            return ["errors"=>$this->_service->getErrors()];
        }
        return ["data"=>$location];
    }

    public function update($id, Request $request) : array
    {
        $data = $request->all();
        $location = $this->_service->update($id, $data);
        if($this->_service->hasErrors()) {
            return ["errors"=>$this->_service->getErrors()];
        }
        return ["data"=>$location];
    }

    public function delete($id) : array
    {
        $location = $this->_service->delete($id);
        if($this->_service->hasErrors()) {
            return ["errors"=>$this->_service->getErrors()];
        }
        return ["data"=>$location];
    }
}

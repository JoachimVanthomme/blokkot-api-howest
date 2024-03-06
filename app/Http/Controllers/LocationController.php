<?php

namespace App\Http\Controllers;

use App\Modules\App\Services\LocationService;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    private $_service;

    public function __construct(LocationService $service)
    {
        $this->_service = $service;
    }

    public function all(Request $request)
    {
        $pages = $request->get("pages", 10);
        return $this->_service->all($pages);
    }

    public function find($id)
    {
        $data = $this->_service->find($id);
        return ["data"=>$data];
    }

    public function findByCity($city)
    {
        $data = $this->_service->findByCity($city);
        return ["data"=>$data];
    }

    public function add(Request $request)
    {
        $data = $request->all();
        $location = $this->_service->add($data);
        if($this->_service->hasErrors()){
            return ["errors"=>$this->_service->getErrors()];
        }
        return ["data"=>$location];
    }

    public function update($id, Request $request)
    {
        $data = $request->all();
        $location = $this->_service->update($id, $data);
        if($this->_service->hasErrors()) {
            return ["errors"=>$this->_service->getErrors()];
        }
        return ["data"=>$location];
    }

    public function delete($id)
    {
        $location = $this->_service->delete($id);
        if($this->_service->hasErrors()) {
            return ["errors"=>$this->_service->getErrors()];
        }
        return ["data"=>$location];
    }
}

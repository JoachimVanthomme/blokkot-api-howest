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

    public function findImageByName($image_path)
    {
        $image = $this->_service->findImageByName($image_path);

        if (!$image){
            return response()->json(["error"=>"Image not found"], 404);
        }

        $path = storage_path('app/images/'.$image_path);

        if (!file_exists($path)) {
            return response()->json(['error' => 'Image not found in storage'], 404);
        }

        return response()->file($path);
    }

    public function mostLocations() : array
    {
        $data = $this->_service->mostLocations();
        return ["data"=>$data];
    }

    public function allCities() : array
    {
        $data = $this->_service->allCities();
        return ["data"=>$data];
    }
}

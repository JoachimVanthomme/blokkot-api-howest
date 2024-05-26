<?php

namespace App\Http\Controllers;

use App\Modules\App\Services\OwnerService;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    private $_service;

    public function __construct(OwnerService $service)
    {
        $this->_service = $service;
    }

    public function findByUser(Request $request)
    {
        $pages = $request->get("pages", 5);
        $data = $this->_service->findByUser($pages);
        return ["data"=>$data];
    }

    public function add(Request $request)
    {
        $data = $request->all();
        $owner = $this->_service->add($data);
        if($this->_service->hasErrors()) {
            return ["errors"=>$this->_service->getErrors()];
        }
        return ["data"=>$owner];
    }

    public function delete($location_id)
    {
        $owner = $this->_service->delete($location_id);
        if($this->_service->hasErrors()) {
            return ["errors"=>$this->_service->getErrors()];
        }
        return ["data"=>$owner];
    }
}

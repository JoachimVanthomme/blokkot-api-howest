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

    public function findByUser($id)
    {
        $data = $this->_service->findByUser($id);
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

    public function delete($user_id, $location_id)
    {
        $owner = $this->_service->delete($user_id, $location_id);
        if($this->_service->hasErrors()) {
            return ["errors"=>$this->_service->getErrors()];
        }
        return ["data"=>$owner];
    }
}

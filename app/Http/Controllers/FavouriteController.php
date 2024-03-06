<?php

namespace App\Http\Controllers;

use App\Modules\App\Services\FavouriteService;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    private $_service;

    public function __construct(FavouriteService $service)
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
        $favourite = $this->_service->add($data);
        if($this->_service->hasErrors()) {
            return ["errors"=>$this->_service->getErrors()];
        }
        return ["data"=>$favourite];
    }

    public function delete($id)
    {
        $favourite = $this->_service->delete($id);
        if($this->_service->hasErrors()) {
            return ["errors"=>$this->_service->getErrors()];
        }
        return ["data"=>$favourite];
    }
}

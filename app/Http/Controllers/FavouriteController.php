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

    public function add($location_id)
    {
        $favourite = $this->_service->add($location_id);
        if($this->_service->hasErrors()) {
            return ["errors"=>$this->_service->getErrors()];
        }
        return ["data"=>$favourite];
    }

    public function delete($user_id, $location_id)
    {
        $favourite = $this->_service->delete($user_id, $location_id);
        if($this->_service->hasErrors()) {
            return ["errors"=>$this->_service->getErrors()];
        }
        return ["data"=>$favourite];
    }
}

<?php

namespace App\Http\Controllers;

use App\Modules\App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $_service;

    public function __construct(UserService $service)
    {
        $this->_service = $service;
    }

    public function all()
    {
        $data = $this->_service->all();
        return ["data"=>$data];
    }

    public function admins()
    {
        $data = $this->_service->admins();
        return ["data"=>$data];
    }

    public function developers()
    {
        $data = $this->_service->developers();
        return ["data"=>$data];
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $user = $this->_service->update($data, $id);
        if($this->_service->hasErrors()) {
            return ["errors"=>$this->_service->getErrors()];
        }
        return ["data"=>$user];
    }
}

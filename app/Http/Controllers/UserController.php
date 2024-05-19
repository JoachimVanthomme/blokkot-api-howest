<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    private $_service;

    public function __construct(UserService $service)
    {
        $this->_service = $service;
    }
}

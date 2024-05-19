<?php

namespace App\Modules\App\Services;

use App\Models\User;
use App\Modules\Core\Services\Service;

class UserService extends Service
{
    protected $_rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ];

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function all()
    {
        return $this->_model->all();
    }

    public function admins()
    {
        return $this->_model->where('is_admin', true)->get();
    }

    public function developers()
    {
        return $this->_model->where('is_developer', true)->get();
    }
}

<?php

namespace App\Modules\App\Services;

use App\Models\User;
use App\Modules\Core\Services\Service;

class UserService extends Service
{
    protected $_rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'username' => 'required|string|max:255',
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

    public function update($data, $id)
    {
        $this->validate($data);
        if ($this->hasErrors()) {
            return;
        }

        $user = $this->_model->find($id);
        if (!$user) {
            return ['error' => "User not found."];
        }

        try {
            $user->update($data);
        } catch (\Exception $e) {
            return ['error' => "An error occurred, please try again later or contact the administrator."];
        }

        return $user;
    }
}

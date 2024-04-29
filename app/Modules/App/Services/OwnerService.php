<?php

namespace App\Modules\App\Services;

use App\Models\Owner;
use App\Modules\Core\Services\Service;

class OwnerService extends Service
{
    protected $_rules = [
        'user_id' => 'required|integer',
        'location_id' => 'required|integer',
    ];

    public function __construct(Owner $model)
    {
        parent::__construct($model);
    }

    public function findByUser($id)
    {
        return $this->_model->where('user_id', $id)->with('location')->get();
    }

    public function add($data)
    {
        $this->validate($data);
        if ($this->haserrors()) {
            return;
        }
        $favourite = $this->_model->create($data);
        return $favourite;
    }

    public function delete($id) {
        $favourite = $this->_model->find($id)->delete();
        return $favourite;
    }
}

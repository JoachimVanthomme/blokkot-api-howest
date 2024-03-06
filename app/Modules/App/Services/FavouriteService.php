<?php

namespace App\Modules\App\Services;

use App\Models\Favourite;
use App\Modules\Core\Services\Service;

class FavouriteService extends Service
{
    protected $_rules = [
        'user_id' => 'required|integer',
        'location_id' => 'required|integer',
    ];

    public function __construct(Favourite $model)
    {
        parent::__construct($model);
    }

    public function findByUser($data)
    {
        return $this->_model->where('user_id', $data['user_id'])->get();
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

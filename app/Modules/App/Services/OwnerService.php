<?php

namespace App\Modules\App\Services;

use App\Models\Owner;
use App\Modules\Core\Services\Service;
use Illuminate\Http\Response;

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

    public function findByUser($pages)
    {
        return $this->_model->where('user_id', auth()->user()->id)
            ->join('locations', 'owners.location_id', '=', 'locations.id')
            ->select('locations.*')
            ->paginate($pages)
            ->withQueryString();
    }

    public function add($data)
    {
        $this->validate($data);
        if ($this->haserrors()) {
            return;
        }

        if ($this->_model->where('user_id', $data['user_id'])->where('location_id', $data['location_id'])->exists()) {
            return ['error' => "Combination of user and location already exists."];
        }

        try {
            $owner = $this->_model->create($data);
        } catch (\Exception $e) {
            return ['error' => "An error occurred, please try again later or contact the administrator."];
        }

        return $owner;
    }

    public function delete($user_id, $location_id)
    {
        if ($this->_model->where('user_id', auth()->user()->id)->where('location_id', $location_id)->doesntExist()) {
            return ['error' => "Combination of user and location does not exist."];
        }

        try {
            $owner = $this->_model->where('user_id', auth()->user()->id)->where('location_id', $location_id)->delete();
        } catch (\Exception $e) {
            return ['error' => "An error occurred, please try again later or contact the administrator."];
        }

        return $owner;
    }
}

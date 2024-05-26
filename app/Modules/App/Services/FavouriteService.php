<?php

namespace App\Modules\App\Services;

use App\Models\Favourite;
use App\Modules\Core\Services\Service;

class FavouriteService extends Service
{
    protected $_rules = [
        'location_id' => 'required|integer',
    ];

    public function __construct(Favourite $model)
    {
        parent::__construct($model);
    }

    public function findByUser()
    {
        return $this->_model->where('user_id', auth()->user()->id)
        //return $this->_model->where('user_id', 10)
            ->join('locations', 'favourites.location_id', '=', 'locations.id')
            ->select('locations.*')
            ->get();
    }

    public function add($location_id)
    {
        $data['user_id'] = auth()->user()->id;
        $data['location_id'] = $location_id;
        $this->validate($data);
        if ($this->haserrors()) {
            return;
        }

        if ($this->_model->where('user_id', $data['user_id'])->where('location_id', $data['location_id'])->exists()) {
            return ['error' => "Combination of user and location already exists."];
        }

        try {
            $favourite = $this->_model->create(['user_id' => $data['user_id'], 'location_id' => $data['location_id']]);
        } catch (\Exception $e) {
            return ['error' => "An error occurred, please try again later or contact the administrator."];
        }

        return $favourite;
    }

    public function delete($location_id)
    {
        if ($this->_model->where('user_id', auth()->user()->id)->where('location_id', $location_id)->doesntExist()) {
            return ['error' => "Combination of user and location does not exist."];
        }

        try {
            $favourite = $this->_model->where('user_id', auth()->user()->id)->where('location_id', $location_id)->delete();
        } catch (\Exception $e) {
            return ['error' => "An error occurred, please try again later or contact the administrator."];
        }

        return $favourite;
    }
}

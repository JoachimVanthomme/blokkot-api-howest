<?php

namespace App\Modules\App\Services;

use App\Models\Location;
use App\Modules\Core\Services\Service;

class LocationService extends Service
{
    protected $_rules = [
        'name' => 'required|string',
        'street' => 'required|string',
        'street_number' => 'required|string',
        'postcode' => 'required|string',
        'city' => 'required|string',
        'hours' => 'required|string',
        'capacity' => 'required|integer',
        'info' => 'required|string',
        'is_reservation_mandatory' => 'required|boolean',
        'image_path' => 'required|string',
        'reservation_link' => 'required|string',
    ];

    public function __construct(Location $model)
    {
        parent::__construct($model);
    }

    public function all($pages)
    {
        return $this->_model->paginate($pages)->withQueryString();
    }

    public function find($id)
    {
        return $this->_model->find($id);
    }

    public function findByCity($city)
    {
        return $this->_model->where('city', $city)->get();
    }

    public function add($data)
    {
        $this->validate($data);
        if ($this->haserrors()) {
            return;
        }
        $location = $this->_model->create($data);
        return $location;
    }

    public function update($id, $data)
    {
        $this->validate($data);
        if ($this->haserrors()) {
            return;
        }
        $location = $this->_model->find($id)->update($data);
        return $location;
    }

    public function delete($id) {
        $location = $this->_model->find($id)->delete();
        return $location;
    }
}

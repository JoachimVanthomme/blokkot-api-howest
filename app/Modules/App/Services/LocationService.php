<?php

namespace App\Modules\App\Services;

use App\Models\Location;
use App\Models\Locations_language;
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

    private $_locations_languageModel;

    public function __construct(Location $model)
    {
        parent::__construct($model);
        $this->_locations_languageModel = new Locations_language();
    }

    public function all($pages)
    {
        return $this->_model->paginate($pages)->withQueryString();
    }

    public function find($id)
    {
        return $this->_model->find($id)
            ->join('locations_languages', 'locations.id', '=', 'locations_languages.location_id')
            ->where('locations_languages.language', app()->getLocale())
            ->get();
    }

    public function findByCity($city)
    {
        return $this->_model->where('city', 'LIKE', "%{$city}%")->get();
    }

    public function add($data) : array
    {
        $this->validate($data);
        if ($this->haserrors()) {
            return $this->hasErrors();
        }
        $location = $this->_model->create($data);
        $location_language = $this->_locations_languageModel->create([
            'location_id' => $location->id,
            'language' => $data['language'],
            'hours' => $data['hours'],
            'info' => $data['info'],
        ]);
        return [$location, $location_language];
    }

    public function update($id, $data)
    {
        $this->validate($data);
        if ($this->haserrors()) {
            return $this->hasErrors();
        }
        $location = $this->_model->find($id)->update($data);
        return $location;
    }

    public function delete($id) {
        $location = $this->_model->find($id)->delete();
        return $location;
    }
}

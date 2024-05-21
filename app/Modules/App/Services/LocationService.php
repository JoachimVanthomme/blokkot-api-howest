<?php

namespace App\Modules\App\Services;

use App\Models\Location;
use App\Models\Locations_language;
use App\Models\Owner;
use App\Modules\Core\Services\Service;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

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
        'reservation_link' => 'required|string',
        'is_active' => 'required|boolean',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'languages' => 'required|array',
    ];

    private $_locations_languageModel;
    private $_ownerModel;

    public function __construct(Location $model)
    {
        parent::__construct($model);
        $this->_locations_languageModel = new Locations_language();
        $this->_ownerModel = new Owner();
    }

    public function all($pages)
    {
        return $this->_model->paginate($pages)->withQueryString();
    }

    public function find($id)
    {
        return $this->_model->where('locations.id', $id)
            ->join('locations_languages', 'locations.id', '=', 'locations_languages.location_id')
            ->where('locations_languages.language', app()->getLocale())
            ->get();
    }

    public function findByCity($city)
    {
        return $this->_model
            ->where([['city', 'LIKE', "%{$city}%"],['is_active', '=', true]])
            ->orwhere([['name', 'LIKE', "%{$city}%"],['is_active', '=', true]])
            ->paginate(10)
            ->withQueryString();
    }

    public function add($data)
    {
        $this->validate($data);
        if ($this->haserrors()) {
            return $this->hasErrors();
        }

        if (isset($data['image'])) {
            $data['image_path'] = $data['image']->store();
        }

        else {
            $data['image_path'] = 'default.jpg';
        }

        Arr::forget($data, 'image');

        try {
            $location = $this->_model->create($data);
        } catch (\Exception $e) {
            return ['error' => $e];
        }



        foreach ($data['languages'] as $language) {
           $this->_locations_languageModel->create([
                'location_id' => $location->id,
                'language' => $language['language'],
                'hours' => $language['hours'],
                'info' => $language['info'],
            ]);
        }

        $this->_ownerModel->create([
            'user_id' => auth()->user()->id,
            'location_id' => $location->id,
        ]);

        return [$location];
    }

    public function update($id, $data)
    {
        $this->validate($data);
        if ($this->haserrors()) {
            return $this->hasErrors();
        }

        if (isset($data['image'])) {
            Storage::delete($this->_model->find($id)->image_path);
            $data['image_path'] = $data['image']->store();
            Arr::forget($data, 'image');
        }

        $location = $this->_model->find($id)->update($data);

        foreach ($data['languages'] as $language) {
            $this->_locations_languageModel->updateOrCreate(
                ['location_id' => $id, 'language' => $language['language']],
                ['hours' => $language['hours'], 'info' => $language['info']]
            );
        }

        return [$location];
    }

    public function delete($id) {
        Storage::delete($this->_model->find($id)->image_path);
        $location = $this->_model->find($id)->delete();
        return $location;
    }

    public function findImageByName($image_path)
    {
        $this->validate(['image_path' => $image_path]);

        if ($this->hasErrors()) {
            return $this->getErrors();
        }

        return $image_path;
    }

    public function mostLocations()
    {
        return $this->_model->select('city')->groupBy('city')->orderByRaw('COUNT(city) DESC')->limit(3)->get();
    }

    public function allCities()
    {
        return $this->_model->select('city')->where('is_active', '=', true)->groupBy('city')->get();
    }

    public function getAllLanguages($id)
    {
        $data = $this->_model->with('locations_language')->find($id);
        $data->languages = $data->locations_language;
        unset($data->locations_language);
        return $data;
    }
}

<?php

namespace App\Modules\App\Services;
use App\Models\Locations_language;
use App\Modules\Core\Services\Service;

class Locations_languageService extends Service
{
    protected $_rules = [
        'location_id' => 'required|integer',
        'language' => 'required|string',
        'hours' => 'required|text',
        'info' => 'required|text',
    ];

    public function __construct(Locations_language $model)
    {
        parent::__construct($model);
    }

    //When is this usefull?
    //public function findByLanguage($language)
    //{
    //    return $this->_model->where('language', $language)->get();
    //}

    public function add($data)
    {
        $this->validate($data);
        if ($this->haserrors()) {
            return;
        }
        $locationLanguage = $this->_model->create($data);
        return $locationLanguage;
    }

    public function update($id, $data)
    {
        $this->validate($data);
        if ($this->haserrors()) {
            return;
        }
        $locationLanguage = $this->_model->find($id)->update($data);
        return $locationLanguage;
    }

    public function delete($location_id) {
        $locationLanguage = $this->_model
            ->where('location_id', $location_id)
            ->delete();
        return $locationLanguage;
    }
}

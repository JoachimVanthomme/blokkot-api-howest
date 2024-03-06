<?php

namespace App\Modules\App\Services;
use App\Models\Locations_language;
use App\Modules\Core\Services\Service;

class Locations_languageService extends Service
{
    protected $_rules = [
        'location_id' => 'required|integer',
        'language' => 'required|string',
        'hours' => 'required|string',
        'info' => 'required|string',
    ];

    public function __construct(Locations_language $model)
    {
        parent::__construct($model);
    }

    public function findByLanguage($language)
    {
        return $this->_model->where('language', $language)->get();
    }

    public function add($data)
    {
        $this->validate($data);
        if ($this->haserrors()) {
            return;
        }
        $locationLanguage = $this->_model->create($data);
        return $locationLanguage;
    }

    public function delete($id) {
        $locationLanguage = $this->_model->find($id)->delete();
        return $locationLanguage;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiDataModel extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public static function fromArray(array $data): self
    {
        $model = new self;
        $model->forceFill($data);
        $model->exists = true;

        return $model;
    }
}

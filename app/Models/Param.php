<?php

namespace App\Models;

use App\Enums\Param\FilterTypeEnum;
use Illuminate\Database\Eloquent\Model;

class Param extends Model
{
    public function getFilterTypeTitleAttribute(): string
    {
        return FilterTypeEnum::map()[$this->filter_type];
    }
}

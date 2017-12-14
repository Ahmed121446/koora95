<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompetitionType extends Model
{
    public function countries()
    {
    	return $this->hasMany(Country::class);
    }
}

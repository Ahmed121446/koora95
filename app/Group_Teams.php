<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group_Teams extends Model
{
    public function group()
    {
    	return $this->belogsTo(Group::class);
    }
}

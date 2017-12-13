<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupTeams extends BaseModel
{
    public function group()
    {
    	return $this->belogsTo(Group::class);
    }
}

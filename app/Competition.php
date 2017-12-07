<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class competition extends BaseModel
{
	public function location()
	{
		return $this->morphTo();
	}
}

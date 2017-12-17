<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupTeams extends BaseModel
{
    public function group()
    {
    	return $this->belogsTo(Group::class);
    }

    public function storeTeamGolas($goals_for ,$goals_against){
    	$this->goals_for += $goals_for;
        $this->goals_against += $goals_against;
    }

    public function storeTeamCards($yellow_cards ,$red_cards){
        $this->yellow_cards += $yellow_cards;
        $this->red_cards += $red_cards;
    }
}
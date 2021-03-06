<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/** @SWG\Definition(
     *          definition = "season",
     *          @SWG\Property(
     *              property="name",
     *              type="string",
     *              description="season name",
     *              example="2017"
     *          ),
     *
     *          @SWG\Property(
     *              property="competition_id",
     *              type="integer",
     *              description="competition id",
     *              example="1"
     *          ),
     *         @SWG\Property(
     *              property="is_active_season",
     *              type="integer",
     *              description="competition id",
     *              example="1 or 0"
     *          ),
     *  )
     */
class Season extends BaseModel
{

	//relation 1-comp - M-Seasons
   public function competition(){
   		return $this->belongsTo(competition::class,'comp_id');
   }

    public function registeredTeams(){
   		return $this->hasMany(RegisteredTeam::class);
   }

   public function matches()
   {
   		return $this->hasMany(Match::class);
   }


   public function stages()
   {
         return $this->hasMany(Stage::class);
   }

   public function GroupStage()
   {
        $stages = $this->stages;
        foreach ($stages as $stage) {
            if($stage->groups()->first()){
                return $stage;
            }
        }

        return false;
   }
   
   public function league_groups()
   {

        $stage = $this->stages->where('name', 'group stage');
        if($stage->first()){
              $stage = $stage->first();
              return $stage->groups;
        }else{
              return false;
        }
   }



  public function teamsRanking()
  {
      return $this->registeredTeams()->orderBy('points', 'desc')->get();
  }


}

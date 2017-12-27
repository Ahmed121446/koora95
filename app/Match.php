<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//for RegisteredTeam properties
/**
 * @SWG\Definition(
 *      definition = "match_creation",
 *      @SWG\Property(
 *          property="date",
 *          type="string",
 *          example="2017-12-17"
 *      ),
 *      @SWG\Property(
 *          property="time",
 *          type="string",
 *          example="01:00:00"
 *      ),
 *      @SWG\Property(
 *          property="stage_id",
 *          type="integer",
 *          example=1
 *      ),
 *      @SWG\Property(
 *          property="team_1_id",
 *          type="integer",
 *          example=1
 *      ),
 *      @SWG\Property(
 *          property="team_2_id",
 *          type="integer",
 *          example=2
 *      ),
 *      @SWG\Property(
 *          property="stadium",
 *          type="string",
 *          example="Ahly stadium"
 *      )
 * )
 */

/**
 * @SWG\Definition(
 *      definition = "match_update",
 *      @SWG\Property(
 *          property="stage_id",
 *          type="integer",
 *          example=4
 *      ),
 *      @SWG\Property(
 *          property="group_round_id",
 *          type="integer",
 *          example=1
 *      ),
 *      @SWG\Property(
 *          property="group_id",
 *          type="integer",
 *          example=1
 *      ),
 *
 *      @SWG\Property(
 *          property="status",
 *          type="string",
 *          example="played"
 *      ),
 *      @SWG\Property(
 *          property="register_team_1_id",
 *          type="integer",
 *          example=1
 *      ),
 *      @SWG\Property(
 *          property="register_team_2_id",
 *          type="integer",
 *          example=2
 *      ),
 *      @SWG\Property(
 *          property="date",
 *          type="string",
 *          example="2017-12-17"
 *      ),
 *      @SWG\Property(
 *          property="time",
 *          type="string",
 *          example="01:00:00"
 *      ),
 *      @SWG\Property(
 *          property="stadium",
 *          type="string",
 *          example="Ahly stadium"
 *      ),
 *      @SWG\Property(
 *          property="team_1_goals",
 *          type="integer",
 *          example=5
 *      ),
 *      @SWG\Property(
 *          property="team_2_goals",
 *          type="integer",
 *          example=4
 *      ),
 *      @SWG\Property(
 *          property="winner_id",
 *          type="integer",
 *          example=2
 *      ),
 *      @SWG\Property(
 *          property="red_cards",
 *          type="integer",
 *          example=0
 *      ),
 *      @SWG\Property(
 *          property="yellow_cards",
 *          type="integer",
 *          example=5
 *      )
 * )
 */


/**
 * @SWG\Definition(
 *      definition = "match_confirm",
 *      @SWG\Property(
 *          property="first_team_goals",
 *          type="integer",
 *          example=3
 *      ),
 *      @SWG\Property(
 *          property="second_team_goals",
 *          type="integer",
 *          example=2
 *      ),
 *      @SWG\Property(
 *          property="first_team_red_cards",
 *          type="integer",
 *          example=1
 *      ),
 *      @SWG\Property(
 *          property="first_team_yellow_cards",
 *          type="integer",
 *          example=4
 *      ),
 *      @SWG\Property(
 *          property="second_team_yellow_cards",
 *          type="integer",
 *          example=3
 *      ),
 *      @SWG\Property(
 *          property="second_team_red_cards",
 *          type="integer",
 *          example=0
 *      )
 * )
 */
class Match extends BaseModel
{



    public function stage()
    {
    	return $this->belongsTo(Stage::class);
    }


    public function season()
    {
    	return $this->belongsTo(Season::class);
    }


    public function register_team_1()
    {
        return $this->belongsTo(RegisteredTeam::class, 'register_team_1_id');
    }


    public function scopeFindByStatus($query, $status)
    {
        return $query->where('status', $status);
    }


    public function scopeFindBySeason($query, $season_id)
    {
        return $query->where('season_id', $season_id);
    }


    public function scopeFindByDate($query, $date)
    {
        return $query->where('date', $date);
    }


    public function scopeFindByStage($query, $season_id, $stage_id, $group_round_id = null)
    {
        $query->where('season_id', $season_id)
              ->where('stage_id', $stage_id);

        if($group_round_id != null){
            $query->where('group_round_id', $group_round_id);
        }
    }


    public function scopeFilter($query, $data)
    {
        if(array_key_exists("status",$data)){
            $query->findByStatus($data['status']);
        }
        if(array_key_exists("date",$data) && $data['date'] != null ){
            $query->findByDate($data['date']);
        }
        if(array_key_exists("season",$data) && $data['season'] != 0){
            $query->findBySeason($data['season']);

            if(array_key_exists("stage",$data) && $data['stage'] != 0){
                $query->findByStage($data['season'], $data['stage']);

                if(array_key_exists("group_round",$data) && $data['group_round'] != 0){
                    $query->findByStage($data['season'], $data['stage'], $data['group_round']);
                }
            }
        }

    }



    //team1
    public function getTeam1Attribute()
    {
        if(isset($this->register_team_1)){
            return $this->register_team_1->team;
        }

        return [];
    }

    public function register_team_2()
    {
        return $this->belongsTo(RegisteredTeam::class,'register_team_2_id');
    }
    
    //team2
    public function getTeam2Attribute()
    {
        if(isset($this->register_team_2)){
            return $this->register_team_2->team;
        }

        return [];

    }

    public function register_team_winner()
    {
        return $this->belongsTo(RegisteredTeam::class,'winner_id');
    }
    //winner
    public function getWinnerAttribute()
    {
        if (isset($this->register_team_winner)) {
            return $this->register_team_winner->team;
        }
    }

    //calculate for match controller 
    public function match_winner($team_1_goals ,$team_2_goals, $is_cup)
    {
        
        if ($team_1_goals > $team_2_goals) {

            $this->winner_id = $this->register_team_1_id;
        }
        else if($team_1_goals < $team_2_goals){        
            $this->winner_id = $this->register_team_2_id;
        }else if(!$is_cup || $this->group_round_id){
            $this->winner_id = 0;
        }

    }


    public function set_winner($winner, $loser, $is_cup)
    {
        $winner->played += 1;
        $loser->played += 1;
        
        // calculate Points
        if(!$is_cup || $this->group_round_id){
            $winner->points += 3;
        }
        $winner->wins += 1;
        $loser->losses += 1;
    }


    public function set_draw($first_team, $second_team)
    {
        $first_team->played += 1;
        $second_team->played += 1;

        $first_team->draws += 1;
        $second_team->draws += 1;
    
        $first_team->points += 1;
        $second_team->points += 1;
    }


    public function storeMatchGoals($team1_final_goals, $team2_final_goals)
    {
        $this->team_1_goals = $team1_final_goals;
        $this->team_2_goals = $team2_final_goals;
    }

    public function storeMatchCards($match_cards)
    {
       $this->red_cards = $match_cards['first_team_cards']['first_team_red_cards'] + $match_cards['second_team_cards']['second_team_red_cards'];

        $this->yellow_cards = $match_cards['first_team_cards']['first_team_yellow_cards'] + $match_cards['second_team_cards']['second_team_yellow_cards'];
    }

    public function image()
    {
        $im = @imagecreate(1125, 1000) or die("Cannot Initialize new GD image stream");
        $background_color = imagecolorallocatealpha($im, 31,31,31,0);

        $im2 = imagecreatefrompng("http://www.zamzar.com/images/filetypes/png.png");
        // $color = imagecolorallocatealpha($im2, 255, 255, 255,10);
        // imagefill($im2, 0, 0, $color);
        imagealphablending($im2, false);
        imagecopyresampled($im,$im2,250,150,0,0,200,200,200,200);

        $im3 = imagecreatefrompng("https://www.compareninja.com/public/images/feature_simple.png");
        imagesavealpha($im3, true);
        imagepng($im3,"im3.png");
        imagecopyresampled($im,$im3,850,150,0,0,200,200,200,200);

        imagepng($im,"image.png");
        imagedestroy($im);
        print "<img src=image.png?".date("U").">";
    }


}

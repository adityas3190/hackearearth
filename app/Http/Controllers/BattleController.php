<?php

namespace App\Http\Controllers;

use App\Battle;
use Illuminate\Http\Request;

class BattleController extends Controller
{


    private $kingArray = array();
    private $n = 400;
    private $k=32;
    private $undefinedVariable = "Undefined";

    //This function fetches the rank of all the kings and sends it across to the homepage view
    public function index()
    {
            //return $this->kingArray;
            //return $finalData;
            return view('main.main')->with('results',$this->getPlayerData());
    }
    public function battles()
    {
        return view('main.battle')->with('results',$this->getBattleData());
    }
    //Get battle data
    public function getBattleData()
    {
        return Battle::all();
    }
    //Get player data
    public function getPlayerData()
    {
        $objectsBattle = Battle::get();
        foreach ($objectsBattle as $data)
        {
            if($data->attacker_king == "" || $data->defender_king == "")
                continue;

            $attackKingRating = $this->getRatings($data->attacker_king);//r1
            $defendKingRating = $this->getRatings($data->defender_king);//r2
            $transformAttackKingRating = (pow(10,$attackKingRating/$this->n));//R1
            $transformDefendKingRating = (pow(10,$defendKingRating/$this->n));//R2
            $expectedAttackKingRating = $transformAttackKingRating/($transformAttackKingRating+$transformDefendKingRating);//E1
            $expectedDefendKingRating = $transformDefendKingRating/($transformAttackKingRating+$transformDefendKingRating);//E2
            $scoreAttacker = $this->battleResult($data->attacker_outcome);
            $scoreDefender = 1- $scoreAttacker;
            $finalRatingAttacker = $attackKingRating+$this->k*($scoreAttacker-$expectedAttackKingRating);
            $finalRatingDefender = $defendKingRating + $this->k*($scoreDefender-$expectedDefendKingRating);
            $this->kingArray[$data->attacker_king] = $finalRatingAttacker;
            $this->kingArray[$data->defender_king] = $finalRatingDefender;

        }
        arsort($this->kingArray);
        $finalData = array();
        $countNames = 0;
        foreach ($this->kingArray as $key=>$value)
        {
            $finalData[$countNames]['id'] = $countNames;
            $finalData[$countNames]['name'] = $key;
            $finalData[$countNames]['rating'] = $value;
            $finalData[$countNames]['battleDetails'] = $this->getDetails($key);
            $countNames++;
        }
        return $finalData;
    }
    //Get a verdict of a battle
    private function battleResult($verdict)
    {
        if($verdict == 'win')
            return 1;
        else if($verdict == 'draw')
            return 0.5;
        else
            return 0;
    }
    //Get battle details of a particular king
    private function getDetails($king)
    {
        $kingData = Battle::where('attacker_king',$king)->orWhere('defender_king',$king)->get();
        $numberWars = 0;
        $battlesWon = 0;
        $battlesLost = 0;
        $wonBattles = array();
        $lostBattles = array();
        foreach ($kingData as $result)
        {
            if($result->attacker_king == $king)
            {
                if($result->attacker_outcome == "win")
                {
                    $wonBattles[$battlesWon]['year'] = $result->year;
                    $wonBattles[$battlesWon]['defeated'] = $result->defender_king;
                    $wonBattles[$battlesWon]['type'] = $result->battle_type;
                    $wonBattles[$battlesWon]['location'] = $result->location;
                    $battlesWon++;
                }
                else
                {
                    $lostBattles[$battlesLost]['year'] = $result->year;
                    $lostBattles[$battlesLost]['defeated'] = $result->attacker_king;
                    $lostBattles[$battlesLost]['type'] = $result->battle_type;
                    $lostBattles[$battlesLost]['location'] = $result->location;
                    $battlesLost++;
                }
            }
            else
            {
                if($result->attacker_outcome != "win")
                {
                    $wonBattles[$battlesWon]['year'] = $result->year;
                    $wonBattles[$battlesWon]['defeated'] = $result->defender_king;
                    $wonBattles[$battlesWon]['type'] = $result->battle_type;
                    $wonBattles[$battlesWon]['location'] = $result->location;
                    $battlesWon++;
                }
                else
                {
                    $lostBattles[$battlesLost]['year'] = $result->year;
                    $lostBattles[$battlesLost]['defeated'] = $result->attacker_king;
                    $lostBattles[$battlesLost]['type'] = $result->battle_type;
                    $lostBattles[$battlesLost]['location'] = $result->location;
                    $battlesLost++;
                }

            }

            $numberWars++;

        }
        return $detailsArray = array(
            'total_battles' => $numberWars,
            'won' =>$battlesWon,
            'lost'=>$battlesLost,
            'wonDetails'=>$wonBattles,
            'lostDetails'=>$lostBattles
            );
    }
    //Get current rating of a king
    private function getRatings($nameKing)
    {
        if(isset($this->kingArray[$nameKing]))
            return $this->kingArray[$nameKing];
        else
            return $this->n;
    }
    
}

<?php 

namespace Game\Board\MainCards;

use Game\Board\Deck;
use Game\Board\MainCards\Interfaces\PlayerInterface;

class MainCard implements PlayerInterface{ 
    private int $HP=40;
    private int $DEF=0;
    private Deck $deck;
    private $type="";

    
    public function SetDeck(Deck $deck){
        $this->deck=$deck;
    }
    public function GetPassive(): int{
        return 1;
    }
    public function DisplayCards(int $Number){
        $costam= $this->deck;
        $costam->PushDeck($Number);
    }
    public function GetCards(int $Number){
        $costam= $this->deck;
        $costam->PushCardToHand($Number);
    }
    public function GetDeck(){
       return $this->deck->PushDeck(5);
    }

    public function GetHp(){
        return $this->HP;
    }
    public function  ChangeHP(int $HP){
         $this->HP=$this->HP-$HP;
    }
    
    public function GetDEF(){
        return $this->DEF;
    }
    public function ChangeDEF(int $def){
        $this->DEF=$this->DEF+$def;
    }
    public function GetPlayerType(): string{
        return $this->type;
    }
   

}


?>
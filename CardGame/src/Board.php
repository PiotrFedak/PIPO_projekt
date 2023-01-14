<?php
namespace Game\Board;

use Game\Board\Log;
use Game\Board\MainCards\MainCard;
use Game\Board\MainCards\Interfaces\PlayerInterface;
use WinnerWasCalled;

    class Board {
        protected MainCard $Player;
        protected MainCard $Enemy;
        protected $Hand=[];
        protected $Mana=1;
        protected $TurnCounter=0;
        protected $winner;


        public function __construct(MainCard $player,MainCard $enemy) {
            $this->Player = $player;
            $this->Enemy = $enemy;
        }

        public function GetWinner(){
            return $this->winner;
        }

        
        public function Set_up_Game(){
            Log::info();
            Log::info();
            $this->TurnCounter++;
            Log::info("Trwa Tura:  $this->TurnCounter") ;
            
            Log::info("Mana wynosi:  $this->Mana") ;

            $this->Player->DisplayCards(5);

            
        }

        public function PlayTurn(){

            Log::info();
            Log::info();
            $this->TurnCounter++;
            Log::info("Trwa Tura:  $this->TurnCounter") ;
            
            Log::info("Mana wynosi:  $this->Mana") ;
          
            $i=0;
            if($this->Mana <10){
                $this->Mana++;
            };
            $enemy=$this->Enemy;
            $player=$this->Player;
            if(($player->GetPlayerType()=="Water" AND $player->GetPassive()==1) OR ($enemy->GetPlayerType()=="Water" AND $enemy->GetPassive()==1) ){
                $this->Player->ChangeHP(-2);
                log::info("Wyleczono maga wody o 2 punkty zdrowia");
                
            }
         
            do{ 
                //Log::info("Którą chcesz zagrać kartę: ");
                //$chocie_of_Player=readline();
                $attackE=2;
                $attackP=4;

                if($enemy->GetPassive()==1){
                    $attackE=$attackE*2;
                    log::info("Trafenie Krtyczne");
                     ;
                }
                $this->Player->ChangeDEF(3);
                $this->Enemy->ChangeDEF(1);
                if($this->Enemy->GetDEF()>0){
                    $dmgP=$attackP-$this->Enemy->GetDEF();
                    if($dmgP<=0){
                        $this->Enemy->ChangeDEF(-($attackP));
                        $dmgP=0;
                    }
                    if($dmgP>0){
                        $this->Enemy->ChangeDEF(-($attackP-$dmgP));
                    }
                }
                if($this->Player->GetDEF()>0){
                    $dmgE=$attackE-$this->Player->GetDEF();
                    if($dmgE<=0){
                        $this->Player->ChangeDEF(-($attackE));
                        $dmgE=0;
                    }
                    if($dmgE>0){
                        $this->Player->ChangeDEF(-($attackE-$dmgE));
                    }
                }
                $this->Enemy->ChangeHP($dmgP);
                $this->Player->ChangeHP($dmgE);
                $i++;
            }while($i!=1);
            $eHP=$this->Enemy->GetHp();
            $pHP=$this->Player->GetHp();
            Log::info("Twoje życie wynosi:  $pHP , A twój DEF: ".$this->Player->GetDEF()) ;
            
            Log::info("Życie twojego przeciwnika wynosi:  $eHP, A jego DEF: ".$this->Enemy->GetDEF()) ;
           
            
            
            if($eHP<=0 || $pHP<=0){
                if($eHP>$pHP){
                $this->winner = "Przeciwnik";
				throw new WinnerWasCalled();
                }
                if($pHP>$eHP){
                    $this->winner = "Gracz";
                    throw new WinnerWasCalled();
                    }
            };
        }

    }
?>
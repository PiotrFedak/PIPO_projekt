<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="css/battlefield.css" type="text/css">
    <title>Fight</title>
</head>


<body>
    <div class="fight">
        <h1>Fight</h1>
    </div>

    <?php
    
    class NPC {
        private $HP=15;

    }

    class Deck {
        protected $ListOfCard;
        protected $Card;

        public function __construct($Card) {
            $this->Card = $Card;
        }

        public function shuffleCards() {
            shuffle($this->Card);
        }

        public function ReadylistCards() {
            foreach($this->Card as $Card) {
                echo $Card . '<br />';
            }  
        }
    }
    ?>

</body>


</html>
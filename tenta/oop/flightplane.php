<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Flightplane</title>
</head>

<body>

	<?php 
error_reporting(-1);


	abstract class flightplane{
		
           
		protected $Speed;
                protected $Rang;
                protected $Playload;
                public $Destnation;
		

                
    public function __construct( $speed=0, $rang=0, $playload=false, $destnation="" ) {

        $this->Speed = $speed;
        $this->Rang = $rang;
        $this->Playload = $playload;
        $this->Destnation = $destnation;
      

            }


                /* Methods */
                
/* Class Level Methods (Static Method)*/
    static public function stat() {

/* $this-> används enbart för instans variabler eller metoder, 
för ej användas för att komma åt statiska klass metoder eller variabler,
för att komma åt konstanter eller statiska egenskaper eller 
statiska metoder använde man sig av self:: om du redan befinner
dig inom klassen som här */
        echo self::INFO;
        echo self::$stat;
                    
                }

/* Standard Witdraw metod*/
    public function WithDraw( $amount ) {

//Transaktionsdatumet är lika med dagensdatum
    $transDate = new DateTime();
/* If account not locked */
    if ( $this->Locked == false ) {

/* 
* titta först vad saldot är lika med, sen ta bort det vi sätter
*  in i pararmetern $amount.
*/
    $this->Balance -= $amount;
				
/*
   * array push är en inbyggd metod, vi sätter vår variabel $Audit som är av,
   * som är av typen array i en sub array, vi får typ en key->value par,
   * vi skriver ut ett om uttaget godändes eller ej, summan på uttaget, saldot
   * och transaktionsdatumet, vi formaterar datumet och tiden med format(c)
*/ 
                               
	array_push( $this->Audit, array( "WITHDRAW ACCEPTED", $amount, $this->Balance, $transDate->format( 'c' ) ) );
	}
	else {
/*
 * annars så visar vi ett error meddelande, samt att saldot inte påverkas och
 * datumet då transaktinen nekades. 
 */
		array_push( $this->Audit, array( "WITHDRAW DENIED!!!", $amount, $this->Balance, $transDate->format( 'c' ) ) );
	}

	}
		
/* Deposit */
	public function Deposit( $amount ) {

		$transDate = new DateTime();
		/* If account not locked */
		if ( $this->Locked == false ) {

/* vi tar suuman från parametern $amount och lägger till på vår saldo*/
			$this->Balance += $amount;

			array_push( $this->Audit, array( "DEPOSIT ACCEPTED", $amount, $this->Balance, $transDate->format( 'c' ) ) );
		} else {

			array_push( $this->Audit, array( "DEPOSIT DENIED!!!", $amount, $this->Balance, $transDate->format( 'c' ) ) );
		}

	}
		
/* Locked account */
	public function Lock() {

		$this->Locked = true;
/* 
 * vi skapar en variabel som sparar datumet då kontot låstes och lägger till
 * den i vår transaktions array
*/
		$lockedDate = new DateTime();

		array_push( $this->Audit, array( "Account Locked!!!", $lockedDate->format( 'c' ) ) );
	}

	/* Unlock account */
	public function unlock() {

		$this->Locked = false;
/* 
 * vi skapar en variabel som sparar datumet då kontot låstes upp och lägger till
 * den i vår transaktions array
*/
		$unlockedDate = new DateTime();

		array_push( $this->Audit, array( "Account unlocked :)", $unlockedDate->format( 'c' ) ) );
	}

	}
	
	?>

</body>

</html>


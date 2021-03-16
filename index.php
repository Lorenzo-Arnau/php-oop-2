<?php
class Prodotto {
   protected $name;
   protected $cost;
   protected $disponibility;
   protected $prime;
   protected $shippingTime=5;//days
   public function __construct($name, $cost,$disponibility,$prime)
   {
      $this->name = $name;
      $this->cost = $cost;
      $this->disponibility = $disponibility;
      $this->prime = $prime;
   }
   public function getDisponibility(){
       return $this->disponibility;
   }
   public function setDisponibilità($disponibility){
       $this->disponibility=$disponibility;
   }
   public function getPrime(){
    return $this->prime;
   }
    public function setShipping($shippingTime){
        $this->shippingTime=$shippingTime;
    }
   
}
class Tech extends Prodotto{
    protected $screen;
    protected $memory;
    protected $processor;
    protected $material;
    
    public function setTech($screen,$memory,$processor,$material){
        $this->screen = $screen;
        $this->memory = $memory;
        $this->processor = $processor;
        $this->material = $material;
    }
}

class Toys extends Prodotto{
    protected $material;
    protected $functions;
    protected $ageRaccomanded;

    public function setToys($material,$functions,$ageRaccomanded){
        $this->material = $material;
        $this->functions = $functions;
        $this->$ageRaccomanded = $ageRaccomanded;
    }
}

class Books extends Prodotto{
    protected $author;
    protected $title;
    protected $edition;

    public function setTech($author,$title,$edition){
        $this->author = $author;
        $this->title = $title;
        $this->edition = $edition;
    }
}

class Cliente {
    protected $name;
    protected $surname;
    protected $paymentMethods=[];
    protected $registrationDate;
    protected $prime;
    protected $cart=[];
    public function __construct($name, $surname,$registrationDate){
       $this->name = $name;
       $this->surname = $surname;
       $this->registrationDate = $registrationDate;
    }
    public function getPaymentMethod(){
        return $this->paymentMethods;
    }
    public function addPaymentMethod($newCard){
        $this->paymentMethods[]=$newCard;
    }
    public function addtoCart(Prodotto $prodotto,Cliente $cliente){
        if ($prodotto->getPrime() == true && $cliente->prime == true) {
            $prodotto->setShipping(1);
        }else{
            echo '</br>no prime';
        }
        $this->cart[] = $prodotto;
    }
    public function setPrime(){
        $this->prime=true;
    }
    public function getPrime(){
        return $this->prime;
    }
 }
 class CreditCard {
     private $number;
     private $expire;
     private $cvv;
     private $bank;

     public function __construct($number, $expire,$cvv,$bank){
        if ($expire < 2021) {
            throw new Exception("Card Expired", 1); 
           }
        $this->number = $number;
        $this->expire = $expire;
        $this->cvv = $cvv;
        $this->bank = $bank;
     }

     public function getCardNumber(){
        return $this->number;
    }
    public function getExpiredDate(){
        return $this->expire;
    }
    public function getCvv(){
        return $this->cvv;
    }
    public function getBank(){
        return $this->bank;
    }

 }

 echo 'abbiamo un nuovo cliente allo shop,questi sono i suoi dati, non ha metodi di pagamento e il carrello vuoto </br>';
 echo '-------------------------------------------------------------------------------------------------------------';
 $client=new Cliente('Pablo','EscoAlBar','20/11/22');
 echo '<pre>' . var_export($client, true) . '</pre>';
 echo 'Il cliente per prima cosa inserisce un nuovo metodo di pagamento ,effettuiamo un controllo sulla scadenza della carta </br>';
 echo '-------------------------------------------------------------------------------------------------------------';
 try {
     $c = new CreditCard('123456123456',2022,'477','Unicredit');
 } catch (\Throwable $th) {
    echo '</br>Carta NON INSERITA,</br>inserire una carta valida!!!';
 }
 $client->addPaymentMethod($c);
 echo '<pre>' . var_export($client, true) . '</pre>';
 echo 'Il cliente sta valutando di comprare un nuovo Laptop e il suo sguardo ricade su questo  </br>';
 echo '-------------------------------------------------------------------------------------------------------------';
 $laptop=new Tech('Lenovo','115£', 40,true);
 $laptop->setTech('hd','8gb','i7','alluminium');
 echo '<pre>' . var_export($laptop, true) . '</pre>';
 echo 'Il cliente si iscrive a prime per velocizzare la spedizione </br>';
 echo '-------------------------------------------------------------------------------------------------------------';
 $client->setPrime();
 echo '<pre>' . var_export($client, true) . '</pre>';
 echo 'Il cliente lo inserisce nel carrello e in seguito lo acquista il programma fa inoltre una verifica su prodotto e cliente per gestire spedizione prime</br>';
 echo '-------------------------------------------------------------------------------------------------------------';
 $client->addtoCart($laptop,$client);
 echo '<pre>' . var_export($client, true) . '</pre>';
?>
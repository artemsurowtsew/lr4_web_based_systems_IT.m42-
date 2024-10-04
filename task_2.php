<?php 

trait my_first_trait //train creating

{ 

public function traitFunction() 

{ 

echo "Hello world"; 

}

 }
 


class helloWorld 

{ 

use my_first_trait;  //train using

} 

$objTest = new HelloWorld(); 

$objTest->traitFunction(); 

?> 

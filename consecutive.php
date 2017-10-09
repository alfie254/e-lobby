<?php
	

$jina = "aa22e";

function hesabu($jina, $character) {
   
   $count = 0;	//initialize the counter to 0
   
   $num = strlen($jina); //loop through the word
    for ($i = 0; $i < $num; $i=$i+1) {
       
       if ($jina[i] == $character)	//if the character in the word is equal to  the character passed in as a parameter increment count
        {
           $count++;
        }
  }

 
  echo("The letter " + $character + " appears " + $count + " times in the word ");
}

hesabu("$jina", 'a');


?>
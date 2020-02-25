<?php 
// PHP Program to find the smallest 
// positive missing number 

function solution($A){//Our original array 

	$m = max($A); //Storing maximum value 
	if ($m < 1) 
	{		 
		// In case all values in our array are negative 
		return 1; 
	} 
	if (sizeof($A) == 1) 
	{ 
		//If it contains only one element 
		if ($A[0] == 1) 
			return 2 ; 
		else
			return 1 ; 
	}		 
	$l = array_fill(0, $m, NULL); 
	for($i = 0; $i < sizeof($A); $i++) 
	{		 
		if( $A[$i] > 0) 
		{ 
			if ($l[$A[$i] - 1] != 1) 
			{ 
				
				//Changing the value status at the index of our list 
				$l[$A[$i] - 1] = 1; 
			} 
		} 
	} 
	for ($i = 0;$i < sizeof($l); $i++) 
	{ 
		
		//Encountering first 0, i.e, the element with least value 
		if ($l[$i] == 0) 
			return $i+1; 
	} 
			//In case all values are filled between 1 and m 
	return $i+2;	 
} 

$A = array(1, 3, 6, 4, 1, 2); 
echo solution($A); 
return 0; 
?> 

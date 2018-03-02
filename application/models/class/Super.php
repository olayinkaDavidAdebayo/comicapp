<?php

	abstract class Super
	{
       	public function extract_year_from_string($string = false)
       	{
          //check if the argument is false
       		if(!$string){
       			return false;
       		}
          //create empty array to hold array of matched value
       		$year_array = array();
          //match all parttern similar or equal to year or year range in bracket
	        preg_match_all("/\(([0-9]{4})\)|\(([0-9]{4})\s-\s([0-9]{4})\)/", $string, $year_array);
          //return the first value using index 0
	        return $year_array[0];
       	}
    }

?>
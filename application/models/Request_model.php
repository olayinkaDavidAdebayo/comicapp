<?php

error_reporting(0);

	class Request_model extends CI_Model {

	private $curl = NULL;

    public function __construct()
    {
        //set accessors
		require_once('class/App.php');
		$this->curl = new App();
    }

    public function poolCharacters($characterid = false)
    {
    	//url to pull all characters if characterid is false
    	$url = 'http://gateway.marvel.com/v1/public/characters';
    	if($characterid){
            //url to pool a character data 
    		$url = 'http://gateway.marvel.com/v1/public/characters/'.$characterid;    		
    	}
        //open stream 
    	return $this->curl->cURLRequest($url);
    }

    public function poolDataByType($characterid = false, $header = false)
    {
        //character type details
    	$url = 'http://gateway.marvel.com/v1/public/characters/'.$characterid.'/'.$header; 
        //open stream
    	return $this->curl->cURLRequest($url);
    }

    public function fetch_result_from_array($resultsData)
    {
        //check if argument is array
        if(is_array($resultsData))
        {
            //fetch only the results from resultsData
            $results = $resultsData['data']['results'];
            //empty array to hold new results
            $newResults = array();
            
            //loop through the result to get the date published  
            foreach ($results as $key => $value) {
                        
                $title_string = $value['title'];
                //date extractor
                $year_array = $this->curl->extract_year_from_string($title_string);
                //assign date to value array  
                $value['date_first_published'] = $year_array[0];
                //assign value to newResults array
                $newResults[] = $value;

            }

            return $newResults;
        }

        return false;
    }


}

?>
<?php

require('Super.php');

	class App extends Super
	{
        private $url = NULL;
        private $hash = NULL;
        private $apiKey = 'caca31d6d44e58ccc49e644c16b2f979';
        private $header = NULL;
        private $limit = 40;

        public function __construct()
        {
            //entry point for this class. gets called automatically 
            $this->setRequestHash(); 
        }

        protected function setRequestHash()
        { 
            $this->hash = md5(time()."2729641dca22d8540eedbc23aca1b9af98839b98caca31d6d44e58ccc49e644c16b2f979");
        }
        
        public function cURLRequest($url)
        {
            //set the url
            $this->url = $url;
            //make cURL Request to server
            $curl = curl_init();  

                    curl_setopt($curl,CURLOPT_URL,$this->url.'?apikey=' 
                        . $this->apiKey . "&hash=".$this->hash 
                        . "&ts=".time() . "&limit=" . $this->limit); 

                    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);  
                    curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
            //execute request  
            return curl_exec($curl);  
            
        }

        
    }

?>
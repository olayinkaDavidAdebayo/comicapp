<?php

//error_reporting(0);

class Pages extends CI_Controller {
	
		
	    public function __construct()
        {
            parent::__construct();

            //load session for global access
            $this->load->library('session');
            //load the only model used in this app, if more than one load all here
            $this->load->model('request_model');
            //load helper function
            $this->load->helper('url_helper');
            //set headers :: I set headers here because all data has same headers
            $headers = array("Character", "Data Type", "Name", "Description", "Date First Published");
            $this->request_model->setHeaders($headers);
				                			
        }

        public function view($pages = 'index')
        {
        	if($pages ==""){
        		//this will be be used to prevent invalid url
				$this->show404();
			}
			//store base url into global data array
			$data["url"] = base_url();
			//load page header from include folder
			$this->load->view('includes/html_header', $data);			
			//this check and load views attached to the requested url if valid
			switch(strtolower($pages))
			{
                case "results": $this->results($data); break;
				default: $this->home($data);
			}			
			//load page footer from include folder
			$this->load->view('includes/html_footer', $data);
			
        }

        public function home($data)
        {
        	//fetch data from online via curl :: model
        	$response = $this->request_model->poolCharacters(); 
        	//decode response json data to an array data type      	
        	$response = json_decode($response, true);
        	//remove on the result and assign to global data for the views 
        	$data['response_data'] = $response['data']['results'];

        	//call the view
        	$this->load->view('pages/search', $data);
        }

        public function results($data)
        {
            //assign base url to view
            $data['url'] = base_url();
        	//check if key header and character exists in global variable post
        	if(array_key_exists("header", $_POST) && array_key_exists("character", $_POST)){
	        	//Post is used in order to hide the data from showing in url
	        	$header = $_POST['header'];
                //decode the json value 
	        	$character = json_decode($_POST['character'], true);
	        	//remove possible surrounding space
	        	$character_id = trim($character['character_id']);
	        	//make request
	        	$json_results = $this->request_model->poolDataByType($character_id, $header);
                //decode response json data
                $array_results = json_decode($json_results, true);
                
                //pass header to the view
	        	$data['header'] = $header;
                //table headers
                $data['table_headers'] = $this->request_model->getHeaders();
                //pass character name to the view
	        	$data['character_name'] = $character['character_name'];
                //pass data to the view
	        	$data['results'] = $this->request_model->fetch_result_from_array( $array_results);

                //store array into session
                $this->session->set_userdata("resultdata", $data['results']);

	        	//call the view
        	   $this->load->view('pages/results', $data);
        	}else{
        		die;
        	}

        	

        }


        public function show404()
        {
        	//call the view
        	$this->load->view('pages/show_404', $data);
        }

		
}

?>
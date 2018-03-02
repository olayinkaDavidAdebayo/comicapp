<?php

class Download extends CI_Controller {
	
		
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
            $headers = array("Character", "Data Type", "Name", "Description", "Published");
            $this->request_model->setHeaders($headers);
				                			
        }


        public function csv($character_header = NULL, $character = NULL) {

            //get data from session
            $results_data = $this->session->userdata("resultdata");
            //get table headers
            $headers = $this->request_model->getHeaders();
            //get csv data
            $csv_results = $this->request_model->generateCSVData($results_data, $headers, $character_header, $character);
            
            $file_path = 'assets/csv/'.$character_header.'_'.$character.'_data.csv';

            $fp = fopen($file_path, 'w');

            foreach ($csv_results as $rows){
                fputcsv($fp, $rows);
            }

            fclose($fp);

            /*  ##################### fallback #######################  */
            $data['url'] = base_url();
            $data['header'] = $character_header;
            $data['character_name'] = $character;
            //load page header from include folder
            $this->load->view('includes/html_header', $data);
            //call the view
            $this->load->view('pages/download', $data);
            //load page footer from include folder
            $this->load->view('includes/html_footer', $data);

            /* ######################## end ######################## */


            // load download helder
            $this->load->helper('download');
            // read file contents
            $data = file_get_contents($file_path);
            force_download($file_path, $data);

        }

}

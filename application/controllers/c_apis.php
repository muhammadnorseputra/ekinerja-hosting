<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';


class C_apis extends REST_Controller {

    function __construct() {

        parent::__construct();
    }

    public function index()
    {
        echo "oke";
    }
    
    public function token_get()
    {
        $tokenData = array();
        $tokenData['id'] = 1; //TODO: Replace with data for token
        $output['token'] = AUTHORIZATION::generateToken($tokenData);
        $this->set_response($output, REST_Controller::HTTP_OK);
    }
    
}

/* End of file admin.php */
/* Location: ./application/controllers/C_api.php */
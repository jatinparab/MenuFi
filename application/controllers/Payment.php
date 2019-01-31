<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
class Payment extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
		$this->load->database();
		if(!isset($_SESSION['id']) || !isset($_SESSION['isLoggedIn']))
		{
			redirect('login', 'refresh');
		}
    }

	public function index()
	{
		$this->load->view('Payment_gateway');
	}
}

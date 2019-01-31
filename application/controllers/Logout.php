<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
	 function __construct()
    {
      parent::__construct();
			if(!isset($_SESSION['id']) || !isset($_SESSION['isLoggedIn']))
			{
				redirect('login', 'refresh');
			}
    }

	public function index()
	{
    if(isset($_REQUEST['logout']))
    {
      require_once APPPATH."config/Googleconfig.php";
//			if(isset)
      $logout = $gclient->revokeAccess();
			$this->session->set_userdata('isLoggedIn', False);
    }
  }
}
 ?>

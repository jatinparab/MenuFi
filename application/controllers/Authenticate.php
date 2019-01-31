<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Authenticate extends CI_Controller {
	 function __construct()
    {
        parent::__construct();
		    $this->load->database();
    }
	public function index()
	{
     $this->load->model('Auth_user_model');
     $is_Auth = $this->Auth_user_model->Auth_user();
     $otp = $this->Auth_user_model->Otp_user();
     if($otp == 1 && $is_Auth == 1)
     {
       $this->session->set_userdata('isLoggedIn', True);
       $res=$this->db->query("select * from logo");
            if($res->num_rows()>0){
                $res = $res->result_array();
                $data['logo'] = $res[0]['img_name'];
            }
       $bg = $this->db->query("select * from background_image");
                        if($bg->num_rows()>0){
                            $bg = $bg->result_array();
                            $data['bg'] = $bg[0]['img_name'];
                        }
        $font = $this->db->query("select * from fonts where is_active=1");
            if($font->num_rows()>0){
                $font = $font->result_array();
                $data['fontName'] = $font[0]['name'];
                $data['fontSrc'] = $font[0]['src'];
            }
       $this->load->view('Table_select',$data);
//              $this->load->view('login');

     }
     else if($otp == 0){
        $this->session->set_userdata('isLoggedIn', True);
        $res=$this->db->query("select * from logo");
             if($res->num_rows()>0){
                 $res = $res->result_array();
                 $data['logo'] = $res[0]['img_name'];
             }
        $bg = $this->db->query("select * from background_image");
                         if($bg->num_rows()>0){
                             $bg = $bg->result_array();
                             $data['bg'] = $bg[0]['img_name'];
                         }
         $font = $this->db->query("select * from fonts where is_active=1");
             if($font->num_rows()>0){
                 $font = $font->result_array();
                 $data['fontName'] = $font[0]['name'];
                 $data['fontSrc'] = $font[0]['src'];
             }
        $data['mnumber'] = $_POST['mnumber'];
        $this->load->view('otp',$data);
     }
     else {

         $res=$this->db->query("select * from logo");
            if($res->num_rows()>0){
                $res = $res->result_array();
                $data['logo'] = $res[0]['img_name'];
            }
       $bg = $this->db->query("select * from background_image");
                        if($bg->num_rows()>0){
                            $bg = $bg->result_array();
                            $data['bg'] = $bg[0]['img_name'];
                        }
                        
        $font = $this->db->query("select * from fonts where is_active=1");
            if($font->num_rows()>0){
                $font = $font->result_array();
                $data['fontName'] = $font[0]['name'];
                $data['fontSrc'] = $font[0]['src'];
            }
         
       $this->load->view('loginby_detail',$data);

     }

	}

}

?>
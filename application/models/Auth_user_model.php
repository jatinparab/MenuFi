<?php



  class Auth_user_model Extends CI_Model

  {
      function __construct() {
//        $this->tableName = 'users';
//        $this->primaryKey = 'id';
//        $this->load->database();
    }

    public function Auth_user()
    {
      $this->db->select('*');
      $this->db->from('customers');
      $this->db->where('mobile', $_POST['mnumber']);
      $query = $this->db->get();
      $rows = $query->num_rows();
      if($rows > 0)
      {
        $this->db->set('views', 'views+1', FALSE);
        $this->db->where('mobile', $_POST['mnumber']);
        $success = $this->db->update('customers');

        $r = $query->result_array();
        $mobile_cust_id = $r[0]['customer_id'];
        if(!empty($mobile_cust_id)){
            $this->session->set_userdata('mCustId',$mobile_cust_id);
        }
      }
      else {
        $customer_array = array('mobile' => $_POST['mnumber'],'views' => 1,'otp' => 0);

        $success = $this->db->insert('customers', $customer_array);
        if($success){
           $this->session->set_userdata('mCustId',$this->db->insert_id());
        }
      }
      return $success;
    }
    public function Otp_user(){
        $this->db->select('*');
        $this->db->from('customers');
        $this->db->where('mobile', $_POST['mnumber']);
        $this->db->where('otp','1');
        $query = $this->db->get();
        if($query->num_rows())
        {
          $rows = $query->result_array();
          if($rows > 0)
          {
             return 1;
          }
          else{
             return 0;
          }
        }
        else
        {
            return 0;
        }
    } 
    public function Set_otp()
    {
      $this->db->select('*');
      $this->db->from('customers');
      $this->db->where('mobile', $_POST['mnumber']);
      $query = $this->db->get();
      $rows = $query->result_array();
      if($rows > 0)
      {
        $this->db->set('otp', '1', FALSE);
        $this->db->where('mobile', $_POST['mnumber']);
        $success = $this->db->update('customers');
        if($success){
            return 1;
        }
      }
    }

//public function storeGoogleData($d){
//    $data['email']=$d['email'];
//
//     $data['gender']=$d['gender'];
//
//     $data['picture']=$d['picture'];
//
//     $data['first_name']=$d['first_name'];
//
//     $data['last_name']=$d['last_name'];
//     $data['gid']=$d['id'];
//     $s = $this->db->insert('users',$data);
//     if($s){
//     return $last_id = $this->db->insert_id();
//     
//     }
// else {
//     
// return 0;}
//}

public function checkUser($data = array()){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where(array('oauth_provider'=>$data['oauth_provider'],'oauth_uid'=>$data['oauth_uid']));
        $query = $this->db->get();
        $check = $query->num_rows();
        
        if($check > 0){
            $result = $query->row_array();
            $data['modified'] = date("Y-m-d H:i:s");
            $update = $this->db->update('users',$data,array('id'=>$result['id']));
            $userID = $result['id'];
        }else{
            $data['created'] = date("Y-m-d H:i:s");
            $data['modified']= date("Y-m-d H:i:s");
            $insert = $this->db->insert('users',$data);
            $q = $this->db->last_query();
            $userID = $this->db->insert_id();
        }

        return $userID?$userID:false;
    }

	}
?>


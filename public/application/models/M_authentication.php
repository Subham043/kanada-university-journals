<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_authentication extends CI_Model {

	    /***admin login
	    * @param : email/username , password
	    *
	    **/ 
      function can_login($email, $password)  
      {
          $query = $this->db->where('email', $email)->where('verified', 1)->get('user');
          if(empty($query->row())){
            return false;
          }
          $result = $query->row_array();
          if ($this->bcrypt->check_password($password, $result['password'])==true) {
            return $result; 
          } else {
            return false;
          }
      }
      public function checkEmail($data){
        $query = $this->db->where('email', $data['email'])->get('user');
        if($query->num_rows() > 0){
            $newdata = array( 
                'otp' => $data['otp'], 
                'passwordChange' => 1, 
            );
            $this->db->where('email', $data['email']);
            $this->db->update('user', $newdata);
            $query = $this->db->where('email', $data['email'])->get('user');
            return $query->row()->id;
        }else{
            return false;
        }
    }

    public function changePassword($data,$id){
      $query = $this->db->where('id', $id)->where('otp', $data['otp'])->get('user');
      if($query->num_rows() > 0){
          $data['otp'] = random_int(100000, 999999);
          $data['passwordChange'] = 0;
          $this->db->where('id', $id);
          $this->db->update('user', $data);
          return true;
      }else{
          return false;
      }
  }

  public function checkChangePasswordActive($id){
    $query = $this->db->where('id', $id)->where('passwordChange', 1)->get('user');
    if($query->num_rows() > 0){
        return true;
    }else{
        return false;
    }
  }

  public function getDetails($value='')
  {
    $query=$this->db->where('verified',1)->get('user');
    $data['user'] = $query->num_rows();
    $query=$this->db->get('contact');
    $data['contact'] = $query->num_rows();
    $query=$this->db->get('literature');
    $data['literature'] = $query->num_rows();
    $query=$this->db->get('subscribe');
    $data['subscription'] = $query->num_rows();
    $query=$this->db->get('volunteer');
    $data['volunteer'] = $query->num_rows();
    $query=$this->db->select_sum('amount')->where('trust','Sai Mayee Trust')->where('payment_status',1)->get('donation');
    $data['mayee'] = $query->row();
    $query=$this->db->select_sum('amount')->where('trust','Sri Sai Meru Mathi Trust')->where('payment_status',1)->get('donation');
    $data['meru'] = $query->row();
    $query=$this->db->where('type','manava-seva')->get('events');
    $data['manava'] = $query->num_rows();
    $query=$this->db->where('type','madhava-seva')->get('events');
    $data['madhava'] = $query->num_rows();
    return $data;
  }
}

/* End of file M_authentication.php */
/* Location: ./application/models/M_authentication.php */
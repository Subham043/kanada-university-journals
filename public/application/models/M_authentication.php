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
}

/* End of file M_authentication.php */
/* Location: ./application/models/M_authentication.php */
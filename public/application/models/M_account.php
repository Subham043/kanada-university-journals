<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_account extends CI_Model {

	/**
	*Change pasword -> Update New password
	* @url : change-password
	*/
	public function changepass($admin,$npass,$cpass)
	{

		$this->db->where('id', $admin);
		$query = $this->db->get('user');
		if($query->num_rows() > 0)
		{
			$this->db->where('id', $admin);
			$this->db->update('user',  array('password' =>$npass));
			if ($this->db->affected_rows() > 0)
			{
				return true;
			}else{
				return false;
			}
		} else {
			return false;
		}
	}

	/**
	*Change pasword -> Update New password
	* @url : change-password
	*/
    public function account($value='')
    {
      $this->db->where('id', $value);
      $query =  $this->db->get('user');
	  return $query->row();
    }

             /**
		*account settings -> Update account
        * @url : update-profile
        *@param : admin uniq id, name phone, date
		*/
        public function acupdte($ac_uniq,$name,$email,$phone)
        {
          $this->db->where('id', $ac_uniq);
          $this->db->update('user',  array('name' =>$name ,'phone'=>$phone,'email'=>$email ));
          if ($this->db->affected_rows() > 0) 
          {
           return true;
          }else{
            return false;
          }
        }

	

}

/* End of file M_account.php */
/* Location: ./application/models/M_account.php */
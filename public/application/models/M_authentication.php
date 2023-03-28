<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_authentication extends CI_Model {

	    /***admin login
	    * @param : email/username , password
	    *
	    **/ 
      function can_login($username, $password)  
      {
        
          $this->db->where('email', $username);  
          $result = $this->getUsers($password);
          if (!empty($result)) {
          return $result;
          } 
          else {
              return null;
          }  
      }


      // check password
      function getUsers($password) 
      {
          $query = $this->db->get('admin');
          if ($query->num_rows() > 0) {
              $result = $query->row_array();
              
             
           
             
              

              if ($this->bcrypt->check_password($password, $result['password'])) {
              
                  return $result;
              } 
              else {
                  return array();
              }
          } 
          else{
              return array();
          }
      }



        /**
		* forget pasword mail check exist or not
		* @url : forgot/email-check
		* @param : email and forgot-id
		*/ 
		public function check_mail($email,$forgotid)
		{
        $this->db->where('email', $email);
        $query = $this->db->get('admin');

        if($query->num_rows() > 0)  
           {
            $this->db->where('email', $email);
            $this->db->update('admin',array('forgot_link' =>$forgotid));
            return true;
           }  
           else  
           {
              return false;
           }
        }

        /**
		* forget pasword -> update new password
		* @url : update-password
		* @param : email and forgot-id , new password
		*/ 
        public function addforgtpass($email,$newpass,$forgotid)
		{
            $this->db->where('email', $email);
			$this->db->where('forgot_link', $forgotid);
			$query = $this->db->get('admin');
			if($query->num_rows() > 0)
			{
			    $this->db->where('email', $email);
                $this->db->where('forgot_link', $forgotid);
                $this->db->update('admin',  array(' password ' =>$newpass,'forgot_link'=>random_string('alnum',16)));
                if ($this->db->affected_rows() > 0) 
                {
                	return true;
                }else{
                	return false;
                }
			}else
			{
             return false;  
			}
			
        }

          //get enquiries
  public function getforma1($value='')
  {
    return $this->db->order_by('id', 'desc')->get('forma1')->result();
  }

  public function projectcount($value='')
  {
    $result =  $this->db->get('projectdetail')->result();
    return count($result);
  }

  public function featureCount($value='')
  {
    $this->db->where('featured_project', '1');
    $result =  $this->db->get('projectdetail')->result();
    return count($result);
  }

  public function enquiryCount($value='')
  {
    $result =  $this->db->get('enquiry')->result();
    return count($result);
  }

  public function adminUser($value='')
  {
    $result =  $this->db->where('is_active','1')->get('admin')->result();
    return count($result);
  }

  public function insertOtp($id,$otp)
  {
    return $this->db->where('id',$id)->update('admin',['otp'=>$otp]);
  }
public function checkOtp($id ,$otp)
{
  $ip = $this->input->ip_address();
  $query = $this->db->where('id',$id)->where('otp',$otp)->get('admin');
  if($query->num_rows()>0){
    $this->db->where('id',$id)->where('otp',$otp)->update('admin',['ip'=>$ip]);
     $result=  $query->row();
     $result->ps_id = $this->getPoliceStationId($result->id);
     
     return $result;
  }else{
    return false;
  }
}
	public function getPoliceStationId($id)
  {
    
    $output=array();
    
    $this->db->select('ps.id as police_station_id');
    $this->db->where('a.id',$id);
    $this->db->where('as.admin_id',$id);
    $this->db->from('admin a');
    $this->db->join('admin_subdivision as','a.id = as.admin_id','inner');
    $this->db->join('police_station ps','ps.sub_division_id = as.subdivision_id','inner');
    $query =  $this->db->get();

    if($query->num_rows()>0){
      foreach ($query->result() as $key => $value) {
        $output[] = $value->police_station_id;
    }
     return  $output;
    }else{
      return false;
    }
  }

  public function throttle_insert($insert='')
  {
      $insert['updated_at']=date('Y-m-d H:i:s');
      $this->db->where('ip', $insert['ip'])->where('created_at',$insert['created_at']);
      $result = $this->db->get('throttles')->row();
      if (!empty($result)) {
          $this->db->where('ip', $insert['ip'])->where('created_at',$insert['created_at']);
          $this->db->update('throttles',array('type' => '1'));
          if ($this->db->affected_rows() > 0) {
              return $result->type;
          }else{
              return false;
          }
      }else{
          $this->db->insert('throttles', $insert);
          if ($this->db->affected_rows() > 0) {
              return true;
          }else{
              return false;
          }
      }

  }

  public function throttle_update($ips='',$up='')
  { $insert['updated_at']=date('Y-m-d H:i:s');
      $today = date('Y-m-d');
      $this->db->where('ip', $ips)->where('created_at',$today);
      $this->db->update('throttles', array('type' => $up,'updated_at'=>$insert['updated_at']));
      if ($this->db->affected_rows() > 0) {
          return true;
      }else{
          return false;
      }
  }

  public function throttle_get($ips='',$current_time='')
  {
      $today = date('Y-m-d');
      $insert['updated_at']=date('Y-m-d H:i:s');
      $this->db->where('ip', $ips)->where('created_at',$today);
      $result = $this->db->get('throttles')->row();
      if (!empty($result)) {
          $date1  = date_create($current_time);  
          $date2  = date_create($result->updated_at);
          $diff   = date_diff($date1,$date2);
          $days   = $diff->format("%R%a");
          $min    = $diff->format('%i');
          $timeFirst  = strtotime( $insert['updated_at']);
          $timeSecond = strtotime($result->updated_at);
          $differenceInSeconds = $timeFirst-$timeSecond ;
          if($min <= 1 &&  $differenceInSeconds < 60){ 
              return $result->type;
          }else{
              $this->db->where('ip', $ips)->where('created_at',$today);
              $this->db->update('throttles',array('type' => '1','updated_at'=>$insert['updated_at']));
              return $result->type;
          }
      }else{
          return false;
      }
  }
  public function checkIp($id)
  {
    $query=$this->db->where('id',$id)->get('admin')->row();
    if(!empty($query)){
      return $query->ip;
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
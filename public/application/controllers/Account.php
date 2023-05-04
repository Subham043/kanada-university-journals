<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    private string $nonce;

	/*--construct--*/
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('admin_id') == '') {$this->session->set_flashdata('error', 'Oops you need to be logged in order to access the page!'); redirect('teacher'); }
    
        $this->load->model('m_account');
        $this->load->library('form_validation');

        $this->nonce = hash('sha256', bin2hex(random_bytes(10)));
        header("Content-Security-Policy: base-uri 'self';connect-src 'self';default-src 'self';form-action 'self';img-src 'self' data:;media-src 'self';object-src 'none';script-src 'self' 'nonce-".$this->nonce."';style-src 'unsafe-inline' 'self' fonts.googleapis.com;frame-src 'self';font-src 'self' data: fonts.gstatic.com;frame-ancestors 'self'");
        
    }
    /**
     * Admin login-> load view page
     * url : login
    **/
	public function profile()
	{
		$data['title'] = 'Profile - Kannada University';
        $data['nonce'] = $this->nonce;
        $this->session->set_flashdata('tab', 'profile');
        $data['admin'] = $this->m_account->account($this->session->userdata('admin_id'));
        $this->load->view('pages/auth/profile.php', $data);
		
	}


    /**
     *Change pasword -> Update New password
     * @url : update/change-password
     * @param : new password,confirm password,userid
     */
    public function password_update()
    {
        $data['title'] = 'Profile - Kannada University';
        $data['nonce'] = $this->nonce;

        $this->security->xss_clean($_POST);
        $this->form_validation->set_rules('crpassword', 'Current Password', 'callback_passwordcheck');
        $this->form_validation->set_rules('password', 'New Password', 'required|callback_is_password_strong');
        $this->form_validation->set_rules('cnpassword', 'Confirm Password', 'required|matches[password]');
        
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('tab', 'password');
            $data['admin'] = $this->m_account->account($this->session->userdata('admin_id'));
            $this->load->view('pages/auth/profile.php', $data);
        } else {
            $crpassword = $this->input->post('crpassword');
            $password =$this->bcrypt->hash_password($this->input->post('password')) ;
            $admin = $this->session->userdata('admin_id');
            if ($this->m_account->changepass($admin, $password, $crpassword)) {
                $this->session->set_flashdata('success', 'Password updated Successfully');
                $this->session->set_flashdata('tab', 'password');
                redirect('profile', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'unable to update your password, New password is matching with the current password!');
                $this->session->set_flashdata('tab', 'password');
                redirect('profile', 'refresh');
            }
        }
    }

    public function is_password_strong($password)
    {
       
       if (preg_match('#[0-9]#', $password) && preg_match('#[a-zA-Z]#', $password)) {
      
         return TRUE;
       }
       $this->form_validation->set_message('is_password_strong', 'Password should be alphnumeric characters');
       return FALSE;
    }

    public function passwordcheck($password)
    {
        $this->db->where('id', $this->session->userdata('admin_id'));
        $result = $this->db->get('user');
        if ($result->num_rows() > 0) {
            $psw = $result->row_array();
            if ($this->bcrypt->check_password($password, $psw['password'])) {
                
                return true;
            }else{
                $this->form_validation->set_message('passwordcheck', 'The {field} is not Valid');
                return false;
            }
        } else {
            $this->form_validation->set_message('passwordcheck', 'The {field} is not Valid');
            return false;
        }
    }

    /**
     *account settings -> Update account
     * @url : update-profile
     *@param : admin uniq id, name phone, date
     */
    public function profile_update()
    {
        $data['title'] = 'Profile - Kannada University';
        $data['nonce'] = $this->nonce;
        $this->security->xss_clean($_POST);
        $data['admin'] = $this->m_account->account($this->session->userdata('admin_id'));

        if($data['admin']->email==$this->input->post('email')){
            $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[10]|max_length[200]|regex_match[/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix]', array('regex_match' => 'Enter a valid %s'));
        }else{
            $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[10]|max_length[200]|is_unique[user.email]|regex_match[/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix]', array('is_unique'=>'This email is already in use','regex_match' => 'Enter a valid %s'));
        }
        
        if($data['admin']->phone==$this->input->post('phone')){
            $this->form_validation->set_rules('phone', 'Phone Number', 'trim|required|min_length[10]|max_length[10]|numeric');
        }else{
            $this->form_validation->set_rules('phone', 'Phone Number', 'trim|required|min_length[10]|max_length[10]|numeric|is_unique[user.phone]', array('is_unique'=>'This email is already in use'));
        }

        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[200]|regex_match[/^[a-zA-Z][a-zA-Z ]*$/]', array('regex_match' => 'The %s field can only contain letters and spaces')); 

        $admin = $this->session->userdata('admin_id');

        if($this->form_validation->run()){
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            if ($this->m_account->acupdte($admin, $name, $email, $phone)) {
                $this->session->set_flashdata('success', 'Profile updated Successfully');
                $this->session->set_flashdata('tab', 'profile');
                redirect('profile', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong please try again!');
                $this->session->set_flashdata('tab', 'profile');
                redirect('profile', 'refresh');
            }
        }else{
            $this->session->set_flashdata('tab', 'profile');
            $this->load->view('pages/auth/profile.php', $data);
        }
        
    }

    /**
     * logout
     * @url : logout
     *
    **/
    public function logout()
    {
        $session_data = array(
            'admin_id' => $this->session->userdata('admin_id'),
        );
        $this->session->unset_userdata($session_data);
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout', 'You are logged out Successfully');
        redirect('teacher');
    }


}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {

    private $nonce;

	/*--construct--*/
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_authentication');
        $this->load->library('form_validation');

        $this->nonce = hash('sha256', bin2hex(rand()));
        header("Content-Security-Policy: base-uri 'self';connect-src 'self';default-src 'self';form-action 'self';img-src 'self' data:;media-src 'self';object-src 'none';script-src 'self' 'nonce-".$this->nonce."';style-src 'unsafe-inline' 'self' fonts.googleapis.com;frame-src 'self';font-src 'self' data: fonts.gstatic.com;frame-ancestors 'self'");

        if ($this->session->userdata('admin_id') != '') {
            redirect('dashboard');
        }
    }

    /**
     * Admin login-> load view page
     * url : login
     * @param : email or username , password
     *
     **/
	public function index()
	{
        $data['title'] = 'Login - Kannada University';
        $data['nonce'] = $this->nonce;

        $this->form_validation->set_rules('email', 
        'Email',
        'trim|required|min_length[10]|max_length[200]|regex_match[/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix]', 
        array('regex_match' => 'Enter a valid %s')
        );
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run()) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $data['login'] = $this->m_authentication->can_login($email, $password);
            if (!empty($data['login'])) {
                if (!empty($data['login']['id'])) {
                    $id = $data['login']['id'];
                }
                if (!empty($data['login']['userType'])) {
                    $userType = $data['login']['userType'];
                }
                $session_data = array('admin_id' => $id, 'user_type' => $userType);
                $this->session->set_userdata($session_data);
                redirect('/');
               
            } else {
                $this->session->set_flashdata('error', 'Invalid Email or Password');
                redirect('login');
            }

        }else{
            $this->load->view('pages/auth/login', $data);
        }
	}
    
    /**
     * Admin forgot-password-> load view page
     * url : forgot-password
    **/
	public function forgot_password()
	{
		$data['title'] = 'Forgot Password - Kannada University';
        $data['nonce'] = $this->nonce;

        $this->form_validation->set_rules(
            'email', 
            'Email', 
            'trim|required|min_length[10]|max_length[200]|regex_match[/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix]', 
            array('regex_match' => 'Enter a valid %s'));
        if($this->form_validation->run()){
            $email 	= $this->input->post('email');
            $data = array(
                'email' 		=> $email,
                'otp' => random_int(100000, 999999),  
            );
            $data = html_escape($this->security->xss_clean($data));
            $application_id = $this->m_authentication->checkEmail($data);
            if($application_id!=false){
                $data['id'] = $this->encryption_url->safe_b64encode($application_id);
                $this->load->config('email');
                $this->load->library('email'); 
                $this->email->from('testing@5ines.com', 'HRUDAYASPANDANA'); 
                $this->email->to($data['email']);
                $this->email->subject('HRUDAYASPANDANA - Reset Password'); 
                
                $msg = $this->load->view('email/forgot-password',$data,true);
                $this->email->message($msg);

                if($this->email->send())
                {
                    $this->session->set_flashdata('success','Kindly check your email in order to change your password.');
                    redirect('reset-password/'.$data['id']);
                }else{
                    $this->session->set_flashdata('error','Some error occured please try again.');
                    redirect('forgot-password');
                }
            }else{
                $this->session->set_flashdata('error','Please enter the valid email');
                redirect('forgot-password');
            }
        }else{
            $this->load->view('pages/auth/forgot-password', $data);
        }
	}
    
    /**
     * Admin forgot-password-> load view page
     * url : forgot-password
    **/
	public function reset_password($id)
	{
		$data['title'] = 'Reset Password - Kannada University';
        $data['nonce'] = $this->nonce;
        
        $user_id = $this->encryption_url->safe_b64decode($id);
        if($this->m_authentication->checkChangePasswordActive($user_id)==false){
            $this->session->set_flashdata('error','Sorry you dont have the permission to access this page');
            redirect('404');
        }
        
        $data['user_id'] = $this->encryption_url->safe_b64encode($user_id);

        $this->form_validation->set_rules('otp', 'OTP', 'trim|required|min_length[6]|max_length[6]|numeric');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));

        if($this->form_validation->run()){
            $otp 	= $this->input->post('otp');
            $password 	= $this->input->post('password');

            $data = array(
                'otp' 		=> $otp, 
                'password' 		=> $this->bcrypt->hash_password($password), 
            );
            $data = html_escape($this->security->xss_clean($data));
            $application_id = $this->m_authentication->changePassword($data,$user_id);
            if($application_id!=false)
            {
                $this->session->set_flashdata('success','Password Reset Successful');
                redirect('login');
            }else{
                $this->session->set_flashdata('error','Please enter the valid OTP');
                redirect('reset-password/'.$id);
            }
        }else{
            $this->load->view('pages/auth/reset-password', $data);
        }
	}

}

/* End of file Authentication.php */
/* Location: ./application/controllers/Authentication.php */
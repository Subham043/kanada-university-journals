<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {

	/*--construct--*/
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_authentication');
        header_remove("X-Powered-By"); 
        header("X-Frame-Options: DENY");
        header("X-XSS-Protection: 1; mode=block");
        header("X-Content-Type-Options: nosniff");
        header("Strict-Transport-Security: max-age=31536000");
        header("Content-Security-Policy: frame-ancestors none");
        header("Referrer-Policy: no-referrer-when-downgrade");
        header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
        header("Pragma: no-cache"); //HTTP 1.0
        if ($this->session->userdata('admin_id') != '') {
            redirect('dashboard');
        }
    }

    /**
     * Admin login-> load view page
     * url : login
    **/
	public function index()
	{
        $data['title'] = 'login - Kannada University';
        $this->load->view('pages/auth/login', $data);
	}
    
    /**
     * Admin forgot-password-> load view page
     * url : forgot-password
    **/
	public function forgot_password()
	{
		$data['title'] = 'forgot password - Kannada University';
        $this->load->view('pages/auth/forgot-password', $data);
	}
    
    /**
     * Admin forgot-password-> load view page
     * url : forgot-password
    **/
	public function reset_password()
	{
		$data['title'] = 'reset password - Kannada University';
        $this->load->view('pages/auth/reset-password', $data);
	}

	/**
     * check admin exist
     * @url : login/check
     * @param : email or username , password
     *
     **/
    public function form_validation()
    {
        // $this->sc_check->limitRequests();
        $this->security->xss_clean($_POST);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $this->form_validation->set_rules('username', 'Username or Email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|callback_captcha_validate');
        if ($this->form_validation->run()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $data['login'] = $this->m_authentication->can_login($username, $password);
            if (!empty($data['login'])) {
                if (!empty($data['login']['id'])) {
                    $id = $data['login']['id'];
                    $email = $data['login']['email'];
                    $phone = $data['login']['phone'];
                }
                $session_data = array('admin_id' => $id, 'ra_name' => $email);
                $this->session->set_userdata($session_data);
                redirect('dashboard');
               
            } else {
                $this->session->set_flashdata('error', 'Invalid Username or Password');
                redirect('login');
            }
        } else {

          
            $this->form_validation->set_error_delimiters('', '<br>');
                $this->session->set_flashdata('formerror', str_replace(array("\n", "\r"), '', validation_errors()));
            
           
            redirect('login');
        }
    }
    }
    public function insertOtp($id,$email,$phone)
    {
       
        // $otp = random_string('nozero',6);
        $otp = '123456';
        $result = $this->m_authentication->insertOtp($id,$otp);
        $this->status_send->sendOtp($phone,$otp);
        $this->status_send->emailOtp($email,$otp);
    }
    /**
     * load otp verification for caseworker or officers
     *
     *
    **/
    public function otp_verication($id='')
    {
        $ip = $this->input->ip_address();
        // $this->sc_check->limitRequests();
        $this->security->xss_clean($_POST);
        $data['id'] = $id;
        if(!empty($this->input->post())){
            $deccid = $this->encryption_url->safe_b64decode($id);
            $otp =  $this->input->post('otp');
            $result =  $this->m_authentication->checkOtp($deccid ,$otp);
            if($result){
                $session_data = array('bcp_id' => $result->id, 'ra_name' => $result->email,'ra_type' => $result->admin_type,'ps_id'=>$result->ps_id,'ip'=>$ip);
                $this->session->set_userdata($session_data);
               
                redirect('dashboard');
            }else{
                $this->session->set_flashdata('error', 'You have entered invalid OTP. Please try again');
            }
        }
       $this->load->view('adminuser/otp-verify', $data, FALSE);
    }



    /**
     * enter admin panel if admin exist
     * @url : dashboard
     *
    **/
    public function enter()
    {
        // $this->sc_check->limitRequests();
        $this->security->xss_clean($_POST);

        if ($this->session->userdata('admin_id') != '') {
            $data['title'] = 'Dashboard - Hrudayaspandana';
            $count = $this->m_authentication->getDetails();
            $data['user_count'] = $count['user'];
            $data['contact_count'] = $count['contact'];
            $data['literature_count'] = $count['literature'];
            $data['subscription_count'] = $count['subscription'];
            $data['volunteer_count'] = $count['volunteer'];
            $data['manava_count'] = $count['manava'];
            $data['madhava_count'] = $count['madhava'];
            $data['mayee_count'] = $count['mayee'];
            $data['meru_count'] = $count['meru'];
            $query = $this->db->query('select timestamp, year(timestamp) as year, month(timestamp) as month, sum(amount) as total_amount from donation  where payment_status = "1" and trust = "Sri Sai Meru Mathi Trust" group by year(timestamp), month(timestamp)');
            $data['mathi_graph_label'] = [];
            foreach($query->result() as $fields){
                array_push($data['mathi_graph_label'],date('M',strtotime($fields->timestamp))."-".$fields->year);
            }
            $data['mathi_graph_data'] = [];
            foreach($query->result() as $fields){
                array_push($data['mathi_graph_data'],$fields->total_amount);
            }
            $query = $this->db->query('select timestamp, year(timestamp) as year, month(timestamp) as month, sum(amount) as total_amount from donation  where payment_status = "1" and trust = "Sai Mayee Trust" group by year(timestamp), month(timestamp)');
            $data['mayee_graph_label'] = [];
            foreach($query->result() as $fields){
                array_push($data['mayee_graph_label'],date('M',strtotime($fields->timestamp))."-".$fields->year);
            }
            $data['mayee_graph_data'] = [];
            foreach($query->result() as $fields){
                array_push($data['mayee_graph_data'],$fields->total_amount);
            }
            $this->load->view('pages/dashboard.php', $data);
        } else {
            $this->session->set_flashdata('error', 'Please login and try again');
            redirect('login');
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
            'ra_name' 	=> $this->session->userdata('ra_name'),
        );
        $this->session->unset_userdata($session_data);
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout', 'You are logged out Successfully');
        redirect('login');
    }


        /**
     * forget pasword mail check exist or not
     * @url : forgot/email-check
     * @param : email and forgot-id
     */
    // public function forgot_password()
    // {
    //     // $this->sc_check->limitRequests();
    //     $this->security->xss_clean($_POST);
    //     $forgotid = random_string('alnum', 16);
    //     $email = $this->input->post('email');
    //     $output = $this->m_authentication->check_mail($email, $forgotid);

    //     if ($output == '' && $output == FALSE) {
    //         $this->session->set_flashdata('error', 'invalid Email address');
    //         redirect('login');
    //     } else {
    //         $this->load->config('email');
    //         $this->email->set_newline('\r\n');
    //         $this->load->library('email');
    //         // $this->email->clear(TRUE);
    //         $from = $this->config->item('smtp_user');

    //         $this->email->from($from , 'Hrudayaspandana');
    //         $this->email->to($email);
    //         $this->email->subject('forgot password - Hrudayaspandana');
    //         $this->email->message('click here to set  a new password <a href="' . base_url() . 'set-password/' . $forgotid . '">Reset Password</a>');

    //         if ($this->email->send()) {
    //             $this->session->set_flashdata('success', 'Please confirm your registered email address');
    //             redirect('login');
    //         } else {
    //             $this->session->set_flashdata('error', 'Please try again');
    //             redirect('login');
    //         }

    //     }

    // }


    /**
     * after forgot pasword mail click
     * @url : forgot/email-check
     * @param : forgot-id
     **/
    public function add_pass($id = '')
    {
        $data['title'] = 'admin-Forgot password - Bangalore City Police';
        $data['id'] = $id;
        $this->load->view('auth/reset-psw', $data);
    }

    /**
     * forget pasword -> update New Password
     * @url : update-password
     * @param : email and forgot-id , new password
    **/
    public function update_pass()
    {
        // $this->sc_check->limitRequests();
        $this->security->xss_clean($_POST);
        $forgotid = $this->input->post('id');
        $this->form_validation->set_rules('remail', 'Email Address', 'required|valid_email');
        $this->form_validation->set_rules('password', 'New Password', 'required');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');
        if ($this->form_validation->run() == false) {
            $error = validation_errors();
            $this->session->set_flashdata('formerror', $error);
            redirect('set-password/' . $forgotid, 'refresh');
        } else {
            $email = $this->input->post('remail');
            $newpass =$this->bcrypt->hash_password($this->input->post('password')) ;
            if ($this->m_authentication->addforgtpass($email, $newpass, $forgotid)) {
                $this->session->set_flashdata('success', 'Password updated Successfully');
                redirect('login', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Email id does not exist. please enter correct one!');
                redirect('set-password/' . $forgotid, 'refresh');
            }
        }
    }
    public function captcha_validate($code)
    {  
        // user considered human if they previously solved the Captcha...
        $isHuman = $this->botdetectcaptcha->IsSolved;
       
        if (!$isHuman) {
            // ...or if they solved the current Captcha
            $isHuman = $this->botdetectcaptcha->Validate($code);
           
        }
        // set error if Captcha validation failed
        if (!$isHuman) {
            $this->form_validation->set_message('captcha_validate', 'Please retype the characters from the image correctly.');
        }
        return $isHuman;
    }

    public function getordergraph()
    {
        $query = $this->db->query('select year(timestamp) as year, month(timestamp) as month, sum(amount) as total_amount from donation  where payment_status = "1" and trust = "Sri Sai Meru Mathi Trust" group by year(timestamp), month(timestamp)');
        print_r($query->result());
    }

}

/* End of file Authentication.php */
/* Location: ./application/controllers/Authentication.php */
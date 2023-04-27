<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConferenceMain extends CI_Controller {

	/*--construct--*/
    public function __construct()
    {
        parent::__construct();
    
        $this->load->model('m_conference');
        header_remove("X-Powered-By"); 
        header("X-Frame-Options: DENY");
        header("X-XSS-Protection: 1; mode=block");
        header("X-Content-Type-Options: nosniff");
        header("Strict-Transport-Security: max-age=31536000");
        header("Content-Security-Policy: frame-ancestors none");
        header("Referrer-Policy: no-referrer-when-downgrade");
        header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
        header("Pragma: no-cache"); //HTTP 1.0
    }
    /**
     * Admin login-> load view page
     * url : login
    **/

    public function lists()
	{
		$data['title'] = 'Conference Proceedings - Kannada University';
		$data['page_name'] = 'Conference Proceedings';

        $this->load->library('pagination');

        $config['base_url'] = base_url('conference-proceedings');
        $config['total_rows'] = $this->m_conference->get_main_count($this->input->get('search'));
        $config['per_page'] = 10;

        $config['full_tag_open'] = '<div class="d-flex justify-content-center"><div class="pagination-wrap hstack gap-2">';
        $config['full_tag_close'] = '</div></div>';
        $config['first_tag_open'] = '<div class="page-item pagination-prev">';
        $config['first_tag_close'] = '</div>';
        $config['prev_tag_open'] = '<div class="page-item pagination-prev">';
        $config['prev_tag_close'] = '</div>';
        $config['last_tag_open'] = '<div class="page-item pagination-next">';
        $config['last_tag_close'] = '</div>';
        $config['next_tag_open'] = '<div class="page-item pagination-next">';
        $config['next_tag_close'] = '</div>';
        $config['num_tag_open'] = '<div class="page-item pagination-next">';
        $config['num_tag_close'] = '</div>';
        $config['cur_tag_open'] = '<div class="page-item pagination-next" style="background: var(--vz-border-color);"><b>';
        $config['cur_tag_close'] = '</b></div>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

        $data["links"] = $this->pagination->create_links();

        $data['data'] = $this->m_conference->get_main_list($config["per_page"], $page, $this->input->get('search'));

        $this->load->view('pages/conference/main-list.php', $data);
    }

}
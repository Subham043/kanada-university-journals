<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TeacherMain extends CI_Controller {
    
    private $nonce;

	/*--construct--*/
    public function __construct()
    {
        parent::__construct();

        
        $this->load->model('m_teacher');
        
        $this->nonce = hash('sha256', bin2hex(rand()));
        header("Content-Security-Policy: base-uri 'self';connect-src 'self';default-src 'self';form-action 'self';img-src 'self' data:;media-src 'self';object-src 'none';script-src 'self' 'nonce-".$this->nonce."';style-src 'unsafe-inline' 'self' fonts.googleapis.com;frame-src 'self';font-src 'self' data: fonts.gstatic.com;frame-ancestors 'self'");

    }
    /**
     * Admin login-> load view page
     * url : login
    **/

    public function lists()
	{
		$data['title'] = 'Teacher - Kannada University';
		$data['page_name'] = 'Teacher';

        $this->load->library('pagination');

        $config['base_url'] = base_url('teacher');
        $config['total_rows'] = $this->m_teacher->get_count();
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

        $data['data'] = $this->m_teacher->get_list_main($config["per_page"], $page, $this->input->get('search'), $this->input->get('department'));

        $this->load->model('m_department');
        $data['department'] = $this->m_department->get_all();

        $data['nonce'] = $this->nonce;

        $this->load->view('pages/teacher/main-list.php', $data);
    }

    public function journal_articles($id)
	{
        $teacher_id = $this->encryption_url->safe_b64decode($id);
        $data['data'] = $this->m_teacher->get_data_with_department($teacher_id);
        if($data['data']==false){
            $this->session->set_flashdata('error','Sorry you dont have the permission to access this page');
            redirect('404');
        }

        $data['conference_count'] = $this->m_teacher->get_conference_main_count($teacher_id);
        $data['journal_count'] = $this->m_teacher->get_journal_main_count($teacher_id);
        $data['book_count'] = $this->m_teacher->get_book_main_count($teacher_id);
        $data['book_articles_count'] = $this->m_teacher->get_book_articles_main_count($teacher_id);
        $data['journal_articles_count'] = $this->m_teacher->get_journal_articles_main_count($teacher_id);

        $this->load->library('pagination');
        $config['base_url'] = base_url('teacher/'.$id.'/journal-articles');
        $config['total_rows'] = $data['journal_articles_count'];
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

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data["links"] = $this->pagination->create_links();

        $data['conference'] = $this->m_teacher->get_list_journal_articles_main($config["per_page"], $page, $teacher_id);

        $data['title'] = 'Teacher - Kannada University';
		$data['page_name'] = 'Teacher';

        $data['nonce'] = $this->nonce;

        $this->load->view('pages/teacher/main-journal-article.php', $data);
    }
    
    public function book_articles($id)
	{
        $teacher_id = $this->encryption_url->safe_b64decode($id);
        $data['data'] = $this->m_teacher->get_data_with_department($teacher_id);
        if($data['data']==false){
            $this->session->set_flashdata('error','Sorry you dont have the permission to access this page');
            redirect('404');
        }

        $data['conference_count'] = $this->m_teacher->get_conference_main_count($teacher_id);
        $data['journal_count'] = $this->m_teacher->get_journal_main_count($teacher_id);
        $data['book_count'] = $this->m_teacher->get_book_main_count($teacher_id);
        $data['book_articles_count'] = $this->m_teacher->get_book_articles_main_count($teacher_id);
        $data['journal_articles_count'] = $this->m_teacher->get_journal_articles_main_count($teacher_id);

        $this->load->library('pagination');
        $config['base_url'] = base_url('teacher/'.$id.'/book-articles');
        $config['total_rows'] = $data['book_articles_count'];
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

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data["links"] = $this->pagination->create_links();

        $data['conference'] = $this->m_teacher->get_list_book_articles_main($config["per_page"], $page, $teacher_id);

        $data['title'] = 'Teacher - Kannada University';
		$data['page_name'] = 'Teacher';

        $data['nonce'] = $this->nonce;

        $this->load->view('pages/teacher/main-book-article.php', $data);
    }
    
    public function journal($id)
	{
        $teacher_id = $this->encryption_url->safe_b64decode($id);
        $data['data'] = $this->m_teacher->get_data_with_department($teacher_id);
        if($data['data']==false){
            $this->session->set_flashdata('error','Sorry you dont have the permission to access this page');
            redirect('404');
        }

        $data['conference_count'] = $this->m_teacher->get_conference_main_count($teacher_id);
        $data['journal_count'] = $this->m_teacher->get_journal_main_count($teacher_id);
        $data['book_count'] = $this->m_teacher->get_book_main_count($teacher_id);
        $data['book_articles_count'] = $this->m_teacher->get_book_articles_main_count($teacher_id);
        $data['journal_articles_count'] = $this->m_teacher->get_journal_articles_main_count($teacher_id);

        $this->load->library('pagination');
        $config['base_url'] = base_url('teacher/'.$id.'/journal');
        $config['total_rows'] = $data['journal_count'];
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

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data["links"] = $this->pagination->create_links();

        $data['conference'] = $this->m_teacher->get_list_journal_main($config["per_page"], $page, $teacher_id);

        $data['title'] = 'Teacher - Kannada University';
		$data['page_name'] = 'Teacher';

        $data['nonce'] = $this->nonce;

        $this->load->view('pages/teacher/main-journal.php', $data);
    }
    
    public function book($id)
	{
        $teacher_id = $this->encryption_url->safe_b64decode($id);
        $data['data'] = $this->m_teacher->get_data_with_department($teacher_id);
        if($data['data']==false){
            $this->session->set_flashdata('error','Sorry you dont have the permission to access this page');
            redirect('404');
        }

        $data['conference_count'] = $this->m_teacher->get_conference_main_count($teacher_id);
        $data['journal_count'] = $this->m_teacher->get_journal_main_count($teacher_id);
        $data['book_count'] = $this->m_teacher->get_book_main_count($teacher_id);
        $data['book_articles_count'] = $this->m_teacher->get_book_articles_main_count($teacher_id);
        $data['journal_articles_count'] = $this->m_teacher->get_journal_articles_main_count($teacher_id);

        $this->load->library('pagination');
        $config['base_url'] = base_url('teacher/'.$id.'/book');
        $config['total_rows'] = $data['book_count'];
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

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data["links"] = $this->pagination->create_links();

        $data['conference'] = $this->m_teacher->get_list_book_main($config["per_page"], $page, $teacher_id);

        $data['title'] = 'Teacher - Kannada University';
		$data['page_name'] = 'Teacher';

        $data['nonce'] = $this->nonce;

        $this->load->view('pages/teacher/main-book.php', $data);
    }
    
    public function conference_proceedings($id)
	{
        $teacher_id = $this->encryption_url->safe_b64decode($id);
        $data['data'] = $this->m_teacher->get_data_with_department($teacher_id);
        if($data['data']==false){
            $this->session->set_flashdata('error','Sorry you dont have the permission to access this page');
            redirect('404');
        }
        $data['conference_count'] = $this->m_teacher->get_conference_main_count($teacher_id);
        $data['journal_count'] = $this->m_teacher->get_journal_main_count($teacher_id);
        $data['book_count'] = $this->m_teacher->get_book_main_count($teacher_id);
        $data['book_articles_count'] = $this->m_teacher->get_book_articles_main_count($teacher_id);
        $data['journal_articles_count'] = $this->m_teacher->get_journal_articles_main_count($teacher_id);

        $this->load->library('pagination');
        $config['base_url'] = base_url('teacher/'.$id.'/conference-proceedings');
        $config['total_rows'] = $data['conference_count'];
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

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data["links"] = $this->pagination->create_links();

        $data['conference'] = $this->m_teacher->get_list_conference_main($config["per_page"], $page, $teacher_id);
        
        $data['title'] = 'Teacher - Kannada University';
		$data['page_name'] = 'Teacher';

        $data['nonce'] = $this->nonce;
        
        $this->load->view('pages/teacher/main-conference-proceedings.php', $data);
    }

}
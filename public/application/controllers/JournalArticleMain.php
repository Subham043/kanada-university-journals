<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JournalArticleMain extends CI_Controller {

	/*--construct--*/
    public function __construct()
    {
        parent::__construct();
    
        $this->load->model('m_journal_article');

    }
    /**
     * Admin login-> load view page
     * url : login
    **/

    public function lists()
	{
		$data['title'] = 'Journal Article - Kannada University';
		$data['page_name'] = 'Journal Article';

        $this->load->library('pagination');

        $config['base_url'] = base_url('journal-article');
        $config['total_rows'] = $this->m_journal_article->get_main_count($this->input->get('search'));
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

        $data['data'] = $this->m_journal_article->get_main_list($config["per_page"], $page, $this->input->get('search'));

        $this->load->view('pages/journal_article/main-list.php', $data);
    }

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BookArticleMain extends CI_Controller {

    private string $nonce;

	/*--construct--*/
    public function __construct()
    {
        parent::__construct();
    
        $this->load->model('m_book_article');

        $this->nonce = hash('sha256', bin2hex(random_bytes(10)));
        header("Content-Security-Policy: base-uri 'self';connect-src 'self';default-src 'self';form-action 'self';img-src 'self' data:;media-src 'self';object-src 'none';script-src 'self' 'nonce-".$this->nonce."';style-src 'unsafe-inline' 'self' fonts.googleapis.com;frame-src 'self';font-src 'self' data: fonts.gstatic.com");
    }
    /**
     * Admin login-> load view page
     * url : login
    **/

    public function lists()
	{
		$data['title'] = 'Book Article - Kannada University';
		$data['page_name'] = 'Book Article';
        $data['nonce'] = $this->nonce;

        $this->load->library('pagination');

        $config['base_url'] = base_url('book-article');
        $config['total_rows'] = $this->m_book_article->get_main_count($this->input->get('search'));
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

        $data['data'] = $this->m_book_article->get_main_list($config["per_page"], $page, $this->input->get('search'));

        $this->load->view('pages/book_article/main-list.php', $data);
    }

}
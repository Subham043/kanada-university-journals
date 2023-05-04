<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    private string $nonce;

    /*--construct--*/
    public function __construct()
    {
        parent::__construct();

        $this->load->model('m_department');
        $this->load->model('m_teacher');
        $this->load->model('m_conference');
        $this->load->model('m_book');
        $this->load->model('m_book_article');
        $this->load->model('m_journal');
        $this->load->model('m_journal_article');

        $this->nonce = hash('sha256', bin2hex(random_bytes(10)));
        header("Content-Security-Policy: base-uri 'self';connect-src 'self';default-src 'self';form-action 'self';img-src 'self' data:;media-src 'self';object-src 'none';script-src 'self' 'nonce-".$this->nonce."';style-src 'unsafe-inline' 'self' fonts.googleapis.com;frame-src 'self';font-src 'self' data: fonts.gstatic.com;frame-ancestors 'self'");
    }

    /**
     * Admin login-> load view page
     * url : login
     * @param : email or username , password
     *
     **/
	public function index()
	{
        $data['title'] = 'Dashboard - Kannada University';
		$data['page_name'] = 'Dashboard';
        $data['nonce'] = $this->nonce;
        $data['department'] = $this->m_department->get_count();
        $data['teacher'] = $this->m_teacher->get_count();
        $data['conference'] = $this->m_conference->get_count();
        $data['book'] = $this->m_book->get_count();
        $data['book_article'] = $this->m_book_article->get_count();
        $data['journal'] = $this->m_journal->get_count();
        $data['journal_article'] = $this->m_journal_article->get_count();
        $this->load->view('pages/dashboard/user', $data);
    }

}
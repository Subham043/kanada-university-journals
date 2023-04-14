<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BookArticle extends CI_Controller {

	/*--construct--*/
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('admin_id') == '') {$this->session->set_flashdata('error', 'Oops you need to be logged in order to access the page!'); redirect('login'); }
    
        $this->load->model('m_book_article');
        $this->load->library('form_validation');
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

    public function list()
	{
		$data['title'] = 'Book/Article - Kannada University';
		$data['page_name'] = 'Book/Article';

        $this->load->library('pagination');

        $config['base_url'] = base_url('book-article/list');
        $config['total_rows'] = $this->m_book_article->get_count();
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

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data["links"] = $this->pagination->create_links();

        $data['data'] = $this->m_book_article->get_list($config["per_page"], $page);

        $this->load->view('pages/book_article/list.php', $data);
    }

    public function create()
    {
        $this->load->model('m_teacher');
        $this->load->model('m_keyword');
        $this->load->model('m_publisher');
        $data['title'] = 'Book/Article - Kannada University';
		$data['page_name'] = 'Book/Article';
        $data['teacher'] = $this->m_teacher->get_all();
        $data['editor'] = $data['teacher'];
        $data['keyword'] = $this->m_keyword->get_all();
        $data['publisher'] = $this->m_publisher->get_all();
        $this->load->view('pages/book_article/create.php', $data);
    }

	public function store()
	{
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $this->load->library('upload');
            $this->security->xss_clean($_POST);
            $this->form_validation->set_rules('title', 'Book/Article Title', 'trim|required|min_length[3]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('place', 'Book/Article Place', 'trim|required|min_length[2]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('book_article', 'Name of Seminar/Workshop/Book/Articles', 'trim|required|min_length[2]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('book', 'Book', 'trim|min_length[3]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('editor', 'Editor', 'trim|min_length[3]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('date', 'Date of Seminar/Workshop/Book/Article', 'trim|required|min_length[2]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('isbn', 'ISBN/ISSN', 'trim|min_length[3]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('link', 'Book/Article Web link KUH website', 'trim|required|min_length[2]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('teacher_id', 'Teacher', 'trim|required|numeric');
            $this->form_validation->set_rules('keyword_id', 'Keyword', 'trim|required|numeric');
            if($this->form_validation->run()){
                
                $config['upload_path']          = $_SERVER['DOCUMENT_ROOT'].'/assets/book_article/abstract';
                $config['allowed_types']        = 'pdf';                
                $config['max_width']            = 0;
                $config['encrypt_name']         = TRUE;
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('abstract')){
                    return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(403)
                    ->set_output(json_encode([
                        'message' => 'Validation Error!',
                        'error' => array(
                            'abstract' => $this->upload->display_errors()
                        ),
                    ]));
                }else{
                    $request['abstract'] = $this->upload->data('file_name');
                }
                
                $config['upload_path']          = $_SERVER['DOCUMENT_ROOT'].'/assets/book_article/book';
                $config['allowed_types']        = 'jpg|png|jpeg|webp';                
                $config['max_width']            = 0;
                $config['encrypt_name']         = TRUE;
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('image')){
                    return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(403)
                    ->set_output(json_encode([
                        'message' => 'Validation Error!',
                        'error' => array(
                            'image' => $this->upload->display_errors()
                        ),
                    ]));
                }else{
                    $request['image'] = $this->upload->data('file_name');
                }
                
                $config['upload_path']          = $_SERVER['DOCUMENT_ROOT'].'/assets/book_article/article';
                $config['allowed_types']        = 'pdf';                
                $config['max_width']            = 0;
                $config['encrypt_name']         = TRUE;
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('article')){
                    return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(403)
                    ->set_output(json_encode([
                        'message' => 'Validation Error!',
                        'error' => array(
                            'article' => $this->upload->display_errors()
                        ),
                    ]));
                }else{
                    $request['article'] = $this->upload->data('file_name');
                }

                $request['title'] = $this->input->post('title');
                $request['place'] = $this->input->post('place');
                $request['book_article'] = $this->input->post('book_article');
                $request['book'] = $this->input->post('book');
                $request['editor'] = $this->input->post('editor');
                $request['date'] = $this->input->post('date');
                $request['isbn'] = $this->input->post('isbn');
                $request['link'] = $this->input->post('link');
                $request['teacher_id'] = $this->input->post('teacher_id');
                $request['keyword_id'] = $this->input->post('keyword_id');
                if ($this->m_book_article->create($request)) {
                    return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(201)
                    ->set_output(json_encode([
                        'message' => 'Book/Article created Successfully',
                    ]));
                } else {
                    return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(405)
                    ->set_output(json_encode([
                        'message' => 'Something went wrong please try again!',
                    ]));
                }
            }else{
                return $this->output
                ->set_content_type('application/json')
                ->set_status_header(403)
                ->set_output(json_encode([
                    'message' => 'Validation Error!',
                    'error' => array(
                        'title' => form_error('title'),
                        'place' => form_error('place'),
                        'book_article' => form_error('book_article'),
                        'book' => form_error('book'),
                        'editor' => form_error('editor'),
                        'date' => form_error('date'),
                        'isbn' => form_error('isbn'),
                        'link' => form_error('link'),
                        'teacher_id' => form_error('teacher_id'),
                        'keyword_id' => form_error('keyword_id'),
                    ),
                ]));
            }
        }
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(405)
            ->set_output(json_encode([
                'message' => 'Invalid Method',
            ]));

		
	}
	
    public function edit($id)
	{
		$data['title'] = 'Book/Article - Kannada University';
		$data['page_name'] = 'Book/Article';
		$data['id'] = $id;

        $book_article_id = $this->encryption_url->safe_b64decode($id);
        $data['data'] = $this->m_book_article->get_data($book_article_id);
        if($data['data']==false){
            $this->session->set_flashdata('error','Sorry you dont have the permission to access this page');
            redirect('404');
        }

        $this->load->model('m_teacher');
        $this->load->model('m_keyword');
        $data['teacher'] = $this->m_teacher->get_all();
        $data['keyword'] = $this->m_keyword->get_all();
        $this->load->view('pages/book_article/edit.php', $data);

    }

    public function update($id)
	{
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $book_article_id = $this->encryption_url->safe_b64decode($id);
            $data['data'] = $this->m_book_article->get_data($book_article_id);
            if($data['data']==false){
                return $this->output
                ->set_content_type('application/json')
                ->set_status_header(404)
                ->set_output(json_encode([
                    'message' => 'Page Not Found',
                ]));
            }
            $this->load->library('upload');

            $this->security->xss_clean($_POST);
            $this->form_validation->set_rules('title', 'Book/Article Title', 'trim|required|min_length[3]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('place', 'Book/Article Place', 'trim|required|min_length[2]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('book_article', 'Name of Seminar/Workshop/Book/Articles', 'trim|required|min_length[2]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('book', 'Book', 'trim|min_length[3]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('editor', 'Editor', 'trim|min_length[3]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('date', 'Date of Seminar/Workshop/Book/Article', 'trim|required|min_length[2]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('isbn', 'ISBN/ISSN', 'trim|min_length[3]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('link', 'Book/Article Web link KUH website', 'trim|required|min_length[2]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('teacher_id', 'Teacher', 'trim|required|numeric');
            $this->form_validation->set_rules('keyword_id', 'Keyword', 'trim|required|numeric');

            if($this->form_validation->run()){

                if(isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"])){
                    $config['upload_path']          = $_SERVER['DOCUMENT_ROOT'].'/assets/book_article/book';
                    $config['allowed_types']        = 'jpg|png|jpeg|webp';                
                    $config['max_width']            = 0;
                    $config['encrypt_name']         = TRUE;
                    $this->upload->initialize($config);
                    if(!$this->upload->do_upload('image')){
                        return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(403)
                        ->set_output(json_encode([
                            'message' => 'Validation Error!',
                            'error' => array(
                                'image' => $this->upload->display_errors()
                            ),
                        ]));
                    }else{
                        $path = $_SERVER['DOCUMENT_ROOT'].'/assets/book_article/book/'.$data['data']->image;
                        unlink($path);
                        $request['image'] = $this->upload->data('file_name');
                    }
                }

                if(isset($_FILES["abstract"]["name"]) && !empty($_FILES["abstract"]["name"])){
                    $config['upload_path']          = $_SERVER['DOCUMENT_ROOT'].'/assets/book_article/abstract';
                    $config['allowed_types']        = 'pdf';                
                    $config['max_width']            = 0;
                    $config['encrypt_name']         = TRUE;
                    $this->upload->initialize($config);
                    if(!$this->upload->do_upload('abstract')){
                        return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(403)
                        ->set_output(json_encode([
                            'message' => 'Validation Error!',
                            'error' => array(
                                'abstract' => $this->upload->display_errors()
                            ),
                        ]));
                    }else{
                        $path = $_SERVER['DOCUMENT_ROOT'].'/assets/book_article/abstract/'.$data['data']->abstract;
                        unlink($path);
                        $request['abstract'] = $this->upload->data('file_name');
                    }
                }
                
                if(isset($_FILES["article"]["name"]) && !empty($_FILES["article"]["name"])){
                    $config['upload_path']          = $_SERVER['DOCUMENT_ROOT'].'/assets/book_article/article';
                    $config['allowed_types']        = 'pdf';                
                    $config['max_width']            = 0;
                    $config['encrypt_name']         = TRUE;
                    $this->upload->initialize($config);
                    if(!$this->upload->do_upload('article')){
                        return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(403)
                        ->set_output(json_encode([
                            'message' => 'Validation Error!',
                            'error' => array(
                                'article' => $this->upload->display_errors()
                            ),
                        ]));
                    }else{
                        $path = $_SERVER['DOCUMENT_ROOT'].'/assets/book_article/article/'.$data['data']->article;
                        unlink($path);
                        $request['article'] = $this->upload->data('file_name');
                    }
                }

                $request['title'] = $this->input->post('title');
                $request['place'] = $this->input->post('place');
                $request['book_article'] = $this->input->post('book_article');
                $request['book'] = $this->input->post('book');
                $request['editor'] = $this->input->post('editor');
                $request['date'] = $this->input->post('date');
                $request['isbn'] = $this->input->post('isbn');
                $request['link'] = $this->input->post('link');
                $request['teacher_id'] = $this->input->post('teacher_id');
                $request['keyword_id'] = $this->input->post('keyword_id');
                if ($this->m_book_article->update($book_article_id, $request)!=FALSE) {
                    return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(201)
                    ->set_output(json_encode([
                        'message' => 'Book/Article updated Successfully',
                    ]));
                } else {
                    return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(405)
                    ->set_output(json_encode([
                        'message' => 'Something went wrong please try again!',
                    ]));
                }

            }else{
                return $this->output
                ->set_content_type('application/json')
                ->set_status_header(403)
                ->set_output(json_encode([
                    'message' => 'Validation Error!',
                    'error' => array(
                        'title' => form_error('title'),
                        'place' => form_error('place'),
                        'book_article' => form_error('book_article'),
                        'book' => form_error('book'),
                        'editor' => form_error('editor'),
                        'date' => form_error('date'),
                        'isbn' => form_error('isbn'),
                        'link' => form_error('link'),
                        'teacher_id' => form_error('teacher_id'),
                        'keyword_id' => form_error('keyword_id'),
                    ),
                ]));
            }
        }
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(405)
            ->set_output(json_encode([
                'message' => 'Invalid Method',
            ]));
		
	}

    public function delete($id)
	{
        $book_article_id = $this->encryption_url->safe_b64decode($id);
        $data['data'] = $this->m_book_article->get_data($book_article_id);
        if($data['data']==false){
            $this->session->set_flashdata('error','Sorry you dont have the permission to access this page');
            redirect('404');
        }
        if ($this->m_book_article->delete($book_article_id)!=FALSE) {
            $path = $_SERVER['DOCUMENT_ROOT'].'/assets/book_article/book/'.$data['data']->image;
            unlink($path);
            $path = $_SERVER['DOCUMENT_ROOT'].'/assets/book_article/article/'.$data['data']->article;
            unlink($path);
            $path = $_SERVER['DOCUMENT_ROOT'].'/assets/book_article/abstract/'.$data['data']->abstract;
            unlink($path);
            $this->session->set_flashdata('success', 'Book/Article deleted Successfully');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('error', 'Something went wrong please try again!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

}
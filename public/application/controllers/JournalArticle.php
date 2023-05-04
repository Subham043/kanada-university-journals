<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JournalArticle extends CI_Controller {

    private $nonce;

	/*--construct--*/
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('admin_id') == '' || $this->session->userdata('user_type') == 2) {$this->session->set_flashdata('error', 'Oops you need to be logged in order to access the page!'); redirect('dashboard'); }
    
        $this->load->model('m_journal_article');
        $this->load->library('form_validation');

        $this->nonce = hash('sha256', bin2hex(rand()));
        header("Content-Security-Policy: base-uri 'self';connect-src 'self';default-src 'self';form-action 'self';img-src 'self' data:;media-src 'self';object-src 'none';script-src 'self' 'nonce-".$this->nonce."';style-src 'unsafe-inline' 'self' fonts.googleapis.com;frame-src 'self';font-src 'self' data: fonts.gstatic.com;frame-ancestors 'self'");
    }
    /**
     * Admin login-> load view page
     * url : login
    **/

    public function lists()
	{
		$data['title'] = 'Journal/Article - Kannada University';
		$data['page_name'] = 'Journal/Article';
        $data['nonce'] = $this->nonce;

        $this->load->library('pagination');

        $config['base_url'] = base_url('admin/journal-article/list');
        $config['total_rows'] = $this->m_journal_article->get_count();
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

        $data['data'] = $this->m_journal_article->get_list($config["per_page"], $page);

        $this->load->view('pages/journal_article/list.php', $data);
    }

    public function create()
    {
        $this->load->model('m_teacher');
        $this->load->model('m_keyword');
        $this->load->model('m_publisher');
        $this->load->model('m_department');
        $data['department'] = $this->m_department->get_all();
        $data['title'] = 'Journal/Article - Kannada University';
		$data['page_name'] = 'Journal/Article';
        $data['teacher'] = $this->m_teacher->get_all();
        $data['editor'] = $data['teacher'];
        $data['keyword'] = $this->m_keyword->get_all();
        $data['publisher'] = $this->m_publisher->get_all();
        $data['nonce'] = $this->nonce;
        $this->load->view('pages/journal_article/create.php', $data);
    }

	public function store()
	{
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $this->load->library('upload');
            $this->security->xss_clean($_POST);
            $this->form_validation->set_rules('is_downloadable', 'Journal/Article Can Download', 'trim|required|in_list[1,0]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('is_published', 'Journal/Article Published', 'trim|required|in_list[1,0]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('name', 'Journal/Article Name', 'trim|required|min_length[3]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('title', 'Journal/Article Title', 'trim|required|min_length[3]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('edition', 'Journal/Article Edition/Volume', 'trim|required|min_length[3]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('isbn', 'ISBN/ISSN', 'trim|min_length[3]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('date', 'Date of Seminar/Workshop/Article', 'trim|required|min_length[2]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('link', 'Journal/Article Web link KUH website', 'trim|required|min_length[2]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('publisher_id', 'Publisher', 'trim|required|numeric');
            $this->form_validation->set_rules('keyword_id', 'Keyword', 'trim|required|numeric');
            $this->form_validation->set_rules('department_id', 'Teacher Department', 'trim|required|numeric');
            $this->form_validation->set_rules('teacher_id[]', 'Author', 'trim|required|numeric');
            $this->form_validation->set_rules('editor_id[]', 'Editor', 'trim|required|numeric');
            $this->form_validation->set_rules('editor_name[]', 'Editor Name', 'trim|min_length[3]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            if((!empty($this->input->post('teacher_name[]'))) || (!empty($this->input->post('teacher_email[]'))) || (!empty($this->input->post('teacher_mobile[]')))){
                $this->form_validation->set_rules('teacher_name[]', 'Teacher Name', 'trim|required|min_length[3]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
                $this->form_validation->set_rules('teacher_email[]', 'Teacher Email', 'trim|required|valid_email');
                $this->form_validation->set_rules('teacher_mobile[]', 'Teacher Mobile', 'trim|required|numeric|min_length[10]|max_length[10]');
            }

            if($this->form_validation->run()){
                $config['upload_path']          = $_SERVER['DOCUMENT_ROOT'].'/assets/journal_article/abstract';
                $config['allowed_types']        = 'pdf';                
                $config['max_width']            = 0;
                $config['encrypt_name']         = TRUE;
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('abstract')){
                    return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(422)
                    ->set_output(json_encode([
                        'message' => 'Validation Error!',
                        'error' => array(
                            'abstract' => $this->upload->display_errors()
                        ),
                        $this->security->get_csrf_token_name() => $this->security->get_csrf_hash(),
                    ]));
                }else{
                    $request['abstract'] = $this->upload->data('file_name');
                }
                
                $config['upload_path']          = $_SERVER['DOCUMENT_ROOT'].'/assets/journal_article/book';
                $config['allowed_types']        = 'jpg|png|jpeg|webp';                
                $config['max_width']            = 0;
                $config['encrypt_name']         = TRUE;
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('image')){
                    return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(422)
                    ->set_output(json_encode([
                        'message' => 'Validation Error!',
                        'error' => array(
                            'image' => $this->upload->display_errors()
                        ),
                        $this->security->get_csrf_token_name() => $this->security->get_csrf_hash(),
                    ]));
                }else{
                    $request['image'] = $this->upload->data('file_name');
                }
                
                $config['upload_path']          = $_SERVER['DOCUMENT_ROOT'].'/assets/journal_article/article';
                $config['allowed_types']        = 'pdf';                
                $config['max_width']            = 0;
                $config['encrypt_name']         = TRUE;
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('article')){
                    return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(422)
                    ->set_output(json_encode([
                        'message' => 'Validation Error!',
                        'error' => array(
                            'article' => $this->upload->display_errors()
                        ),
                        $this->security->get_csrf_token_name() => $this->security->get_csrf_hash(),
                    ]));
                }else{
                    $request['article'] = $this->upload->data('file_name');
                }

                $request['title'] = $this->input->post('title');
                $request['name'] = $this->input->post('name');
                $request['edition'] = $this->input->post('edition');
                $request['isbn'] = $this->input->post('isbn');
                $request['date'] = $this->input->post('date');
                $request['link'] = $this->input->post('link');
                $request['is_downloadable'] = $this->input->post('is_downloadable');
                $request['is_published'] = $this->input->post('is_published');
                $request['publisher_id'] = $this->input->post('publisher_id');
                $request['keyword_id'] = $this->input->post('keyword_id');
                $request['department_id'] = $this->input->post('department_id');
                if ($id = $this->m_journal_article->create($request)) {

                    $this->m_journal_article->delete_teacher($id);
                    foreach($this->input->post('teacher_id') as $data){
                        $this->m_journal_article->create_teacher(
                            array(
                                'teacher_id' => $data,
                                'journal_article_id' => $id
                            )
                        );
                    }

                    $this->m_journal_article->delete_editor($id);
                    foreach($this->input->post('editor_id') as $val){
                        $this->m_journal_article->create_editor(
                            array(
                                'editor_id' => $val,
                                'journal_article_id' => $id
                            )
                        );
                    }

                    if(!empty($this->input->post('editor_name'))){
                        $this->m_journal_article->delete_add_editor($id);
                        foreach($this->input->post('editor_name') as $val){
                            $this->m_journal_article->create_add_editor(
                                array(
                                    'editor_name' => $val,
                                    'journal_article_id' => $id
                                )
                            );
                        }
                    }
                    
                    if(!empty($this->input->post('teacher_name'))){
                        $this->m_journal_article->delete_add_teacher($id);
                        foreach($this->input->post('teacher_name') as $ind=>$val){
                            $this->m_journal_article->create_add_teacher(
                                array(
                                    'teacher_name' => $val,
                                    'teacher_email' => $this->input->post('teacher_email')[$ind],
                                    'teacher_mobile' => $this->input->post('teacher_mobile')[$ind],
                                    'journal_article_id' => $id
                                )
                            );
                        }
                    }

                    return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(201)
                    ->set_output(json_encode([
                        'message' => 'Journal/Article created Successfully',
                        $this->security->get_csrf_token_name() => $this->security->get_csrf_hash(),
                    ]));
                } else {
                    return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(405)
                    ->set_output(json_encode([
                        'message' => 'Something went wrong please try again!',
                        $this->security->get_csrf_token_name() => $this->security->get_csrf_hash(),
                    ]));
                }
            }else{
                return $this->output
                ->set_content_type('application/json')
                ->set_status_header(422)
                ->set_output(json_encode([
                    'message' => 'Validation Error!',
                    'error' => array(
                        'title' => form_error('title'),
                        'name' => form_error('name'),
                        'edition' => form_error('edition'),
                        'date' => form_error('date'),
                        'isbn' => form_error('isbn'),
                        'link' => form_error('link'),
                        'keyword_id' => form_error('keyword_id'),
                        'publicher_id' => form_error('publicher_id'),
                        'department_id' => form_error('department_id'),
                        'teacher_id[]' => form_error('teacher_id[]'),
                        'teacher_name[]' => form_error('teacher_name[]'),
                        'teacher_email[]' => form_error('teacher_email[]'),
                        'teacher_mobile[]' => form_error('teacher_mobile[]'),
                        'editor_id[]' => form_error('editor_id[]'),
                        'editor_name[]' => form_error('editor_name[]'),
                    ),
                    $this->security->get_csrf_token_name() => $this->security->get_csrf_hash(),
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
		$data['title'] = 'Journal/Article - Kannada University';
		$data['page_name'] = 'Journal/Article';
		$data['id'] = $id;
        $data['nonce'] = $this->nonce;

        $article_id = $this->encryption_url->safe_b64decode($id);
        $data['data'] = $this->m_journal_article->get_data($article_id);
        if($data['data']==false){
            $this->session->set_flashdata('error','Sorry you dont have the permission to access this page');
            redirect('404');
        }
        
        $data['selected_teacher'] = $this->array_pluck( 
            $this->m_journal_article->get_teacher_all($article_id), 
            'teacher_id' 
        );
        
        $data['selected_add_teacher'] = $this->m_journal_article->get_add_teacher_all($article_id);
        
        $data['selected_editor'] = $this->array_pluck( 
            $this->m_journal_article->get_editor_all($article_id), 
            'editor_id' 
        );
        
        $data['selected_add_editor'] = $this->m_journal_article->get_add_editor_all($article_id);
        
        $this->load->model('m_teacher');
        $this->load->model('m_keyword');
        $this->load->model('m_publisher');
        $this->load->model('m_department');
        $data['department'] = $this->m_department->get_all();
        $data['teacher'] = $this->m_teacher->get_all();
        $data['editor'] = $data['teacher'];
        $data['keyword'] = $this->m_keyword->get_all();
        $data['publisher'] = $this->m_publisher->get_all();
        $this->load->view('pages/journal_article/edit.php', $data);

    }

    public function update($id)
	{
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $article_id = $this->encryption_url->safe_b64decode($id);
            $data['data'] = $this->m_journal_article->get_data($article_id);
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
            $this->form_validation->set_rules('is_downloadable', 'Journal/Article Can Download', 'trim|required|in_list[1,0]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('is_published', 'Journal/Article Published', 'trim|required|in_list[1,0]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('name', 'Journal/Article Name', 'trim|required|min_length[3]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('title', 'Journal/Article Title', 'trim|required|min_length[3]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('edition', 'Journal/Article Edition/Volume', 'trim|required|min_length[3]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('isbn', 'ISBN/ISSN', 'trim|min_length[3]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('date', 'Date of Seminar/Workshop/Article', 'trim|required|min_length[2]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('link', 'Journal/Article Web link KUH website', 'trim|required|min_length[2]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('publisher_id', 'Publisher', 'trim|required|numeric');
            $this->form_validation->set_rules('keyword_id', 'Keyword', 'trim|required|numeric');
            $this->form_validation->set_rules('department_id', 'Teacher Department', 'trim|required|numeric');
            $this->form_validation->set_rules('teacher_id[]', 'Author', 'trim|required|numeric');
            $this->form_validation->set_rules('editor_id[]', 'Editor', 'trim|required|numeric');
            $this->form_validation->set_rules('editor_name[]', 'Editor Name', 'trim|min_length[3]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            if((!empty($this->input->post('teacher_name[]'))) || (!empty($this->input->post('teacher_email[]'))) || (!empty($this->input->post('teacher_mobile[]')))){
                $this->form_validation->set_rules('teacher_name[]', 'Teacher Name', 'trim|required|min_length[3]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
                $this->form_validation->set_rules('teacher_email[]', 'Teacher Email', 'trim|required|valid_email');
                $this->form_validation->set_rules('teacher_mobile[]', 'Teacher Mobile', 'trim|required|numeric|min_length[10]|max_length[10]');
            }

            if($this->form_validation->run()){

                if(isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"])){
                    $config['upload_path']          = $_SERVER['DOCUMENT_ROOT'].'/assets/journal_article/book';
                    $config['allowed_types']        = 'jpg|png|jpeg|webp';                
                    $config['max_width']            = 0;
                    $config['encrypt_name']         = TRUE;
                    $this->upload->initialize($config);
                    if(!$this->upload->do_upload('image')){
                        return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(422)
                        ->set_output(json_encode([
                            'message' => 'Validation Error!',
                            'error' => array(
                                'image' => $this->upload->display_errors()
                            ),
                            $this->security->get_csrf_token_name() => $this->security->get_csrf_hash(),
                        ]));
                    }else{
                        $path = $_SERVER['DOCUMENT_ROOT'].'/assets/journal_article/book/'.$data['data']->image;
                        unlink($path);
                        $request['image'] = $this->upload->data('file_name');
                    }
                }

                if(isset($_FILES["abstract"]["name"]) && !empty($_FILES["abstract"]["name"])){
                    $config['upload_path']          = $_SERVER['DOCUMENT_ROOT'].'/assets/journal_article/abstract';
                    $config['allowed_types']        = 'pdf';                
                    $config['max_width']            = 0;
                    $config['encrypt_name']         = TRUE;
                    $this->upload->initialize($config);
                    if(!$this->upload->do_upload('abstract')){
                        return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(422)
                        ->set_output(json_encode([
                            'message' => 'Validation Error!',
                            'error' => array(
                                'abstract' => $this->upload->display_errors()
                            ),
                            $this->security->get_csrf_token_name() => $this->security->get_csrf_hash(),
                        ]));
                    }else{
                        $path = $_SERVER['DOCUMENT_ROOT'].'/assets/journal_article/abstract/'.$data['data']->abstract;
                        unlink($path);
                        $request['abstract'] = $this->upload->data('file_name');
                    }
                }
                
                if(isset($_FILES["article"]["name"]) && !empty($_FILES["article"]["name"])){
                    $config['upload_path']          = $_SERVER['DOCUMENT_ROOT'].'/assets/journal_article/article';
                    $config['allowed_types']        = 'pdf';                
                    $config['max_width']            = 0;
                    $config['encrypt_name']         = TRUE;
                    $this->upload->initialize($config);
                    if(!$this->upload->do_upload('article')){
                        return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(422)
                        ->set_output(json_encode([
                            'message' => 'Validation Error!',
                            'error' => array(
                                'article' => $this->upload->display_errors()
                            ),
                            $this->security->get_csrf_token_name() => $this->security->get_csrf_hash(),
                        ]));
                    }else{
                        $path = $_SERVER['DOCUMENT_ROOT'].'/assets/journal_article/article/'.$data['data']->article;
                        unlink($path);
                        $request['article'] = $this->upload->data('file_name');
                    }
                }

                $request['title'] = $this->input->post('title');
                $request['name'] = $this->input->post('name');
                $request['edition'] = $this->input->post('edition');
                $request['isbn'] = $this->input->post('isbn');
                $request['date'] = $this->input->post('date');
                $request['link'] = $this->input->post('link');
                $request['is_downloadable'] = $this->input->post('is_downloadable');
                $request['is_published'] = $this->input->post('is_published');
                $request['publisher_id'] = $this->input->post('publisher_id');
                $request['keyword_id'] = $this->input->post('keyword_id');
                $request['department_id'] = $this->input->post('department_id');
                if ($this->m_journal_article->update($article_id, $request)!=FALSE) {

                    $this->m_journal_article->delete_teacher($article_id);
                    foreach($this->input->post('teacher_id') as $data){
                        $this->m_journal_article->create_teacher(
                            array(
                                'teacher_id' => $data,
                                'journal_article_id' => $article_id
                            )
                        );
                    }

                    $this->m_journal_article->delete_editor($article_id);
                    foreach($this->input->post('editor_id') as $val){
                        $this->m_journal_article->create_editor(
                            array(
                                'editor_id' => $val,
                                'journal_article_id' => $article_id
                            )
                        );
                    }

                    if(!empty($this->input->post('editor_name'))){
                        $this->m_journal_article->delete_add_editor($article_id);
                        foreach($this->input->post('editor_name') as $val){
                            $this->m_journal_article->create_add_editor(
                                array(
                                    'editor_name' => $val,
                                    'journal_article_id' => $article_id
                                )
                            );
                        }
                    }
                    
                    if(!empty($this->input->post('teacher_name'))){
                        $this->m_journal_article->delete_add_teacher($article_id);
                        foreach($this->input->post('teacher_name') as $ind=>$val){
                            $this->m_journal_article->create_add_teacher(
                                array(
                                    'teacher_name' => $val,
                                    'teacher_email' => $this->input->post('teacher_email')[$ind],
                                    'teacher_mobile' => $this->input->post('teacher_mobile')[$ind],
                                    'journal_article_id' => $article_id
                                )
                            );
                        }
                    }

                    return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(201)
                    ->set_output(json_encode([
                        'message' => 'Journal/Article updated Successfully',
                        $this->security->get_csrf_token_name() => $this->security->get_csrf_hash(),
                    ]));
                } else {
                    return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(405)
                    ->set_output(json_encode([
                        'message' => 'Something went wrong please try again!',
                        $this->security->get_csrf_token_name() => $this->security->get_csrf_hash(),
                    ]));
                }

            }else{
                return $this->output
                ->set_content_type('application/json')
                ->set_status_header(422)
                ->set_output(json_encode([
                    'message' => 'Validation Error!',
                    'error' => array(
                        'title' => form_error('title'),
                        'name' => form_error('name'),
                        'edition' => form_error('edition'),
                        'date' => form_error('date'),
                        'isbn' => form_error('isbn'),
                        'link' => form_error('link'),
                        'keyword_id' => form_error('keyword_id'),
                        'publicher_id' => form_error('publicher_id'),
                        'department_id' => form_error('department_id'),
                        'teacher_id[]' => form_error('teacher_id[]'),
                        'teacher_name[]' => form_error('teacher_name[]'),
                        'teacher_email[]' => form_error('teacher_email[]'),
                        'teacher_mobile[]' => form_error('teacher_mobile[]'),
                        'editor_id[]' => form_error('editor_id[]'),
                        'editor_name[]' => form_error('editor_name[]'),
                    ),
                    $this->security->get_csrf_token_name() => $this->security->get_csrf_hash(),
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
        $article_id = $this->encryption_url->safe_b64decode($id);
        $data['data'] = $this->m_journal_article->get_data($article_id);
        if($data['data']==false){
            $this->session->set_flashdata('error','Sorry you dont have the permission to access this page');
            redirect('404');
        }
        if ($this->m_journal_article->delete($article_id)!=FALSE) {
            $path = $_SERVER['DOCUMENT_ROOT'].'/assets/journal_article/book/'.$data['data']->image;
            unlink($path);
            $path = $_SERVER['DOCUMENT_ROOT'].'/assets/journal_article/article/'.$data['data']->article;
            unlink($path);
            $path = $_SERVER['DOCUMENT_ROOT'].'/assets/journal_article/abstract/'.$data['data']->abstract;
            unlink($path);
            $this->session->set_flashdata('success', 'Journal/Article deleted Successfully');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('error', 'Something went wrong please try again!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    function array_pluck($array, $key) {
        return array_map(function($v) use ($key) {
          return is_object($v) ? $v->$key : $v[$key];
        }, $array);
    }

}
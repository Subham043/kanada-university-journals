<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends CI_Controller {

	/*--construct--*/
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('admin_id') == '') {$this->session->set_flashdata('error', 'Oops you need to be logged in to access the page!'); redirect('login'); }
    
        $this->load->model('m_teacher');
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
		$data['title'] = 'Teacher - Kannada University';
		$data['page_name'] = 'Teacher';

        $this->load->library('pagination');

        $config['base_url'] = base_url('teacher/list');
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

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data["links"] = $this->pagination->create_links();

        $data['data'] = $this->m_teacher->get_list($config["per_page"], $page);

        $this->load->view('pages/teacher/list.php', $data);
    }

    public function create()
    {
        $this->load->model('m_department');
        $this->load->model('m_designation');
        $data['title'] = 'Teacher - Kannada University';
		$data['page_name'] = 'Teacher';
        $data['department'] = $this->m_department->get_all();
        $data['designation'] = $this->m_designation->get_all();
        $this->load->view('pages/teacher/create.php', $data);
    }

	public function store()
	{
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $config['upload_path']          = $_SERVER['DOCUMENT_ROOT'].'/assets/teacher';
            $config['allowed_types']        = 'jpg|png|jpeg|webp';                
            $config['max_width']            = 0;
            $config['encrypt_name']         = TRUE;
            $this->load->library('upload', $config);

            $this->security->xss_clean($_POST);
            $this->form_validation->set_rules('prefix', 'Teacher Prefix', 'trim|required|in_list[Dr,Prof,Sri,Smt,Ms,Mr,Mrs]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('code', 'Teacher Code', 'trim|required|min_length[3]|max_length[200]|is_unique[teacher.code]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s', 'is_unique'=>'This teacher code is already in use'));
            $this->form_validation->set_rules('first_name', 'Teacher First Name', 'trim|required|min_length[3]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('last_name', 'Teacher Last Name', 'trim|required|min_length[2]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('dob', 'Teacher Date of Birth', 'trim|required|min_length[2]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('joining', 'Teacher Date of Joining', 'trim|required|min_length[2]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('subject', 'Teacher Subject and Specialization', 'trim|required|min_length[2]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('mobile', 'Teacher Mobile Number', 'trim|required|numeric|min_length[10]|max_length[10]|is_unique[teacher.mobile]', array('is_unique'=>'This teacher code is already in use'));
            $this->form_validation->set_rules('email', 'Teacher Email', 'trim|required|min_length[3]|max_length[200]|is_unique[teacher.email]|valid_email');
            $this->form_validation->set_rules('address', 'Teacher Address', 'trim|required|min_length[2]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('link', 'Teacher Web link KUH website', 'trim|required|min_length[2]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('designation_id', 'Teacher Designation', 'trim|required|numeric');
            $this->form_validation->set_rules('department_id', 'Teacher Department', 'trim|required|numeric');
            if($this->form_validation->run()){

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
                }

                $request['code'] = $this->input->post('code');
                $request['prefix'] = $this->input->post('prefix');
                $request['first_name'] = $this->input->post('first_name');
                $request['last_name'] = $this->input->post('last_name');
                $request['dob'] = $this->input->post('dob');
                $request['joining'] = $this->input->post('joining');
                $request['subject'] = $this->input->post('subject');
                $request['mobile'] = $this->input->post('mobile');
                $request['email'] = $this->input->post('email');
                $request['address'] = $this->input->post('address');
                $request['link'] = $this->input->post('link');
                $request['designation_id'] = $this->input->post('designation_id');
                $request['department_id'] = $this->input->post('department_id');
                $request['image'] = $this->upload->data('file_name');
                if ($this->m_teacher->create($request)) {
                    return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(201)
                    ->set_output(json_encode([
                        'message' => 'Teacher created Successfully',
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
                        'code' => form_error('code'),
                        'first_name' => form_error('first_name'),
                        'last_name' => form_error('last_name'),
                        'prefix' => form_error('prefix'),
                        'dob' => form_error('dob'),
                        'joining' => form_error('joining'),
                        'subject' => form_error('subject'),
                        'mobile' => form_error('mobile'),
                        'email' => form_error('email'),
                        'address' => form_error('address'),
                        'link' => form_error('link'),
                        'designation_id' => form_error('designation_id'),
                        'department_id' => form_error('department_id'),
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
		$data['title'] = 'Teacher - Kannada University';
		$data['page_name'] = 'Teacher';
		$data['id'] = $id;

        $teacher_id = $this->encryption_url->safe_b64decode($id);
        $data['data'] = $this->m_teacher->get_data($teacher_id);
        if($data['data']==false){
            $this->session->set_flashdata('error','Sorry you dont have the permission to access this page');
            redirect('404');
        }

        $this->load->model('m_department');
        $this->load->model('m_designation');
        $data['department'] = $this->m_department->get_all();
        $data['designation'] = $this->m_designation->get_all();
        $this->load->view('pages/teacher/edit.php', $data);

    }

    public function update($id)
	{
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $teacher_id = $this->encryption_url->safe_b64decode($id);
            $data['data'] = $this->m_teacher->get_data($teacher_id);
            if($data['data']==false){
                return $this->output
                ->set_content_type('application/json')
                ->set_status_header(404)
                ->set_output(json_encode([
                    'message' => 'Page Not Found',
                ]));
            }

            $config['upload_path']          = $_SERVER['DOCUMENT_ROOT'].'/assets/teacher';
            $config['allowed_types']        = 'jpg|png|jpeg|webp';                
            $config['max_width']            = 0;
            $config['encrypt_name']         = TRUE;
            $this->load->library('upload', $config);

            $this->security->xss_clean($_POST);
            $this->form_validation->set_rules('prefix', 'Teacher Prefix', 'trim|required|in_list[Dr,Prof,Sri,Smt,Ms,Mr,Mrs]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('first_name', 'Teacher First Name', 'trim|required|min_length[3]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('last_name', 'Teacher Last Name', 'trim|required|min_length[2]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('dob', 'Teacher Date of Birth', 'trim|required|min_length[2]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('joining', 'Teacher Date of Joining', 'trim|required|min_length[2]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('subject', 'Teacher Subject and Specialization', 'trim|required|min_length[2]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('address', 'Teacher Address', 'trim|required|min_length[2]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('link', 'Teacher Web link KUH website', 'trim|required|min_length[2]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
            $this->form_validation->set_rules('designation_id', 'Teacher Designation', 'trim|required|numeric');
            $this->form_validation->set_rules('department_id', 'Teacher Department', 'trim|required|numeric');

            if($data['data']->code==$this->input->post('code')){
                $this->form_validation->set_rules('code', 'Teacher Code', 'trim|required|min_length[3]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s', 'is_unique'=>'This teacher code is already in use'));
            }else{
                $this->form_validation->set_rules('code', 'Teacher Code', 'trim|required|min_length[3]|max_length[200]|is_unique[teacher.code]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s', 'is_unique'=>'This teacher code is already in use'));
            }
            
            if($data['data']->mobile==$this->input->post('mobile')){
                $this->form_validation->set_rules('mobile', 'Teacher Mobile Number', 'trim|required|numeric|min_length[10]|max_length[10]');
            }else{
                $this->form_validation->set_rules('mobile', 'Teacher Mobile Number', 'trim|required|numeric|min_length[10]|max_length[10]|is_unique[teacher.mobile]', array('is_unique'=>'This teacher code is already in use'));
            }
            
            if($data['data']->email==$this->input->post('email')){
                $this->form_validation->set_rules('email', 'Teacher Email', 'trim|required|min_length[3]|max_length[200]|valid_email');
            }else{
                $this->form_validation->set_rules('email', 'Teacher Email', 'trim|required|min_length[3]|max_length[200]|is_unique[teacher.email]|valid_email');
            }

            if($this->form_validation->run()){

                if(isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"])){
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
                        $path = $_SERVER['DOCUMENT_ROOT'].'/assets/teacher/'.$data['data']->image;
                        unlink($path);
                        $request['image'] = $this->upload->data('file_name');
                    }
                }

                $request['code'] = $this->input->post('code');
                $request['prefix'] = $this->input->post('prefix');
                $request['first_name'] = $this->input->post('first_name');
                $request['last_name'] = $this->input->post('last_name');
                $request['dob'] = $this->input->post('dob');
                $request['joining'] = $this->input->post('joining');
                $request['subject'] = $this->input->post('subject');
                $request['mobile'] = $this->input->post('mobile');
                $request['email'] = $this->input->post('email');
                $request['address'] = $this->input->post('address');
                $request['link'] = $this->input->post('link');
                $request['designation_id'] = $this->input->post('designation_id');
                $request['department_id'] = $this->input->post('department_id');
                if ($this->m_teacher->update($teacher_id, $request)!=FALSE) {
                    return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(201)
                    ->set_output(json_encode([
                        'message' => 'Teacher updated Successfully',
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
                        'code' => form_error('code'),
                        'first_name' => form_error('first_name'),
                        'last_name' => form_error('last_name'),
                        'prefix' => form_error('prefix'),
                        'dob' => form_error('dob'),
                        'joining' => form_error('joining'),
                        'subject' => form_error('subject'),
                        'mobile' => form_error('mobile'),
                        'email' => form_error('email'),
                        'address' => form_error('address'),
                        'link' => form_error('link'),
                        'designation_id' => form_error('designation_id'),
                        'department_id' => form_error('department_id'),
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
        $teacher_id = $this->encryption_url->safe_b64decode($id);
        $data['data'] = $this->m_teacher->get_data($teacher_id);
        if($data['data']==false){
            $this->session->set_flashdata('error','Sorry you dont have the permission to access this page');
            redirect('404');
        }
        if ($this->m_teacher->delete($teacher_id)!=FALSE) {
            $path = $_SERVER['DOCUMENT_ROOT'].'/assets/teacher/'.$data['data']->image;
            unlink($path);
            $this->session->set_flashdata('success', 'Teacher deleted Successfully');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('error', 'Something went wrong please try again!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

}
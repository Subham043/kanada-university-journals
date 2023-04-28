<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Designation extends CI_Controller {

	/*--construct--*/
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('admin_id') == '') {$this->session->set_flashdata('error', 'Oops you need to be logged in order to access the page!'); redirect('login'); }
    
        $this->load->model('m_designation');
        $this->load->library('form_validation');

    }
    /**
     * Admin login-> load view page
     * url : login
    **/

    public function lists()
	{
		$data['title'] = 'Designation - Kannada University';
		$data['page_name'] = 'Designation';

        $this->load->library('pagination');

        $config['base_url'] = base_url('admin/designation/list');
        $config['total_rows'] = $this->m_designation->get_count();
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

        $data['data'] = $this->m_designation->get_list($config["per_page"], $page);

        $this->load->view('pages/designation/list.php', $data);
    }

	public function create()
	{
		$data['title'] = 'Designation - Kannada University';
		$data['page_name'] = 'Designation';

        $this->security->xss_clean($_POST);
        $this->form_validation->set_rules('code', 'Designation Code', 'trim|required|min_length[3]|max_length[200]|is_unique[designation.code]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s', 'is_unique'=>'This designation code is already in use'));
        $this->form_validation->set_rules('name', 'Designation Name', 'trim|required|min_length[3]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
        if($this->form_validation->run()){
            $request['code'] = $this->input->post('code');
            $request['name'] = $this->input->post('name');
            if ($this->m_designation->create($request)) {
                $this->session->set_flashdata('success', 'Designation created Successfully');
                redirect('admin/designation/create', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong please try again!');
                redirect('admin/designation/create', 'refresh');
            }
        }else{
            $this->load->view('pages/designation/create.php', $data);
        }
		
	}
	
    public function edit($id)
	{
		$data['title'] = 'Designation - Kannada University';
		$data['page_name'] = 'Designation';
		$data['id'] = $id;

        $designation_id = $this->encryption_url->safe_b64decode($id);
        $data['data'] = $this->m_designation->get_data($designation_id);
        if($data['data']==false){
            $this->session->set_flashdata('error','Sorry you dont have the permission to access this page');
            redirect('404');
        }

        $this->security->xss_clean($_POST);

        if($data['data']->code==$this->input->post('code')){
            $this->form_validation->set_rules('code', 'Designation Code', 'trim|required|min_length[3]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s', 'is_unique'=>'This designation code is already in use'));
        }else{
            $this->form_validation->set_rules('code', 'Designation Code', 'trim|required|min_length[3]|max_length[200]|is_unique[designation.code]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s', 'is_unique'=>'This designation code is already in use'));
        }

        $this->form_validation->set_rules('name', 'Designation Name', 'trim|required|min_length[3]|max_length[200]|regex_match[/^[a-z 0-9~%.:_\@\-\/\&+=,]+$/i]', array('regex_match' => 'Enter a valid %s'));
        if($this->form_validation->run()){
            $request['code'] = $this->input->post('code');
            $request['name'] = $this->input->post('name');
            if ($this->m_designation->update($designation_id, $request)!=FALSE) {
                $this->session->set_flashdata('success', 'Designation update Successfully');
                redirect('admin/designation/edit/'.$this->encryption_url->safe_b64encode($designation_id), 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong please try again!');
                redirect('admin/designation/edit/'.$this->encryption_url->safe_b64encode($designation_id), 'refresh');
            }
        }else{
            $this->load->view('pages/designation/edit.php', $data);
        }
		
	}

    public function delete($id)
	{
        $designation_id = $this->encryption_url->safe_b64decode($id);
        $data['data'] = $this->m_designation->get_data($designation_id);
        if($data['data']==false){
            $this->session->set_flashdata('error','Sorry you dont have the permission to access this page');
            redirect('404');
        }
        if ($this->m_designation->delete($designation_id)!=FALSE) {
            $this->session->set_flashdata('success', 'Designation deleted Successfully');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('error', 'Something went wrong please try again!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

}
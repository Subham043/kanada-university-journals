<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_keyword extends CI_Model {

	/**
	*Change pasword -> Update New password
	* @url : change-password
	*/

	public function create($data = null)
	{
		$this->db->insert('keyword',$data);
        $insertId = $this->db->insert_id();
        if ($insertId) {
            return $insertId;
        }else{
            return false;
        }
	}

	public function get_data($id = null)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('keyword');
		if($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return false;
		}
	}

	public function update($id, $data = null)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('keyword');
		if($query->num_rows() > 0)
		{
			$this->db->where('id', $id);
			$this->db->update('keyword',  $data);
			return true;
		} else {
			return false;
		}
	}
	
	public function delete($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('keyword');
		if($query->num_rows() > 0)
		{
			$this->db->where('id', $id);
			$this->db->delete('keyword');
			return true;
		} else {
			return false;
		}
	}
	
	public function get_count() {
        return $this->db->count_all('keyword');
    }

    public function get_list($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get('keyword');

        return $query->result();
    }

}

/* End of file M_account.php */
/* Location: ./application/models/M_account.php */
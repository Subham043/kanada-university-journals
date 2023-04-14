<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_book_article extends CI_Model {

	/**
	*Change pasword -> Update New password
	* @url : change-password
	*/

	public function create($data = null)
	{
		$this->db->insert('book_article',$data);
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
		$query = $this->db->get('book_article');
		if($query->num_rows() > 0)
		{
			return $query->row();
		} else {
			return false;
		}
	}

	public function get_all()
	{
		$query = $this->db->get('book_article');
		return $query->result();
	}

	public function update($id, $data = null)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('book_article');
		if($query->num_rows() > 0)
		{
			$this->db->where('id', $id);
			$this->db->update('book_article',  $data);
			return true;
		} else {
			return false;
		}
	}
	
	public function delete($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('book_article');
		if($query->num_rows() > 0)
		{
			$this->db->where('id', $id);
			$this->db->delete('book_article');
			return true;
		} else {
			return false;
		}
	}
	
	public function get_count() {
        return $this->db->count_all('book_article');
    }

    public function get_list($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get('book_article');

        return $query->result();
    }

}

/* End of file M_account.php */
/* Location: ./application/models/M_account.php */
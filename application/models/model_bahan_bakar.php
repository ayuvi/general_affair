<?php
class Model_bahan_bakar extends CI_Model
{
	public function getAllbahan_bakar($show=null, $start=null, $cari=null)
	{
		$this->db->select("a.*");
		$this->db->from("ref_bahan_bakar a");
		$session = $this->session->userdata('login');
		$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
		$this->db->where("(a.nm_bahan_bakar  LIKE '%".$cari."%' ) ");
		$this->db->where("a.active IN (0, 1) ");

		if ($show == null && $start == null) {
		} else {
			$this->db->limit($show, $start);
		}

		return $this->db->get();
	}

	public function get_count_bahan_bakar($search = null)
	{
		$count = array();
		$session = $this->session->userdata('login');

		$this->db->select(" COUNT(id_bahan_bakar) as recordsFiltered ");
		$this->db->from("ref_bahan_bakar");
		$this->db->where('id_perusahaan', $session['id_perusahaan']);
		$this->db->where("active != '2' ");
		$this->db->like("nm_bahan_bakar ", $search);
		$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];

		$this->db->select(" COUNT(id_bahan_bakar) as recordsTotal ");
		$this->db->from("ref_bahan_bakar");
		$this->db->where('id_perusahaan', $session['id_perusahaan']);
		$this->db->where("active != '2' ");
		$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];

		return $count;
	}

	public function insert_bahan_bakar($data)
	{
		$this->db->insert('ref_bahan_bakar', $data);
		return $this->db->insert_id();
	}

	public function delete_bahan_bakar($data)
	{
		$session = $this->session->userdata('login');
		$this->db->where('id_perusahaan', $session['id_perusahaan']);
		$this->db->where('id_bahan_bakar', $data['id_bahan_bakar']);
		$this->db->update('ref_bahan_bakar', array('active' => '2'));
		return $data['id_bahan_bakar'];
	}

	public function update_bahan_bakar($data)
	{
		$session = $this->session->userdata('login');
		$this->db->where('id_perusahaan', $session['id_perusahaan']);
		$this->db->where('id_bahan_bakar', $data['id_bahan_bakar']);
		$this->db->where("active != '2' ");
		$this->db->update('ref_bahan_bakar', $data);
		return $data['id_bahan_bakar'];
	}

	public function get_bahan_bakar_by_id($id_bahan_bakar)
	{
		if(empty($id_bahan_bakar))
		{
			return array();
		}
		else
		{
			$session = $this->session->userdata('login');
			$this->db->from("ref_bahan_bakar a");
			$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
			$this->db->where('a.id_bahan_bakar', $id_bahan_bakar);
			$this->db->where("a.active != '2' ");
			return $this->db->get()->row_array();
		}
	}

}

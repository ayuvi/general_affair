<?php
class Model_jenis_armada extends CI_Model
{
	public function getAlljenis_armada($show=null, $start=null, $cari=null)
	{
		$this->db->select("a.*");
		$this->db->from("ref_jenis_armada a");
		$session = $this->session->userdata('login');
		$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
		$this->db->where("(a.nm_jenis_armada  LIKE '%".$cari."%' ) ");
		$this->db->where("a.active IN (0, 1) ");

		if ($show == null && $start == null) {
		} else {
			$this->db->limit($show, $start);
		}

		return $this->db->get();
	}

	public function get_count_jenis_armada($search = null)
	{
		$count = array();
		$session = $this->session->userdata('login');

		$this->db->select(" COUNT(id_jenis_armada) as recordsFiltered ");
		$this->db->from("ref_jenis_armada");
		$this->db->where('id_perusahaan', $session['id_perusahaan']);
		$this->db->where("active != '2' ");
		$this->db->like("nm_jenis_armada ", $search);
		$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];

		$this->db->select(" COUNT(id_jenis_armada) as recordsTotal ");
		$this->db->from("ref_jenis_armada");
		$this->db->where('id_perusahaan', $session['id_perusahaan']);
		$this->db->where("active != '2' ");
		$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];

		return $count;
	}

	public function insert_jenis_armada($data)
	{
		$this->db->insert('ref_jenis_armada', $data);
		return $this->db->insert_id();
	}

	public function delete_jenis_armada($data)
	{
		$session = $this->session->userdata('login');
		$this->db->where('id_perusahaan', $session['id_perusahaan']);
		$this->db->where('id_jenis_armada', $data['id_jenis_armada']);
		$this->db->update('ref_jenis_armada', array('active' => '2'));
		return $data['id_jenis_armada'];
	}

	public function update_jenis_armada($data)
	{
		$session = $this->session->userdata('login');
		$this->db->where('id_perusahaan', $session['id_perusahaan']);
		$this->db->where('id_jenis_armada', $data['id_jenis_armada']);
		$this->db->where("active != '2' ");
		$this->db->update('ref_jenis_armada', $data);
		return $data['id_jenis_armada'];
	}

	public function get_jenis_armada_by_id($id_jenis_armada)
	{
		if(empty($id_jenis_armada))
		{
			return array();
		}
		else
		{
			$session = $this->session->userdata('login');
			$this->db->from("ref_jenis_armada a");
			$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
			$this->db->where('a.id_jenis_armada', $id_jenis_armada);
			$this->db->where("a.active != '2' ");
			return $this->db->get()->row_array();
		}
	}

}

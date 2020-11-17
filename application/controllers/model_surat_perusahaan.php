<?php
class Model_surat_perusahaan extends CI_Model
{
	public function getAllsurat_perusahaan($show=null, $start=null, $cari=null)
	{
		$this->db->select("a.*");
		$this->db->from("ref_surat_perusahaan a");
		$session = $this->session->userdata('login');
		$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
		$this->db->where("(a.nm_surat_perusahaan  LIKE '%".$cari."%' ) ");
		$this->db->where("a.active IN (0, 1) ");

		if ($show == null && $start == null) {
		} else {
			$this->db->limit($show, $start);
		}

		return $this->db->get();
	}

	public function get_count_surat_perusahaan($search = null)
	{
		$count = array();
		$session = $this->session->userdata('login');

		$this->db->select(" COUNT(id_surat_perusahaan) as recordsFiltered ");
		$this->db->from("ref_surat_perusahaan");
		$this->db->where('id_perusahaan', $session['id_perusahaan']);
		$this->db->where("active != '2' ");
		$this->db->like("nm_surat_perusahaan ", $search);
		$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];

		$this->db->select(" COUNT(id_surat_perusahaan) as recordsTotal ");
		$this->db->from("ref_surat_perusahaan");
		$this->db->where('id_perusahaan', $session['id_perusahaan']);
		$this->db->where("active != '2' ");
		$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];

		return $count;
	}

	public function insert_surat_perusahaan($data)
	{
		$this->db->insert('ref_surat_perusahaan', $data);
		return $this->db->insert_id();
	}

	public function delete_surat_perusahaan($data)
	{
		$session = $this->session->userdata('login');
		$this->db->where('id_perusahaan', $session['id_perusahaan']);
		$this->db->where('id_surat_perusahaan', $data['id_surat_perusahaan']);
		$this->db->update('ref_surat_perusahaan', array('active' => '2'));
		return $data['id_surat_perusahaan'];
	}

	public function update_surat_perusahaan($data)
	{
		$session = $this->session->userdata('login');
		$this->db->where('id_perusahaan', $session['id_perusahaan']);
		$this->db->where('id_surat_perusahaan', $data['id_surat_perusahaan']);
		$this->db->where("active != '2' ");
		$this->db->update('ref_surat_perusahaan', $data);
		return $data['id_surat_perusahaan'];
	}

	public function get_surat_perusahaan_by_id($id_surat_perusahaan)
	{
		if(empty($id_surat_perusahaan))
		{
			return array();
		}
		else
		{
			$session = $this->session->userdata('login');
			$this->db->from("ref_surat_perusahaan a");
			$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
			$this->db->where('a.id_surat_perusahaan', $id_surat_perusahaan);
			$this->db->where("a.active != '2' ");
			return $this->db->get()->row_array();
		}
	}

}

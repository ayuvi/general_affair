<?php
class Model_jenis_surat extends CI_Model
{
	public function getAlljenis_surat($show=null, $start=null, $cari=null)
	{
		$this->db->select("a.*");
		$this->db->from("ref_jenis_surat a");
		$session = $this->session->userdata('login');
		$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
		$this->db->where("(a.nm_jenis_surat  LIKE '%".$cari."%' ) ");
		$this->db->where("a.active IN (0, 1) ");

		if ($show == null && $start == null) {
		} else {
			$this->db->limit($show, $start);
		}

		return $this->db->get();
	}

	public function get_count_jenis_surat($search = null)
	{
		$count = array();
		$session = $this->session->userdata('login');

		$this->db->select(" COUNT(id_jenis_surat) as recordsFiltered ");
		$this->db->from("ref_jenis_surat");
		$this->db->where('id_perusahaan', $session['id_perusahaan']);
		$this->db->where("active != '2' ");
		$this->db->like("nm_jenis_surat ", $search);
		$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];

		$this->db->select(" COUNT(id_jenis_surat) as recordsTotal ");
		$this->db->from("ref_jenis_surat");
		$this->db->where('id_perusahaan', $session['id_perusahaan']);
		$this->db->where("active != '2' ");
		$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];

		return $count;
	}

	public function insert_jenis_surat($data)
	{
		$this->db->insert('ref_jenis_surat', $data);
		return $this->db->insert_id();
	}

	public function delete_jenis_surat($data)
	{
		$session = $this->session->userdata('login');
		$this->db->where('id_perusahaan', $session['id_perusahaan']);
		$this->db->where('id_jenis_surat', $data['id_jenis_surat']);
		$this->db->update('ref_jenis_surat', array('active' => '2'));
		return $data['id_jenis_surat'];
	}

	public function update_jenis_surat($data)
	{
		$session = $this->session->userdata('login');
		$this->db->where('id_perusahaan', $session['id_perusahaan']);
		$this->db->where('id_jenis_surat', $data['id_jenis_surat']);
		$this->db->where("active != '2' ");
		$this->db->update('ref_jenis_surat', $data);
		return $data['id_jenis_surat'];
	}

	public function get_jenis_surat_by_id($id_jenis_surat)
	{
		if(empty($id_jenis_surat))
		{
			return array();
		}
		else
		{
			$session = $this->session->userdata('login');
			$this->db->from("ref_jenis_surat a");
			$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
			$this->db->where('a.id_jenis_surat', $id_jenis_surat);
			$this->db->where("a.active != '2' ");
			return $this->db->get()->row_array();
		}
	}

}

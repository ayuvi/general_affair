<?php
class Model_list_peralatan extends CI_Model
{
	public function getAlllist_peralatan($show=null, $start=null, $cari=null)
	{
		$this->db->select("a.*");
		$this->db->from("ref_list_peralatan a");
		$session = $this->session->userdata('login');
		$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
		$this->db->where("(a.nm_kategori  LIKE '%".$cari."%' ) ");
		$this->db->where("a.active IN (0, 1) ");

		if ($show == null && $start == null) {
		} else {
			$this->db->limit($show, $start);
		}

		return $this->db->get();
	}

	public function get_count_list_peralatan($search = null)
	{
		$count = array();
		$session = $this->session->userdata('login');

		$this->db->select("COUNT(id_peralatan) as recordsFiltered ");
		$this->db->from("ref_list_peralatan");
		$this->db->where('id_perusahaan', $session['id_perusahaan']);
		$this->db->where("active != '2' ");
		$this->db->like("nm_kategori ", $search);
		$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];

		$this->db->select(" COUNT(id_peralatan) as recordsTotal ");
		$this->db->from("ref_list_peralatan");
		$this->db->where('id_perusahaan', $session['id_perusahaan']);
		$this->db->where("active != '2' ");
		$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];

		return $count;
	}


	public function getAlllist_peralatan_foto($show=null, $start=null, $cari=null,$id_peralatan)
	{
		$this->db->select("a.*");
		$this->db->from("ref_list_peralatan_foto a");
		$this->db->where('a.id_peralatan', $id_peralatan);
		$this->db->where("(a.nm_peralatan_foto  LIKE '%".$cari."%' ) ");

		if ($show == null && $start == null) {
		} else {
			$this->db->limit($show, $start);
		}

		return $this->db->get();
	}

	public function get_count_list_peralatan_foto($search = null,$id_peralatan)
	{
		$count = array();
		$session = $this->session->userdata('login');

		$this->db->select("COUNT(id_peralatan_foto) as recordsFiltered ");
		$this->db->from("ref_list_peralatan_foto");
		$this->db->where('id_peralatan', $id_peralatan);
		$this->db->like("nm_peralatan_foto ", $search);
		$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];

		$this->db->select(" COUNT(id_peralatan_foto) as recordsTotal ");
		$this->db->from("ref_list_peralatan_foto");
		$this->db->where('id_peralatan', $id_peralatan);
		$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];

		return $count;
	}

	public function insert_list_peralatan($data)
	{
		$this->db->insert('ref_list_peralatan', $data);
		return $this->db->insert_id();
	}

	public function insert_list_peralatan_foto($data)
	{
		$this->db->insert('ref_list_peralatan_foto', $data);
		return $this->db->insert_id();
	}

	public function delete_list_peralatan($data)
	{
		$session = $this->session->userdata('login');
		$this->db->where('id_perusahaan', $session['id_perusahaan']);
		$this->db->where('id_peralatan', $data['id_peralatan']);
		$this->db->delete('ref_list_peralatan');
		return $data['id_peralatan'];
	}

		public function delete_list_peralatan_foto($data)
	{
		$this->db->where('id_peralatan_foto', $data['id_peralatan_foto']);
		$this->db->delete('ref_list_peralatan_foto');
		return $data['id_peralatan_foto'];
	}

	public function update_list_peralatan($data)
	{
		$session = $this->session->userdata('login');
		$this->db->where('id_perusahaan', $session['id_perusahaan']);
		$this->db->where('id_peralatan', $data['id_peralatan']);
		$this->db->update('ref_list_peralatan', $data);
		return $data['id_peralatan'];
	}

	public function get_list_peralatan_by_id($id_peralatan)
	{
		if(empty($id_peralatan))
		{
			return array();
		}
		else
		{
			$session = $this->session->userdata('login');
			$this->db->from("ref_list_peralatan a");
			$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
			$this->db->where('a.id_peralatan', $id_peralatan);
			return $this->db->get()->row_array();
		}
	}

	public function combobox_kategori()
	{
		$session = $this->session->userdata('login');
		$this->db->from("ref_kategori b");
		$this->db->where('b.id_perusahaan', $session['id_perusahaan']);
		$this->db->where('b.active', 1);

		return $this->db->get();
	}
	public function combobox_posisi_barang()
	{
		$session = $this->session->userdata('login');
		$this->db->from("ref_posisi_barang b");
		$this->db->where('b.id_perusahaan', $session['id_perusahaan']);
		$this->db->where('b.active', 1);

		return $this->db->get();
	}

	public function combobox_kategori_sub($id_kategori){
		$this->db->from("ref_kategori_sub a");
		if ($id_kategori=='0') {
		} else {
			$this->db->where('id_kategori', $id_kategori);
		}
		return $this->db->get();
	}


}

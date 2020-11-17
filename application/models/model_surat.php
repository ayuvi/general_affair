<?php
class Model_surat extends CI_Model
{
 public function getAllsurat($show=null, $start=null, $cari=null)
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

public function get_count_surat($search = null)
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

public function getAllsurat_hgb($show=null, $start=null, $cari=null,$id_bu,$id_jenis_surat)
{
    $this->db->select("a.*");
    $this->db->from("ref_surat_hgb a");
    $session = $this->session->userdata('login');
    $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
    $this->db->where('a.id_bu', $id_bu);
    $this->db->where('a.id_jenis_surat', $id_jenis_surat);
    $this->db->where("(a.no_hgb  LIKE '%".$cari."%' OR a.no_surat_ukur  LIKE '%".$cari."%' OR a.nm_penunjuk_batas  LIKE '%".$cari."%') ");
    $this->db->where("a.active IN (0, 1) ");

    if ($show == null && $start == null) {
    } else {
        $this->db->limit($show, $start);
    }

    return $this->db->get();
}

public function get_count_surat_hgb($cari = null,$id_bu,$id_jenis_surat)
{
    $count = array();
    $session = $this->session->userdata('login');

    $this->db->select(" COUNT(id_surat_hgb) as recordsFiltered ");
    $this->db->from("ref_surat_hgb");
    $this->db->where('id_perusahaan', $session['id_perusahaan']);
    $this->db->where("active != '2' ");
    $this->db->where('id_bu', $id_bu);
    $this->db->where('id_jenis_surat', $id_jenis_surat);
    $this->db->where("(no_hgb  LIKE '%".$cari."%' OR no_surat_ukur  LIKE '%".$cari."%' OR nm_penunjuk_batas  LIKE '%".$cari."%') ");
    $count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];

    $this->db->select(" COUNT(id_surat_hgb) as recordsTotal ");
    $this->db->from("ref_surat_hgb");
    $this->db->where('id_perusahaan', $session['id_perusahaan']);
    $this->db->where("active != '2' ");
    $this->db->where('id_bu', $id_bu);
    $this->db->where('id_jenis_surat', $id_jenis_surat);
    $count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];

    return $count;
}

public function getAllsurat_hgb_attachment($show=null, $start=null, $cari=null,$id_surat_hgb)
{
    $this->db->select("a.*");
    $this->db->from("ref_surat_attachment_hgb a");
    $session = $this->session->userdata('login');
    $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
    $this->db->where('a.id_surat_hgb', $id_surat_hgb);
    $this->db->where("(a.nm_attachment  LIKE '%".$cari."%' ) ");
    $this->db->where("a.active IN (0, 1) ");

    if ($show == null && $start == null) {
    } else {
        $this->db->limit($show, $start);
    }

    return $this->db->get();
}

public function get_count_surat_hgb_attachment($cari = null,$id_surat_hgb)
{
    $count = array();
    $session = $this->session->userdata('login');

    $this->db->select(" COUNT(id_surat_attachment) as recordsFiltered ");
    $this->db->from("ref_surat_attachment_hgb");
    $this->db->where('id_perusahaan', $session['id_perusahaan']);
    $this->db->where("active != '2' ");
    $this->db->where('id_surat_hgb', $id_surat_hgb);
    $this->db->where("(nm_attachment  LIKE '%".$cari."%' ) ");
    $count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];

    $this->db->select(" COUNT(id_surat_attachment) as recordsTotal ");
    $this->db->from("ref_surat_attachment_hgb");
    $this->db->where('id_perusahaan', $session['id_perusahaan']);
    $this->db->where("active != '2' ");
    $this->db->where('id_surat_hgb', $id_surat_hgb);
    $count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];

    return $count;
}



public function getAllsurat_pbb($show=null, $start=null, $cari=null,$id_bu,$id_jenis_surat)
{
    $this->db->select("a.*");
    $this->db->from("ref_surat_pbb a");
    $session = $this->session->userdata('login');
    $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
    $this->db->where('a.id_bu', $id_bu);
    $this->db->where('a.id_jenis_surat', $id_jenis_surat);
    $this->db->where("(a.lokasi_objek_pajak  LIKE '%".$cari."%' OR a.objek_pajak  LIKE '%".$cari."%' OR a.alamat_wp  LIKE '%".$cari."%' OR a.nama_wp  LIKE '%".$cari."%') ");
    $this->db->where("a.active IN (0, 1) ");

    if ($show == null && $start == null) {
    } else {
        $this->db->limit($show, $start);
    }

    return $this->db->get();
}

public function get_count_surat_pbb($cari = null,$id_bu,$id_jenis_surat)
{
    $count = array();
    $session = $this->session->userdata('login');

    $this->db->select(" COUNT(id_surat_pbb) as recordsFiltered ");
    $this->db->from("ref_surat_pbb");
    $this->db->where('id_perusahaan', $session['id_perusahaan']);
    $this->db->where("active != '2' ");
    $this->db->where('id_bu', $id_bu);
    $this->db->where('id_jenis_surat', $id_jenis_surat);
    $this->db->where("(lokasi_objek_pajak  LIKE '%".$cari."%' OR objek_pajak  LIKE '%".$cari."%' OR alamat_wp  LIKE '%".$cari."%' OR nama_wp  LIKE '%".$cari."%') ");
    $count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];

    $this->db->select(" COUNT(id_surat_pbb) as recordsTotal ");
    $this->db->from("ref_surat_pbb");
    $this->db->where('id_perusahaan', $session['id_perusahaan']);
    $this->db->where("active != '2' ");
    $this->db->where('id_bu', $id_bu);
    $this->db->where('id_jenis_surat', $id_jenis_surat);
    $count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];

    return $count;
}

public function getAllsurat_pbb_attachment($show=null, $start=null, $cari=null,$id_surat_pbb)
{
    $this->db->select("a.*");
    $this->db->from("ref_surat_attachment_pbb a");
    $session = $this->session->userdata('login');
    $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
    $this->db->where('a.id_surat_pbb', $id_surat_pbb);
    $this->db->where("(a.nm_attachment  LIKE '%".$cari."%' ) ");
    $this->db->where("a.active IN (0, 1) ");

    if ($show == null && $start == null) {
    } else {
        $this->db->limit($show, $start);
    }

    return $this->db->get();
}

public function get_count_surat_pbb_attachment($cari = null,$id_surat_pbb)
{
    $count = array();
    $session = $this->session->userdata('login');

    $this->db->select(" COUNT(id_surat_attachment) as recordsFiltered ");
    $this->db->from("ref_surat_attachment_pbb");
    $this->db->where('id_perusahaan', $session['id_perusahaan']);
    $this->db->where("active != '2' ");
    $this->db->where('id_surat_pbb', $id_surat_pbb);
    $this->db->where("(nm_attachment  LIKE '%".$cari."%' ) ");
    $count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];

    $this->db->select(" COUNT(id_surat_attachment) as recordsTotal ");
    $this->db->from("ref_surat_attachment_pbb");
    $this->db->where('id_perusahaan', $session['id_perusahaan']);
    $this->db->where("active != '2' ");
    $this->db->where('id_surat_pbb', $id_surat_pbb);
    $count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];

    return $count;
}


public function insert_surat($data)
{
    $this->db->insert('ref_surat', $data);
    return $this->db->insert_id();
}

public function insert_surat_access($data)
{
    $this->db->insert('ref_surat_access', $data);
    return $this->db->insert_id();
}


public function delete_surat($data)
{
    $this->db->where('id_surat', $data['id_surat']);
    $this->db->delete('ref_surat');
    return $data['id_surat'];
}

public function delete_surat_access($data)
{
    $session = $this->session->userdata('login');
    $this->db->where('id_perusahaan', $session['id_perusahaan']);
    $this->db->where('id_surat_access', $data['id_surat_access']);
    $this->db->delete('ref_surat_access');
    return $data['id_surat_access'];
}

public function update_surat($data)
{
    $session = $this->session->userdata('login');
    $this->db->where('id_perusahaan', $session['id_perusahaan']);
    $this->db->where('id_surat', $data['id_surat']);
    $this->db->where("active != '2' ");
    $this->db->update('ref_surat', $data);
    return $data['id_surat'];
}


public function update_surat_hgb($data)
{
    $this->db->where('id_surat_hgb', $data['id_surat_hgb']);
    $this->db->where("active != '2' ");
    $this->db->update('ref_surat_hgb', $data);
    return $data['id_surat_hgb'];
}


public function get_surat_by_id($id_surat)
{
 if(empty($id_surat))
 {
    return array();
}
else
{
    $session = $this->session->userdata('login');
    $this->db->select("a.*");
    $this->db->from("ref_surat a");
    $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
    $this->db->where('a.id_surat', $id_surat);
    $this->db->where("a.active != '2' ");
    return $this->db->get()->row_array();
}
}


public function get_surat_by_id_surat_hgb($id_surat_hgb)
{
 if(empty($id_surat_hgb))
 {
    return array();
}
else
{
    $this->db->select("a.*");
    $this->db->from("ref_surat_hgb a");
    $this->db->where('a.id_surat_hgb', $id_surat_hgb);
    $this->db->where("a.active != '2' ");
    return $this->db->get()->row_array();
}
}

public function get_surat_by_id_surat_pbb($id_surat_pbb)
{
 if(empty($id_surat_pbb))
 {
    return array();
}
else
{
    $this->db->select("a.*");
    $this->db->from("ref_surat_pbb a");
    $this->db->where('a.id_surat_pbb', $id_surat_pbb);
    $this->db->where("a.active != '2' ");
    return $this->db->get()->row_array();
}
}

public function get_surat_access_by_id($id_surat_access)
{
    if(empty($id_surat_access))
    {
        return array();
    }
    else
    {
        $session = $this->session->userdata('login');
        $this->db->select("a.*, b.nm_user");
        $this->db->from("ref_surat_access a");
        $this->db->join("ref_user b", "a.id_user = b.id_user", "left");
        $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
        $this->db->where('a.id_surat_access', $id_surat_access);
        $this->db->where("a.active != '2' ");
        return $this->db->get()->row_array();
    }
}



public function combobox_bu()
{
    $session = $this->session->userdata('login');
    $this->db->from("ref_bu_access b");
    $this->db->join("ref_bu a", "b.id_bu = a.id_bu", "left");
    $this->db->where('b.id_perusahaan', $session['id_perusahaan']);
    $this->db->where('b.id_user', $session['id_user']);
    $this->db->where('b.active', 1);

    return $this->db->get();
}

public function combobox_jenis_surat()
{
    $session = $this->session->userdata('login');
    $this->db->from("ref_jenis_surat b");
    $this->db->where('b.id_perusahaan', $session['id_perusahaan']);
    $this->db->where('b.active', 1);

    return $this->db->get();
}

public function combobox_user()
{
    $this->db->from("ref_user");
    $session = $this->session->userdata('login');
    $this->db->where('id_perusahaan', $session['id_perusahaan']);
    $this->db->where('active', 1);
    return $this->db->get();
}

public function combobox_prov()
{
    $query = $this->db->query("SELECT * FROM ref_prov ORDER BY id_prov ASC");
    $dropdowns = $query->result();
    if(! $dropdowns){
        $finaldropdown[''] = " - Pilih - ";
        return $finaldropdown;
    }
    else{
        foreach ($dropdowns as $dropdown){
            $dropdownlist[$dropdown->id_prov] = $dropdown->nama;
        }
        $finaldropdown = $dropdownlist;
        $finaldropdown[''] = " - Pilih - ";
        return $finaldropdown;
    }
}

public function get_chain_kab($id='')
{
    $query = $this->db->query("SELECT * FROM ref_kab WHERE id_prov = ".$this->db->escape($id)." ");
    return $kab = $query->result();
}

public function get_chain_kec($id='')
{
    $query = $this->db->query("SELECT * FROM ref_kec WHERE id_kab = ".$this->db->escape($id)." ");
    return $kec = $query->result();
}

public function get_chain_kel($id='')
{
    $query = $this->db->query("SELECT * FROM ref_kel WHERE id_kec = ".$this->db->escape($id)." ");
    return $kel = $query->result();
}


}

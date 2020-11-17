<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class surat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("model_surat");
        $this->load->model("model_menu");
        ///constructor yang dipanggil ketika memanggil ro.php untuk melakukan pemanggilan pada model : ro.php yang ada di folder models
    }

    public function index()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S11";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {
                $data['id_user'] = $session['id_user'];
                $data['nm_user'] = $session['nm_user'];
                $data['session_level'] = $session['id_level'];
                $data['combobox_bu'] = $this->model_surat->combobox_bu();
                $data['combobox_jenis_surat'] = $this->model_surat->combobox_jenis_surat();
                $this->load->view('surat/index', $data);
            } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.surat.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
    }
    

    public function ax_data_surat()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S11";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $id_bu = $this->input->post('id_bu');
                $start = $this->input->post('start');
                $draw = $this->input->post('draw');
                $length = $this->input->post('length');
                $cari = $this->input->post('search', true);
                $data = $this->model_surat->getAllsurat($length, $start, $cari['value'],$id_bu)->result_array();
                $count = $this->model_surat->get_count_surat($cari['value'],$id_bu);

                echo json_encode(array('recordsTotal' => $count['recordsTotal'], 'recordsFiltered' => $count['recordsFiltered'], 'draw' => $draw, 'search' => $cari['value'], 'data' => $data));
            } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.surat.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
    }
    

    public function ax_set_data()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S11";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $id_surat = $this->input->post('id_surat');
                $id_bu = $this->input->post('id_bu');
                $id_jenis_surat = $this->input->post('id_jenis_surat');
                $tgl_terbit = $this->input->post('tgl_terbit');
                $tgl_berakhir = $this->input->post('tgl_berakhir');
                $tgl_jatuh_tempo = $this->input->post('tgl_jatuh_tempo');
                $active = $this->input->post('active');

                $session = $this->session->userdata('login');
                $data = array(
                    'id_surat' => $id_surat,
                    'id_bu' => $id_bu,
                    'id_jenis_surat' => $id_jenis_surat,
                    'tgl_terbit' => $tgl_terbit,
                    'tgl_berakhir' => $tgl_berakhir,
                    'tgl_jatuh_tempo' => $tgl_jatuh_tempo,
                    'active' => $active,
                    'cuser' => $session['id_user'],
                    'id_perusahaan' => $session['id_perusahaan'],
                    );

                if(empty($id_surat)){
                    $data['id_surat'] = $this->model_surat->insert_surat($data);
                }
                else
                {
                    $data['id_surat'] = $this->model_surat->update_surat($data);
                }

                echo json_encode(array('status' => 'success', 'data' => $data));

            } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.surat.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
    }

    
    
    public function ax_unset_data()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S11";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $id_surat = $this->input->post('id_surat');

                $data = array('id_surat' => $id_surat);

                if(!empty($id_surat))
                    $data['id_surat'] = $this->model_surat->delete_surat($data);

                echo json_encode(array('status' => 'success', 'data' => $data));

            } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.surat.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
    }
    
    public function ax_get_data_by_id()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S11";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $id_surat = $this->input->post('id_surat');

                if(empty($id_surat))
                    $data = array();
                else
                    $data = $this->model_surat->get_surat_by_id($id_surat);

                echo json_encode($data);

            } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.surat.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
    }


//SURAT HGB
    public function hgb($id_jenis_surat,$id_bu)
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S11";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {
                $data['id_user'] = $session['id_user'];
                $data['nm_user'] = $session['nm_user'];
                $data['session_level'] = $session['id_level'];

                $data['id_jenis_surat_filter']  = $id_jenis_surat;
                $data['id_bu_filter']           = $id_bu;

                $data['combobox_prov'] = $this->model_surat->combobox_prov();
                $data['combobox_kab'] = [];
                $data['combobox_kec'] = [];
                $data['combobox_kel'] = [];

                $this->load->view('surat/surat_hgb', $data);
            } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.surat.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
    }

    public function get_chain_kab($id){
        $data_id = $this->model_surat->get_chain_kab($id);
        echo json_encode($data_id);
    }

    public function get_chain_kec($id){
        $data_id = $this->model_surat->get_chain_kec($id);
        echo json_encode($data_id);
    }
    
    public function get_chain_kel($id){
        $data_id = $this->model_surat->get_chain_kel($id);
        echo json_encode($data_id);
    }

    public function ax_data_surat_hgb()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S11";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $id_bu = $this->input->post('id_bu');
                $id_jenis_surat = $this->input->post('id_jenis_surat');
                $start = $this->input->post('start');
                $draw = $this->input->post('draw');
                $length = $this->input->post('length');
                $cari = $this->input->post('search', true);
                $data = $this->model_surat->getAllsurat_hgb($length, $start, $cari['value'],$id_bu,$id_jenis_surat)->result_array();
                $count = $this->model_surat->get_count_surat_hgb($cari['value'],$id_bu,$id_jenis_surat);

                echo json_encode(array('recordsTotal' => $count['recordsTotal'], 'recordsFiltered' => $count['recordsFiltered'], 'draw' => $draw, 'search' => $cari['value'], 'data' => $data));
            } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.surat.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
    }

    public function ax_data_surat_hgb_attachment()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S11";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $id_surat_hgb = $this->input->post('id_surat_hgb');
                $start = $this->input->post('start');
                $draw = $this->input->post('draw');
                $length = $this->input->post('length');
                $cari = $this->input->post('search', true);
                $data = $this->model_surat->getAllsurat_hgb_attachment($length, $start, $cari['value'],$id_surat_hgb)->result_array();
                $count = $this->model_surat->get_count_surat_hgb_attachment($cari['value'],$id_surat_hgb);

                echo json_encode(array('recordsTotal' => $count['recordsTotal'], 'recordsFiltered' => $count['recordsFiltered'], 'draw' => $draw, 'search' => $cari['value'], 'data' => $data));
            } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.surat.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
    }

    public function ax_upload_surat()
    {
        ini_set('max_execution_time', 0); //0=NOLIMIT;
        
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S11";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {


            $config['upload_path']="./uploads/surat/"; //path folder file upload
            $config['allowed_types']='pdf|docx|doc|xlsx|xls|pptx|ppt|png|jpeg|jpg'; //type file yang boleh di upload
            $config['encrypt_name'] = TRUE; //enkripsi file name upload
            $config['max_size'] = '1000000';
            
            $this->load->library('upload',$config); //call library upload 
            if($this->upload->do_upload("file_attachment")){ //upload file
                $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload
                
                $id_surat= $this->input->post('id_surat');
                $nm_attachment= $this->input->post('nm_file');
                $attachment= $data['upload_data']['file_name']; //set file name ke variable image
                
                $session = $this->session->userdata('login');
                $data = array(
                    'attachment' => $attachment,
                    );
                
                if(file_exists("./uploads/surat/".$attachment)){
                    echo json_encode(array('status' => 'success', 'data' => $data));
                }else{
                    echo json_encode(array('status' => 'fail', 'data' => $data));
                }
                
                
            }else{
                echo json_encode(array('status' => 'fail', 'data' => 'gagal upload'));
            }
        } else {
            echo "<script>alert('Anda tidak mendapatkan access menu ini');window.location.href='javascript:history.back(-1);'</script>";
        }
    } else {
        if ($this->uri->segment(1) != null) {
            $url = $this->uri->segment(1);
            $url = $url.' '.$this->uri->segment(2);
            $url = $url.' '.$this->uri->segment(3);
            redirect('welcome/relogin/?url='.$url.'', 'refresh');
        } else {
            redirect('welcome/relogin', 'refresh');
        }
    }
}


public function ax_set_data_surat_hgb()
{
    if ($this->session->userdata('login')) {
        $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S11";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                // $id_surat_hgb   = $this->input->post('id_surat_hgb');
                $id_jenis_surat = $this->input->post('id_jenis_surat_filter');
                $id_bu          = $this->input->post('id_bu_filter');
                $no_hgb         = $this->input->post('no_hgb');
                $id_prov        = $this->input->post('prov');
                $id_kab         = $this->input->post('kab');
                $id_kec         = $this->input->post('kec');
                $id_kel             = $this->input->post('kel');
                $atas_nama          = $this->input->post('atas_nama');
                $tgl_terbit         = $this->input->post('tgl_terbit');
                $no_surat_ukur      = $this->input->post('no_surat_ukur');
                $luas               = $this->input->post('luas');
                $nm_penunjuk_batas  = $this->input->post('nm_penunjuk_batas');
                $active             = $this->input->post('active');

                $session = $this->session->userdata('login');
                $data = array(
                    'id_jenis_surat' => $id_jenis_surat,
                    'id_bu' => $id_bu,
                    'no_hgb' => $no_hgb,
                    'id_prov' => $id_prov,
                    'id_kab' => $id_kab,
                    'id_kec' => $id_kec,
                    'id_kel' => $id_kel,

                    'atas_nama' => $atas_nama,
                    'tgl_terbit' => $tgl_terbit,
                    'no_surat_ukur' => $no_surat_ukur,
                    'luas' => $luas,
                    'nm_penunjuk_batas' => $nm_penunjuk_batas,
                    'active' => 1,
                    'cuser' => $session['id_user'],
                    'id_perusahaan' => $session['id_perusahaan'],
                    );

                
                $this->db->insert('ref_surat_hgb', $data);
                $id_surat_hgb = $this->db->insert_id();

                    #ATTACHMENT
                $jmlfile = $this->input->post('jmlfile');
                $nm_file = $this->input->post('nm_file');
                $nm_attach = $this->input->post('nm_attach');
                if(!empty($nm_attach)){
                    $nmfilearr = explode(",",$nm_file);
                    $nmattacharr = explode(",",$nm_attach);
                    
                    $attachment = array(
                        'nm_attachment' => $nmfilearr,
                        'attachment' => $nmattacharr,
                        );
                    
                    $h = -1;
                    foreach($nmfilearr as $attachment) {

                        $h++;
                        $datah = array(
                            'id_surat_hgb' => $id_surat_hgb,
                            'nm_attachment' => $nmfilearr["$h"],
                            'attachment' => $nmattacharr["$h"],
                            'cuser' => $session['id_user'],
                            'id_perusahaan' => $session['id_perusahaan'],
                            'active' => 1,
                            );
                        
                        $this->db->insert('ref_surat_attachment_hgb', $datah);
                        $this->db->insert_id();

                    }
                }

                echo json_encode(array('status' => 'success', 'data' => $data));

            } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.surat.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
    }

    public function ax_set_data_surat_hgb_edit()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S11";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $id_surat_hgb   = $this->input->post('id_surat_hgb_');
                $id_jenis_surat = $this->input->post('id_jenis_surat_filter_');
                $id_bu          = $this->input->post('id_bu_filter_');
                $no_hgb         = $this->input->post('no_hgb_');
                $id_prov        = $this->input->post('prov_');
                $id_kab         = $this->input->post('kab_');
                $id_kec         = $this->input->post('kec_');

                $id_kel             = $this->input->post('kel_');

                $atas_nama          = $this->input->post('atas_nama_');
                $tgl_terbit         = $this->input->post('tgl_terbit_');
                $no_surat_ukur      = $this->input->post('no_surat_ukur_');
                $luas               = $this->input->post('luas_');
                $nm_penunjuk_batas  = $this->input->post('nm_penunjuk_batas_');
                $active             = $this->input->post('active_');

                

                $session = $this->session->userdata('login');
                $data = array(
                    'id_surat_hgb' => $id_surat_hgb,
                    'id_jenis_surat' => $id_jenis_surat,
                    'id_bu' => $id_bu,
                    'no_hgb' => $no_hgb,
                    'id_prov' => $id_prov,
                    'id_kab' => $id_kab,
                    'id_kec' => $id_kec,
                    'id_kel' => $id_kel,
                    'atas_nama' => $atas_nama,
                    'tgl_terbit' => $tgl_terbit,
                    'no_surat_ukur' => $no_surat_ukur,
                    'luas' => $luas,
                    'nm_penunjuk_batas' => $nm_penunjuk_batas,
                    'active' => 1,
                    'cuser' => $session['id_user'],
                    'id_perusahaan' => $session['id_perusahaan'],
                    );

                $this->db->update('ref_surat_hgb', $data, array('id_surat_hgb' => $id_surat_hgb));
                $data['id_surat_hgb'] = $this->db->affected_rows();

                // $data['id_surat_hgb'] = $this->model_surat->update_surat_hgb($data);

                echo json_encode(array('status' => 'success', 'data' => $data));

            } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.surat.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
    }

    public function ax_upload_data_attachment_hgb()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S11";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {


                $config['upload_path']="./uploads/surat/";
                $config['allowed_types']='pdf|docx|doc|xlsx|xls|pptx|ppt|png|jpeg|jpg'; 
                $config['encrypt_name'] = TRUE; 
                $config['max_size'] = 2000; 

                $this->load->library('upload',$config); 
                if($this->upload->do_upload("file")){ 
                    $data = array('upload_data' => $this->upload->data()); 

                    $id_surat_hgb = $this->input->post('id_surat_hgb_attachment');
                    $nm_attachment = $this->input->post('nm_Attachment_edit');
                    $upload = $data['upload_data']['file_name'];
                    $url = './uploads/surat/'.$upload; 

                    $session = $this->session->userdata('login');
                    $data = array(
                        'id_surat_hgb' => $id_surat_hgb,
                        'nm_attachment' => $nm_attachment,
                        'attachment' => $upload,
                        'active' => 1,
                        'cuser' => $session['id_user'],
                        'id_perusahaan' => $session['id_perusahaan'],
                        );

                    if (file_exists($url)) {
                        $this->db->insert('ref_surat_attachment_hgb', $data);
                       $data['id_surat_attachment'] = $this->db->insert_id();

                       echo json_encode(array('status' => 'success', 'data' => $data));
                   } 

               }

           } else {
            echo "<script>alert('Anda tidak mendapatkan access menu ini');window.location.href='javascript:history.back(-1);'</script>";
        }
    } else {
        if ($this->uri->segment(1) != null) {
            $url = $this->uri->segment(1);
            $url = $url.' '.$this->uri->segment(2);
            $url = $url.' '.$this->uri->segment(3);
            redirect('welcome/relogin/?url='.$url.'', 'refresh');
        } else {
            redirect('welcome/relogin', 'refresh');
        }
    }
}



public function ax_unset_data_surat_hgb()
{
    if ($this->session->userdata('login')) {
        $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S11";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $id_surat_hgb = $this->input->post('id_surat_hgb');

                $data = array('id_surat_hgb' => $id_surat_hgb);

                if(!empty($id_surat_hgb))

                    $this->db->from("ref_surat_attachment_hgb a");
                $this->db->where('a.id_surat_hgb', $id_surat_hgb);
                $data_attachment = $this->db->get()->result();

                foreach ($data_attachment as $row) {
                    if(file_exists('uploads/surat/'.$row->attachment) && $row->attachment){
                        unlink('uploads/surat/'.$row->attachment);
                    }
                }
                

                $this->db->where('id_surat_hgb', $data['id_surat_hgb']);
                $data['id_surat_hgb'] = $this->db->delete('ref_surat_hgb');

                echo json_encode(array('status' => 'success', 'data' => $data));

            } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.surat.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
    }

    public function ax_unset_data_surat_hgb_attachment()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S11";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $id_surat_attachment = $this->input->post('id_surat_attachment');
                $attachment = $this->input->post('attachment');

                $data = array('id_surat_attachment' => $id_surat_attachment);

                if(!empty($id_surat_attachment))


                    if(file_exists('uploads/surat/'.$attachment) && $attachment){
                        unlink('uploads/surat/'.$attachment);
                    }

                    $this->db->where('id_surat_attachment', $id_surat_attachment);
                    $data['id_surat_attachment'] = $this->db->delete('ref_surat_attachment_hgb');

                    echo json_encode(array('status' => 'success', 'data' => $data));

                } else {
                    echo "<script>alert('Anda tidak mendapatkan access menu ini');window.surat.href='javascript:history.back(-1);'</script>";
                }
            } else {
                if ($this->uri->segment(1) != null) {
                    $url = $this->uri->segment(1);
                    $url = $url.' '.$this->uri->segment(2);
                    $url = $url.' '.$this->uri->segment(3);
                    redirect('welcome/relogin/?url='.$url.'', 'refresh');
                } else {
                    redirect('welcome/relogin', 'refresh');
                }
            }
        }

        public function ax_get_data_by_id_surat_hgb()
        {
            if ($this->session->userdata('login')) {
                $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S11";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $id_surat_hgb = $this->input->post('id_surat_hgb');

                if(empty($id_surat_hgb))
                    $data = array();
                else
                    $data = $this->model_surat->get_surat_by_id_surat_hgb($id_surat_hgb);

                echo json_encode($data);

            } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.surat.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
    }




    //PBB
    public function pbb($id_jenis_surat,$id_bu)
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S11";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {
                $data['id_user'] = $session['id_user'];
                $data['nm_user'] = $session['nm_user'];
                $data['session_level'] = $session['id_level'];

                $data['id_jenis_surat_filter']  = $id_jenis_surat;
                $data['id_bu_filter']           = $id_bu;

                $this->load->view('surat/surat_pbb', $data);
            } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.surat.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
    }

    public function ax_data_surat_pbb()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S11";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $id_bu = $this->input->post('id_bu');
                $id_jenis_surat = $this->input->post('id_jenis_surat');
                $start = $this->input->post('start');
                $draw = $this->input->post('draw');
                $length = $this->input->post('length');
                $cari = $this->input->post('search', true);
                $data = $this->model_surat->getAllsurat_pbb($length, $start, $cari['value'],$id_bu,$id_jenis_surat)->result_array();
                $count = $this->model_surat->get_count_surat_pbb($cari['value'],$id_bu,$id_jenis_surat);

                echo json_encode(array('recordsTotal' => $count['recordsTotal'], 'recordsFiltered' => $count['recordsFiltered'], 'draw' => $draw, 'search' => $cari['value'], 'data' => $data));
            } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.surat.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
    }

    public function ax_data_surat_pbb_attachment()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S11";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $id_surat_pbb = $this->input->post('id_surat_pbb');
                $start = $this->input->post('start');
                $draw = $this->input->post('draw');
                $length = $this->input->post('length');
                $cari = $this->input->post('search', true);
                $data = $this->model_surat->getAllsurat_pbb_attachment($length, $start, $cari['value'],$id_surat_pbb)->result_array();
                $count = $this->model_surat->get_count_surat_pbb_attachment($cari['value'],$id_surat_pbb);

                echo json_encode(array('recordsTotal' => $count['recordsTotal'], 'recordsFiltered' => $count['recordsFiltered'], 'draw' => $draw, 'search' => $cari['value'], 'data' => $data));
            } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.surat.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
    }


public function ax_set_data_surat_pbb()
{
    if ($this->session->userdata('login')) {
        $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S11";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                // $id_surat_hgb   = $this->input->post('id_surat_hgb');
                $id_jenis_surat     = $this->input->post('id_jenis_surat_filter');
                $id_bu              = $this->input->post('id_bu_filter');
                $tahun              = $this->input->post('tahun');
                $nama_wp            = $this->input->post('nama_wp');
                $alamat_wp          = $this->input->post('alamat_wp');
                $objek_pajak        = $this->input->post('objek_pajak');
                $lokasi_objek_pajak = $this->input->post('lokasi_objek_pajak');
                $luas_tanah         = $this->input->post('luas_tanah');
                $luas_bangunan      = $this->input->post('luas_bangunan');
                $njop_tanah         = $this->input->post('njop_tanah');
                $njop_bangunan      = $this->input->post('njop_bangunan');
                $total_njop         = $this->input->post('total_njop');
                $njop_tidak_kena_pajak = $this->input->post('njop_tidak_kena_pajak');
                $njop_pbb              = $this->input->post('njop_pbb');
                $pbb_terhutang         = $this->input->post('pbb_terhutang');
                $tgl_pembayaran        = $this->input->post('tgl_pembayaran');
                $active                = $this->input->post('active');

                $session = $this->session->userdata('login');
                $data = array(
                    'id_jenis_surat' => $id_jenis_surat,
                    'id_bu'          => $id_bu,
                    'tahun'         => $tahun,
                    'nama_wp'       => $nama_wp,
                    'alamat_wp'     => $alamat_wp,
                    'objek_pajak'   => $objek_pajak,
                    'lokasi_objek_pajak' => $lokasi_objek_pajak,
                    'luas_tanah' => $luas_tanah,
                    'luas_bangunan' => $luas_bangunan,
                    'njop_tanah' => $njop_tanah,
                    'njop_bangunan' => $njop_bangunan,
                    'total_njop' => $total_njop,
                    'njop_tidak_kena_pajak' => $njop_tidak_kena_pajak,
                    'njop_pbb' => $njop_pbb,
                    'pbb_terhutang' => $pbb_terhutang,
                    'tgl_pembayaran' => $tgl_pembayaran,
                    'active' => 1,
                    'cuser' => $session['id_user'],
                    'id_perusahaan' => $session['id_perusahaan'],
                    );

                
                $this->db->insert('ref_surat_pbb', $data);
                $id_surat_pbb = $this->db->insert_id();

                    #ATTACHMENT
                $jmlfile = $this->input->post('jmlfile');
                $nm_file = $this->input->post('nm_file');
                $nm_attach = $this->input->post('nm_attach');
                if(!empty($nm_attach)){
                    $nmfilearr = explode(",",$nm_file);
                    $nmattacharr = explode(",",$nm_attach);
                    
                    $attachment = array(
                        'nm_attachment' => $nmfilearr,
                        'attachment' => $nmattacharr,
                        );
                    
                    $h = -1;
                    foreach($nmfilearr as $attachment) {

                        $h++;
                        $datah = array(
                            'id_surat_pbb' => $id_surat_pbb,
                            'nm_attachment' => $nmfilearr["$h"],
                            'attachment' => $nmattacharr["$h"],
                            'cuser' => $session['id_user'],
                            'id_perusahaan' => $session['id_perusahaan'],
                            'active' => 1,
                            );
                        
                        $this->db->insert('ref_surat_attachment_pbb', $datah);
                        $this->db->insert_id();

                    }
                }

                echo json_encode(array('status' => 'success', 'data' => $data));

            } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.surat.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
    }

    public function ax_set_data_surat_pbb_edit()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S11";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $id_surat_pbb       = $this->input->post('id_surat_pbb_');
                $id_jenis_surat     = $this->input->post('id_jenis_surat_filter_');
                $id_bu              = $this->input->post('id_bu_filter_');
                $tahun              = $this->input->post('tahun_');
                $nama_wp            = $this->input->post('nama_wp_');
                $alamat_wp          = $this->input->post('alamat_wp_');
                $objek_pajak        = $this->input->post('objek_pajak_');
                $lokasi_objek_pajak = $this->input->post('lokasi_objek_pajak_');
                $luas_tanah         = $this->input->post('luas_tanah_');
                $luas_bangunan      = $this->input->post('luas_bangunan_');
                $njop_tanah         = $this->input->post('njop_tanah_');
                $njop_bangunan      = $this->input->post('njop_bangunan_');
                $total_njop         = $this->input->post('total_njop_');
                $njop_tidak_kena_pajak = $this->input->post('njop_tidak_kena_pajak_');
                $njop_pbb              = $this->input->post('njop_pbb_');
                $pbb_terhutang         = $this->input->post('pbb_terhutang_');
                $tgl_pembayaran        = $this->input->post('tgl_pembayaran_');
                $active                = $this->input->post('active_');

                $session = $this->session->userdata('login');
                $data = array(
                    'id_jenis_surat' => $id_jenis_surat,
                    'id_bu'          => $id_bu,
                    'tahun'         => $tahun,
                    'nama_wp'       => $nama_wp,
                    'alamat_wp'     => $alamat_wp,
                    'objek_pajak'   => $objek_pajak,
                    'lokasi_objek_pajak' => $lokasi_objek_pajak,
                    'luas_tanah' => $luas_tanah,
                    'luas_bangunan' => $luas_bangunan,
                    'njop_tanah' => $njop_tanah,
                    'njop_bangunan' => $njop_bangunan,
                    'total_njop' => $total_njop,
                    'njop_tidak_kena_pajak' => $njop_tidak_kena_pajak,
                    'njop_pbb' => $njop_pbb,
                    'pbb_terhutang' => $pbb_terhutang,
                    'tgl_pembayaran' => $tgl_pembayaran,
                    'active' => 1,
                    'cuser' => $session['id_user'],
                    'id_perusahaan' => $session['id_perusahaan'],
                    );

                $this->db->update('ref_surat_pbb', $data, array('id_surat_pbb' => $id_surat_pbb));
                $data['ref_surat_pbb'] = $this->db->affected_rows();

                // $data['id_surat_hgb'] = $this->model_surat->update_surat_hgb($data);

                echo json_encode(array('status' => 'success', 'data' => $data));

            } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.surat.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
    }

    public function ax_upload_data_attachment_pbb()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S11";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {


                $config['upload_path']="./uploads/surat/";
                $config['allowed_types']='pdf|docx|doc|xlsx|xls|pptx|ppt|png|jpeg|jpg'; 
                $config['encrypt_name'] = TRUE; 
                $config['max_size'] = 2000; 

                $this->load->library('upload',$config); 
                if($this->upload->do_upload("file")){ 
                    $data = array('upload_data' => $this->upload->data()); 

                    $id_surat_pbb = $this->input->post('id_surat_pbb_attachment');
                    $nm_attachment = $this->input->post('nm_Attachment_edit');
                    $upload = $data['upload_data']['file_name'];
                    $url = './uploads/surat/'.$upload; 

                    $session = $this->session->userdata('login');
                    $data = array(
                        'id_surat_pbb' => $id_surat_pbb,
                        'nm_attachment' => $nm_attachment,
                        'attachment' => $upload,
                        'active' => 1,
                        'cuser' => $session['id_user'],
                        'id_perusahaan' => $session['id_perusahaan'],
                        );


                    if (file_exists($url)) {
                        $this->db->insert('ref_surat_attachment_pbb', $data);
                       $data['id_surat_attachment'] = $this->db->insert_id();

                       echo json_encode(array('status' => 'success', 'data' => $data));
                   } 

               }

           } else {
            echo "<script>alert('Anda tidak mendapatkan access menu ini');window.location.href='javascript:history.back(-1);'</script>";
        }
    } else {
        if ($this->uri->segment(1) != null) {
            $url = $this->uri->segment(1);
            $url = $url.' '.$this->uri->segment(2);
            $url = $url.' '.$this->uri->segment(3);
            redirect('welcome/relogin/?url='.$url.'', 'refresh');
        } else {
            redirect('welcome/relogin', 'refresh');
        }
    }
}



public function ax_unset_data_surat_pbb()
{
    if ($this->session->userdata('login')) {
        $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S11";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $id_surat_pbb = $this->input->post('id_surat_pbb');

                $data = array('id_surat_pbb' => $id_surat_pbb);

                if(!empty($id_surat_pbb))

                    $this->db->from("ref_surat_attachment_pbb a");
                $this->db->where('a.id_surat_pbb', $id_surat_pbb);
                $data_attachment = $this->db->get()->result();

                foreach ($data_attachment as $row) {
                    if(file_exists('uploads/surat/'.$row->attachment) && $row->attachment){
                        unlink('uploads/surat/'.$row->attachment);
                    }
                }
                

                $this->db->where('id_surat_pbb', $data['id_surat_pbb']);
                $data['id_surat_pbb'] = $this->db->delete('ref_surat_pbb');

                echo json_encode(array('status' => 'success', 'data' => $data));

            } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.surat.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
    }

    public function ax_unset_data_surat_pbb_attachment()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S11";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $id_surat_attachment = $this->input->post('id_surat_attachment');
                $attachment = $this->input->post('attachment');

                $data = array('id_surat_attachment' => $id_surat_attachment);

                if(!empty($id_surat_attachment))


                    if(file_exists('uploads/surat/'.$attachment) && $attachment){
                        unlink('uploads/surat/'.$attachment);
                    }

                    $this->db->where('id_surat_attachment', $id_surat_attachment);
                    $data['id_surat_attachment'] = $this->db->delete('ref_surat_attachment_pbb');

                    echo json_encode(array('status' => 'success', 'data' => $data));

                } else {
                    echo "<script>alert('Anda tidak mendapatkan access menu ini');window.surat.href='javascript:history.back(-1);'</script>";
                }
            } else {
                if ($this->uri->segment(1) != null) {
                    $url = $this->uri->segment(1);
                    $url = $url.' '.$this->uri->segment(2);
                    $url = $url.' '.$this->uri->segment(3);
                    redirect('welcome/relogin/?url='.$url.'', 'refresh');
                } else {
                    redirect('welcome/relogin', 'refresh');
                }
            }
        }

        public function ax_get_data_by_id_surat_pbb()
        {
            if ($this->session->userdata('login')) {
                $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S11";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $id_surat_pbb = $this->input->post('id_surat_pbb');

                if(empty($id_surat_pbb))
                    $data = array();
                else
                    $data = $this->model_surat->get_surat_by_id_surat_pbb($id_surat_pbb);

                echo json_encode($data);

            } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.surat.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
    }


    
}

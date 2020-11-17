<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class armada extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("model_armada");
        $this->load->model("model_menu");
        ///constructor yang dipanggil ketika memanggil ro.php untuk melakukan pemanggilan pada model : ro.php yang ada di folder models
    }

    public function index()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S10";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {
                $data['id_user'] = $session['id_user'];
                $data['nm_user'] = $session['nm_user'];
                $data['session_level'] = $session['id_level'];
                $data['combobox_bu'] = $this->model_armada->combobox_bu();
                $data['combobox_merek'] = $this->model_armada->combobox_merek();
                $data['combobox_jenis_armada'] = $this->model_armada->combobox_jenis_armada();
                $data['combobox_bahan_bakar'] = $this->model_armada->combobox_bahan_bakar();
                
                $this->load->view('armada/index', $data);
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

    

    public function ax_data_armada()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S10";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $id_bu = $this->input->post('id_bu');
                $start = $this->input->post('start');
                $draw = $this->input->post('draw');
                $length = $this->input->post('length');
                $cari = $this->input->post('search', true);
                $data = $this->model_armada->getAllarmada($length, $start, $cari['value'], $id_bu)->result_array();
                $count = $this->model_armada->get_count_armada($cari['value'], $id_bu);

                echo json_encode(array('recordsTotal' => $count['recordsTotal'], 'recordsFiltered' => $count['recordsFiltered'], 'draw' => $draw, 'search' => $cari['value'], 'data' => $data));
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

    public function ax_set_data()
    {
      if ($this->session->userdata('login')) {
        $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S10";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $id_armada = $this->input->post('id_armada');
                $id_bu = $this->input->post('id_bu');
                $id_jenis_armada = $this->input->post('id_jenis_armada');
                $no_rangka = $this->input->post('no_rangka');
                $no_mesin = $this->input->post('no_mesin');
                $plat_armada = $this->input->post('plat_armada');
                $id_merek = $this->input->post('id_merek');
                $tahun_pembuatan = $this->input->post('tahun_pembuatan');
                $tahun_pembelian = $this->input->post('tahun_pembelian');
                $id_bahan_bakar = $this->input->post('id_bahan_bakar');
                $warna = $this->input->post('warna');
                $active = $this->input->post('active');
                $session = $this->session->userdata('login');

                $data = array(
                    'id_armada' => $id_armada,
                    'id_bu' => $id_bu,
                    'id_jenis_armada' => $id_jenis_armada,
                    'no_rangka' => $no_rangka,
                    'no_mesin' => $no_mesin,
                    'plat_armada' => $plat_armada,
                    'id_merek' => $id_merek,
                    'tahun_pembuatan' => $tahun_pembuatan,
                    'tahun_pembelian' => $tahun_pembelian,
                    'id_bahan_bakar' => $id_bahan_bakar,
                    'warna' => $warna,
                    'active' => $active,
                    'id_perusahaan' => $session['id_perusahaan'],
                    'cuser' => $session['id_user'],
                    );

                if($id_armada == 0){
                 $data['id_armada'] = $this->model_armada->insert_armada($data);
             }
             else{
                 $data['id_armada'] = $this->model_armada->update_armada($data);
             }

             echo json_encode(array('status' => 'success', 'data' => $data));

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

public function ax_unset_data()
{
  if ($this->session->userdata('login')) {
    $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S10";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $id_armada = $this->input->post('id_armada');

                $data = array('id_armada' => $id_armada);

                if(!empty($id_armada))
                 $data['id_armada'] = $this->model_armada->delete_armada($data);

             echo json_encode(array('status' => 'success', 'data' => $data));

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



public function ax_get_data_by_id()
{
    if ($this->session->userdata('login')) {
        $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S10";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

              $id_armada = $this->input->post('id_armada');

              if(empty($id_armada))
                 $data = array();
             else
                 $data = $this->model_armada->get_armada_by_id($id_armada);

             echo json_encode($data);

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


public function ax_data_foto()
{
    if ($this->session->userdata('login')) {
        $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S10";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $id_armada = $this->input->post('id_armada');
                $start = $this->input->post('start');
                $draw = $this->input->post('draw');
                $length = $this->input->post('length');
                $cari = $this->input->post('search', true);
                $data = $this->model_armada->getAllarmadafoto($length, $start, $cari['value'], $id_armada)->result_array();
                $count = $this->model_armada->get_count_armadafoto($cari['value'], $id_armada);

                echo json_encode(array('recordsTotal' => $count['recordsTotal'], 'recordsFiltered' => $count['recordsFiltered'], 'draw' => $draw, 'search' => $cari['value'], 'data' => $data));
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

    public function ax_upload_data_foto()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S10";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {


            $config['upload_path']="./uploads/armada/foto/"; //path folder file upload
            $config['allowed_types']='jpeg|jpg'; //type file yang boleh di upload
            $config['encrypt_name'] = TRUE; //enkripsi file name upload
            $config['max_size'] = 150; //enkripsi file name upload

            $this->load->library('upload',$config); //call library upload 
            if($this->upload->do_upload("file")){ //upload file
                $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload

                $nm_armada_foto = $this->input->post('nm_armada_foto'); //get judul image
                $id_armada = $this->input->post('id_armadafoto'); //get judul image
                // $nm_upload = $this->input->post('nm_upload'); //get judul image
                $upload = $data['upload_data']['file_name']; //set file name ke variable image
                $url = './uploads/armada/foto/'.$upload; 

                $session = $this->session->userdata('login');
                $data = array(
                    'nm_armada_foto' => $nm_armada_foto,
                    'id_armada' => $id_armada,
                    'attachment' => $upload,
                    'active' => 1,
                    'cuser' => $session['id_user'],
                    'id_perusahaan' => $session['id_perusahaan'],


                    );
                // print_r($data);exit();
                if (file_exists($url)) {
                 $data['id_armada_foto'] = $this->model_armada->insert_armada_foto($data);
                 echo json_encode(array('status' => 'success', 'data' => $data));
             } 

                // echo json_encode(array('status' => 'success', 'data' => $data));
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

public function ax_unset_foto()
{
    if ($this->session->userdata('login')) {
        $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S10";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $id_armada_foto = $this->input->post('id_armada_foto');

                $data = array('id_armada_foto' => $id_armada_foto);


                $datas = $this->model_armada->get_foto_by_id($id_armada_foto);
                $this->load->helper("file");
                $url = './uploads/armada/foto/'.$datas['attachment'];
                
                if (file_exists($url)) {
                    unlink($url);
                    $data['id_armada_foto'] = $this->model_armada->delete_foto($data);
                    echo json_encode(array('status' => 'success', 'data' => $url));
                } else {
                    $data['id_armada_foto'] = $this->model_armada->delete_foto($data);
                    echo json_encode(array('status' => 'success', 'data' => $url));
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

    public function ax_data_stnk()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S10";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $id_armada = $this->input->post('id_armada');
                $start = $this->input->post('start');
                $draw = $this->input->post('draw');
                $length = $this->input->post('length');
                $cari = $this->input->post('search', true);
                $data = $this->model_armada->getAllarmadastnk($length, $start, $cari['value'], $id_armada)->result_array();
                $count = $this->model_armada->get_count_armadastnk($cari['value'], $id_armada);

                echo json_encode(array('recordsTotal' => $count['recordsTotal'], 'recordsFiltered' => $count['recordsFiltered'], 'draw' => $draw, 'search' => $cari['value'], 'data' => $data));
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

    public function ax_upload_data_stnk()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S10";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {


            $config['upload_path']="./uploads/armada/stnk/"; //path folder file upload
            $config['allowed_types']='jpeg|jpg'; //type file yang boleh di upload
            $config['encrypt_name'] = TRUE; //enkripsi file name upload
            $config['max_size'] = 150; //enkripsi file name upload

            $this->load->library('upload',$config); //call library upload 
            if($this->upload->do_upload("file")){ //upload file
                $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload

                $tgl_exp_stnk = $this->input->post('tgl_exp_stnk'); //get judul image
                $id_armada = $this->input->post('id_armadastnk'); //get judul image
                $masa = $this->input->post('masa'); //get judul image
                $no_stnk = $this->input->post('no_stnk'); 
                // $nm_upload = $this->input->post('nm_upload'); //get judul image
                $upload = $data['upload_data']['file_name']; //set file name ke variable image
                $url = './uploads/armada/stnk/'.$upload; 

                $session = $this->session->userdata('login');
                $data = array(
                    'tgl_exp_stnk' => $tgl_exp_stnk,
                    'id_armada' => $id_armada,
                    'no_stnk' => $no_stnk,
                    'attachment' => $upload,
                    'masa' => $masa,
                    'active' => 1,
                    'cuser' => $session['id_user'],
                    'id_perusahaan' => $session['id_perusahaan'],


                    );
                // print_r($data);exit();
                if (file_exists($url)) {
                 $data['id_armada_stnk'] = $this->model_armada->insert_armada_stnk($data);
                 echo json_encode(array('status' => 'success', 'data' => $data));
             } 

                // echo json_encode(array('status' => 'success', 'data' => $data));
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

public function ax_unset_stnk()
{
    if ($this->session->userdata('login')) {
        $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S10";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $id_armada_stnk = $this->input->post('id_armada_stnk');

                $data = array('id_armada_stnk' => $id_armada_stnk);


                $datas = $this->model_armada->get_stnk_by_id($id_armada_stnk);
                $this->load->helper("file");
                $url = './uploads/armada/stnk/'.$datas['attachment'];
                
                if (file_exists($url)) {
                    unlink($url);
                    $data['id_armada_stnk'] = $this->model_armada->delete_stnk($data);
                    echo json_encode(array('status' => 'success', 'data' => $url));
                } else {
                    $data['id_armada_stnk'] = $this->model_armada->delete_stnk($data);
                    echo json_encode(array('status' => 'success', 'data' => $url));
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



    public function ax_data_bpkb()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S10";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $id_armada = $this->input->post('id_armada');
                $start = $this->input->post('start');
                $draw = $this->input->post('draw');
                $length = $this->input->post('length');
                $cari = $this->input->post('search', true);
                $data = $this->model_armada->getAllarmadabpkb($length, $start, $cari['value'], $id_armada)->result_array();
                $count = $this->model_armada->get_count_armadabpkb($cari['value'], $id_armada);

                echo json_encode(array('recordsTotal' => $count['recordsTotal'], 'recordsFiltered' => $count['recordsFiltered'], 'draw' => $draw, 'search' => $cari['value'], 'data' => $data));
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

    public function ax_upload_data_bpkb()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S10";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {


            $config['upload_path']="./uploads/armada/bpkb/"; //path folder file upload
            $config['allowed_types']='jpeg|jpg'; //type file yang boleh di upload
            $config['encrypt_name'] = TRUE; //enkripsi file name upload
            $config['max_size'] = 150; //enkripsi file name upload

            $this->load->library('upload',$config); //call library upload 
            if($this->upload->do_upload("file")){ //upload file
                $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload

                $tgl_exp_bpkb = $this->input->post('tgl_exp_bpkb'); //get judul image
                $id_armada = $this->input->post('id_armadabpkb'); //get judul image
                $no_bpkb = $this->input->post('no_bpkb'); 
                // $nm_upload = $this->input->post('nm_upload'); //get judul image
                $upload = $data['upload_data']['file_name']; //set file name ke variable image
                $url = './uploads/armada/bpkb/'.$upload; 

                $session = $this->session->userdata('login');
                $data = array(
                    'tgl_exp_bpkb' => $tgl_exp_bpkb,
                    'id_armada' => $id_armada,
                    'no_bpkb' => $no_bpkb,
                    'attachment' => $upload,
                    'active' => 1,
                    'cuser' => $session['id_user'],
                    'id_perusahaan' => $session['id_perusahaan'],


                    );
                // print_r($data);exit();
                if (file_exists($url)) {
                 $data['id_armada_bpkb'] = $this->model_armada->insert_armada_bpkb($data);
                 echo json_encode(array('status' => 'success', 'data' => $data));
             } 

                // echo json_encode(array('status' => 'success', 'data' => $data));
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

public function ax_unset_bpkb()
{
    if ($this->session->userdata('login')) {
        $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S10";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $id_armada_bpkb = $this->input->post('id_armada_bpkb');

                $data = array('id_armada_bpkb' => $id_armada_bpkb);


                $datas = $this->model_armada->get_bpkb_by_id($id_armada_bpkb);
                $this->load->helper("file");
                $url = './uploads/armada/bpkb/'.$datas['attachment'];
                
                if (file_exists($url)) {
                    unlink($url);
                    $data['id_armada_bpkb'] = $this->model_armada->delete_bpkb($data);
                    echo json_encode(array('status' => 'success', 'data' => $url));
                } else {
                    $data['id_armada_bpkb'] = $this->model_armada->delete_bpkb($data);
                    echo json_encode(array('status' => 'success', 'data' => $url));
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



    

    

}

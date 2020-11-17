<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class list_peralatan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("peralatan/model_list_peralatan","model_list_peralatan");
        $this->load->model("model_menu");
        ///constructor yang dipanggil ketika memanggil ro.php untuk melakukan pemanggilan pada model : ro.php yang ada di folder models
    }

    public function index()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S09";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {
                $data['id_user'] = $session['id_user'];
                $data['nm_user'] = $session['nm_user'];
                $data['session_level'] = $session['id_level'];
                $data['combobox_kategori'] = $this->model_list_peralatan->combobox_kategori();
                $data['combobox_posisi_barang'] = $this->model_list_peralatan->combobox_posisi_barang();
                $this->load->view('peralatan/list_peralatan', $data);
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

    

    public function ax_data_list_peralatan()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S09";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $start = $this->input->post('start');
                $draw = $this->input->post('draw');
                $length = $this->input->post('length');
                $cari = $this->input->post('search', true);
                $data = $this->model_list_peralatan->getAlllist_peralatan($length, $start, $cari['value'])->result_array();
                $count = $this->model_list_peralatan->get_count_list_peralatan($cari['value']);

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

    public function ax_data_list_peralatan_foto()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S09";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $id_peralatan = $this->input->post('id_peralatan');
                $start = $this->input->post('start');
                $draw = $this->input->post('draw');
                $length = $this->input->post('length');
                $cari = $this->input->post('search', true);
                $data = $this->model_list_peralatan->getAlllist_peralatan_foto($length, $start, $cari['value'],$id_peralatan)->result_array();
                $count = $this->model_list_peralatan->get_count_list_peralatan_foto($cari['value'],$id_peralatan);

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
            $menu_kd_menu_details = "S09";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $id_peralatan       = $this->input->post('id_peralatan');
                $id_kategori        = $this->input->post('id_kategori');
                $id_kategori_sub    = $this->input->post('id_kategori_sub');
                $tgl_pembelian      = $this->input->post('tgl_pembelian');
                $harga_pembelian    = $this->input->post('harga_pembelian');
                $kuantitas_barang   = $this->input->post('kuantitas_barang');
                $ijin_prinsip       = $this->input->post('ijin_prinsip');
                $purchase_order     = $this->input->post('purchase_order');
                $invoice            = $this->input->post('invoice');
                $id_posisi_barang   = $this->input->post('id_posisi_barang');
                $session            = $this->session->userdata('login');
                $data = array(
                    'id_peralatan'    => $id_peralatan,
                    'id_kategori'     => $id_kategori,
                    'id_kategori_sub' => $id_kategori_sub,
                    'tgl_pembelian'   => $tgl_pembelian,
                    'harga_pembelian' => $harga_pembelian,
                    'kuantitas_barang'=> $kuantitas_barang,
                    'ijin_prinsip'    => $ijin_prinsip,
                    'purchase_order'  => $purchase_order,
                    'invoice'         => $invoice,
                    'id_posisi_barang'=> $id_posisi_barang,
                    'id_kategori_sub' => $id_kategori_sub,
                    'tgl_pembelian'   => $tgl_pembelian,
                    'active'          => 1,
                    'id_perusahaan'   => $session['id_perusahaan'],
                    'cuser'           => $session['id_user']
                    );

                if(empty($id_peralatan))
                   $data['id_peralatan'] = $this->model_list_peralatan->insert_list_peralatan($data);
               else
                   $data['id_peralatan'] = $this->model_list_peralatan->update_list_peralatan($data);

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


public function ax_upload_data_peralatan_foto()
{
    if ($this->session->userdata('login')) {
        $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S09";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {


            $config['upload_path']="./uploads/peralatan/"; //path folder file upload
            $config['allowed_types']='jpeg|jpg'; //type file yang boleh di upload
            $config['encrypt_name'] = TRUE; //enkripsi file name upload
            $config['max_size'] = 150; //enkripsi file name upload

            $this->load->library('upload',$config); //call library upload 
            if($this->upload->do_upload("file")){ //upload file
                $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload

                $id_peralatan_foto  = $this->input->post('id_peralatan_foto');
                $id_peralatan       = $this->input->post('id_peralatanfoto');
                $nm_peralatan_foto  = $this->input->post('nm_peralatan_foto');
                $upload             = $data['upload_data']['file_name'];
                $url                = './uploads/peralatan/'.$upload; 

                $session = $this->session->userdata('login');
                $data = array(
                    'id_peralatan_foto' => $id_peralatan_foto,
                    'id_peralatan' => $id_peralatan,
                    'nm_peralatan_foto' => $nm_peralatan_foto,
                    'attachment' => $upload,
                    'active' => 1,
                    'cuser' => $session['id_user'],
                    'id_perusahaan' => $session['id_perusahaan'],
                    );
                if (file_exists($url)) {
                 $data['id_peralatan_foto'] = $this->model_list_peralatan->insert_list_peralatan_foto($data);
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

public function ax_unset_data()
{
  if ($this->session->userdata('login')) {
    $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S09";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $id_peralatan = $this->input->post('id_peralatan');

                $data = array('id_list_peralatan' => $id_peralatan);

                if(!empty($id_peralatan))
                   $data['id_list_peralatan'] = $this->model_list_peralatan->delete_list_peralatan($data);

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


public function ax_unset_peralatan_foto()
{
  if ($this->session->userdata('login')) {
    $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S09";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {
                $id_peralatan_foto = $this->input->post('id_peralatan_foto');
                $data = array('id_peralatan_foto' => $id_peralatan_foto);
                if(!empty($id_peralatan_foto))
                   $data['id_peralatan_foto'] = $this->model_list_peralatan->delete_list_peralatan_foto($data);

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
            $menu_kd_menu_details = "S09";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {
              $id_peralatan = $this->input->post('id_peralatan');
              if(empty($id_peralatan))
               $data = array();
           else
               $data = $this->model_list_peralatan->get_list_peralatan_by_id($id_peralatan);

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

public function ax_get_kategori_sub()
{
    if ($this->session->userdata('login')) {
        $session = $this->session->userdata('login');
            $menu_kd_menu_details = "S09";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

                $id_kategori = $this->input->post('id_kategori');
                $data = $this->model_list_peralatan->combobox_kategori_sub($id_kategori);
                $html = "";
                foreach ($data->result() as $row) {
                    $html .= "<option value='".$row->id_kategori_sub."'>".$row->nm_kategori_sub."</option>"; 
                }
                $callback = array('data_kategori_sub'=>$html);
                echo json_encode($callback);

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

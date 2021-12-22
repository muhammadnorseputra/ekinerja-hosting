<?php
Class C_kelompok extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $data['jabatan']=$this->db->where('jenis','JFT')->get('tbljabatan')->result();
        $this->load->view('admin/v_kelompok_jabatan',$data);
    }

    public function list_jabatan(){
        $post=$this->input->post();
        $parWhere="";
        $no=$post['no'];
        if($no!=""){
            $parWhere=" AND kelas='$no'";
        }
        $jabatan=$post['jabatan'];
        if($jabatan!="all"){
            $parWhere=" AND kodejab='$jabatan'";
        }
        $data['jabatan']=$this->db->query("SELECT * FROM tbljabatan WHERE jenis='JFT' $parWhere")->result();
        $this->load->view('admin/v_list_kelompok_jabatan',$data);
    }

    public function simpan_kelas(){
        $post=$this->input->post();
        $data=array('kelas'=>$post['kelas']);
        $this->db->where('kodejab',$post['kodejab']);
        $update=$this->db->update('tbljabatan',$data);
        if($update){
            echo 'ok';
        }
    }
}
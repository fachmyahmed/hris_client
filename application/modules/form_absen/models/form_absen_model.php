<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_absen_model extends CI_Model {

    var $table = 'users_absen';
    var $join1  = 'users';
    var $join2  = 'keterangan_absen';
    var $column = array('users_absen.id', 'nik', 'username','date_tidak_hadir', 'keterangan'); //set column field database for order and search
    var $order = array('id' => 'desc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query($f)
    {
            if(!is_admin()){
            $sess_id = $this->session->userdata('user_id');
            $sess_nik = get_nik($sess_id);
            $is_admin = is_admin();
            $is_approver = $this->approval->approver('absen', $sess_nik);//print_mz($is_approver);
            $is_admin_cabang = is_admin_cabang();
            if($is_approver == $sess_nik || $is_admin_cabang == 1)$user = get_user_satu_bu($sess_nik);
            }

        $this->db->select(array(
                'users_absen'.'.id as id',
                'users_absen'.'.date_tidak_hadir',
                'keterangan_absen'.'.title as keterangan',
                'users_absen'.'.created_by',
                'users_absen'.'.approval_status_id_lv1',
                'users_absen'.'.approval_status_id_lv2',
                'users_absen'.'.approval_status_id_lv3',
                'users_absen'.'.approval_status_id_hrd',
                'users_absen'.'.user_app_lv1',
                'users_absen'.'.user_app_lv2',
                'users_absen'.'.user_app_lv3',
               'users'.'.username',
               'users'.'.nik',
            ));

            $this->db->from($this->table);

            $this->db->join($this->join1, $this->table.'.user_id ='.$this->join1.'.id', 'left');
            $this->db->join($this->join2, $this->join2.'.id ='.$this->table.'.keterangan_id', 'left');
            
            $this->db->where($this->table.'.is_deleted', 0);
            if($f == 1){
                $this->db->where('is_app_hrd', 0);
            }elseif($f == 2){
                $this->db->where('is_app_hrd', 1);
            }else{
                
            }
            if($is_admin!=1):
            if($is_approver == $sess_nik || $is_admin_cabang == 1){
                $this->db->where_in($this->table.'.user_id', $user);//print_mz($user);
            }elseif($is_admin!=1 ){
                 $this->db->where("(users_absen.user_id = '$sess_id' 
                               OR users_absen.user_app_lv1 = '$sess_nik'  OR users_absen.user_app_lv2 = '$sess_nik'  OR users_absen.user_app_lv3 = '$sess_nik' 
                )",null, false);
            }
            endif;


        $i = 0;
    
        foreach ($this->column as $item) // loop column 
        {
            if($_POST['search']['value'])
            {
                if($item == 'nik'){
                    $item = $this->join1.'.nik';
                }elseif($item == 'username'){
                    $item = $this->join1.'.username';
                }elseif($item == 'date_tidak_hadir'){
                    $item = $this->table.'.date_tidak_hadir';
                }elseif($item == 'keterangan'){
                    $item = $this->join2.'.title';
                }

                ($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
            }
                
            $column[$i] = $item;
            $i++;
        }
        
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($f)
    {
        $this->_get_datatables_query($f);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($f)
    {
        $this->_get_datatables_query($f);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($f)
    {
        if(!is_admin()){
            $sess_id = $this->session->userdata('user_id');
            $sess_nik = get_nik($sess_id);
            $is_admin = is_admin();
            $is_approver = $this->approval->approver('absen', $sess_nik);//print_mz($is_approver);
            $is_admin_cabang = is_admin_cabang();
            if($is_approver == $sess_nik || $is_admin_cabang == 1)$user = get_user_satu_bu($sess_nik);
            }

         if($is_admin!=1):
            if($is_approver == $sess_nik || $is_admin_cabang == 1){
                $this->db->where_in($this->table.'.user_id', $user);//print_mz($user);
            }elseif($is_admin!=1 ){
                 $this->db->where("(users_absen.user_id = '$sess_id' 
                               OR users_absen.user_app_lv1 = '$sess_nik'  OR users_absen.user_app_lv2 = '$sess_nik'  OR users_absen.user_app_lv3 = '$sess_nik' 
                )",null, false);
            }
            endif;
        $this->db->where('users_absen.is_deleted', 0);
        if($f == 1){
            $this->db->where('is_app_hrd', 0);
        }elseif($f == 2){
            $this->db->where('is_app_hrd', 1);
        }else{
            
        }
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id',$id);
        $query = $this->db->get();

        return $query->row();
    }

     public function create_($user_id = FALSE, $additional_data = array())
    {

        $data = array('user_id'=>$user_id);

        //filter out any data passed that doesnt have a matching column in the form absen table
        //and merge the set group data and the additional data

        if (!empty($additional_data)) $data = array_merge($additional_data, $data);


        // insert the new form_absen
        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();

        return $id;
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('users_absen', $data);
    }

    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

    public function save_component($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    function detail($id){
        $this->db->select(array(
                'users_absen'.'.id as id',
                'users_absen'.'.*',
                'keterangan_absen'.'.title as keterangan',
               'users'.'.username',
               'users'.'.nik',
            ));

            $this->db->from('users_absen');

            $this->db->join($this->join1, $this->table.'.user_id ='.$this->join1.'.id', 'left');
            $this->db->join($this->join2, $this->join2.'.id ='.$this->table.'.keterangan_id', 'left');
            
            $this->db->where('users_absen.is_deleted', 0);
            $this->db->where('users_absen.id', $id);

            return $this->db->get();
    }
}

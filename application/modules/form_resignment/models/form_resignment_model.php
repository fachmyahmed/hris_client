<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class form_resignment_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function form_resignment($id = null)
    {
        $sess_id = $this->session->userdata('user_id');
            
        if(!empty(is_have_subordinate(get_nik($sess_id)))){
        $sub_id = get_subordinate($sess_id);
        }else{
            $sub_id = '';
        }

        $this->db->select('resignment.*, alasan_resign.title as alasan_resign');
        $this->db->from('users_resignment as resignment');
        $this->db->join('users', 'users.id = resignment.user_id', 'LEFT');
        $this->db->join('alasan_resign', 'resignment.alasan_resign_id = alasan_resign.id', 'LEFT');                                                                                                                                                                                                                                                                                                                                                                               
        if($id != null){
            $this->db->where('resignment.id', $id);
        }

        $this->db->where('resignment.is_deleted', 0);
        $this->db->where("(resignment.user_id= $sess_id $sub_id)",null, false);
        $this->db->order_by('resignment.id', 'desc');
        $q = $this->db->get();

        return $q;

    }

    function form_resignment_admin($id = null)
    {
        $this->db->select('resignment.*, alasan_resign.title as alasan_resign');
        $this->db->from('users_resignment as resignment');
        $this->db->join('users', 'users.id = resignment.user_id', 'LEFT');
        $this->db->join('alasan_resign', 'resignment.alasan_resign_id = alasan_resign.id', 'LEFT');

        if($id != null){
            $this->db->where('resignment.id', $id);
        }

        $this->db->where('resignment.is_deleted', 0);
        $this->db->order_by('resignment.id', 'desc');
        
        $q = $this->db->get();

        return $q;

    }

    function add($data)
    {
        $this->db->insert('users_resignment', $data);
        return true;
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('users_resignment', $data);

        return TRUE;
    }

}
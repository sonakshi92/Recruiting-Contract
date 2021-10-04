<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contract_model extends CI_Model {
   public function __construct()
   {
      parent::__construct();
     
      $this->load->database();
   }
   public function login($user){
      $this->db->insert('users', $user);
  }
   public function checkemail($email){
      $this->db->select('*');
      $this->db->from('users');
      $this->db->where('email', $email);
      $query=$this->db->get();
      if($query->num_rows()>0){
          return false;
      }
      else{
          return true;
      }
  }   
    public function listcontracts()
    {
        $this->db->select('contracts.*,cm.media_files as media_files');
        $this->db->from('contracts');
        $this->db->join('contract_media as cm', 'contracts.id = cm.contractor_id');
        $data = $this->db->get()->result_array();
        // echo '<pre>';
        // print_r($data);die;
        return $data;
    }
    public function documentation()
    {
        // $this->db->select('paper_work.*,pd.user_paperwork_document as media_files');
        // $this->db->from('paper_work');
        // $this->db->join('paperworks_documents as pd', 'paper_work.id = pd.paper_work_id');
        // $this->db->where('pd.status',1);
        $data = $this->db->get('paper_work')->result_array();
        // echo '<pre>';
        // print_r($data);die;
        return $data;
    }
    public function paperwrkdoc()
    {
        $this->db->select('pd.id,pd.paper_work_id,pd.user_paperwork_document as media_files');
        $this->db->from('paperworks_documents as pd');
        $this->db->join('paper_work pw', 'pw.id = pd.paper_work_id');
        $this->db->where('pd.status',1);
        $data = $this->db->get()->result_array();
        // echo '<pre>';
        // print_r($data);die;
        return $data;
    }

    public function dashboard()
    {
        $this->db->limit(100);
        $email = $this->session->userdata('username');
        $data = $this->db->get_where('contracts', array('user_email_id'=>$email))->result_array();
        return $data;
    }
  
    function addContracts($formArray)
    {
        $this->db->insert("contracts",$formArray);
    } 

    function getContracts($userId)
    {
        $this->db->where('id', $userId);
        return $user = $this->db->get('contracts');
    }
   
    function editContract($userId)
    {
        $this->db->select('contracts.*,cm.media_files as media_files');
        $this->db->from('contracts');
        $this->db->join('contract_media as cm', 'contracts.id = cm.contractor_id');
        $this->db->where('id',$userId);
        $data = $this->db->get()->row_array();
        return $data;
    }
    function updateContract($userId,$formArray){
        $this->db->where('id', $userId);
        $this->db->update('contracts', $formArray); 
    }
    
    // public function checkFileImage($userid)
    // {
    //     $query = $this->db->get_where('contracts', ['id' => $userId]);
    //     return $query->row();
        
    // }

    function deleteContract($userId)
    {
        $this->db->where('id',$userId);              
        $this->db->delete('contracts');
    }
    public function addPaperwork($formarray)
    {
        $this->db->insert("paper_work",$formArray);
    }

    function getPaperwork($userId)
    {
        $this->db->where('id', $userId);
        return $data = $this->db->get('paper_work');
    }
    function edit($userId)
    {
    $query = $this->db->get_where('paper_work',['id'=> $userId]);
    return $query->row_array();
    }
    function updatedoc($userId,$formArray){
        $this->db->where('id', $userId);
        $this->db->update('paper_work', $formArray); 
    }
    function delete($userId)
    {
        $this->db->where('id',$userId);              
        $this->db->delete('paper_work');
    }
} 
?>
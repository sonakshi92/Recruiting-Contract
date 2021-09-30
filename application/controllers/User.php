<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
   public function __construct()
   {
      parent::__construct();
      $this->load->helper('file');
      $this->load->helper('url');
      $this->load->helper('form');
      $this->load->library('session');
      $this->load->model('Contract_model');
      $this->load->library('upload');
      $this->load->database();
   }
       //1)Index
       public function index()
       {
          $contracts = $this->Contract_model->all();
            $data = array();
          $data['contracts'] = $contracts;
          $this->load->view('dashboard', $data);
       }
//2)Login Form
   public function login()
   {
      $this->form_validation->set_rules('email', 'Email', 'required');
      $this->form_validation->set_rules('password', 'Password', 'required|max_length[5]');
      if($this->form_validation->run() == TRUE) {
      
         $email = $_POST['email'];
         $password= md5($_POST['password']);

         $this->db->select('*');
         $this->db->from('users');
         $this->db->where(array('email'=>$email, 'password' => $password));
         $query = $this->db->get();

         $user = $query->row();
         if(isset($user->email) && isset($user->password))  {
            $this->session->set_flashdata("success", "<div class='alert alert-success'>You are logged in</div>");

            $_SESSION['user_logged'] = TRUE;
            $_SESSION['username'] = $user->email;
            redirect("user/dashboard", "refresh");
         } else{
            if($this->form_validation->run() == TRUE); 
            $this->session->set_flashdata("success", "<div class='alert alert-danger'>Email Doesn't exist</div>");
            
         }
      } 
      $this->load->view('login');
   }

     //3)PROFILE/DASHBOARD
     public function dashboard()
     {
        if ($this->input->get('orderBy') == 'old') {
           $this->db->order_by("id", "desc");
        }
        $data = $this->Contract_model->dashboard();
        $data['data'] = $data;
        if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
           $this->load->view('dashboard',$data);
        } else{
        redirect('user/login');
        }
      }

//4)JQuery Datatable
public function listcontracts()
{
   $data = $this->Contract_model->listcontracts();
   $data['data'] = $data;
   if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
   $this->load->view('listcontracts',$data);
   }
   else{
   redirect('user/login');
   }
}

//5) Recruiting Contract Form
public function addContracts()
{
   $data = $this->Contract_model->listcontracts();
   $data['data'] = $data;
   if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
   }
   else{
   redirect('user/login');
   }
   if(isset($_FILES["upload_file"]["name"]) && $_FILES["upload_file"]["name"]!="") 
   {
         $target_dir = "upload_file/";
     $file2 = $_FILES['upload_file']['name'];
    // $imageFileType2 = strtolower(pathinfo($file2,PATHINFO_EXTENSION));
   //   $newfilename2 = strtolower(str_replace(' ','-',$data['name'])).rand(1111,9999).'.'.$imageFileType2;
     $config2['upload_path']=$target_dir;
     $config2['allowed_types']='jpg|jpeg|png|gif|JPG|JPEG|PNG|pdf|PDF|txt';
     $config2['max_size']='40960';
     $config2['file_name'] = $file2;
     $this->upload->initialize($config2);
     $upload2=$this->upload->do_upload('upload_file');
     $error = array('error' => $this->upload->display_errors());
     $img2_path=$target_dir.$this->upload->data('file_name');
     if($upload2)
     {
       $upload_file=$img2_path;
     }
   }     
         $this->form_validation->set_rules('name_of_company', 'Name Of Company', 'required');
         $this->form_validation->set_rules('employer_email', 'Employer Email', 'required');
         $this->form_validation->set_rules('company_website', 'Company Website', 'required');
         $this->form_validation->set_rules('employer_phn', 'Employer Phone', 'required');
         $this->form_validation->set_rules('sub_by', 'Submitted By', 'required');
         $this->form_validation->set_rules('sub_for_company', 'Submitted For Company', 'required');
         $this->form_validation->set_rules('blacklisted', 'Blacklisted', 'required');
         if (empty($_FILES['upload_file']['name']))
{
    $this->form_validation->set_rules('upload_file', 'upload file', 'required');
}
         
        
         if($this->form_validation->run() == TRUE){
         //echo "form validated";
         $email_emp = $_POST ['employer_email'];
        $numrow = $this->db->get_where('contracts',array('employer_email'=> $email_emp))->result_array();
        if(count($numrow)>0){
         $this->session->set_flashdata("success", "<div style='color:red;'> A Contract Already Exists With this Employer's E-mail Address .</div>");
         redirect('user/addContracts');
        }else{
         $data = array(
            'user_email_id' => $_SESSION['username'],         
            'name_of_company'=> $_POST ['name_of_company'],
            'employer_email'=> $_POST ['employer_email'],
            'company_website'=> $_POST ['company_website'],
            'employer_phn'=> $_POST ['employer_phn'],
            'sub_by'=> $_POST ['sub_by'],
            'sub_for_company'=> $_POST ['sub_for_company'],
            'blacklisted'=> $_POST ['blacklisted'],
            'upload_file' => $upload_file
         );
         // echo '<pre>';
         // print_r($data);exit;
         $this->db->insert('contracts', $data);
         $this->session->set_flashdata("success", "Created Successfully ");
           redirect("user/dashboard", "refresh");
  
       }
      }
       $this->load->view('addContracts');
   }
//7)EDIT CONTRACT
public function editContract()
{
   $userId = $this->input->get('v');
       $this->session->set_flashdata("emsg", "Contract Details Modified Successfully ");
      $data['user'] = $this->Contract_model->editContract($userId);
      
      $this->load->view('editContract',$data); 
}

//8)UPDATE CONTRACT
public function update()
{
   $upload_file = "";
   if(isset($_FILES["upload_file"]["name"]) && $_FILES["upload_file"]["name"]!="")
   {
      $target_dir = "upload_file/";
      $file2 = $_FILES['upload_file']['name'];

     $config2['upload_path']=$target_dir;
     $config2['allowed_types']='jpg|jpeg|png|gif|JPG|JPEG|PNG|pdf|PDF|txt';
     $config2['max_size']='40960';
     $config2['file_name'] = $file2;
     $this->upload->initialize($config2);
     $upload2=$this->upload->do_upload('upload_file');
     $img2_path=$target_dir.$this->upload->data('file_name');
     if($upload2)
     {
         $upload_file=$img2_path;
         $oldfile = $_POST ['old_img_file'];
         if($oldfile!=""){
            unlink($oldfile);
         }
     }

   }     
   $id = $this->input->post('id');
   $data = array(
      // 'id' => $_POST['id'],
      'name_of_company'=> $_POST ['name_of_company'],
      'employer_email'=> $_POST ['employer_email'],
      'company_website'=> $_POST ['company_website'],
      'employer_phn'=> $_POST ['employer_phn'],
      'sub_by'=> $_POST ['sub_by'],
      'sub_for_company'=> $_POST ['sub_for_company'],
      'blacklisted'=> $_POST ['blacklisted']
   );
   if($upload_file!=""){
      $data['upload_file'] = $upload_file;
   }
   // echo '<pre>';
   // print_r($this->input->post());echo '</pre><pre>';
   // print_r($data);die;
   
   $this->db->where('id', $id);
      $this->db->update('contracts', $data);
      $this->session->set_flashdata("success", "Contract Updated Successfully ");
      redirect('user/dashboard');
}

   public function deleteImg()
   {
      $userId = $this->input->post('id');
      $imgnm = $this->input->post('imgnm');
      $res = $this->Contract_model->getPaperwork($userId);
      print_r($res->result_array());
   //}
   //9)DELETE Contract
      function delete($userId){
         $this->load->model('Contract_model');
         $user = $this->Contract_model->getContracts($userId);
         if(empty($user)){
            $this->session->set_flashdata("emsg", "<div class='alert alert-danger'>Recruiting Contracts Have Been Deleted </div>");
         redirect(base_url().'user/dashboard');
         }
         $this->Contract_model->deleteContract($userId);
         $this->session->set_flashdata('success',"Contract Details Deleted ");
         redirect(base_url().'user/dashboard');
      }
   }

 //ADD PAPERWORK/DOCUMENTATION
   public function addpaperwork()
   {    
      $data = $this->Contract_model->listcontracts();
      $data['data'] = $data;
      if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
      }
      else{
      redirect('user/login');
      }
      if ($this->input->post('create')) 
      {
         $uploaddata = $statusMsg = $errorUploadType = "";
      if(!empty($_FILES["upload_files"]["name"]) && count(array_filter($_FILES["upload_files"]["name"]))>0)
      {
         $cpt = count($_FILES['upload_files']['name']);
         $target_dir = "doc_folder/";
      $upload_files= [];
      for($i=0;$i<$cpt; $i++)
      {
         unset($config);
         $config = array();
         $file2 = $_FILES['upload_files']['name'];
         $config['upload_path']   = $target_dir;
         $config['allowed_types'] = 'jpg|jpeg|png|gif|JPG|JPEG|PNG|pdf|PDF|txt';
         $config['max_size'] = '40960';
         $config['overwrite'] = TRUE;
         $config['remove_spaces'] = FALSE;
         $config['file_name'] = $_FILES['upload_files']['name'][$i];

         $_FILES['f']['name'] =  $_FILES['upload_files']['name'][$i];
         $_FILES['f']['type'] = $_FILES['upload_files']['type'][$i];
         $_FILES['f']['tmp_name'] = $_FILES['upload_files']['tmp_name'][$i];
         $_FILES['f']['error'] = $_FILES['upload_files']['error'][$i];
         $_FILES['f']['size'] = $_FILES['upload_files']['size'][$i];

         $this->load->library('upload', $config);
         $this->upload->initialize($config);
                     
         if (! $this->upload->do_upload('f'))
         {
            $statusMsg = $this->upload->display_errors();
            $errorUploadType .= $_FILES['upload_files']['name'].' | ';
         }
         else
         {
            $fileData = $this->upload->data();
            $uploaddata .= $fileData['file_name'].',';
         }
      }
      }else{
         $statusMsg = 'Please select image files to upload';
      }   
      $this->form_validation->set_rules('name_of_candidate', 'Name Of Candidate','required');
      $this->form_validation->set_rules('email', 'Email','required');
      $this->form_validation->set_rules('phone', 'Phone','required');
      $this->form_validation->set_rules('employer_company_name', 'Employer Company Name','required');
      $this->form_validation->set_rules('employer_website', 'Employer Website','required');
      $this->form_validation->set_rules('sub_by_rec_name', 'Submitted By','required');
      $this->form_validation->set_rules('manager_name', 'Manager Name','required');
      if($this->form_validation->run() == TRUE) {

      $data = array(
         'user_email_id' => $_SESSION['username'],
      'name_of_candidate'=> $_POST ['name_of_candidate'],
      'email'=> $_POST ['email'],
      'phone'=> $_POST ['phone'],
      'employer_company_name'=> $_POST ['employer_company_name'],
      'employer_website'=> $_POST ['employer_website'],
      'sub_by_rec_name'=> $_POST ['sub_by_rec_name'],
      'manager_name'=> $_POST ['manager_name'],
      'upload_files' => substr($uploaddata, 0, -1)
      );
      $this->db->insert('paper_work', $data);
      $this->session->set_flashdata("success", "Documentation Addes Successfully");
      redirect("user/dashboard", "refresh");
      }
      } 
      $this->load->view('addpaperwork');
      }

   public function editdoc()
   {
      $userId = $this->input->get('x');
         $this->session->set_flashdata("emsg", "Paper Work Details Modified Successfully ");
         $data['data'] = $this->Contract_model->edit($userId);
         
         $this->load->view('editdoc',$data); 
   }
   public function updatedoc()
   {
   if(isset($_POST['create']))
   {
      $uploaddata = $statusMsg = $errorUploadType = "";
   if(!empty($_FILES["upload_files"]["name"]) && count(array_filter($_FILES["upload_files"]["name"]))>0)
   {
      $cpt = count($_FILES['upload_files']['name']);
      $target_dir = "doc_folder/";
   $upload_files= [];
   for($i=0;$i<$cpt; $i++)
   {
      unset($config);
      $config = array();
      $file2 = $_FILES['upload_files']['name'];
      $config['upload_path']   = $target_dir;
      $config['allowed_types'] = 'jpg|jpeg|png|gif|JPG|JPEG|PNG|pdf|PDF|txt';
      $config['max_size'] = '40960';
      $config['overwrite'] = TRUE;
      $config['remove_spaces'] = FALSE;
      $config['file_name'] = $_FILES['upload_files']['name'][$i];

      $_FILES['f']['name'] =  $_FILES['upload_files']['name'][$i];
      $_FILES['f']['type'] = $_FILES['upload_files']['type'][$i];
      $_FILES['f']['tmp_name'] = $_FILES['upload_files']['tmp_name'][$i];
      $_FILES['f']['error'] = $_FILES['upload_files']['error'][$i];
      $_FILES['f']['size'] = $_FILES['upload_files']['size'][$i];

      $this->load->library('upload', $config);
      $this->upload->initialize($config);
                  
      if (! $this->upload->do_upload('f'))
      {
         $statusMsg = $this->upload->display_errors();
         $errorUploadType .= $_FILES['upload_files']['name'].' | ';
      }
      else
      {
         $fileData = $this->upload->data();
         $uploaddata .= $fileData['file_name'].',';
      }
   }
   }else{
      $statusMsg = 'Please select image files to upload';
   }   
   $this->form_validation->set_rules('name_of_candidate', 'Name Of Candidate','required');
   $this->form_validation->set_rules('email', 'Email','required');
   $this->form_validation->set_rules('phone', 'Phone','required');
   $this->form_validation->set_rules('employer_company_name', 'Employer Company Name','required');
   $this->form_validation->set_rules('employer_website', 'Employer Website','required');
   $this->form_validation->set_rules('sub_by_rec_name', 'Submitted By','required');
   $this->form_validation->set_rules('manager_name', 'Manager Name','required');
   if($this->form_validation->run() == TRUE) {

      $id = $this->input->post('id');
      $data = array(
      'user_email_id' => $_SESSION['username'],
   'name_of_candidate'=> $_POST ['name_of_candidate'],
   'email'=> $_POST ['email'],
   'phone'=> $_POST ['phone'],
   'employer_company_name'=> $_POST ['employer_company_name'],
   'employer_website'=> $_POST ['employer_website'],
   'sub_by_rec_name'=> $_POST ['sub_by_rec_name'],
   'manager_name'=> $_POST ['manager_name'],
   'upload_files' => substr($uploaddata, 0, -1)
   );
   $this->db->where('id', $id);
   $this->db->update('paper_work', $data);
   $this->session->set_flashdata("success", "Your documentation is Updated Successfully");
   redirect("user/dashboard", "refresh");
   }
   } 
   $upload_file = '/doc_folder';
   if(unlink($upload_file)) {
      echo 'deleted successfully';
   }
   else {
   redirect("user/dashboard", "data");
   }
   }
      
   public function documentation()
   {
      $data = $this->Contract_model->documentation();
      $data['data'] = $data;
      if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
      $this->load->view('documentation',$data);
      }
      else{
      redirect('user/login');
      }
   }

   function deletedoc($userId)
   {
   $this->load->model('Contract_model');
   $data = $this->Contract_model->getPaperwork($userId);
   if(empty($data)){
   $this->session->set_flashdata("emsg", "<div class='alert alert-danger'>Documentaton Have Been Deleted </div>");
   redirect(base_url().'user/dashboard');
   }
   $this->Contract_model->delete($userId);
   $this->session->set_flashdata('success',"Documentation Details Deleted");
   redirect(base_url().'user/dashboard');
   }

//6)Logout 
public function logout()
   {
      $this->session->sess_destroy();
      redirect('user/login');
   }             
}
?>
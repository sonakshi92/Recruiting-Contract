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
   public function index()
   {
      if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
         redirect('user/dashboard');
      }else{
         
         if(isset($_POST['login']))
         {
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required|max_length[5]');
            if($this->form_validation->run() == TRUE) 
            {
            
               $email = $_POST['email'];
               $password= md5($_POST['password']);

               $this->db->select('*');
               $this->db->from('users');
               $this->db->where(array('email'=>$email, 'password' => $password));
               $query = $this->db->get();

               $user = $query->row();
               if(isset($user->email) && isset($user->password))  
               {
                  $this->session->set_flashdata("success", "You are logged in successfully");

                  $_SESSION['user_logged'] = TRUE;
                  $_SESSION['username'] = $user->email;
                  redirect("user/dashboard", "refresh");
               } else{
                  if($this->form_validation->run() == TRUE); 
                  $this->session->set_flashdata("msg", "<div class='alert alert-danger'>Either Email id or password is wrong</div>"); 
               }
            } 
         }
         $this->load->view('includes/header');
         $this->load->view('login');
         $this->load->view('includes/footer');
      }
      
   }

     //3)PROFILE/DASHBOARD
     public function dashboard()
     {
         if ($this->input->get('orderBy') == 'old') {
            $this->db->order_by("id", "desc");
         }
  
         $data = $this->Contract_model->listcontracts();
         $data['data'] = $data;
         $data = $this->Contract_model->listcontracts();
         $data['contractor'] = $data;
         $data['paperwork'] = $this->Contract_model->documentation();
         $data['paperworkdoc'] = $this->Contract_model->paperwrkdoc();
        if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
        
         $this->load->view('includes/header',$data);
         $this->load->view('includes/sidebar');
         $this->load->view('dashboard');
         $this->load->view('listcontracts');
         $this->load->view('documentation');
         $this->load->view('includes/footer');
     
     } else{
        redirect('/');
     }
   }

//4)JQuery Datatable
public function listcontracts()
{
   $data = $this->Contract_model->listcontracts();
   $data['contractor'] = $data;
   if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
      $this->load->view('includes/header',$data);
      $this->load->view('includes/sidebar');
      $this->load->view('listcontracts');
      $this->load->view('includes/footer');
   }else{
      redirect('/');
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
   redirect('/');
   }
   $upload_file="";
   if(isset($_FILES["upload_file"]["name"]) && $_FILES["upload_file"]["name"]!="") 
   {

      $target_dir = "assets/images/contractorMedia/";
      $file2 = $_FILES['upload_file']['name'];
      // $imageFileType2 = strtolower(pathinfo($file2,PATHINFO_EXTENSION));
      //   $newfilename2 = strtolower(str_replace(' ','-',$data['name'])).rand(1111,9999).'.'.$imageFileType2;
      $config2['upload_path']=$target_dir;
      $config2['allowed_types']='jpg|jpeg|png|gif|JPG|JPEG|PNG|pdf|PDF|txt';
      $config2['max_size']='40960';
      $config2['overwrite'] = FALSE;
      $config2['remove_spaces'] = FALSE;
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
         $this->form_validation->set_rules('employer_phn', 'Employer Phone', 'trim|required|integer|max_length[10]');
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
         $this->session->set_flashdata("success", "A Contract Already Exists With this Employer's E-mail Address.");
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
         );
         // echo '<pre>';
         // print_r($data);exit;
         $res = $this->db->insert('contracts', $data);
         if($res){
            $lastid = $this->db->insert_id();
            $mediafile=array(
               'contractor_id'=>$lastid,
               'media_files'=>$upload_file
            );
            $res2 = $this->db->insert('contract_media',$mediafile);
            if($res2){
         $this->session->set_flashdata("success", "Contract Added successfully");
               redirect("user/listContracts", "refresh");
            }
            
         }
  
       }
      }
       $this->load->view('includes/header');
       $this->load->view('includes/sidebar');
       $this->load->view('addContracts');
       $this->load->view('includes/footer');
   }
//7)EDIT CONTRACT
public function editContract()
{
   if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
   }else{
      redirect('/');
   }
   $userId = $this->input->get('v');
   $data['user'] = $this->Contract_model->editContract($userId);
      
   $this->load->view('includes/header',$data); 
   $this->load->view('includes/sidebar'); 
   $this->load->view('editContract'); 
   $this->load->view('includes/footer'); 
}

//8)UPDATE CONTRACT
public function update()
{
   $upload_file = "";
   if(isset($_FILES["upload_file"]["name"]) && $_FILES["upload_file"]["name"]!="")
   {
      $target_dir = "assets/images/contractorMedia/";
      $file2 = $_FILES['upload_file']['name'];

      $config2['upload_path']=$target_dir;
      $config2['allowed_types']='jpg|jpeg|png|gif|JPG|JPEG|PNG|pdf|PDF|txt';
      $config2['max_size']='40960';
      $config['overwrite'] = FALSE;
      $config['remove_spaces'] = FALSE;
      $config2['file_name'] = $file2;
      $this->upload->initialize($config2);

      $oldfile = $_POST ['old_img_file'];
      // echo $oldfile;exit;
      if($oldfile!=""){
         unlink($oldfile);
      }
     $upload2=$this->upload->do_upload('upload_file');
     $img2_path=$target_dir.$this->upload->data('file_name');
     if($upload2)
     {
         $upload_file=$img2_path; 
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
      $mediafile['media_files'] = $upload_file;
      $this->db->where('contractor_id', $id);
      $this->db->update('contract_media', $mediafile);
   }
   // echo '<pre>';
   // print_r($this->input->post());echo '</pre><pre>';
   // print_r($data);die;
   
   $this->db->where('id', $id);
   $this->db->update('contracts', $data);
   $this->session->set_flashdata("success", "Contract Updated Successfully");
   redirect('user/listContracts');
}
public function deleteImg(){
   $userId = $this->input->post('id');
   $imgnm = $this->input->post('imgnm');
   $res = $this->Contract_model->getPaperwork($userId);
   print_r($res->result_array());
}
//9)DELETE Contract
public function deleteContractor()
{
   $contractorid = $this->input->post('id');
   $mediafile_data = $this->db->get_where('contract_media',array('contractor_id'=>$contractorid))->row();
   $mediafile = $mediafile_data->media_files;
   if($mediafile){
      $x = file_exists($mediafile);
      if($x){
         unlink($mediafile);
      }
      $res=$this->db->delete('contract_media',array('contractor_id'=>$contractorid));
      if($res){
      $res2 =  $this->db->delete('contracts',array('id'=>$contractorid));
      }
      if($res && $res2){

         echo 'data deleted successfully';
      }else{
         echo 'Data can\'t be deleted'; 
      }
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
      redirect('/');
   }
   if ($this->input->post('create')) 
   {
      $uploaddata = $statusMsg = $errorUploadType = "";
      if(!empty($_FILES["upload_files"]["name"]) && count(array_filter($_FILES["upload_files"]["name"]))>0)
      {
         $cpt = count($_FILES['upload_files']['name']);
         $target_dir = "assets/images/paperMedia/";
         $upload_files= [];
         for($i=0;$i<$cpt; $i++)
         {
            unset($config);
            $config = array();
            $file2 = $_FILES['upload_files']['name'];
            $config['upload_path']   = $target_dir;
            $config['allowed_types'] = 'jpg|jpeg|png|gif|JPG|JPEG|PNG|pdf|PDF|txt';
            $config['max_size'] = '40960';
            $config['overwrite'] = FALSE;
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
               // $uploaddata .= $fileData['file_name'].',';
               $upload_files[$i]['user_paperwork_document'] = $target_dir.$fileData['file_name'];
            }
         }
      }else{
         $statusMsg = 'Please select image files to upload';
      }
      $this->form_validation->set_rules('name_of_candidate', 'Name Of Candidate','required');
      $this->form_validation->set_rules('email', 'Email','required');
      $this->form_validation->set_rules('phone', 'Phone','trim|required|integer|max_length[10]');
      $this->form_validation->set_rules('employer_company_name', 'Employer Company Name','required');
      $this->form_validation->set_rules('employer_website', 'Employer Website','required');
      $this->form_validation->set_rules('sub_by_rec_name', 'Submitted By','required');
      $this->form_validation->set_rules('manager_name', 'Manager Name','required');
      if($this->form_validation->run() == TRUE) 
      {

         $data = array(
            'user_email_id' => $_SESSION['username'],
           'name_of_candidate'=> $_POST ['name_of_candidate'],
           'email'=> $_POST ['email'],
           'phone'=> $_POST ['phone'],
           'employer_company_name'=> $_POST ['employer_company_name'],
           'employer_website'=> $_POST ['employer_website'],
           'sub_by_rec_name'=> $_POST ['sub_by_rec_name'],
           'manager_name'=> $_POST ['manager_name'],
           // 'upload_files' => substr($uploaddata, 0, -1)
         );
         $res = $this->db->insert('paper_work', $data);
         if ($res) {
            $lastid = $this->db->insert_id();
            for ($i=0; $i < count($upload_files); $i++) { 
               $upload_files[$i]['paper_work_id'] = $lastid;
            }
            // echo '<pre>';
            // print_r($upload_files);die;
            $this->db->insert_batch('paperworks_documents',$upload_files);
         }
         $this->session->set_flashdata("success", "Documentation Added Successfully");
         redirect("user/Documentation");
      }
   } 
   $this->load->view('includes/header');
   $this->load->view('includes/sidebar');
   $this->load->view('addpaperwork');
   $this->load->view('includes/footer');
}

public function editdoc()
{
   if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
   }
   else{
      redirect('/');
   }

   $userId = $this->input->get('x');
   $data['paperwork'] = $this->db->get_where('paper_work',array('id'=>$userId))->row_array();
   $data['paperworkdoc'] = $this->db->get_where('paperworks_documents',array('paper_work_id'=>$userId))->result_array();
   $this->load->view('includes/header',$data); 
   $this->load->view('includes/sidebar'); 
   $this->load->view('editdoc'); 
   $this->load->view('includes/footer'); 
}
public function deletepaperworkdoc()
{
   
   $paper_work_id = $this->input->post('id');
   $paper_work_doc_id = $this->input->post('docid');
   $file = $this->db->get_where('paperworks_documents',array('id'=>$paper_work_doc_id))->row_array();
   $doc = trim($file['user_paperwork_document']);
   if(file_exists($doc)){
      $res = unlink($doc);
      if($res){
         $res2= $this->db->delete('paperworks_documents',array('id'=>$paper_work_doc_id));
      }
      if($res && $res2){
         echo 'Document Deleted Successfully';
      }
   }else{
      echo 'file does not exist';
   }
      
}
public function updatedoc()
{
   if(isset($_POST['create']))
   {
      $uploaddata = $statusMsg = $errorUploadType = "";
      $id = $this->input->post('id');
      $upload_files = [];
      if(!empty($_FILES["upload_files"]["name"]) && count(array_filter($_FILES["upload_files"]["name"]))>0)
      {
         $cpt = count($_FILES['upload_files']['name']);
         $target_dir = "assets/images/paperMedia/";
         for($i=0;$i<$cpt; $i++)
         {
            unset($config);
            $config = array();
            $file2 = $_FILES['upload_files']['name'];
            $config['upload_path']   = $target_dir;
            $config['allowed_types'] = 'jpg|jpeg|png|gif|JPG|JPEG|PNG|pdf|PDF|txt';
            $config['max_size'] = '40960';
            $config['overwrite'] = FALSE;
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
               // $uploaddata .= $fileData['file_name'].',';
               $upload_files[$i]['user_paperwork_document'] = $target_dir.$fileData['file_name'];
            }
         }
         $this->db->select('user_paperwork_document');
         $oldfile_data = $this->db->get_where('paperworks_documents',array('paper_work_id'=>$id))->result_array();
         if(count($oldfile_data)>0){
            foreach ($oldfile_data as $key => $oldfiles) {
               $oldfile = $oldfiles['user_paperwork_document'];
               if(file_exists($oldfile)){
                  unlink($oldfile);
               }
            }
         }

         $this->db->delete('paperworks_documents',array('paper_work_id'=>$id));
      }  
      $this->form_validation->set_rules('name_of_candidate', 'Name Of Candidate','required');
      $this->form_validation->set_rules('email', 'Email','required');
      $this->form_validation->set_rules('phone', 'Phone','required');
      $this->form_validation->set_rules('employer_company_name', 'Employer Company Name','required');
      $this->form_validation->set_rules('employer_website', 'Employer Website','required');
      $this->form_validation->set_rules('sub_by_rec_name', 'Submitted By','required');
      $this->form_validation->set_rules('manager_name', 'Manager Name','required');
      if($this->form_validation->run() == TRUE) 
      {
         $data = array(
            'user_email_id' => $_SESSION['username'],
            'name_of_candidate'=> $_POST ['name_of_candidate'],
            'email'=> $_POST ['email'],
            'phone'=> $_POST ['phone'],
            'employer_company_name'=> $_POST ['employer_company_name'],
            'employer_website'=> $_POST ['employer_website'],
            'sub_by_rec_name'=> $_POST ['sub_by_rec_name'],
            'manager_name'=> $_POST ['manager_name']
            // 'upload_files' => substr($uploaddata, 0, -1)
         );
         $this->db->where('id', $id);
         $res = $this->db->update('paper_work', $data);
         if ($res) {
            if(count($upload_files)>0){
               for ($i=0; $i < count($upload_files); $i++) { 
                  $upload_files[$i]['paper_work_id'] = $id;
               }
               $this->db->insert_batch('paperworks_documents',$upload_files);
            }
         }
         $this->session->set_flashdata("success", "Your documentation is Updated Successfully");
         redirect("user/documentation", "refresh");
      }
   }   
}
     
public function documentation()
{
   $data['paperwork'] = $this->Contract_model->documentation();
   $data['paperworkdoc'] = $this->Contract_model->paperwrkdoc();
   if(isset($_SESSION['username']) && $_SESSION['username'] != ''){
   $this->load->view('includes/header',$data);
   $this->load->view('includes/sidebar');
   $this->load->view('documentation');
   $this->load->view('includes/footer');
   }
   else{
      redirect('/');
   }
}

//old
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
//new

public function deletePaperDoc()
{
   $id = $this->input->post('id');
   $doc = $this->db->get_where('paperworks_documents',array('paper_work_id'=>$id,'status'=>1))->result_array();
   // print_r($doc);die;
   foreach ($doc as $key => $value) {
      $file = $value['user_paperwork_document'];
      if(file_exists($file)){
         unlink($file);
      }
   }
   $res = $this->db->delete('paperworks_documents',array('paper_work_id'=>$id,'status'=>1));
   if($res){
      $res2 = $this->db->delete('paper_work',array('id'=>$id));
   }
   if($res && $res2){
      echo 'Paper Work Record Deleted Successfully';
   }else{
      echo 'Paper Work Can\'t be delete';
   }
}

//6)Logout 
public function logout()
   {
      $this->session->sess_destroy();
      redirect('/');
   }  

}
?>
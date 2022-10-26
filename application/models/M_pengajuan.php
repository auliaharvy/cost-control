<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pengajuan extends CI_Model {

	public function showdata($table){
		
	    $this->db->order_by('id', 'desc');
		$data = $this->db->get($table);
		if($data->num_rows() > 0){
			return $data->result_array();
		}else{
			return false;
		}
	}

	public function showpengajuandetail($id){
		$this->db->select('
          a.*,b.nama_jenis_rap,b.nama_pekerjaan,c.note_app,c.jumlah_approval,c.is_send_cash,IF(c.jumlah_approval is NOT NULL,FORMAT(c.jumlah_approval,0,"de_DE"),0) as jumlah_approval_v
          ,FORMAT(a.jumlah_pengajuan,0,"de_DE") as jumlah_pengajuan_v,IF(c.updated_at is NOT NULL,DATE_FORMAT(c.created_at,"%d %M %Y"),"-") as approval_date
      ');
	    
	    $this->db->from('akk_pengajuan_biaya as a');
	    $this->db->join('akk_rap_biaya as b', 'a.rap_biaya_id = b.id');
	    $this->db->join('akk_pengajuan_approval as c', 'a.id = c.pengajuan_biaya_id','left');
	    $this->db->where('a.pengajuan_id',$id);
		$data = $this->db->get();
		if($data->num_rows() > 0){
			return $data->result_array();
		}else{
			return false;
		}
	}

	public function showPengajuanApproval($id){
		$this->db->select('
          a.*,c.nama_jenis_rap,c.nama_pekerjaan,
      ');
	    
	    $this->db->from('akk_pengajuan_approval as a');
	    $this->db->join('akk_pengajuan_biaya as b', 'a.pengajuan_biaya_id = b.id');
	    $this->db->join('akk_rap_biaya as c', 'b.rap_biaya_id = c.id');
	    
	    $this->db->where('b.pengajuan_id',$id);
	    
		$data = $this->db->get();
		if($data->num_rows() > 0){
			return $data->result_array();
		}else{
			return false;
		}
	}

	public function getPengajuan($id){
		$this->db->select('
          a.*,b.project_name, b.project_location, b.project_deadline, b.rab_project, b.id, a.id as pengajuan_id
      ');
	    $this->db->from('akk_pengajuan as a');
	    $this->db->join('mst_project as b', 'a.project_id = b.id');
	      
	      $this->db->where('a.id',$id);
	      $data = $this->db->get();
		if($data->num_rows() > 0){
			return $data->result_array();
		}else{
			return false;
		}
	}

	

	public function showPengajuan(){
		
		// $this->db->select('
  //         a.*,sum(b.jumlah_pengajuan) as total_pengajuan,c.project_name,c.project_location,
  //         c.project_deadline
  //     ');
	 //    $this->db->order_by('id', 'desc');
	 //    $this->db->from('akk_pengajuan as a');
	 //    $this->db->join('akk_pengajuan_biaya as b', 'a.id = b.pengajuan_id');
	 //    $this->db->join('mst_project as c', 'a.project_id = c.id');
		$data = $this->db->query('SELECT a.*, b.jumlah_pengajuan as total_pengajuan,FORMAT(b.jumlah_pengajuan,0,"de_DE") as total_pengajuan_v, c.project_name
, c.project_location, DATE_FORMAT(c.project_deadline,"%d %M %Y") as project_deadline FROM akk_pengajuan as a 
JOIN (SELECT SUM(jumlah_pengajuan) AS jumlah_pengajuan,pengajuan_id FROM akk_pengajuan_biaya GROUP BY pengajuan_id) as b 
ON a.id = b.pengajuan_id 
JOIN mst_project as c ON a.project_id = c.id WHERE c.project_status=0');
		if($data->num_rows() > 0){
			return $data->result_array();
		}else{
			return false;
		}
	}

	public function showPencairan(){
		
		$this->db->select('
          a.*,c.project_name,c.project_location,
          c.project_deadline
      ');
	    $this->db->order_by('id', 'desc');
	    $this->db->from('akk_pengajuan as a');
	    
	    $this->db->join('mst_project as c', 'a.project_id = c.id');
		$data = $this->db->get();
		if($data->num_rows() > 0){
			return $data->result_array();
		}else{
			return false;
		}
	}

	public function dataPencairan(){
		
		$this->db->select('a.*,IF (a.destination_id = 1, p.project_name, c.project_name) AS pro_office,b.organization_name,
			g.nama_jenis_rap,g.nama_pekerjaan,h.project_name as project_source');
	    $this->db->order_by('id', 'desc');
	    $this->db->from('trx_pengiriman_uang as a');
	    $this->db->join('mst_organization as b', 'a.organization_id = b.id');
	    $this->db->join('mst_project as c', 'a.project_office_id = c.id','left');
	    
	    
	    $this->db->join('akk_pengajuan_approval as d', 'a.pengajuan_approval_id = d.id');
	    $this->db->join('akk_pengajuan_biaya as e', 'd.pengajuan_biaya_id = e.id');
	    $this->db->join('akk_pengajuan as f', 'e.pengajuan_id = f.id');
	    $this->db->join('akk_rap_biaya as g', 'e.rap_biaya_id = g.id');
	    $this->db->join('mst_project as h', 'f.project_id = h.id');
	    $this->db->join('mst_office as p', 'a.project_office_id = p.id','left');
	    
	    
	    $this->db->where('d.is_send_cash',1);
		$data = $this->db->get();
		if($data->num_rows() > 0){
			return $data->result_array();
		}else{
			return false;
		}
	}

	public function getOffice()
	{
		$this->db->select('
          a.id,concat(b.nama_type," ",c.fullname) AS project_name
      ');
      
      $this->db->from('mst_office as a');
      $this->db->join('mst_office_type as b', 'a.type_office_id = b.id');
      $this->db->join('mst_users as c', 'a.user_id = c.id');
      
      $query = $this->db->get();
      return $query->result_array();
	}

	

	public function GetData($tableName,$where="")
	{
		$data = $this->db->query('select * from '.$tableName.$where);
		return $data->result_array();
	}

	public function GetData2($tableName,$where="")
	{
		$data = $this->db->query('select * from '.$tableName.$where);
		return $data;
	}
	
	public function InsertData($tabelName,$data){
		$res = $this->db->insert($tabelName,$data);
		return $res;
	}

	public function DeleteData($tabelName,$where){
		$res = $this->db->delete($tabelName,$where);
		return $res;
	}
	
	public function UpdateData($tabelName,$data,$where){
		$res = $this->db->update($tabelName,$data,$where);
		return $res;
	}

	

}

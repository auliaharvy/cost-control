<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_project extends CI_Model {

	public function showdata($table){
		
	    $this->db->order_by('id', 'desc');
		$data = $this->db->get($table);
		if($data->num_rows() > 0){
			return $data->result_array();
		}else{
			return false;
		}
	}

	
	public function showproject($table,$status){
		
	    $this->db->order_by('id', 'desc');
	    $this->db->where('project_status',$status);
		$data = $this->db->get($table);
		if($data->num_rows() > 0){
			return $data->result_array();
		}else{
			return false;
		}
	}
		public function showInventory($id){
		
	    	$this->db->select('
          a.*,b.material_name, b.unit
      ');
	    $this->db->from('akk_inventory_project as a');
	    $this->db->join('mst_material as b', 'a.material_id = b.id');
	      
	      $this->db->where('a.project_id',$id);
	      $data = $this->db->get();
		if($data->num_rows() > 0){
			return $data->result_array();
		}else{
			return false;
		}
	}

	public function getProject($status){
		
		
	      $data = $this->db->query("SELECT a.*, FORMAT(c.total_biaya,0,'de_DE') as total_biaya_v,FORMAT(c.total_pengeluaran,0,'de_DE') as total_pengeluaran_v, a.project_name,FORMAT(a.cash_in_hand,0,'de_DE') as cash_in_hand
, a.project_location, a.project_deadline,FORMAT(a.rab_project,0,'de_DE') as rab_project_v,DATE_FORMAT(a.project_deadline,'%d %M %Y') as project_deadline_v,DATE_FORMAT(a.finish_at,'%d %M %Y') as finish_at_v, CONCAT(c.persentase,'%') as persentase_v FROM akk_rap as b 
RIGHT JOIN (SELECT rap_id,SUM(jumlah_biaya) AS total_biaya, SUM(jumlah_aktual) AS total_pengeluaran,ROUND((SUM(jumlah_aktual) / SUM(jumlah_biaya) * 100),2) as persentase FROM akk_rap_biaya GROUP BY rap_id) as c 
ON b.id = c.rap_id 
RIGHT JOIN mst_project as a ON b.project_id = a.id
WHERE a.project_status = $status");

		if($data->num_rows() > 0){
			return $data->result_array();
		}else{
			return false;
		}
	}

	public function getProjectAll(){
		
		
	      $data = $this->db->query("SELECT a.*, IF((c.persentase-a.project_progress)>5,'bg-danger text-white','') as background_text, FORMAT(c.total_biaya,0,'de_DE') as total_biaya_v,FORMAT(c.total_pengeluaran,0,'de_DE') as total_pengeluaran_v, a.project_name,FORMAT(a.cash_in_hand,0,'de_DE') as cash_in_hand
, a.project_location, a.project_deadline,FORMAT(a.rab_project,0,'de_DE') as rab_project_v,DATE_FORMAT(a.project_deadline,'%d %M %Y') as project_deadline_v,DATE_FORMAT(a.finish_at,'%d %M %Y') as finish_at_v, CONCAT(c.persentase,'%') as persentase_v FROM akk_rap as b 
RIGHT JOIN (SELECT rap_id,SUM(jumlah_biaya) AS total_biaya, SUM(jumlah_aktual) AS total_pengeluaran,ROUND((SUM(jumlah_aktual) / SUM(jumlah_biaya) * 100),2) as persentase FROM akk_rap_biaya GROUP BY rap_id) as c 
ON b.id = c.rap_id 
RIGHT JOIN mst_project as a ON b.project_id = a.id");

		if($data->num_rows() > 0){
			return $data->result_array();
		}else{
			return false;
		}
	}

	public function getProjectFinish($status){
		
	    $this->db->order_by('id', 'desc');
	    $this->
	    $this->db->where('project_status',$status);
		$data = $this->db->get("mst_project");
		if($data->num_rows() > 0){
			return $data->result_array();
		}else{
			return false;
		}
	}


	public function getBiayaPengajuan($id){
		$this->db->select('
          a.*,b.nama_jenis_rap, b.nama_pekerjaan, c.nama_jenis, d.nama_kategori,f.id as project_id,
          g.jumlah_approval,IF(g.jumlah_approval IS NOT NULL,FORMAT(g.jumlah_approval,0,"de_DE"),0) as jumlah_approval_v,FORMAT(a.jumlah_pengajuan,0,"de_DE") as jumlah_pengajuan_v
      ');
	    $this->db->from('akk_pengajuan_biaya as a');
	    $this->db->join('akk_pengajuan as e', 'a.pengajuan_id = e.id');
	    $this->db->join('mst_project as f', 'e.project_id = f.id');
	    $this->db->join('akk_rap_biaya as b', 'a.rap_biaya_id = b.id');
	   	$this->db->join('mst_jenis_biaya as c', 'b.jenis_biaya_id = c.id');
	    $this->db->join('mst_kategori_biaya as d', 'b.kategori_biaya_id = d.id');
	    $this->db->join('akk_pengajuan_approval as g', 'a.id = g.pengajuan_biaya_id','left');
	    $this->db->where('e.id',$id);
	      $data = $this->db->get();
		if($data->num_rows() > 0){
			return $data->result_array();
		}else{
			return false;
		}
	}


	public function getRap($id){
		$this->db->select('
          a.*,b.project_name, b.project_location, b.project_deadline, b.rab_project,b.cash_in_hand
      ');
	    $this->db->from('akk_rap as a');
	    $this->db->join('mst_project as b', 'a.project_id = b.id');
	      
	      $this->db->where('b.id',$id);
	      $data = $this->db->get();
		if($data->num_rows() > 0){
			return $data->result_array();
		}else{
			return false;
		}
	}
	
	public function getJenisrap($id){
		$this->db->select('
          a.*
      ');
	    $this->db->from('mst_jenis_biaya as a');
	   
	      
	      $this->db->where('a.id_kategori',$id);
	      $data = $this->db->get();
		if($data->num_rows() > 0){
			return $data->result_array();
		}else{
			return false;
		}
	}

	// public function getPengajuan($id){
	// 	$this->db->select('
 //          a.*,b.project_name, b.project_location, b.project_deadline, b.rab_project
 //      ');
	//     $this->db->from('akk_pengajuan as a');
	//     $this->db->join('mst_project as b', 'a.project_id = b.id');
	      
	//       $this->db->where('b.id',$id);
	//       $data = $this->db->get();
	// 	if($data->num_rows() > 0){
	// 		return $data->result_array();
	// 	}else{
	// 		return false;
	// 	}
	// }

	public function getPengajuan($id){
		$this->db->select('
          a.*,b.project_name, b.project_location, b.project_deadline, b.rab_project,c.id as pengajuan_id,c.is_pengajuan_confirm
      ');
		$this->db->from('akk_pengajuan as c');
	    $this->db->join('akk_rap as a','c.rap_id = a.id');
	    $this->db->join('mst_project as b', 'c.project_id = b.id');
	      
	      $this->db->where('b.id',$id);
	      $data = $this->db->get();
		if($data->num_rows() > 0){
			return $data->result_array();
		}else{
			return false;
		}
	}

	
	public function getBiayaRap($id,$kategori_id){
		$this->db->select('
          a.*,b.nama_jenis, c.nama_kategori,FORMAT(a.jumlah_biaya,0,"de_DE") as jumlah_biaya_v,IF(a.jumlah_aktual is NULL,0,FORMAT(a.jumlah_aktual,0,"de_DE")) as jumlah_aktual_v,
          IF(a.jumlah_aktual is NULL,0,ROUND(((jumlah_aktual) / (jumlah_biaya) * 100),2)) as persentase
      ');
	    $this->db->from('akk_rap_biaya as a');
	    $this->db->join('mst_jenis_biaya as b', 'a.jenis_biaya_id = b.id');
	    $this->db->join('mst_kategori_biaya as c', 'a.kategori_biaya_id = c.id');  
	    $this->db->where('a.rap_id',$id);
	    $this->db->where('a.kategori_biaya_id',$kategori_id);
	      $data = $this->db->get();
		if($data->num_rows() > 0){
			return $data->result_array();
		}else{
			return false;
		}
	}

	public function getBiayaRapformEdit($id){
		$this->db->select('
          a.*,b.nama_jenis, c.nama_kategori
      ');
	    $this->db->from('akk_rap_biaya as a');
	    $this->db->join('mst_jenis_biaya as b', 'a.jenis_biaya_id = b.id');
	    $this->db->join('mst_kategori_biaya as c', 'a.kategori_biaya_id = c.id');  
	    $this->db->where('a.rap_id',$id);
	   
	      $data = $this->db->get();
		if($data->num_rows() > 0){
			return $data->result_array();
		}else{
			return false;
		}
	}

	public function getBiayaRap2($id){
		$this->db->select('
          a.*,b.nama_jenis, c.nama_kategori
      ');
	    $this->db->from('akk_rap_biaya as a');
	    $this->db->join('mst_jenis_biaya as b', 'a.jenis_biaya_id = b.id');
	    $this->db->join('mst_kategori_biaya as c', 'a.kategori_biaya_id = c.id');  
	    $this->db->where('a.rap_id',$id);
	   
	      $data = $this->db->get();
		if($data->num_rows() > 0){
			return $data->result_array();
		}else{
			return false;
		}
	}




	public function showKas($id,$date){
		$this->db->select('
          a.*,b.id as param_id, b.value as jenis_kas
      ');
      $this->db->join('mst_param as b', 'a.kas_type = b.id');
      $this->db->from('mst_kas as a');
      $this->db->where('b.id',$id);
      if($date!=null){
      	$this->db->where('DATE(a.created_at)',$date);
      }
      
      $query = $this->db->get();
      return $query->result_array();
	}

	

	public function GetData($tableName,$where="")
	{
		$data = $this->db->query('select * from '.$tableName.$where);
		return $data->result_array();
	}
	
		public function GetDataInventory($id)
	{
		$data = $this->db->query("select a.material_id as mat_id_prj,a.qty as qty_prj, b.material_id as mat_id_inv,b.qty as qty_inv 
		        from akk_inventory_project as a left join akk_inventory as b on a.material_id=b.material_id where a.project_id=$id");
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

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_data extends CI_Model
{

	public function showdata($table)
	{

		$this->db->order_by('id', 'asc');
		$data = $this->db->get($table);
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function showKas($id, $date)
	{
		$this->db->select('
          a.*,b.id as param_id, b.value as jenis_kas
      ');
		$this->db->join('mst_param as b', 'a.kas_type = b.id');
		$this->db->from('mst_kas as a');
		$this->db->where('b.id', $id);
		if ($date != null) {
			$this->db->where('DATE(a.created_at)', $date);
		}

		$query = $this->db->get();
		return $query->result_array();
	}

	public function showLogKas()
	{
		$this->db->select('
          *,DATE_FORMAT(created_at,"%d %M %Y") as created_at_v
      ');

		$this->db->from('log_mst_organization');
		$this->db->order_by('id', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function showLogMaterial()
	{
		$this->db->select('
          a.*,DATE_FORMAT(a.created_at,"%d %M %Y") as created_at_v,b.project_name,c.material_name
      ');

		$this->db->from('log_inventory_organization as a');
		$this->db->join('mst_project as b', 'a.project_id = b.id', 'left');
		$this->db->join('mst_material as c', 'a.material_id = c.id');
		$this->db->order_by('a.id', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function showLogMaterialRange($range)
	{
		$data = $this->db->query("SELECT a.*,b.project_name,c.material_name,DATE_FORMAT(a.created_at,'%d %M %Y') as created_at_v
			FROM log_inventory_organization as a LEFT JOIN mst_project as b on a.project_id=b.id
			JOIN mst_material as c on a.material_id=c.id
			WHERE a.created_at >= DATE_ADD(NOW(), INTERVAL -$range MONTH)");
		return $data->result_array();
	}

	public function showLogKasRange($range)
	{
		$data = $this->db->query("SELECT *,DATE_FORMAT(created_at,'%d %M %Y') as created_at_v
			FROM log_mst_organization
			WHERE created_at >= DATE_ADD(NOW(), INTERVAL -$range MONTH)");
		return $data->result_array();
	}

	public function showInventory()
	{
		$this->db->select('
          a.*,b.material_name, b.unit
      ');
		$this->db->from('akk_inventory as a');
		$this->db->join('mst_material as b', 'a.material_id = b.id');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function getpengajuan()
	{
		$this->db->select('
		FORMAT(a.jumlah_pengajuan,0,"de_DE") as jumlah_uang,
		');
		$this->db->from('akk_pengajuan_biaya as a');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function GetData($tableName, $where = "")
	{
		$data = $this->db->query('select * from ' . $tableName . $where);
		return $data->result_array();
	}

	public function GetKasRange($range)
	{ //master kas di dashboard
		$data = $this->db->query("SELECT *,DATE_FORMAT(created_at,'%d %M %Y') as created_at_v
			FROM log_mst_organization
			WHERE created_at >= DATE_ADD(NOW(), INTERVAL -$range MONTH)");
		return $data;
	}

	public function GetJumlahKasRange($range)
	{
		$data = $this->db->query("SELECT SUM(cash_additional) as total_kas
			FROM log_mst_organization
			WHERE created_at >= DATE_ADD(NOW(), INTERVAL -$range MONTH)");
		return $data->result_array();
	}

	public function GetKas()
	{ //master kas di dashboard

		$data = $this->db->query("SELECT *,DATE_FORMAT(created_at,'%d %M %Y') as created_at_v
			FROM log_mst_organization");
		return $data;
	}

	public function GetJumlahKas()
	{
		$data = $this->db->query("SELECT SUM(cash_additional) as total_kas
			FROM log_mst_organization");
		return $data->result_array();
	}

	public function getProject()
	{
		$data = $this->db->query("SELECT a.*, a.project_name, a.project_location FROM akk_rap as b 
		JOIN (SELECT rap_id,SUM(jumlah_biaya) AS total_biaya, SUM(jumlah_aktual) AS total_pengeluaran FROM akk_rap_biaya GROUP BY rap_id) as c 
		ON b.id = c.rap_id JOIN mst_project as a ON b.project_id = a.id");
		return $data;
	}


	public function getAll()
	{
		$this->db->select("
          a.project_name,SUM(b.nominal) as total_omset,sum(a.rab_project) - sum(b.nominal) as total_piutang,
		  sum(c.nominal) as total_hutang,sum(a.cash_in_hand) as total_kas,SUM(e.jumlah_pengajuan) as total_pengajuan
      ");
		$this->db->from('mst_project as a');
		$this->db->join('akk_penerimaan_project as b', 'a.id = b.project_id');
		$this->db->join('akk_hutang as c', 'a.id = b.project_id');
		$this->db->join('akk_pengajuan as d', 'a.id = d.project_id');
		$this->db->join('akk_pengajuan_biaya as e', 'd.id = e.pengajuan_id');
		// $this->db->where('a.id');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data;
		} else {
			return false;
		}
	}

	public function getAlltitle()
	{
		$this->db->select("
          a.project_name,SUM(b.nominal) as total_omset,sum(a.rab_project) - sum(b.nominal) as total_piutang,
		  sum(c.nominal) as total_hutang,sum(a.cash_in_hand) as total_kas,SUM(e.jumlah_pengajuan) as total_pengajuan
      ");
		$this->db->from('mst_project as a');
		$this->db->join('akk_penerimaan_project as b', 'a.id = b.project_id');
		$this->db->join('akk_hutang as c', 'a.id = b.project_id');
		$this->db->join('akk_pengajuan as d', 'a.id = d.project_id');
		$this->db->join('akk_pengajuan_biaya as e', 'd.id = e.pengajuan_id');
		// $this->db->where('a.id');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function getOmset()
	{
		$this->db->select("
          a.project_name,SUM(b.nominal) as total_omset
      ");
		$this->db->from('mst_project as a');
		$this->db->join('akk_penerimaan_project as b', 'a.id = b.project_id');
		$this->db->group_by('a.id');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data;
		} else {
			return false;
		}
	}

	public function getPiutang()
	{
		$this->db->select("
          a.project_name,a.rab_project - sum(b.nominal) as total_piutang
      ");
		$this->db->from('mst_project as a');
		$this->db->join('akk_penerimaan_project as b', 'a.id = b.project_id');
		$this->db->group_by('a.id');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data;
		} else {
			return false;
		}
	}

	public function getHutang()
	{
		$this->db->select("
          a.project_name,sum(b.nominal) as total_hutang
      ");
		$this->db->from('mst_project as a');
		$this->db->join('akk_hutang as b', 'a.id = b.project_id');
		$this->db->group_by('a.id');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data;
		} else {
			return false;
		}
	}

	public function getKasdashboard()
	{
		$this->db->select("
          a.project_name,sum(a.cash_in_hand) as total_kas	
      ");
		$this->db->from('mst_project as a');
		$this->db->group_by('a.id');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data;
		} else {
			return false;
		}
	}

	public function getPengajuandashboard()
	{
		$this->db->select("
          a.project_name,SUM(c.jumlah_pengajuan) as total_pengajuan
      ");
		$this->db->from('mst_project as a');
		$this->db->join('akk_pengajuan as b', 'a.id = b.project_id');
		$this->db->join('akk_pengajuan_biaya as c', 'b.id = c.pengajuan_id');
		$this->db->group_by('a.id');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data;
		} else {
			return false;
		}
	}

	public function getProject2()
	{

		$this->db->select("
    	a.project_name,a.rab_project,a.cash_in_hand as total_kas,sum(b.nominal) as total_hutang,
		a.rab_project - sum(c.nominal) as total_piutang
		");
		$this->db->from('mst_project as a');
		$this->db->join('akk_penerimaan_project as c', 'a.id = c.project_id', 'left');
		$this->db->join('akk_hutang as b', 'a.id = b.project_id', 'left');
		$this->db->group_by('a.id');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data;
		} else {
			return false;
		}
	}

	public function getProject3($project_id)
	{
		$this->db->select("
		a.*,sum(b.jumlah_pengajuan) as jumlah_pengajuan,sum(c.jumlah_approval) as jumlah_approval,
		sum(d.jumlah_uang) as jumlah_pencairan,sum(e.jumlah_uang_pembelian) as jumlah_pembelian,
		sum(g.jumlah_uang_pembelian) as jumlah_tanpa_pengajuan
        ");
		$this->db->from('akk_pengajuan as a');
		$this->db->join('akk_pengajuan_biaya as b', 'a.id = b.pengajuan_id');
		$this->db->join('akk_pengajuan_approval as c', 'b.id = c.pengajuan_biaya_id');
		$this->db->join('trx_pengiriman_uang as d', 'c.id = d.pengajuan_approval_id');
		$this->db->join('trx_pembelian_barang as e', 'd.id = e.pengiriman_uang_id');
		$this->db->join('mst_project as f', 'a.project_id = f.id', 'left');
		$this->db->join('trx_pembelian_barang_remaining as g', 'f.id = g.project_id', 'left');
		$this->db->where('f.id', $project_id);
		$this->db->group_by('a.id');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data;
		} else {
			return false;
		}
	}

	public function getTotalPengajuan()
	{
		$data = $this->db->query("select a.pengajuan_id,c.project_name,sum(a.jumlah_pengajuan) as total_pengajuan from akk_pengajuan_biaya as a 
	    JOIN akk_pengajuan as b on a.pengajuan_id = b.id JOIN mst_project as c on b.project_id = c.id group by a.pengajuan_id");
		return $data;
	}

	public function TotalPengajuan()
	{
		$data = $this->db->query("select sum(bb.total) as totalpengajuan from( select a.pengajuan_id,c.project_name,sum(a.jumlah_pengajuan) as total 
	    from akk_pengajuan_biaya as a JOIN akk_pengajuan as b on a.pengajuan_id = b.id 
	    JOIN mst_project as c on b.project_id = c.id group by a.pengajuan_id) as bb");
		return $data->result_array();
	}

	public function getTotalPengajuanApproval()
	{
		$data = $this->db->query("select a.pengajuan_id,c.project_name,sum(a.jumlah_approval) as total_approval from akk_pengajuan_approval as a 
	    JOIN akk_pengajuan as b on a.pengajuan_id = b.id JOIN mst_project as c on b.project_id = c.id group by a.pengajuan_id");
		return $data;
	}

	public function TotalPengajuanApproval()
	{
		$data = $this->db->query("select sum(bb.total_approval) as total_approval from( select a.pengajuan_id,c.project_name,sum(a.jumlah_approval) as total_approval 
	    from akk_pengajuan_approval as a JOIN akk_pengajuan as b on a.pengajuan_id = b.id 
	    JOIN mst_project as c on b.project_id = c.id group by a.pengajuan_id) as bb");
		return $data->result_array();
	}

	public function getPembelian()
	{
		$data = $this->db->query("select c.pengajuan_id,e.project_name,e.cash_in_hand,sum(a.jumlah_uang_pembelian) as total_pembelian 
	    from trx_pembelian_barang as a JOIN trx_pengiriman_uang as b on a.pengiriman_uang_id = b.id 
	    JOIN akk_pengajuan_approval as c on b.pengajuan_approval_id = c.id JOIN akk_pengajuan as d on c.pengajuan_id = d.id 
	    JOIN mst_project as e on d.project_id = e.id group by c.pengajuan_id");
		return $data;
	}

	public function TotalPembelian()
	{
		$data = $this->db->query("select sum(bb.total_pembelian) as total_pembelian from( select c.pengajuan_id,e.project_name,sum(a.jumlah_uang_pembelian) as total_pembelian 
	    from trx_pembelian_barang as a JOIN trx_pengiriman_uang as b on a.pengiriman_uang_id = b.id 
	    JOIN akk_pengajuan_approval as c on b.pengajuan_approval_id = c.id JOIN akk_pengajuan as d on c.pengajuan_id = d.id 
	    JOIN mst_project as e on d.project_id = e.id group by c.pengajuan_id) as bb");
		return $data->result_array();
	}


	public function getPembelianRemaining()
	{
		$data = $this->db->query("select b.project_name,sum(a.jumlah_uang_pembelian) as total_pembelian 
	    from trx_pembelian_barang_remaining as a join mst_project as b on a.project_id=b.id group by project_id");
		return $data;
	}

	public function TotalPembelianRemaining()
	{
		$data = $this->db->query("select sum(jumlah_uang_pembelian) as total_pembelian from trx_pembelian_barang_remaining");
		return $data->result_array();
	}

	public function GetData2($tableName, $where = "")
	{
		$data = $this->db->query('select * from ' . $tableName . $where);
		return $data;
	}

	public function InsertData($tabelName, $data)
	{
		$res = $this->db->insert($tabelName, $data);
		return $res;
	}

	public function DeleteData($tabelName, $where)
	{
		$res = $this->db->delete($tabelName, $where);
		return $res;
	}

	public function UpdateData($tabelName, $data, $where)
	{
		$res = $this->db->update($tabelName, $data, $where);
		return $res;
	}


	public function GetPie1()
	{
		$data = $this->db->query("SELECT project_name as kas_name,cash_in_hand FROM mst_project WHERE cash_In_hand > 0
		
		
		");
		if ($data->num_rows() > 0) {
			return $data;
		} else {
			return false;
		}
	}

	public function GetPie()
	{
		$data = $this->db->query("SELECT project_name as kas_name,cash_in_hand FROM mst_project as a 
		LEFT JOIN (SELECT SUM(nominal) as total_hutang,project_id FROM akk_hutang GROUP BY project_id) as b ON b.project_id = a.id 
		
		");
		if ($data->num_rows() > 0) {
			return $data;
		} else {
			return false;
		}
	}

	public function Total_cash()
	{
		$data = $this->db->query("SELECT SUM(jumlah_kas.cash_in_hand) as total FROM (
SELECT project_name as kas_name,cash_in_hand FROM mst_project WHERE cash_In_hand > 0) AS jumlah_kas;");

		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function masterkas()
	{
		$this->db->select('
          a.cash_in_hand
      ');
		$this->db->from('mst_organization as a');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function cekMaterialProject($project_id, $material_id)
	{
		$data = $this->db->query("select * from akk_inventory_project where project_id='$project_id' and material_id='$material_id'");
		return $data->result_array();
	}

	public function cekMaterialInventory($material_id)
	{
		$data = $this->db->query("select * from akk_inventory where material_id='$material_id'");
		return $data->result_array();
	}

	public function GetDataTransfer($project_id, $material_id)
	{
		$data = $this->db->query("select * from akk_inventory_project where project_id='$project_id' material_id='$material_id'");
		return $data->result_array();
	}
}

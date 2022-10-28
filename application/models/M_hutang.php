<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_hutang extends CI_Model
{

	public function showdata($table)
	{

		$this->db->order_by('id', 'desc');
		$data = $this->db->get($table);
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function showpengajuandetail($id)
	{
		$this->db->select('
          a.*,b.nama_jenis_rap,b.nama_pekerjaan,c.jumlah_approval
      ');

		$this->db->from('akk_pengajuan_biaya as a');
		$this->db->join('akk_rap_biaya as b', 'a.rap_biaya_id = b.id');
		$this->db->join('akk_pengajuan_approval as c', 'a.id = c.pengajuan_biaya_id', 'left');
		$this->db->where('a.pengajuan_id', $id);
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function showPengajuanApproval($id)
	{
		$this->db->select('
          a.*,c.nama_jenis_rap,c.nama_pekerjaan,FORMAT(a.jumlah_approval,0,"de_DE") as jumlah_approval_v
      ');

		$this->db->from('akk_pengajuan_approval as a');
		$this->db->join('akk_pengajuan_biaya as b', 'a.pengajuan_biaya_id = b.id');
		$this->db->join('akk_rap_biaya as c', 'b.rap_biaya_id = c.id');

		$this->db->where('b.pengajuan_id', $id);

		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function getHutang($id)
	{
		$this->db->select('
          a.*,b.project_name, b.project_location, b.project_deadline, b.rab_project, b.id, a.id as hutang_id, b.cash_in_hand
      ');
		$this->db->from('akk_hutang as a');
		$this->db->join('mst_project as b', 'a.project_id = b.id');

		$this->db->where('a.project_id', $id);
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function showHutang()
	{
		$role = $this->session->userdata('role');
		$user_id = $this->session->userdata('id');
		if ($role == 4) {
			$data = $this->db->query("SELECT a.*, FORMAT(b.termin_terbayar,0,'de_DE') as total_hutang, FORMAT(a.rab_project,0,'de_DE') as rab_project_v,
		FORMAT(ROUND((a.rab_project - b.termin_terbayar),0),0,'de_DE') as sisa_termin FROM mst_project as a 
		JOIN (SELECT SUM(nominal) AS termin_terbayar,project_id, is_pay FROM akk_hutang GROUP BY project_id) as b 
		ON a.id = b.project_id 
		WHERE a.project_status = 0 AND a.created_by = $user_id AND b.is_pay = 0");
		} else {
			$data = $this->db->query("SELECT a.*, FORMAT(b.termin_terbayar,0,'de_DE') as total_hutang, FORMAT(a.rab_project,0,'de_DE') as rab_project_v,
		FORMAT(ROUND((a.rab_project - b.termin_terbayar),0),0,'de_DE') as sisa_termin FROM mst_project as a 
		JOIN (SELECT SUM(nominal) AS termin_terbayar,project_id, is_pay FROM akk_hutang GROUP BY project_id) as b 
		ON a.id = b.project_id 
		WHERE b.is_pay = 0");
		}
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function showHutangProject($id)
	{
		$user_id = $this->session->userdata('id');
		$this->db->select('
          a.*, FORMAT(a.nominal,0,"de_DE") AS nominal_v,
          
      ');
		$this->db->order_by('id', 'asc');
		$this->db->from('akk_hutang as a');
		$this->db->where('a.project_id', $id);
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function dataPencairan()
	{

		$this->db->select('a.*,IF (a.destination_id = 1, concat(q.nama_type," ",r.fullname), c.project_name) AS pro_office,b.organization_name,FORMAT(a.jumlah_uang,0,"de_DE") as jumlah_uang,
			g.nama_jenis_rap,g.nama_pekerjaan,h.project_name as project_source');
		$this->db->order_by('id', 'desc');
		$this->db->from('trx_pengiriman_uang as a');
		$this->db->join('mst_organization as b', 'a.organization_id = b.id');
		$this->db->join('mst_project as c', 'a.project_office_id = c.id', 'left');


		$this->db->join('akk_pengajuan_approval as d', 'a.pengajuan_approval_id = d.id');
		$this->db->join('akk_pengajuan_biaya as e', 'd.pengajuan_biaya_id = e.id');
		$this->db->join('akk_pengajuan as f', 'e.pengajuan_id = f.id');
		$this->db->join('akk_rap_biaya as g', 'e.rap_biaya_id = g.id');
		$this->db->join('mst_project as h', 'f.project_id = h.id');
		$this->db->join('mst_office as p', 'a.project_office_id = p.id', 'left');
		$this->db->join('mst_office_type as q', 'p.type_office_id = q.id', 'left');
		$this->db->join('mst_users as r', 'p.user_id = r.id', 'left');

		$this->db->where('d.is_send_cash', 1);
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
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



	public function GetData($tableName, $where = "")
	{
		$data = $this->db->query('select * from ' . $tableName . $where);
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
}

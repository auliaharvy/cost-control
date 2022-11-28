<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_laporan extends CI_Model
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

	public function getProjectAll()
	{
		$role = $this->session->userdata('role');
		$user_id = $this->session->userdata('id');
		if ($role == 4) {
			$data = $this->db->query("SELECT a.*, IF((c.persentase-a.project_progress)>5,'bg-danger text-white','') as background_text, FORMAT(d.termin_terbayar,0,'de_DE') as termin_terbayar, FORMAT(e.total_hutang,0,'de_DE') as total_hutang,FORMAT(c.total_biaya,0,'de_DE') as total_biaya_v,FORMAT(c.total_pengeluaran,0,'de_DE') as total_pengeluaran_v, a.project_name,FORMAT(a.cash_in_hand,0,'de_DE') as cash_in_hand
			, FORMAT(ROUND((a.rab_project - d.termin_terbayar),0),0,'de_DE') as sisa_termin, a.project_location, a.project_deadline,FORMAT(a.rab_project,0,'de_DE') as rab_project_v,DATE_FORMAT(a.project_deadline,'%d %M %Y') as project_deadline_v,DATE_FORMAT(a.finish_at,'%d %M %Y') as finish_at_v, CONCAT(c.persentase,'%') as persentase_v FROM akk_rap as b
			RIGHT JOIN (SELECT rap_id,SUM(jumlah_biaya) AS total_biaya, SUM(jumlah_aktual) AS total_pengeluaran,ROUND((SUM(jumlah_aktual) / SUM(jumlah_biaya) * 100),2) as persentase FROM akk_rap_biaya GROUP BY rap_id) as c 
			ON b.id = c.rap_id 
			RIGHT JOIN mst_project as a ON b.project_id = a.id 
			LEFT JOIN (SELECT SUM(nominal) AS termin_terbayar,project_id FROM akk_penerimaan_project GROUP BY project_id) as d ON d.project_id = a.id
			LEFT JOIN (SELECT SUM(nominal) AS total_hutang,project_id FROM akk_hutang WHERE is_pay = 0 GROUP BY project_id) as e ON e.project_id = a.id
			WHERE a.created_by = $user_id");
		} else {
			$data = $this->db->query("SELECT a.*, IF((c.persentase-a.project_progress)>5,'bg-danger text-white','') as background_text, FORMAT(d.termin_terbayar,0,'de_DE') as termin_terbayar, FORMAT(e.total_hutang,0,'de_DE') as total_hutang,FORMAT(c.total_biaya,0,'de_DE') as total_biaya_v,FORMAT(c.total_pengeluaran,0,'de_DE') as total_pengeluaran_v, a.project_name,FORMAT(a.cash_in_hand,0,'de_DE') as cash_in_hand
			, FORMAT(ROUND((a.rab_project - d.termin_terbayar),0),0,'de_DE') as sisa_termin, a.project_location, a.project_deadline,FORMAT(a.rab_project,0,'de_DE') as rab_project_v,DATE_FORMAT(a.project_deadline,'%d %M %Y') as project_deadline_v,DATE_FORMAT(a.finish_at,'%d %M %Y') as finish_at_v, CONCAT(c.persentase,'%') as persentase_v FROM akk_rap as b 
			RIGHT JOIN (SELECT rap_id,SUM(jumlah_biaya) AS total_biaya, SUM(jumlah_aktual) AS total_pengeluaran,ROUND((SUM(jumlah_aktual) / SUM(jumlah_biaya) * 100),2) as persentase FROM akk_rap_biaya GROUP BY rap_id) as c 
			ON b.id = c.rap_id
			RIGHT JOIN mst_project as a ON b.project_id = a.id
			LEFT JOIN (SELECT SUM(nominal) AS termin_terbayar,project_id FROM akk_penerimaan_project GROUP BY project_id) as d ON d.project_id = a.id
			LEFT JOIN (SELECT SUM(nominal) AS total_hutang,project_id FROM akk_hutang WHERE is_pay = 0 GROUP BY project_id) as e ON e.project_id = a.id
			");
		}
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function getBiayaRap($id)
	{
		$this->db->select('
          a.*, c.nama_kategori,FORMAT(a.jumlah_biaya,0,"de_DE") as jumlah_biaya_v,IF(a.jumlah_aktual is NULL,0,FORMAT(a.jumlah_aktual,0,"de_DE")) as jumlah_aktual_v,
          IF(a.jumlah_aktual is NULL,0,ROUND(((jumlah_aktual) / (jumlah_biaya) * 100),2)) as presentase,IF(a.jumlah_aktual is NULL,0,a.jumlah_aktual) as jumlah_aktual_f
      ');
		$this->db->from('akk_rap_biaya as a');
		$this->db->join('akk_rap as d', 'a.rap_id = d.id');
		$this->db->join('mst_project as e', 'd.project_id = e.id');
		$this->db->join('mst_kategori_biaya as c', 'a.kategori_biaya_id = c.id');
		$this->db->where('d.project_id', $id);
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function getRap($id)
	{
		$this->db->select("
          a.*,b.project_name, b.project_location, b.project_deadline, b.rab_project,b.cash_in_hand,b.project_status,
          IF(b.project_status=0,'bg-danger text-white','bg-success text-white') as background_text
      ");
		$this->db->from('akk_rap as a');
		$this->db->join('mst_project as b', 'a.project_id = b.id');

		$this->db->where('b.id', $id);
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function showuangdetail($id)
	{
		$this->db->select('
        a.*,d.nama_jenis_rap,d.nama_pekerjaan,FORMAT(c.jumlah_pengajuan,0,"de_DE") as jumlah_pengajuan_v,
		FORMAT(e.jumlah_approval,0,"de_DE") as jumlah_approval_v,FORMAT(f.jumlah_uang,0,"de_DE") as jumlah_pencairan_v,
		FORMAT(g.jumlah_uang_pembelian,0,"de_DE") as jumlah_pembelian_v,c.is_approved,e.is_send_cash,f.is_buy,
		c.note as note1,e.note_app as note2,g.note as note3,
		DATE_FORMAT(c.created_at,"%d %M %Y") as created_at1,DATE_FORMAT(e.created_at,"%d %M %Y") as created_at2,
		DATE_FORMAT(f.created_at,"%d %M %Y") as created_at3,DATE_FORMAT(g.created_at,"%d %M %Y") as created_at4
        ');
		$this->db->from('akk_pengajuan as a');
		$this->db->join('mst_project as b', 'a.project_id = b.id');
		$this->db->join('akk_pengajuan_biaya as c', 'a.id = c.pengajuan_id');
		$this->db->join('akk_rap_biaya as d', 'c.rap_biaya_id = d.id');
		$this->db->join('akk_pengajuan_approval as e', 'c.id = e.pengajuan_biaya_id', 'left');
		$this->db->join('trx_pengiriman_uang as f', 'e.id = f.pengajuan_approval_id', 'left');
		$this->db->join('trx_pembelian_barang as g', 'f.id = g.pengiriman_uang_id', 'left');
		$this->db->where('a.project_id', $id);
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function showuangdetailremaining($id)
	{
		$this->db->select('
        c.nama_jenis_rap,c.nama_pekerjaan,FORMAT(a.jumlah_uang_pembelian,0,"de_DE") as jumlah_pembelian_v,a.note as note1,
		DATE_FORMAT(a.created_at,"%d %M %Y") as created_at1
        ');
		$this->db->from('trx_pembelian_barang_remaining as a');
		$this->db->join('mst_project as b', 'a.project_id = b.id');
		$this->db->join('akk_rap_biaya as c', 'a.rap_biaya_id = c.id');
		$this->db->where('a.project_id', $id);
		$data = $this->db->get();
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

	public function dataPencairan($id)
	{

		$this->db->select('a.*,IF (a.destination_id = 1, concat(q.nama_type," ",r.fullname), c.project_name) AS pro_office,b.organization_name,
		FORMAT(a.jumlah_uang,0,"de_DE") as jumlah_uang,
		DATE_FORMAT(a.created_at,"%d %M %Y") as tanggal_pencairan,
		g.nama_jenis_rap,g.nama_pekerjaan,h.project_name as project_source');
		$this->db->order_by('id', 'asc');
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
		$this->db->where('h.id', $id);
		$this->db->where('d.is_send_cash', 1);
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function dataPembelian($id)
	{ //pembelian berdasarkan pengajuan

		$this->db->select('
		a.*,IF (a.destination_id = 1, concat(q.nama_type," ",r.fullname), c.project_name) AS pro_office,FORMAT(a.jumlah_uang_pembelian,0,"de_DE") as jumlah_uang,
		g.nama_jenis_rap,g.nama_pekerjaan,h.project_name as project_source,
		DATE_FORMAT(a.created_at,"%d %M %Y") as tanggal_pembelian
		');
		$this->db->order_by('id', 'asc');
		$this->db->from('trx_pembelian_barang as a');
		$this->db->join('trx_pengiriman_uang as s', 'a.pengiriman_uang_id = s.id');
		$this->db->join('mst_project as c', 'a.project_office_id = c.id', 'left');
		$this->db->join('akk_pengajuan_approval as d', 's.pengajuan_approval_id = d.id');
		$this->db->join('akk_pengajuan_biaya as e', 'd.pengajuan_biaya_id = e.id');
		$this->db->join('akk_pengajuan as f', 'e.pengajuan_id = f.id');
		$this->db->join('akk_rap_biaya as g', 'e.rap_biaya_id = g.id');
		$this->db->join('mst_project as h', 'f.project_id = h.id');
		$this->db->join('mst_office as p', 'a.project_office_id = p.id', 'left');
		$this->db->join('mst_office_type as q', 'p.type_office_id = q.id', 'left');
		$this->db->join('mst_users as r', 'p.user_id = r.id', 'left');
		$this->db->where('h.id', $id);
		$this->db->where('d.is_send_cash', 1);
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function dataPembelianRemaining($id)
	{ //pembelian berdasarkan pengajuan

		$this->db->select('a.*,IF (a.destination_id = 1, concat(q.nama_type," ",r.fullname), c.project_name) AS pro_office,FORMAT(a.jumlah_uang_pembelian,0,"de_DE") as jumlah_uang,
			g.nama_jenis_rap,g.nama_pekerjaan,h.project_name as project_source,
			DATE_FORMAT(a.created_at,"%d %M %Y") as tanggal_pembelian
			');
		$this->db->order_by('id', 'asc');
		$this->db->from('trx_pembelian_barang_remaining as a');

		$this->db->join('mst_project as c', 'a.project_office_id = c.id', 'left');



		$this->db->join('akk_rap_biaya as g', 'a.rap_biaya_id = g.id');
		$this->db->join('mst_project as h', 'a.project_id = h.id');
		$this->db->join('mst_office as p', 'a.project_office_id = p.id', 'left');
		$this->db->join('mst_office_type as q', 'p.type_office_id = q.id', 'left');
		$this->db->join('mst_users as r', 'p.user_id = r.id', 'left');
		$this->db->where('h.id', $id);

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

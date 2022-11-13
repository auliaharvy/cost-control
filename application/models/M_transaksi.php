<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_transaksi extends CI_Model
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
          a.*,c.nama_jenis_rap,c.nama_pekerjaan,FORMAT(a.jumlah_approval,0,"de_DE") as jumlah_approval_v,
          IF(d.created_at is NOT NULL,DATE_FORMAT(d.created_at,"%d %M %Y"),"-") as tanggal_pencairan
      ');

		$this->db->from('akk_pengajuan_approval as a');
		$this->db->join('trx_pengiriman_uang as d', 'd.pengajuan_approval_id = a.id', 'left');
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

	public function getPengajuan($id)
	{
		$this->db->select('
        a.*,b.project_name, b.project_location, b.project_deadline, b.rab_project, b.id, a.id as pengajuan_id
        ');
		$this->db->from('akk_pengajuan as a');
		$this->db->join('mst_project as b', 'a.project_id = b.id');

		$this->db->where('a.id', $id);
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function showTermin()
	{
		$data = $this->db->query('SELECT a.*, FORMAT(b.termin_terbayar,0,"de_DE") as termin_terbayar, FORMAT(a.rab_project,0,"de_DE") as rab_project_v,
		FORMAT(ROUND((a.rab_project - b.termin_terbayar),0),0,"de_DE") as sisa_termin, DATE_FORMAT(a.project_deadline,"%d %M %Y") as project_deadline FROM mst_project as a 
		JOIN (SELECT SUM(nominal) AS termin_terbayar,project_id FROM akk_penerimaan_project GROUP BY project_id) as b 
		ON a.id = b.project_id ');
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function showPengajuan()
	{
		$data = $this->db->query('SELECT a.*, b.jumlah_pengajuan as total_pengajuan,FORMAT(b.jumlah_pengajuan,0,"de_DE") as total_pengajuan_v, c.project_name
, c.project_location, DATE_FORMAT(c.project_deadline,"%d %M %Y") as project_deadline FROM akk_pengajuan as a 
JOIN (SELECT SUM(jumlah_pengajuan) AS jumlah_pengajuan,pengajuan_id FROM akk_pengajuan_biaya GROUP BY pengajuan_id) as b 
ON a.id = b.pengajuan_id 
JOIN mst_project as c ON a.project_id = c.id WHERE c.project_status=0');
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function pengajuanbelumapprove()
	{
		$this->db->select('
        a.*, c.project_name, d.nama_pekerjaan, DATE_FORMAT(a.created_at,"%d %M %Y") as tanggal_pengajuan,
		FORMAT(b.jumlah_pengajuan,0,"de_DE") as jumlah_pengajuan, b.note as keterangan, b.id as akk_pengajuan_biaya_id
        ');
		$this->db->from('akk_pengajuan as a');
		$this->db->join('akk_pengajuan_biaya as b', 'a.id = b.pengajuan_id');
		$this->db->join('mst_project as c', 'a.project_id = c.id');
		$this->db->join('akk_rap_biaya as d', 'b.rap_biaya_id = d.id');
		$this->db->where('b.is_approved', 0);
		$this->db->group_by('b.id');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function pengajuansudahapprove()
	{
		$this->db->select('
        a.*, c.project_name, d.nama_pekerjaan, DATE_FORMAT(e.updated_at,"%d %M %Y") as tanggal_approve,
		FORMAT(b.jumlah_pengajuan,0,"de_DE") as jumlah_pengajuan, FORMAT(e.jumlah_approval,0,"de_DE") as jumlah_approval_v,
		e.note_app as keterangan
        ');
		$this->db->from('akk_pengajuan as a');
		$this->db->join('akk_pengajuan_biaya as b', 'a.id = b.pengajuan_id');
		$this->db->join('mst_project as c', 'a.project_id = c.id');
		$this->db->join('akk_rap_biaya as d', 'b.rap_biaya_id = d.id');
		$this->db->join('akk_pengajuan_approval as e', 'a.id = e.pengajuan_id');
		$this->db->where('b.is_approved', 1);
		$this->db->group_by('b.pengajuan_id');
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
		FORMAT(ROUND((a.rab_project - b.termin_terbayar),0),0,'de_DE') as sisa_termin, DATE_FORMAT(a.project_deadline, '%d %M %Y') as project_deadline FROM mst_project as a 
		JOIN (SELECT SUM(nominal) AS termin_terbayar,project_id, is_pay FROM akk_hutang GROUP BY project_id) as b 
		ON a.id = b.project_id 
		WHERE a.project_status = 0 AND a.created_by = $user_id AND b.is_pay = 0");
		} else {
			$data = $this->db->query("SELECT a.*, FORMAT(b.termin_terbayar,0,'de_DE') as total_hutang, FORMAT(a.rab_project,0,'de_DE') as rab_project_v,
		FORMAT(ROUND((a.rab_project - b.termin_terbayar),0),0,'de_DE') as sisa_termin, DATE_FORMAT(a.project_deadline,'%d %M %Y') as project_deadline FROM mst_project as a 
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

	public function showHutangbelum()
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

	public function showHutangsudah()
	{
		$role = $this->session->userdata('role');
		$user_id = $this->session->userdata('id');
		if ($role == 4) {
			$data = $this->db->query("SELECT a.*, FORMAT(b.termin_terbayar,0,'de_DE') as total_hutang, FORMAT(a.rab_project,0,'de_DE') as rab_project_v,
		FORMAT(ROUND((a.rab_project - b.termin_terbayar),0),0,'de_DE') as sisa_termin FROM mst_project as a 
		JOIN (SELECT SUM(nominal) AS termin_terbayar,project_id, is_pay FROM akk_hutang GROUP BY project_id) as b 
		ON a.id = b.project_id 
		WHERE a.project_status = 0 AND a.created_by = $user_id AND b.is_pay = 1");
		} else {
			$data = $this->db->query("SELECT a.*, FORMAT(b.termin_terbayar,0,'de_DE') as total_hutang, FORMAT(a.rab_project,0,'de_DE') as rab_project_v,
		FORMAT(ROUND((a.rab_project - b.termin_terbayar),0),0,'de_DE') as sisa_termin FROM mst_project as a 
		JOIN (SELECT SUM(nominal) AS termin_terbayar,project_id, is_pay FROM akk_hutang GROUP BY project_id) as b 
		ON a.id = b.project_id 
		WHERE b.is_pay = 1");
		}
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function showPencairan()
	{
		$this->db->select('
        a.*,c.project_name,c.project_location, DATE_FORMAT(c.project_deadline,"%d %M %Y") as project_deadline
        ');
		$this->db->order_by('id', 'asc');
		$this->db->from('akk_pengajuan as a');
		$this->db->join('mst_project as c', 'a.project_id = c.id');
		$this->db->where('c.project_status', 0);
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function dataPencairan()
	{

		$this->db->select('
		a.*,IF (a.destination_id = 1, concat(q.nama_type," ",r.fullname), c.project_name) AS pro_office,b.organization_name,FORMAT(a.jumlah_uang,0,"de_DE") as jumlah_uang,
		g.nama_jenis_rap,g.nama_pekerjaan,h.project_name as project_source
		');
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

	public function getProject($status)
	{
		$role = $this->session->userdata('role');
		$user_id = $this->session->userdata('id');
		if ($role == 4) {
			$data = $this->db->query("SELECT a.*, FORMAT(c.total_biaya,0,'de_DE') as total_biaya_v,FORMAT(c.total_pengeluaran,0,'de_DE') as total_pengeluaran_v, a.project_name,FORMAT(a.cash_in_hand,0,'de_DE') as cash_in_hand, a.project_location, a.project_deadline,FORMAT(a.rab_project,0,'de_DE') as rab_project_v,DATE_FORMAT(a.project_deadline,'%d %M %Y') as project_deadline_v,DATE_FORMAT(a.finish_at,'%d %M %Y') as finish_at_v, CONCAT(c.persentase,'%') as persentase_v FROM akk_rap as b 
			RIGHT JOIN (SELECT rap_id,SUM(jumlah_biaya) AS total_biaya, SUM(jumlah_aktual) AS total_pengeluaran,ROUND((SUM(jumlah_aktual) / SUM(jumlah_biaya) * 100),2) as persentase FROM akk_rap_biaya GROUP BY rap_id) as c 
			ON b.id = c.rap_id RIGHT JOIN mst_project as a ON b.project_id = a.id
			WHERE a.project_status = $status AND a.created_by = $user_id");
		} else {
			$data = $this->db->query("SELECT a.*, FORMAT(c.total_biaya,0,'de_DE') as total_biaya_v,FORMAT(c.total_pengeluaran,0,'de_DE') as total_pengeluaran_v, a.project_name,FORMAT(a.cash_in_hand,0,'de_DE') as cash_in_hand, a.project_location, a.project_deadline,FORMAT(a.rab_project,0,'de_DE') as rab_project_v,DATE_FORMAT(a.project_deadline,'%d %M %Y') as project_deadline_v,DATE_FORMAT(a.finish_at,'%d %M %Y') as finish_at_v, CONCAT(c.persentase,'%') as persentase_v FROM akk_rap as b 
			RIGHT JOIN (SELECT rap_id,SUM(jumlah_biaya) AS total_biaya, SUM(jumlah_aktual) AS total_pengeluaran,ROUND((SUM(jumlah_aktual) / SUM(jumlah_biaya) * 100),2) as persentase FROM akk_rap_biaya GROUP BY rap_id) as c 
			ON b.id = c.rap_id RIGHT JOIN mst_project as a ON b.project_id = a.id
			WHERE a.project_status = $status");
		}
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

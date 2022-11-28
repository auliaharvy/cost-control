<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pembelian extends CI_Model
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

	public function showPembelianbelum()
	{

		$user_id = $this->session->userdata('id');
		$this->db->select('
          a.*,d.project_name,d.project_location,b.note_app as keterangan,
          d.project_deadline,c.id as pengajuan_id,FORMAT(a.jumlah_uang,0,"de_DE") as jumlah_uang, g.nama_pekerjaan,
		  d.id as project_id,FORMAT(h.cash_remaining,0,"de_DE") as sisa_uang 
      ');
		$this->db->from('trx_pengiriman_uang as a');
		$this->db->join('akk_pengajuan_approval as b', 'a.pengajuan_approval_id = b.id');
		$this->db->join('akk_pengajuan as c', 'b.pengajuan_id = c.id');
		$this->db->join('mst_project as d', 'c.project_id = d.id');
		$this->db->join('trx_pembelian_barang as e', 'e.pengiriman_uang_id = a.id', 'left');
		$this->db->join('akk_rap as f', 'c.rap_id = f.id');
		$this->db->join('akk_rap_biaya as g', 'f.id = g.rap_id', 'left');
		$this->db->join('trx_cash_remaining as h', 'd.id = h.project_id', 'left');
		$this->db->where('a.is_buy', 0);
		$this->db->where('d.project_status', 0);
		$this->db->where('d.created_by', $user_id);
		$this->db->group_by('a.id');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function showPembeliansudah()
	{

		$user_id = $this->session->userdata('id');
		$this->db->select('
          a.*,d.project_name,d.project_location,e.note as keterangan,FORMAT(e.jumlah_uang_pembelian,0,"de_DE") as jumlah_pembelian,
		  DATE_FORMAT(e.created_at, "%d %M %Y") as tanggal_pembelian,FORMAT(a.jumlah_uang,0,"de_DE") as jumlah_uang,
          d.project_deadline,c.id as pengajuan_id, b.jumlah_approval, g.nama_pekerjaan
      ');
		$this->db->from('trx_pengiriman_uang as a');
		$this->db->join('akk_pengajuan_approval as b', 'a.pengajuan_approval_id = b.id');
		$this->db->join('akk_pengajuan as c', 'b.pengajuan_id = c.id');
		$this->db->join('mst_project as d', 'c.project_id = d.id');
		$this->db->join('trx_pembelian_barang as e', 'e.pengiriman_uang_id = a.id', 'left');
		$this->db->join('akk_rap as f', 'c.rap_id = f.id');
		$this->db->join('akk_rap_biaya as g', 'f.id = g.rap_id', 'inner');
		$this->db->where('a.is_buy !=', 0);
		$this->db->where('d.project_status', 0);
		$this->db->where('d.created_by', $user_id);
		$this->db->group_by('a.id');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function showPencairan($id)
	{
		$this->db->select('
          a.*,c.nama_jenis_rap,c.nama_pekerjaan,FORMAT(a.jumlah_uang,0,"de_DE") as jumlah_uang_v,IFNULL(FORMAT(e.jumlah_uang_pembelian,0,"de_DE"),0) as jumlah_uang_pembelian_v,
          DATE_FORMAT(e.created_at,"%d %M %Y") as tanggal_pembelian
      ');
		$this->db->from('trx_pengiriman_uang as a');
		$this->db->join('akk_pengajuan_approval as d', 'a.pengajuan_approval_id = d.id');
		$this->db->join('akk_pengajuan_biaya as b', 'd.pengajuan_biaya_id = b.id');
		$this->db->join('akk_rap_biaya as c', 'b.rap_biaya_id = c.id');
		$this->db->join('trx_pembelian_barang as e', 'e.pengiriman_uang_id = a.id', 'left');
		$this->db->where('b.pengajuan_id', $id);
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function showPencairanOffice($id, $destination_id, $user_id)
	{
		$this->db->select('
          a.*,c.nama_jenis_rap,c.nama_pekerjaan,FORMAT(a.jumlah_uang,0,"de_DE") as jumlah_uang_v,IFNULL(FORMAT(g.jumlah_uang_pembelian,0,"de_DE"),0) as jumlah_uang_pembelian_v
      ');
		$this->db->from('trx_pengiriman_uang as a');

		$this->db->join('akk_pengajuan_approval as d', 'a.pengajuan_approval_id = d.id');
		$this->db->join('akk_pengajuan_biaya as b', 'd.pengajuan_biaya_id = b.id');
		$this->db->join('akk_rap_biaya as c', 'b.rap_biaya_id = c.id');
		$this->db->join('mst_office as e', 'a.project_office_id = e.id');
		$this->db->join('mst_users as f', 'e.user_id = f.id');
		$this->db->join('trx_pembelian_barang as g', 'g.pengiriman_uang_id = a.id', 'left');
		$this->db->where('b.pengajuan_id', $id);
		$this->db->where('a.destination_id', $destination_id);
		$this->db->where('f.id', $user_id);
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}


	public function showPencairanRemaining($id, $destination_id)
	{
		$this->db->select('
          SUM(remaining_pembelian) as remaining_pembelian,FORMAT(SUM(remaining_pembelian),0,"de_DE") as remaining_pembelian_v,c.nama_jenis_rap,c.nama_pekerjaan,FORMAT(a.jumlah_uang,0,"de_DE") as jumlah_uang_v
      ');
		$this->db->from('trx_pengiriman_uang as a');

		$this->db->join('akk_pengajuan_approval as d', 'a.pengajuan_approval_id = d.id');
		$this->db->join('akk_pengajuan_biaya as b', 'd.pengajuan_biaya_id = b.id');
		$this->db->join('akk_rap_biaya as c', 'b.rap_biaya_id = c.id');
		$this->db->group_by('a.destination_id');
		$this->db->group_by('a.project_office_id');
		$this->db->where('b.pengajuan_id', $id);
		$this->db->where('a.destination_id', $destination_id);
		$this->db->where('a.is_buy', 2); //parsial

		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function showPencairanRemainingOffice($project_id, $destination_id, $user_id)
	{
		$this->db->select('
          a.id,a.cash_remaining,FORMAT(a.cash_remaining,0,"de_DE") as remaining_pembelian_v
      ');
		$this->db->from('trx_cash_remaining as a');
		$this->db->join('mst_office as b', 'a.project_office_id = b.id');
		$this->db->join('mst_users as c', 'b.user_id = c.id');

		$this->db->where('a.project_id', $project_id);
		$this->db->where('a.destination_id', $destination_id);
		$this->db->where('c.id', $user_id);

		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}
	public function showPencairanRemainingProject($project_id, $destination_id, $user_id)
	{
		$this->db->select('
          a.id,a.cash_remaining,FORMAT(a.cash_remaining,0,"de_DE") as remaining_pembelian_v
      ');
		$this->db->from('trx_cash_remaining as a');

		$this->db->where('a.project_id', $project_id);
		$this->db->where('a.destination_id', $destination_id);
		$this->db->where('a.project_office_id', $project_id);

		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function showBiayaRemainingOffice($id, $destination_id, $user_id)
	{ //data untuk mengurangi pembelian yang remaining
		$this->db->select('
          a.remaining_pembelian
      ');
		$this->db->from('trx_pengiriman_uang as a');

		$this->db->join('akk_pengajuan_approval as d', 'a.pengajuan_approval_id = d.id');
		$this->db->join('akk_pengajuan_biaya as b', 'd.pengajuan_biaya_id = b.id');
		$this->db->join('akk_rap_biaya as c', 'b.rap_biaya_id = c.id');
		$this->db->join('mst_office as e', 'a.project_office_id = e.id');
		$this->db->join('mst_users as f', 'e.user_id = f.id');
		$this->db->where('b.pengajuan_id', $id);
		$this->db->where('a.destination_id', $destination_id);
		$this->db->where('f.id', $user_id);
		$this->db->where('a.is_buy', 2); //parsial

		$data = $this->db->get();
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

	public function getProjectcash($id)
	{
		$this->db->select('
          a.*,b.project_name, b.project_location, b.project_deadline, b.rab_project, b.id as project_id, a.id as pengajuan_id,
		  FORMAT(c.cash_remaining,0,"de_DE") as sisa_uang
      ');
		$this->db->from('akk_pengajuan as a');
		$this->db->join('mst_project as b', 'a.project_id = b.id');
		$this->db->join('trx_cash_remaining as c', 'b.id = c.project_id');
		$this->db->where('a.id', $id);
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}



	public function showPengajuan()
	{

		$this->db->select('
          a.*,sum(b.jumlah_pengajuan) as total_pengajuan,c.project_name,c.project_location,
          c.project_deadline
      ');
		$this->db->order_by('id', 'asc');
		$this->db->from('akk_pengajuan as a');
		$this->db->join('akk_pengajuan_biaya as b', 'a.id = b.pengajuan_id');
		$this->db->join('mst_project as c', 'a.project_id = c.id');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}



	public function dataPencairan()
	{
		$this->db->select('a.*,IF (a.destination_id = 1, p.project_name, c.project_name) AS pro_office,b.organization_name,
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

	public function getBiayaAktualRap($id)
	{
		$this->db->select('
          a.id,d.id as rap_biaya_id, d.jumlah_aktual, b.pengajuan_id
      ');
		$this->db->from('trx_pengiriman_uang as a');
		$this->db->join('akk_pengajuan_approval as b', 'a.pengajuan_approval_id = b.id');
		$this->db->join('akk_pengajuan_biaya as c', 'b.pengajuan_biaya_id = c.id');
		$this->db->join('akk_rap_biaya as d', 'c.rap_biaya_id = d.id');
		$this->db->where('a.id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getBiayaRap($id)
	{
		$this->db->select('
          a.*,b.nama_jenis, c.nama_kategori
      ');
		$this->db->from('akk_rap_biaya as a');
		$this->db->join('mst_jenis_biaya as b', 'a.jenis_biaya_id = b.id');
		$this->db->join('mst_kategori_biaya as c', 'a.kategori_biaya_id = c.id');
		$this->db->join('akk_rap as d', 'a.rap_id = d.id');
		$this->db->join('mst_project as e', 'd.project_id = e.id');
		$this->db->where('e.id', $id);
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

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
          a.*,c.project_name,i.nama_kategori,g.nama_pekerjaan,FORMAT(a.jumlah_uang,0,"de_DE") as jumlah_uang,d.note_app as keterangan
      ');
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
		$this->db->join('mst_kategori_biaya as i', 'g.kategori_biaya_id = i.id');
		$this->db->where('a.is_buy', 0);
		$this->db->where('c.project_status', 0);
		$this->db->where('c.created_by', $user_id);
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
        a.*,b.project_name,FORMAT(d.jumlah_approval,0,"de_DE") as jumlah_approval,g.nama_pekerjaan,FORMAT(a.jumlah_uang_pembelian,0,"de_DE") as jumlah_pembelian,
		DATE_FORMAT(a.created_at, "%d %M %Y") as tanggal_pembelian,a.note as keterangan,h.nama_kategori,FORMAT(i.jumlah_uang_pembelian,0,"de_DE") as jumlah_pembelian_remaining,
		c.id as id_pengiriman,j.id as id_remaining, b.id as id_project,f.id as pengajuan_id,b.cash_in_hand as cash, c.is_buy,g.id as id_rap , g.jumlah_aktual as cash_rap
      ');
		$this->db->from('trx_pembelian_barang as a');
		$this->db->join('mst_project as b', 'a.project_office_id = b.id', 'left');
		$this->db->join('trx_pengiriman_uang as c', 'a.pengiriman_uang_id = c.id', 'left');
		$this->db->join('akk_pengajuan_approval as d', 'c.pengajuan_approval_id = d.id');
		$this->db->join('akk_pengajuan_biaya as e', 'd.pengajuan_biaya_id = e.id');
		$this->db->join('akk_pengajuan as f', 'e.pengajuan_id = f.id');
		$this->db->join('akk_rap_biaya as g', 'e.rap_biaya_id = g.id');
		$this->db->join('mst_kategori_biaya as h', 'g.kategori_biaya_id = h.id');
		$this->db->join('trx_pembelian_barang_remaining as i', 'b.id = i.project_id', 'left');
		$this->db->join('trx_cash_remaining as j', 'b.id = j.project_id');
		$this->db->where('c.is_buy !=', 0);
		$this->db->where('b.project_status', 0);
		$this->db->where('b.created_by', $user_id);
		$this->db->group_by('c.id');

		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function getPembelian($id)
	{
		$this->db->select('
          a.*,
      ');
		$this->db->from('trx_pembelian_barang as a');
		$this->db->join('mst_project as b', 'a.project_office_id = b.id');
		$this->db->where('a.id', $id);
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

	public function getBiayaAktualRap2($id)
	{
		$this->db->select('
          a.id,d.id as rap_biaya_id, d.jumlah_aktual, b.pengajuan_id,e.id as pengiriman_id
      ');
		$this->db->from('mst_project as a');
		$this->db->join('trx_pengiriman_uang as e', 'a.id = e.project_office_id');
		$this->db->join('akk_pengajuan_approval as b', 'e.pengajuan_approval_id = b.id');
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

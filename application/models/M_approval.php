<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_approval extends CI_Model
{
	public function cek_user($data)
	{
		$query = $this->db->get_where('mst_users', $data);
		return $query;
	}

	public function pengajuanbelumapprove()
	{
		$this->db->select('
        a.*, c.project_name, d.nama_pekerjaan, DATE_FORMAT(b.created_at,"%d %M %Y") as tanggal_pengajuan,
		FORMAT(b.jumlah_pengajuan,0,"de_DE") as jumlah_pengajuan_v, b.note as keterangan,a.id as pengajuan_id,b.id,
		d.nama_pekerjaan,d.nama_jenis_rap,e.nama_kategori,b.id as id_pengajuan
        ');
		$this->db->from('akk_pengajuan as a');
		$this->db->join('akk_pengajuan_biaya as b', 'a.id = b.pengajuan_id');
		$this->db->join('mst_project as c', 'a.project_id = c.id');
		$this->db->join('akk_rap_biaya as d', 'b.rap_biaya_id = d.id');
		$this->db->join('mst_kategori_biaya as e', 'd.kategori_biaya_id = e.id');
		$this->db->where('b.is_approved', 0);
		$this->db->group_by('b.id');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function pengajuanbelumapprove1()
	{
		$this->db->select('
        a.*,c.project_name,e.nama_kategori,a.note as keterangan,e.nama_kategori, a.id as id_pengajuan,
		d.nama_jenis_rap,d.nama_pekerjaan,FORMAT(a.jumlah_pengajuan,0,"de_DE") as jumlah_pengajuan_v ,
		DATE_FORMAT(a.created_at,"%d %M %Y") as tanggal_pengajuan, d.id as rap_biaya_id
        ');
		$this->db->from('akk_pengajuan_biaya as a');
		$this->db->join('akk_pengajuan as b', 'a.pengajuan_id = b.id', 'left');
		$this->db->join('mst_project as c', 'b.project_id = c.id');
		$this->db->join('akk_rap_biaya as d', 'a.rap_biaya_id = d.id');
		$this->db->join('mst_kategori_biaya as e', 'd.kategori_biaya_id = e.id');
		$this->db->where('a.is_approved', 0);
		// $this->db->group_by('a.id');
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
		FORMAT(b.jumlah_pengajuan,0,"de_DE") as jumlah_pengajuan_v, FORMAT(e.jumlah_approval,0,"de_DE") as jumlah_approval_v,
		e.note_app as keterangan, b.id as pengajuan_biaya_id,d.nama_pekerjaan,d.nama_jenis_rap,f.nama_kategori

        ');
		$this->db->from('akk_pengajuan as a');
		$this->db->join('akk_pengajuan_biaya as b', 'a.id = b.pengajuan_id', 'left');
		$this->db->join('mst_project as c', 'a.project_id = c.id');
		$this->db->join('akk_rap_biaya as d', 'b.rap_biaya_id = d.id');
		$this->db->join('akk_pengajuan_approval as e', 'a.id = e.pengajuan_id', 'left');
		$this->db->join('mst_kategori_biaya as f', 'd.kategori_biaya_id = f.id');
		$this->db->where('b.is_approved', 1);
		$this->db->group_by('b.id');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function pengajuansudahapprove1()
	{
		$this->db->select('
        a.*, d.project_name, e.nama_pekerjaan, DATE_FORMAT(a.updated_at,"%d %M %Y") as tanggal_approve,
		FORMAT(b.jumlah_pengajuan,0,"de_DE") as jumlah_pengajuan_v, FORMAT(a.jumlah_approval,0,"de_DE") as jumlah_approval_v,
		a.note_app as keterangan, b.id as pengajuan_biaya_id,e.nama_jenis_rap,f.nama_kategori

        ');
		$this->db->from('akk_pengajuan_approval as a');
		$this->db->join('akk_pengajuan_biaya as b', 'a.pengajuan_biaya_id = b.id');
		$this->db->join('akk_pengajuan as c', 'b.pengajuan_id = c.id');
		$this->db->join('mst_project as d', 'c.project_id = d.id');
		$this->db->join('akk_rap_biaya as e', 'b.rap_biaya_id = e.id');
		$this->db->join('mst_kategori_biaya as f', 'e.kategori_biaya_id = f.id');
		$this->db->where('b.is_approved', 1);
		// $this->db->group_by('b.id');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}
}

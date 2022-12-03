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
        a.*, c.project_name, d.nama_pekerjaan, DATE_FORMAT(a.created_at,"%d %M %Y") as tanggal_pengajuan,
		FORMAT(b.jumlah_pengajuan,0,"de_DE") as jumlah_pengajuan_v, b.note as keterangan,a.id as pengajuan_id,b.id,
		d.nama_pekerjaan,d.nama_jenis_rap,e.nama_kategori
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

	public function pengajuansudahapprove()
	{
		$this->db->select('
        a.*, c.project_name, d.nama_pekerjaan, DATE_FORMAT(e.updated_at,"%d %M %Y") as tanggal_approve,
		FORMAT(b.jumlah_pengajuan,0,"de_DE") as jumlah_pengajuan_v, FORMAT(e.jumlah_approval,0,"de_DE") as jumlah_approval_v,
		e.note_app as keterangan, b.id as pengajuan_biaya_id,d.nama_pekerjaan,d.nama_jenis_rap,f.nama_kategori

        ');
		$this->db->from('akk_pengajuan as a');
		$this->db->join('akk_pengajuan_biaya as b', 'a.id = b.pengajuan_id');
		$this->db->join('mst_project as c', 'a.project_id = c.id');
		$this->db->join('akk_rap_biaya as d', 'b.rap_biaya_id = d.id');
		$this->db->join('akk_pengajuan_approval as e', 'a.id = e.pengajuan_id');
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
}

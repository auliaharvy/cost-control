<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pengguna extends CI_Model
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

	public function getUser()
	{
		$this->db->select("
          a.*,b.id as role_id,b.role_name,IF(a.is_active=0,'Active','Non Active') as is_active_v,
          IF(a.is_active=0,'','bg-danger text-white') as background_text
      ");

		$this->db->from('mst_users as a');
		$this->db->join('mst_role as b', 'a.role = b.id');

		$query = $this->db->get();
		return $query->result_array();
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

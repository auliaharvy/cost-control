<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_material extends CI_Model
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

	public function getOffice()
	{
		$this->db->select('
          a.*,b.nama_type,b.id as office_type_id,c.id as user_id ,c.fullname,concat(b.nama_type," ",c.fullname) AS office_name,FORMAT(a.cash_in_hand,0,"de_DE") as cash_in_hand_v
      ');

		$this->db->from('mst_office as a');
		$this->db->join('mst_office_type as b', 'a.type_office_id = b.id');
		$this->db->join('mst_users as c', 'a.user_id = c.id');
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

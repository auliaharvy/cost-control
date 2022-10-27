<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_kas extends CI_Model
{
	public function cek_user($data)
	{
		$query = $this->db->get_where('mst_users', $data);
		return $query;
	}

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

	public function showLogKasRange($range)
	{
		$data = $this->db->query("SELECT *,DATE_FORMAT(created_at,'%d %M %Y') as created_at_v
			FROM log_mst_organization
			WHERE created_at >= DATE_ADD(NOW(), INTERVAL -$range MONTH)");
		return $data->result_array();
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

	public function GetData($tableName, $where = "")
	{
		$data = $this->db->query('select * from ' . $tableName . $where);
		return $data->result_array();
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

	public function GetData2($tableName, $where = "")
	{
		$data = $this->db->query('select * from ' . $tableName . $where);
		return $data;
	}
}

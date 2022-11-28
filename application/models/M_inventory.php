<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_inventory extends CI_Model
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

	public function showInventory()
	{
		$this->db->select('
          a.*,b.material_name, b.unit,FORMAT(a.qty,0,"de_DE") as qty
      ');
		$this->db->from('akk_inventory as a');
		$this->db->join('mst_material as b', 'a.material_id = b.id');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result_array();
		} else {
			return false;
		}
	}

	public function showLogMaterial()
	{
		$this->db->select('
          a.*,DATE_FORMAT(a.created_at,"%d %M %Y") as created_at_v,b.project_name,c.material_name,FORMAT(a.qty,0,"de_DE") as qty,c.unit
      ');
		$this->db->from('log_inventory_organization as a');
		$this->db->join('mst_project as b', 'a.project_id = b.id', 'left');
		$this->db->join('mst_material as c', 'a.material_id = c.id');
		$this->db->order_by('a.id', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function showLogMaterialRange($range)
	{
		$data = $this->db->query("SELECT a.*,b.project_name,c.material_name,DATE_FORMAT(a.created_at,'%d %M %Y') as created_at_v
			FROM log_inventory_organization as a LEFT JOIN mst_project as b on a.project_id=b.id
			JOIN mst_material as c on a.material_id=c.id
			WHERE a.created_at >= DATE_ADD(NOW(), INTERVAL -$range MONTH)");
		return $data->result_array();
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

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function users($id = 0)
	{
		if ($id) {
			$this->db->where('id', $id);
			$query = $this->db->get('users')->row();
			return $query;
		}
		$query = $this->db->get('users')->result();
		return $query;
	}

	public function user_crud($data)
	{
		if($data['id']) {
			$this->db->where('id', $data['id']);
			$this->db->update('users', $data);
			return;
		}
		$this->db->insert('users', $data);
	}

	public function user_delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('users');
	}

	public function permissions($id = 0)
	{
		if ($id) {
			$this->db->select('pu.*, p.*, u.*, pu.id as pu_id, p.id as permission_id, u.id as user_id');
			$this->db->join('permissions p', 'p.id = pu.permission_id');
			$this->db->join('users u', 'u.id = pu.user_id');
			$this->db->where('pu.id', $id);
			$query = $this->db->get('permission_user pu')->row();
			return $query;
		}
		$this->db->select('pu.*, p.*, u.*, pu.id as pu_id, p.id as permission_id, u.id as user_id');
		$this->db->join('permissions p', 'p.id = pu.permission_id');
		$this->db->join('users u', 'u.id = pu.user_id');
		$query = $this->db->get('permission_user pu')->result();
		return $query;
	}

	public function permission_crud($data)
	{
		$permission_data = [
			'uri' => $data['uri']
		];

		$pu_data = [
			'permission_id' => $data['permission_id'],
			'user_id' => $data['user_id']
		];

		if($data['permission_id']) {
			// update permissions table
			$this->db->where('id', $data['permission_id']);
			$this->db->update('permissions', $permission_data);

			// update permission_user table
			$this->db->where('id', $data['pu_id']);
			$this->db->update('permission_user', $pu_data);
			return;
		}

		// Insert into permission table
		$this->db->insert('permissions', $permission_data);
		$permission_id = $this->db->insert_id();

		// Insert into table permission_user
		$pu_data['permission_id'] = $permission_id;
		$this->db->insert('permission_user', $pu_data);
	}

	public function permission_delete($id)
	{
		
		$this->db->where('id', $id);
		$this->db->delete('permissions');
	}

	public function __destruct()
	{
		$this->db->close();
	}
}

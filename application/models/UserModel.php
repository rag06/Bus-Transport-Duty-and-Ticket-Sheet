<?php

Class UserModel extends CI_Model {

public function listAdminUsers()
	{			$query=$this->db->query("SELECT * FROM admin_users WHERE Admin_Id>1");
				return $query->result();
	}
	public function getAdminUser($id)
	{			$query=$this->db->query("SELECT * FROM admin_users WHERE Admin_Id=$id");
				return $query->result_array();
	}
	
	public function updateUsers($data)
	{			
		$this->db->where('Admin_Id', $data['Admin_Id']);
		$this->db->update('admin_users' ,$data);
			if ($this->db->affected_rows() > 0) {
				return true;
				}
		
			return false;
		
	}
	public function deleteUser($id) {

		
		$this->db->where('Admin_Id', $id);
		$this->db->delete('admin_users');
		if ($this->db->affected_rows() > 0) {
				return true;
				}
				return false;
		
	}
// Insert registration data in database
public function registration_insert($data) {

// Query to check whether username already exist or not
$condition = "Admin_Uname =" . "'" . $data['Admin_Uname'] . "'";
$this->db->select('*');
$this->db->from('admin_users');
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();
if ($query->num_rows() == 0) {

// Query to insert data in database
$this->db->insert('admin_users', $data);
if ($this->db->affected_rows() > 0) {
return true;
}
} else {
return false;
}
}

// Read data using username and password
public function login($data) {

$condition = "Admin_Uname =" . "'" . $data['username'] . "' AND " . "Admin_Pass =" . "'" . $data['password'] . "' AND ". "Admin_Status =1";
$this->db->select('*');
$this->db->from('admin_users');
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();

if ($query->num_rows() == 1) {
return true;
} else {
return false;
}
}

// Read data from database to show data in admin page
public function read_user_information($username) {

$condition = "Admin_Uname =" . "'" . $username . "'";
$this->db->select('*');
$this->db->from('admin_users');
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();

if ($query->num_rows() == 1) {
return $query->result();
} else {
return false;
}
}

}

?>
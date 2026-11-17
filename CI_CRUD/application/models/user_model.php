<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function save_data($id, $name, $dob, $mob, $email, $pass, $image, $time)
    {
        $data = array(
            'id'        => $id,
            'name'      => $name,
            'dob'       => $dob,
            'mob'       => $mob,
            'email'     => $email,
            'password'  => $pass,
            'image'     => $image,
            'create_at' => $time
        );
        return $this->db->insert('users', $data);
    }

    public function display_data()
    {
        $query = $this->db->get('users');
        return $query->result();
    }

    public function get_user($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row();
    }

    public function update_data($id, $name, $dob, $mob, $email, $image)
    {
        $data = array(
            'name'  => $name,
            'dob'   => $dob,
            'mob'   => $mob,
            'email' => $email,
            'image' => $image
        );
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }

    // Login check
    public function login($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $query = $this->db->get('users');
        return $query->row();
    }

    // Check if email already exists
    public function email_exists($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }
}

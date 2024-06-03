<?php
    /*
    * File Name    : classUser.php
    * Description  : Class for managing the operations relations to the Users.
    * Author       : Praveen Prabhakaran
    * Date         : 2024-06-03
    * Version      : 1.0
    */
    require_once 'classDatabase.php';

    class User {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }
        //Function for User Registration
        public function register($name, $email, $password) {
            if ($this->emailExists($email)) {
                return false; // Email already exists
            }
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            return $this->db->insert('users', ['name' => $name, 'email' => $email, 'password' => $hashedPassword]);
        }
        //Function for login
        public function login($email, $password) {
            $users = $this->db->read('users', ['email' => $email]);
            if ($users && password_verify($password, $users[0]['password'])) {
                return $users[0]['id'];
            }
            return false;
        }
        //Function to Get the user details by user id
        public function getUserById($id) {
            $users = $this->db->read('users', ['id' => $id]);
            return $users ? $users[0] : null;
        }
        //Function to Update the user details
        public function updateUser($id, $name, $email) {
            if ($this->db->emailExistsForOtherUser($email, $id)) {
                return false; // Email already exists for another user
            }
            return $this->db->update('users', ['name' => $name, 'email' => $email], ['id' => $id]);
        }
        //Function to check whether user email already exists or not
        public function emailExists($email) {
            $users = $this->db->read('users', ['email' => $email]);
            return !empty($users);
        }
        //Function to check the loggedin user is Admin or not
        public function isAdmin($user_id) {
            $user = $this->getUserById($user_id);
            return $user && $user['role'] === 'admin';
        }
        //Function to get all Users
        public function getAllUsers() {
            return $this->db->read('users');
        }
        //Function to update the User Roles
        public function updateUserRole($user_id, $role) {
            return $this->db->update('users', ['role' => $role], ['id' => $user_id]);
        }
    }
?>
<?php
    class User {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        // Method to check for existing user using email as reference
        public function getUserByEmail($email) {
            $this->db->query('SELECT * FROM users WHERE email = :email');
            $this->db->bind(':email', $email);

            // Get the single row
            $row = $this->db->getResultRow();

            // Check if Row found
            if ( $this->db->getRowCount() > 0 ) {
                return $row;
            }
            else {
                return false;
            }
        }

        // Method to check for existing user using email as reference
        public function getUserById($id) {
            $this->db->query('SELECT * FROM users WHERE id = :user_id');
            $this->db->bind(':user_id', $id);

            // Get the single row
            $row = $this->db->getResultRow();

            return $row;
        }

        // Log in the user
        public function login($email, $raw_password) {

            if ( !empty($email) && !empty($raw_password) ) {
                
                if ( $user_record = $this->getUserByEmail($email) ) {
                    $hashed_pw = $user_record->password;       

                    //verify the password
                    if ( password_verify($raw_password, $hashed_pw) ) {
                        return $user_record;
                    }
                }

            }

            return false;
        }

        // Method to insert record to the database; param: $data(array)
        public function register($data) {
            $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
            // Bind the placevalues
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);

            // Execute Insert Query
            if ( $this->db->execute() ) {
                return true;
            }
            else {
                return false;
            }
        }
    }

?>
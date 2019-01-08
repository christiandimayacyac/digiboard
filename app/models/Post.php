<?php
    class Post {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function getPosts() {
            $this->db->query('SELECT * ,
                                posts.id as postId,
                                users.id as userId
                              FROM posts
                              INNER JOIN users
                              ON posts.user_id = users.id
                              ORDER BY posts.date_posted DESC
                            ');

            $results = $this->db->getResultSet();

            return $results;
        }

        public function addPost($data) {
            $this->db->query('INSERT INTO posts (user_id, title, body) VALUES (:user_id, :title, :body)');
            $this->db->bind(':user_id', $data['uid']);
            $this->db->bind(':title', $data['post_title']);
            $this->db->bind(':body', $data['post_body']);

            // Execute Insert Query
            if ( $this->db->execute() ) {
                return true;
            }
            else {
                return false;
            }
        }

        public function updatePost($data) {
            $this->db->query('UPDATE posts SET user_id=:user_id, title=:title, body=:body WHERE id = :post_id');
            // $this->db->query('SELECT * FROM posts');
            $this->db->bind(':user_id', $data['uid']);
            $this->db->bind(':title', $data['post_title']);
            $this->db->bind(':body', $data['post_body']);
            $this->db->bind(':post_id', $data['post_id']);

            // Execute Insert Query
            if ( $this->db->execute() ) {
                return true;
            }
            else {
                return false;
            }
        }

        public function deletePost($post_id) {
            $this->db->query("DELETE FROM posts WHERE id = :post_id");
            $this->db->bind(':post_id', $post_id);

            // Execute Insert Query
            if ( $this->db->execute() ) {
                return true;
            }
            else {
                return false;
            }
        }

        public function getPostById($post_id) {
            $this->db->query('SELECT * FROM posts WHERE id = :post_id');
            $this->db->bind(':post_id', $post_id);

            $post = $this->db->getResultRow();

            return $post;
        }
    }
?>
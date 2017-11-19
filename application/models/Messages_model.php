<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Messages_model extends CI_Model {

        public function __construct() {
            // Loading the database
            $this->load->database();
        }

        // Get messages.
        public function getMessagesByPoster($name) {
            // Order by posted_at DESC
            $this->db->order_by('posted_at', 'DESC');
            // Where user_username = $name
            $this->db->where('user_username', $name);
            // Select * from Messages
            $query = $this->db->get('Messages');
            // Store the results of the query
            return $query->result_array();
        }

        // Search message.
        public function searchMessages($string) {
            // Order by posted_at DESC
            $this->db->order_by('posted_at', 'DESC');
            // Where text like $string
            $this->db->like('text', $string);
            // Select * from Messages
            $query = $this->db->get('Messages');

            // Check if the search field is empty, otherwise return the query results.
            if($string == "") {
              return array();
            } else {
              return $query->result_array();
            }
        }

        // Publish a new message.
        public function insertMessage($poster, $string) {
            // The date of posted message.
            $time = date( "Y-m-d H:i:s");
            // Set data to insert into the table messages.
            $data = array(
                'text' => $string,
                'user_username' => $poster,
                'posted_at' => $time
            );

            // Insert into the db.
            $query = $this->db->insert('Messages', $data);
            return $query;
        }

        // Get users messages that the current logged in user is following.
        public function getFollowedMessages($name) {
          $sql = "SELECT *
                  FROM Messages
                  INNER JOIN User_Follows
                  ON Messages.user_username = User_Follows.followed_username
                  WHERE follower_username = '$name'
                  ORDER BY posted_at DESC";

          // Match the $name param with the query $name param and return query.
          $query = $this->db->query($sql, $name);
          return $query->result_array();
        }
    }

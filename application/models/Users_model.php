<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Users_model extends CI_Model {

        // Check if the user details are correct.
        public function checkLogin($username, $pass) {
            // Retrieve the data from the db where the match the parameters passed.
            $query = $this->db->get_where('Users', array(
                'username' => $username,
                'password' => $pass
            ));

            // If the result array is not empty, return true, otherwise user details error.
            if (!empty($query->row_array())) {
                return true;
            } else {
                return false;
            }
        }

        // Check if user exists, did this to check through the username only, without the password, unlike the previous function.
        public function user_exists($name) {
          $query = $this->db->get_where('Users', array(
            'username' => $name
          ));

          // Check the number of the rows returned. At most 1(exists), at least 0 (doesnt exist).
          if ($query->num_rows() == 1) {
              return true;
          } else {
            return false;
          }
        }

        public function isFollowing($follower, $followed) {
          $sql = "SELECT *
                  FROM User_Follows
                  WHERE follower_username = '$follower'
                  AND followed_username = '$followed'";

          $query = $this->db->query($sql, $follower, $followed);

          if($query->num_rows() == 1) {
            return true;
          } else {
            return false;
          }
        }

        public function follow($followed) {
          $data = array(
            'follower_username' => $this->session->userdata('username'),
            'followed_username' => $followed
          );

          return $this->db->insert('User_Follows', $data);
        }
    }

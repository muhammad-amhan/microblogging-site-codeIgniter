<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class User extends CI_Controller {

        public function view($name) {
            // Loading the model.
            $this->load->model('messages_model');
            // Checks if the user exists in the database.
            if($this->users_model->user_exists($name)) {

                // Store the current user as the follower, and the logged_in as the current user status.
                $follower = $this->session->userdata('username');
                $logged_in = $this->session->userdata('logged_in');

                // Call isFollowing and store the boolean in following var.
                $following = $this->users_model->isFollowing($follower, $name);
                // Store the name param in the variable name. Reason is to check for the follow button and ensure that logged in user cant follow himself.
                $data['name'] = $name;

                // Perform the follow button boolean. Which cases the follow button should be display in?
                if(!$following && $logged_in && $follower != $name) {
                    $data['follow_btn'] = true;
                }

                // Check if the current user viewing his own messages. Otherise print the name of the owner of those messages.
                if ($this->session->userdata('username') == $name) {
                    $data['title'] = 'your messages...';
                } else {
                    $data['title'] = $name."'s messages...";
                }

                // Get the messages and store in var messages so that we can loop over the table messages.
                $data['messages'] = $this->messages_model->getMessagesByPoster($name);

                // Load the views.
                $this->load->view('templates/header');
                $this->load->view('ViewMessages', $data);
                $this->load->view('templates/footer');
            }

            // If user doesnt exist, display flash message and redirect to the current user's page.
            else {
              $this->session->set_flashdata('no_user', "The user $name does not exist.");
              redirect('user/view/'.$this->session->userdata('username'));
            }
        }

        // Invokes the method follow to update database when current user follows another.
        public function follow($followed) {
            $this->load->model('users_model');
            $this->users_model->follow($followed);
            // Then redirect to the user that's just been followed.
            redirect('user/view/'.$followed);
        }

        // Show all messages for people that the current user has followed.
        public function feed($name) {
          // Load model.
          $this->load->model('messages_model');
          // Store current user in $name.
          $name = $this->session->userdata('username');
          $data['title'] = 'Your feeds..';
          // Store results of getFollowedMessages in **messages** so that it can be used in ViewMessages foreach loop.
          $data['messages'] = $this->messages_model->getFollowedMessages($name);

          // Load views.
          $this->load->view('templates/header');
          $this->load->view('ViewMessages', $data);
          $this->load->view('templates/footer');
        }

        public function login() {
            // Login page title.
            $data['title'] = 'Login';

            // Load views.
            $this->load->view('templates/header');
            $this->load->view('Login', $data);
            $this->load->view('templates/footer');
        }

        public function doLogin() {
            // Load the model.
            $this->load->model('users_model');

            // Set input validation rules.
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            // Run validation, and check if there is an error.
            if ($this->form_validation->run() === FALSE) {
                // Pages title.
                $data['title'] = 'Login';

                // Reload the login page when failed.
                $this->load->view('templates/header');
                $this->load->view('Login', $data);
                $this->load->view('templates/footer');

            } else {
                // Get the value via POST and hash the password.
                $username = $this->input->post('username');
                $pass = sha1($this->input->post('password'));
                // Pass the above values as param in the checkLogin method which makes sure that user details are valid (exists).
                $checkLogin = $this->users_model->checkLogin($username, $pass);

                // Check if user password and username are true.
                if ($checkLogin) {
                    // Store user session data.
                    $user_data = array(
                        'username' => $username,
                        'logged_in' => true
                    );
                    // Set the session.
                    $this->session->set_userdata($user_data);

                    // Display a flashdata messages on successful login, then redirect to the current user's messages.
                    $this->session->set_flashdata('user_loggedin', 'Logged in successfully');
                    redirect('user/view/'.$this->session->userdata('username'));

                } else {
                    // Display a flashdata message on unsuccessful login and redirect to the same login form.
                    $this->session->set_flashdata('login_failed', 'Username or password is incorrect.');
                    redirect('user/login');
                }
            }
        }

        public function logout() {
            // Clear user session variables, then redirect.
            $this->session->unset_userdata('logged_in');
            $this->session->unset_userdata('username');

            // Set a message on logout.
            $this->session->set_flashdata('user_loggedout', 'You logged out successfully');
            redirect('user/login');
        }
    }

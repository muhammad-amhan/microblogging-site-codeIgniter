<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Message extends CI_Controller {

        public function index() {
            // Check if the user is logged in and redirects if not.
            if (!$this->session->userdata('logged_in')) {
                redirect('user/login');

            } else {
                // Pages title.
                $data['title'] = 'Post a message';

                // Load views.
                $this->load->view('templates/header');
                $this->load->view('Post', $data);
                $this->load->view('templates/footer');
            }
        }

        public function doPost() {
            // Check if the user is logged in.
            if (!$this->session->userdata('logged_in')) {
                redirect('user/login');
            } else {

                // Load the model.
                $this->load->model('messages_model');
                // Validating the input field.
                $this->form_validation->set_rules('msgbody', 'Msgbody', 'required');
                
        				// Get the string message from message input field and  current user ($poster).
        				$string = $this->input->post('msgbody');
        				$poster = $this->session->userdata('username');

                // Call the insertMessage function and pass the above values as param.
                $this->messages_model->insertMessage($poster, $string);

                // Set a flashdata message on successful post and redirect the user to their ViewMessages view.
                $this->session->set_flashdata('post_created', 'Your message has been published');
                redirect('user/view/'.$this->session->userdata('username'));
            }
        }
    }

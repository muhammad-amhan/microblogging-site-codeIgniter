<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Search extends CI_Controller {

        // Display search form.
        public function index() {
            // Page title.
            $data['title'] = 'Search site...';
            // Load the views.
            $this->load->view('templates/header');
            $this->load->view('Search', $data);
            $this->load->view('templates/footer');
        }

        // Perform the search.
        public function dosearch() {
          // Load model.
            $this->load->model('messages_model');
            $data['title'] = 'Search results...';
            // Get value via get method from input field.
            $keyword = $this->input->get('keyword');

            // Call searchMessages and store in **messages** so that it can be used in the foreach loop in ViewMessages.
            $data['messages'] = $this->messages_model->searchMessages($keyword);

            // Check if search results is empty.
            if (empty($data['messages'])) {
              // Print no results message.
                $this->session->set_flashdata('empty_search', "No search results found for '$keyword'.");
            }
            // Load views.
            $this->load->view('templates/header');
            $this->load->view('ViewMessages', $data);
            $this->load->view('templates/footer');
        }
    }

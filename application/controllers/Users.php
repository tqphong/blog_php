<?php 
    class Users extends CI_Controller{
        public function register(){
            $data['title'] = 'Sign Up';

            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
            $this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('password2', 'Comfirm Password', 'matches[password]');

            if($this->form_validation->run() === FALSE){
                $this->load->view('templates/header');
                $this->load->view('users/register', $data);
                $this->load->view('templates/footer');
            } else {
                //Mã hóa password
                $enc_password = md5($this->input->post('password'));

                $this->user_model->register($enc_password);

                //set message
                $this->session->set_flashdata('user_registered', 'Bạn đã đăng ký thành công và có thể đăng nhập.');

                redirect('posts');
            }
        }

        public function login(){
            $data['title'] = 'Đăng Nhập';

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if($this->form_validation->run() === FALSE){
                $this->load->view('templates/header');
                $this->load->view('users/login', $data);
                $this->load->view('templates/footer');
            } else {
                //Get usename
                $username = $this->input->post('username');
                //Get password
                $password = md5($this->input->post('password'));
                //Login user
                $user_id  = $this->user_model->login($username, $password);

                if($user_id){
                    $user_data = array(
                        'user_id' => $user_id,
                        'username' => $username,
                        'logged_in' => true,
                    );
                    $this->session->set_userdata($user_data);

                    //set message
                    $this->session->set_flashdata('user_loggedin', 'Đăng nhập thành công.');
                    redirect('posts');
                } else {
                    //set message
                    $this->session->set_flashdata('login_failed', 'Đăng nhập lỗi!');
                    redirect('users/login');
                }

            }
        }

        public function logout(){
            $this->session->unset_userdata('logged_in');
            $this->session->unset_userdata('user_id');
            $this->session->unset_userdata('username');
            $this->session->set_flashdata('user_loggedout', 'Bạn đã đăng xuất');
            redirect('users/login');

        }

        // kiểm tra tài khoản
        public function check_username_exists($username){
            $this->form_validation->set_message('check_username_exists', 'Tên này đã tồn tại. Hãy chọn một tên khác');
            if($this->user_model->check_username_exists($username)){
                return true;
            } else {
                return false;
            }
        }
        // kiểm tra email
        public function check_email_exists($email){
            $this->form_validation->set_message('check_email_exists', 'Email này đã tồn tại. Hãy chọn một email khác');
            if($this->user_model->check_email_exists($email)){
                return true;
            } else {
                return false;
            }
        }
    }
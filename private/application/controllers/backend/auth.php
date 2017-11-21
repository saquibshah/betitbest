<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Auth
 * @property Ion_auth $ion_auth
 */
class Auth extends CI_Controller {
    /**
     * @var array
     */
    protected $data = array();

    /**
     * @var array
     */
    protected $viewdata = array();

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');

        $this->load->database();

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'),
            $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->helper('language');


    }

    function activate($id, $code = false) {
        if ($code !== false) {
            $activation = $this->ion_auth->activate($id, $code);
        } else if ($this->ion_auth->is_admin()) {
            $activation = $this->ion_auth->activate($id);
        }

        if ($activation) {
            //redirect them to the auth page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("auth", 'refresh');
        } else {
            //redirect them to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("auth/forgot_password", 'refresh');
        }
    }

    function change_password() {
        $this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'),
            'required');
        $this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'),
            'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length['
            . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
        $this->form_validation->set_rules('new_confirm',
            $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $user = $this->ion_auth->user()->row();

        if ($this->form_validation->run() == false) {
            //display the form
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
            $this->data['old_password'] = array(
                'name' => 'old',
                'id' => 'old',
                'type' => 'password',
            );
            $this->data['new_password'] = array(
                'name' => 'new',
                'id' => 'new',
                'type' => 'password',
                'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
            );
            $this->data['new_password_confirm'] = array(
                'name' => 'new_confirm',
                'id' => 'new_confirm',
                'type' => 'password',
                'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
            );
            $this->data['user_id'] = array(
                'name' => 'user_id',
                'id' => 'user_id',
                'type' => 'hidden',
                'value' => $user->id,
            );

            //render
            $this->_render_page('auth/change_password', $this->data);
        } else {
            $identity = $this->session->userdata('identity');

            $change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

            if ($change) {
                //if the password was successfully changed
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                $this->logout();
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('auth/change_password', 'refresh');
            }
        }
    }

    function _render_page($view, $data = null, $render = false) {

        $this->viewdata = (empty($data)) ? $this->data : $data;

        $view_html = $this->load->view($view, $this->viewdata, $render);

        if (!$render) {
            return $view_html;
        }
    }

    //log the user out

    function logout() {
        $this->data['title'] = "Logout";

        //log the user out
        $logout = $this->ion_auth->logout();

        //redirect them to the login page
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect('backend/auth/login', 'refresh');
    }

    //change password

    function create_group() {
        $this->data['title'] = $this->lang->line('create_group_title');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

        //validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'),
            'required|alpha_dash|xss_clean');
        $this->form_validation->set_rules('description', $this->lang->line('create_group_validation_desc_label'),
            'xss_clean');

        if ($this->form_validation->run() == true) {
            $new_group_id =
                $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
            if ($new_group_id) {
                // check to see if we are creating the group
                // redirect them back to the admin page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("auth", 'refresh');
            }
        } else {
            //display the create group form
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() :
                ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['group_name'] = array(
                'name' => 'group_name',
                'id' => 'group_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('group_name'),
            );
            $this->data['description'] = array(
                'name' => 'description',
                'id' => 'description',
                'type' => 'text',
                'value' => $this->form_validation->set_value('description'),
            );

            $this->_render_page('auth/create_group', $this->data);
        }
    }

    //forgot password

    function create_user() {
        $this->data['title'] = "Create User";

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('backend/auth', 'refresh');
        }

        $tables = $this->config->item('tables', 'ion_auth');

        //validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'),
            'required|xss_clean');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'),
            'required|xss_clean');
        $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'),
            'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'),
            'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length['
            . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm',
            $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() == true) {
            $username =
                strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
            $email = strtolower($this->input->post('email'));
            $password = $this->input->post('password');

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
            );
        }
        if ($this->form_validation->run() == true
            && $this->ion_auth->register($username, $password, $email, $additional_data)
        ) {
            //check to see if we are creating the user
            //redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("/backend/auth", 'refresh');
        } else {
            //display the create user form
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() :
                ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['first_name'] = array(
                'name' => 'first_name',
                'id' => 'first_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('first_name'),
                'class' => 'form-control',
            );
            $this->data['last_name'] = array(
                'name' => 'last_name',
                'id' => 'last_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('last_name'),
                'class' => 'form-control',
            );
            $this->data['email'] = array(
                'name' => 'email',
                'id' => 'email',
                'type' => 'text',
                'value' => $this->form_validation->set_value('email'),
                'class' => 'form-control',
            );
            $this->data['password'] = array(
                'name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'value' => $this->form_validation->set_value('password'),
                'class' => 'form-control',
            );
            $this->data['password_confirm'] = array(
                'name' => 'password_confirm',
                'id' => 'password_confirm',
                'type' => 'password',
                'value' => $this->form_validation->set_value('password_confirm'),
                'class' => 'form-control',
            );

            $headerdata['title'] = 'Dashboard | BIB - Betreiberbackend';
            $headerdata['langcode'] = 'de';
            $headerdata['userid'] = $this->ion_auth->user()->row()->id;

            $this->data['formopenparams'] = array('role' => 'form', 'id' => 'edit_user_form');
            $this->data['submitbtn'] = array(
                'class' => 'btn green',
                'type' => 'submit',
                'content' => lang('create_user_submit_btn'),
                'name' => 'submitbutton'
            );

            $this->data['username'] = $this->ion_auth->user()->row()->username;
            $headerdata['username'] =
                $this->ion_auth->user()->row()->first_name . ' ' . $this->ion_auth->user()->row()->last_name;

            $this->load->view('backend/layouts/header', $headerdata);
            $this->load->view('backend/layouts/sidebar');
            $this->load->view('auth/create_user', $this->data);
            $this->load->view('backend/layouts/footer');
        }
    }

    function deactivate($id = null) {
        $id = (int)$id;

        $this->load->library('form_validation');
        $this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'),
            'required');
        $this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'),
            'required|alpha_numeric');

        if ($this->form_validation->run() == false) {
            // insert csrf check
            $this->data['csrf'] = $this->_get_csrf_nonce();
            $this->data['user'] = $this->ion_auth->user($id)->row();

            $this->_render_page('auth/deactivate_user', $this->data);
        } else {
            // do we really want to deactivate?
            if ($this->input->post('confirm') == 'yes') {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === false || $id != $this->input->post('id')) {
                    show_error($this->lang->line('error_csrf'));
                }

                // do we have the right userlevel?
                if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
                    $this->ion_auth->deactivate($id);
                }
            }

            //redirect them back to the auth page
            redirect('auth', 'refresh');
        }
    }

    function _get_csrf_nonce() {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }


    //activate the user

    function _valid_csrf_nonce() {
        return true;

        if ($this->input->post($this->session->flashdata('csrfkey')) !== false
            && $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')
        ) {
            return true;
        } else {
            return false;
        }
    }

    function edit_group($id) {
        // bail if no group id given
        if (!$id || empty($id)) {
            redirect('auth', 'refresh');
        }

        $this->data['title'] = $this->lang->line('edit_group_title');

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

        $group = $this->ion_auth->group($id)->row();

        //validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'),
            'required|alpha_dash|xss_clean');
        $this->form_validation->set_rules('group_description', $this->lang->line('edit_group_validation_desc_label'),
            'xss_clean');

        if (isset($_POST) && !empty($_POST)) {
            if ($this->form_validation->run() === true) {
                $group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

                if ($group_update) {
                    $this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
                } else {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                }
                redirect("auth", 'refresh');
            }
        }

        //set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() :
            ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        //pass the user to the view
        $this->data['group'] = $group;

        $this->data['group_name'] = array(
            'name' => 'group_name',
            'id' => 'group_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('group_name', $group->name),
        );
        $this->data['group_description'] = array(
            'name' => 'group_description',
            'id' => 'group_description',
            'type' => 'text',
            'value' => $this->form_validation->set_value('group_description', $group->description),
        );

        $this->_render_page('auth/edit_group', $this->data);
    }

    //deactivate the user

    function edit_user($id) {
        $this->data['title'] = "Edit User";

        if (!$this->ion_auth->logged_in()
            || (!$this->ion_auth->is_admin()
                && !($this->ion_auth->user()->row()->id == $id))
        ) {
            redirect('/backend', 'refresh');
        }

        $user = $this->ion_auth->user($id)->row();
        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();

        //validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'),
            'required|xss_clean');
        $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'),
            'required|xss_clean');
        $this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'xss_clean');
        $this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'),
            'xss_clean');
        $this->form_validation->set_rules('groups', $this->lang->line('edit_user_validation_groups_label'),
            'xss_clean');

        if (isset($_POST) && !empty($_POST)) {
            // do we have a valid request?
            if ($this->_valid_csrf_nonce() === false || $id != $this->input->post('id')) {
                show_error($this->lang->line('error_csrf'));
            }

            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'company' => $this->input->post('company'),
                'phone' => $this->input->post('phone'),
            );

            // Only allow updating groups if user is admin
            if ($this->ion_auth->is_admin()) {
                //Update the groups user belongs to
                $groupData = $this->input->post('groups');

                if (isset($groupData) && !empty($groupData)) {

                    $this->ion_auth->remove_from_group('', $id);

                    foreach ($groupData as $grp) {
                        $this->ion_auth->add_to_group($grp, $id);
                    }

                }
            }

            //update the password if it was posted
            if ($this->input->post('password')) {
                $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'),
                    'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length['
                    . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm',
                    $this->lang->line('edit_user_validation_password_confirm_label'), 'required');

                $data['password'] = $this->input->post('password');
            }

            if ($this->form_validation->run() === true) {
                $this->ion_auth->update($user->id, $data);

                //check to see if we are creating the user
                //redirect them back to the admin page
                $this->session->set_flashdata('message', "User Saved");

                if ($this->ion_auth->is_admin()) {
                    redirect('/backend/auth', 'refresh');
                } else {
                    redirect('/backend', 'refresh');
                }
            }
        }

        //display the edit user form
        $this->data['csrf'] = $this->_get_csrf_nonce();

        //set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() :
            ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        //pass the user to the view
        $this->data['user'] = $user;
        $this->data['groups'] = $groups;
        $this->data['currentGroups'] = $currentGroups;

        $this->data['first_name'] = array(
            'name' => 'first_name',
            'id' => 'first_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('first_name', $user->first_name),
            'class' => 'form-control',
        );
        $this->data['last_name'] = array(
            'name' => 'last_name',
            'id' => 'last_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('last_name', $user->last_name),
            'class' => 'form-control',
        );
        $this->data['company'] = array(
            'name' => 'company',
            'id' => 'company',
            'type' => 'text',
            'value' => $this->form_validation->set_value('company', $user->company),
            'class' => 'form-control',
        );
        $this->data['phone'] = array(
            'name' => 'phone',
            'id' => 'phone',
            'type' => 'text',
            'value' => $this->form_validation->set_value('phone', $user->phone),
            'class' => 'form-control',
        );
        $this->data['password'] = array(
            'name' => 'password',
            'id' => 'password',
            'type' => 'password',
            'class' => 'form-control',
        );
        $this->data['password_confirm'] = array(
            'name' => 'password_confirm',
            'id' => 'password_confirm',
            'type' => 'password',
            'class' => 'form-control',
        );

        $headerdata['title'] = 'Dashboard | BIB - Betreiberbackend';
        $headerdata['langcode'] = 'de';
        $headerdata['userid'] = $this->ion_auth->user()->row()->id;

        $this->data['formopenparams'] = array('role' => 'form', 'id' => 'edit_user_form');
        $this->data['submitbtn'] = array(
            'class' => 'btn green',
            'type' => 'submit',
            'content' => lang('edit_user_submit_btn'),
            'name' => 'submitbutton'
        );

        $this->data['username'] = $this->ion_auth->user()->row()->username;
        $headerdata['username'] = $this->ion_auth->user()->row()->first_name . ' '
            . $this->ion_auth->user()->row()->last_name;

        $this->load->view('backend/layouts/header', $headerdata);
        $this->load->view('backend/layouts/sidebar');
        $this->load->view('auth/edit_user', $this->data);
        $this->load->view('backend/layouts/footer');
    }

    //create a new user

    function forgot_password() {
        $this->form_validation->set_rules('email', 'E-Mail-Adresse', 'required|valid_email');
        if ($this->form_validation->run() === false) {
            echo json_encode(array(
                'status' => false,
                'error_code' => 1
            ));

            return;
        }

        $identity = $this->ion_auth->where('email', strtolower($this->input->post('email')))->users()->row();

        if (empty($identity)) {
            //Because any person can use this to check if a email exists
            echo json_encode(array(
                'status' => true,
            ));

            return;
        }

        if ($this->ion_auth->forgotten_password($identity->email)) {
            echo json_encode(array(
                'status' => true
            ));
        } else {
            echo json_encode(array(
                'status' => false,
                'error_code' => 2,
                'add' => $this->ion_auth->errors_array()
            ));
        }
    }

    //edit a user

    function index() {

        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('backend/auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) //remove this elseif if you want to enable this for non-admins
        {
            //redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to view this page.');
        } else {
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            //list the users
            $this->data['users'] = $this->ion_auth->users()->result();
            foreach ($this->data['users'] as $k => $user) {
                $the_groups = $this->ion_auth->get_users_groups($user->id)->result();

                if (count($the_groups) == 1 && $the_groups[0]->id == 4) {
                    unset($this->data['users'][$k]);
                } else {
                    $this->data['users'][$k]->groups = $the_groups;
                }

            }

            $headerdata['title'] = 'Backend-User Verwaltung | BIB - Betreiberbackend';
            $headerdata['langcode'] = 'de';
            $headerdata['userid'] = $this->ion_auth->user()->row()->id;

            /*$this->data['formopenparams'] = array('role' => 'form', 'id' => 'edit_user_form');
            $this->data['submitbtn'] = array(
                'class' => 'btn green',
                'type' => 'submit',
                'content' => lang('edit_user_submit_btn'),
                'name' => 'submitbutton'
            );*/

            $this->data['username'] = $this->ion_auth->user()->row()->username;
            $headerdata['username'] =
                $this->ion_auth->user()->row()->first_name . ' ' . $this->ion_auth->user()->row()->last_name;

            $this->load->view('backend/layouts/header', $headerdata);
            $this->load->view('backend/layouts/sidebar');
            $this->load->view('auth/index', $this->data);
            $this->load->view('backend/layouts/footer');
        }
    }

    // create a new group

    function login() {
        $this->data['title'] = "Login";

        $this->data['email'] = array(
            'name' => 'email',
            'type' => 'text',
            'class' => 'form-control placeholder-no-fix',
            'placeholder' => 'E-Mail-Adresse',
            'value' => $this->form_validation->set_value('email'),
        );
        $this->data['password'] = array(
            'name' => 'password',
            'type' => 'password',
            'class' => 'form-control placeholder-no-fix',
            'placeholder' => 'Passwort'
        );

        $this->load->view('auth/login', $this->data);
    }

    //edit a group

    function loginCheck() {
        $this->form_validation->set_rules('email', 'E-Mail-Adresse', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Passwort', 'required');

        if (!$this->form_validation->run()) {
            echo json_encode(array(
                'status' => false,
                'error_code' => 1
            ));
            return;
        }

        if ($this->ion_auth->login($this->input->post('email'), $this->input->post('password'),
            (bool)$this->input->post('remember'))
        ) {
            echo json_encode(array(
                'status' => true
            ));
        } else {
            echo json_encode(array(
                'status' => false,
                'error_code' => 2
            ));
        }
    }

    function remove($id = null) {
        $id = (int)$id;

        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
            $this->ion_auth->delete_user($id);
        }
        $this->session->set_flashdata('message', "Benutzer erfolgreich gelöscht");
        redirect('backend/auth', 'refresh');

    }

    public function reset_password($code = false) {
        if (!$code) {
            redirect('/backend/auth/login');
            return;
        }

        $user = $this->ion_auth->forgotten_password_check($code);
        if (!$user) {
            redirect('/backend/auth/login');
            return;
        }

        $this->data['csrf_nonce'] = $this->_get_csrf_nonce();
        $this->data['code'] = $code;

        $this->_render_page('auth/reset_password', $this->data);
    }

    function reset_password_step2() {
        if (!$this->input->post('code')) {
            echo json_encode(array(
                'status' => false,
                'error_code' => 1
            ));
            return;
        }

        $code = $this->input->post('code');

        $user = $this->ion_auth->forgotten_password_check($code);
        if (!$user) {
            echo json_encode(array(
                'status' => false,
                'error_code' => 2
            ));
            return;
        }

        $minLength = $this->config->item('min_password_length', 'ion_auth');
        $maxLength = $this->config->item('max_password_length', 'ion_auth');

        $this->form_validation->set_rules('password', 'Passwort',
            "required|min_length[{$minLength}]|max_length[{$maxLength}]");
        $this->form_validation->set_rules('confirm', 'Bestätigung', 'required|matches[password]');

        if (!$this->form_validation->run()) {
            echo json_encode(array(
                'status' => false,
                'error_code' => 3,
                'add' => form_error('password'),
                'add2' => form_error('confirm')
            ));
            return;
        }

        $identity = $user->{$this->config->item('identity', 'ion_auth')};
        //@todo check that token is invalidated
        if ($this->ion_auth->reset_password($identity, $this->input->post('password'))) {
            echo json_encode(array(
                'status' => true
            ));
            $this->logout();
        } else {
            echo json_encode(array(
                'status' => false,
                'error_code' => 4
            ));
        }
    }

}

<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_controller  {

	protected $table = 'admins';
	protected $redirect = 'dashboard';
	
	public function index()
	{
        $data['title'] = 'dashboard';
        $data['name'] = 'dashboard';
        $data['url'] = $this->redirect;
        
        return $this->template->load('template', 'home', $data);
	}

	public function getInquiry($id)
	{
        $this->load->model('inquiry_model');
        $data = $this->inquiry_model->get('inquiry', 'name, email, mobile, company, requirements, message', ['id' => d_id($id)]);
        
        die($this->load->view(admin('inquiry/getInquiry'), $data, TRUE));
	}
    
	public function getApply($id)
	{
        $this->load->model('apply_model');
        $data = $this->apply_model->get('job_apply a', 'c.c_title, a.name, a.subject, a.email, a.phone, a.aadhar, a.message, a.resume, a.image, a.police_certy, a.licence', ['a.id' => d_id($id)]);
        $this->path = $this->config->item('apply');
        die($this->load->view(admin('apply/getApply'), $data, TRUE));
	}

	public function profile()
    {
        if ($this->form_validation->run('profile') == FALSE)
        {
            $data['title'] = 'Profile';
            $data['name'] = 'profile';
            $data['operation'] = 'Update';
            $data['url'] = $this->redirect;

            return $this->template->load('template', 'profile', $data);
        }
        else
        {
            $post = [
    			'mobile'   	 => $this->input->post('mobile'),
    			'email'   	 => $this->input->post('email'),
    			'name'   	 => $this->input->post('name')
    		];

            if ($this->input->post('password'))
                $post['password'] = my_crypt($this->input->post('password'));

            $id = $this->main->update(['id' => $this->session->auth], $post, $this->table);

            flashMsg($id, "Profile updated.", "Profile not updated. Try again.", admin("profile"));
        }
    }

	public function logout()
    {
        $this->session->sess_destroy();
        return redirect(admin('login'));
    }

	public function backup()
    {
        // Load the DB utility class
        $this->load->dbutil();
        
        // Backup your entire database and assign it to a variable
        $backup = $this->dbutil->backup();

        // Load the download helper and send the file to your desktop
        $this->load->helper('download');
        force_download(APP_NAME.'.zip', $backup);
        return redirect(admin());
    }
}
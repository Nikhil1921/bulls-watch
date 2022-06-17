<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends Admin_controller  {

    public function __construct()
	{
		parent::__construct();
		$this->path = $this->config->item('service');
	}

	protected $table = 'services';
	protected $redirect = 'services';
	protected $title = 'Service';
	protected $name = 'services';
	
	public function index()
	{
        $data['title'] = $this->title;
        $data['name'] = $this->name;
        $data['url'] = $this->redirect;
        $data['operation'] = "List";
        $data['datatable'] = "$this->redirect/get";
        
		return $this->template->load('template', "$this->redirect/home", $data);
	}

    public function get()
    {
        check_ajax();
        $this->load->model('Services_model', 'data');
        
        $fetch_data = $this->data->make_datatables();
        $sr = $this->input->get('start') + 1;
        $data = [];

        foreach($fetch_data as $row)
        {
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->name;
            $sub_array[] = img($this->path.$row->image, '', 'height="50"');

            $action = '<div class="dropdown">
                          <button type="button" class="btn btn-round btn-outline-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false">
                            <i class="nc-icon nc-settings-gear-65"></i>
                          </button>
                          <div class="dropdown-menu" style="will-change: transform;">';
            
            $action .= anchor($this->redirect."/add-update/".e_id($row->id), '<i class="fa fa-edit"></i> Edit</a>', 'class="dropdown-item"');

            $action .= form_open($this->redirect.'/delete', 'id="'.e_id($row->id).'"', ['id' => e_id($row->id)]).
                '<a class="dropdown-item" onclick="script.delete('.e_id($row->id).'); return false;" href=""><i class="fa fa-trash"></i> Delete</a>'.
                form_close();

            $action .= '</div></div>';
            
            $sub_array[] = $action;
            
            $data[] = $sub_array;  
            $sr++;
        }

        $output = [
            "draw"              => intval($this->input->get('draw')),  
            "recordsTotal"      => $this->data->count(),
            "recordsFiltered"   => $this->data->get_filtered_data(),
            "data"              => $data
        ];
        
        die(json_encode($output));
    }

    public function add_update($id=0)
	{
        $this->form_validation->set_rules($this->validate);

        $data['title'] = $this->title;
        $data['name'] = $this->name;
        $data['operation'] = $id === 0 ? "Add" : "Update";
        $data['url'] = $this->redirect;
        $data['image'] = true;

        if($id !== 0) $data['data'] = $this->main->get($this->table, 'name, title, slug, description, image', ['id' => d_id($id)]);
        
        if ($this->form_validation->run() == FALSE)
        {
            return $this->template->load('template', "$this->redirect/form", $data);
        }else{
            $img = '';

            if($id === 0){
                $image = $this->uploadImage('image');
                if ($image['error'] == TRUE){
                    $this->session->set_flashdata('error', $image["message"]);
                    return $this->template->load('template', "$this->redirect/form", $data);
                }else
                    $img = $image["message"];
            }else{
                if (!empty($_FILES['image']['name'])) {
                    $image = $this->uploadImage('image');
                    if ($image['error'] == TRUE){
                        $this->session->set_flashdata('error', $image["message"]);
                        return $this->template->load('template', "$this->redirect/form", $data);
                    }else
                        $img = $image["message"];
                }else
                    $img = $this->input->post('image');
            }
            
            $post = [
                'name'         => $this->input->post('name'),
                'description'  => $this->input->post('description'),
                'title'        => $this->input->post('title'),
                'slug'         => $this->input->post('slug'),
                'image'        => $img
            ];
            
            $uid = ($id === 0) ? $this->main->add($post, $this->table) : $this->main->update(['id' => d_id($id)], $post, $this->table);

            $msg = ($id === 0) ? 'added' : 'updated';
            $unlink = $this->input->post('image');

            if($id !== 0 && $uid && $unlink !== $img && is_file($this->path.$unlink))
                unlink($this->path.$unlink);
                
            if(!$uid && is_file($this->path.$img))
                unlink($this->path.$img);

            flashMsg($uid, "$this->title $msg.", "$this->title not $msg. Try again.", $this->redirect);
        }
	}

    public function delete()
    {
        $this->form_validation->set_rules('id', 'id', 'required|is_natural');
        if ($this->form_validation->run() == FALSE)
            flashMsg(0, "", "Some required fields are missing.", $this->redirect);
        else{
            $id = $this->main->update(['id' => d_id($this->input->post('id'))], ['is_deleted' => 1],$this->table);
            flashMsg($id, "$this->title deleted.", "$this->title not deleted.", $this->redirect);
        }
    }

    public function slug_check($slug)
    {
        $check = $this->uri->segment(4) ? d_id($this->uri->segment(4)) : 0;

        $where = ['slug' => $slug, 'id != ' => $check, 'is_deleted' => 0];
        
        if ($this->main->check($this->table, $where, 'id'))
        {
            $this->form_validation->set_message('slug_check', '%s is already in use');
            return FALSE;
        } else
            return TRUE;
    }

    protected $validate = [
        [
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required|max_length[200]|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 200 chars allowed",
            ],
        ],
        [
            'field' => 'slug',
            'label' => 'Slug',
            'rules' => 'required|max_length[200]|alpha_dash|trim|callback_slug_check',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 200 chars allowed.",
                'alpha_dash' => "Only characters and dash are allowed.",
            ],
        ],
        [
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'required|max_length[200]|trim',
            'errors' => [
                'required' => "%s is required",
                'alpha_numeric_spaces' => "%s is invalid",
                'max_length' => "Max 200 chars allowed",
            ],
        ],
        [
            'field' => 'description',
            'label' => 'Description',
            'rules' => 'required|trim',
            'errors' => [
                'required' => "%s is required",
            ],
        ]
    ];
}
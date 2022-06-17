<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_controller {

	public function __construct()
	{
		parent::__construct();
		$this->services = $this->main->getAll('services', 'image, slug, name, title, description', ['is_deleted' => 0]);
	}

	public function index()
	{
		if($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') === "POST"):
			$post = [
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'mobile' => $this->input->post('phone'),
				'company' => $this->input->post('company'),
				'requirements' => $this->input->post('requirements'),
			];

			$id = $this->main->add($post, 'inquiry');

			$response = [
				'error' => $id ? false : true,
				'message' => $id ? "Thank you for showing interest. Your request is saved. we will get back to you shortly." : "Your request is not saved. Try again.",
			];

			die(json_encode($response));
		else:
			$data['title'] = "Home";
			$data['banners'] = $this->main->getAll('banners', 'CONCAT("'.$this->config->item('banners').'", banner) banner', []);
			
			$data['validate'] = true;
			$data['owl'] = true;
			
			return $this->template->load('template', "home", $data);
		endif;
	}

	public function about()
	{
		if($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') === "POST"):
			$this->path = $this->config->item('testimonials');
			$img = $this->uploadImage('image');
			
			if($img['error']) die(json_encode($img));
			
			$post = [
				't_title' => $this->input->post('t_title'),
				't_name' => $this->input->post('name'),
				'description' => $this->input->post('message'),
				'image' => $img['message']
			];
			
			$id = $this->main->add($post, 'testimonials');

			if(!$id) unlink($this->path.$img['message']);

			$response = [
				'error' => $id ? false : true,
				'message' => $id ? "Thank you for feedback." : "Your feedback is not saved. Try again.",
			];

			die(json_encode($response));
		else:
			$data['title'] = "About Us";
			$data['bread'] = "About Us";
			$data['testimonials'] = $this->main->getAll('testimonials', 't_title, description, t_name, CONCAT("'.$this->config->item('testimonials').'", image) image', ['is_deleted' => 0, 'is_approved' => 1]);
			
			return $this->template->load('template', "about", $data);
		endif;
	}

	public function services()
	{
		$data['title'] = "Services";
		$data['bread'] = "Services";
		
		return $this->template->load('template', "services", $data);
	}

	public function gallery()
	{
		$data['title'] = "Gallery";
		$data['bread'] = "Gallery";
		$data['gallery'] = $this->main->getAll('gallery', 'CONCAT("'.$this->config->item('gallery').'", image) image', []);
		
		return $this->template->load('template', "gallery", $data);
	}

	public function career()
	{
		$data['title'] = "Career";
		$data['bread'] = "Career";
		$data['careers'] = $this->main->getAll('careers', 'id, c_title, eligibility, height, documents, description', ['is_deleted' => 0]);
		
		return $this->template->load('template', "career", $data);
	}

	public function faq()
	{
		if($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') === "POST"):
			
			$post = [
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'mobile' => $this->input->post('phone'),
				'message' => $this->input->post('message')
			];
			
			$id = $this->main->add($post, 'inquiry');
			
			$response = [
				'error' => $id ? false : true,
				'message' => $id ? "Thank you for showing interest. Your request is saved. we will get back to you shortly." : "Your request is not saved. Try again.",
			];

			die(json_encode($response));
		else:
			$data['title'] = "FAQ";
			$data['bread'] = "FAQ";
			
			return $this->template->load('template', "faq", $data);
		endif;
	}

	public function contact()
	{
		if($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') === "POST"):
			
			$post = [
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'mobile' => $this->input->post('phone'),
				'company' => $this->input->post('company'),
				'requirements' => $this->input->post('requirements'),
				'message' => $this->input->post('message')
			];
			
			$id = $this->main->add($post, 'inquiry');
			
			$response = [
				'error' => $id ? false : true,
				'message' => $id ? "Thank you for showing interest. Your request is saved. we will get back to you shortly." : "Your request is not saved. Try again.",
			];

			die(json_encode($response));
		else:
			$data['title'] = "Contact Us";
			$data['bread'] = "Contact Us";
			
			return $this->template->load('template', "contact", $data);
		endif;
	}

	public function apply()
	{
		if($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') === "POST"):
			$this->path = $this->config->item('apply');

			$resume = $this->uploadImage('resume', 'pdf|PDF');
			
			if($resume['error']){
				$resume['message'] = "Resume : ".$resume['message'];
				die(json_encode($resume));
			}

			$image = $this->uploadImage('image', "jpg|jpeg|png|JPG|JPEG|PNG", [], floor(microtime(true) * 1000));

			if($image['error']){
				$image['message'] = "Photo : ".$image['message'];
				unlink($this->path.$resume['message']);
				die(json_encode($image));
			}

			$police_certy = $this->uploadImage('police_certy', "jpg|jpeg|png|JPG|JPEG|PNG", [], floor(microtime(true) * 1000));

			if($police_certy['error']){
				$police_certy['message'] = "Police verification : ".$police_certy['message'];
				unlink($this->path.$resume['message']);
				unlink($this->path.$image['message']);
				die(json_encode($police_certy));
			}

			if(!empty($_FILES['licence']['name']))
			{
				$licence = $this->uploadImage('licence', "jpg|jpeg|png|JPG|JPEG|PNG", [], floor(microtime(true) * 1000));
	
				if($licence['error']){
					$licence['message'] = "Licence : ".$licence['message'];
					unlink($this->path.$resume['message']);
					unlink($this->path.$image['message']);
					unlink($this->path.$police_certy['message']);
					die(json_encode($licence));
				}
			}
			
			$post = [
				'job_id' => my_crypt($this->input->post('job'), 'd'),
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'aadhar' => $this->input->post('aadhar'),
				'subject' => $this->input->post('subject'),
				'message' => $this->input->post('message'),
				'resume' => $resume['message'],
				'image' => $image['message'],
				'police_certy' => $police_certy['message'],
				'licence' => isset($licence['message']) ? $licence['message'] : '',
			];
			
			$id = $this->main->add($post, 'job_apply');
			
			$response = [
				'error' => $id ? false : true,
				'message' => $id ? "Thank you for showing interest. Your request is saved. we will get back to you shortly." : "Your request is not saved. Try again.",
			];

			die(json_encode($response));
		else:
			$data['title'] = "Apply";
			$data['careers'] = $this->main->getAll('careers', 'id, c_title', ['is_deleted' => 0]);
			
			return $this->template->load('template', "apply", $data);
		endif;
	}

	public function service($service)
	{
		
		$service = array_filter($this->services, function($s) use ($service) {
			if($s['slug'] === $service) return $s;
		});

		switch (true) {
			case count($service):
				$service = reset($service);
				$data['title'] = $service['name'];
				$data['bread'] = $service['name'];
				$data['data'] = $service;
				
				return $this->template->load('template', "service", $data);
				break;
			
			default:
				return $this->error_404();
				break;
		}
	}
}
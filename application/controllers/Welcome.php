<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$data['header'] = $this->Contentmodel->getfield();
		$data['isi'] = $this->Contentmodel->getalldata();
		$data['isi2'] = $this->Categorymodel->getalldata();
		$this->load->view('welcome_message', $data);
	}
	public function tambah()
	{
		$this->load->view('tambah');
	}
	public function adddata()
	{
		$config['upload_path']          = './picture/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 1024;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('userfile')) {
			$error = array('error' => $this->upload->display_errors());
			foreach ($error as $error) :
				echo ($error);
			endforeach;
			$this->load->view('tambah', $error);
		} else {
			$picture = $this->upload->data();
			$picture = $picture['file_name'];
			$title = $this->input->post('title', true);
			$content = $this->input->post('content', true);
			$slug = $this->input->post('slug', true);
			$categoryid = $this->input->post('category_id', true);
			$category = $this->input->post('category', true);
			$data = array(
				'title' => $title,
				'content' => $content,
				'slug' => $slug,
				'category_id' => $categoryid,
				'image' => $picture,
			);
			$data2 = array(
				'id' => $categoryid,
				'category' => $category,
			);
			$this->Contentmodel->insertdata($data);
			$this->Categorymodel->insertdata($data2);
			$this->index();
		}
	}
	public function edit($id)
	{
		$data['isi'] = $this->Contentmodel->getid($id);
		$data['isi2'] = $this->Categorymodel->getid($id);
		$this->load->view('edit', $data);
	}
	public function delete($id)
	{
		$this->Contentmodel->deletedata($id);
		$this->Categorymodel->deletedata($id);
		$this->index();
	}
	public function updatedata()
	{
		$config['upload_path']          = './picture/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 1024;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('userfile')) {
			$error = array('error' => $this->upload->display_errors());
			foreach ($error as $error) :
				echo ($error);
			endforeach;
			$this->load->view('tambah', $error);
		} else {
			$picture = $this->upload->data();
			$picture = $picture['file_name'];
			$title = $this->input->post('title', true);
			$content = $this->input->post('content', true);
			$slug = $this->input->post('slug', true);
			$categoryid = $this->input->post('category_id', true);
			$category = $this->input->post('category', true);
			$id = $this->input->post('id');
			$id2 = $this->input->post('id2');
			$data = array(
				'title' => $title,
				'content' => $content,
				'slug' => $slug,
				'category_id' => $categoryid,
				'image' => $picture,
			);
			$data2 = array(
				'id' => $categoryid,
				'category' => $category,
			);
			$where = array('id' => $id);
			$where2 = array('id' => $id2);
			$this->Contentmodel->updatedata($where, $data, 'content');
			$this->Categorymodel->updatedata($where2, $data2, 'category');
			$this->index();
		}
	}
}

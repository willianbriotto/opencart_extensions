<?php
class ControllerModuleAlsoBought extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/also_bought');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('also_bought', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_heading'] = $this->language->get('entry_heading');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_quantity'] = $this->language->get('entry_quantity');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['error_heading'] = "";
		$data['error_quantity'] = "";
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/also_bought', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('module/also_bought', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['also_bought_heading'])) {
			$data['also_bought_heading'] = $this->request->post['also_bought_heading'];
		} else {
			$data['also_bought_heading'] = $this->config->get('also_bought_heading');
		}

		if (isset($this->request->post['status'])) {
			$data['also_bought_status'] = $this->request->post['also_bought_status'];
		} else {
			$data['also_bought_status'] = $this->config->get('also_bought_status');
		}

		if (isset($this->request->post['also_bought_quantity'])) {
			$data['also_bought_quantity'] = $this->request->post['also_bought_quantity'];
		} else {
			$data['also_bought_quantity'] = $this->config->get('also_bought_quantity');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/also_bought.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/also_bought')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}

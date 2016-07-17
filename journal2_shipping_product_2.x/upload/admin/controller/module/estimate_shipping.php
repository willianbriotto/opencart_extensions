<?php
class ControllerModuleEstimateShipping extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/estimate_shipping');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('estimate_shipping', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
		$data['geo_need'] = $this->language->get('geo_need');
		$data['entry_popup'] = $this->language->get('entry_popup');
		$data['entry_header'] = $this->language->get('entry_header');
		$data['entry_status'] = $this->language->get('entry_status');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_remove'] = $this->language->get('button_remove');

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
			'href' => $this->url->link('module/estimate_shipping', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('module/estimate_shipping', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['estimate_shipping_header_title'])) {
			$data['estimate_shipping_header_title'] = $this->request->post['estimate_shipping_header_title'];
		} else {
			$data['estimate_shipping_header_title'] = $this->config->get('estimate_shipping_header_title');
		}

		if (isset($this->request->post['popup_title'])) {
			$data['estimate_shipping_popup_title'] = $this->request->post['estimate_shipping_popup_title'];
		} else {
			$data['estimate_shipping_popup_title'] = $this->config->get('estimate_shipping_popup_title');
		}

		if (isset($this->request->post['estimate_shipping_geo'])) {
			$data['estimate_shipping_geo'] = $this->request->post['estimate_shipping_geo'];
		} else {
			$data['estimate_shipping_geo'] = $this->config->get('estimate_shipping_geo');
		}

		if (isset($this->request->post['estimate_shipping_shipping_status'])) {
			$data['estimate_shipping_status'] = $this->request->post['estimate_shipping_status'];
		} else {
			$data['estimate_shipping_status'] = $this->config->get('estimate_shipping_status');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/estimate_shipping.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/estimate_shipping')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}

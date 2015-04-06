<?php 
/*
	@author willianbriotto@gmail.com
	@licence GPL(General Public License)
*/
class ControllerModuleProductShipping extends Controller {
    private $error = array();
 
    public function index() {
        $this->load->language('module/product_shipping');
        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');
		
 
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('product_shipping', $this->request->post);        
			$this->session->data['success'] = $this->language->get('text_success');
            $this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        }
 
        $this->data['heading_title'] = $this->language->get('heading_title');
 
        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_yes'] = $this->language->get('text_yes');
        $this->data['text_no'] = $this->language->get('text_no');
		$this->data['geo_need'] = $this->language->get('geo_need');
		$this->data['entry_popup'] = $this->language->get('entry_popup');
		$this->data['entry_header'] = $this->language->get('entry_header');
		$this->data['entry_enabled'] = $this->language->get('entry_enabled');
 
        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');
        $this->data['button_remove'] = $this->language->get('button_remove');
 
        /* Faz a validacao dos dados enviados pelo modulo */
        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }
 
        /* Carrega os dados do Breadcrumbs (auxiliares de navegacao) */
        $this->data['breadcrumbs'] = array();
 
        $this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );
 
        $this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_module'),
            'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
        );
 
        $this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('module/product_shipping', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
        );
 
        $this->data['action'] = $this->url->link('module/product_shipping', 'token=' . $this->session->data['token'], 'SSL');
 
        $this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
 
        $this->data['token'] = $this->session->data['token'];
 
        $this->data['modules'] = array();
		
		$_data = $this->model_setting_setting->getSetting('product_shipping');  
 
        if (isset($this->request->post['product_shipping_module'])) {
            $this->data['modules'] = $this->request->post['product_shipping_module'];
        } elseif ($_data) {
            $this->data['modules'] = $_data;
        }
 
        $this->load->model('design/layout');
 
        $this->data['layouts'] = $this->model_design_layout->getLayouts();
 
        $this->template = 'module/product_shipping.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );
 
        $this->response->setOutput($this->render());
    }
 
    private function validate() {
        if (!$this->user->hasPermission('modify', 'module/product_shipping')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
 
        if (!$this->error) {
            return true;
        } else {
            return false;
        }    
    }
}
?>
<?php
class ControllerExtensionPaymentcheckoutapipayment extends Controller
{
    private $error = array();

    public function index()
    {
        $this->load->language('extension/payment/checkoutapipayment');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate())
        {
            $this->model_setting_setting->editSetting('checkoutapipayment', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true));

        }

        $data['heading_title']                 = $this->language->get('heading_title');
        $data['text_edit']                     = $this->language->get('text_edit');
        $data['text_checkoutapipayment_join']  = $this->language->get('text_checkoutapipayment_join');
        $data['text_checkoutapipayment']       = $this->language->get('text_checkoutapipayment');
        $data['text_payment']                  = $this->language->get('text_payment');
        $data['text_success']                  = $this->language->get('text_success');
        $data['text_page_title']               = $this->language->get('text_page_title');
        $data['text_status_on']                = $this->language->get('text_status_on');
        $data['text_status_off']               = $this->language->get('text_status_off');
        $data['text_mode_sandbox']             = $this->language->get('text_mode_sandbox');
        $data['text_mode_live']                = $this->language->get('text_mode_live');
        $data['text_auth_only']                = $this->language->get('text_auth_only');
        $data['text_auth_capture']             = $this->language->get('text_auth_capture');
        $data['text_pci_yes']                  = $this->language->get('text_pci_yes');
        $data['text_pci_no']                   = $this->language->get('text_pci_no');
        $data['text_localPayment_yes']         = $this->language->get('text_localPayment_yes');
        $data['text_localPayment_no']          = $this->language->get('text_localPayment_no');
        $data['text_gateway_timeout']          = $this->language->get('text_gateway_timeout');
        $data['text_button_settings']          = $this->language->get('text_button_settings');
        $data['text_code']                     = $this->language->get('text_code');
        $data['text_symbol']                   = $this->language->get('text_symbol');
        $data['text_3D_yes']                   = $this->language->get('text_3D_yes');
        $data['text_3D_no']                    = $this->language->get('text_3D_no');

        $data['entry_test_mode']               = $this->language->get('entry_test_mode');
        $data['entry_secret_key']              = $this->language->get('entry_secret_key');
        $data['entry_public_key']              = $this->language->get('entry_public_key');
        $data['entry_localpayment_enable']     = $this->language->get('entry_localpayment_enable');
        $data['entry_payment_url']             = $this->language->get('entry_payment_url');
        $data['entry_pci_enable']              = $this->language->get('entry_pci_enable');
        $data['entry_payment_action']          = $this->language->get('entry_payment_action');
        $data['entry_autocapture_delay']       = $this->language->get('entry_autocapture_delay');
        $data['entry_card_type']               = $this->language->get('entry_card_type');
        $data['entry_gateway_timeout']         = $this->language->get('entry_gateway_timeout');
        $data['entry_successful_order_status'] = $this->language->get('entry_successful_order_status');
		$data['entry_flagged_order_status'] 	= $this->language->get('entry_flagged_order_status');	
        $data['entry_failed_order_status']     = $this->language->get('entry_failed_order_status');
        $data['entry_sort_order']              = $this->language->get('entry_sort_order');
        $data['entry_status']                  = $this->language->get('entry_status');
        $data['entry_sort_order']              = $this->language->get('entry_sort_order');
        $data['entry_gateway_timeout']         = $this->language->get('entry_gateway_timeout');
        $data['entry_logo_url']                = $this->language->get('entry_logo_url');
        $data['entry_theme_color']             = $this->language->get('entry_theme_color');
        $data['entry_button_color']            = $this->language->get('entry_button_color');
        $data['entry_icon_color']              = $this->language->get('entry_icon_color');
        $data['entry_currency_format']         = $this->language->get('entry_currency_format');
        $data['entry_3D_secure']               = $this->language->get('entry_3D_secure');

        $data['button_save']                   = $this->language->get('button_save');
        $data['button_cancel']                 = $this->language->get('button_cancel');


        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['checkoutapipayment_secret_key'])) {
            $data['error_secret_key'] = $this->error['checkoutapipayment_secret_key'];
        } else {
            $data['error_secret_key'] = '';
        }

        if (isset($this->error['checkoutapipayment_public_key'])) {
            $data['error_public_key'] = $this->error['checkoutapipayment_public_key'];
        } else {
            $data['error_public_key'] = '';
        }


        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
			/*'text' => $this->language->get('text_extension'),*/
                        'text' => 'Extension',
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/payment/checkoutapipayment', 'token=' . $this->session->data['token'], true)
		);
		$data['action'] = $this->url->link('extension/payment/checkoutapipayment', 'token=' . $this->session->data['token'], true);
		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true);
        //$data['action'] = $this->url->link('payment/checkoutapipayment', 'token=' . $this->session->data['token'], 'SSL');
        //$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');


        if (isset($this->request->post['checkoutapipayment_test_mode'])) {
            $data['checkoutapipayment_test_mode'] = $this->request->post['checkoutapipayment_test_mode'];
        } else {
            $data['checkoutapipayment_test_mode'] = $this->config->get('checkoutapipayment_test_mode');
        }

        if (isset($this->request->post['checkoutapipayment_3D_secure'])) {
            $data['checkoutapipayment_3D_secure'] = $this->request->post['checkoutapipayment_3D_secure'];
        } else {
            $data['checkoutapipayment_3D_secure'] = $this->config->get('checkoutapipayment_3D_secure');
        }

        if (isset($this->request->post['checkoutapipayment_secret_key'])) {
            $data['checkoutapipayment_secret_key'] = $this->request->post['checkoutapipayment_secret_key'];
        } else {
            $data['checkoutapipayment_secret_key'] = $this->config->get('checkoutapipayment_secret_key');
        }

        if (isset($this->request->post['checkoutapipayment_public_key'])) {
            $data['checkoutapipayment_public_key'] = $this->request->post['checkoutapipayment_public_key'];
        } else {
            $data['checkoutapipayment_public_key'] = $this->config->get('checkoutapipayment_public_key');
        }

        if (isset($this->request->post['checkoutapipayment_localpayment_enable'])) {
            $data['checkoutapipayment_localpayment_enable'] = $this->request->post['checkoutapipayment_localpayment_enable'];
        } else {
            $data['checkoutapipayment_localpayment_enable'] = $this->config->get('checkoutapipayment_localpayment_enable');
        }

        if (isset($this->request->post['checkoutapipayment_pci_enable'])) {
            $data['checkoutapipayment_pci_enable'] = $this->request->post['checkoutapipayment_pci_enable'];
        } else {
            $data['checkoutapipayment_pci_enable'] = $this->config->get('checkoutapipayment_pci_enable');
        }

        if (isset($this->request->post['checkoutapipayment_payment_action'])) {
            $data['checkoutapipayment_payment_action'] = $this->request->post['checkoutapipayment_payment_action'];
        } else {
            $data['checkoutapipayment_payment_action'] = $this->config->get('checkoutapipayment_payment_action');
        }

        if (isset($this->request->post['checkoutapipayment_autocapture_delay'])) {
            $data['checkoutapipayment_autocapture_delay'] = $this->request->post['checkoutapipayment_autocapture_delay'];
        } else {
            $data['checkoutapipayment_autocapture_delay'] = $this->config->get('checkoutapipayment_autocapture_delay');
        }

        if (isset($this->request->post['checkoutapipayment_gateway_timeout'])) {
            $data['checkoutapipayment_gateway_timeout'] = $this->request->post['checkoutapipayment_gateway_timeout'];
        } else {
            $data['checkoutapipayment_gateway_timeout'] = $this->config->get('checkoutapipayment_gateway_timeout');
        }

        if (isset($this->request->post['checkoutapipayment_checkout_successful_order'])) {
            $data['checkoutapipayment_checkout_successful_order'] = $this->request->post['checkoutapipayment_checkout_successful_order'];
        } else {
            $data['checkoutapipayment_checkout_successful_order'] = $this->config->get('checkoutapipayment_checkout_successful_order');
        }
		if (isset($this->request->post['checkoutapipayment_checkout_flagged_order'])) {
            $data['checkoutapipayment_checkout_flagged_order'] = $this->request->post['checkoutapipayment_checkout_flagged_order'];
        } else {
            $data['checkoutapipayment_checkout_flagged_order'] = $this->config->get('checkoutapipayment_checkout_flagged_order');
        }

        if (isset($this->request->post['checkoutapipayment_checkout_failed_order'])) {
            $data['checkoutapipayment_checkout_failed_order'] = $this->request->post['checkoutapipayment_checkout_failed_order'];
        } else {
            $data['checkoutapipayment_checkout_failed_order'] = $this->config->get('checkoutapipayment_checkout_failed_order');
        }

        if (isset($this->request->post['checkoutapipayment_logo_url'])) {
            $data['checkoutapipayment_logo_url'] = $this->request->post['checkoutapipayment_logo_url'];
        } else {
            $data['checkoutapipayment_logo_url'] = $this->config->get('checkoutapipayment_logo_url');
        }

        if (isset($this->request->post['checkoutapipayment_theme_color'])) {
            $data['checkoutapipayment_theme_color'] = $this->request->post['checkoutapipayment_theme_color'];
        } else {
            $data['checkoutapipayment_theme_color'] = $this->config->get('checkoutapipayment_theme_color');
        }

        if (isset($this->request->post['checkoutapipayment_button_color'])) {
            $data['checkoutapipayment_button_color'] = $this->request->post['checkoutapipayment_button_color'];
        } else {
            $data['checkoutapipayment_button_color'] = $this->config->get('checkoutapipayment_button_color');
        }

        if (isset($this->request->post['checkoutapipayment_icon_color'])) {
            $data['checkoutapipayment_icon_color'] = $this->request->post['checkoutapipayment_icon_color'];
        } else {
            $data['checkoutapipayment_icon_color'] = $this->config->get('checkoutapipayment_icon_color');
        }

        if (isset($this->request->post['checkoutapipayment_currency_format'])) {
            $data['checkoutapipayment_currency_format'] = $this->request->post['checkoutapipayment_currency_format'];
        } else {
            $data['checkoutapipayment_currency_format'] = $this->config->get('checkoutapipayment_currency_format');
        }

        $this->load->model('localisation/order_status');

        $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

        if (isset($this->request->post['checkoutapipayment_status'])) {
            $data['checkoutapipayment_status'] = $this->request->post['checkoutapipayment_status'];
        } else {
            $data['checkoutapipayment_status'] = $this->config->get('checkoutapipayment_status');
        }

        if (isset($this->request->post['checkoutapipayment_sort_order'])) {
            $data['checkoutapipayment_sort_order'] = $this->request->post['checkoutapipayment_sort_order'];
        } else {
            $data['checkoutapipayment_sort_order'] = $this->config->get('checkoutapipayment_sort_order');
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/payment/checkoutapi/checkoutapipayment', $data));
    }


    protected function validate()
    {
        if (!$this->user->hasPermission('modify', 'extension/payment/checkoutapipayment')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->request->post['checkoutapipayment_secret_key']) {
            $this->error['checkoutapipayment_secret_key'] = $this->language->get('error_secret_key');
        }

        if (!$this->request->post['checkoutapipayment_public_key']) {
            $this->error['checkoutapipayment_public_key'] = $this->language->get('error_public_key');
        }

        return !$this->error;
    }
}

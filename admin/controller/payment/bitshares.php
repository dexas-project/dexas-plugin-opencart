<?php 
/**
 * The MIT License (MIT)
 * 
 * Copyright (c) 2011-2014 BitShares
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

class ControllerPaymentBitShares extends Controller
{

    /**
     * @var array
     */
    private $error = array();

    /**
     * @var string
     */
    private $payment_module_name  = 'bitshares';

    /**
     * @return boolean
     */
    private function validate()
    {
		
        if (!$this->user->hasPermission('modify', 'payment/'.$this->payment_module_name))
        {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        
				
        if (!$this->error)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }	
    }
    /**
     */
    public function index()
    {
        $this->load->language('payment/'.$this->payment_module_name);
        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate()))
        {
            $this->model_setting_setting->editSetting($this->payment_module_name, $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
        }
        if (isset($this->error['warning']))
        {
            $data['error_warning'] = $this->error['warning'];
        }
        else
        {
            $data['error_warning'] = '';
        }
        if (isset($this->error['error']))
        {
            $data['error'] = $this->error['error'];
        }
        else
        {
            $data['error'] = '';
        }
        //$this->document->title = $this->language->get('heading_title'); // for 1.4.9
        $this->document->setTitle($this->language->get('heading_title')); // for 1.5.0 thanks rajds 
		
		$data['text_edit']				 = $this->language->get('text_edit');
        $data['heading_title']           = $this->language->get('heading_title');
        $data['text_enabled']            = $this->language->get('text_enabled');
        $data['text_disabled']           = $this->language->get('text_disabled');
		$data['text_bitshares']          = $this->language->get('text_bitshares');
		$data['text_bitshares_join']     = $this->language->get('text_bitshares_join');
        $data['entry_confirmed_status']  = $this->language->get('entry_confirmed_status');
        $data['entry_processing_status'] = $this->language->get('entry_processing_status');
        $data['entry_invalid_status']    = $this->language->get('entry_invalid_status');
        $data['entry_status']            = $this->language->get('entry_status');
        $data['entry_demo']              = $this->language->get('entry_demo');
        $data['button_save']             = $this->language->get('button_save');
        $data['button_cancel']           = $this->language->get('button_cancel');
        $data['tab_general']             = $this->language->get('tab_general');

        $data['breadcrumbs']   = array();
        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_payment'),
            'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('payment/bitshares', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $data['action'] = HTTPS_SERVER . 'index.php?route=payment/'.$this->payment_module_name.'&token=' . $this->session->data['token'];
        $data['cancel'] = HTTPS_SERVER . 'index.php?route=extension/payment&token=' . $this->session->data['token'];	

        $this->load->model('localisation/order_status');
        $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

        
		if (isset($this->request->post[$this->payment_module_name.'_processing_status_id'])) {
			$data[$this->payment_module_name.'_processing_status_id'] = $this->request->post[$this->payment_module_name.'_processing_status_id'];
		} elseif ($this->config->get($this->payment_module_name.'_processing_status_id')) {
			$data[$this->payment_module_name.'_processing_status_id'] = $this->config->get($this->payment_module_name.'_processing_status_id');
		} else {
			$data[$this->payment_module_name.'_processing_status_id'] = 2;
		}
			    
		if (isset($this->request->post[$this->payment_module_name.'_invalid_status_id'])) {
			$data[$this->payment_module_name.'_invalid_status_id'] = $this->request->post[$this->payment_module_name.'_invalid_status_id'];
		} elseif ($this->config->get($this->payment_module_name.'_invalid_status_id')) {
			$data[$this->payment_module_name.'_invalid_status_id'] = $this->config->get($this->payment_module_name.'_invalid_status_id');
		} else {
			$data[$this->payment_module_name.'_invalid_status_id'] = 0;
		}
		if (isset($this->request->post[$this->payment_module_name.'_confirmed_status_id'])) {
			$data[$this->payment_module_name.'_confirmed_status_id'] = $this->request->post[$this->payment_module_name.'_confirmed_status_id'];
		} elseif ($this->config->get($this->payment_module_name.'_confirmed_status_id')) {
			$data[$this->payment_module_name.'_confirmed_status_id'] = $this->config->get($this->payment_module_name.'_confirmed_status_id');
		} else {
			$data[$this->payment_module_name.'_confirmed_status_id'] = 5;
		}		


        if (isset($this->request->post[$this->payment_module_name.'_status']))
        {
            $data[$this->payment_module_name.'_status'] = $this->request->post[$this->payment_module_name.'_status'];
        }
        else
        {
            $data[$this->payment_module_name.'_status'] = $this->config->get($this->payment_module_name.'_status');
        }
       
        $this->template = 'payment/'.$this->payment_module_name.'.tpl';
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view($this->template, $data));
    }
}

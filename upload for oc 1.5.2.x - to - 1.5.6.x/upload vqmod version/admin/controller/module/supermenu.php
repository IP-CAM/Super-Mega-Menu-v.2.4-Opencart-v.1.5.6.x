<?php
class ControllerModulesupermenu extends Controller {
	private $error = array(); 
	private $sets = array();
	private function getSetting($i) {
		return isset($this->sets[$i]) ? $this->sets[$i] : null;
	}
	
	public function index() {   
		$this->language->load('module/supermenu');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
		$this->load->model('catalog/category');
		$this->load->model('catalog/information');
		$this->load->model('localisation/language');
		$this->load->model('tool/image');
        $this->load->model('setting/store');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

			$redirect = '';
			$sid = 0;
			
			if (isset($this->request->get['store']) && (int)$this->request->get['store']) {
				$redirect = '&store=' . (int)$this->request->get['store'];
				$sid = (int)$this->request->get['store'];
			}

			$this->model_setting_setting->editSetting('supermenu', $this->request->post, $sid);		
			
			$this->cache->delete('supermenu');
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('module/supermenu', 'token=' . $this->session->data['token'] . $redirect, 'SSL'));
		}

		$this->data['store'] = (isset($this->request->get['store']) && (int)$this->request->get['store']) ? (int)$this->request->get['store'] : 0;

		$this->sets = $this->model_setting_setting->getSetting('supermenu', $this->data['store']); 
				
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['stores'] = $this->model_setting_store->getStores();
		$this->data['text_stores'] = $this->language->get('text_stores');
		$this->data['text_fbrands'] = $this->language->get('text_fbrands');
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');
		$this->data['text_image'] = $this->language->get('text_image');
		$this->data['text_expando'] = $this->language->get('text_expando');
		$this->data['text_sorder'] = $this->language->get('text_sorder');
		$this->data['text_tlcolor'] = $this->language->get('text_tlcolor');
		$this->data['text_tlstyle'] = $this->language->get('text_tlstyle');
		$this->data['text_justadd'] = $this->language->get('text_justadd');
		$this->data['text_alldrop'] = $this->language->get('text_alldrop');
		$this->data['text_overdrop'] = $this->language->get('text_overdrop');
		$this->data['text_supermenuisresponsive'] = $this->language->get('text_supermenuisresponsive');
		$this->data['text_or'] = $this->language->get('text_or');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['tab_items'] = $this->language->get('tab_items');
		$this->data['tab_settings'] = $this->language->get('tab_settings');
		$this->data['tab_html'] = $this->language->get('tab_html');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_browse'] = $this->language->get('text_browse');
		$this->data['text_clear'] = $this->language->get('text_clear');
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');
		$this->data['text_unselect_all'] = $this->language->get('text_unselect_all');
		$this->data['text_select_all'] = $this->language->get('text_select_all');
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_add'] = $this->language->get('entry_add');
		$this->data['text_slist'] = $this->language->get('text_slist');
		$this->data['text_sgrid'] = $this->language->get('text_sgrid');
		$this->data['text_sview'] = $this->language->get('text_sview');
		$this->data['text_dwidth'] = $this->language->get('text_dwidth');
		$this->data['text_iwidth'] = $this->language->get('text_iwidth');
		$this->data['text_chtml'] = $this->language->get('text_chtml');
		$this->data['text_cchtml'] = $this->language->get('text_cchtml');
		$this->data['text_whatproducts'] = $this->language->get('text_whatproducts');
		$this->data['text_productlatest'] = $this->language->get('text_productlatest');
		$this->data['text_productspecial'] = $this->language->get('text_productspecial');
		$this->data['text_productfeatured'] = $this->language->get('text_productfeatured');
		$this->data['text_productbestseller'] = $this->language->get('text_productbestseller');
		$this->data['text_productlimit'] = $this->language->get('text_productlimit');
		$this->data['entry_type'] = $this->language->get('entry_type');
		$this->data['entry_category'] = $this->language->get('entry_category');
		$this->data['entry_custom'] = $this->language->get('entry_custom');
		$this->data['entry_information'] = $this->language->get('entry_information');
		$this->data['entry_advanced'] = $this->language->get('entry_advanced');
		$this->data['custom_name'] = $this->language->get('custom_name');
		$this->data['custom_url'] = $this->language->get('custom_url');
		$this->data['type_cat'] = $this->language->get('type_cat');
		$this->data['type_mand'] = $this->language->get('type_mand');
		$this->data['type_infol'] = $this->language->get('type_infol');
		$this->data['type_products'] = $this->language->get('type_products');
		$this->data['type_catprods'] = $this->language->get('type_catprods');
		$this->data['type_infod'] = $this->language->get('type_infod');
		$this->data['entry_iset'] = $this->language->get('entry_iset');
		$this->data['type_custom'] = $this->language->get('type_custom');
		$this->data['type_more'] = $this->language->get('type_more');
		$this->data['type_more2'] = $this->language->get('type_more2');
		$this->data['type_login'] = $this->language->get('type_login');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_count'] = $this->language->get('entry_count');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_add_item'] = $this->language->get('button_add_item');
		$this->data['button_remove'] = $this->language->get('button_remove');
		$this->data['more_name'] = $this->language->get('more_name');
		$this->data['more2_name'] = $this->language->get('more2_name');
		$this->data['more_status'] = $this->language->get('more_status');
		$this->data['entry_image_size'] = $this->language->get('entry_image_size');
		$this->data['entry_show_description'] = $this->language->get('entry_show_description');
		$this->data['text_general'] = $this->language->get('text_general');
		$this->data['text_more_dropdown'] = $this->language->get('text_more_dropdown');
		$this->data['text_more2_dropdown'] = $this->language->get('text_more2_dropdown');
		$this->data['text_languagerelated'] = $this->language->get('text_languagerelated');
		$this->data['text_customization'] = $this->language->get('text_customization');
		$this->data['text_settings_isresponsive'] = $this->language->get('text_settings_isresponsive');
		$this->data['text_settings_dropdowntitle'] = $this->language->get('text_settings_dropdowntitle');
		$this->data['text_settings_topitemlink'] = $this->language->get('text_settings_topitemlink');
		$this->data['text_settings_flyoutwidth'] = $this->language->get('text_settings_flyoutwidth');
		$this->data['text_settings_bspacewidth'] = $this->language->get('text_settings_bspacewidth');
		$this->data['text_settings_mobilemenuname'] = $this->language->get('text_settings_mobilemenuname');
		$this->data['text_settings_infodname'] = $this->language->get('text_settings_infodname');
		$this->data['text_settings_brandsdname'] = $this->language->get('text_settings_brandsdname');
		$this->data['text_settings_latestpname'] = $this->language->get('text_settings_latestpname');
		$this->data['text_settings_specialpname'] = $this->language->get('text_settings_specialpname');
		$this->data['text_settings_featuredpname'] = $this->language->get('text_settings_featuredpname');
		$this->data['text_settings_bestpname'] = $this->language->get('text_settings_bestpname');
		$this->data['text_subcatdisplay'] = $this->language->get('text_subcatdisplay');
		$this->data['text_subcatdisplay_all'] = $this->language->get('text_subcatdisplay_all');
		$this->data['text_subcatdisplay_level1'] = $this->language->get('text_subcatdisplay_level1');
		$this->data['text_subcatdisplay_none'] = $this->language->get('text_subcatdisplay_none');
		$this->data['text_3dlevellimit'] = $this->language->get('text_3dlevellimit');
		$this->data['text_settings_viewallname'] = $this->language->get('text_settings_viewallname');
		$this->data['text_settings_viewmorename'] = $this->language->get('text_settings_viewmorename');
		$this->data['text_settings_dropeffect'] = $this->language->get('text_settings_dropeffect');
		$this->data['text_settings_hoverintent'] = $this->language->get('text_settings_hoverintent');
		$this->data['text_settings_tophomelink'] = $this->language->get('text_settings_tophomelink');
		$this->data['text_settings_menuskin'] = $this->language->get('text_settings_menuskin');
		$this->data['text_dflist'] = $this->language->get('text_dflist');
		$this->data['text_dfgrid'] = $this->language->get('text_dfgrid');
		$this->data['text_settings_supercache'] = $this->language->get('text_settings_supercache');
		
		
		$this->data['token'] = $this->session->data['token'];
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		
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
			'href'      => $this->url->link('module/supermenu', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

		if ($this->data['store']) {
		  $this->data['action'] = $this->url->link('module/supermenu', 'token=' . $this->session->data['token'] . '&store=' . $this->data['store'], 'SSL');
		} else {
		  $this->data['action'] = $this->url->link('module/supermenu', 'token=' . $this->session->data['token'], 'SSL');
		}
		
		$this->data['module_url'] = $this->url->link('module/supermenu', 'token=' . $this->session->data['token'], 'SSL');
		
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		$this->data['modules'] = array();
		$this->data['items'] = array();
		$this->data['categories'] = array();
		$this->data['informations'] = array();
		$this->data['languages'] = $this->model_localisation_language->getLanguages();
		
		
		$categ = $this->model_catalog_category->getCategories(0);

		foreach ($categ as $cate) {
							
			$this->data['categories'][] = array(
				'category_id' => $cate['category_id'],
				'name'        => $cate['name']
			);
		}
		
		$infos = $this->model_catalog_information->getInformations();
		
		foreach ($infos as $info) {
							
			$this->data['informations'][] = array(
				'information_id' => $info['information_id'],
				'name'           => $info['title']
			);
		}
		
		if (isset($this->request->post['supermenu_module'])) {
			$this->data['modules'] = $this->request->post['supermenu_module'];
		} elseif ($this->getSetting('supermenu_module')) { 
			$this->data['modules'] = $this->getSetting('supermenu_module');
		}	
		if (isset($this->request->post['supermenu_item'])) {
			$this->data['items'] = $this->request->post['supermenu_item'];
		} elseif ($this->getSetting('supermenu_item')) { 
			$this->data['items'] = $this->getSetting('supermenu_item');
		}
		if (isset($this->request->post['supermenu_settings'])) {
			$this->data['settings'] = $this->request->post['supermenu_settings'];
		} elseif ($this->getSetting('supermenu_settings')) { 
			$this->data['settings'] = $this->getSetting('supermenu_settings');
		}
		if (isset($this->request->post['supermenu_settings_status'])) {
			$this->data['supermenu_settings_status'] = $this->request->post['supermenu_settings_status'];
		} elseif ($this->getSetting('supermenu_settings_status')) { 
			$this->data['supermenu_settings_status'] = $this->getSetting('supermenu_settings_status');
		} else {
		    $this->data['supermenu_settings_status'] = '';
		}
		if (isset($this->request->post['supermenu_supermenuisresponsive'])) {
			$this->data['supermenu_supermenuisresponsive'] = $this->request->post['supermenu_supermenuisresponsive'];
		} elseif ($this->getSetting('supermenu_supermenuisresponsive')) { 
			$this->data['supermenu_supermenuisresponsive'] = $this->getSetting('supermenu_supermenuisresponsive');
		} else {
		    $this->data['supermenu_supermenuisresponsive'] = 0;
		}
		if (isset($this->request->post['supermenu_more'])) {
			$this->data['supermenu_more'] = $this->request->post['supermenu_more'];
		} elseif ($this->getSetting('supermenu_more')) {
			$this->data['supermenu_more'] = $this->getSetting('supermenu_more');
		} else {
			$this->data['supermenu_more'] = array();
		}
		if (isset($this->request->post['supermenu_more2'])) {
			$this->data['supermenu_more2'] = $this->request->post['supermenu_more2'];
		} elseif ($this->getSetting('supermenu_more2')) {
			$this->data['supermenu_more2'] = $this->getSetting('supermenu_more2');
		} else {
			$this->data['supermenu_more2'] = array();
		}
		
		if (isset($this->request->post['supermenu_more_view'])) {
			$this->data['supermenu_more_view'] = $this->request->post['supermenu_more_view'];
		} elseif ($this->getSetting('supermenu_more_view')) {
			$this->data['supermenu_more_view'] = $this->getSetting('supermenu_more_view');
		} else {
			$this->data['supermenu_more_view'] = '';
		}
		
		if (isset($this->request->post['supermenu_more_title'])) {
			$this->data['supermenu_more_title'] = $this->request->post['supermenu_more_title'];
		} else {
			$this->data['supermenu_more_title'] = $this->getSetting('supermenu_more_title');
		}
		if (isset($this->request->post['supermenu_more2_title'])) {
			$this->data['supermenu_more2_title'] = $this->request->post['supermenu_more2_title'];
		} else {
			$this->data['supermenu_more2_title'] = $this->getSetting('supermenu_more2_title');
		}
		
		if (isset($this->request->post['supermenu_more_status'])) {
			$this->data['supermenu_more_status'] = $this->request->post['supermenu_more_status'];
		} elseif ($this->getSetting('supermenu_more_status')) {
			$this->data['supermenu_more_status'] = $this->getSetting('supermenu_more_status');
		} else {
		    $this->data['supermenu_more_status'] = '';
		}
		if (isset($this->request->post['supermenu_image_width'])) {
			$this->data['supermenu_image_width'] = $this->request->post['supermenu_image_width'];
		} elseif ($this->getSetting('supermenu_image_width')) {
			$this->data['supermenu_image_width'] = $this->getSetting('supermenu_image_width');
		} else {
			$this->data['supermenu_image_width'] = 120;
		}
		if (isset($this->request->post['supermenu_image_height'])) {
			$this->data['supermenu_image_height'] = $this->request->post['supermenu_image_height'];
		} elseif ($this->getSetting('supermenu_image_height')) {
			$this->data['supermenu_image_height'] = $this->getSetting('supermenu_image_height');
		} else {
			$this->data['supermenu_image_height'] = 120;
		}
		if (isset($this->request->post['supermenu_show_description'])) {
			$this->data['supermenu_show_description'] = $this->request->post['supermenu_show_description'];
		} elseif ($this->getSetting('supermenu_show_description')) {
			$this->data['supermenu_show_description'] = $this->getSetting('supermenu_show_description');
		} else {
			$this->data['supermenu_show_description'] = 'no';
		}
		if (isset($this->request->post['supermenu_dropdowntitle'])) {
			$this->data['supermenu_dropdowntitle'] = $this->request->post['supermenu_dropdowntitle'];
		} elseif ($this->getSetting('supermenu_dropdowntitle')) { 
			$this->data['supermenu_dropdowntitle'] = $this->getSetting('supermenu_dropdowntitle');
		} else {
		    $this->data['supermenu_dropdowntitle'] = 0;
		}
		if (isset($this->request->post['supermenu_topitemlink'])) {
			$this->data['supermenu_topitemlink'] = $this->request->post['supermenu_topitemlink'];
		} elseif ($this->getSetting('supermenu_topitemlink')) { 
			$this->data['supermenu_topitemlink'] = $this->getSetting('supermenu_topitemlink');
		} else {
		    $this->data['supermenu_topitemlink'] = 'bottom';
		}
		if (isset($this->request->post['supermenu_skin'])) {
			$this->data['supermenu_skin'] = $this->request->post['supermenu_skin'];
		} elseif ($this->getSetting('supermenu_skin')) { 
			$this->data['supermenu_skin'] = $this->getSetting('supermenu_skin');
		} else {
		    $this->data['supermenu_skin'] = 'default';
		}
		if (isset($this->request->post['supermenu_flyout_width'])) {
			$this->data['supermenu_flyout_width'] = $this->request->post['supermenu_flyout_width'];
		} elseif ($this->getSetting('supermenu_flyout_width')) {
			$this->data['supermenu_flyout_width'] = $this->getSetting('supermenu_flyout_width');
		} else {
			$this->data['supermenu_flyout_width'] = '';
		}
		if (isset($this->request->post['supermenu_mobilemenuname'])) {
			$this->data['supermenu_mobilemenuname'] = $this->request->post['supermenu_mobilemenuname'];
		} elseif ($this->getSetting('supermenu_mobilemenuname')) {
			$this->data['supermenu_mobilemenuname'] = $this->getSetting('supermenu_mobilemenuname');
		} else {
		    $this->data['supermenu_mobilemenuname'] = array();
		}
		if (isset($this->request->post['supermenu_infodname'])) {
			$this->data['supermenu_infodname'] = $this->request->post['supermenu_infodname'];
		} elseif ($this->getSetting('supermenu_infodname')) {
			$this->data['supermenu_infodname'] = $this->getSetting('supermenu_infodname');
		} else {
		    $this->data['supermenu_infodname'] = array();
		}
		if (isset($this->request->post['supermenu_brandsdname'])) {
			$this->data['supermenu_brandsdname'] = $this->request->post['supermenu_brandsdname'];
		} elseif ($this->getSetting('supermenu_brandsdname')) {
			$this->data['supermenu_brandsdname'] = $this->getSetting('supermenu_brandsdname');
		} else {
		    $this->data['supermenu_brandsdname'] = array();
		}
		if (isset($this->request->post['supermenu_latestpname'])) {
			$this->data['supermenu_latestpname'] = $this->request->post['supermenu_latestpname'];
		} elseif ($this->getSetting('supermenu_latestpname')) {
			$this->data['supermenu_latestpname'] = $this->getSetting('supermenu_latestpname');
		} else {
		    $this->data['supermenu_latestpname'] = array();
		}
		if (isset($this->request->post['supermenu_specialpname'])) {
			$this->data['supermenu_specialpname'] = $this->request->post['supermenu_specialpname'];
		} elseif ($this->getSetting('supermenu_specialpname')) {
			$this->data['supermenu_specialpname'] = $this->getSetting('supermenu_specialpname');
		} else {
		    $this->data['supermenu_specialpname'] = array();
		}
		if (isset($this->request->post['supermenu_featuredpname'])) {
			$this->data['supermenu_featuredpname'] = $this->request->post['supermenu_featuredpname'];
		} elseif ($this->getSetting('supermenu_featuredpname')) {
			$this->data['supermenu_featuredpname'] = $this->getSetting('supermenu_featuredpname');
		} else {
		    $this->data['supermenu_featuredpname'] = array();
		}
		if (isset($this->request->post['supermenu_bestpname'])) {
			$this->data['supermenu_bestpname'] = $this->request->post['supermenu_bestpname'];
		} elseif ($this->getSetting('supermenu_bestpname')) {
			$this->data['supermenu_bestpname'] = $this->getSetting('supermenu_bestpname');
		} else {
		    $this->data['supermenu_bestpname'] = array();
		}
		if (isset($this->request->post['supermenu_3dlevellimit'])) {
			$this->data['supermenu_3dlevellimit'] = $this->request->post['supermenu_3dlevellimit'];
		} elseif ($this->getSetting('supermenu_3dlevellimit')) {
			$this->data['supermenu_3dlevellimit'] = $this->getSetting('supermenu_3dlevellimit');
		} else {
			$this->data['supermenu_3dlevellimit'] = '';
		}
		if (isset($this->request->post['supermenu_viewallname'])) {
			$this->data['supermenu_viewallname'] = $this->request->post['supermenu_viewallname'];
		} elseif ($this->getSetting('supermenu_viewallname')) {
			$this->data['supermenu_viewallname'] = $this->getSetting('supermenu_viewallname');
		} else {
		    $this->data['supermenu_viewallname'] = array();
		}
		if (isset($this->request->post['supermenu_viewmorename'])) {
			$this->data['supermenu_viewmorename'] = $this->request->post['supermenu_viewmorename'];
		} elseif ($this->getSetting('supermenu_viewmorename')) {
			$this->data['supermenu_viewmorename'] = $this->getSetting('supermenu_viewmorename');
		} else {
		    $this->data['supermenu_viewmorename'] = array();
		}
		if (isset($this->request->post['supermenu_dropdowneffect'])) {
			$this->data['supermenu_dropdowneffect'] = $this->request->post['supermenu_dropdowneffect'];
		} elseif ($this->getSetting('supermenu_dropdowneffect')) {
			$this->data['supermenu_dropdowneffect'] = $this->getSetting('supermenu_dropdowneffect');
		} else {
		    $this->data['supermenu_dropdowneffect'] = 'drop';
		}
		if (isset($this->request->post['supermenu_usehoverintent'])) {
			$this->data['supermenu_usehoverintent'] = $this->request->post['supermenu_usehoverintent'];
		} elseif ($this->getSetting('supermenu_usehoverintent')) {
			$this->data['supermenu_usehoverintent'] = $this->getSetting('supermenu_usehoverintent');
		} else {
			$this->data['supermenu_usehoverintent'] = '';
		}
		if (isset($this->request->post['supermenu_tophomelink'])) {
			$this->data['supermenu_tophomelink'] = $this->request->post['supermenu_tophomelink'];
		} elseif ($this->getSetting('supermenu_tophomelink')) { 
			$this->data['supermenu_tophomelink'] = $this->getSetting('supermenu_tophomelink');
		} else {
		    $this->data['supermenu_tophomelink'] = 'none';
		}
		if (isset($this->request->post['supermenu_htmlarea1'])) {
			$this->data['supermenu_htmlarea1'] = $this->request->post['supermenu_htmlarea1'];
		} elseif ($this->getSetting('supermenu_htmlarea1')) {
			$this->data['supermenu_htmlarea1'] = $this->getSetting('supermenu_htmlarea1');
		} else {
		    $this->data['supermenu_htmlarea1'] = array();
		}
		if (isset($this->request->post['supermenu_htmlarea2'])) {
			$this->data['supermenu_htmlarea2'] = $this->request->post['supermenu_htmlarea2'];
		} elseif ($this->getSetting('supermenu_htmlarea2')) {
			$this->data['supermenu_htmlarea2'] = $this->getSetting('supermenu_htmlarea2');
		} else {
		    $this->data['supermenu_htmlarea2'] = array();
		}
		if (isset($this->request->post['supermenu_htmlarea3'])) {
			$this->data['supermenu_htmlarea3'] = $this->request->post['supermenu_htmlarea3'];
		} elseif ($this->getSetting('supermenu_htmlarea3')) {
			$this->data['supermenu_htmlarea3'] = $this->getSetting('supermenu_htmlarea3');
		} else {
		    $this->data['supermenu_htmlarea3'] = array();
		}
		if (isset($this->request->post['supermenu_htmlarea4'])) {
			$this->data['supermenu_htmlarea4'] = $this->request->post['supermenu_htmlarea4'];
		} elseif ($this->getSetting('supermenu_htmlarea4')) {
			$this->data['supermenu_htmlarea4'] = $this->getSetting('supermenu_htmlarea4');
		} else {
		    $this->data['supermenu_htmlarea4'] = array();
		}
		if (isset($this->request->post['supermenu_htmlarea5'])) {
			$this->data['supermenu_htmlarea5'] = $this->request->post['supermenu_htmlarea5'];
		} elseif ($this->getSetting('supermenu_htmlarea5')) {
			$this->data['supermenu_htmlarea5'] = $this->getSetting('supermenu_htmlarea5');
		} else {
		    $this->data['supermenu_htmlarea5'] = array();
		}
		if (isset($this->request->post['supermenu_htmlarea6'])) {
			$this->data['supermenu_htmlarea6'] = $this->request->post['supermenu_htmlarea6'];
		} elseif ($this->getSetting('supermenu_htmlarea6')) {
			$this->data['supermenu_htmlarea6'] = $this->getSetting('supermenu_htmlarea6');
		} else {
		    $this->data['supermenu_htmlarea6'] = array();
		}
		if (isset($this->request->post['supermenu_htmlarea7'])) {
			$this->data['supermenu_htmlarea7'] = $this->request->post['supermenu_htmlarea7'];
		} elseif ($this->getSetting('supermenu_htmlarea7')) {
			$this->data['supermenu_htmlarea7'] = $this->getSetting('supermenu_htmlarea7');
		} else {
		    $this->data['supermenu_htmlarea7'] = array();
		}
		if (isset($this->request->post['supermenu_htmlarea8'])) {
			$this->data['supermenu_htmlarea8'] = $this->request->post['supermenu_htmlarea8'];
		} elseif ($this->getSetting('supermenu_htmlarea8')) {
			$this->data['supermenu_htmlarea8'] = $this->getSetting('supermenu_htmlarea8');
		} else {
		    $this->data['supermenu_htmlarea8'] = array();
		}
		if (isset($this->request->post['supermenu_bannerspace_width'])) {
			$this->data['supermenu_bannerspace_width'] = $this->request->post['supermenu_bannerspace_width'];
		} elseif ($this->getSetting('supermenu_bannerspace_width')) {
			$this->data['supermenu_bannerspace_width'] = $this->getSetting('supermenu_bannerspace_width');
		} else {
			$this->data['supermenu_bannerspace_width'] = '';
		}
		if (isset($this->request->post['supermenu_cache'])) {
			$this->data['supermenu_cache'] = $this->request->post['supermenu_cache'];
		} elseif ($this->getSetting('supermenu_cache')) { 
			$this->data['supermenu_cache'] = $this->getSetting('supermenu_cache');
		} else {
		    $this->data['supermenu_cache'] = 0;
		}
				
		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->template = 'module/supermenu.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/supermenu')) {
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
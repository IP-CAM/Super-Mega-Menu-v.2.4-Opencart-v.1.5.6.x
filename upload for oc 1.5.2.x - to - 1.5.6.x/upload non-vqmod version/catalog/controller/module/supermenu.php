<?php  
class ControllerModulesupermenu extends Controller {
	protected function index($setting) {
	
		$this->load->model('catalog/category');
	
		$this->load->model('tool/image'); 
		
		$this->load->model('catalog/information');
		
		$this->load->model('catalog/manufacturer');
		
		$this->load->model('catalog/product');
		
		$this->language->load('common/footer');
      
	    $this->language->load('module/category');
		
		$this->data['skin'] = $this->config->get('supermenu_skin');
		$this->data['categ_text'] = $this->language->get('heading_title');
		$this->data['brands_text'] = $this->language->get('text_manufacturer');
		$this->data['viewalltext'] = "View All";
		$this->data['direction'] = $this->language->get('direction');
		$viewmorecategoriestext = 'view more';
		$vmname = $this->config->get('supermenu_viewmorename');
		if ($vmname[$this->config->get('config_language_id')]) {
			$viewmorecategoriestext = $vmname[$this->config->get('config_language_id')];	
		}
		
		$vaname = $this->config->get('supermenu_viewallname');
		if ($vaname[$this->config->get('config_language_id')]) {
			$this->data['viewalltext'] = $vaname[$this->config->get('config_language_id')];
		}
		$baname = $this->config->get('supermenu_brandsdname');
		if ($baname[$this->config->get('config_language_id')]) {
			$this->data['brands_text'] = $baname[$this->config->get('config_language_id')];	
			$newbranddname = $baname[$this->config->get('config_language_id')];
		} else {
		    $newbranddname = false;
		}
		$caname = $this->config->get('supermenu_mobilemenuname');
		if ($caname[$this->config->get('config_language_id')]) {
			$this->data['categ_text'] = $caname[$this->config->get('config_language_id')];
		}
		$infodrname = $this->config->get('supermenu_infodname');
		$infodrnamenew = ($infodrname[$this->config->get('config_language_id')] ? $infodrname[$this->config->get('config_language_id')] : false);
		$subcatslimit = ($this->config->get('supermenu_3dlevellimit') ? $this->config->get('supermenu_3dlevellimit') : false);
		$this->data['tophomelink'] = ($this->config->get('supermenu_tophomelink') ? $this->config->get('supermenu_tophomelink') : 'none');
		$this->data['linkoftopitem'] = ($this->config->get('supermenu_topitemlink') ? $this->config->get('supermenu_topitemlink') : 'topitem');
		$this->data['dropdowntitle'] = ($this->config->get('supermenu_dropdowntitle') ? true : false);
		$this->data['dropdowneffect'] = ($this->config->get('supermenu_dropdowneffect') ? $this->config->get('supermenu_dropdowneffect') : 'fade');
		$this->data['usehoverintent'] = ($this->config->get('supermenu_usehoverintent') ? false : true);
		$this->data['flyout_width'] = $this->config->get('supermenu_flyout_width');
		$this->data['bspace_width'] = $this->config->get('supermenu_bannerspace_width');
		
		$this->language->load('account/login');
        $this->language->load('module/account');
		
	    $this->data['mitems'] = array();
		$mitems = array();
		
		$items = $this->config->get('supermenu_item');
		
		if ($items) {
		 foreach ($items as $iorder) {
			if (isset($iorder['sorder'])) {
                if(is_numeric($iorder['sorder'])) { $itemsorder[] = $iorder['sorder']; } else { $itemsorder[] = 99; }
			} else {
				$itemsorder[] = 99;
			}
         }
		 array_multisort($itemsorder,SORT_NUMERIC,$items);
		}
		
		$this->data['supermenuisresponsive'] = ($this->config->get('supermenu_supermenuisresponsive') ? true : false);
		
		$supercache = $this->config->get('supermenu_cache') ? true : false;
		
		$c_items = false;
		
		if ($items) { /*check for items*/
		
		$increaseid = 0;
			if ($supercache) {
                $c_items = $this->cache->get('supermenu.items.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id'));
            } else {
                $c_items= false;
            }
            
         
         if (!$c_items) { /* check for cache */
		
		 foreach ($items as $item) { /* loop trough items */
			 
		 //$stores = isset($item['stores']) ? $item['stores'] : array();
		 if (true) {  /* check if item is activated for active store */
		  
		  $increaseid++;
		 
		  $item_name = '';
		 
		  if ($item['type'] == 'cat') {
		 
           $katid = $item['category_id']; 
		   
		   $cssid = 'supcat' . $item['category_id'];
		 
           $kat_info = $this->model_catalog_category->getCategory($katid);	
		   
		    if ($kat_info) {
			
		     $item_name = $kat_info['name'];
			 
			 if (isset($item['customname'][$this->config->get('config_language_id')])) { 
				if (strlen($item['customname'][$this->config->get('config_language_id')]) > 2) {
					$item_name = $item['customname'][$this->config->get('config_language_id')];
				}
			 }
			 $item_view = $item['view'];
			 
			 $item_id = $kat_info['category_id'];
			 
			 $item_url = $this->url->link('product/category', 'path=' . $item_id);
			 
			 $firstkids_data = array();
			 
			 if($item['subcatdisplay'] != 'none') {
			
			 $firstkids = $this->model_catalog_category->getCategories($item_id);
			 
			 foreach ($firstkids as $firstkid) {
			 
			  $secondkids_data = array();
			  
			  if ($firstkid['image']) {
				$image = $this->model_tool_image->resize($firstkid['image'], $this->config->get('supermenu_image_width'), $this->config->get('supermenu_image_height'));
			  } else {
				$image = $this->model_tool_image->resize('no_image.jpg', $this->config->get('supermenu_image_width'), $this->config->get('supermenu_image_height'));
			  }
			if ($item['subcatdisplay'] != 'none' && $item['subcatdisplay'] != 'level1') {
			  $secondkids = $this->model_catalog_category->getCategories($firstkid['category_id']);
			  
			  $countingsubcats = 0;
			  
			  foreach ($secondkids as $secondkid) {
				$countingsubcats++;
				if ($secondkid['image']) {
					$secondimage = $this->model_tool_image->resize($secondkid['image'], $this->config->get('supermenu_image_width'), $this->config->get('supermenu_image_height'));
				} else {
					$secondimage = $this->model_tool_image->resize('no_image.jpg', $this->config->get('supermenu_image_width'), $this->config->get('supermenu_image_height'));
				}
				if (!$subcatslimit) {
					$secondkids_data[] = array(
						'category_id' => $secondkid['category_id'],
						'cssid'       => "supcat" . $secondkid['category_id'],
						'name'        => $secondkid['name'],
						'thumb'	      => $secondimage,
						'href'        => $this->url->link('product/category', 'path=' . $item_id . '_' . $firstkid['category_id'] . '_' . $secondkid['category_id'])	
					);	
				} else {
					if ($countingsubcats <= $subcatslimit) {
						$secondkids_data[] = array(
							'category_id' => $secondkid['category_id'],
							'cssid'       => "supcat" . $secondkid['category_id'],
							'name'        => $secondkid['name'],
							'thumb'	      => $secondimage,
							'href'        => $this->url->link('product/category', 'path=' . $item_id . '_' . $firstkid['category_id'] . '_' . $secondkid['category_id'])	
						);	
					}
				}	
			  } 
				if ($subcatslimit && $item_view != 'f0' && $item_view != 'f1') {
				 if ($subcatslimit < $countingsubcats) {
				    $secondkids_data[] = array(
						'category_id' => '',
						'cssid'       => "supcat-more-button",
						'name'        => $viewmorecategoriestext,
						'thumb'	      => '',
						'href'        => $this->url->link('product/category', 'path=' . $item_id . '_' . $firstkid['category_id'])	
					);	
				 }
				}
			}
			   
			  $firstkids_data[] = array(
						'category_id' => $firstkid['category_id'],
						'cssid'       => "supcat" . $firstkid['category_id'],
						'name'        => $firstkid['name'],
						'thumb'       => $image,
						'gchildren'   => $secondkids_data,
						'href'        => $this->url->link('product/category', 'path=' . $item_id . '_' . $firstkid['category_id'])	
					);						
			 }
			 }
			 
			 if ($kat_info['image']) {
				$item_image = $this->model_tool_image->resize($kat_info['image'], 100, 100);
			 } else {
				$item_image = $this->model_tool_image->resize('no_image.jpg', 100, 100);
			 }
		   
		   
		    }
		
		  } elseif ($item['type'] == 'more' || $item['type'] == 'more2') {
		     
			 if ($item['type'] == 'more2') {
				$itm = $this->config->get('supermenu_more2_title');
			 
				$item_name = $itm[$this->config->get('config_language_id')];
			 } else {
				$itm = $this->config->get('supermenu_more_title');
			 
				$item_name = $itm[$this->config->get('config_language_id')];
			 }
			 
			 $cssid = 'notcat' . $increaseid;
			 $item_view = $item['view'];
			 
			 $item_id = '';
			 
			 $item_url = '';
			 
			 $firstkids_data = array();
			 $order = array();
			 
			if ($item['type'] == 'more2') {
			 $firstkids =  $this->config->get('supermenu_more2');
			} else {
			 $firstkids =  $this->config->get('supermenu_more');
			}
			 if ($subcatslimit && $item_view != 'f0' && $item_view != 'f1') { $scatslimit = $subcatslimit; } else { $scatslimit = false; }
			 
			foreach ($firstkids as $kid) {
			 
			 $firstkid = $this->model_catalog_category->getCategory($kid);
			 if($firstkid) {
			  $secondkids_data = array();
			
			  if ($firstkid['image']) {
				$image = $this->model_tool_image->resize($firstkid['image'], $this->config->get('supermenu_image_width'), $this->config->get('supermenu_image_height'));
              } else {
				$image = $this->model_tool_image->resize('no_image.jpg', $this->config->get('supermenu_image_width'), $this->config->get('supermenu_image_height'));
			  }
			  if($item['subcatdisplay'] != 'none') {
			  $secondkids = $this->model_catalog_category->getCategories($firstkid['category_id']);
			  $countingsubcatsk = 0;
			  foreach ($secondkids as $secondkid) {
			   $countingsubcatsk++;
			    $thirdkids_data = array();
			   if ($item['subcatdisplay'] != 'none' && $item['subcatdisplay'] != 'level1') {
			    $thirdkids = $this->model_catalog_category->getCategories($secondkid['category_id']);
				 $countingsubcats2 = 0;
				foreach ($thirdkids as $thirdkid) {
				 $countingsubcats2++;
					if (!$subcatslimit) {
						$thirdkids_data[] = array(
							'category_id' => $thirdkid['category_id'],
							'cssid'       => "morecatc" . $thirdkid['category_id'],
							'name'        => $thirdkid['name'],
							'href'        => $this->url->link('product/category', 'path=' . $firstkid['category_id'] . '_' . $secondkid['category_id'] . '_' . $thirdkid['category_id'])	
						);
					} else {
						if ($countingsubcats2 <= $subcatslimit) {
							$thirdkids_data[] = array(
								'category_id' => $thirdkid['category_id'],
								'cssid'       => "morecatc" . $thirdkid['category_id'],
								'name'        => $thirdkid['name'],
								'href'        => $this->url->link('product/category', 'path=' . $firstkid['category_id'] . '_' . $secondkid['category_id'] . '_' . $thirdkid['category_id'])	
							);
						}
					}
				}
				if ($subcatslimit) {
				 if ($subcatslimit < $countingsubcats2) {	
					$thirdkids_data[] = array(
								'category_id' => '',
								'cssid'       => "supcat-more-button",
								'name'        => $viewmorecategoriestext,
								'href'        => $this->url->link('product/category', 'path=' . $firstkid['category_id'] . '_' . $secondkid['category_id'])	
					);
				 }
				}
					
			   }
			   if ($secondkid['image']) {
				$secondimage = $this->model_tool_image->resize($secondkid['image'], $this->config->get('supermenu_image_width'), $this->config->get('supermenu_image_height'));
               } else {
				$secondimage = $this->model_tool_image->resize('no_image.jpg', $this->config->get('supermenu_image_width'), $this->config->get('supermenu_image_height'));
			   }
			   if (!$scatslimit) {
			    $secondkids_data[] = array(
						'category_id' => $secondkid['category_id'],
						'cssid'       => "morecat" . $secondkid['category_id'],
						'name'        => $secondkid['name'],
						'thumb'       => $secondimage,
						'ggchildren'  => $thirdkids_data,
						'href'        => $this->url->link('product/category', 'path=' . $firstkid['category_id'] . '_' . $secondkid['category_id'])	
					);	
			   } else {
			    if ($countingsubcatsk <= $scatslimit) {
			     $secondkids_data[] = array(
						'category_id' => $secondkid['category_id'],
						'cssid'       => "morecat" . $secondkid['category_id'],
						'name'        => $secondkid['name'],
						'thumb'       => $secondimage,
						'ggchildren'  => $thirdkids_data,
						'href'        => $this->url->link('product/category', 'path=' . $firstkid['category_id'] . '_' . $secondkid['category_id'])	
					);	
			    }
			   }
			  
			  }
			  
				if ($scatslimit) {
				 if ($scatslimit < $countingsubcatsk) {	
			     $secondkids_data[] = array(
						'category_id' => '',
						'cssid'       => "supcat-more-button",
						'name'        => $viewmorecategoriestext,
						'thumb'       => '',
						'ggchildren'  => '',
						'href'        => $this->url->link('product/category', 'path=' . $firstkid['category_id'])	
					);	
				 }
				}
			  }
			   
			  $firstkids_data[] = array(
						'category_id' => $firstkid['category_id'],
						'cssid'       => "morecat" . $firstkid['category_id'],
						'name'        => $firstkid['name'],
						'thumb'       => $image,
						'order'       => $firstkid['sort_order'],
						'gchildren'   => $secondkids_data,
						'href'        => $this->url->link('product/category', 'path=' . $firstkid['category_id'])	
					);						
			 }
			}
			 foreach ($firstkids_data as $itemsmore) {
                $order[] = $itemsmore['order'];
             }


			 array_multisort($order,SORT_NUMERIC,$firstkids_data);
			 $item_image = false;
		   
		
		  } elseif ($item['type'] == 'infol') {
		  
		   $info_id = $item['information_id']; 
		   
		   $cssid = 'notcat' . $increaseid;
		   
		   $item_view = '';
		 
           $info_info = $this->model_catalog_information->getInformation($info_id);
		   
		   if ($info_info) {
		    
			 $item_name = $info_info['title'];
			 
			 $item_id = $info_info['information_id'];
			 
			 $item_url = $this->url->link('information/information', 'information_id=' . $item_id);
			 
			 $firstkids_data = array();
			 
			 $item_image = false;
			
		   }
			
			
		  } elseif ($item['type'] == 'infod') {
			if ($infodrnamenew) {
		     $item_name = $infodrnamenew;
			} else {
		     $item_name = $this->language->get('text_information');
			}
			 $item_view = '';
			 
			 $cssid = 'notcat' . $increaseid;
			 
			 $item_id = '';
			 
			 $item_url = '';
			 
			 $firstkids_data = array();
			 
			 foreach ($this->model_catalog_information->getInformations() as $infolinks) {
			 
				$firstkids_data[] = array(
						'category_id' => false,
						'cssid'       => "supinfo" . $infolinks['information_id'],
						'name'        => $infolinks['title'],
						'gchildren'   => false,
						'href'        => $this->url->link('information/information', 'information_id=' . $infolinks['information_id'])
					);
					
    	     }
			 
			 $item_image = false;
		
		  } elseif ($item['type'] == 'mand') {
		    if ($newbranddname) {
		     $item_name = $newbranddname;
			} else {
		     $item_name = $this->language->get('text_manufacturer');
			}
			 $item_view = $item['view'];
			 
			 $cssid = 'notcat' . $increaseid;
			 
			 $item_id = '';
			 
			 $item_url = '';
			 
			 $firstkids_data = array();
			 
			 foreach ($this->model_catalog_manufacturer->getManufacturers() as $brandlinks) {
			 
			     if ($brandlinks['image']) {
				  $image = $this->model_tool_image->resize($brandlinks['image'],  $this->config->get('supermenu_image_width'), $this->config->get('supermenu_image_height'));
                 } else {
			 	  $image = $this->model_tool_image->resize('no_image.jpg',  $this->config->get('supermenu_image_width'), $this->config->get('supermenu_image_height'));
			     }
			    if (VERSION == '1.5.2' || VERSION == '1.5.2.1' || VERSION == '1.5.3' || VERSION == '1.5.3.1') {
				$firstkids_data[] = array(
						'category_id' => false,
						'name'        => $brandlinks['name'],
						'cssid'       => "supbrand" . $brandlinks['manufacturer_id'],
						'thumb'       => $image,
						'gchildren'   => false,
						'href'        => $this->url->link('product/manufacturer/product', 'manufacturer_id=' . $brandlinks['manufacturer_id'])
					);
				} else {
                    $firstkids_data[] = array(
						'category_id' => false,
						'name'        => $brandlinks['name'],
						'cssid'       => "supbrand" . $brandlinks['manufacturer_id'],
						'thumb'       => $image,
						'gchildren'   => false,
						'href'        => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $brandlinks['manufacturer_id'])
					);
                }				
    	     }
			 
			 $item_image = false;
			 
			 $item_description = false;
		
		  } elseif ($item['type'] == 'products') {
		  
			 $item_view = $item['view'];
			 
			 $item_id = '';
			 
			 $cssid = 'notcat' . $increaseid;
			 
			 $item_url = '';
			 
			 $firstkids_data = array();
			
			if ($item['products'] == 'special') {
			
			 $item_name = 'Special Offers';
			 $itm = $this->config->get('supermenu_specialpname');
			 if ($itm[$this->config->get('config_language_id')]) {
			  $item_name = $itm[$this->config->get('config_language_id')];
			 }
			 $data = array(
				'sort'  => 'pd.name',
				'order' => 'ASC',
				'start' => 0,
				'limit' => $item['productlimit']
		     );
			 $productresults = $this->model_catalog_product->getProductSpecials($data);
			
			} elseif ($item['products'] == 'featured') {
			
			 $item_name = 'Featured Products';
			 $itm = $this->config->get('supermenu_featuredpname');
			 if ($itm[$this->config->get('config_language_id')]) {
			  $item_name = $itm[$this->config->get('config_language_id')];
			 }
			 if ($this->config->get('featured_product')){
			 $productresults = explode(',', $this->config->get('featured_product'));		
		     $productresults = array_slice($productresults, 0, (int)$item['productlimit']);
			 } else {
			 $productresults = array();
			 }
			} elseif ($item['products'] == 'bestseller') {
			
			 $item_name = 'BestSellers';
			 $itm = $this->config->get('supermenu_bestpname');
			 if ($itm[$this->config->get('config_language_id')]) {
			  $item_name = $itm[$this->config->get('config_language_id')];
			 }
			 $productresults = $this->model_catalog_product->getBestSellerProducts($item['productlimit']);
			} else {
			
			 $item_name = 'Latest Products';
			 $itm = $this->config->get('supermenu_latestpname');
			 if ($itm[$this->config->get('config_language_id')]) {
			  $item_name = $itm[$this->config->get('config_language_id')];
			 }
			 $data = array(
				'sort'  => 'p.date_added',
				'order' => 'DESC',
				'start' => 0,
				'limit' => $item['productlimit']
			 );
			 $productresults = $this->model_catalog_product->getProducts($data);
			}
			if ($item['products'] == 'featured') {
			foreach ($productresults as $product_id) {
			$product_info = $this->model_catalog_product->getProduct($product_id);
			
			if ($product_info) {
				if ($product_info['image']) {
					$image = $this->model_tool_image->resize($product_info['image'], $this->config->get('supermenu_image_width'), $this->config->get('supermenu_image_height'));
				} else {
					$image = $this->model_tool_image->resize('no_image.jpg', $this->config->get('supermenu_image_width'), $this->config->get('supermenu_image_height'));
				}

				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$price = false;
				}
						
				if ((float)$product_info['special']) {
					$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$special = false;
				}
				
				$secondkids_data = array();
				$firstkids_data[] = array(
						'category_id' => $product_info['product_id'],
						'cssid'       => "morecat" . $product_info['product_id'],
						'name'        => $product_info['name'],
						'thumb'       => $image,
						'price'   	  => $price,
						'special' 	  => $special,
						'gchildren'   => $secondkids_data,
						'href'        => $this->url->link('product/product', 'product_id=' . $product_info['product_id'])	
					);
			}
			}
			} else {
			foreach ($productresults as $product_info) {
				if ($product_info['image']) {
					$image = $this->model_tool_image->resize($product_info['image'], $this->config->get('supermenu_image_width'), $this->config->get('supermenu_image_height'));
				} else {
					$image = $this->model_tool_image->resize('no_image.jpg', $this->config->get('supermenu_image_width'), $this->config->get('supermenu_image_height'));
				}

				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$price = false;
				}
						
				if ((float)$product_info['special']) {
					$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$special = false;
				}
				
				$secondkids_data = array();
				$firstkids_data[] = array(
						'category_id' => $product_info['product_id'],
						'cssid'       => "morecat" . $product_info['product_id'],
						'name'        => $product_info['name'],
						'thumb'       => $image,
						'price'   	  => $price,
						'special' 	  => $special,
						'gchildren'   => $secondkids_data,
						'href'        => $this->url->link('product/product', 'product_id=' . $product_info['product_id'])	
					);
			}
			}
			 
			 $item_image = false;
		   
		
		 } elseif ($item['type'] == 'catprods') {
		 
		   $katid = $item['category_id']; 
		   
		   $cssid = 'supcat' . $item['category_id'];
		 
           $kat_info = $this->model_catalog_category->getCategory($katid);	
		   
		  if ($kat_info) {
			
		     $item_name = $kat_info['name'];
			 
			 $item_view = $item['view'];
			 
			 $item_id = $kat_info['category_id'];
			 
			 $item_url = $this->url->link('product/category', 'path=' . $item_id);
			 
			 $firstkids_data = array();
			
			 $data = array(
				'sort'  => 'p.date_added',
				'filter_category_id' => $item_id,
				'order' => 'DESC',
				'start' => 0,
				'limit' => $item['productlimit']
			 );
			 $productresults = $this->model_catalog_product->getProducts($data);
			
			foreach ($productresults as $product_info) {
				if ($product_info['image']) {
					$image = $this->model_tool_image->resize($product_info['image'], $this->config->get('supermenu_image_width'), $this->config->get('supermenu_image_height'));
				} else {
					$image = $this->model_tool_image->resize('no_image.jpg', $this->config->get('supermenu_image_width'), $this->config->get('supermenu_image_height'));
				}

				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$price = false;
				}
						
				if ((float)$product_info['special']) {
					$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$special = false;
				}
				
				$secondkids_data = array();
				$firstkids_data[] = array(
						'category_id' => $product_info['product_id'],
						'cssid'       => "morecat" . $product_info['product_id'],
						'name'        => $product_info['name'],
						'thumb'       => $image,
						'price'   	  => $price,
						'special' 	  => $special,
						'gchildren'   => $secondkids_data,
						'href'        => $this->url->link('product/product', 'path=' . $item_id . '&product_id=' . $product_info['product_id'])	
					);
			}
			 
			 if ($kat_info['image']) {
				$item_image = $this->model_tool_image->resize($kat_info['image'], 100, 100);
			 } else {
				$item_image = $this->model_tool_image->resize('no_image.jpg', 100, 100);
			 }
		   
		  }
		
		 } elseif($item['type'] == 'login') {
			
		     $item_name = $this->language->get('button_login');
			 
			 $item_view = '';
			 
			 $item_id = '';
			 
			 $cssid = 'login_drop';
			 if ($this->customer->isLogged()) {
				 $item_url = $this->url->link('account/account', '', 'SSL');
				 $item_name = $this->language->get('heading_title');
			 } else {
				 $item_url = $this->url->link('account/login', '', 'SSL');
			 }
			  
			 $firstkids_data = array();
			 
			 $item_image = false;
			 
		  } else {
		  
		     $item_name = $item['customname'][$this->config->get('config_language_id')];
			 
			 $item_view = '';
			 
			 $item_id = '';
			 
			 $cssid = 'notcat' . $increaseid;
			 
			 $item_url = $item['customurl'][$this->config->get('config_language_id')];
			 
			 $firstkids_data = array();
			 
			 $item_image = false;
		  
		  }
		  
		  $item_addurl = $item['addurl'][$this->config->get('config_language_id')];
		  
		  $item_topimg = '';
		 
		  
		  if ($item_name) {
			  if (!$item_url && isset($item['customurl'][$this->config->get('config_language_id')]) && $item['customurl'][$this->config->get('config_language_id')]) $item_url = $item['customurl'][$this->config->get('config_language_id')];
			  $mitems[] = array(
				'name'        => $item_name,
				'id'          => $item_id,
				'cssid'       => $cssid,
				'children'    => $firstkids_data,
				'image'       => $item_image,
				'view'        => $item_view,
				'add'         => $item['image'],
				'addurl'      => $item_addurl,
				'href'        => $item_url,
				'tlcolor'     => $item['tlcolor'],
				'tlstyle'     => $item['tlstyle'],
				'chtml'       => $item['chtml'],
				'dwidth'      => $item['dwidth'],
				'iwidth'      => $item['iwidth'],
				'fbrands'     => $item['fbrands'],
				'item_topimg' => $item_topimg,
				'type' 		  => $item['type'],
				'cchtml'      => $item['cchtml']
			  );
			}	
		 } /* end store check */
		} /* end loop trough items */
			 if ($supercache && $mitems) { /* set cache if enabled */
                $this->cache->set('supermenu.items.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id'), $mitems);
             }
	   } /* end check for cache */
       } /* end check for items */
		
		$mitems = $c_items ? $c_items : $mitems;
		
		foreach ($mitems as $item) { /* loop again trough items to not include html areas in cache */
			
			if ($item['cchtml'] && $item['chtml']) { 
				$itemarea = $this->config->get('supermenu_html'.$item['cchtml']);
				if (isset($itemarea[$this->config->get('config_language_id')])) {
					$cchtml = html_entity_decode($itemarea[$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
				} else {
					$cchtml = '';
				}
			} else {
				$cchtml = '';
			}
			
			$brandsinitem = array();
			
			if ($item['fbrands']) {
				$brandsids = explode(',', $item['fbrands']);
			} else {
				$brandsids  = array();
			}
			
		    foreach ($brandsids as $brandsid) {
					$brand_info = $this->model_catalog_manufacturer->getManufacturer($brandsid);
					if ($brand_info) {
						if (VERSION == '1.5.2' || VERSION == '1.5.2.1' || VERSION == '1.5.3' || VERSION == '1.5.3.1') {
							$brandsinitem[] = array(
								'name' => $brand_info['name'],
								'manufacturer_id' => $brand_info['manufacturer_id'],
								'href' => $this->url->link('product/manufacturer/product', 'manufacturer_id=' . $brand_info['manufacturer_id'])
							);
						} else {
							$brandsinitem[] = array(
								'name' => $brand_info['name'],
								'manufacturer_id' => $brand_info['manufacturer_id'],
								'href' => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $brand_info['manufacturer_id'])
							);
						}
					}
			}
			
			if ($item['dwidth']) {
				$dwidth = $item['dwidth'];
			} else {
				$dwidth = '';
			}
			
			
			if($this->data['skin'] == "imgmenu") {
				$item_add = '';
				$item_topimg_pre = isset($item['add'][$this->config->get('config_language_id')]) ? $item['add'][$this->config->get('config_language_id')] : '';
				if($item_topimg_pre) {
					$item_topimg = $this->model_tool_image->resize($item_topimg_pre, 75, 75);
				} else {
					$item_topimg = $this->model_tool_image->resize('no_image.jpg', 75, 75);
				}
			} else {
				$item_add = isset($item['add'][$this->config->get('config_language_id')]) ? $item['add'][$this->config->get('config_language_id')] : '';
				$item_topimg = '';
			}
				
			$this->data['mitems'][] = array(
				'name'        => $item['name'],
				'id'          => $item['id'],
				'cssid'       => $item['cssid'],
				'children'    => $item['children'],
				'image'       => $item['image'],
				'view'        => $item['view'],
				'add'         => $item_add,
				'addurl'      => $item['addurl'],
				'href'        => $item['href'],
				'tlcolor'     => $item['tlcolor'],
				'tlstyle'     => $item['tlstyle'],
				'chtml'       => $item['chtml'],
				'dwidth'      => $dwidth,
				'iwidth'      => $item['iwidth'],
				'fbrands'     => $brandsinitem,
				'item_topimg' => $item_topimg,
				'cchtml'      => $cchtml
			);
		}
		
		 /* in case the account dropdown is enabled */
             $this->data['text_register'] = $this->language->get('text_register');
			 $this->data['text_forgotten'] = $this->language->get('text_forgotten');
			 $this->data['entry_email'] = $this->language->get('entry_email');
			 $this->data['entry_password'] = $this->language->get('entry_password');
			 $this->data['button_login'] = $this->language->get('button_login');
			 $this->data['actiond'] = $this->url->link('account/login', '', 'SSL');
			 $this->data['registerd'] = $this->url->link('account/register', '', 'SSL');
			 $this->data['forgottend'] = $this->url->link('account/forgotten', '', 'SSL');
			 $this->data['text_logout'] = $this->language->get('text_logout');
			 $this->data['text_account'] = $this->language->get('text_account');
			 $this->data['text_edit'] = $this->language->get('text_edit');
			 $this->data['text_password'] = $this->language->get('text_password');
			 $this->data['text_address'] = $this->language->get('text_address');
			 $this->data['text_wishlist'] = $this->language->get('text_wishlist');
			 $this->data['text_order'] = $this->language->get('text_order');
			 $this->data['text_download'] = $this->language->get('text_download');
			 $this->data['text_return'] = $this->language->get('text_return');
			 $this->data['text_transaction'] = $this->language->get('text_transaction');
			 $this->data['text_newsletter'] = $this->language->get('text_newsletter');
			 $this->data['text_recurring'] = $this->language->get('text_recurring');
			 $this->data['logged'] = $this->customer->isLogged();
			 $this->data['logout'] = $this->url->link('account/logout', '', 'SSL');
			 $this->data['forgotten'] = $this->url->link('account/forgotten', '', 'SSL');
			 $this->data['account'] = $this->url->link('account/account', '', 'SSL');
			 $this->data['edit'] = $this->url->link('account/edit', '', 'SSL');
			 $this->data['password'] = $this->url->link('account/password', '', 'SSL');
			 $this->data['address'] = $this->url->link('account/address', '', 'SSL');
			 $this->data['wishlist'] = $this->url->link('account/wishlist');
			 $this->data['order'] = $this->url->link('account/order', '', 'SSL');
			 $this->data['download'] = $this->url->link('account/download', '', 'SSL');
			 $this->data['return'] = $this->url->link('account/return', '', 'SSL');
			 $this->data['transaction'] = $this->url->link('account/transaction', '', 'SSL');
			 $this->data['newsletter'] = $this->url->link('account/newsletter', '', 'SSL');
			 $this->data['recurring'] = $this->url->link('account/recurring', '', 'SSL');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/supermenu.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/supermenu.tpl';
		} else {
			$this->template = 'default/template/module/supermenu.tpl';
		}
		
		$this->render();
  	}
}
?>
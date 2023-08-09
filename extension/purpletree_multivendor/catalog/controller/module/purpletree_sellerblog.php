<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Module;
class PurpletreeSellerblog extends \Opencart\System\Engine\Controller {
		public function index() { 
			$this->load->language('extension/purpletree_multivendor/module/purpletree_sellerblog');
			
			$data['heading_title'] = $this->language->get('heading_title');
			
			$data['text_readmore'] = $this->language->get('text_readmore');
			
			$this->load->model('extension/purpletree_multivendor/module/purpletree_sellerblog');
			
			$this->load->model('tool/image');
			
			$data['pts_blogs'] = array();
			$data['view_all'] = $this->language->get('view_all');
			$data['all_blog'] = $this->url->link('extension/purpletree_multivendor/multivendor/blog_post|all_blog','language=' . $this->config->get('config_language'), true);
			
			$results = $this->model_extension_purpletree_multivendor_module_purpletree_sellerblog->getPurpletreeBlog($this->config->get('module_purpletree_sellerblog_limit'));
			$image_height = 150;
			$image_width = 150;
			if ($this->config->get('module_purpletree_sellerblog_height')) {
			  $image_height = $this->config->get('module_purpletree_sellerblog_height');
			}
			if ($this->config->get('module_purpletree_sellerblog_width')) {
			  $image_width = $this->config->get('module_purpletree_sellerblog_width');
			}
			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $image_width, $image_height);
					} else {
					$image = $this->model_tool_image->resize('placeholder.png',$image_width, $image_height);
				}
				
				$shortdescription = substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, (int)$this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..';
				
				
				if(strlen($shortdescription) > 25){
					$shortdescription =  substr($shortdescription, 0, 25).'...';
				}      
				$data['pts_blogs'][] = array(
				'blog_post_id'  => $result['blog_post_id'],
				'thumb'         => $image,
				'title'         => $result['title'],
				'description'   => $shortdescription,
				'date'          => date('d M', strtotime($result['created_at'])),
				'href'          => $this->url->link('extension/purpletree_multivendor/multivendor/blog_post', 'blog_post_id=' . $result['blog_post_id'].'&language=' . $this->config->get('config_language'))						
				);
			}
			if ($results) {
				return $this->load->view('extension/purpletree_multivendor/module/purpletree_sellerblog', $data);
			}
		}
	}
<?php
namespace Opencart\Admin\Controller\Extension\PurpletreeMultivendor\Module;
class PurpletreeMultivendor extends \Opencart\System\Engine\Controller {
	private $error = array();
	private $events = array();
		
	public function __construct($registry){
		parent::__construct($registry);	
		$this->events();
		$this->addStartUp();
	}
	public function install(): void {
		// Add events
		$this->addEvent($this->events);
		$this->createDatabaseTables();
		$this->addStartUp();
	}
	
	public function uninstall(): void {
		// Delete Events
		$this->deleteEvent($this->events);
		//$this->deleteDatabaseTables();
		$this->deleteStartUp();
	}
	
	private function events(): void {
		$this->events = array();
		define('EVENT_PATH','extension/purpletree_multivendor/events/');
		$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_payment_addr_save_before',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/payment_address|save/before',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/paymentaddress|saveBefore',
			'status'		=> true,
			'sort_order'		=> 0
		    );
			
			$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_payment_addr_address_before',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/payment_address|address/before',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/paymentaddress|addressBefore',
			'status'		=> true,
			'sort_order'		=> 0
		    );
			
			$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_payment_addr_save_after',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/payment_address|save/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/paymentaddress|saveAfter',
			'status'		=> true,
			'sort_order'		=> 0
		    );
			
			$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_payment_addr_address_after',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/payment_address|address/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/paymentaddress|addressAfter',
			'status'		=> true,
			'sort_order'		=> 0
		    );
		
		$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_shipping_addr_save_before',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/shpping_address|save/before',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/shppingaddress|saveBefore',
			'status'		=> true,
			'sort_order'		=> 0
		    );
			
			$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_shipping_addr_address_before',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/shpping_address|address/before',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/shppingaddress|addressBefore',
			'status'		=> true,
			'sort_order'		=> 0
		    );
		
		$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_shipping_addr_save_after',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/shpping_address|save/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/shppingaddress|saveAfter',
			'status'		=> true,
			'sort_order'		=> 0
		    );
			
			$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_shipping_addr_address_after',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/shpping_address|address/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/shppingaddress|addressAfter',
			'status'		=> true,
			'sort_order'		=> 0
		    );

		
		$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_register_save_before',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/register|save/before',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/register|saveBefore',
			'status'		=> true,
			'sort_order'		=> 0
		    );
			
			$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_register_save_after',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/register|save/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/register|saveAfter',
			'status'		=> true,
			'sort_order'		=> 0
		    );
		$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_payment_m_before',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/payment_method/before',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/paymentmethod|paymentIndexBefore',
			'status'		=> true,
			'sort_order'		=> 0
		    );
			
			$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_payment_m_after',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/payment_method/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/paymentmethod|paymentIndexAfter',
			'status'		=> true,
			'sort_order'		=> 0
		    );
			
			$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_payment_m_getMethods_before',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/payment_method|getMethods/before',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/paymentmethod|getMethodsBefore',
			'status'		=> true,
			'sort_order'		=> 0
		    );
			
			$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_payment_m_getMethods_after',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/payment_method|getMethods/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/paymentmethod|getMethodsAfter',
			'status'		=> true,
			'sort_order'		=> 0
		    );
			
			
			$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_payment_m_save_before',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/payment_method|save/before',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/paymentmethod|saveBefore',
			'status'		=> true,
			'sort_order'		=> 0
		    );
			$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_payment_m_save_after',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/payment_method|save/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/paymentmethod|saveAfter',
			'status'		=> true,
			'sort_order'		=> 0
		    );
		
		
		
		$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_shipping_m_before',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/shipping_method/before',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/shippingmethod|shippingIndexBefore',
			'status'		=> true,
			'sort_order'		=> 0
		    );
			
			$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_shipping_m_after',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/shipping_method/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/shippingmethod|shippingIndexAfter',
			'status'		=> true,
			'sort_order'		=> 0
		    );
			
			$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_shipping_m_getMethods_before',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/shipping_method|getMethods/before',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/shippingmethod|getMethodsBefore',
			'status'		=> true,
			'sort_order'		=> 0
		    );
			
			$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_shipping_m_getMethods_after',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/shipping_method|getMethods/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/shippingmethod|getMethodsAfter',
			'status'		=> true,
			'sort_order'		=> 0
		    );
			
			
			$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_shipping_m_save_before',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/shipping_method|save/before',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/shippingmethod|saveBefore',
			'status'		=> true,
			'sort_order'		=> 0
		    );
			$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_shipping_m_save_after',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/shipping_method|save/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/shippingmethod|saveAfter',
			'status'		=> true,
			'sort_order'		=> 0
		    );

			
		$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_checkout_before',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/checkout/before',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/checkout|beforeCheckoutController',
			'status'		=> true,
			'sort_order'		=> 0
		    );
			
			$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_cart_before',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/cart/before',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/cart|beforeCartController',
			'status'		=> true,
			'sort_order'		=> 0
		    );
			$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_cart_getList_after',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/cart|getList/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/cart|afterGetListController',
			'status'		=> true,
			'sort_order'		=> 0
		    );
					
			$this->events[] = array(
			'code'			=>'pts_catalog_controller_common_cart_after',
			'description'	=>'',
			'trigger'		=>'catalog/controller/common/cart/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/common/cart|afterCartController',
			'status'		=> true,
			'sort_order'		=> 0
		    );
			
			$this->events[] = array(
			'code'			=>'pts_catalog_controller_common_cart_info_after',
			'description'	=>'',
			'trigger'		=>'catalog/controller/common/cart|info/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/common/cart|afterCartInfoController',
			'status'		=> true,
			'sort_order'		=> 0
		    );
			
			$this->events[] = array(
			'code'			=>'catalog_model_design_seo_url_getSeoUrlByKeyValue_after',
			'description'	=>'',
			'trigger'		=>'catalog/model/design/seo_url/getSeoUrlByKeyValue/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/startup/seourl|afterSeoUrlModel',
			'status'		=> true,
			'sort_order'		=> 0
		    );
		
		$this->events[] = array(
			'code'			=>'catalog_controller_api_sale_cart_after',
			'description'	=>'',
			'trigger'		=>'catalog/controller/api/sale/cart|add/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/cart|afterCartAddController',
			'status'		=> true,
			'sort_order'		=> 0
		    );
		
		$this->events[] = array(
			'code'			=>'catalog_model_total_sub_total_getTotal_after',
			'description'	=>'',
			'trigger'		=>'catalog/model/extension/opencart/total/sub_total/getTotal/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/cart|getSubTotal',
			'status'		=> true,
			'sort_order'		=> 0
		    );
		
		$this->events[] = array(
			'code'			=>'catalog_controller_checkout_confirm_confirm_after',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/confirm|confirm/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/success|checkoutConfirmAfter',
			'status'		=> true,
			'sort_order'		=> 0
		    );
			
			$this->events[] = array(
			'code'			=>'catalog_controller_checkout_confirm_after',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/confirm/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/confirm|afterCheckoutConfirm',
			'status'		=> true,
			'sort_order'		=> 0
		    );

			$this->events[] = array(
			'code'			=>'catalog_view_common_success_after',
			'description'	=>'',
			'trigger'		=>'catalog/view/common/success/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/success|viewSuccessAfter',
			'status'		=> true,
			'sort_order'		=> 0
		    ); 
			
			$this->events[] = array(
			'code'			=>'admin_view_sale_returns_getHistories_after',
			'description'	=>'',
			'trigger'		=>'admin/model/sale/returns/getHistories/after',
			'action'		=>'extension/purpletree_multivendor/events/sale/returns|getHistoriesAfter',
			'status'		=> true,
			'sort_order'		=> 0
		    ); 
		
			$this->events[] = array(
			'code'			=>'admin_view_sale_returns_return_history_after',
			'description'	=>'',
			'trigger'		=>'admin/view/sale/return_history/after',
			'action'		=>'extension/purpletree_multivendor/events/sale/returns|viewRetrunHistoryAfter',
			'status'		=> true,
			'sort_order'		=> 0
		    ); 
		
			$this->events[] = array(
			'code'			=>'admin_model_sale_returns_addReturn_after',
			'description'	=>'',
			'trigger'		=>'admin/model/sale/returns/addReturn/after',
			'action'		=>'extension/purpletree_multivendor/events/sale/returns|addReturnAfter',
			'status'		=> true,
			'sort_order'		=> 0
		    ); 
		
			$this->events[] = array(
			'code'			=>'admin_model_sale_returns_editReturn_after',
			'description'	=>'',
			'trigger'		=>'admin/model/sale/returns/editReturn/after',
			'action'		=>'extension/purpletree_multivendor/events/sale/returns|editReturnAfter',
			'status'		=> true,
			'sort_order'		=> 0
		    ); 
		
		$this->events[] = array(
			'code'			=>'catalog_model_account_return_after',
			'description'	=>'',
			'trigger'		=>'catalog/model/account/returns/addReturn/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/account/returns|addReturnAfter',
			'status'		=> true,
			'sort_order'		=> 0
		    ); 
			
		$this->events[] = array(
			'code'			=>'catalog_view_account_order_info_after 	',
			'description'	=>'',
			'trigger'		=>'catalog/view/account/order_info/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/account/order|getOrderInfo',
			'status'		=> true,
			'sort_order'		=> 0
		    ); 
		
		$this->events[] = array(
			'code'			=>'catalog_model_marketing_coupon_getCoupon_after 	',
			'description'	=>'',
			'trigger'		=>'catalog/model/marketing/coupon/getCoupon/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/marketing/coupon|getCouponAfter',
			'status'		=> true,
			'sort_order'		=> 0
		    ); 
			
		
		$this->events[] = array(
			'code'			=>'admin_model_marketing_coupon_editCoupon_after 	',
			'description'	=>'',
			'trigger'		=>'admin/model/marketing/coupon/editCoupon/after',
			'action'		=>'extension/purpletree_multivendor/events/marketing/coupon|editCouponAfter',
			'status'		=> true,
			'sort_order'		=> 0
		    ); 
			
		$this->events[] = array(
			'code'			=>'admin_model_marketing_coupon_addCoupon_after 	',
			'description'	=>'',
			'trigger'		=>'admin/model/marketing/coupon/addCoupon/after',
			'action'		=>'extension/purpletree_multivendor/events/marketing/coupon|addCouponAfter',
			'status'		=> true,
			'sort_order'		=> 0
		    ); 
		
			$this->events[] = array(
			'code'			=>'admin_view_marketing_coupon_form_after 	',
			'description'	=>'',
			'trigger'		=>'admin/view/marketing/coupon_form/after',
			'action'		=>'extension/purpletree_multivendor/events/marketing/coupon|getCouponFormViewAfter',
			'status'		=> true,
			'sort_order'		=> 0
		    ); 

			$this->events[] = array(
			'code'			=>'admin_view_marketing_coupon_list_after',
			'description'	=>'',
			'trigger'		=>'admin/view/marketing/coupon_list/after',
			'action'		=>'extension/purpletree_multivendor/events/marketing/coupon|getCouponListViewAfter',
			'status'		=> true,
			'sort_order'		=> 0
		    ); 
			
			$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_cart_remove_before 	',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/cart|remove/before',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/cart|beforeCartRemoveController',
			'status'		=> true,
			'sort_order'		=> 0
		    ); 
			
			$this->events[] = array(
			'code'			=>'pts_catalog_model_product_before',
			'description'	=>'',
			'trigger'		=>'catalog/model/checkout/cart/getProducts/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/cart|getProducts',
			'status'		=> true,
			'sort_order'		=> 0
		    );

			$this->events[] = array(
			'code'			=>'pts_catalog_model_order_addOrderHistory_after',
			'description'	=>'',
			'trigger'		=>'catalog/model/checkout/order/addHistory/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/Order|afterAddOrderHistory',
			'status'		=> true,
			'sort_order'		=> 0
		    );

			$this->events[] = array(
			'code'			=>'pts_catalog_view_product_category_before',
			'description'	=>'',
			'trigger'		=>'catalog/view/product/category/before',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/product/category|beforeCategoryView',
			'status'		=> true,
			'sort_order'		=> 0
		    );
		
		    $this->events[] = array(
			'code'			=>'pts_catalog_view_product_category',
			'description'	=>'',
			'trigger'		=>'catalog/view/product/category/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/product/category|afterCategoryView',
			'status'		=> true,
			'sort_order'		=> 0
		    );
		
		 $this->events[] = array(
			'code'			=>'pts_catalog_controller_category_before',
			'description'	=>'',
			'trigger'		=>'catalog/view/extension/opencart/module/category/before',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/module/category|beforeCategoryController',
			'status'		=> true,
			'sort_order'		=> 0
			);
			
		  $this->events[] = array(
			'code'			=>'pts_catalog_model_order_addorder_after',
			'description'	=>'',
			'trigger'		=>'catalog/model/checkout/order/addOrder/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/Order|afterAddOrder',
			'status'		=> true,
			'sort_order'		=> 0
			);
			
			$this->events[] = array(
			'code'			=>'pts_catalog_model_order_editorder_after',
			'description'	=>'',
			'trigger'		=>'catalog/model/checkout/order/editOrder/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/Order|afterEditOrder',
			'status'		=> true,
			'sort_order'		=> 0
		    );
			
			  $this->events[] = array(
			'code'			=>'pts_catalog_model_checkout_cart_getproducts_after',
			'description'	=>'',
			'trigger'		=>'catalog/model/checkout/cart/getProducts/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/cart|getProducts',
			'status'		=> true,
			'sort_order'		=> 0
			);
		
		    $this->events[] = array(
			'code'			=>'pts_catalog_controller_customer_contact_after',
			'description'	=>'',
			'trigger'		=>'catalog/view/extension/opencart/module/account/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/module/account/account|afterCustomerContactController',
			'status'		=> true,
			'sort_order'		=> 0
			);
		
			$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_cart_index_before',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/cart/before',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/cart|beforeCartIndexController',
			'status'		=> true,
			'sort_order'		=> 0
			);
			
			$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_cart_remove_before',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/cart|remove/before',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/cart|beforeCartRemoveController',
			'status'		=> true,
			'sort_order'		=> 0
			);
			
			$this->events[] = array(
			'code'			=>'pts_catalog_view_product_thumb_before',
			'description'	=>'',
			'trigger'		=>'catalog/view/product/thumb/before',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/module/thumb|beforeThumbView',
			'status'		=> true,
			'sort_order'		=> 0
			);
			
			$this->events[] = array(
			'code'			=>'pts_catalog_view_product_thumb_after',
			'description'	=>'',
			'trigger'		=>'catalog/view/product/thumb/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/module/thumb|afterThumbView',
			'status'		=> true,
			'sort_order'		=> 0
			);
		
			$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_cart_add_after',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/cart|add/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/cart|afterCartAddController',
			'status'		=> true,
			'sort_order'		=> 0
			);
		
			$this->events[] = array(
			'code'			=>'pts_catalog_controller_checkout_cart_add_before',
			'description'	=>'',
			'trigger'		=>'catalog/controller/checkout/cart|add/before',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/cart|beforeCartAddController',
			'status'		=> true,
			'sort_order'		=> 0
		);
		
			$this->events[] = array(
			'code'			=>'pts_catalog_view_checkout_checkout ',
			'description'	=>'',
			'trigger'		=>'catalog/view/checkout/checkout/before',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/checkout|beforeCheckoutView',
			'status'		=> true,
			'sort_order'		=> 0
		);
		
			$this->events[] = array(
			'code'			=>'pts_catalog_view_checkout_cart',
			'description'	=>'',
			'trigger'		=>'catalog/view/checkout/cart/before',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/checkout/cart|beforeCartView',
			'status'		=> true,
			'sort_order'		=> 0
		);
		
		$this->events[] = array(
			'code'			=>'pts_catalog_view_product_product',
			'description'	=>'',
			'trigger'		=>'catalog/view/product/product/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/product/product|afterProductView',
			'status'		=> true,
			'sort_order'		=> 0
		);
		
		$this->events[] = array(
			'code'			=>'pts_catalog_view_common_header',
			'description'	=>'',
			'trigger'		=>'catalog/view/common/header/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/common/header|afterheaderview',
			'status'		=> true,
			'sort_order'		=> 0
		);
		
			$this->events[] = array(
			'code'			=>'admin_view_catalog_product_form_after',
			'description'	=>'',
			'trigger'		=>'admin/view/catalog/product_form/after',
			'action'		=>'extension/purpletree_multivendor/events/catalog/product|product_form',
			'status'		=> true,
			'sort_order'		=> 0
		);
		
		
		$this->events[] = array(
			'code'			=>'pts_admin_model_catalog_product_add_product',
			'description'	=>'',
			'trigger'		=>'admin/model/catalog/product/addProduct/after',
			'action'		=>'extension/purpletree_multivendor/events/catalog/product|addproduct',
			'status'		=> true,
			'sort_order'		=> 0
		);
		$this->events[] = array(
			'code'			=>'pts_admin_model_catalog_product_edit_product',
			'description'	=>'',
			'trigger'		=>'admin/model/catalog/product/editProduct/after',
			'action'		=>'extension/purpletree_multivendor/events/catalog/product|editproduct',
			'status'		=> true,
			'sort_order'		=> 0
		);
		$this->events[] = array(
			'code'			=>'pts_admin_view_customer_customer_customer_form',
			'description'	=>'',
			'trigger'		=>'admin/view/customer/customer_form/after',
			'action'		=>EVENT_PATH.'customer/customer|customer_form',
			'status'		=> true,
			'sort_order'		=> 0
		);
		$this->events[] = array(
			'code'			=>'pts_admin_controller_common_column_left',
			'description'	=>'',
			'trigger'		=>'admin/view/common/column_left/before',
			'action'		=>EVENT_PATH.'common/column_left|createMenu',
			'status'		=> true,
			'sort_order'		=> 0
		);
		$this->events[] = array(
			'code'			=>'pts_getjournal3filterproducts',
			'description'	=>'',
			'trigger'		=>'catalog/model/journal3/filter/getProducts/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/common/events|getFilterProducts',
			'status'		=> true,
			'sort_order'		=> 0
		);
		$this->events[] = array(
			'code'			=>'pts_getfilterproducts',
			'description'	=>'',
			'trigger'		=>'catalog/model/catalog/product/getProducts/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/common/events|getFilterProducts',
			'status'		=> true,
			'sort_order'		=> 0
		);
		$this->events[] = array(
			'code'			=>'pts_getfilterlatestproducts',
			'description'	=>'',
			'trigger'		=>'catalog/model/catalog/product/getLatestProducts/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/common/events|getFilterLatestProducts',
			'status'		=> true,
			'sort_order'		=> 0
		);
		$this->events[] = array(
			'code'			=>'pts_getfilterproductspecials',
			'description'	=>'',
			'trigger'		=>'catalog/model/catalog/product/getProductSpecials/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/common/events|getFilterLatestProducts',
			'status'		=> true,
			'sort_order'		=> 0
		);
		$this->events[] = array(
			'code'			=>'pts_getfilterbestsellerproducts',
			'description'	=>'',
			'trigger'		=>'catalog/model/catalog/product/getBestSellerProducts/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/common/events|getFilterLatestProducts',
			'status'		=> true,
			'sort_order'		=> 0
		);
		$this->events[] = array(
			'code'			=>'pts_getfilterproduct',
			'description'	=>'',
			'trigger'		=>'catalog/model/catalog/product/getProduct/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/common/events|getFilterProduct',
			'status'		=> true,
			'sort_order'		=> 0
		);
		$this->events[] = array(
			'code'			=>'pts_getfiltertotalproducts',
			'description'	=>'',
			'trigger'		=>'catalog/model/catalog/product/getTotalProducts/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/common/events|getFilterTotalProducts',
			'status'		=> true,
			'sort_order'		=> 0
		);
		$this->events[] = array(
			'code'			=>'pts_admin_header',
			'description'	=>'',
			'trigger'		=>'catalog/controller/common/header/after',
			'action'		=>'extension/purpletree_multivendor/multivendor/events/common/events|beforeheader',
			'status'		=> true,
			'sort_order'		=> 0
		);
	/* 	$this->events[] = array(
			'code'			=>'pts_addShippingCharge',
			'description'	=>'',
			'trigger'		=>'admin/model/catalog/product/addProduct/after',
			'action'		=>'extension/purpletree_multivendor/events/addShippingCharge',
			'status'		=> true,
			'sort_order'		=> 0
		); */
	/* 	$this->events[] = array(
			'code'			=>'pts_editShippingCharge',
			'description'	=>'',
			'trigger'		=>'admin/model/catalog/product/editProduct/after',
			'action'		=>'extension/purpletree_multivendor/events/editShippingCharge',
			'status'		=> true,
			'sort_order'		=> 0
		); */
		
		$this->events[] = array(
			'code'			=>'pts_admin_model_customer_customer_editcustomer',
			'description'	=>'',
			'trigger'		=>'admin/model/customer/customer/editCustomer/before',
			'action'		=>'extension/purpletree_multivendor/events/customer/customer|editcustomer',
			'status'		=> true,
			'sort_order'		=> 0
		);
		$this->events[] = array(
			'code'			=>'pts_admin_model_customer_customer_addcustomer',
			'description'	=>'',
			'trigger'		=>'admin/model/customer/customer/addCustomer/after',
			'action'		=>'extension/purpletree_multivendor/events/customer/customer|addcustomer',
			'status'		=> true,
			'sort_order'		=> 0
		);
		$this->events[] = array(
			'code'			=>'pts_admin_model_customer_customer_getcustomer',
			'description'	=>'',
			'trigger'		=>'admin/model/customer/customer/getCustomers/after',
			'action'		=>'extension/purpletree_multivendor/events/customer/customer|getcustomer',
			'status'		=> true,
			'sort_order'		=> 0
		);
		$this->events[] = array(
			'code'			=>'pts_admin_model_customer_customer_validate',
			'description'	=>'',
			'trigger'		=>'admin/controller/customer/customer/validateForm/before',
			'action'		=>'extension/purpletree_multivendor/events/customer/customer|validateseller',
			'status'		=> true,
			'sort_order'		=> 0
		);
	}		
	
	private function addStartUp(): void {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "startup` WHERE `code` = 'SEO URL' AND `action` = 'catalog/extension/purpletree_multivendor/startup/seourl'");
		if(!$query->num_rows){
		$query = $this->db->query("INSERT INTO`" . DB_PREFIX . "startup` SET `code` = 'SEO URL', `action` = 'catalog/extension/purpletree_multivendor/startup/seourl', `status` = '1'");		
		}
		
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "seo_url` WHERE `key` = 'route' AND `value` = 'extension/purpletree_multivendor/multivendor'");
		if(!$query->num_rows){
		$query = $this->db->query("INSERT INTO`" . DB_PREFIX . "seo_url` SET `store_id` = '".(int)$this->config->get('config_store_id')."',`language_id` = '".(int)$this->config->get('config_language_id')."',`key` = 'route', `value` = 'extension/purpletree_multivendor/multivendor',`keyword` = 'ocmultivendor',`sort_order` = '0'");		
		}	
	}
	
	private function deleteStartUp(): void {
		$query = $this->db->query("DELETE FROM `" . DB_PREFIX . "startup` WHERE `code` = 'SEO URL' AND `action` = 'catalog/extension/purpletree_multivendor/startup/seourl'");
		
		$query = $this->db->query("DELETE FROM `" . DB_PREFIX . "seo_url` WHERE `key` = 'route' AND `value` = 'extension/purpletree_multivendor/multivendor'");	
	}
	private function deleteDatabaseTables(): void {
		/***  Drop Tables Of Multivendor Extension when module un-installs  ****/
		if($this->request->get['extension']=="purpletree_multivendor"){
			$query = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "purpletree_vendor_stores'");	
			if($query->num_rows==1) 
			{
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_cart");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_template");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_allowed_category");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_template_products");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_downloads");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_shipping");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_stores");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_products");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_orders");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_reviews");
				$this->db->query("DROP TABLE IF EXISTS ".DB_PREFIX."purpletree_vendor_commissions");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_payments");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_order_total");
		        $this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_orders_history");
		
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_contact");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_customer_vendor_enquiries");
					
				//subscription plan_description
			
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_plan_description");
				
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_seller_plan");
				
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_plan_invoice_item");
				
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_plan_invoice_history");
				

				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_categories_commission");
					
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_plan_invoice");
				
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_plan");
				
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_plan_invoice_status_l");
				
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_plan_invoice_status");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_plan_subscription");
				//Start Seller blog
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_blog_post_description");

				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_blog_post_comment");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_blog_post");                				
			//End seller blog
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_commission_invoice_items");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_commission_invoice");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_payment_settlement_history");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_subscription_products");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."pts_vendor_shipping");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_social_links");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_adaptive_paykey");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_products_return");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_geozone");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_coupons");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_email");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_customfield");			
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_quick_order_product");		$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_holiday");					
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_store_time");						
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_area_discaription");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_area");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_temp_product_option");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_temp_product_option_value");
				
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_stripe_account");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_attribute");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_attribute_group");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_enquiries");
				$this->db->query("DROP TABLE IF EXISTS ". DB_PREFIX ."purpletree_vendor_option");
			/* SEO URL TABLE */
				/* $query = $this->db->query("SELECT * FROM ". DB_PREFIX ."seo_url WHERE query LIKE 'blog_post%'");
				if($query->num_rows){
					$this->db->query("DELETE FROM ". DB_PREFIX ."seo_url WHERE query LIKE 'blog_post%'");	
				}
				$query1 = $this->db->query("SELECT * FROM ". DB_PREFIX ."seo_url WHERE query LIKE 'seller_store_id%'");
				if($query1->num_rows){
					$this->db->query("DELETE FROM " . DB_PREFIX . "seo_url WHERE query LIKE '%seller_store_id%'");
				} */
			}
		}	
	}
	
	private function createDatabaseTables(): void {
		/** Create Tables For Multivendor Extension when module installs ***/
		if($this->request->get['extension']=="purpletree_multivendor"){
			$query = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "purpletree_vendor_stores'");	
				if($query->num_rows==0) {
			$seller_layout = $this->db->query("SELECT layout_id FROM " . DB_PREFIX . "layout WHERE name='Account'");
			
			if($seller_layout->num_rows > 0){
				$data = $seller_layout->row;
					$this->db->query("INSERT into " . DB_PREFIX . "layout_route SET layout_id='".$data['layout_id']."', store_id='0', route='extension/account/%'");	
			}
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_stores` (
  							`id` int(11) NOT NULL AUTO_INCREMENT,
  							`seller_id` int(11) NOT NULL,
  							`store_name` varchar(256) NOT NULL,
  							`store_logo` varchar(150) NOT NULL,
  							`store_email` varchar(200) NOT NULL,
  							`store_phone` varchar(32) NOT NULL,
  							`store_banner` varchar(150) NOT NULL,
  							`document` varchar(150) NOT NULL,
  							`store_description` text NOT NULL,
  							`store_address` text NOT NULL,
  							`store_city` varchar(200) NOT NULL,
  							`store_country` int(11) NOT NULL,
  							`store_state` int(11) NOT NULL,
  							`store_zipcode` varchar(11) NOT NULL,
							`store_area` varchar(255) NOT NULL,
  							`store_shipping_policy` text NOT NULL,
							`store_return_policy` text NOT NULL,
							`store_meta_keywords` text NOT NULL,
							`store_meta_descriptions` text NOT NULL,
							`store_bank_details` varchar(356) NOT NULL,
  							`store_tin` varchar(50) NOT NULL,
							`store_shipping_type` varchar(50) NOT NULL,
							`store_shipping_order_type` varchar(50) NOT NULL,
  							`store_shipping_charge` decimal(6,2) NULL DEFAULT NULL,
							`store_live_chat_enable` tinyint(1) NOT NULL,
							`store_live_chat_code` text NOT NULL,
  							`store_status` tinyint(1) NOT NULL,
  							`store_commission` float(6,4) NULL DEFAULT NULL,
  							`is_removed` tinyint(1) NOT NULL,
  							`store_created_at` date NOT NULL,
  							`store_updated_at` date NOT NULL,
  							`seller_paypal_id` varchar(50) NOT NULL,
							`store_image` varchar(50) NOT NULL,
							`store_video` text NOT NULL,
							`google_map` text NOT NULL,
							`google_map_link` text NOT NULL,
							`store_timings` text NOT NULL,
							`multi_store_id` varchar(100) NOT NULL,
							`vacation` tinyint(1) NOT NULL,
							`sort_order` int(11) NOT NULL,
  							PRIMARY KEY (`id`)  ) CHARACTER SET utf8 COLLATE utf8_unicode_ci
						");
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_social_links` (
							`id` int(11) NOT NULL AUTO_INCREMENT,
							`store_id` int(11) NOT NULL,
							`facebook_link` varchar(255) NOT NULL,
							`google_link` varchar(255) NOT NULL,
							`instagram_link` varchar(255) NOT NULL,
							`twitter_link` varchar(255) NOT NULL,
							`pinterest_link` varchar(255) NOT NULL,
							`wesbsite_link` varchar(255) NOT NULL,	
							`whatsapp_link` varchar(255) NOT NULL,	
							PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
			            ");
				
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_products` (
  							`id` int(11) NOT NULL AUTO_INCREMENT,
  							`seller_id` int(11) NOT NULL,
  							`product_id` int(11) NOT NULL,
							`is_featured` int(11) NOT NULL,
							`is_category_featured` int(11) NOT NULL,
							`delivery_address` varchar(255) NOT NULL,
							`deliveraddresslat` varchar(255) NOT NULL,
							`deliveraddresslon` varchar(255) NULL,
  							`is_approved` tinyint(1) NOT NULL,
  							`created_at` date NOT NULL,
  							`updated_at` date NOT NULL,
							`vacation` tinyint(1) NOT NULL,
  							PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
						");
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_orders` (
  							`id` int(11) NOT NULL AUTO_INCREMENT,
  							`seller_id` int(11) NOT NULL,
  							`product_id` int(11) NOT NULL,
  							`order_id` int(11) NOT NULL,
  							`shipping` decimal(6,2) NOT NULL,
  							`quantity` int(11) NOT NULL,
  							`unit_price` decimal(10,2) NOT NULL,
  							`total_price` decimal(10,2) NOT NULL,
  							`order_status_id` int(3) NOT NULL,
  							`created_at` date NOT NULL,
  							`updated_at` date NOT NULL,
							`seen` int(11) NOT NULL DEFAULT '1',
  							PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
						");
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_order_total` (
  							`order_total_id` int(11) NOT NULL AUTO_INCREMENT,
  							`order_id` int(11) NOT NULL,
  							`seller_id` int(11) NOT NULL,
  							`code` varchar(32) NOT NULL,
  							`title` varchar(255) NOT NULL,
  							`value` decimal(15,4) NOT NULL,
  							`sort_order` int(3) NOT NULL,
  							PRIMARY KEY (`order_total_id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
						");
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_orders_history` (
  							`id` int(11) NOT NULL AUTO_INCREMENT,
  							`seller_id` int(11) NOT NULL,
  							`order_id` int(11) NOT NULL,
  							`order_status_id` int(11) NOT NULL,
  							`comment` varchar(250) NOT NULL,
							`notify` tinyint(1) NOT NULL,
  							`created_at` date NOT NULL,
  							PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
						");
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_reviews` (
  							`id` int(11) NOT NULL AUTO_INCREMENT,
  							`seller_id` int(11) NOT NULL,
  							`customer_id` int(11) NOT NULL,
  							`review_title` varchar(150) NOT NULL,
  							`review_description` text NOT NULL,
  							`rating` int(11) NOT NULL,
  							`status` tinyint(1) NOT NULL,
  							`created_at` date NOT NULL,
  							`updated_at` date NOT NULL,
  							PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
						");
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_commissions` (
  							`id` int(11) NOT NULL AUTO_INCREMENT,
  							`seller_id` int(11) NOT NULL,
  							`order_id` int(11) NOT NULL,
  							`product_id` int(11) NOT NULL,
							`vendor_order_table_id` int(11) NOT NULL,
							`commission_fixed` double NOT NULL DEFAULT '0',
							`commission_percent` decimal(4,2) NOT NULL DEFAULT '0.00',
							`commission_shipping` float(8,2) NOT NULL DEFAULT '0.00',
							`invoice_status` int(50) NOT NULL DEFAULT '0',
  							`commission` decimal(10,2) NOT NULL,
  							`status` varchar(50) NOT NULL,
  							`created_at` date NOT NULL,
  							`updated_at` date NOT NULL,
  							PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
						");
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_payments` (
  							`id` int(11) NOT NULL AUTO_INCREMENT,
  							`invoice_id` int(11) NOT NULL,
  							`seller_id` int(11) NOT NULL,
  							`transaction_id` varchar(20) NOT NULL,
  							`amount` decimal(10,2) NOT NULL,
  							`payment_mode` varchar(50) NOT NULL,
  							`status` varchar(50) NOT NULL,
  							`created_at` date NOT NULL,
  							`updated_at` date NOT NULL,
  							PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
						");
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_contact` (
							  `id` int(10) NOT NULL AUTO_INCREMENT,
							  `seller_id` int(10) NOT NULL,
							  `customer_id` int(10) NOT NULL,
							  `contact_from` int(10) NOT NULL,
							  `customer_name` varchar(150) NOT NULL,
							  `customer_email` varchar(150) NOT NULL,
							  `customer_message` text NOT NULL,
							  `created_at` datetime NOT NULL,
							  `updated_at` datetime NOT NULL,
							  `seen` int(11) NOT NULL DEFAULT '1',
							  PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
					");
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_categories_commission` (
  							`id` int(11) NOT NULL AUTO_INCREMENT,
  							`category_id` int(11) NOT NULL,
  							`commission` decimal(4,2) NOT NULL,
							`commison_fixed` double NULL DEFAULT NULL,
  							`seller_group` int(50) NOT NULL DEFAULT '1',
  							PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
						");	
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_shipping` (
							`id` int(11) NOT NULL AUTO_INCREMENT,
							`seller_id` int(11) NOT NULL,
							`shipping_country` int(11) NOT NULL,
							`zipcode_from` varchar(11) NOT NULL,
							`zipcode_to` varchar(11) NOT NULL,
							`shipping_price` decimal(15,2) NOT NULL,
							`weight_from` decimal(15,2) NOT NULL,
							`weight_to` decimal(15,2) NOT NULL,
							`max_days` int(11) NOT NULL,
							PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
						");
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_downloads` (
  							`id` int(11) NOT NULL AUTO_INCREMENT,
  							`download_id` int(11) NOT NULL,
  							`seller_id` int(11) NOT NULL,
  							PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
						");	
						// Subscription Plan
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_plan_invoice_status` (
					`status_id` int(11) NOT NULL AUTO_INCREMENT,
					`created_date` datetime NOT NULL,
					`modified_date` datetime NOT NULL,
					PRIMARY KEY (`status_id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
			");
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_coupons` (
				`coupon_id` int(11) NOT NULL AUTO_INCREMENT,
				`seller_id` int(11) NOT NULL,
				PRIMARY KEY (`coupon_id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
			");
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_attribute` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`seller_id` int(11) NOT NULL,
				`attribute_id` int(11) NOT NULL,
				PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
			");		
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_attribute_group` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`seller_id` int(11) NOT NULL,
				`attribute_group_id` int(11) NOT NULL,
				PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
			");		
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_option` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`seller_id` int(11) NOT NULL,
				`option_id` int(11) NOT NULL,
				PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
			");
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_plan_invoice_status_l` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`status_id` int(11) NOT NULL,
				`language_id` int(11) NOT NULL,
				`status` varchar(30) NOT NULL,
				PRIMARY KEY (`id`),FOREIGN KEY (`status_id`) REFERENCES " . DB_PREFIX . "purpletree_vendor_plan_invoice_status(`status_id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
			");
			
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_plan` (
				`plan_id` int(11) NOT NULL AUTO_INCREMENT,
				`no_of_product` int(11) NOT NULL,
				`no_of_featured_product` int(10) NOT NULL,
				`no_of_category_featured_product` int(10) NOT NULL,
				`featured_store` int(10) NOT NULL,
				`joining_fee` decimal(15,4) NOT NULL,
				`subscription_price` decimal(15,4) NOT NULL,
				`validity` int(11) NOT NULL,
				`default_subscription_plan` int(1) NOT NULL,
				`status` int(1) NOT NULL,
				`created_date` datetime NOT NULL,
				`modified_date` datetime NOT NULL,
				PRIMARY KEY (`plan_id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
			");	
			
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_plan_description` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`plan_id` int(11) NOT NULL,
				`language_id` int(11) NOT NULL,
				`plan_name` varchar(30) NOT NULL,
				`plan_description` TEXT NOT NULL,
				`plan_short_description` TEXT NOT NULL,
				PRIMARY KEY (`id`),FOREIGN KEY (`plan_id`) REFERENCES " . DB_PREFIX . "purpletree_vendor_plan(`plan_id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
			");	
				
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_seller_plan` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`invoice_id` int(11) NOT NULL,
				`plan_id` int(11) NOT NULL,
				`seller_id` int(11) NOT NULL,
				`reminder` int(1) NOT NULL,
				`reminder1` int(1) NOT NULL,
				`reminder2` int(1) NOT NULL,
				`status` int(1) NOT NULL,
				`new_status` int(1) NOT NULL,
				`start_date` datetime NOT NULL,
				`end_date` datetime NOT NULL,
				`new_end_date` datetime NOT NULL,
				`created_date` datetime NOT NULL,
				`modified_date` datetime NOT NULL,
				PRIMARY KEY (`id`),FOREIGN KEY (`plan_id`) REFERENCES " . DB_PREFIX . "purpletree_vendor_plan(`plan_id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
			");	
			
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_plan_invoice` (
				`invoice_id` int(11) NOT NULL AUTO_INCREMENT,
				`seller_id` int(11) NOT NULL,
				`plan_id` int(11) NOT NULL,
				`payment_mode` varchar(30) NOT NULL,
				`status_id` int(11) NOT NULL,
				`created_date` datetime NOT NULL,
				PRIMARY KEY (`invoice_id`),FOREIGN KEY (`plan_id`) REFERENCES " . DB_PREFIX . "purpletree_vendor_plan(`plan_id`),FOREIGN KEY (`status_id`) REFERENCES " . DB_PREFIX . "purpletree_vendor_plan_invoice_status(`status_id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
			");	
			
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_plan_invoice_item` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`invoice_id` int(11) NOT NULL,
				`code` varchar(30) NOT NULL,
				`title` varchar(30) NOT NULL,
				`price` decimal(15,4) NOT NULL,
				`sort_order` int(11) NOT NULL,
				PRIMARY KEY (`id`),FOREIGN KEY (`invoice_id`) REFERENCES " . DB_PREFIX . "purpletree_vendor_plan_invoice(`invoice_id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
			");	

				$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_plan_invoice_history` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`invoice_id` int(11) NOT NULL,
				`status_id` int(11) NOT NULL,
				`payment_mode` varchar(30) NOT NULL,
				`transaction_id` varchar(30) NOT NULL,
				`comment` text NOT NULL,
				`created_date` datetime NOT NULL,
				`modified_date` datetime NOT NULL,
				PRIMARY KEY (`id`),FOREIGN KEY (`invoice_id`) REFERENCES " . DB_PREFIX . "purpletree_vendor_plan_invoice(`invoice_id`),FOREIGN KEY (`status_id`) REFERENCES " . DB_PREFIX . "purpletree_vendor_plan_invoice_status(`status_id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
			");
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_plan_subscription` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`seller_id` int(11) NOT NULL,
				`status_id` int(1) NOT NULL,
				`created_date` datetime NOT NULL,
				`modified_date` datetime NOT NULL,
				PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
			");
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_customfield` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`custom_field_id` int(11) NOT NULL,
				`step_location` varchar(30) NOT NULL,
				PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
			");
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_commission_invoice_items` (
  							`id` int(11) NOT NULL AUTO_INCREMENT,
							`commission_id` int(11) NOT NULL,
							`link_id` int(50) NOT NULL,
  							`order_id` int(50) NOT NULL,
  							`product_id` int(50) NOT NULL,
  							`seller_id` int(50) NOT NULL,
  							`commission_fixed` double NOT NULL DEFAULT '0',
  							`commission_percent` decimal(4,2) NOT NULL DEFAULT '0.00',
  							`commission_shipping` decimal(4,2) NOT NULL DEFAULT '0.00',
  							`total_commission` float(8,2) NOT NULL,
  							PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
						");
						$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_commission_invoice` (
  							`id` int(11) NOT NULL AUTO_INCREMENT,
							`total_amount` decimal(11,2) NOT NULL DEFAULT '0.00',
							`total_commission` decimal(11,2) NOT NULL DEFAULT '0.00',
							`total_pay_amount` decimal(11,2) NOT NULL DEFAULT '0.00',
							`seller_coupon_amount` decimal(11,2) NOT NULL,
  							`created_at` date NOT NULL,
  							PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
						");
					// Pending
			$querry = $this->db->query("SELECT * FROM " . DB_PREFIX . "purpletree_vendor_plan_invoice_status WHERE status_id = 1");
			if($querry->num_rows){} else {
			$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_plan_invoice_status SET status_id = '1', created_date = NOW(), modified_date = NOW()");
			
			$status_id = $this->db->getLastId();   
			
			$this->load->model('localisation/language');            
		    $languages = $this->model_localisation_language->getLanguages();
			
			foreach ($languages as $language_id ) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_plan_invoice_status_l SET status_id = '" . (int)$status_id . "', language_id = '" . (int)$language_id['language_id'] . "', status = 'Pending'");
			}
			}
			// Pending
			// Complete
			$querry1 = $this->db->query("SELECT * FROM " . DB_PREFIX . "purpletree_vendor_plan_invoice_status WHERE status_id = 2");
			if($querry1->num_rows){} else {
			$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_plan_invoice_status SET status_id = '2', created_date = NOW(), modified_date = NOW()");
			
			$status_id = $this->db->getLastId();   
			
			$this->load->model('localisation/language');            
		    $languages = $this->model_localisation_language->getLanguages();
			
			foreach ($languages as $language_id ) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_plan_invoice_status_l SET status_id = '" . (int)$status_id . "', language_id = '" . (int)$language_id['language_id'] . "', status = 'Complete'");
		}
			}
			// Complete
		// Subscription Plan
		       // Start seller blog
					$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_blog_post` (
  							`blog_post_id` int(11) NOT NULL AUTO_INCREMENT,
							`seller_id` int(11) NOT NULL,
  							`image` varchar(255) NOT NULL, 
 							`author` varchar(150) NOT NULL,
  							`sort_order` int(11) NOT NULL,
							`status` tinyint(1) NOT NULL,
							`created_at` datetime NOT NULL,
  							`updated_at` datetime NOT NULL, 							
							PRIMARY KEY (`blog_post_id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
						");
						
                  $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_blog_post_comment` (
  							`blog_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  							`blog_post_id` int(11) NOT NULL,
  							`name` varchar(150) NOT NULL,
  							`email_id` varchar(150) NOT NULL,
  							`text` text NOT NULL,
							`status` tinyint(1) NOT NULL,
							`created_at` datetime NOT NULL,
  							`updated_at` datetime NOT NULL,
  							PRIMARY KEY (`blog_comment_id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
						");
						
				$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_blog_post_description` (
  							`blog_post_id` int(11) NOT NULL,
  							`language_id` int(11) NOT NULL,
  							`title` varchar(255) NOT NULL,
  							`description` text NOT NULL,
							`meta_title` varchar(255) NOT NULL,
  							`meta_description` varchar(255) NOT NULL,
  							`meta_keyword` varchar(255) NOT NULL,
  							`post_tags` varchar(255) NOT NULL)
							CHARACTER SET utf8 COLLATE utf8_unicode_ci
						");
						// End seller blog
						$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_payment_settlement_history` (
  							`id` int(11) NOT NULL AUTO_INCREMENT,
  							`invoice_id` int(11) NOT NULL,
  							`status_id` int(11) NOT NULL,
  							`payment_mode` varchar(50) NOT NULL,
  							`transaction_id` varchar(50) NOT NULL,
  							`comment` text NOT NULL,
							`created_date` datetime NOT NULL,
  							`modified_date` datetime NOT NULL, 	
							PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
						");	
				$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_enquiries` (
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`seller_id` int(11) NOT NULL,
					`contact_from` int(11) NOT NULL,
					`message` varchar(3000) NOT NULL,
					`created_at` datetime NOT NULL,
					`updated_at` datetime NOT NULL, 
					`seen` int(11) NOT NULL DEFAULT '1',					
					PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
				");
									

	$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_subscription_products` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`product_id` int(11) NOT NULL,
				`product_plan_id` int(11) NOT NULL,
				`featured_product_plan_id` int(11) NOT NULL,
				`category_featured_product_plan_id` varchar(255) NOT NULL,
				PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
		");	
    $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_template` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`product_id` int(11) NOT NULL,
				`status` tinyint(1) NOT NULL DEFAULT '0',		
				PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
		");  
	// stripe account
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_stripe_account` (				
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`seller_id` int(11) NOT NULL,
			`account_id` varchar(100) NOT NULL,
			`livemode` tinyint(1) NOT NULL DEFAULT '0',
			`scope` varchar(100) NOT NULL,
			`created_date` datetime NOT NULL,
			PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
			");	
	// stripe account	
 	$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_allowed_category` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`seller_id` int(11) NOT NULL,
				`category_id` varchar(255) NOT NULL,
				`type` tinyint(1) NOT NULL DEFAULT '1',				
				PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
		"); 	
    $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_template_products` (				
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`template_id` int(11) NOT NULL,
				`seller_id` int(11) NOT NULL,
				`quantity` int(4) NOT NULL DEFAULT '0',
				`price` decimal(15,4) NOT NULL DEFAULT '0.0000',
				`stock_status_id` int(11) NOT NULL,
				`subtract` tinyint(1) NOT NULL DEFAULT '1',
				`t_description` text NOT NULL,
				`comment` text NOT NULL,
				`status` tinyint(1) NOT NULL DEFAULT '0',				
				PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
		");	
      $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_cart` (				
				`id` int(11) NOT NULL AUTO_INCREMENT,
                `cart_id` int(11) NOT NULL,
                `seller_id` int(11) NOT NULL,				
                `template_product_id` int(11) NOT NULL,				
				PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
		");		

		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_adaptive_paykey` (
							`id` int(11) NOT NULL AUTO_INCREMENT,
							`order_id` int(11) NOT NULL,
							`payment_key` VARCHAR(50) NOT NULL,
							PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
						");	
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_products_return` (				
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`return_id` int(11) NOT NULL,
					`order_id` int(11) NOT NULL,
					`product_id` int(11) NOT NULL,
					`seller_id` int(11) NOT NULL,				
					`status` tinyint(1) NOT NULL DEFAULT '0',
					`created_date` datetime NOT NULL,
					`modified_date` datetime NOT NULL, 
					PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
				");			
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_geozone` (				
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`geo_zone_id` int(11) NOT NULL,
					`seller_id` int(11) NOT NULL,
					`weight_from` decimal(15,4) NOT NULL,
					`weight_to` decimal(15,4) NOT NULL,
					`price` decimal(15,4) NOT NULL,
					PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
		");
		//// quick order ////
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_quick_order_product` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`seller_id` int(11) NOT NULL,
				`product_id` int(11) NOT NULL,
				`status` tinyint(1) NOT NULL,
				PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
			");
		//// end quick order ////
		///////  Start email  template ///////
		///////  Start seller email ///////
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_email` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`language_code` varchar(256) NOT NULL,
			`email_code` varchar(256) NOT NULL,
			`title` varchar(256) NOT NULL,
			`subject` varchar(256) NOT NULL,
			`new_subject` varchar(256) NOT NULL,
			`message` text NOT NULL,
			`new_message` text NOT NULL,
			`note` varchar(256) NOT NULL,
			`note_subject` varchar(256) NOT NULL,
			`type` varchar(256) NOT NULL,
			PRIMARY KEY (`id`)  ) CHARACTER SET utf8 COLLATE utf8_unicode_ci
			");
			//// vacation mode  ////
		    $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_store_time` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`store_id` int(11) NOT NULL,
				`day_id` int(11) NOT NULL,
				`day_name` varchar(30) NOT NULL,
				`open_time` time NOT NULL,
				`close_time` time NOT NULL,
				PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
			");
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_holiday` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`store_id` int(11) NOT NULL,
		        `date` date NOT NULL,	
				PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
			");
			//// vacation mode  ////
			
			// cusotmer seller enquiries 
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_customer_vendor_enquiries` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`chat_id` int(11) NOT NULL,
				`image_name` varchar(255) NOT NULL,
				`image` varchar(255) NOT NULL,
				PRIMARY KEY (`id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
			");
			// cusotmer seller enquiries 
			//// Seller area /////
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_area` (
				`area_id` int(11) NOT NULL AUTO_INCREMENT,
				`language_id` int(11) NOT NULL,
				`area_name` varchar(150) NOT NULL,				
				`sort_order` int(11) NOT NULL,
				`status` tinyint(1) NOT NULL,
				PRIMARY KEY (`area_id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
			");	
			
			$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_vendor_area_discaription` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`area_id` int(11) NOT NULL,
				`language_id` int(11) NOT NULL,
				`area_name` varchar(150) NOT NULL,		
				PRIMARY KEY (`id`),FOREIGN KEY (`area_id`) REFERENCES " . DB_PREFIX . "purpletree_vendor_area(`area_id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci
			");
		// template product options	
				
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_temp_product_option` (
				`product_option_id` int(11) NOT NULL AUTO_INCREMENT,
				`product_id` int(11) NOT NULL,
				`temp_product_id` int(11) NOT NULL,
				`option_id` int(11) NOT NULL,
				`value` text NOT NULL,
				PRIMARY KEY (`product_option_id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci");
				
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "purpletree_temp_product_option_value` (
				`product_option_value_id` int(11) NOT NULL AUTO_INCREMENT,
				`product_option_id` int(11) NOT NULL,
				`product_id` int(11) NOT NULL,
				`temp_product_id` int(11) NOT NULL,
				`seller_id` int(11) NOT NULL,
				`option_id` int(11) NOT NULL,
				`option_value_id` int(11) NOT NULL,
				`quantity` int(3) NOT NULL,
				`subtract` tinyint(1) NOT NULL,
				`price` float(15,4) NOT NULL,
				`price_prefix` varchar(1) NOT NULL,
				PRIMARY KEY (`product_option_value_id`)) CHARACTER SET utf8 COLLATE utf8_unicode_ci");
				
		// template product options	
		//// Seller area /////
		
		####----Start Metal code-----####
		# create new fields metal and price_extra in table product if not exists
		    $field_query = $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "product` LIKE 'metal'");
			$field1_query = $this->db->query("SET SESSION sql_mode =''");
			if (!$field_query->num_rows) {
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "product`  ADD `metal` INT(1) NOT NULL DEFAULT '0' AFTER `product_id`");
			}
			
			$field_query = $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "product` LIKE 'price_extra'");
			if (!$field_query->num_rows) {
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "product`  ADD `price_extra` DECIMAL(15,4) NOT NULL DEFAULT '0.00' AFTER `price`");
			}
			
			$field_query = $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "product` LIKE 'price_extra_type'");
			if (!$field_query->num_rows) {
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "product`  ADD `price_extra_type` INT(1) NOT NULL DEFAULT '0' AFTER `price`");
			}
		####----Edit Metal code-----####
		////per product shipping///
		$field_query = $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "product` LIKE 'shipping_charge'");
		if (!$field_query->num_rows) {
	     $this->db->query("ALTER TABLE `" . DB_PREFIX . "product`  ADD `shipping_charge` double NULL DEFAULT NULL AFTER `shipping`");
		}
		///end pre product shipping ///
		###---Seller return---###
		 $field_query = $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "return_history` LIKE 'seller_id'");
		    $field1_query = $this->db->query("SET SESSION sql_mode =''");
			if (!$field_query->num_rows) {
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "return_history`  ADD `seller_id` int(11) NULL DEFAULT NULL AFTER `return_id`");
			}
		###---End Seller return ---###
/////-------------------Seller Email Template-------------------------/////
//$this->load->model('extension/purpletree_multivendor/upgradedatabase');
//$this->model_extension_purpletree_multivendor_upgradedatabase->addtemplateinsert();
//////-------------------End email template------------------------///////
			}
			}
	}
	
	private function addEvent(array $events): void {
		$this->load->model('setting/event');
		if(!empty($events)){
			if(version_compare(VERSION, '4.0.0.0', '>')){
				foreach($events as $key=>$value){
				$this->model_setting_event->addEvent($value);
				}
			} else {
				foreach($events as $key=>$value){
					$event = $this->model_setting_event->getEventByCode($value['code']);
					if(empty($event)){
					$this->model_setting_event->addEvent($value['code'], $value['description'],$value['trigger'],$value['action']);	
					}
				}
			}
		}
	}
	
	private function deleteEvent( array $events ): void {
		$this->load->model('setting/event');
		if(!empty($events)){
			foreach($events as $key=>$value){
				$this->model_setting_event->deleteEventByCode($value['code']);
			}	
		}		
	}
		public function index(): void {
			$this->load->language('extension/purpletree_multivendor/customer/ptscustomer');
			$this->load->language('extension/purpletree_multivendor/module/purpletree_multivendor');
			$this->document->addStyle('../extension/purpletree_multivendor/admin/view/javascript/purpletreecss/commonstylesheet.css');
			$this->document->setTitle($this->language->get('heading_title'));
			$data['version'] = "Version 4.0.0.0";
			$this->load->model('setting/setting'); 
			$this->load->model('localisation/order_status');
			$data['order_statuses'] = array();
			$data['order_statuses1'] = $this->model_localisation_order_status->getOrderStatuses();
			
			$dashboard_icons=array(
				'orders_icons'	        =>'Orders',
				'messages_icons'          =>'Admin Messages',
				'enquiries_icons'         =>'Customer Enquiries',
				'plan_icons'	           =>'Subscription Plan',
				'reviews_icons'           =>'My reviews',
				'downloads_icons'         =>'Downloads',
				'view_store_icons'        =>'View Store',
				'store_information_icons' =>'Store Information',
				'products_icons'          =>'Products',
				'blog_icons'	          =>'Blog',
				'blog_comments_icons'     =>'Blog Comments',
				'product_temp_icons'      =>'Product Template',
				'upload_icons'            =>'Bulk Product Upload',
				'payments_icons'	       =>'Payments',
				'commissions_icons'       =>'Commissions',
				'comm_invoices_icons'     =>'Commission Invoices',
				'shipping_rates_icons'	  =>'Shipping Rates',
				'returns_icons'           =>'Returns',
				'sub_invoice_icons'       =>'Subscription Invoice',
				'seller_coupons_icons'    =>'Seller Coupons',
				'summary_icons'           =>'Summary',
				'remove_as_seller_icons'  =>'Remove as a seller',
				'sales_icons'             =>'Sales',
				'dashboard_iconss'         =>'Dashboard',
				'pass_icons'              =>'Password',
				'catalog_icons'           =>'Catalog',
				'log_icons_icons'               =>'Logout',
				'admin_approval_icons'    =>'Admin Seller Approval'
 				);
				foreach($dashboard_icons as $key=>$value){
				        
				   $all_icons[]=array(
								'id'=>$key
							   );
				  
				}
			  foreach($all_icons as $key=>$allow_icon_status){
			      $all_selected_icone[$key]= $allow_icon_status['id'];
			  }
			  
			foreach($data['order_statuses1'] as $ordersstatus) {
				if($ordersstatus['name'] != 'Canceled' && $ordersstatus['name'] != 'Canceled Reversal' &&  $ordersstatus['name'] != 'Chargeback' && $ordersstatus['name'] != 'Denied' && $ordersstatus['name'] != 'Expired' && $ordersstatus['name'] != 'Failed' && $ordersstatus['name'] != 'Refunded' && $ordersstatus['name'] != 'Reversed' && $ordersstatus['name'] != 'Voided' ) {
					$data['order_statuses'][] = array(
					'order_status_id' => $ordersstatus['order_status_id'],
					'name' => $ordersstatus['name']
					);
				}
			}
			///////refund
			$data['return_actions'] = array();			
			$this->load->model('localisation/return_action');
			$data['return_actions'] = $this->model_localisation_return_action->getReturnActions();
			///////refund
			/* if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
				echo "<pre>";
				print_r($this->request->post);				
				echo "</pre>";				
				die;
			}  */
			
			foreach($data['order_statuses1'] as $ordersstatus) {
			  $order_status[]= $ordersstatus['order_status_id'];
			}
			if (($this->request->server['REQUEST_METHOD'] == 'POST')){
				if($this->validate()) {
				if(isset($this->request->post['module_purpletree_multivendor_allow_order_status'])){				      
				       $this->request->post['module_purpletree_multivendor_allow_order_status'] = serialize($this->request->post['module_purpletree_multivendor_allow_order_status']);
					   }else{
					   
						   if(null ===$this->config->get('module_purpletree_multivendor_allow_order_status')){
						
						   $this->request->post['module_purpletree_multivendor_allow_order_status'] = serialize($order_status);
						   }else{
							 $this->request->post['module_purpletree_multivendor_allow_order_status'] = array();
						   }
					   }
					    if(empty($this->request->post['module_purpletree_multivendor_icons_status'])){		   
						   if(null ===$this->config->get('module_purpletree_multivendor_icons_status')){
						    $this->request->post['module_purpletree_multivendor_icons_status'] = $all_selected_icone;
						   }else{
							 $this->request->post['module_purpletree_multivendor_icons_status'] = '';
						   }
					   }
					/* if($this->request->post['module_purpletree_multivendor_validate_text']==0 || !$this->config->get('module_purpletree_multivendor_status')){  */
					$module	    	= 'purpletree_multivendor_oc';
					
					if($_SERVER['HTTP_HOST'] == 'localhost') {
						$domain = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];
						
						} else {
						$domain = 'http://'.$_SERVER['HTTP_HOST'];
					} 
					$valuee = $this->request->post['module_purpletree_multivendor_process_data'];
					$ip_address = $this->get_client_ip();
					$url = "https://www.process.purpletreesoftware.com/occheckdata.php";
					$handle=curl_init($url);					
					curl_setopt($handle, CURLOPT_VERBOSE, true);
					curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($handle, CURLOPT_POSTFIELDS,
					"process_data=$valuee&domain_name=$domain&ip_address=$ip_address&module_name=$module");
					$result = curl_exec($handle);
					$result1 = json_decode($result);
					if(curl_error($handle))
					{
						echo 'error';
						die;
					}
					$ip_a = $_SERVER['HTTP_HOST'];
					////$ip_a = '122.177.1.229';
					if ($result1->status == 'success') {
						if (preg_match('(localhost|demo|test)',$domain)) {
							$str = 'qtriangle.in';
							$this->request->post['module_purpletree_multivendor_encypt_text'] = md5($str);
							$this->request->post['module_purpletree_multivendor_live_validate_text']=0;
							} elseif(str_replace(array(':', '.'), '', $ip_a)) {
							if(is_numeric($ip_a)){
								$str = 'qtriangle.in';
								$this->request->post['module_purpletree_multivendor_encypt_text'] = md5($str);
								$this->request->post['module_purpletree_multivendor_live_validate_text']=0;
							}
							}  else {
							$this->request->post['module_purpletree_multivendor_encypt_text'] = md5($domain);
							$this->request->post['module_purpletree_multivendor_live_validate_text']=1;
						}
						$this->request->post['module_purpletree_multivendor_validate_text']=1;
						if((int)$this->request->post['module_purpletree_multivendor_seller_invoice']){
							unset($this->request->post['module_purpletree_multivendor_hide_customer_details']);
						}
						$this->model_setting_setting->editSetting('module_purpletree_multivendor', $this->request->post);
						
						$this->session->data['success'] = $this->language->get('text_success');
						} else {
						$this->session->data['warning'] = $this->language->get('text_license_error');
					} 
					/* } else {
						$this->model_setting_setting->editSetting('module_purpletree_multivendor', $this->request->post);
						
						$this->session->data['success'] = $this->language->get('text_success');
					}  */
					
					if(isset($this->request->post['module_purpletree_multivendor_status'])) {
						
						$check_price_extension = $this->db->query("SELECT `code` FROM " . DB_PREFIX . "extension WHERE code = 'purpletree_sellerprice'");	
						if($check_price_extension->num_rows){  } else {
							$this->db->query("INSERT INTO " . DB_PREFIX . "extension SET type = 'module', extension ='purpletree_multivendor', code = 'purpletree_sellerprice'");
						}
						$check_price_extension2 = $this->db->query("SELECT `code` FROM " . DB_PREFIX . "setting WHERE code = 'module_purpletree_multivendor' AND `key`= 'module_purpletree_sellerprice_status'");	
						if($check_price_extension2->num_rows){
							$this->db->query("UPDATE `" . DB_PREFIX . "setting` SET `value` = '1' WHERE code = 'module_purpletree_multivendor' AND `key`= 'module_purpletree_sellerprice_status'");
							} else {
							
							$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`, `code`, `key`, `value`, `serialized`) VALUES ('0', 'module_purpletree_multivendor', 'module_purpletree_sellerprice_status', '1', '0')");
						}
						$check_price_extension3 = $this->db->query("Select layout_id FROM " . DB_PREFIX . "layout WHERE name = 'Product'");
						if($check_price_extension3->num_rows) { 
							
							$check_price_extension4 = $this->db->query("Select `code` FROM " . DB_PREFIX . "layout_module WHERE code = 'purpletree_multivendor.purpletree_sellerprice'");
							if($check_price_extension4->num_rows) { } else {
								$this->db->query("INSERT INTO " . DB_PREFIX . "layout_module SET layout_id = '".$check_price_extension3->row['layout_id']."', code = 'purpletree_multivendor.purpletree_sellerprice', position = 'column_right', sort_order = '-1'");
							}
						}
					    $check_sellerdetail_extension = $this->db->query("SELECT `code` FROM " . DB_PREFIX . "extension WHERE code = 'purpletree_sellerdetail'");	
						if($check_sellerdetail_extension->num_rows){  } else {
							$this->db->query("INSERT INTO " . DB_PREFIX . "extension SET type = 'module', extension='purpletree_multivendor', code = 'purpletree_sellerdetail'");
						}
						$check_sellerdetail_extension2 = $this->db->query("SELECT `code` FROM " . DB_PREFIX . "setting WHERE code = 'module_purpletree_multivendor' AND `key`= 'module_purpletree_sellerdetail_status'");	
						if($check_sellerdetail_extension2->num_rows){
							$this->db->query("UPDATE `" . DB_PREFIX . "setting` SET `value` = '1' WHERE code = 'module_purpletree_multivendor' AND `key`= 'module_purpletree_sellerdetail_status'");
							} else {
							
							$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`, `code`, `key`, `value`, `serialized`) VALUES ('0', 'module_purpletree_multivendor', 'module_purpletree_sellerdetail_status', '1', '0')");
						}
						$check_sellerdetail_extension3 = $this->db->query("Select layout_id FROM " . DB_PREFIX . "layout WHERE name = 'Product'");
						if($check_sellerdetail_extension3->num_rows) { 
							
							$check_sellerdetail_extension4 = $this->db->query("Select `code` FROM " . DB_PREFIX . "layout_module WHERE code = 'purpletree_multivendor.purpletree_sellerdetail'");
							if($check_sellerdetail_extension4->num_rows) { } else {
								$this->db->query("INSERT INTO " . DB_PREFIX . "layout_module SET layout_id = '".$check_sellerdetail_extension3->row['layout_id']."', code = 'purpletree_multivendor.purpletree_sellerdetail', position = 'column_right', sort_order = '-1'");
							}
						}	
					}
					$this->response->redirect($this->url->link('extension/purpletree_multivendor/module/purpletree_multivendor', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
					
					} else {
					$this->error['warning'] = $this->language->get('form_error_warning');//'Chek cthe form carefyully';
				}
			}
			$data['heading_title'] = $this->language->get('heading_title');
			$data['vendor_heading'] = $this->language->get('vendor_heading');
			$data['order_heading'] = $this->language->get('order_heading');
			$data['seller_product_heading'] = $this->language->get('seller_product_heading');
			$data['seller_review_heading'] = $this->language->get('seller_review_heading');
			$data['seller_email_heading'] = $this->language->get('seller_email_heading');
			$data['seller_store_heading'] = $this->language->get('seller_store_heading');
			
			$data['text_edit'] = $this->language->get('text_edit');
			$data['text_enabled'] = $this->language->get('text_enabled');
			$data['text_disabled'] = $this->language->get('text_disabled');
			$data['text_yes'] = $this->language->get('text_yes');
			$data['text_no'] = $this->language->get('text_no');
			$data['text_allowed_categories'] = $this->language->get('text_allowed_categories');
			$data['text_selected_categories'] = $this->language->get('text_selected_categories');
			$data['text_assign_categories'] = $this->language->get('text_assign_categories');
			$data['text_store_email'] = $this->language->get('text_store_email');
			$data['text_store_phone'] = $this->language->get('text_store_phone');
			$data['text_store_address'] = $this->language->get('text_store_address');
			
			$data['entry_status'] = $this->language->get('entry_status');
			$data['entry_commission'] = $this->language->get('entry_commission');
			$data['entry_commission_status'] = $this->language->get('entry_commission_status');
			$data['please_select'] = $this->language->get('please_select');
			$data['entry_seller_manage_order'] = $this->language->get('entry_seller_manage_order');
			$data['entry_customer_manage_order'] = $this->language->get('entry_customer_manage_order');//quick order
			$data['entry_seller_approval'] = $this->language->get('entry_seller_approval');
			$data['entry_product_approval'] = $this->language->get('entry_product_approval');
			$data['entry_product_edit_approval'] = $this->language->get('entry_product_edit_approval');
			$data['entry_allow_category'] = $this->language->get('entry_allow_category');
			$data['entry_seller_login'] = $this->language->get('entry_seller_login');
			$data['entry_order_approval'] = $this->language->get('entry_order_approval');
			$data['entry_allow_related'] = $this->language->get('entry_allow_related');
			$data['entry_limit_purchase'] = $this->language->get('entry_limit_purchase');
			$data['entry_allow_metals'] = $this->language->get('entry_allow_metals');
			$data['entry_seller_review'] = $this->language->get('entry_seller_review');
			$data['entry_license'] = $this->language->get('entry_license');
			$data['entry_seller_store'] = $this->language->get('entry_seller_store');
			$data['entry_seller_mode'] = $this->language->get('entry_seller_mode');
			$data['entry_seller_invoice'] = $this->language->get('entry_seller_invoice');
			$data['entry_order_id'] = $this->language->get('entry_order_id');
			$data['entry_email_id'] = $this->language->get('entry_email_id');
			$data['entry_allow_live_chat'] = $this->language->get('entry_allow_live_chat');
			$data['allow_browse_sellers'] = $this->language->get('allow_browse_sellers');
			$data['entry_refund_status'] = $this->language->get('entry_refund_status');
			
			$data['button_save'] = $this->language->get('button_save');
			$data['button_cancel'] = $this->language->get('button_cancel');
			$data['button_get_license'] = $this->language->get('change_license_key');
			if(null === $this->config->get('module_purpletree_multivendor_process_data') || $this->config->get('module_purpletree_multivendor_process_data') == '') {
				$data['button_get_license'] = $this->language->get('button_get_license');
			}
			$data['button_submit'] = $this->language->get('button_submit');
			$data['error_order_id'] = $this->language->get('error_order_id');
			$data['error_email_id'] = $this->language->get('error_email_id');
			$data['please_wait'] = $this->language->get('please_wait');
			$data['text_seller_logedin'] = $this->language->get('text_seller_logedin');
			$data['text_seller_general'] = $this->language->get('text_seller_general');
			$data['entry_seller_contact'] = $this->language->get('entry_seller_contact');
			$data['seller_contact_heading'] = $this->language->get('seller_contact_heading');
			$data['button_ok'] = $this->language->get('button_ok');
			$data['enter_license_key1'] = $this->language->get('enter_license_key1');
			$data['dont_have_lisence_key'] = $this->language->get('dont_have_lisence_key');
			$data['paypal_hosted_button_id'] = $this->language->get('paypal_hosted_button_id');
			$data['entry_featured_enabled_hide_edit'] = $this->language->get('entry_featured_enabled_hide_edit');
			$data['entry_seller_featured_product'] = $this->language->get('entry_seller_featured_product');
			$data['entry_seller_category_featured_product'] = $this->language->get('entry_seller_category_featured_product');
			///////category for single product///////
			$data['entry_seller_product_category'] = $this->language->get('entry_seller_product_category');
			$data['text_single'] = $this->language->get('text_single');
			$data['text_multiple'] = $this->language->get('text_multiple');
			/////////////////////////////
			$data['entry_shipping_commission'] = $this->language->get('entry_shipping_commission');
			$data['commission_from_seller_group'] = $this->language->get('commission_from_seller_group');
			$data['text_store_social_link'] = $this->language->get('text_store_social_link');//social link
			/////////////////Start seller Blog setting/////////////////
			$data['seller_blog_heading']    = $this->language->get('seller_blog_heading');
			$data['text_sort_order']    = $this->language->get('text_sort_order');
			$data['text_create_date_order']    = $this->language->get('text_create_date_order');
			$data['entry_seller_sort_by']    = $this->language->get('entry_seller_sort_by');
			/////////////////End  seller Blog setting/////////////////
			$data['text_seller_product_template']    = $this->language->get('text_seller_product_template');
			$data['text_allow_seller_to_reply_customer'] = $this->language->get('text_allow_seller_to_reply_customer');
			
			/// product view /////
			$data['entry_products_view'] = $this->language->get('entry_products_view');
			$data['text_list'] = $this->language->get('text_list');
			$data['text_grid'] = $this->language->get('text_grid');
			/// End product view ///// 
			
			$data['entry_seller_info_success'] = $this->language->get('entry_seller_info_success');
			if (isset($this->error['warning'])) {
				$data['error_warning'] = $this->error['warning'];
				} elseif(isset($this->session->data['warning'])){ 
				$data['error_warning'] = $this->session->data['warning'];
				unset($this->session->data['warning']);
				} else {
				$data['error_warning'] = '';
			}
			
			if(isset($this->session->data['success'])) {
				$data['success'] = $this->session->data['success'];
				unset($this->session->data['success']);
				} else {
				$data['success'] = '';
			}
			
			if (isset($this->error['commission'])) {
				$data['commission_error'] = $this->error['commission'];
			} 
			if (isset($this->error['commission_status'])) {
				$data['commission_status_error'] = $this->error['commission_status'];
			} 
			
			if (isset($this->error['shipping_commission_error'])) {
				$data['shipping_commission_error'] = $this->error['shipping_commission_error'];
			} 
			
			if (isset($this->error['product_limit'])) {
				$data['product_limit_error'] = $this->error['product_limit'];
			} 
			
			if (isset($this->error['process_data'])) {
				$data['error_warning'] = $this->error['process_data'];
			} 
			//subscription plan tax value
			if (isset($this->error['tax_name'])) {
				$data['tax_name_error'] = $this->error['tax_name'];
			} 
			if (isset($this->error['tax_value'])) {
				$data['tax_value_error'] = $this->error['tax_value'];
			} 
			if (isset($this->error['grace_period'])) {
				$data['error_grace_period'] = $this->error['grace_period'];
			} 
			
			if (isset($this->error['reminder_one_days'])) {
				$data['error_reminder_one_days'] = $this->error['reminder_one_days'];
			} 
			if (isset($this->error['reminder_two_days'])) {
				$data['error_reminder_two_days'] = $this->error['reminder_two_days'];
			} 
			if (isset($this->error['reminder_three_days'])) {
				$data['error_reminder_three_days'] = $this->error['reminder_three_days'];
			}
			if (isset($this->error['paypal_email'])) {
				$data['error_paypal_email'] = $this->error['paypal_email'];
			}
			
			///Help code///				
			//$data['helplink'] = "https://www.purpletreesoftware.com/knowledgebase/tag/opencart-multivendor-settings";
			$data['helplink'] = "https://cutt.ly/ICo4U9h";
			if (defined ('DISABLED_PTS_HELP')){if(DISABLED_PTS_HELP == 0){$data['helpcheck'] = 1;}else{$data['helpcheck'] = 0;}}else{$data['helpcheck'] = 1;}
			$data['helpimage'] = HTTP_CATALOG . '/extension/purpletree_multivendor/admin/view/image/help.png';
			
			/// End Help code///
			$data['breadcrumbs'] = array();
			
			$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
			);
			
			$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
			);
			
			$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/purpletree_multivendor/module/purpletree_multivendor', 'user_token=' . $this->session->data['user_token'], true)
			);
			
			$data['action'] = $this->url->link('extension/purpletree_multivendor/module/purpletree_multivendor', 'user_token=' . $this->session->data['user_token'], true);
			
			$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);
			$data['text_normal_mode'] = $this->language->get('text_normal_mode');
			$data['text_category_mode'] = $this->language->get('text_category_mode');
			$data['text_service_mode'] = $this->language->get('text_service_mode');
			
			if (isset($this->request->post['module_purpletree_multivendor_status'])) {
				$data['module_purpletree_multivendor_status'] = $this->request->post['module_purpletree_multivendor_status'];
				} else {
				$data['module_purpletree_multivendor_status'] = $this->config->get('module_purpletree_multivendor_status');
			}
			
			if (isset($this->request->post['module_purpletree_multivendor_process_data'])) {
				$data['module_purpletree_multivendor_process_data'] = $this->request->post['module_purpletree_multivendor_process_data'];
				} else {
				$data['module_purpletree_multivendor_process_data'] = $this->config->get('module_purpletree_multivendor_process_data');
			}
			
			if (isset($this->request->post['module_purpletree_multivendor_validate_text'])) {
				$data['module_purpletree_multivendor_validate_text'] = 1;
				} else {
				$data['module_purpletree_multivendor_validate_text'] = $this->config->get('module_purpletree_multivendor_validate_text');
			}
			
			if (isset($this->request->post['module_purpletree_multivendor_live_validate_text'])) {
				$data['module_purpletree_multivendor_live_validate_text'] = 0;
				} else {
				$data['module_purpletree_multivendor_live_validate_text'] = $this->config->get('module_purpletree_multivendor_live_validate_text');
			}
			
			if (isset($this->request->post['module_purpletree_multivendor_encypt_text'])) {
				$str = 'qtriangle.in';
				$data['module_purpletree_multivendor_encypt_text'] = md5($str);
				} else {
				$data['module_purpletree_multivendor_encypt_text'] = $this->config->get('module_purpletree_multivendor_encypt_text');
			}
			if(isset($this->request->post['module_purpletree_multivendor_shippingtype'])){
				$data['module_purpletree_multivendor_shippingtype'] = $this->request->post['module_purpletree_multivendor_shippingtype'];
				} elseif(NULL !== $this->config->get('module_purpletree_multivendor_shippingtype')){
				$data['module_purpletree_multivendor_shippingtype'] = $this->config->get('module_purpletree_multivendor_shippingtype');
				} else {
				$data['module_purpletree_multivendor_shippingtype'] = "0";
			}			
			if (isset($this->request->post['module_purpletree_multivendor_commission'])) {
				$data['module_purpletree_multivendor_commission'] = $this->request->post['module_purpletree_multivendor_commission'];
				} elseif($this->config->get('module_purpletree_multivendor_commission') || $this->config->get('module_purpletree_multivendor_commission') == '0') {
				$data['module_purpletree_multivendor_commission'] = $this->config->get('module_purpletree_multivendor_commission');
				} else {
				$data['module_purpletree_multivendor_commission'] = "10";
			}
			///*** Fix commission ***///			
			$data['text_fix_commission'] = $this->language->get('text_fix_commission');
			if (isset($this->request->post['module_purpletree_multivendor_fix_commission'])) {
				$data['module_purpletree_multivendor_fix_commission'] = $this->request->post['module_purpletree_multivendor_fix_commission'];
				} elseif($this->config->get('module_purpletree_multivendor_fix_commission')){
				$data['module_purpletree_multivendor_fix_commission'] = $this->config->get('module_purpletree_multivendor_fix_commission');
				} else {
				$data['module_purpletree_multivendor_fix_commission'] = "0";
			}
			///*** End fix commission ***///
			if (isset($this->request->post['module_purpletree_multivendor_commission_status'])) {
				$data['module_purpletree_multivendor_commission_status'] = $this->request->post['module_purpletree_multivendor_commission_status'];
				} else {
				$data['module_purpletree_multivendor_commission_status'] = $this->config->get('module_purpletree_multivendor_commission_status');
			}
			
			/////////////////refund
			if (isset($this->request->post['module_purpletree_multivendor_refund_status'])) {
				$data['module_purpletree_multivendor_refund_status'] = $this->request->post['module_purpletree_multivendor_refund_status'];
				} else {
				$data['module_purpletree_multivendor_refund_status'] = $this->config->get('module_purpletree_multivendor_refund_status');
			}
			//////////////
			
			if (isset($this->request->post['module_purpletree_multivendor_seller_manage_order'])) {
				$data['module_purpletree_multivendor_seller_manage_order'] = $this->request->post['module_purpletree_multivendor_seller_manage_order'];
				} else {
				$data['module_purpletree_multivendor_seller_manage_order'] = $this->config->get('module_purpletree_multivendor_seller_manage_order');
			}
			
			///quick order
			if (defined('QUICK_ORDER') && QUICK_ORDER == 1 ){
			     $data['quick_order_check'] = QUICK_ORDER;
				}
				if (isset($this->request->post['module_purpletree_multivendor_customer_manage_order'])) {
				$data['module_purpletree_multivendor_customer_manage_order'] = $this->request->post['module_purpletree_multivendor_customer_manage_order'];
				} else {
				$data['module_purpletree_multivendor_customer_manage_order'] = $this->config->get('module_purpletree_multivendor_customer_manage_order');
				}
			$this->load->model('localisation/order_status');

		     $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
			 	if (isset($this->request->post['module_purpletree_multivendor_allow_order_status'])) {
				$data['allow_order_statuse'] = Unserialize($this->request->post['module_purpletree_multivendor_allow_order_status']);
				} else {
				if(empty($this->config->get('module_purpletree_multivendor_allow_order_status') )){				    
					 $data['allow_order_statuse'] = '';
					}else{						
				  $data['allow_order_statuse'] = Unserialize($this->config->get('module_purpletree_multivendor_allow_order_status'));
			    }
			}
			
			if(!empty($data['allow_order_statuse'])){
			$allow_order_statuse = array_flip($data['allow_order_statuse']);
			foreach($data['allow_order_statuse'] as $key=>$value){
				$allow_order_statuse1[$value]='selected';
			}
			}			
			foreach($data['order_statuses'] as $key => $value){
			    $allow_order_statuse4 ='';
				if(isset($allow_order_statuse1[$value['order_status_id']])){
				   $allow_order_statuse4= 'selected';
					}
			    $data['allow_order_statuse3'][] = array(
				'order_status_id' => $value['order_status_id'],
				'name' => $value['name'],
				'selected' => $allow_order_statuse4
				);
				
				}
				//echo"<pre>";print_r($data['allow_order_statuse3']);die;
			$data['all'] = 0;
			if(isset($data['allow_order_statuse'][0])){
			    $data['all'] = $data['allow_order_statuse'][0];
			}
			if (isset($this->request->post['module_purpletree_multivendor_seller_info_on_order_sucess'])) {
				$data['module_purpletree_multivendor_seller_info_on_order_sucess'] = $this->request->post['module_purpletree_multivendor_seller_info_on_order_sucess'];
				} else {
				$data['module_purpletree_multivendor_seller_info_on_order_sucess'] = $this->config->get('module_purpletree_multivendor_seller_info_on_order_sucess');
			}
			if (isset($this->request->post['module_purpletree_multivendor_quick_order_tab_position'])) {
				$data['module_purpletree_multivendor_quick_order_tab_position'] = $this->request->post['module_purpletree_multivendor_quick_order_tab_position'];
				} else {
				$data['module_purpletree_multivendor_quick_order_tab_position'] = $this->config->get('module_purpletree_multivendor_quick_order_tab_position');
			}
			if (isset($this->request->post['module_purpletree_multivendor_quick_order_api'])) {
				$data['module_purpletree_multivendor_quick_order_api'] = $this->request->post['module_purpletree_multivendor_quick_order_api'];
				} else {
				$data['module_purpletree_multivendor_quick_order_api'] = $this->config->get('module_purpletree_multivendor_quick_order_api');
			}
			/// end quick order

			           ///dashboard icons

			if (isset($this->request->post['module_purpletree_multivendor_icons_status'])) {
				$data['module_purpletree_multivendor_icons_status'] = $this->request->post['module_purpletree_multivendor_icons_status'];
				} else {
				$data['module_purpletree_multivendor_icons_status'] = $this->config->get('module_purpletree_multivendor_icons_status');
			}			 
			 	if (isset($this->request->post['module_purpletree_multivendor_icons_status'])) {
				$data['allow_icon_statuse'] =$this->request->post['module_purpletree_multivendor_icons_status'];
				} else {
                    
                     $allow_icon_statuse =$this->config->get('module_purpletree_multivendor_icons_status');
                 
                         
                         if(empty($allow_icon_statuse)){
							$allow_icon_statuse=array('no_value');
                         }	

					      foreach($dashboard_icons as $key=>$value){
				          if(in_array($key,$allow_icon_statuse)){
				              $data['allow_icon_statuse'][]=array(
				                              'id'=>$key,
				                              'value'=>$value,
				                              'selected'=>'selected'
				                           );
				          } else {
				           $data['allow_icon_statuse'][]=array(
				                            'id'=>$key,
				                            'value'=>$value,
				                            'selected'=>''
				                           );
				               }	
						    }
						}
					
	
         /// End dashboard icons section
         /// start Hyper local 

			if (isset($this->request->post['module_purpletree_multivendor_hyperlocal_status'])) {
				$data['module_purpletree_multivendor_hyperlocal_status'] = $this->request->post['module_purpletree_multivendor_hyperlocal_status'];
				}else {
				$data['module_purpletree_multivendor_hyperlocal_status'] = $this->config->get('module_purpletree_multivendor_hyperlocal_status');
			}
			
			if (isset($this->request->post['module_purpletree_multivendor_hyperlocal_type'])) {
				$data['module_purpletree_multivendor_hyperlocal_type'] = $this->request->post['module_purpletree_multivendor_hyperlocal_type'];
				}else {
				$data['module_purpletree_multivendor_hyperlocal_type'] = $this->config->get('module_purpletree_multivendor_hyperlocal_type');
			}
			
			$data['seller_area_link'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerarea', 'user_token=' . $this->session->data['user_token'], true);
 
		///	end hyper local	

		/// hyper local pop up heading 

			if(isset($this->request->post['module_purpletree_multivendor_hp_heading'])){
				$data['module_purpletree_multivendor_hp_heading'] = $this->request->post['module_purpletree_multivendor_hp_heading'];
				} elseif($this->config->get('module_purpletree_multivendor_hp_heading')){
				$data['module_purpletree_multivendor_hp_heading'] = $this->config->get('module_purpletree_multivendor_hp_heading');
				} else {
				$data['module_purpletree_multivendor_hp_heading'] = $this->language->get('text_hyper_delivering');
			}

             if (isset($this->request->post['module_purpletree_multivendor_area_status'])) {
				$data['module_purpletree_multivendor_area_status'] = $this->request->post['module_purpletree_multivendor_area_status'];
				} else {
				$data['module_purpletree_multivendor_area_status'] = $this->config->get('module_purpletree_multivendor_area_status');
			}				
		///	end hyper local	pop up heading 				
			if (isset($this->request->post['module_purpletree_multivendor_seller_approval'])) {
				$data['module_purpletree_multivendor_seller_approval'] = $this->request->post['module_purpletree_multivendor_seller_approval'];
				} else {
				$data['module_purpletree_multivendor_seller_approval'] = $this->config->get('module_purpletree_multivendor_seller_approval');
			}
			
			
			if (isset($this->request->post['module_purpletree_multivendor_product_approval'])) {
				$data['module_purpletree_multivendor_product_approval'] = $this->request->post['module_purpletree_multivendor_product_approval'];
				} else {
				$data['module_purpletree_multivendor_product_approval'] = $this->config->get('module_purpletree_multivendor_product_approval');
			}
			
			if (isset($this->request->post['module_purpletree_multivendor_allow_categorytype'])) {
				$data['module_purpletree_multivendor_allow_categorytype'] = $this->request->post['module_purpletree_multivendor_allow_categorytype'];
				} else {
				$data['module_purpletree_multivendor_allow_categorytype'] = $this->config->get('module_purpletree_multivendor_allow_categorytype');
			}
			$data['module_purpletree_multivendor_allow_category1'] = array();
			
			if (isset($this->request->post['module_purpletree_multivendor_allow_category'])) {
				$data['module_purpletree_multivendor_allow_category'] = $this->request->post['module_purpletree_multivendor_allow_category'];
				$data['module_purpletree_multivendor_allow_category1'] = $this->request->post['module_purpletree_multivendor_allow_category'];
				} elseif($this->config->get('module_purpletree_multivendor_allow_category')) {
				$data['module_purpletree_multivendor_allow_category'] = $this->config->get('module_purpletree_multivendor_allow_category');
				$data['module_purpletree_multivendor_allow_category1'] = $this->config->get('module_purpletree_multivendor_allow_category');
				} else {
				$data['module_purpletree_multivendor_allow_category'] = array();
				$data['module_purpletree_multivendor_allow_category1'] = array();
			}
			$data['module_purpletree_multivendor_allow_category'] = array();
			$this->load->model('catalog/category');
			$results = $this->model_catalog_category->getCategories();
			foreach ($results as $result) {
				if($data['module_purpletree_multivendor_allow_categorytype']) {
					
					$data['module_purpletree_multivendor_allow_category'][strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))] = $result['category_id'];
					} else {
					if(in_array($result['category_id'],$data['module_purpletree_multivendor_allow_category1'])) {
						$data['module_purpletree_multivendor_allow_category'][strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))] = $result['category_id'];
					}
				}
			}
			
			//////category for single product///////
			if (isset($this->request->post['module_purpletree_multivendor_seller_product_category'])) {
				$data['module_purpletree_multivendor_seller_product_category'] = $this->request->post['module_purpletree_multivendor_seller_product_category'];
				} else {
				$data['module_purpletree_multivendor_seller_product_category'] = $this->config->get('module_purpletree_multivendor_seller_product_category');
			}
			////////////////////////////////////////
			if(isset($this->request->post['module_purpletree_multivendor_seller_login'])){
				$data['module_purpletree_multivendor_seller_login'] = $this->request->post['module_purpletree_multivendor_seller_login'];
				} elseif(NULL !== $this->config->get('module_purpletree_multivendor_seller_login')){
				$data['module_purpletree_multivendor_seller_login'] = $this->config->get('module_purpletree_multivendor_seller_login');
				} else {
				$data['module_purpletree_multivendor_seller_login'] = "1";
			}	
			if (isset($this->request->post['module_purpletree_multivendor_storepage_layout'])) {
				$data['module_purpletree_multivendor_storepage_layout'] = $this->request->post['module_purpletree_multivendor_storepage_layout'];
				} else {
				$data['module_purpletree_multivendor_storepage_layout'] = $this->config->get('module_purpletree_multivendor_storepage_layout');
			}	
			/// Product view ///
				if (isset($this->request->post['module_purpletree_multivendor_products_view'])) {
				$data['module_purpletree_multivendor_products_view'] = $this->request->post['module_purpletree_multivendor_products_view'];
				} else {
				$data['module_purpletree_multivendor_products_view'] = $this->config->get('module_purpletree_multivendor_products_view');
			}	
			//// end  product view ///
			if (isset($this->request->post['module_purpletree_multivendor_allow_selleron_category'])) {
				$data['module_purpletree_multivendor_allow_selleron_category'] = $this->request->post['module_purpletree_multivendor_allow_selleron_category'];
				} else {
				$data['module_purpletree_multivendor_allow_selleron_category'] = $this->config->get('module_purpletree_multivendor_allow_selleron_category');
			}
			
			$data['entry_hide_seller_detail'] = $this->language->get('entry_hide_seller_detail');
			if (isset($this->request->post['module_purpletree_multivendor_hide_seller_detail'])) {
				$data['module_purpletree_multivendor_hide_seller_detail'] = $this->request->post['module_purpletree_multivendor_hide_seller_detail'];
				} else {
				$data['module_purpletree_multivendor_hide_seller_detail'] = $this->config->get('module_purpletree_multivendor_hide_seller_detail');
			}
			if (isset($this->request->post['module_purpletree_multivendor_template_description'])) {
				$data['module_purpletree_multivendor_template_description'] = $this->request->post['module_purpletree_multivendor_template_description'];
				} else {
				$data['module_purpletree_multivendor_template_description'] = $this->config->get('module_purpletree_multivendor_template_description');
			}	
				if (isset($this->request->post['module_purpletree_multivendor_temp_prod_price_list'])) {
				$data['module_purpletree_multivendor_temp_prod_price_list'] = $this->request->post['module_purpletree_multivendor_temp_prod_price_list'];
				} else {
				$data['module_purpletree_multivendor_temp_prod_price_list'] = $this->config->get('module_purpletree_multivendor_temp_prod_price_list');
			}			
			
			if (isset($this->request->post['module_purpletree_multivendor_featured_enabled_hide_edit'])) {
				$data['module_purpletree_multivendor_featured_enabled_hide_edit'] = $this->request->post['module_purpletree_multivendor_featured_enabled_hide_edit'];
				} else {
				$data['module_purpletree_multivendor_featured_enabled_hide_edit'] = $this->config->get('module_purpletree_multivendor_featured_enabled_hide_edit');
			}		
			if (isset($this->request->post['module_purpletree_multivendor_seller_featured_products'])) {
				$data['module_purpletree_multivendor_seller_featured_products'] = $this->request->post['module_purpletree_multivendor_seller_featured_products'];
				} else {
				$data['module_purpletree_multivendor_seller_featured_products'] = $this->config->get('module_purpletree_multivendor_seller_featured_products');
			}		
			if (isset($this->request->post['module_purpletree_multivendor_seller_category_featured'])) {
				$data['module_purpletree_multivendor_seller_category_featured'] = $this->request->post['module_purpletree_multivendor_seller_category_featured'];
				} else {
				$data['module_purpletree_multivendor_seller_category_featured'] = $this->config->get('module_purpletree_multivendor_seller_category_featured');
			}
			
			if (isset($this->request->post['module_purpletree_multivendor_allow_related_product'])) {
				$data['module_purpletree_multivendor_allow_related_product'] = $this->request->post['module_purpletree_multivendor_allow_related_product'];
				} else {
				$data['module_purpletree_multivendor_allow_related_product'] = $this->config->get('module_purpletree_multivendor_allow_related_product');
			}
			
			
			if (isset($this->request->post['module_purpletree_multivendor_product_limit'])) {
				$data['module_purpletree_multivendor_product_limit'] = $this->request->post['module_purpletree_multivendor_product_limit'];
				} elseif($this->config->get('module_purpletree_multivendor_product_limit') || $this->config->get('module_purpletree_multivendor_product_limit') == '0') {
				$data['module_purpletree_multivendor_product_limit'] = $this->config->get('module_purpletree_multivendor_product_limit');
				} else {
				$data['module_purpletree_multivendor_product_limit'] = "10";
			}
			if (isset($this->request->post['module_purpletree_multivendor_allow_metals_product'])) {
				$data['module_purpletree_multivendor_allow_metals_product'] = $this->request->post['module_purpletree_multivendor_allow_metals_product'];
				} else {
				$data['module_purpletree_multivendor_allow_metals_product'] = $this->config->get('module_purpletree_multivendor_allow_metals_product');
			}
			
			if (isset($this->request->post['module_purpletree_multivendor_seller_review'])) {
				$data['module_purpletree_multivendor_seller_review'] = $this->request->post['module_purpletree_multivendor_seller_review'];
				} else {
				$data['module_purpletree_multivendor_seller_review'] = $this->config->get('module_purpletree_multivendor_seller_review');
			}
			
            //////////Seller Name/////////
			
			if (isset($this->request->post['module_purpletree_multivendor_seller_name'])) {
				$data['module_purpletree_multivendor_seller_name'] = $this->request->post['module_purpletree_multivendor_seller_name'];
				} else {
				$data['module_purpletree_multivendor_seller_name'] = $this->config->get('module_purpletree_multivendor_seller_name');
			}
			
			//////////////////////////////      		
			if (isset($this->request->post['module_purpletree_multivendor_seller_contact'])) {
				$data['module_purpletree_multivendor_seller_contact'] = $this->request->post['module_purpletree_multivendor_seller_contact'];
				} else {
				$data['module_purpletree_multivendor_seller_contact'] = $this->config->get('module_purpletree_multivendor_seller_contact');
			}
			
			if (isset($this->request->post['module_purpletree_multivendor_store_email'])) {
				$data['module_purpletree_multivendor_store_email'] = $this->request->post['module_purpletree_multivendor_store_email'];
				} else {
				$data['module_purpletree_multivendor_store_email'] = $this->config->get('module_purpletree_multivendor_store_email');
			}
			
			if (isset($this->request->post['module_purpletree_multivendor_store_phone'])) {
				$data['module_purpletree_multivendor_store_phone'] = $this->request->post['module_purpletree_multivendor_store_phone'];
				} else {
				$data['module_purpletree_multivendor_store_phone'] = $this->config->get('module_purpletree_multivendor_store_phone');
			}
			
			if (isset($this->request->post['module_purpletree_multivendor_store_address'])) {
				$data['module_purpletree_multivendor_store_address'] = $this->request->post['module_purpletree_multivendor_store_address'];
				} else {
				$data['module_purpletree_multivendor_store_address'] = $this->config->get('module_purpletree_multivendor_store_address');
			}
			/////    Store social link   //////
			
			if (isset($this->request->post['module_purpletree_multivendor_store_social_link'])) {
				$data['module_purpletree_multivendor_store_social_link'] = $this->request->post['module_purpletree_multivendor_store_social_link'];
				} else {
				$data['module_purpletree_multivendor_store_social_link'] = $this->config->get('module_purpletree_multivendor_store_social_link');
			}
			////  Store social link end //////
			
			//// hide customer details /////
			if (isset($this->request->post['module_purpletree_multivendor_hide_customer_details'])) {
				$data['module_purpletree_multivendor_hide_customer_details'] = $this->request->post['module_purpletree_multivendor_hide_customer_details'];
				} else {
				$data['module_purpletree_multivendor_hide_customer_details'] = $this->config->get('module_purpletree_multivendor_hide_customer_details');
			}
			
			//// hide customer details /////
			if (isset($this->request->post['module_purpletree_multivendor_seller_invoice'])) {
				$data['module_purpletree_multivendor_seller_invoice'] = $this->request->post['module_purpletree_multivendor_seller_invoice'];
				} else {
				$data['module_purpletree_multivendor_seller_invoice'] = $this->config->get('module_purpletree_multivendor_seller_invoice');
			}
			// echo'<pre>';
			// print_r($data);
			// die;
			if (isset($this->request->post['module_purpletree_multivendor_allow_live_chat'])) {
				$data['module_purpletree_multivendor_allow_live_chat'] = $this->request->post['module_purpletree_multivendor_allow_live_chat'];
				} else {
				$data['module_purpletree_multivendor_allow_live_chat'] = $this->config->get('module_purpletree_multivendor_allow_live_chat');
			}
			if(isset($this->request->post['module_purpletree_multivendor_browse_sellers'])){
				$data['module_purpletree_multivendor_browse_sellers'] = $this->request->post['module_purpletree_multivendor_browse_sellers'];
				} elseif(NULL !== $this->config->get('module_purpletree_multivendor_browse_sellers')){
				$data['module_purpletree_multivendor_browse_sellers'] = $this->config->get('module_purpletree_multivendor_browse_sellers');
				} else {
				$data['module_purpletree_multivendor_browse_sellers'] = "1";
			}
			////Hide User Menu////
			if (isset($this->request->post['module_purpletree_multivendor_hide_user_menu'])) {
				$data['module_purpletree_multivendor_hide_user_menu'] = $this->request->post['module_purpletree_multivendor_hide_user_menu'];
				} else {
				$data['module_purpletree_multivendor_hide_user_menu'] = $this->config->get('module_purpletree_multivendor_hide_user_menu');
			}
			////End Hide User Menu////
			//Start domain wise store
			if (isset($this->request->post['module_purpletree_multivendor_multi_store'])) {
				$data['module_purpletree_multivendor_multi_store'] = $this->request->post['module_purpletree_multivendor_multi_store'];
				} else {
				$data['module_purpletree_multivendor_multi_store'] = $this->config->get('module_purpletree_multivendor_multi_store');
			}
			//End domain wise store
			
			if (isset($this->request->post['module_purpletree_multivendor_seller_contact'])) {
				$data['module_purpletree_multivendor_seller_contact'] = $this->request->post['module_purpletree_multivendor_seller_contact'];
				} else {
				$data['module_purpletree_multivendor_seller_contact'] = $this->config->get('module_purpletree_multivendor_seller_contact');
			}
			//subscription plan
			
			if(isset($this->request->post['module_purpletree_multivendor_subscription_plans'])){
				$data['module_purpletree_multivendor_subscription_plans'] = $this->request->post['module_purpletree_multivendor_subscription_plans'];
				} elseif($this->config->get('module_purpletree_multivendor_subscription_plans')){
				$data['module_purpletree_multivendor_subscription_plans'] = $this->config->get('module_purpletree_multivendor_subscription_plans');
				} else {
				$data['module_purpletree_multivendor_subscription_plans'] = "0";
			}
			if(isset($this->request->post['module_purpletree_multivendor_paypal_email'])){
				$data['module_purpletree_multivendor_paypal_email'] = $this->request->post['module_purpletree_multivendor_paypal_email'];
				} else{
				$data['module_purpletree_multivendor_paypal_email'] = $this->config->get('module_purpletree_multivendor_paypal_email');
			}
			
			if(isset($this->request->post['module_purpletree_multivendor_subscription_price'])){
				$data['module_purpletree_multivendor_subscription_price'] = $this->request->post['module_purpletree_multivendor_subscription_price'];
				} else{
				$data['module_purpletree_multivendor_subscription_price'] = $this->config->get('module_purpletree_multivendor_subscription_price');
			}
			if(isset($this->request->post['module_purpletree_multivendor_joining_fees'])){
				$data['module_purpletree_multivendor_joining_fees'] = $this->request->post['module_purpletree_multivendor_joining_fees'];
				} else{
				$data['module_purpletree_multivendor_joining_fees'] = $this->config->get('module_purpletree_multivendor_joining_fees');
			}
			if(isset($this->request->post['module_purpletree_multivendor_tax_name'])){
				$data['module_purpletree_multivendor_tax_name'] = $this->request->post['module_purpletree_multivendor_tax_name'];
				} elseif($this->config->get('module_purpletree_multivendor_tax_name') || $this->config->get('module_purpletree_multivendor_tax_name') == '0'){
				$data['module_purpletree_multivendor_tax_name'] = $this->config->get('module_purpletree_multivendor_tax_name');
				} else {
				$data['module_purpletree_multivendor_tax_name'] = "Tax";
			}
			if(isset($this->request->post['module_purpletree_multivendor_tax_value'])){
				$data['module_purpletree_multivendor_tax_value'] = $this->request->post['module_purpletree_multivendor_tax_value'];
				} elseif($this->config->get('module_purpletree_multivendor_tax_value') || $this->config->get('module_purpletree_multivendor_tax_value') == '0'){
				$data['module_purpletree_multivendor_tax_value'] = $this->config->get('module_purpletree_multivendor_tax_value');
				} else {
				$data['module_purpletree_multivendor_tax_value'] = "0";
			}
			
			if(isset($this->request->post['module_purpletree_multivendor_reminder_one_days'])){
				$data['module_purpletree_multivendor_reminder_one_days'] = $this->request->post['module_purpletree_multivendor_reminder_one_days'];
				} elseif($this->config->get('module_purpletree_multivendor_reminder_one_days') || $this->config->get('module_purpletree_multivendor_reminder_one_days') == '0'){
				$data['module_purpletree_multivendor_reminder_one_days'] = $this->config->get('module_purpletree_multivendor_reminder_one_days');
				} else {
				$data['module_purpletree_multivendor_reminder_one_days'] = "10";
			}
			
			if(isset($this->request->post['module_purpletree_multivendor_reminder_two_days'])){
				$data['module_purpletree_multivendor_reminder_two_days'] = $this->request->post['module_purpletree_multivendor_reminder_two_days'];
				} elseif($this->config->get('module_purpletree_multivendor_reminder_two_days') || $this->config->get('module_purpletree_multivendor_reminder_two_days') == '0'){
				$data['module_purpletree_multivendor_reminder_two_days'] = $this->config->get('module_purpletree_multivendor_reminder_two_days');
				} else {
				$data['module_purpletree_multivendor_reminder_two_days'] = "5";
			}
			if(isset($this->request->post['module_purpletree_multivendor_reminder_three_days'])){
				$data['module_purpletree_multivendor_reminder_three_days'] = $this->request->post['module_purpletree_multivendor_reminder_three_days'];
				} elseif($this->config->get('module_purpletree_multivendor_reminder_three_days') || $this->config->get('module_purpletree_multivendor_reminder_three_days') == '0'){
				$data['module_purpletree_multivendor_reminder_three_days'] = $this->config->get('module_purpletree_multivendor_reminder_three_days');
				} else {
				$data['module_purpletree_multivendor_reminder_three_days'] = "1";
			}
			if(isset($this->request->post['module_purpletree_multivendor_grace_period'])){
				$data['module_purpletree_multivendor_grace_period'] = $this->request->post['module_purpletree_multivendor_grace_period'];
				} elseif($this->config->get('module_purpletree_multivendor_grace_period') || $this->config->get('module_purpletree_multivendor_grace_period') == '0'){
				$data['module_purpletree_multivendor_grace_period'] = $this->config->get('module_purpletree_multivendor_grace_period');
				} else {
				$data['module_purpletree_multivendor_grace_period'] = "3";
			}
			if (isset($this->request->post['module_purpletree_multivendor_shipping_commission'])) {
				$data['module_purpletree_multivendor_shipping_commission'] = $this->request->post['module_purpletree_multivendor_shipping_commission'];
				} elseif($this->config->get('module_purpletree_multivendor_shipping_commission')  || $this->config->get('module_purpletree_multivendor_shipping_commission') == '0') {
				$data['module_purpletree_multivendor_shipping_commission'] = $this->config->get('module_purpletree_multivendor_shipping_commission');
				} else {
				$data['module_purpletree_multivendor_shipping_commission'] = "0";
			}
			if (isset($this->request->post['module_purpletree_multivendor_seller_group'])) {
				$data['module_purpletree_multivendor_seller_group'] = $this->request->post['module_purpletree_multivendor_seller_group'];
				} else {
				$data['module_purpletree_multivendor_seller_group'] = $this->config->get('module_purpletree_multivendor_seller_group');
			}
			if (isset($this->request->post['module_purpletree_multivendor_footer_text'])) {
				$data['module_purpletree_multivendor_footer_text'] = $this->request->post['module_purpletree_multivendor_footer_text'];
				} else {
				$data['module_purpletree_multivendor_footer_text'] = $this->config->get('module_purpletree_multivendor_footer_text');
			}
			
			///// development option //////
			if(isset($this->request->post['module_purpletree_multivendor_include_jquery'])){
				$data['module_purpletree_multivendor_include_jquery'] = $this->request->post['module_purpletree_multivendor_include_jquery'];
				} elseif(NULL !== $this->config->get('module_purpletree_multivendor_include_jquery')){
				$data['module_purpletree_multivendor_include_jquery'] = $this->config->get('module_purpletree_multivendor_include_jquery');
				} else {
				$data['module_purpletree_multivendor_include_jquery'] = "1";
			}
			///// development option //////
			
			//// Hide seller product tab ////
			$data['text_hide_seller_product_tab'] = $this->language->get('text_hide_seller_product_tab');
			if (isset($this->request->post['module_purpletree_multivendor_hide_seller_product_tab'])) {
				$data['module_purpletree_multivendor_hide_seller_product_tab'] = $this->request->post['module_purpletree_multivendor_hide_seller_product_tab'];
				} else {
				$data['module_purpletree_multivendor_hide_seller_product_tab'] = $this->config->get('module_purpletree_multivendor_hide_seller_product_tab');
			}
			//// End Hide seller product tab ////
			if (isset($this->request->post['module_purpletree_multivendor_seller_product_template'])) {
				$data['module_purpletree_multivendor_seller_product_template'] = $this->request->post['module_purpletree_multivendor_seller_product_template'];
				} else {
				$data['module_purpletree_multivendor_seller_product_template'] = $this->config->get('module_purpletree_multivendor_seller_product_template');
			}
			if(isset($this->request->post['module_purpletree_multivendor_multiple_subscription_plan_active'])){
				$data['module_purpletree_multivendor_multiple_subscription_plan_active'] = $this->request->post['module_purpletree_multivendor_multiple_subscription_plan_active'];
				} elseif($this->config->get('module_purpletree_multivendor_multiple_subscription_plan_active') || $this->config->get('module_purpletree_multivendor_multiple_subscription_plan_active') == '0'){
				$data['module_purpletree_multivendor_multiple_subscription_plan_active'] = $this->config->get('module_purpletree_multivendor_multiple_subscription_plan_active');
				} else {
				$data['module_purpletree_multivendor_multiple_subscription_plan_active'] = "0";
			}
			//paypal Currency
			$this->load->model('localisation/currency');
			
			$data['paypalcurrencies'] = $this->model_localisation_currency->getCurrencies();
			
			if (isset($this->request->post['module_purpletree_multivendor_paypal_currency'])) {
				$data['module_purpletree_multivendor_paypal_currency'] = $this->request->post['module_purpletree_multivendor_paypal_currency'];
				} else {
				$data['module_purpletree_multivendor_paypal_currency'] = (NULL != $this->config->get('module_purpletree_multivendor_paypal_currency'))?$this->config->get('module_purpletree_multivendor_paypal_currency'):$this->config->get('config_currency');
			}
			
			/////////////////Start seller Blog setting/////////////////
			if(isset($this->request->post['module_purpletree_multivendor_seller_blog_order'])){
				$data['module_purpletree_multivendor_seller_blog_order'] = $this->request->post['module_purpletree_multivendor_seller_blog_order'];
				} elseif($this->config->get('module_purpletree_multivendor_seller_blog_order') || $this->config->get('module_purpletree_multivendor_seller_blog_order') == '0'){
				$data['module_purpletree_multivendor_seller_blog_order'] = $this->config->get('module_purpletree_multivendor_seller_blog_order');
				} else {
				$data['module_purpletree_multivendor_seller_blog_order'] = "0";
			}	
			/////////////////End  seller Blog setting/////////////////
			
			/////////////////Start Quick order /////////////////
			$data['entry_show_seller_name'] = $this->language->get('entry_show_seller_name');
			$data['entry_show_seller_address'] = $this->language->get('entry_show_seller_address');
			if(isset($this->request->post['module_purpletree_multivendor_show_seller_name'])){
				$data['module_purpletree_multivendor_show_seller_name'] = $this->request->post['module_purpletree_multivendor_show_seller_name'];
				} elseif($this->config->get('module_purpletree_multivendor_show_seller_name')){
				$data['module_purpletree_multivendor_show_seller_name'] = $this->config->get('module_purpletree_multivendor_show_seller_name');
				} else {
				$data['module_purpletree_multivendor_show_seller_name'] = "0";
			}
			if(isset($this->request->post['module_purpletree_multivendor_show_seller_address'])){
				$data['module_purpletree_multivendor_show_seller_address'] = $this->request->post['module_purpletree_multivendor_show_seller_address'];
				} elseif($this->config->get('module_purpletree_multivendor_show_seller_address')){
				$data['module_purpletree_multivendor_show_seller_address'] = $this->config->get('module_purpletree_multivendor_show_seller_address');
				} else {
				$data['module_purpletree_multivendor_show_seller_address'] = "0";
			}
			/////////////////End  Quick order/////////////////
			
			/* hide seller registration field */
			if(isset($this->request->post['module_purpletree_multivendor_hide_reg'])){
				$data['module_purpletree_multivendor_hide_reg'] = $this->request->post['module_purpletree_multivendor_hide_reg'];
				} elseif($this->config->get('module_purpletree_multivendor_hide_reg')){
				$data['module_purpletree_multivendor_hide_reg'] = $this->config->get('module_purpletree_multivendor_hide_reg');
				} else {
				$data['module_purpletree_multivendor_hide_reg'] = array();
			}
$this->load->language('customer/customer');
$this->load->language('extension/purpletree_multivendor/multivendor/stores');

		$data['seller_reg_fields']=array();
		$data['seller_reg_fields']['personal_details'][] =	array(
			'field_required'=>true,
			'field_name'=>'firstname',
			'field_title'=>$this->language->get('entry_firstname')
			);
		$data['seller_reg_fields']['personal_details'][] =	array(
			'field_required'=>true,
			'field_name'=>'lastname',
			'field_title'=>$this->language->get('entry_lastname'),
			);
		$data['seller_reg_fields']['personal_details'][] =	array(
			'field_required'=>true,
			'field_name'=>'email',
			'field_title'=>$this->language->get('entry_email'),
			);		
		$data['seller_reg_fields']['personal_details'][] =	array(
			'field_required'=>true,
			'field_name'=>'password',
			'field_title'=>$this->language->get('text_password'),
			);		
		$data['seller_reg_fields']['personal_details'][] =	array(
			'field_required'=>true,
			'field_name'=>'confirm',
			'field_title'=>$this->language->get('text_confirm_password'),
			);	
		$data['seller_reg_fields']['personal_details'][] =	array(
			'field_required'=>true,
			'field_name'=>'telephone',
			'field_title'=>$this->language->get('entry_telephone'),
			);	
		$data['seller_reg_fields']['personal_details'][] =	array(
			'field_required'=>true,
			'field_name'=>'agree',
			'field_title'=>$this->language->get('text_agree'),
			);
		$data['seller_reg_fields']['seller_information'][] =	array(
			'field_required'=>true,
			'field_name'=>'store_name',
			'field_title'=>$this->language->get('column_storename'),
			);
		$data['seller_reg_fields']['seller_information'][] =	array(
			'field_required'=>false,
			'field_name'=>'store_phone',
			'field_title'=>$this->language->get('column_storephone'),
			);
			$data['seller_reg_fields']['seller_information'][] =	array(
			'field_required'=>false,
			'field_name'=>'store_logo',
			'field_title'=>$this->language->get('entry_storelogo'),
			);
			$data['seller_reg_fields']['seller_information'][] =	array(
			'field_required'=>false,
			'field_name'=>'store_banner',
			'field_title'=>$this->language->get('entry_storebanner'),
			);
			$data['seller_reg_fields']['seller_information'][] =	array(
			'field_required'=>false,
			'field_name'=>'store_address',
			'field_title'=>$this->language->get('entry_storeaddress'),
			);
			
			$data['seller_reg_fields']['seller_information'][] =	array(
			'field_required'=>false,
			'field_name'=>'store_country',
			'field_title'=>$this->language->get('entry_storecountry'),
			);
			$data['seller_reg_fields']['seller_information'][] =	array(
			'field_required'=>false,
			'field_name'=>'store_state',
			'field_title'=>$this->language->get('entry_storezone'),
			);
			$data['seller_reg_fields']['seller_information'][] =	array(
			'field_required'=>false,
			'field_name'=>'store_city',
			'field_title'=>$this->language->get('entry_storecity'),
			);
			$data['seller_reg_fields']['seller_information'][] =	array(
			'field_required'=>false,
			'field_name'=>'store_zipcode',
			'field_title'=>$this->language->get('entry_storepostcode'),
			);
			$data['seller_reg_fields']['seller_information'][] =	array(
			'field_required'=>false,
			'field_name'=>'sellerarea',
			'field_title'=>$this->language->get('entry_sellerarea'),
			);
			$data['seller_reg_fields']['seller_information'][] =	array(
			'field_required'=>false,
			'field_name'=>'store_shipping_policy',
			'field_title'=>$this->language->get('entry_storeshippingpolicy'),
			);
			
			$data['seller_reg_fields']['seller_information'][] =	array(
			'field_required'=>false,
			'field_name'=>'store_return_policy',
			'field_title'=>$this->language->get('entry_storereturn'),
			);
			
			
			$data['seller_reg_fields']['seller_information'][] =	array(
			'field_required'=>false,
			'field_name'=>'store_meta_keywords',
			'field_title'=>$this->language->get('entry_storemetakeyword'),
			);
			$data['seller_reg_fields']['seller_information'][] =	array(
			'field_required'=>false,
			'field_name'=>'store_meta_description',
			'field_title'=>$this->language->get('entry_storemetadescription'),
			);
			$data['seller_reg_fields']['seller_information'][] =	array(
			'field_required'=>false,
			'field_name'=>'store_seo',
			'field_title'=>$this->language->get('entry_storeseo'),
			);
			
			$data['seller_reg_fields']['seller_information'][] =	array(
			'field_required'=>false,
			'field_name'=>'facebook_link',
			'field_title'=>$this->language->get('entry_facebook'),
			);
			$data['seller_reg_fields']['seller_information'][] =	array(
			'field_required'=>false,
			'field_name'=>'twitter_link',
			'field_title'=>$this->language->get('entry_twitter'),
			);
			$data['seller_reg_fields']['seller_information'][] =	array(
			'field_required'=>false,
			'field_name'=>'instagram_link',
			'field_title'=>$this->language->get('entry_instagram'),
			);
			$data['seller_reg_fields']['seller_information'][] =	array(
			'field_required'=>false,
			'field_name'=>'pinterest_link',
			'field_title'=>$this->language->get('entry_printerest'),
			);
			$data['seller_reg_fields']['seller_information'][] =	array(
			'field_required'=>false,
			'field_name'=>'wesbsite_link',
			'field_title'=>$this->language->get('entry_website'),
			);
			$data['seller_reg_fields']['seller_information'][] =	array(
			'field_required'=>false,
			'field_name'=>'whatsapp_link',
			'field_title'=>$this->language->get('entry_whatsapp_number'),
			);
			
			$data['seller_reg_fields']['payment_details'][] =	array(
			'field_required'=>false,
			'field_name'=>'store_bank_details',
			'field_title'=>$this->language->get('entry_storebankdetail'),
			);
			$data['seller_reg_fields']['payment_details'][] =	array(
			'field_required'=>false,
			'field_name'=>'store_tin',
			'field_title'=>$this->language->get('entry_storetin'),
			);
			$data['seller_reg_fields']['payment_details'][] =	array(
			'field_required'=>false,
			'field_name'=>'seller_paypal_id',
			'field_title'=>$this->language->get('entry_seller_paypal_id'),
			);
			$data['personal_details']=$this->language->get('text_personal_details');
			$data['seller_information']=$this->language->get('text_seller_information');
			$data['payment_details']=$this->language->get('text_payment_details');

			/* hide seller registration field */
			
			//Allow seller to reply 
			if (isset($this->request->post['module_purpletree_multivendor_allow_seller_to_reply'])) {
				$data['module_purpletree_multivendor_allow_seller_to_reply'] = $this->request->post['module_purpletree_multivendor_allow_seller_to_reply'];
				} else {
				$data['module_purpletree_multivendor_allow_seller_to_reply'] = $this->config->get('module_purpletree_multivendor_allow_seller_to_reply');
			}  
		
			if (isset($this->request->post['module_purpletree_multivendor_seller_ac_terms'])) {
				$data['module_purpletree_multivendor_seller_ac_terms'] = $this->request->post['module_purpletree_multivendor_seller_ac_terms'];
				} else if($this->config->get('module_purpletree_multivendor_seller_ac_terms')!=null){
				$data['module_purpletree_multivendor_seller_ac_terms'] = $this->config->get('module_purpletree_multivendor_seller_ac_terms');
			}  else {
				$data['module_purpletree_multivendor_seller_ac_terms'] = $this->config->get('config_account_id');
			}
			
			$data['text_seller_ac_terms']=$this->language->get('text_seller_ac_terms');
			$this->load->model('catalog/information');
			$data['informations'] = $this->model_catalog_information->getInformations();
			
			$data['user_token'] = $this->session->data['user_token'];
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/module/purpletree_multivendor', $data));
		}
		
		public function get_client_ip() {
			$ipaddress = '';
			if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
			else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
			else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
			else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
			else if(getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
			else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
			else
			$ipaddress = 'UNKNOWN';
			return $ipaddress;
		}
		
		protected function validate() {
			if (!$this->user->hasPermission('modify', 'extension/purpletree_multivendor/module/purpletree_multivendor')) {
				$this->error['warning'] = $this->language->get('error_permission');
			}
			
			if(!isset($this->request->post['module_purpletree_multivendor_commission_status']) || $this->request->post['module_purpletree_multivendor_commission_status'] == '') {
				
				$this->error['commission_status'] = $this->language->get('error_commission_status');
			}
			if(!isset($this->request->post['module_purpletree_multivendor_commission'])){
				$this->error['commission'] = $this->language->get('error_commission');
				} else {
				if($this->request->post['module_purpletree_multivendor_commission'] > 100){
					
					$this->error['commission'] = $this->language->get('error_commission');			
					
					}elseif( ! filter_var($this->request->post['module_purpletree_multivendor_commission'], FILTER_VALIDATE_FLOAT) && $this->request->post['module_purpletree_multivendor_commission'] != '0' ){
					$this->error['commission'] = $this->language->get('error_commission');
					
					} elseif($this->request->post['module_purpletree_multivendor_commission'] < 0){
					$this->error['commission'] = $this->language->get('error_commission');
				}
			}
			if(!isset($this->request->post['module_purpletree_multivendor_process_data']) || strlen($this->request->post['module_purpletree_multivendor_process_data']) < 1 ){
				$this->error['process_data'] = $this->language->get('error_process_data');
			}
			
			if(!isset($this->request->post['module_purpletree_multivendor_product_limit'])){
				
				$this->error['product_limit'] = $this->language->get('error_product_limit');
				
				} else {
				
				if( ! filter_var($this->request->post['module_purpletree_multivendor_product_limit'], FILTER_VALIDATE_FLOAT) && $this->request->post['module_purpletree_multivendor_product_limit'] != '0' ){
					$this->error['product_limit'] = $this->language->get('error_product_limit');
					
					} elseif($this->request->post['module_purpletree_multivendor_product_limit'] < 0){
					$this->error['product_limit'] = $this->language->get('error_product_limit');
				}
			}
			//subscription plan tax value
			if(!isset($this->request->post['module_purpletree_multivendor_subscription_plans']) || $this->request->post['module_purpletree_multivendor_subscription_plans']){
				if(!isset($this->request->post['module_purpletree_multivendor_tax_value'])){
					$this->error['tax_value'] = $this->language->get('error_tax_value');
					} else {
					if($this->request->post['module_purpletree_multivendor_tax_value'] > 100){
						$this->error['tax_value'] = $this->language->get('error_tax_value');
						}elseif( ! filter_var($this->request->post['module_purpletree_multivendor_tax_value'], FILTER_VALIDATE_FLOAT) && $this->request->post['module_purpletree_multivendor_tax_value'] != '0' ){
						$this->error['tax_value'] = $this->language->get('error_tax_value');
						
						} elseif($this->request->post['module_purpletree_multivendor_tax_value'] < 0){
						$this->error['tax_value'] = $this->language->get('error_tax_value');
					}
					
				}
				
				
				if(!isset($this->request->post['module_purpletree_multivendor_tax_name']) || $this->request->post['module_purpletree_multivendor_tax_name'] =='' ){
					$this->error['tax_name'] = $this->language->get('error_tax_name');
				}
				
				if(!isset($this->request->post['module_purpletree_multivendor_reminder_one_days']) || !is_numeric($this->request->post['module_purpletree_multivendor_reminder_one_days']) || $this->request->post['module_purpletree_multivendor_reminder_one_days'] < 0 )
				{
					$this->error['reminder_one_days'] = $this->language->get('reminder_one_days_error');
				}
				if(!isset($this->request->post['module_purpletree_multivendor_reminder_two_days']) || !is_numeric($this->request->post['module_purpletree_multivendor_reminder_two_days']) || $this->request->post['module_purpletree_multivendor_reminder_two_days'] < 0){
					$this->error['reminder_two_days'] = $this->language->get('reminder_two_days_error');
				}
				if(!isset($this->request->post['module_purpletree_multivendor_reminder_three_days']) || !is_numeric($this->request->post['module_purpletree_multivendor_reminder_three_days']) || $this->request->post['module_purpletree_multivendor_reminder_three_days'] < 0 ){
					$this->error['reminder_three_days'] = $this->language->get('reminder_three_days_error');
				}
				if(!isset($this->request->post['module_purpletree_multivendor_grace_period']) || !is_numeric($this->request->post['module_purpletree_multivendor_grace_period']) || $this->request->post['module_purpletree_multivendor_grace_period'] < 0 ){
					$this->error['grace_period'] = $this->language->get('grace_period_error');
				}
			}
			if(!isset($this->request->post['module_purpletree_multivendor_shipping_commission'])){
				$this->error['shipping_commission_error'] = $this->language->get('error_shipping_commission');
				} else {
				if($this->request->post['module_purpletree_multivendor_shipping_commission'] > 100){
					
					$this->error['shipping_commission_error'] = $this->language->get('error_shipping_commission');			
					
					}elseif( ! filter_var($this->request->post['module_purpletree_multivendor_shipping_commission'], FILTER_VALIDATE_FLOAT) && $this->request->post['module_purpletree_multivendor_shipping_commission'] != '0' ){
					$this->error['shipping_commission_error'] = $this->language->get('error_shipping_commission');
					
					} elseif($this->request->post['module_purpletree_multivendor_shipping_commission'] < 0){
					$this->error['shipping_commission_error'] = $this->language->get('error_shipping_commission');
				}
			}
			if(isset($this->request->post['module_purpletree_multivendor_paypal_email']) && $this->request->post['module_purpletree_multivendor_paypal_email'] != ''){
				if ((strlen($this->request->post['module_purpletree_multivendor_paypal_email']) > 96) || !filter_var($this->request->post['module_purpletree_multivendor_paypal_email'], FILTER_VALIDATE_EMAIL)) {
					$this->error['paypal_email'] = $this->language->get('error_email_id');
				}
			}
			
			return !$this->error;
		}
		
		public function getSelectedCategory()
		{
			$json = array();
			$this->load->model('catalog/category');
			$results = $this->model_catalog_category->getCategories();
			if(!empty($results)){
				foreach ($results as $result) {
					
					$categories = $this->config->get('module_purpletree_multivendor_allow_category');
					if(!empty($categories)){
						if(in_array($result['category_id'],$categories)) {
							$json[] = array(
							'category_id' => $result['category_id'],
							'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
							);
						}
					}
				}
			} 
			/* if(!empty($categories)){
				foreach ($categories as $key => $value) {
				$json[] = array(
				'category_id' => $value,
				'name'        => strip_tags(html_entity_decode($key, ENT_QUOTES, 'UTF-8'))
				);
				}
			} */
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));
		}
	}?>
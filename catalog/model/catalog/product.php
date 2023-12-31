<?php
namespace Opencart\Catalog\Model\Catalog;
class Product extends \Opencart\System\Engine\Model {
	protected array $statement = [];

	public function __construct(\Opencart\System\Engine\Registry $registry) {
		$this->registry = $registry;

		// Storing some sub queries so that we are not typing them out multiple times.
		$this->statement['discount'] = "(SELECT `pd2`.`price` FROM `" . DB_PREFIX . "product_discount` `pd2` WHERE `pd2`.`product_id` = `p`.`product_id` AND `pd2`.`customer_group_id` = '" . (int)$this->config->get('config_customer_group_id') . "'AND `pd2`.`quantity` = '1' AND ((`pd2`.`date_start` = '0000-00-00' OR `pd2`.`date_start` < NOW()) AND (`pd2`.`date_end` = '0000-00-00' OR `pd2`.`date_end` > NOW())) ORDER BY `pd2`.`priority` ASC, `pd2`.`price` ASC LIMIT 1) AS `discount`";
		$this->statement['special'] = "(SELECT `ps`.`price` FROM `" . DB_PREFIX . "product_special` `ps` WHERE `ps`.`product_id` = `p`.`product_id` AND `ps`.`customer_group_id` = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((`ps`.`date_start` = '0000-00-00' OR `ps`.`date_start` < NOW()) AND (`ps`.`date_end` = '0000-00-00' OR `ps`.`date_end` > NOW())) ORDER BY `ps`.`priority` ASC, `ps`.`price` ASC LIMIT 1) AS `special`";
		$this->statement['reward'] = "(SELECT `pr`.`points` FROM `" . DB_PREFIX . "product_reward` `pr` WHERE `pr`.`product_id` = `p`.`product_id` AND `pr`.`customer_group_id` = '" . (int)$this->config->get('config_customer_group_id') . "') AS `reward`";
		$this->statement['review'] = "(SELECT COUNT(*) FROM `" . DB_PREFIX . "review` `r` WHERE `r`.`product_id` = `p`.`product_id` AND `r`.`status` = '1' GROUP BY `r`.`product_id`) AS `reviews`";
	}

	public function getProduct(int $product_id): array {
		$query = $this->db->query("SELECT DISTINCT *, pd.`name` , `p`.`image`, " . $this->statement['discount'] . ", " . $this->statement['special'] . ", " . $this->statement['reward'] . ", " . $this->statement['review']  . " FROM `" . DB_PREFIX . "product_to_store` `p2s` LEFT JOIN `" . DB_PREFIX . "product` `p` ON (`p`.`product_id` = `p2s`.`product_id` AND `p`.`status` = '1' AND `p`.`date_available` <= NOW()) LEFT JOIN `" . DB_PREFIX . "product_description` `pd` ON (`p`.`product_id` = `pd`.`product_id`) WHERE `p2s`.`store_id` = '" . (int)$this->config->get('config_store_id') . "' AND `p2s`.`product_id` = '" . (int)$product_id . "' AND `pd`.`language_id` = '" . (int)$this->config->get('config_language_id') . "'");

		if ($query->num_rows) {
			$product_data = $query->row;

			$product_data['variant'] = (array)json_decode($query->row['variant'], true);
			$product_data['override'] = (array)json_decode($query->row['override'], true);
			$product_data['price'] = (float)($query->row['discount'] ? $query->row['discount'] : $query->row['price']);
			$product_data['rating'] = (int)$query->row['rating'];
			$product_data['reviews'] = (int)$query->row['reviews'] ? $query->row['reviews'] : 0;

			return $product_data;
		} else {
			return [];
		}
	}

	public function getProducts(array $data = []): array {
		$sql = "SELECT DISTINCT *, pd.`name` , `p`.`image`, " . $this->statement['discount'] . ", " . $this->statement['special'] . ", " . $this->statement['reward'] . ", " . $this->statement['review'];

		if (!empty($data['filter_category_id'])) {
			$sql .= " FROM `" . DB_PREFIX . "category_to_store` `c2s`";

			if (!empty($data['filter_sub_category'])) {
				$sql .= " LEFT JOIN `" . DB_PREFIX . "category_path` `cp` ON (`cp`.`category_id` = `c2s`.`category_id` AND `c2s`.`store_id` = '" . (int)$this->config->get('config_store_id') . "') LEFT JOIN `" . DB_PREFIX . "product_to_category` `p2c` ON (`p2c`.`category_id` = `cp`.`category_id`)";
			} else {
				$sql .= " LEFT JOIN `" . DB_PREFIX . "product_to_category` `p2c` ON (`p2c`.`category_id` = `c2s`.`category_id` AND `c2s`.`store_id` = '" . (int)$this->config->get('config_store_id') . "')";
			}

			$sql .= " LEFT JOIN `" . DB_PREFIX . "product_to_store` `p2s` ON (`p2s`.`product_id` = `p2c`.`product_id` AND `p2s`.`store_id` = '" . (int)$this->config->get('config_store_id') . "')";

			if (!empty($data['filter_filter'])) {
				$sql .= " LEFT JOIN `" . DB_PREFIX . "product_filter` `pf` ON (`pf`.`product_id` = `p2s`.`product_id`) LEFT JOIN `" . DB_PREFIX . "product` `p` ON (`p`.`product_id` = `pf`.`product_id` AND `p`.`status` = '1' AND `p`.`date_available` <= NOW())";
			} else {
				$sql .= " LEFT JOIN `" . DB_PREFIX . "product` `p` ON (`p`.`product_id` = `p2s`.`product_id` AND `p`.`status` = '1' AND `p`.`date_available` <= NOW())";
			}
		} else {
			$sql .= " FROM `" . DB_PREFIX . "product_to_store` `p2s` LEFT JOIN `" . DB_PREFIX . "product` `p` ON (`p`.`product_id` = `p2s`.`product_id` AND `p`.`status` = '1' AND `p`.`date_available` <= NOW())";
		}

		$sql .= " LEFT JOIN `" . DB_PREFIX . "product_description` `pd` ON (`p`.`product_id` = `pd`.`product_id`) WHERE `pd`.`language_id` = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " AND `cp`.`path_id` = '" . (int)$data['filter_category_id'] . "'";
			} else {
				$sql .= " AND `p2c`.`category_id` = '" . (int)$data['filter_category_id'] . "'";
			}

			if (!empty($data['filter_filter'])) {
				$implode = [];

				$filters = explode(',', $data['filter_filter']);

				foreach ($filters as $filter_id) {
					$implode[] = (int)$filter_id;
				}

				$sql .= " AND `pf`.`filter_id` IN (" . implode(',', $implode) . ")";
			}
		}

		if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = [];

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "`pd`.`name` LIKE '" . $this->db->escape('%' . $word . '%') . "'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					$sql .= " OR `pd`.`description` LIKE '" . $this->db->escape('%' . (string)$data['filter_name'] . '%') . "'";
				}
			}

			if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
				$sql .= " OR ";
			}

			if (!empty($data['filter_tag'])) {
				$implode = [];

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_tag'])));

				foreach ($words as $word) {
					$implode[] = "`pd`.`tag` LIKE '" . $this->db->escape('%' . $word . '%') . "'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}
			}

			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(`p`.`model`) = '" . $this->db->escape(oc_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(`p`.`sku`) = '" . $this->db->escape(oc_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(`p`.`upc`) = '" . $this->db->escape(oc_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(`p`.`ean`) = '" . $this->db->escape(oc_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(`p`.`jan`) = '" . $this->db->escape(oc_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(`p`.`isbn`) = '" . $this->db->escape(oc_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(`p`.`mpn`) = '" . $this->db->escape(oc_strtolower($data['filter_name'])) . "'";
			}

			$sql .= ")";
		}

		if (!empty($data['filter_manufacturer_id'])) {
			$sql .= " AND `p`.`manufacturer_id` = '" . (int)$data['filter_manufacturer_id'] . "'";
		}

		$sort_data = [
			'pd.name',
			'p.model',
			'p.quantity',
			'p.price',
			'rating',
			'p.sort_order',
			'p.date_added'
		];

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if ($data['sort'] == 'pd.name' || $data['sort'] == 'p.model') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			} elseif ($data['sort'] == 'p.price') {
				$sql .= " ORDER BY (CASE WHEN `special` IS NOT NULL THEN `special` WHEN `discount` IS NOT NULL THEN `discount` ELSE p.`price` END)";
			} else {
				$sql .= " ORDER BY " . $data['sort'];
			}
		} else {
			$sql .= " ORDER BY p.`sort_order`";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(`pd`.`name`) DESC";
		} else {
			$sql .= " ASC, LCASE(`pd`.`name`) ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$product_data = (array)$this->cache->get('product.' . md5($sql));

		if (!$product_data) {
			$query = $this->db->query($sql);

			$product_data = $query->rows;

			$this->cache->set('product.' . md5($sql), $product_data);
		}

		return $product_data;
	}

	public function getCategories(int $product_id): array {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_to_category` WHERE `product_id` = '" . (int)$product_id . "'");

		return $query->rows;
	}

	public function getAttributes(int $product_id): array {
		$product_attribute_group_data = [];

		$product_attribute_group_query = $this->db->query("SELECT ag.`attribute_group_id`, agd.`name` FROM `" . DB_PREFIX . "product_attribute` pa LEFT JOIN `" . DB_PREFIX . "attribute` a ON (pa.`attribute_id` = a.`attribute_id`) LEFT JOIN `" . DB_PREFIX . "attribute_group` ag ON (a.`attribute_group_id` = ag.`attribute_group_id`) LEFT JOIN `" . DB_PREFIX . "attribute_group_description` agd ON (ag.`attribute_group_id` = agd.`attribute_group_id`) WHERE pa.`product_id` = '" . (int)$product_id . "' AND agd.`language_id` = '" . (int)$this->config->get('config_language_id') . "' GROUP BY ag.`attribute_group_id` ORDER BY ag.`sort_order`, agd.`name`");

		foreach ($product_attribute_group_query->rows as $product_attribute_group) {
			$product_attribute_data = [];

			$product_attribute_query = $this->db->query("SELECT a.`attribute_id`, ad.`name`, pa.`text` FROM `" . DB_PREFIX . "product_attribute` pa LEFT JOIN `" . DB_PREFIX . "attribute` a ON (pa.`attribute_id` = a.`attribute_id`) LEFT JOIN `" . DB_PREFIX . "attribute_description` ad ON (a.`attribute_id` = ad.`attribute_id`) WHERE pa.`product_id` = '" . (int)$product_id . "' AND a.`attribute_group_id` = '" . (int)$product_attribute_group['attribute_group_id'] . "' AND ad.`language_id` = '" . (int)$this->config->get('config_language_id') . "' AND pa.`language_id` = '" . (int)$this->config->get('config_language_id') . "' ORDER BY a.`sort_order`, ad.`name`");

			foreach ($product_attribute_query->rows as $product_attribute) {
				$product_attribute_data[] = [
					'attribute_id' => $product_attribute['attribute_id'],
					'name'         => $product_attribute['name'],
					'text'         => $product_attribute['text']
				];
			}

			$product_attribute_group_data[] = [
				'attribute_group_id' => $product_attribute_group['attribute_group_id'],
				'name'               => $product_attribute_group['name'],
				'attribute'          => $product_attribute_data
			];
		}

		return $product_attribute_group_data;
	}

	public function getOptions(int $product_id): array {
		$product_option_data = [];

		$product_option_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_option` `po` LEFT JOIN `" . DB_PREFIX . "option` o ON (po.`option_id` = o.`option_id`) LEFT JOIN `" . DB_PREFIX . "option_description` od ON (o.`option_id` = od.`option_id`) WHERE po.`product_id` = '" . (int)$product_id . "' AND od.`language_id` = '" . (int)$this->config->get('config_language_id') . "' ORDER BY o.`sort_order`");

		foreach ($product_option_query->rows as $product_option) {
			$product_option_value_data = [];

			$product_option_value_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_option_value` pov LEFT JOIN `" . DB_PREFIX . "option_value` ov ON (pov.`option_value_id` = ov.`option_value_id`) LEFT JOIN `" . DB_PREFIX . "option_value_description` ovd ON (ov.`option_value_id` = ovd.`option_value_id`) WHERE pov.`product_id` = '" . (int)$product_id . "' AND pov.`product_option_id` = '" . (int)$product_option['product_option_id'] . "' AND ovd.`language_id` = '" . (int)$this->config->get('config_language_id') . "' ORDER BY ov.`sort_order`");

			foreach ($product_option_value_query->rows as $product_option_value) {
				$product_option_value_data[] = [
					'product_option_value_id' => $product_option_value['product_option_value_id'],
					'option_value_id'         => $product_option_value['option_value_id'],
					'name'                    => $product_option_value['name'],
					'image'                   => $product_option_value['image'],
					'quantity'                => $product_option_value['quantity'],
					'subtract'                => $product_option_value['subtract'],
					'price'                   => $product_option_value['price'],
					'price_prefix'            => $product_option_value['price_prefix'],
					'weight'                  => $product_option_value['weight'],
					'weight_prefix'           => $product_option_value['weight_prefix']
				];
			}

			$product_option_data[] = [
				'product_option_id'    => $product_option['product_option_id'],
				'product_option_value' => $product_option_value_data,
				'option_id'            => $product_option['option_id'],
				'name'                 => $product_option['name'],
				'type'                 => $product_option['type'],
				'value'                => $product_option['value'],
				'required'             => $product_option['required']
			];
		}

		return $product_option_data;
	}

	public function getDiscounts(int $product_id): array {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_discount` WHERE `product_id` = '" . (int)$product_id . "' AND `customer_group_id` = '" . (int)$this->config->get('config_customer_group_id') . "' AND `quantity` > 1 AND ((`date_start` = '0000-00-00' OR `date_start` < NOW()) AND (`date_end` = '0000-00-00' OR `date_end` > NOW())) ORDER BY `quantity` ASC, `priority` ASC, `price` ASC");

		return $query->rows;
	}

	public function getImages(int $product_id): array {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_image` WHERE `product_id` = '" . (int)$product_id . "' ORDER BY `sort_order` ASC");

		return $query->rows;
	}

	public function getSubscription(int $product_id, int $subscription_plan_id): array {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_subscription` ps LEFT JOIN `" . DB_PREFIX . "subscription_plan` sp ON (ps.`subscription_plan_id` = sp.`subscription_plan_id`) WHERE ps.`product_id` = '" . (int)$product_id . "' AND ps.`subscription_plan_id` = '" . (int)$subscription_plan_id . "' AND ps.`customer_group_id` = '" . (int)$this->config->get('config_customer_group_id') . "' AND sp.`status` = '1'");

		return $query->row;
	}

	public function getSubscriptions(int $product_id): array {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_subscription` ps LEFT JOIN `" . DB_PREFIX . "subscription_plan` sp ON (ps.`subscription_plan_id` = sp.`subscription_plan_id`) LEFT JOIN `" . DB_PREFIX . "subscription_plan_description` spd ON (sp.`subscription_plan_id` = spd.`subscription_plan_id`) WHERE ps.`product_id` = '" . (int)$product_id . "' AND ps.`customer_group_id` = '" . (int)$this->config->get('config_customer_group_id') . "' AND spd.`language_id` = '" . (int)$this->config->get('config_language_id') . "' AND sp.`status` = '1' ORDER BY sp.`sort_order` ASC");

		return $query->rows;
	}

	public function getLayoutId(int $product_id): int {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_to_layout` WHERE `product_id` = '" . (int)$product_id . "' AND `store_id` = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return (int)$query->row['layout_id'];
		} else {
			return 0;
		}
	}

	public function getRelated(int $product_id): array {
		$sql = "SELECT DISTINCT *, `pd`.`name` AS name, `p`.`image`, " . $this->statement['discount'] . ", " . $this->statement['special'] . ", " . $this->statement['reward'] . ", " . $this->statement['review'] . " FROM `" . DB_PREFIX . "product_related` `pr` LEFT JOIN `" . DB_PREFIX . "product_to_store` `p2s` ON (`p2s`.`product_id` = `pr`.`product_id` AND `p2s`.`store_id` = '" . (int)$this->config->get('config_store_id') . "') LEFT JOIN `" . DB_PREFIX . "product` `p` ON (`p`.`product_id` = `pr`.`related_id` AND `p`.`status` = '1' AND `p`.`date_available` <= NOW()) LEFT JOIN `" . DB_PREFIX . "product_description` `pd` ON (`p`.`product_id` = `pd`.`product_id`) WHERE `pr`.`product_id` = '" . (int)$product_id . "' AND `pd`.`language_id` = '" . (int)$this->config->get('config_language_id') . "'";

		$product_data = $this->cache->get('product.' . md5($sql));

		if (!$product_data) {
			$query = $this->db->query($sql);

			$product_data = $query->rows;

			$this->cache->set('product.' . md5($sql), $product_data);
		}


		return (array)$product_data;
	}

	public function getTotalProducts(array $data = []): int {
		$sql = "SELECT COUNT(DISTINCT `p`.`product_id`) AS total";

		if (!empty($data['filter_category_id'])) {
			$sql .= " FROM `" . DB_PREFIX . "category_to_store` `c2s`";

			if (!empty($data['filter_sub_category'])) {
				$sql .= " LEFT JOIN `" . DB_PREFIX . "category_path` `cp` ON (`cp`.`category_id` = `c2s`.`category_id` AND `c2s`.`store_id` = '" . (int)$this->config->get('config_store_id') . "') LEFT JOIN `" . DB_PREFIX . "product_to_category` `p2c` ON (`p2c`.`category_id` = `cp`.`category_id`)";
			} else {
				$sql .= " LEFT JOIN `" . DB_PREFIX . "product_to_category` `p2c` ON (`p2c`.`category_id` = `c2s`.`category_id`)";
			}

			$sql .= " LEFT JOIN `" . DB_PREFIX . "product_to_store` `p2s` ON (`p2s`.`product_id` = `p2c`.`product_id`)";

			if (!empty($data['filter_filter'])) {
				$sql .= " LEFT JOIN `" . DB_PREFIX . "product_filter` `pf` ON (`pf`.`product_id` = `p2s`.`product_id`) LEFT JOIN `" . DB_PREFIX . "product` `p` ON (`p`.`product_id` = `pf`.`product_id` AND `p`.`status` = '1' AND `p`.`date_available` <= NOW())";
			} else {
				$sql .= " LEFT JOIN `" . DB_PREFIX . "product` `p` ON (`p`.`product_id` = `p2s`.`product_id` AND `p`.`status` = '1' AND `p`.`date_available` <= NOW() AND `p2s`.`store_id` = '" . (int)$this->config->get('config_store_id') . "')";
			}
		} else {
			$sql .= " FROM `" . DB_PREFIX . "product` `p`";
		}

		$sql .= " LEFT JOIN `" . DB_PREFIX . "product_description` `pd` ON (`p`.`product_id` = `pd`.`product_id`) WHERE `pd`.`language_id` = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " AND `cp`.`path_id` = '" . (int)$data['filter_category_id'] . "'";
			} else {
				$sql .= " AND `p2c`.`category_id` = '" . (int)$data['filter_category_id'] . "'";
			}

			if (!empty($data['filter_filter'])) {
				$implode = [];

				$filters = explode(',', $data['filter_filter']);

				foreach ($filters as $filter_id) {
					$implode[] = (int)$filter_id;
				}

				$sql .= " AND `pf`.`filter_id` IN (" . implode(',', $implode) . ")";
			}
		}

		if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = [];

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "`pd`.`name` LIKE '" . $this->db->escape('%' . $word . '%') . "'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					$sql .= " OR `pd`.`description` LIKE '" . $this->db->escape('%' . (string)$data['filter_name'] . '%') . "'";
				}
			}

			if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
				$sql .= " OR ";
			}

			if (!empty($data['filter_tag'])) {
				$implode = [];

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_tag'])));

				foreach ($words as $word) {
					$implode[] = "`pd`.`tag` LIKE '" . $this->db->escape('%' . $word . '%') . "'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}
			}

			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(`p`.`model`) = '" . $this->db->escape(oc_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(`p`.`sku`) = '" . $this->db->escape(oc_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(`p`.`upc`) = '" . $this->db->escape(oc_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(`p`.`ean`) = '" . $this->db->escape(oc_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(`p`.`jan`) = '" . $this->db->escape(oc_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(`p`.`isbn`) = '" . $this->db->escape(oc_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(`p`.`mpn`) = '" . $this->db->escape(oc_strtolower($data['filter_name'])) . "'";
			}

			$sql .= ")";
		}

		if (!empty($data['filter_manufacturer_id'])) {
			$sql .= " AND `p`.`manufacturer_id` = '" . (int)$data['filter_manufacturer_id'] . "'";
		}

		$query = $this->db->query($sql);

		return (int)$query->row['total'];
	}

	public function getLatest(int $limit): array {
		$sql = "SELECT DISTINCT *, `pd`.`name`, `p`.`image`, " . $this->statement['discount'] . ", " . $this->statement['special'] . ", " . $this->statement['reward'] . ", " . $this->statement['review'] . " FROM `" . DB_PREFIX . "product_to_store` `p2s` LEFT JOIN `" . DB_PREFIX . "product` `p` ON (`p`.`product_id` = `p2s`.`product_id` AND `p2s`.`store_id` = '" . (int)$this->config->get('config_store_id') . "' AND `p`.`status` = '1' AND `p`.`date_available` <= NOW()) LEFT JOIN `" . DB_PREFIX . "product_description` `pd` ON (`p`.`product_id` = `pd`.`product_id`) WHERE `pd`.`language_id` = '" . (int)$this->config->get('config_language_id') . "' ORDER BY `p`.`date_added` DESC LIMIT 0," . (int)$limit;

		$product_data = $this->cache->get('product.' . md5($sql));

		if (!$product_data) {
			$query = $this->db->query($sql);

			$product_data = $query->rows;

			$this->cache->set('product.' . md5($sql), $product_data);
		}

		return (array)$product_data;
	}

	public function getSpecials(array $data = []): array {
		$sql = "SELECT DISTINCT *, `pd`.`name`, `p`.`image`, `p`.`price`, " . $this->statement['discount'] . ", " . $this->statement['special'] . ", " . $this->statement['reward'] . ", " . $this->statement['review'] . " FROM `" . DB_PREFIX . "product_special` `ps2` LEFT JOIN `" . DB_PREFIX . "product_to_store` `p2s` ON (`ps2`.`product_id` = `p2s`.`product_id` AND `p2s`.`store_id` = '" . (int)$this->config->get('config_store_id') . "' AND `ps2`.`customer_group_id` = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((`ps2`.`date_start` = '0000-00-00' OR `ps2`.`date_start` < NOW()) AND (`ps2`.`date_end` = '0000-00-00' OR `ps2`.`date_end` > NOW()))) LEFT JOIN `" . DB_PREFIX . "product` `p` ON (`p`.`product_id` = `p2s`.`product_id` AND `p`.`status` = '1' AND `p`.`date_available` <= NOW()) LEFT JOIN `" . DB_PREFIX . "product_description` `pd` ON (`pd`.`product_id` = `p`.`product_id`) WHERE `pd`.`language_id` = '" . (int)$this->config->get('config_language_id') . "' GROUP BY `ps2`.`product_id`";

		$sort_data = [
			'pd.name',
			'p.model',
			'p.price',
			'rating',
			'p.sort_order'
		];

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if ($data['sort'] == 'pd.name' || $data['sort'] == 'p.model') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			} elseif ($data['sort'] == 'p.price') {
				$sql .= " ORDER BY (CASE WHEN `special` IS NOT NULL THEN `special` WHEN `discount` IS NOT NULL THEN `discount` ELSE p.`price` END)";
			} else {
				$sql .= " ORDER BY " . $data['sort'];
			}
		} else {
			$sql .= " ORDER BY p.`sort_order`";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(`pd`.`name`) DESC";
		} else {
			$sql .= " ASC, LCASE(`pd`.`name`) ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$product_data = $this->cache->get('product.' . md5($sql));

		if (!$product_data) {
			$query = $this->db->query($sql);

			$product_data = $query->rows;

			$this->cache->set('product.' . md5($sql), $product_data);
		}

		return (array)$product_data;
	}

	public function getTotalSpecials(): int {
		$query = $this->db->query("SELECT COUNT(DISTINCT `ps`.`product_id`) AS `total` FROM `" . DB_PREFIX . "product_special` `ps` LEFT JOIN `" . DB_PREFIX . "product_to_store` `p2s` ON (`p2s`.`product_id` = `ps`.`product_id` AND `p2s`.`store_id` = '" . (int)$this->config->get('config_store_id') . "' AND `ps`.`customer_group_id` = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((`ps`.`date_start` = '0000-00-00' OR `ps`.`date_start` < NOW()) AND (`ps`.`date_end` = '0000-00-00' OR `ps`.`date_end` > NOW()))) LEFT JOIN `" . DB_PREFIX . "product` `p` ON (`p2s`.`product_id` = `p`.`product_id` AND `p`.`status` = '1' AND `p`.`date_available` <= NOW())");

		if (isset($query->row['total'])) {
			return (int)$query->row['total'];
		} else {
			return 0;
		}
	}

	public function addReport(int $product_id, string $ip, string $country = ''): void {
		$this->db->query("INSERT INTO `" . DB_PREFIX . "product_report` SET `product_id` = '" . (int)$product_id . "', `store_id` = '" . (int)$this->config->get('config_store_id') . "', `ip` = '" . $this->db->escape($ip) . "', `country` = '" . $this->db->escape($country) . "', `date_added` = NOW()");
	}
	
	public function getProductsByIds($product_ids, $customer, $sortSql = "ORDER BY p.product_id ASC") {

		if(count($product_ids) == 0){
			return false;
		}

		if ($customer->isLogged()) {
			$customer_group_id = $customer->getGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$query = $this->db->query("SELECT DISTINCT *, pd.name AS name, p.image, m.name AS manufacturer, (SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$customer_group_id . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount,
		(SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special,
		(SELECT product_special_id FROM " . DB_PREFIX . "product_special ps
		WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$customer_group_id . "'
		AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special_id, (SELECT points FROM " . DB_PREFIX . "product_reward pr WHERE pr.product_id = p.product_id AND customer_group_id = '" . (int)$customer_group_id . "') AS reward, (SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = p.stock_status_id AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "') AS stock_status, (SELECT wcd.unit FROM " . DB_PREFIX . "weight_class_description wcd WHERE p.weight_class_id = wcd.weight_class_id AND wcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS weight_class, (SELECT lcd.unit FROM " . DB_PREFIX . "length_class_description lcd WHERE p.length_class_id = lcd.length_class_id AND lcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS length_class, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, (SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r2 WHERE r2.product_id = p.product_id AND r2.status = '1' GROUP BY r2.product_id) AS reviews, p.sort_order FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) WHERE p.product_id IN (" . implode(',', $product_ids) . ") AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'".$sortSql);

		if ($query->num_rows) {
			$ret = $this->productData($query->rows);
			$specialIds = $ret['specialIds'];
			$product_data = $ret['product_data'];

			if(count($specialIds) > 0){
				$specialsQuery = $this->db->query("SELECT date_start, date_end, price, product_id FROM " . DB_PREFIX . "product_special ps WHERE ps.product_special_id IN (" . implode(',', $specialIds) . ")");

				foreach ($specialsQuery->rows as $special) {

					if(isset($product_data[$special['product_id']])){
						$product_data[$special['product_id']]['special'] = $special['price'];
						$product_data[$special['product_id']]['special_start_date'] = $special['date_start'];
						$product_data[$special['product_id']]['special_end_date'] = $special['date_end'];
					}
				}
			}
			return $product_data;
		} else {
			return false;
		}
    }
	private function productData($results){
		$specialIds = array();
		$product_data = array();
		foreach ($results as $result) {
					$specialIds[$result['product_id']] = $result['special_id'];
					$product_data[$result['product_id']] = array(
									'product_id'       => $result['product_id'],
									'name'             => $result['name'],
									'description'      => $result['description'],
									'meta_description' => $result['meta_description'],
									'meta_keyword'     => $result['meta_keyword'],
									'meta_title'     => $result['meta_title'],
									'tag'              => $result['tag'],
									'model'            => $result['model'],
									'sku'              => $result['sku'],
									'upc'              => $result['upc'],
									'ean'              => $result['ean'],
									'jan'              => $result['jan'],
									'isbn'             => $result['isbn'],
									'mpn'              => $result['mpn'],
									'location'         => $result['location'],
									'quantity'         => $result['quantity'],
									'stock_status'     => $result['stock_status'],
									'image'            => $result['image'],
									'manufacturer_id'  => $result['manufacturer_id'],
									'manufacturer'     => $result['manufacturer'],
									'price'            => ($result['discount'] ? $result['discount'] : $result['price']),
									'special'          => isset($result['special']) ? $result['special'] : '',
									'reward'           => $result['reward'],
									'points'           => $result['points'],
									'tax_class_id'     => $result['tax_class_id'],
									'date_available'   => $result['date_available'],
									'weight'           => $result['weight'],
									'weight_class_id'  => $result['weight_class_id'],
									'length'           => $result['length'],
									'width'            => $result['width'],
									'height'           => $result['height'],
									'length_class_id'  => $result['length_class_id'],
									'subtract'         => $result['subtract'],
									'rating'           => round((int)$result['rating']),
									'reviews'          => $result['reviews'] ? $result['reviews'] : 0,
									'minimum'          => $result['minimum'],
									'sort_order'       => $result['sort_order'],
									'status'           => $result['status'],
									'date_added'       => $result['date_added'],
									'date_modified'    => $result['date_modified'],
									//'viewed'           => $result['viewed'],
									'weight_class'     => $result['weight_class'],
									'stock_status_id'  => $result['stock_status_id'],
									'length_class'     => $result['length_class']
								);
				}

				$specialIds = array_filter($specialIds, function($item){
					return !empty($item);
				});

				return array(
							'specialIds' => $specialIds,
							'product_data' => $product_data
				);
		}
	public function getProductSeoUrls($product_id) {

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "seo_url
		WHERE `key` = 'product_id' and `value`='" . (int)$product_id . "'
		AND language_id = '" . (int)$this->config->get('config_language_id') . "'
		AND store_id = '" . (int)$this->config->get('config_store_id') . "'
		");

		/*if ($query->num_rows) {
			return $query->row['keyword'];
		}*/

		return "";
	}	
	public function getProductsAllData($customer, $data = array()) {
		if ($customer->isLogged()) {
			$customer_group_id = $customer->getGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$sql = "
				  SELECT DISTINCT *,
					 pd.name AS name, p.image, m.name AS manufacturer,
					(SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$customer_group_id . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1)
					 AS discount,
					(SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1)
					 AS special,
					(SELECT product_special_id FROM " . DB_PREFIX . "product_special ps
						WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$customer_group_id . "'
						AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW())
						AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1)
					 AS special_id,
					 (SELECT points FROM " . DB_PREFIX . "product_reward pr
						WHERE pr.product_id = p.product_id AND customer_group_id = '" . (int)$customer_group_id . "')
					 AS reward,
						(SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = p.stock_status_id
						 AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "')
					 AS stock_status,
						(SELECT wcd.unit FROM " . DB_PREFIX . "weight_class_description wcd
							WHERE p.weight_class_id = wcd.weight_class_id AND wcd.language_id = '" . (int)$this->config->get('config_language_id') . "')
					AS weight_class,
						(SELECT lcd.unit FROM " . DB_PREFIX . "length_class_description lcd
							WHERE p.length_class_id = lcd.length_class_id AND lcd.language_id = '" . (int)$this->config->get('config_language_id') . "')
					AS length_class,
						(SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1
							WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id)
					AS rating,
						(SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r2 WHERE r2.product_id = p.product_id
							AND r2.status = '1' GROUP BY r2.product_id)
					AS reviews,
					p.sort_order ";

				if (!empty($data['filter_category_id'])) {
					if (!empty($data['filter_sub_category'])) {
						$sql .= " FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (cp.category_id = p2c.category_id)";
					} else {
						$sql .= " FROM " . DB_PREFIX . "product_to_category p2c";
					}
					if (!empty($data['filter_filter'])) {
						$sql .= " LEFT JOIN " . DB_PREFIX . "product_filter pf ON (p2c.product_id = pf.product_id) LEFT JOIN " . DB_PREFIX . "product p ON (pf.product_id = p.product_id)";
					} else {
						$sql .= " LEFT JOIN " . DB_PREFIX . "product p ON (p2c.product_id = p.product_id)";
					}
				} else {
					$sql .= " FROM " . DB_PREFIX . "product p";
				}

			  $sql.= "
			  LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)
			  LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id)
			  LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id)
			  WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'
			  AND p.status = '1' AND p.date_available <= NOW()
			  AND p2s.store_id = '" . (int)$this->config->get('config_store_id')."'";

		$sql.= $this->filterSql($data);

		$query = $this->db->query($sql);

		if ($query->num_rows) {
			$ret = $this->productData($query->rows);
			$specialIds = $ret['specialIds'];
			$product_data = $ret['product_data'];

			if(count($specialIds) > 0){
				$specialsQuery = $this->db->query("SELECT date_start, date_end, price, product_id FROM " . DB_PREFIX . "product_special ps WHERE ps.product_special_id IN (" . implode(',', $specialIds) . ")");

				foreach ($specialsQuery->rows as $special) {

					if(isset($product_data[$special['product_id']])){
						$product_data[$special['product_id']]['special'] = $special['price'];
						$product_data[$special['product_id']]['special_start_date'] = $special['date_start'];
						$product_data[$special['product_id']]['special_end_date'] = $special['date_end'];
					}
				}
			}
			return $product_data;
		} else {
			return false;
		}
	}
	private function filterSql($data, $onlycount = false){
		$sql = "";
		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " AND cp.path_id = '" . (int)$data['filter_category_id'] . "'";
			} else {
				$categoryImplode = array();

				$categoryFilters = explode(',', $data['filter_category_id']);

				foreach ($categoryFilters as $categoryFilterId) {
					$categoryImplode[] = (int)$categoryFilterId;
				}

				if(count($categoryImplode) > 1) {
					$sql .= " AND p2c.category_id IN (" . implode(',', $categoryImplode) . ")";
				} else {
					$sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
				}
			}

			if (!empty($data['filter_filter'])) {
				$implode = array();

				$filters = explode(',', $data['filter_filter']);

				foreach ($filters as $filter_id) {
					$implode[] = (int)$filter_id;
				}

				$sql .= " AND pf.filter_id IN (" . implode(',', $implode) . ")";
			}
		}

		if (!empty($data['filter_sku'])) {
			$sql .= " AND LCASE(p.sku) = '" . $this->db->escape(utf8_strtolower($data['filter_sku'])) . "'";
		}

		if (!empty($data['filter_model'])) {
			$sql .= " AND LCASE(p.model) = '" . $this->db->escape(utf8_strtolower($data['filter_model'])) . "'";
		}

		if (!empty($data['filter_name']) ) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "pd.name LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					$sql .= " OR pd.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
				}
			}

			if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
				$sql .= " OR ";
			}

			if (!empty($data['filter_tag'])) {
				$sql .= "pd.tag LIKE '%" . $this->db->escape($data['filter_tag']) . "%'";
			}

			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.model) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.sku) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.upc) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.ean) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.jan) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.isbn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.mpn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
			}

			$sql .= ")";
		}

		if (!empty($data['filter_manufacturer_id'])) {
			$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
		}


		if (!empty($data['filter_date_added_to']) && !empty($data['filter_date_added_from'])) {

			$sql .= " AND p.date_added BETWEEN STR_TO_DATE('" . $this->db->escape($data['filter_date_added_from']) . "','%Y-%m-%d %H:%i:%s') AND STR_TO_DATE('" . $this->db->escape($data['filter_date_added_to']) . "','%Y-%m-%d %H:%i:%s')";

		} elseif (!empty($data['filter_date_added_from'])) {

			$sql .= " AND p.date_added >= STR_TO_DATE('" . $this->db->escape($data['filter_date_added_from']) . "','%Y-%m-%d %H:%i:%s')";

		} elseif (!empty($data['filter_date_added_on'])) {

			$sql .= " AND DATE(p.date_added) = DATE('" . $this->db->escape($data['filter_date_added_on']) . "')";
		}

		if (!empty($data['filter_date_modified_to']) && !empty($data['filter_date_modified_from'])) {

			$sql .= " AND p.date_modified BETWEEN STR_TO_DATE('" . $this->db->escape($data['filter_date_modified_from']) . "','%Y-%m-%d %H:%i:%s') AND STR_TO_DATE('" . $this->db->escape($data['filter_date_modified_to']) . "','%Y-%m-%d %H:%i:%s')";

		} elseif (!empty($data['filter_date_modified_from'])) {

			$sql .= " AND p.date_modified >= STR_TO_DATE('" . $this->db->escape($data['filter_date_modified_from']) . "','%Y-%m-%d %H:%i:%s')";

		} elseif (!empty($data['filter_date_modified_on'])) {

			$sql .= " AND DATE(p.date_modified) = DATE('" . $this->db->escape($data['filter_date_modified_on']) . "')";
		}


		if(empty($onlycount)) {

			$sql .= " GROUP BY p.product_id";

			$sort_data = array(
				'name'=>'pd.name',
				'model'=>'p.model',
				'quantity'=>'p.quantity',
				'price'=>'p.price',
				'id'=>'p.product_id',
				'rating'=>'rating',
				'sort_order'=>'p.sort_order',
				'date_added'=>'p.date_added',
				'date_modified'=>'p.date_modified'
			);

			if (isset($data['sort']) && in_array($data['sort'], array_keys($sort_data))) {
				if ($data['sort'] == 'name' || $data['sort'] == 'model') {
					$sql .= " ORDER BY LCASE(" . $sort_data[$data['sort']] . ")";
				} elseif ($data['sort'] == 'price') {
					$sql .= " ORDER BY (CASE WHEN special IS NOT NULL THEN special WHEN discount IS NOT NULL THEN discount ELSE p.price END)";
				} else {
					$sql .= " ORDER BY " . $sort_data[$data['sort']];
				}
			} else {
				$sql .= " ORDER BY p.sort_order";
			}

			if (isset($data['order']) && (strtolower($data['order']) == strtolower('DESC'))) {
				$sql .= " DESC, LCASE(pd.name) DESC";
			} else {
				$sql .= " ASC, LCASE(pd.name) ASC";
			}


			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['limit'] < 1) {
					$limit = 20;
				}else {
					$limit = (int)$data['limit'];
				}


				if ($data['start'] < 0) {
					$offset = 0;
				}else{
					$offset = (int)$data['start'];
				}

				$sql .= " LIMIT " . $offset . "," . $limit;
			}
		}
		return $sql;
	}
	public function getProductsTotal($customer, $data = array() , $onlycount=true) {

		if ($customer->isLogged()) {
			$customer_group_id = $customer->getGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$sql = "SELECT COUNT(DISTINCT p.product_id) AS total";


		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (cp.category_id = p2c.category_id)";
			} else {
				$sql .= " FROM " . DB_PREFIX . "product_to_category p2c";
			}
			if (!empty($data['filter_filter'])) {
				$sql .= " LEFT JOIN " . DB_PREFIX . "product_filter pf ON (p2c.product_id = pf.product_id) LEFT JOIN " . DB_PREFIX . "product p ON (pf.product_id = p.product_id)";
			} else {
				$sql .= " LEFT JOIN " . DB_PREFIX . "product p ON (p2c.product_id = p.product_id)";
			}
		} else {
			$sql .= " FROM " . DB_PREFIX . "product p";
		}

		  $sql.= "
		  LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)
		  LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id)
		  LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id)
		  WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'
		  AND p.status = '1' AND p.date_available <= NOW()
		  AND p2s.store_id = '" . (int)$this->config->get('config_store_id')."'";

		$sql.= $this->filterSql($data, $onlycount);

		$query = $this->db->query($sql);
		return $query->row['total'];

	}
	public function getValue(int $option_value_id): array {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "option_value` ov LEFT JOIN `" . DB_PREFIX . "option_value_description` ovd ON (ov.`option_value_id` = ovd.`option_value_id`) WHERE ov.`option_value_id` = '" . (int)$option_value_id . "' AND ovd.`language_id` = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}
	public function getOption(int $option_id): array {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "option` o LEFT JOIN `" . DB_PREFIX . "option_description` od ON (o.`option_id` = od.`option_id`) WHERE o.`option_id` = '" . (int)$option_id . "' AND od.`language_id` = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}
}

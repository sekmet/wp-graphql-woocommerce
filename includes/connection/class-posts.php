<?php
/**
 * Connection type - Posts
 *
 * Registers connections to Posts
 *
 * @package WPGraphQL\WooCommerce\Connection
 */

namespace WPGraphQL\WooCommerce\Connection;

use WPGraphQL\Connection\PostObjects;

/**
 * Class - Posts
 */
class Posts extends PostObjects {
	/**
	 * Registers the various connections from other WooCommerce Types to other WordPress post-types
	 */
	public static function register_connections() {
		register_graphql_connection(
			self::get_connection_config(
				get_post_type_object( 'attachment' ),
				array(
					'fromType'      => 'Product',
					'toType'        => 'MediaItem',
					'fromFieldName' => 'galleryImages',
				)
			)
		);
		/**
		 * From product types to MediaItem
		 */
		$product_types = array_values( \WP_GraphQL_WooCommerce::get_enabled_product_types() );
		foreach ( $product_types as $product_type ) {
			register_graphql_connection(
				self::get_connection_config(
					get_post_type_object( 'attachment' ),
					array(
						'fromType'      => $product_type,
						'toType'        => 'MediaItem',
						'fromFieldName' => 'galleryImages',
					)
				)
			);
		}
	}
}

<?php
/*
Plugin Name: Revisions-meta-box
Version: 0.1
Description: Revisions Meta Box
Author: WordPress
Author URI: wordpress.org
Plugin URI: https://plugins.wordpress.org/revisions-meta-box
Text Domain: revisions-meta-box
Domain Path: /languages
*/

Class RevisionsMetaBox {
	function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'revisions_add_meta_box' ) );
	}

	function revisions_add_meta_box( $post_type, $post ) {

		if ( post_type_supports( $post_type, 'revisions') && 'auto-draft' != $post->post_status ) {
			$revisions = wp_get_post_revisions( $post_ID );

			// We should aim to show the revisions metabox only when there are revisions.
			if ( count( $revisions ) > 1 ) {
				reset( $revisions ); // Reset pointer for key()
				$publish_callback_args = array( 'revisions_count' => count( $revisions ), 'revision_id' => key( $revisions ) );
				add_meta_box( 'revisionsdiv', __('Revisions'), 'post_revisions_meta_box', null, 'normal', 'core');
			}
		}
	}
}

$revisionsmetabox = new RevisionsMetaBox();

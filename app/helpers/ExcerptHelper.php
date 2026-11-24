<?php
namespace gradZagrebWeb2024\helpers;

class ExcerptHelper {

	private $lengths = array();

	private $current_length = null;

	private $more = '...';

	public function __construct() {

		$this->add_excerpt_length( 'sm', 20 );
		$this->add_excerpt_length( 'md', 40 );
		$this->add_excerpt_length( 'lg', 60 );

		add_filter( 'excerpt_length', array( $this, 'set_excerpt_length' ), 999 );
		add_filter( 'excerpt_more', array( $this, 'set_excerpt_more' ) );
	}

	public function add_excerpt_length( $name, $length ) {
		$this->lengths[ $name ] = $length;
	}

	public function use_excerpt_length( $name ) {
		if ( isset( $this->lengths[ $name ] ) ) {
			$this->current_length = $this->lengths[ $name ];
		}
	}

	public function set_excerpt_length( $length ) {
		if ( ! is_null( $this->current_length ) ) {
			return $this->current_length;
		}
		return $length;
	}

	public function use_excerpt_more( $more ) {
		$this->more = $more;
	}

	public function set_excerpt_more() {
		return $this->more;
	}

	public function get_the_excerpt( $post_id = null, $length, $more ) {
		$this->use_excerpt_length( $length );
		$this->use_excerpt_more( $more );

		return get_the_excerpt( $post_id );
	}
}

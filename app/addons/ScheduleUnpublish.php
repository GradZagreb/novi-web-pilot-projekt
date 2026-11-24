<?php
namespace gradZagrebWeb2024\addons;

class ScheduleUnpublish {

	public function init() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save_meta_box' ) );
		add_action( 'su_unpublish_event', array( $this, 'unpublish_post' ) );
		add_action( 'before_delete_post', array( $this, 'cleanup_on_delete' ) );
		add_action( 'wp_ajax_su_cancel_schedule', array( $this, 'ajax_cancel_schedule' ) );
	}

	public function add_meta_box() {
		add_meta_box(
			'su_meta_box',
			'Schedule Unpublish',
			array( $this, 'meta_box_callback' ),
			'notification',
			'side',
			'high'
		);
	}

	public function meta_box_callback( $post ) {
		$unpublish_date = get_post_meta( $post->ID, '_su_unpublish_date', true );
		wp_nonce_field( 'su_save_meta_box', 'su_meta_box_nonce' );

		echo '<label for="su_unpublish_date" style="margin-bottom: 5px; display: block;">Unpublish Date and Time:</label>';
		echo '<input type="date" id="su_unpublish_date" name="su_unpublish_date" value="' . esc_attr( $unpublish_date ) . '" style="width:100%; display: block; margin-bottom: 10px;">';
		echo '<button type="button" id="su_cancel_schedule" class="button button-primary button-small">Clear Schedule</button>';

		$post_id   = $post->ID;
		$timestamp = wp_next_scheduled( 'su_unpublish_event', array( (int) $post_id ) );
		if ( $timestamp ) {
			echo '<p id="su_schedule_status" style="margin-bottom: 0;">Scheduled for: ' . date( 'Y-m-d', $timestamp ) . '</p>';
		} else {
			echo '<p id="su_schedule_status" style="margin-bottom: 0;">No unpublish event scheduled for this post.</p>';
		}

		echo '<script>
			document.getElementById("su_cancel_schedule").addEventListener("click", function() {
				const nonce = "' . wp_create_nonce( 'su_cancel_schedule_nonce' ) . '";
				fetch("' . admin_url( 'admin-ajax.php' ) . '?action=su_cancel_schedule", {
					method: "POST",
					headers: { "Content-Type": "application/x-www-form-urlencoded" },
					body: `post_id=${' . $post_id . '}&_ajax_nonce=${nonce}`
				})
					.then(response => {
						if (!response.ok) throw new Error("Failed to cancel schedule.");
						return response.json();
					})
					.then(data => {
						if (data.success) {
							document.getElementById("su_unpublish_date").value = "";
							document.getElementById("su_schedule_status").textContent = "Schedule has been cleared.";
						}
						else throw new Error(data.data);
					})
					.catch(error => {
						document.getElementById("su_schedule_status").textContent = "Error clearing schedule: " + error.message;
					});
			});
		</script>';
	}

	public function save_meta_box( $post_id ) {
		if ( ! isset( $_POST['su_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['su_meta_box_nonce'], 'su_save_meta_box' ) ) {
			return;
		}
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( isset( $_POST['su_unpublish_date'] ) ) {
			$unpublish_date = sanitize_text_field( $_POST['su_unpublish_date'] );
			update_post_meta( $post_id, '_su_unpublish_date', $unpublish_date );

			if ( $unpublish_date ) {
				$timestamp = strtotime( $unpublish_date );
				if ( $timestamp && $timestamp > time() ) {
					wp_clear_scheduled_hook( 'su_unpublish_event', array( (int) $post_id ) );
					wp_schedule_single_event( $timestamp, 'su_unpublish_event', array( (int) $post_id ) );
				}
			}
		}
	}

	public function unpublish_post( $post_id ) {
		$post = get_post( $post_id );
		if ( $post && $post->post_status === 'publish' ) {
			wp_update_post(
				array(
					'ID'          => $post_id,
					'post_status' => 'draft',
				)
			);
			delete_post_meta( $post_id, '_su_unpublish_date' );
		}
	}

	public function cleanup_on_delete( $post_id ) {
		wp_clear_scheduled_hook( 'su_unpublish_event', array( (int) $post_id ) );
	}

	public function cancel_schedule( $post_id ) {
		wp_clear_scheduled_hook( 'su_unpublish_event', array( (int) $post_id ) );
		delete_post_meta( $post_id, '_su_unpublish_date' );
	}

	public function ajax_cancel_schedule() {
		check_ajax_referer( 'su_cancel_schedule_nonce', '_ajax_nonce' );
		if ( isset( $_POST['post_id'] ) ) {
			$post_id = (int) $_POST['post_id'];
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				wp_send_json_error( 'Insufficient permissions.' );
			}
			$this->cancel_schedule( $post_id );
			wp_send_json_success( 'Schedule canceled successfully.' );
		} else {
			wp_send_json_error( 'Invalid post ID.' );
		}
	}
}

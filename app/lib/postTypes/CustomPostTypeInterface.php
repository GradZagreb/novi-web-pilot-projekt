<?php

namespace gradZagrebWeb2024\lib\postTypes;

interface CustomPostTypeInterface extends CustomPostTypeSettingsInterface {
	public function get_post_type_slug(): string;
}
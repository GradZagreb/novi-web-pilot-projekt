<?php

namespace gradZagrebWeb2024\lib\postTypes;

interface CustomTaxonomiesInterface extends CustomPostTypeSettingsInterface {
	public function get_post_types(): array;
}
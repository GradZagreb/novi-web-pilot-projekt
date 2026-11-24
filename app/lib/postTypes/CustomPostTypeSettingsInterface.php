<?php

namespace gradZagrebWeb2024\lib\postTypes;

interface CustomPostTypeSettingsInterface {
	public function get_labels(): array;

	public function get_args(): array;
}
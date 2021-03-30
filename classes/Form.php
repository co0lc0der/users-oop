<?php

class Form
{
	public static function begin($params = []) {
		$attrs = '';//" method=\"{$method}\"";

		if ($params) {
			foreach($params as $attr => $value) {
				if (!empty($value)) $attrs .= " {$attr}='{$value}'";
			}
		}

		echo "<form{$attrs}>";
	}

	public static function end() {
		echo '</form>';
	}

	public static function input($name, $params = []) {
		if (empty($name)) return;

		$label = '';
		$attrs = '';//" type=\"{$type}\"";
		$label_after = false;

		if ($name == 'token') {
			echo "<input name='{$name}' type='hidden' value='" . Token::generate() . "'>";
			return;
		}

		$params['name'] = $name;
		if (!array_key_exists('type', $params)) $params['type'] = 'text';
		if (!array_key_exists('id', $params)) $params['id'] = $name;

		if (array_key_exists('label', $params)) {
			$label = $params['label'];
			unset($params['label']);

			$label = "<label for=\"{$params['id']}\">{$label}</label>";

			if (array_key_exists('label_after', $params)) {
				$label_after = $params['label_after'];
				unset($params['label_after']);
			}
		}

		if ($params) {
			foreach($params as $attr => $value) {
				if (!empty($value)) $attrs .= " {$attr}='{$value}'";
			}
		}

		echo $label_after ? "<input{$attrs}> {$label}" : "{$label} <input{$attrs}>";
	}

	public static function button($params = [], $text = '') {
		$attrs = '';
		if ($params) {
			foreach($params as $attr => $value) {
				if (!empty($value)) $attrs .= " {$attr}='{$value}'";
			}
		}
		echo "<button{$attrs}>{$text}</button>";
	}
}

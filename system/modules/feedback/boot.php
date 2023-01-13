<?php
/**
 * @var \core\App $this
 */

$this->event->on('core.template.render', function (\core\Html $html) {

	if (!$html->isSystemTemplate()) {
		if (isset($_GET['wysiwyg']) and \core\User::current()->isAdmin()) {
			return $html->render;
		}
	}

    $dom = new DOMDocument();
    $dom->loadHTML('<?xml encoding="utf-8" ?>' . $html->content);
    $xpath = new DOMXPath($dom);

    $forms = $dom->getElementsByTagName('form');

    foreach ($forms as $form) {
        $xpath->query('descendant::input[@name="csrf_token"]', $form)->item(0)->setAttribute('value', 'test');
    }

    $html->content = $dom->saveHTML();

    $csrf_token = \core\Tools::generateRandomString();

//    $html->content = str_replace('_CSRF_', $csrf_token, $html->content);
    return $html->content;

});

?>
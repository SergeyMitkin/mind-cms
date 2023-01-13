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
    $dom->loadHTML('<?xml encoding="utf-8">' . $html->content);
    $xpath = new DOMXPath($dom);

    $forms = $dom->getElementsByTagName('form');

    if ($forms->length > 0) {
        foreach ($forms as $form) {

            $form_id = $xpath->query('descendant::input[@name="form_id"]', $form)->item(0)->getAttribute('value');
            $csrf_token = \core\Tools::generateRandomString();

            $xpath->query('descendant::input[@name="csrf_token"]', $form)->item(0)->setAttribute('value', $csrf_token);
        }

        $html->content = $dom->saveHTML();

        return $html->content;

        //    $csrf_token = \core\Tools::generateRandomString();
        //    $html->content = str_replace('_CSRF_', $csrf_token, $html->content);
    }

});

?>
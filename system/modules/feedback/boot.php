<?php
/**
 * @var \core\App $this
 */

$this->event->on('core.template.render', function (\core\Html $html) {

	if (!$html->isSystemTemplate()) {
		if (isset($_GET['wysiwyg']) and \core\User::current()->isAdmin()) {
			return $html->render;
		}

        $dom = new DOMDocument();
        $dom->loadHTML('<?xml encoding="utf-8">' . $html->content);

        $forms = $dom->getElementsByTagName('form');

        if ($forms->length > 0) {
            $xpath = new DOMXPath($dom);
            $_SESSION['csrf'] = [];

            foreach ($forms as $form) {

                if ($xpath->query('descendant::input[@name="form_id"]', $form)->length > 0
                    && $xpath->query('descendant::input[@name="csrf_token"]', $form)->length > 0)
                {
                    $form_id = $xpath->query('descendant::input[@name="form_id"]', $form)->item(0)->getAttribute('value');
                    $csrf_token = \core\Tools::generateRandomString();

                    $xpath->query('descendant::input[@name="csrf_token"]', $form)->item(0)->setAttribute('value', $csrf_token);
                    $_SESSION['csrf'][$form_id] = $csrf_token;
                }
            }

            $html->content = $dom->saveHTML();

            return $html->content;
        }
	}

});

?>
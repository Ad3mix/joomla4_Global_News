<?php
defined('_JEXEC') or die;

require_once __DIR__ . '/helper.php';

$articles = ModGlobalNewsHelper::getArticles($params);

if (!$articles) {
    echo '<p>No articles found. Please check the module settings and content availability.</p>';
    return;
}

require JModuleHelper::getLayoutPath('mod_globalnews', $params->get('layout', 'default'));

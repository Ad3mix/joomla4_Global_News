<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_globalnews
 * @copyright   Copyright (C) 2025 Ad3mix
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

require_once __DIR__ . '/helper.php';

$articles = ModGlobalNewsHelper::getArticles($params);
require ModuleHelper::getLayoutPath('mod_globalnews', $params->get('layout', 'default'));

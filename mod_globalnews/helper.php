<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.helper');
jimport('joomla.application.component.router'); // Per compatibilità

class ModGlobalNewsHelper
{
    public static function getArticles($params)
    {
        $categories = $params->get('catid', []);
        $count = (int)$params->get('count', 5);
        $ordering = $params->get('ordering', 'created');

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query->select([
            'a.id',
            'a.title',
            'a.introtext',
            'a.created',
            'a.hits',
            'a.images',
            'a.catid',
            'a.alias'
        ])
        ->from($db->quoteName('#__content', 'a'))
        ->where('a.state = 1') // Solo articoli pubblicati
        ->order('a.' . $db->escape($ordering) . ' DESC')
        ->setLimit($count);

        if (!empty($categories)) {
            $query->where('a.catid IN (' . implode(',', $categories) . ')');
        }

        $db->setQuery($query);
        $articles = $db->loadObjectList();

        foreach ($articles as &$article) {
            $images = json_decode($article->images);
            $article->image = !empty($images->image_intro) ? $images->image_intro : '';
            
            // Genera il link all'articolo
            $article->link = JRoute::_(ContentHelperRoute::getArticleRoute($article->id, $article->catid));
        }

        return $articles;
    }
}

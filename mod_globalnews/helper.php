<?php
defined('_JEXEC') or die;

class ModGlobalNewsHelper
{
    public static function getArticles($params)
    {
        $categories = $params->get('catid');
        $count = $params->get('count', 5);
        $ordering = $params->get('ordering', 'created');

        // Database query
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select($db->quoteName(['a.id', 'a.title', 'a.catid', 'a.introtext', 'a.images', 'a.created', 'a.hits']))
            ->select($db->quoteName('c.title', 'category_title')) // Join category title
            ->from($db->quoteName('#__content', 'a'))
            ->join('LEFT', $db->quoteName('#__categories', 'c') . ' ON c.id = a.catid') // Join categories
            ->where($db->quoteName('a.catid') . ' IN (' . implode(',', $categories) . ')')
            ->where($db->quoteName('a.state') . ' = 1') // Only published articles
            ->order($db->quoteName('a.' . $ordering) . ' DESC')
            ->setLimit($count);

        $db->setQuery($query);
        $articles = $db->loadObjectList();

        // Process articles
        foreach ($articles as &$article) {
            // Generate article link
            $article->link = JRoute::_(ContentHelperRoute::getArticleRoute($article->id, $article->catid));
            // Generate category link
            $article->category_link = JRoute::_(ContentHelperRoute::getCategoryRoute($article->catid));
        }

        return $articles;
    }
}

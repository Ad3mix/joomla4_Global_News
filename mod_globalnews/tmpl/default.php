<?php
defined('_JEXEC') or die;

$columns = $params->get('columns', 3);
$border_width = $params->get('border_width', 1);
$border_color = $params->get('border_color', '#ccc');
$title_size = $params->get('title_size', 16);
$category_title_size = $params->get('category_title_size', 18);
$image_width = $params->get('image_width', 150);
$image_height = $params->get('image_height', 150);
?>

<div class="mod-globalnews" style="display: grid; grid-template-columns: repeat(<?php echo $columns; ?>, 1fr); gap: 10px;">
    <?php if (!empty($articles)) : ?>
        <?php foreach ($articles as $article) : ?>
            <div class="article-item" style="border: <?php echo $border_width; ?>px solid <?php echo $border_color; ?>; padding: 10px;">
                <!-- Category Title -->
                <div class="category-title" style="font-size: <?php echo $category_title_size; ?>px; font-weight: bold; margin-bottom: 5px;">
                    <a href="<?php echo $article->category_link; ?>"><?php echo htmlspecialchars($article->category_title); ?></a>
                </div>

                <!-- Article Image -->
                <?php if ($params->get('show_image') && !empty($article->images)) : ?>
    <?php $images = json_decode($article->images); ?>
    <?php if (!empty($images->image_intro)) : ?>
        <img src="<?php echo $images->image_intro; ?>" 
             alt="<?php echo htmlspecialchars($article->title); ?>" 
             style="width: <?php echo $image_width; ?>px; height: <?php echo $image_height; ?>px; object-fit: <?php echo $params->get('image_fit', 'contain'); ?>; border: 0px solid #ddd; padding: 0px;">
    <?php endif; ?>
    <?php endif; ?>

                <!-- Article Title -->
                <h3 class="article-title" style="font-size: <?php echo $title_size; ?>px; margin: 10px 0;">
                    <a href="<?php echo $article->link; ?>"><?php echo htmlspecialchars($article->title); ?></a>
                </h3>

                <!-- Intro Text -->
                <?php if ($params->get('show_intro')) : ?>
                    <p><?php echo $article->introtext; ?></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No articles found to display.</p>
    <?php endif; ?>
</div>

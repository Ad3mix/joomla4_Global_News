<?php
$titleSize = $params->get('title_size', '16px');
$titlePosition = $params->get('title_position', 'above');
$columns = $params->get('columns', 3);
$border = $params->get('border', '1px solid #ddd');
$padding = $params->get('padding', 10);
$space = $params->get('space', 10);
?>

<div class="globalnews-container" style="display: grid; grid-template-columns: repeat(<?= $columns ?>, 1fr); gap: <?= $space ?>px;">
    <?php foreach ($articles as $article): ?>
        <div class="article" style="border: <?= $border ?>; padding: <?= $padding ?>px; background-color: #f9f9f9; border-radius: 8px;">
            <?php if ($titlePosition === 'above'): ?>
                <h3 class="article-title" style="font-size: <?= $titleSize ?>;">
                    <a href="<?= htmlspecialchars(JRoute::_($article->link), ENT_QUOTES, 'UTF-8') ?>" style="text-decoration: none; color: #333;">
                        <?= htmlspecialchars($article->title, ENT_QUOTES, 'UTF-8') ?>
                    </a>
                </h3>
            <?php endif; ?>

            <div class="article-content" style="display: flex; <?= $titlePosition === 'left' ? 'flex-direction: row-reverse;' : ($titlePosition === 'right' ? 'flex-direction: row;' : 'flex-direction: column;') ?>">
                <?php if (!empty($article->image)): ?>
                    <img src="<?= htmlspecialchars($article->image, ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($article->title, ENT_QUOTES, 'UTF-8') ?>" style="width: <?= $params->get('image_width', 150) ?>px; height: <?= $params->get('image_height', 150) ?>px; object-fit: cover; margin-right: 10px;" />
                <?php endif; ?>

                <?php if (in_array($titlePosition, ['left', 'right'])): ?>
                    <h3 class="article-title" style="font-size: <?= $titleSize ?>;">
                        <a href="<?= htmlspecialchars(JRoute::_($article->link), ENT_QUOTES, 'UTF-8') ?>" style="text-decoration: none; color: #333;">
                            <?= htmlspecialchars($article->title, ENT_QUOTES, 'UTF-8') ?>
                        </a>
                    </h3>
                <?php endif; ?>
            </div>

            <?php if ($titlePosition === 'below'): ?>
                <h3 class="article-title" style="font-size: <?= $titleSize ?>;">
                    <a href="<?= htmlspecialchars(JRoute::_($article->link), ENT_QUOTES, 'UTF-8') ?>" style="text-decoration: none; color: #333;">
                        <?= htmlspecialchars($article->title, ENT_QUOTES, 'UTF-8') ?>
                    </a>
                </h3>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>

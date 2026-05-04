<?php
/** @var mixed $tags comma-separated tags from listing row */
$parts = listingTagParts(isset($tags) ? (string) $tags : '');
$size = $size ?? 'sm';
$chipClass = $size === 'md'
  ? 'inline-flex max-w-full shrink-0 rounded-capsule border border-jobscape-border-subtle bg-jobscape-soft/70 px-3 py-1 text-[13px] font-medium text-jobscape-primary'
  : 'inline-flex max-w-full shrink-0 rounded-capsule border border-jobscape-border-subtle bg-jobscape-soft/70 px-3 py-1 text-[12px] font-medium text-jobscape-primary';
$wrapClass = 'm-0 flex list-none flex-wrap gap-2 p-0';
?>
<?php if ($parts !== []) : ?>
  <ul class="<?= htmlspecialchars($wrapClass, ENT_QUOTES, 'UTF-8') ?>">
    <?php foreach ($parts as $tag) : ?>
      <li class="<?= htmlspecialchars($chipClass, ENT_QUOTES, 'UTF-8') ?>">
        <?= htmlspecialchars($tag, ENT_QUOTES, 'UTF-8') ?></li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>

<?php if (isset($errors)) : ?>
  <?php foreach ($errors as $error) : ?>
    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-4 text-[14px] font-medium text-red-900 shadow-jobscape-soft message"
      role="alert">
      <?= htmlspecialchars((string) $error, ENT_QUOTES, 'UTF-8') ?>
    </div>
  <?php endforeach; ?>
<?php endif; ?>

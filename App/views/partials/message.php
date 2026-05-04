<?php

declare(strict_types=1);

use Framework\Session;

$successMessage = Session::getFlashMessage('success_message');
if ($successMessage !== null) : ?>
  <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-4 text-[14px] font-medium text-emerald-900 shadow-jobscape-soft message"
    role="status">
    <?= htmlspecialchars((string) $successMessage, ENT_QUOTES, 'UTF-8') ?>
  </div>
<?php endif; ?>

<?php
$errorMessage = Session::getFlashMessage('error_message');
if ($errorMessage !== null) : ?>
  <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-4 text-[14px] font-medium text-red-900 shadow-jobscape-soft message"
    role="alert">
    <?= htmlspecialchars((string) $errorMessage, ENT_QUOTES, 'UTF-8') ?>
  </div>
<?php endif; ?>

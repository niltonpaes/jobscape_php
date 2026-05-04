<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>
<?php loadPartial('main-open'); ?>

<div class="mx-auto flex w-full max-w-lg flex-col items-center px-4">
  <div
    class="w-full rounded-2xl border border-jobscape-border-subtle bg-jobscape-surface p-8 text-center shadow-jobscape-soft sm:p-10">
    <h1 class="font-fraunces text-3xl font-semibold tracking-tight text-jobscape-primary md:text-[2rem]">
      <?= htmlspecialchars((string) $status, ENT_QUOTES, 'UTF-8') ?>
    </h1>
    <p class="mt-3 text-[15px] leading-relaxed text-jobscape-secondary">
      <?= htmlspecialchars((string) $message, ENT_QUOTES, 'UTF-8') ?>
    </p>
    <a class="mt-6 inline-flex font-semibold text-jobscape-coral underline-offset-4 hover:underline" href="/listings">Go Back To Listings</a>
  </div>
</div>

<?= loadPartial('footer') ?>

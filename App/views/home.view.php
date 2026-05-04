<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>
<?= loadPartial('showcase-search') ?>
<?= loadPartial('top-banner') ?>
<?php loadPartial('main-open'); ?>
<?= loadPartial('message') ?>

<section class="relative" aria-labelledby="recent-heading">
  <header class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
    <h2 id="recent-heading"
      class="font-fraunces text-[1.875rem] font-semibold tracking-tight text-jobscape-primary sm:text-[2rem] lg:text-[2.125rem]">
      Recent Jobs
    </h2>
    <a href="/listings"
      class="group inline-flex items-center gap-2 text-[15px] font-semibold text-jobscape-primary underline-offset-4 transition hover:text-jobscape-coral hover:underline">
      View all jobs
      <span class="transition group-hover:translate-x-1" aria-hidden="true">&rarr;</span>
    </a>
  </header>

  <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:gap-8">
    <?php foreach ($listings as $listing) : ?>
      <?php
        $title = htmlspecialchars((string) $listing->title, ENT_QUOTES, 'UTF-8');
        $descPlain = htmlspecialchars(strip_tags((string) $listing->description), ENT_QUOTES, 'UTF-8');
        $initial = strtoupper(mb_substr(strip_tags((string) $listing->title), 0, 1));
        $lid = (int) $listing->id;
        ?>
      <article
        class="group relative overflow-hidden rounded-2xl border border-jobscape-border-subtle bg-jobscape-surface shadow-jobscape shadow-jobscape-soft transition duration-200 hover:-translate-y-px">
        <span class="absolute left-0 right-0 top-0 h-[5px] bg-gradient-to-r from-jobscape-coral to-jobscape-terracotta"
          aria-hidden="true"></span>
        <div class="flex gap-5 p-6 pt-[calc(1.5rem+5px)]">
          <div class="flex size-14 shrink-0 items-center justify-center rounded-2xl border border-jobscape-border-subtle bg-jobscape-soft font-fraunces text-lg font-semibold text-jobscape-coral"
            aria-hidden="true"><?= htmlspecialchars($initial, ENT_QUOTES, 'UTF-8') ?></div>
          <div class="flex min-w-0 flex-1 flex-col gap-3">
            <div>
              <h3 class="font-fraunces text-xl font-semibold leading-tight tracking-tight text-jobscape-primary">
                <a href="/listings/<?= $lid ?>"
                  class="hover:text-jobscape-coral focus:outline-none focus-visible:underline"><?= $title ?></a>
              </h3>
              <p class="mt-2 text-[14px] text-jobscape-secondary">
                <strong>Salary:</strong> <?= htmlspecialchars(formatSalary((string) $listing->salary), ENT_QUOTES, 'UTF-8') ?>
              </p>
              <p class="mt-1 text-[13px] font-medium text-jobscape-secondary">
                <i class="fa fa-location-dot text-xs" aria-hidden="true"></i>
                <?= htmlspecialchars((string) $listing->city, ENT_QUOTES, 'UTF-8') ?>,
                <?= htmlspecialchars((string) $listing->state, ENT_QUOTES, 'UTF-8') ?>
              </p>
            </div>
            <p class="line-clamp-3 text-[14px] leading-snug text-jobscape-secondary"><?= $descPlain ?></p>
            <?php if (!empty($listing->tags)) : ?>
              <p class="text-[13px] text-jobscape-secondary">
                <span class="inline-block rounded-capsule border border-jobscape-border-subtle px-3 py-1 text-[12px] font-medium"><?= htmlspecialchars((string) $listing->tags, ENT_QUOTES, 'UTF-8') ?></span>
              </p>
            <?php endif; ?>
            <div class="mt-auto flex justify-end pt-1">
              <a href="/listings/<?= $lid ?>"
                class="inline-flex items-center justify-center rounded-capsule bg-jobscape-coral px-5 py-2 text-[13px] font-semibold text-white shadow-jobscape-soft transition duration-200 hover:-translate-y-px hover:bg-jobscape-coral-dark">
                Details
              </a>
            </div>
          </div>
        </div>
      </article>
    <?php endforeach; ?>
  </div>

  <div class="mt-8 text-center text-[15px] text-jobscape-secondary">
    <a href="/listings"
      class="inline-flex items-center gap-2 font-semibold text-jobscape-primary underline-offset-4 transition hover:text-jobscape-coral hover:underline">
      <i class="fa fa-arrow-alt-circle-right" aria-hidden="true"></i>
      Show All Jobs
    </a>
  </div>
</section>

<?= loadPartial('bottom-banner') ?>
<?= loadPartial('footer') ?>

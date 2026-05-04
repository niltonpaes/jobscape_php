<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>
<?php loadPartial('main-open'); ?>

<?= loadPartial('message') ?>

<section class="mb-8">
  <div class="overflow-hidden rounded-2xl border border-jobscape-border-subtle bg-jobscape-surface p-4 shadow-jobscape-soft md:p-6">
    <div class="flex flex-wrap items-center justify-between gap-3">
      <a class="flex items-center gap-2 px-3 py-2 text-[15px] font-semibold text-jobscape-coral underline-offset-4 hover:text-jobscape-primary hover:underline"
        href="/listings">
        <i class="fa fa-arrow-alt-circle-left" aria-hidden="true"></i>
        Back To Listings
      </a>
      <?php if (Framework\Authorization::isOwner($listing->user_id)) : ?>
        <div class="flex flex-wrap items-center gap-2">
          <a href="/listings/edit/<?= (int) $listing->id ?>"
            class="rounded-capsule bg-jobscape-coral px-4 py-2 text-[14px] font-semibold text-white shadow-jobscape-soft transition hover:bg-jobscape-coral-dark">
            Edit
          </a>
          <form method="POST" onsubmit="return confirm('Are you sure that you want to delete this job?')">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit"
              class="rounded-capsule border border-red-200 bg-red-50 px-4 py-2 text-[14px] font-semibold text-red-700 hover:bg-red-100">
              Delete
            </button>
          </form>
        </div>
      <?php endif; ?>
    </div>

    <div class="mt-4 border-t border-jobscape-border-subtle pt-4">
      <h2 class="font-fraunces text-2xl font-semibold text-jobscape-primary"><?= htmlspecialchars((string) $listing->title, ENT_QUOTES, 'UTF-8') ?></h2>
      <p class="mt-2 text-lg leading-relaxed text-jobscape-secondary">
        <?= nl2br(htmlspecialchars((string) $listing->description, ENT_QUOTES, 'UTF-8')) ?>
      </p>
      <ul class="mt-4 space-y-2 rounded-xl border border-jobscape-border-subtle bg-jobscape-soft/60 p-4 text-[15px] text-jobscape-primary">
        <li><strong>Salary:</strong> <?= htmlspecialchars(formatSalary((string) $listing->salary), ENT_QUOTES, 'UTF-8') ?></li>
        <li><strong>Location:</strong> <?= htmlspecialchars((string) $listing->city, ENT_QUOTES, 'UTF-8') ?>,
          <?= htmlspecialchars((string) $listing->state, ENT_QUOTES, 'UTF-8') ?></li>
        <?php if (!empty($listing->tags)) : ?>
          <li><strong>Tags:</strong> <?= htmlspecialchars((string) $listing->tags, ENT_QUOTES, 'UTF-8') ?></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</section>

<section>
  <h2 class="mb-4 font-fraunces text-xl font-semibold text-jobscape-primary">Job Details</h2>
  <div class="rounded-2xl border border-jobscape-border-subtle bg-jobscape-surface p-6 shadow-jobscape-soft">
    <h3 class="mb-2 text-lg font-semibold text-jobscape-brand">Job Requirements</h3>
    <p class="text-[15px] leading-relaxed text-jobscape-primary">
      <?= nl2br(htmlspecialchars((string) $listing->requirements, ENT_QUOTES, 'UTF-8')) ?>
    </p>
    <h3 class="mb-2 mt-6 text-lg font-semibold text-jobscape-brand">Benefits</h3>
    <p class="text-[15px] leading-relaxed text-jobscape-primary">
      <?= nl2br(htmlspecialchars((string) $listing->benefits, ENT_QUOTES, 'UTF-8')) ?>
    </p>
  </div>

  <p class="my-6 text-[15px] leading-relaxed text-jobscape-secondary">
    Put "Job Application" as the subject of your email and attach your resume.
  </p>
  <a href="mailto:<?= htmlspecialchars((string) $listing->email, ENT_QUOTES, 'UTF-8') ?>"
    class="inline-flex w-full items-center justify-center rounded-capsule bg-jobscape-coral px-5 py-3 text-[15px] font-semibold text-white shadow-jobscape-soft transition hover:bg-jobscape-coral-dark">
    Apply Now
  </a>
</section>

<?= loadPartial('footer') ?>

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
      <?php
      $postedAt = '';
      if (!empty($listing->created_at)) {
        $ts = strtotime((string) $listing->created_at);
        if ($ts !== false) {
          $postedAt = date('M j, Y', $ts);
        }
      }
      $addressLine = '';
      $parts = [];
      if (!empty(trim((string) ($listing->address ?? '')))) {
        $parts[] = htmlspecialchars(trim((string) $listing->address), ENT_QUOTES, 'UTF-8');
      }
      $cityTrim = trim((string) ($listing->city ?? ''));
      $stateTrim = trim((string) ($listing->state ?? ''));
      $cityState = '';
      if ($cityTrim !== '' && $stateTrim !== '') {
        $cityState = $cityTrim . ', ' . $stateTrim;
      } elseif ($cityTrim !== '') {
        $cityState = $cityTrim;
      } elseif ($stateTrim !== '') {
        $cityState = $stateTrim;
      }
      if ($cityState !== '') {
        $parts[] = htmlspecialchars($cityState, ENT_QUOTES, 'UTF-8');
      }
      if ($parts !== []) {
        $addressLine = implode(' · ', $parts);
      }
      ?>
      <ul class="mt-4 space-y-2 rounded-xl border border-jobscape-border-subtle bg-jobscape-soft/60 p-4 text-[15px] text-jobscape-primary">
        <?php if (!empty(trim((string) ($listing->company ?? '')))) : ?>
          <li><strong>Company:</strong> <?= htmlspecialchars(trim((string) $listing->company), ENT_QUOTES, 'UTF-8') ?></li>
        <?php endif; ?>
        <li><strong>Salary:</strong> <?= htmlspecialchars(formatSalary((string) $listing->salary), ENT_QUOTES, 'UTF-8') ?></li>
        <?php if ($addressLine !== '') : ?>
          <li><strong>Location:</strong> <?= $addressLine ?></li>
        <?php endif; ?>
        <?php if (!empty(trim((string) ($listing->phone ?? '')))) :
          $phoneRaw = trim((string) $listing->phone);
          $phoneTel = preg_replace('/[^\d+]/', '', $phoneRaw);
          if ($phoneTel === '') {
            $phoneTel = preg_replace('/\s+/', '', $phoneRaw);
          }
          ?>
          <li><strong>Phone:</strong>
            <?php if ($phoneTel !== '') : ?>
              <a class="font-medium text-jobscape-coral underline-offset-2 hover:underline"
                href="tel:<?= htmlspecialchars($phoneTel, ENT_QUOTES, 'UTF-8') ?>">
                <?= htmlspecialchars($phoneRaw, ENT_QUOTES, 'UTF-8') ?></a>
            <?php else : ?>
              <span><?= htmlspecialchars($phoneRaw, ENT_QUOTES, 'UTF-8') ?></span>
            <?php endif; ?>
          </li>
        <?php endif; ?>
        <?php if (!empty(trim((string) ($listing->email ?? '')))) : ?>
          <li><strong>Listing contact email:</strong>
            <a class="font-medium text-jobscape-coral underline-offset-2 hover:underline"
              href="mailto:<?= htmlspecialchars(trim((string) $listing->email), ENT_QUOTES, 'UTF-8') ?>">
              <?= htmlspecialchars(trim((string) $listing->email), ENT_QUOTES, 'UTF-8') ?></a></li>
        <?php endif; ?>
        <?php $tagList = listingTagParts((string) ($listing->tags ?? '')); ?>
        <?php if ($tagList !== []) : ?>
          <li class="flex flex-col gap-2">
            <strong>Tags:</strong>
            <?php loadPartial('listing-tag-badges', ['tags' => $listing->tags, 'size' => 'md']); ?>
          </li>
        <?php endif; ?>
        <?php if ($postedAt !== '') : ?>
          <li><strong>Posted:</strong> <?= htmlspecialchars($postedAt, ENT_QUOTES, 'UTF-8') ?></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</section>

<?php $hasRequirements = isset($listing->requirements) && trim((string) $listing->requirements) !== ''; ?>
<?php $hasBenefits = isset($listing->benefits) && trim((string) $listing->benefits) !== ''; ?>
<?php if ($hasRequirements || $hasBenefits) : ?>
  <section>
    <h2 class="mb-4 font-fraunces text-xl font-semibold text-jobscape-primary">Job details</h2>
    <div class="rounded-2xl border border-jobscape-border-subtle bg-jobscape-surface p-6 shadow-jobscape-soft">
      <?php if ($hasRequirements) : ?>
        <h3 class="mb-2 text-lg font-semibold text-jobscape-brand">Requirements</h3>
        <p class="text-[15px] leading-relaxed text-jobscape-primary">
          <?= nl2br(htmlspecialchars(trim((string) $listing->requirements), ENT_QUOTES, 'UTF-8')) ?></p>
      <?php endif; ?>
      <?php if ($hasBenefits) : ?>
        <h3 class="mb-2 <?= $hasRequirements ? 'mt-6' : '' ?> text-lg font-semibold text-jobscape-brand">Benefits</h3>
        <p class="text-[15px] leading-relaxed text-jobscape-primary">
          <?= nl2br(htmlspecialchars(trim((string) $listing->benefits), ENT_QUOTES, 'UTF-8')) ?></p>
      <?php endif; ?>
    </div>
  </section>
<?php endif; ?>

<section class="<?= ($hasRequirements || $hasBenefits) ? 'mt-8' : '' ?>">
  <p class="mb-6 text-[15px] leading-relaxed text-jobscape-secondary">
    Put "Job Application" as the subject of your email and attach your resume.
  </p>
  <?php if (!empty(trim((string) ($listing->email ?? '')))) : ?>
    <a href="mailto:<?= htmlspecialchars(trim((string) $listing->email), ENT_QUOTES, 'UTF-8') ?>?subject=<?= rawurlencode('Job Application') ?>"
      class="inline-flex w-full items-center justify-center rounded-capsule bg-jobscape-coral px-5 py-3 text-[15px] font-semibold text-white shadow-jobscape-soft transition hover:bg-jobscape-coral-dark">
      Apply now
    </a>
  <?php else : ?>
    <p class="rounded-xl border border-jobscape-border-subtle bg-jobscape-soft/60 p-4 text-[15px] text-jobscape-secondary">
      No contact email is listed for this posting.
    </p>
  <?php endif; ?>
</section>

<?= loadPartial('footer') ?>

<?php

declare(strict_types=1);

$inp = 'w-full rounded-xl border border-jobscape-border-subtle bg-jobscape-surface px-4 py-3 text-[15px] text-jobscape-primary shadow-jobscape-soft placeholder:text-jobscape-secondary/75 focus:border-jobscape-coral focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-jobscape-coral/45';
$ta = $inp . ' min-h-[10rem] resize-y';

?>
<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>
<?php loadPartial('main-open'); ?>

<div class="mx-auto w-full max-w-3xl rounded-2xl border border-jobscape-border-subtle bg-jobscape-surface p-8 shadow-jobscape-soft md:p-10">
  <h1 class="mb-10 text-center font-fraunces text-4xl font-bold tracking-tight text-jobscape-primary">
    Edit Job Listing
  </h1>

  <form method="POST" action="/listings/<?= (int) $listing->id ?>" class="space-y-5">
    <input type="hidden" name="_method" value="PUT">

    <h2 class="font-fraunces mb-2 text-center text-2xl font-semibold text-jobscape-secondary">
      Job Info
    </h2>
    <?= loadPartial('errors', ['errors' => $errors ?? []]) ?>

    <input type="text" name="title" placeholder="Job Title" class="<?= $inp ?>" value="<?= htmlspecialchars((string) ($listing->title ?? ''), ENT_QUOTES, 'UTF-8') ?>">
    <textarea name="description" placeholder="Job Description" class="<?= $ta ?>"><?= htmlspecialchars((string) ($listing->description ?? ''), ENT_QUOTES, 'UTF-8') ?></textarea>
    <input type="text" name="salary" placeholder="Annual Salary" class="<?= $inp ?>" value="<?= htmlspecialchars((string) ($listing->salary ?? ''), ENT_QUOTES, 'UTF-8') ?>">
    <input type="text" name="requirements" placeholder="Requirements" class="<?= $inp ?>" value="<?= htmlspecialchars((string) ($listing->requirements ?? ''), ENT_QUOTES, 'UTF-8') ?>">
    <input type="text" name="benefits" placeholder="Benefits" class="<?= $inp ?>" value="<?= htmlspecialchars((string) ($listing->benefits ?? ''), ENT_QUOTES, 'UTF-8') ?>">
    <input type="text" name="tags" placeholder="Tags" class="<?= $inp ?>" value="<?= htmlspecialchars((string) ($listing->tags ?? ''), ENT_QUOTES, 'UTF-8') ?>">

    <h2 class="font-fraunces pt-4 text-center text-2xl font-semibold text-jobscape-secondary">
      Company Info &amp; Location
    </h2>

    <input type="text" name="company" placeholder="Company Name" class="<?= $inp ?>" value="<?= htmlspecialchars((string) ($listing->company ?? ''), ENT_QUOTES, 'UTF-8') ?>">
    <input type="text" name="address" placeholder="Address" class="<?= $inp ?>" value="<?= htmlspecialchars((string) ($listing->address ?? ''), ENT_QUOTES, 'UTF-8') ?>">
    <input type="text" name="city" placeholder="City" class="<?= $inp ?>" value="<?= htmlspecialchars((string) ($listing->city ?? ''), ENT_QUOTES, 'UTF-8') ?>">
    <input type="text" name="state" placeholder="State" class="<?= $inp ?>" value="<?= htmlspecialchars((string) ($listing->state ?? ''), ENT_QUOTES, 'UTF-8') ?>">
    <input type="text" name="phone" placeholder="Phone" class="<?= $inp ?>" value="<?= htmlspecialchars((string) ($listing->phone ?? ''), ENT_QUOTES, 'UTF-8') ?>">
    <input type="email" name="email" placeholder="Email Address For Applications" class="<?= $inp ?>" value="<?= htmlspecialchars((string) ($listing->email ?? ''), ENT_QUOTES, 'UTF-8') ?>">

    <button type="submit"
      class="mt-8 w-full rounded-capsule bg-jobscape-coral px-6 py-3 font-semibold text-white shadow-jobscape-soft transition hover:bg-jobscape-coral-dark">
      Save
    </button>
    <a href="/listings/<?= (int) $listing->id ?>"
      class="mt-2 block w-full rounded-capsule border border-red-200 bg-red-50 py-3 text-center font-semibold text-red-700 transition hover:bg-red-100">
      Cancel
    </a>
  </form>
</div>

<?= loadPartial('footer') ?>

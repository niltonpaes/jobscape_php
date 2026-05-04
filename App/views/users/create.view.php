<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>
<?php loadPartial('main-open'); ?>

<?php
$inp = 'w-full rounded-xl border border-jobscape-border-subtle bg-jobscape-surface px-4 py-3 text-[15px] text-jobscape-primary shadow-jobscape-soft placeholder:text-jobscape-secondary/75 focus:border-jobscape-coral focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-jobscape-coral/45';
?>

<div
  class="mx-auto mt-8 w-full max-w-md rounded-2xl border border-jobscape-border-subtle bg-jobscape-surface p-8 shadow-jobscape shadow-jobscape-soft sm:p-10">
  <h1 class="text-center font-fraunces text-3xl font-semibold tracking-tight text-jobscape-primary md:text-[2rem]">
    Register
  </h1>
  <p class="mt-2 text-center text-[15px] text-jobscape-secondary">Create an account to publish and track listings.</p>

  <?= loadPartial('errors', ['errors' => $errors ?? []]) ?>

  <form class="mt-8 space-y-5" method="POST" action="/auth/register">
    <input type="text" name="name" placeholder="Full Name" class="<?= $inp ?>" value="<?= htmlspecialchars((string) ($user['name'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
    <input type="email" name="email" placeholder="Email Address" autocomplete="email" class="<?= $inp ?>" value="<?= htmlspecialchars((string) ($user['email'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
    <input type="text" name="city" placeholder="City" class="<?= $inp ?>" value="<?= htmlspecialchars((string) ($user['city'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
    <input type="text" name="state" placeholder="State" class="<?= $inp ?>" value="<?= htmlspecialchars((string) ($user['state'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
    <input type="password" name="password" placeholder="Password" autocomplete="new-password" class="<?= $inp ?>">
    <input type="password" name="password_confirmation" placeholder="Confirm Password" autocomplete="new-password" class="<?= $inp ?>">

    <button type="submit"
      class="w-full rounded-capsule bg-jobscape-coral px-5 py-3 text-[15px] font-semibold text-white shadow-jobscape-soft transition duration-200 hover:-translate-y-px hover:bg-jobscape-coral-dark focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-jobscape-coral/55">
      Register
    </button>

    <p class="pt-2 text-center text-[14px] text-jobscape-secondary">
      Already have an account?
      <a class="font-semibold text-jobscape-coral underline-offset-4 hover:underline" href="/auth/login">Login</a>
    </p>
  </form>
</div>

<?= loadPartial('footer') ?>

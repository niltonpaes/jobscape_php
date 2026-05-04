<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>
<?php loadPartial('main-open'); ?>

<div
  class="mx-auto mt-8 w-full max-w-md rounded-2xl border border-jobscape-border-subtle bg-jobscape-surface p-8 shadow-jobscape shadow-jobscape-soft sm:p-10">
  <h1 class="text-center font-fraunces text-3xl font-semibold tracking-tight text-jobscape-primary md:text-[2rem]">
    Login
  </h1>
  <p class="mt-2 text-center text-[15px] text-jobscape-secondary">Sign in to post and manage listings.</p>

  <?= loadPartial('errors', ['errors' => $errors ?? []]) ?>

  <form class="mt-8 space-y-5" method="POST" action="/auth/login">
    <input type="text" name="email" placeholder="Email Address" autocomplete="username"
      class="w-full rounded-xl border border-jobscape-border-subtle bg-jobscape-surface px-4 py-3 text-[15px] text-jobscape-primary shadow-jobscape-soft placeholder:text-jobscape-secondary/75 focus:border-jobscape-coral focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-jobscape-coral/45">
    <input type="password" name="password" placeholder="Password" autocomplete="current-password"
      class="w-full rounded-xl border border-jobscape-border-subtle bg-jobscape-surface px-4 py-3 text-[15px] text-jobscape-primary shadow-jobscape-soft placeholder:text-jobscape-secondary/75 focus:border-jobscape-coral focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-jobscape-coral/45">

    <button type="submit"
      class="w-full rounded-capsule bg-jobscape-coral px-5 py-3 text-[15px] font-semibold text-white shadow-jobscape-soft transition duration-200 hover:-translate-y-px hover:bg-jobscape-coral-dark focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-jobscape-coral/55">
      Login
    </button>

    <p class="pt-2 text-center text-[14px] text-jobscape-secondary">
      Don't have an account?
      <a class="font-semibold text-jobscape-coral underline-offset-4 hover:underline" href="/auth/register">Register</a>
    </p>
  </form>
</div>

<?= loadPartial('footer') ?>

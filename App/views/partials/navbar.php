<?php

declare(strict_types=1);

use Framework\Session;

$navPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$navPath = is_string($navPath) ? $navPath : '/';
if ($navPath === '') {
    $navPath = '/';
}

$homeActive = $navPath === '/';
$allJobsActive = $navPath === '/listings'
    || $navPath === '/listings/search'
    || (bool) preg_match('#^/listings/\d+#', $navPath);

$loggedIn = Session::has('user');
$welcomeName = $loggedIn ? (string) (Session::get('user')['name'] ?? '') : '';

$navLink = 'text-[15px] font-medium text-jobscape-secondary transition-colors duration-200 hover:text-jobscape-primary shrink-0';
$navActive = 'font-semibold !text-jobscape-primary';

?>
<header class="sticky top-0 z-40 border-b border-jobscape-border-subtle bg-jobscape-nav-bg/95 shadow-jobscape-soft backdrop-blur-md"
    x-data="{ open: false }">
  <div class="mx-auto flex w-full min-h-[56px] max-w-jobscape items-center gap-4 px-6 py-3 sm:px-8 lg:min-h-[60px] lg:py-4">
    <a href="/" class="group flex shrink-0 items-center gap-2.5 sm:gap-3" aria-label="Jobscape — Home">
      <span class="flex size-14 shrink-0 overflow-hidden rounded-[18px] sm:size-[3.75rem] sm:rounded-[20px]" aria-hidden="true">
        <img src="/images/jobscape-logo.svg" alt="" width="60" height="60" class="size-full object-cover" decoding="async">
      </span>
      <span class="font-logo text-[1.8rem] font-semibold tracking-[-0.02em] text-jobscape-brand transition group-hover:text-jobscape-brand-deep sm:text-[2rem] lg:text-[2.125rem]">Jobscape</span>
    </a>

    <div
      class="hidden min-w-0 flex-1 flex-nowrap items-center justify-end gap-4 overflow-x-auto overscroll-x-contain [scrollbar-width:thin] lg:flex xl:gap-8 [&_button]:whitespace-nowrap"
      role="navigation"
      aria-label="Primary">
      <a href="/" class="<?= $navLink ?> <?= $homeActive ? $navActive : '' ?>">Home</a>
      <a href="/listings" class="<?= $navLink ?> <?= $allJobsActive ? $navActive : '' ?>">All Jobs</a>

      <?php if ($loggedIn) : ?>
        <span class="hidden text-[14px] text-jobscape-secondary whitespace-nowrap xl:inline" aria-live="polite">
          Welcome <?= htmlspecialchars($welcomeName, ENT_QUOTES, 'UTF-8') ?>
        </span>
        <div class="flex shrink-0 items-center gap-2 xl:gap-2.5">
          <form method="POST" action="/auth/logout" class="inline shrink-0">
            <button type="submit"
              class="shrink-0 rounded-capsule border border-jobscape-border-subtle bg-transparent px-5 py-2.5 text-[14px] font-semibold text-jobscape-secondary transition hover:border-jobscape-primary/35 hover:bg-jobscape-page focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-jobscape-coral/45">
              Sign out
            </button>
          </form>
          <a href="/listings/create"
            class="shrink-0 rounded-capsule bg-jobscape-coral px-5 py-2.5 text-[14px] font-semibold text-white shadow-jobscape-soft transition duration-200 hover:-translate-y-px hover:bg-jobscape-coral-dark">
            Post a job
          </a>
        </div>
      <?php else : ?>
        <div class="flex shrink-0 items-center gap-2 xl:gap-2.5">
          <a href="/auth/login"
            class="shrink-0 rounded-capsule border border-jobscape-border-subtle bg-transparent px-5 py-2.5 text-[14px] font-semibold text-jobscape-secondary transition hover:border-jobscape-primary/35 hover:bg-jobscape-page focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-jobscape-coral/45">
            Sign In
          </a>
          <a href="/auth/register"
            class="shrink-0 rounded-capsule bg-jobscape-coral px-5 py-2.5 text-[14px] font-semibold text-white shadow-jobscape-soft transition duration-200 hover:-translate-y-px hover:bg-jobscape-coral-dark">
            Sign Up
          </a>
        </div>
      <?php endif; ?>
    </div>

    <button type="button" @click="open = !open" class="ml-auto rounded-lg p-2 text-jobscape-primary lg:hidden"
      aria-controls="mobile-menu" :aria-expanded="open.toString()">
      <span class="sr-only">Toggle menu</span>
      <i class="fa fa-bars text-xl"></i>
    </button>
  </div>

  <div x-show="open" x-cloak x-transition
    class="border-t border-jobscape-border-subtle bg-jobscape-nav-bg px-4 pb-6 pt-3 lg:hidden" id="mobile-menu"
    @click.outside="open = false">
    <nav class="mx-auto flex max-w-jobscape flex-col gap-1 rounded-2xl bg-jobscape-surface p-3 shadow-jobscape-soft" aria-label="Mobile navigation">
      <a href="/"
        class="rounded-xl px-4 py-3 text-jobscape-secondary hover:bg-jobscape-page <?= $homeActive ? 'font-semibold text-jobscape-primary' : '' ?>">Home</a>
      <a href="/listings"
        class="rounded-xl px-4 py-3 text-jobscape-secondary hover:bg-jobscape-page <?= $allJobsActive ? 'font-semibold text-jobscape-primary' : '' ?>">All Jobs</a>

      <?php if ($loggedIn) : ?>
        <hr class="my-2 border-jobscape-border-subtle">
        <form method="POST" action="/auth/logout">
          <button type="submit"
            class="w-full rounded-xl px-4 py-3 text-left text-jobscape-secondary hover:bg-jobscape-page">
            Sign out
          </button>
        </form>
        <a href="/listings/create"
          class="mt-2 rounded-capsule bg-jobscape-coral py-3 text-center font-semibold text-white">
          Post a job
        </a>
      <?php else : ?>
        <hr class="my-2 border-jobscape-border-subtle">
        <a href="/auth/login" class="rounded-xl px-4 py-3 text-jobscape-secondary hover:bg-jobscape-page">Sign In</a>
        <a href="/auth/register"
          class="mt-2 rounded-capsule bg-jobscape-coral py-3 text-center font-semibold text-white">Sign Up</a>
      <?php endif; ?>
    </nav>
  </div>
</header>

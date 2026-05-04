<!-- Homepage hero + search — GET /listings/search -->
<section class="relative bg-jobscape-page pb-0 pt-6 sm:pt-8" aria-labelledby="hero-heading">
  <div class="mx-auto max-w-jobscape px-6 sm:px-8">
    <div
      class="relative overflow-hidden rounded-[24px] border border-jobscape-border-subtle bg-gradient-to-br from-[#F5E8E0] via-jobscape-page to-jobscape-page shadow-jobscape">
      <div class="flex min-h-[min(540px,_calc(100vh-220px))] flex-col lg:flex-row lg:items-stretch">
        <div class="relative h-52 shrink-0 sm:h-64 lg:h-auto lg:w-[58%]">
          <img src="/images/jobscape-hero-dream-workspace-flip.png" alt=""
            class="absolute inset-0 size-full rounded-t-[24px] object-cover lg:rounded-l-[24px] lg:rounded-r-none lg:rounded-t-none"
            width="1536" height="1024" decoding="async" fetchpriority="high">
          <div
            class="pointer-events-none absolute inset-0 rounded-t-[24px] bg-[#8B5343]/18 mix-blend-multiply lg:rounded-l-[24px] lg:rounded-r-none lg:rounded-t-none"
            aria-hidden="true"></div>
        </div>

        <div class="relative z-10 flex flex-1 flex-col justify-center px-6 py-10 lg:-ml-[3rem] xl:-ml-[4.25rem] lg:py-16 lg:pl-2 xl:pr-10">
          <div
            class="rounded-2xl border border-jobscape-border-subtle/70 bg-jobscape-surface p-8 shadow-jobscape shadow-jobscape-soft md:p-10">
            <h1 id="hero-heading"
              class="font-fraunces text-[2.5rem] font-semibold leading-[1.08] tracking-tight text-jobscape-primary md:text-[2.75rem] md:leading-[1.06] lg:text-[3rem]">
              Find Your <em class="not-italic text-jobscape-coral">Dream</em> Job
            </h1>
            <p class="mt-3 max-w-xl text-[15px] leading-relaxed text-jobscape-secondary md:text-base">
              Discover listings that match your skills—search by keyword and location.
            </p>
            <div class="mt-8">
              <form method="GET" action="/listings/search" class="space-y-3" role="search" aria-label="Search listings">
                <div class="rounded-2xl bg-jobscape-soft p-4 md:p-5">
                  <div class="flex flex-col gap-3 md:gap-4">
                    <div class="flex w-full flex-col gap-3">
                      <label class="relative block w-full">
                        <span class="sr-only">Keywords</span>
                        <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-jobscape-secondary"
                          aria-hidden="true"><i class="fa fa-search text-sm"></i></span>
                        <input type="text" name="keywords" placeholder="Keywords"
                          class="h-12 w-full rounded-xl border border-jobscape-border-subtle bg-jobscape-surface pl-11 pr-4 text-[15px] text-jobscape-primary shadow-jobscape-soft placeholder:text-jobscape-secondary/80 focus:border-jobscape-coral focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-jobscape-coral/45">
                      </label>
                      <label class="relative block w-full">
                        <span class="sr-only">Location</span>
                        <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-jobscape-secondary"
                          aria-hidden="true"><i class="fa fa-location-dot text-sm"></i></span>
                        <input type="text" name="location" placeholder="Location"
                          class="h-12 w-full rounded-xl border border-jobscape-border-subtle bg-jobscape-surface pl-11 pr-4 text-[15px] text-jobscape-primary shadow-jobscape-soft placeholder:text-jobscape-secondary/80 focus:border-jobscape-coral focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-jobscape-coral/45">
                      </label>
                    </div>
                    <div class="flex justify-end">
                      <button type="submit"
                        class="inline-flex h-12 shrink-0 items-center justify-center gap-2 rounded-capsule bg-jobscape-coral px-8 text-[15px] font-semibold text-white shadow-jobscape-soft transition duration-200 hover:-translate-y-px hover:bg-jobscape-coral-dark focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-jobscape-coral/45">
                        <i class="fa fa-magnifying-glass text-sm" aria-hidden="true"></i>
                        Search
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

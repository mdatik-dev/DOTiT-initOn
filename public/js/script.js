(function () {
  const $ = (selector) => document.querySelector(selector);
  const $$ = (selector) => document.querySelectorAll(selector);
  const year = $('#year');

  if (year) {
    year.textContent = new Date().getFullYear();
  }

  const header = $('#header');
  const backToTop = $('.back-top');

  const updateScrollState = () => {
    const scrollPosition = window.scrollY;

    if (header) {
      header.classList.toggle('scrolled', scrollPosition > 30);
    }

    if (backToTop) {
      backToTop.classList.toggle('show', scrollPosition > 500);
    }
  };

  window.addEventListener('scroll', updateScrollState, { passive: true });
  updateScrollState();

  backToTop?.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  const menu = $('.menu-toggle');
  const links = $('.nav-links');

  if (menu && links) {
    menu.addEventListener('click', () => {
      const isOpen = links.classList.toggle('open');
      menu.setAttribute('aria-expanded', String(isOpen));
    });

    $$('.nav-links a').forEach((link) => {
      link.addEventListener('click', () => {
        links.classList.remove('open');
        menu.setAttribute('aria-expanded', 'false');
      });
    });
  }

  const cursorGlow = $('.cursor-glow');

  if (cursorGlow && window.matchMedia('(pointer: fine)').matches) {
    document.addEventListener('mousemove', (event) => {
      cursorGlow.style.left = `${event.clientX}px`;
      cursorGlow.style.top = `${event.clientY}px`;
    }, { passive: true });
  }

  const motionElements = Array.from($$('.reveal, .reveal-scale'));
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  if (!motionElements.length || prefersReducedMotion || document.hidden) {
    return;
  }

  const grids = new Map();

  motionElements.forEach((element) => {
    const grid = element.closest('.service-grid, .marketing-list, .process-grid, .feature-strip');

    if (!grid) {
      element.dataset.motionDelay = '0';
      return;
    }

    if (!grids.has(grid)) {
      grids.set(grid, 0);
    }

    const index = grids.get(grid);
    grids.set(grid, index + 1);
    element.dataset.motionDelay = String(Math.min(index * 0.065, 0.39));
  });

  document.documentElement.classList.add('motion-ready');

  const revealElement = (element) => {
    if (element.dataset.motionShown === 'true') {
      return;
    }

    element.dataset.motionShown = 'true';
    element.classList.add('is-visible');
    const delay = Number(element.dataset.motionDelay || 0);
    const isScaleReveal = element.classList.contains('reveal-scale');

    if (window.gsap) {
      window.gsap.fromTo(
        element,
        {
          autoAlpha: 0,
          y: isScaleReveal ? 0 : 30,
          scale: isScaleReveal ? 0.94 : 1,
        },
        {
          autoAlpha: 1,
          y: 0,
          scale: 1,
          duration: isScaleReveal ? 0.8 : 0.7,
          delay,
          ease: 'power3.out',
          clearProps: 'opacity,visibility,transform',
        },
      );
    } else {
      element.classList.add('is-visible');
    }
  };

  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries, currentObserver) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          revealElement(entry.target);
          currentObserver.unobserve(entry.target);
        }
      });
    }, {
      threshold: 0.08,
      rootMargin: '0px 0px -35px 0px',
    });

    motionElements.forEach((element) => observer.observe(element));
  } else {
    motionElements.forEach(revealElement);
  }

  const heroTitleLines = $$('.hero-title .line');
  const heroEyebrow = $('.hero .eyebrow');

  if (window.gsap && heroTitleLines.length && !prefersReducedMotion) {
    window.gsap.fromTo(
      heroTitleLines,
      { y: 54, autoAlpha: 0 },
      {
        y: 0,
        autoAlpha: 1,
        duration: 0.85,
        stagger: 0.14,
        delay: 0.12,
        ease: 'power4.out',
        clearProps: 'opacity,visibility,transform',
      },
    );
  }

  if (window.gsap && heroEyebrow && !prefersReducedMotion) {
    window.gsap.fromTo(
      heroEyebrow,
      { y: 16, autoAlpha: 0 },
      {
        y: 0,
        autoAlpha: 1,
        duration: 0.65,
        ease: 'power3.out',
        clearProps: 'opacity,visibility,transform',
      },
    );
  }
})();

document.addEventListener('DOMContentLoaded', () => {
  const sidebarToggle = document.querySelector('.admin-sidebar-toggle');
  const sidebarShell = document.querySelector('.admin-shell');

  if (sidebarToggle instanceof HTMLButtonElement && sidebarShell instanceof HTMLElement) {
    const savedCollapsed = localStorage.getItem('dotit-admin-sidebar-collapsed') === 'true';
    const applySidebarState = (collapsed) => {
      sidebarShell.classList.toggle('sidebar-collapsed', collapsed);
      sidebarToggle.setAttribute('aria-expanded', String(!collapsed));
      sidebarToggle.setAttribute('aria-label', collapsed ? 'Expand sidebar' : 'Collapse sidebar');
      sidebarToggle.setAttribute('title', collapsed ? 'Expand sidebar' : 'Collapse sidebar');
      sidebarToggle.innerHTML = `<i class="fa-solid ${collapsed ? 'fa-chevron-right' : 'fa-chevron-left'}" aria-hidden="true"></i>`;
    };

    applySidebarState(savedCollapsed);
    sidebarToggle.addEventListener('click', () => {
      const collapsed = !sidebarShell.classList.contains('sidebar-collapsed');
      applySidebarState(collapsed);
      localStorage.setItem('dotit-admin-sidebar-collapsed', String(collapsed));
    });
  }

  const toggle = document.querySelector('.admin-theme-toggle');

  if (!(toggle instanceof HTMLButtonElement)) {
    return;
  }

  const root = document.documentElement;
  const updateToggle = () => {
    const isLight = root.dataset.adminTheme === 'light';
    const label = isLight ? 'Switch to dark theme' : 'Switch to light theme';

    toggle.setAttribute('aria-label', label);
    toggle.setAttribute('title', label);
    toggle.setAttribute('aria-pressed', String(isLight));
    toggle.innerHTML = `<i class="fa-solid ${isLight ? 'fa-moon' : 'fa-sun'}" aria-hidden="true"></i><span>${isLight ? 'Dark mode' : 'Light mode'}</span>`;
  };

  updateToggle();

  toggle.addEventListener('click', () => {
    const theme = root.dataset.adminTheme === 'light' ? 'dark' : 'light';
    root.dataset.adminTheme = theme;

    try {
      localStorage.setItem('dotit-admin-theme', theme);
    } catch (error) {
      console.warn('Could not save the admin theme preference.', error);
    }

    updateToggle();
  });
});

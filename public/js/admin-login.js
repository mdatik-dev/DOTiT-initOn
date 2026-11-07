document.addEventListener('DOMContentLoaded', () => {
  const password = document.querySelector('#password');
  const toggle = document.querySelector('.admin-password-toggle');

  if (!(password instanceof HTMLInputElement) || !(toggle instanceof HTMLButtonElement)) {
    return;
  }

  toggle.addEventListener('click', () => {
    const isVisible = password.type === 'text';

    password.type = isVisible ? 'password' : 'text';
    toggle.setAttribute('aria-pressed', String(!isVisible));
    toggle.setAttribute('aria-label', isVisible ? 'Show password' : 'Hide password');
    toggle.innerHTML = `<i class="fa-regular ${isVisible ? 'fa-eye' : 'fa-eye-slash'}" aria-hidden="true"></i>`;
    password.focus();
  });
});

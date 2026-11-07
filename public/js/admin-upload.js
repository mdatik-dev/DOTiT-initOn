document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('[data-admin-upload]').forEach((box) => {
    const input = box.querySelector('input[type="file"]');
    const preview = box.querySelector('.admin-upload-preview');
    const hiddenRemove = box.querySelector('input[type="hidden"][name^="remove_"]');
    const previewType = box.dataset.previewType;

    const clearPreview = () => {
      input.value = '';
      preview.replaceChildren();
      preview.classList.add('is-empty');
      if (hiddenRemove) hiddenRemove.value = '0';
    };

    const addRemoveButton = () => {
      preview.querySelector('.admin-upload-remove')?.addEventListener('click', () => {
        clearPreview();
        if (hiddenRemove) hiddenRemove.value = '1';
      });
    };

    addRemoveButton();
    input.addEventListener('change', () => {
      const file = input.files && input.files[0];
      if (!file) return;

      preview.replaceChildren();
      preview.classList.remove('is-empty');
      if (hiddenRemove) hiddenRemove.value = '0';

      const removeButton = document.createElement('button');
      removeButton.type = 'button';
      removeButton.className = 'admin-upload-remove';
      removeButton.setAttribute('aria-label', 'Remove selected file');
      removeButton.innerHTML = '<i class="fa-solid fa-xmark"></i>';
      preview.appendChild(removeButton);
      removeButton.addEventListener('click', () => clearPreview());

      if (previewType === 'image') {
        const image = document.createElement('img');
        image.alt = 'Selected image preview';
        image.src = URL.createObjectURL(file);
        image.addEventListener('load', () => URL.revokeObjectURL(image.src), { once: true });
        preview.appendChild(image);
      } else {
        const icon = document.createElement('i');
        icon.className = 'fa-solid fa-file-pdf';
        const name = document.createElement('strong');
        name.textContent = file.name;
        preview.classList.add('admin-file-preview');
        preview.append(icon, name);
      }
    });

    ['dragenter', 'dragover'].forEach((eventName) => {
      box.addEventListener(eventName, (event) => {
        event.preventDefault();
        box.classList.add('is-dragging');
      });
    });
    ['dragleave', 'drop'].forEach((eventName) => {
      box.addEventListener(eventName, (event) => {
        event.preventDefault();
        box.classList.remove('is-dragging');
      });
    });
    box.addEventListener('drop', (event) => {
      if (!event.dataTransfer?.files?.length) return;
      const transfer = new DataTransfer();
      transfer.items.add(event.dataTransfer.files[0]);
      input.files = transfer.files;
      input.dispatchEvent(new Event('change', { bubbles: true }));
    });
  });
});

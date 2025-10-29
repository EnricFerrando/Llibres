import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Image preview helper: any <input type="file" class="image-input" data-preview-target="#id"> will
// show a preview image in the target <img> element. The target can have `data-default-src` to restore.
document.addEventListener('DOMContentLoaded', () => {
	document.querySelectorAll('input.image-input[type="file"]').forEach(input => {
		input.addEventListener('change', (e) => {
			const file = e.target.files && e.target.files[0];
			const selector = e.target.dataset.previewTarget || e.target.getAttribute('data-preview-target');
			const target = selector ? document.querySelector(selector) : null;
			if (!target) return;

			if (file) {
				try {
					const url = URL.createObjectURL(file);
					target.src = url;
					target.classList.remove('hidden');
				} catch (err) {
					console.error('Could not create preview URL', err);
				}
			} else {
				// restore default if provided
				if (target.dataset.defaultSrc) {
					target.src = target.dataset.defaultSrc;
				} else {
					target.src = '';
					target.classList.add('hidden');
				}
			}
		});
	});
});

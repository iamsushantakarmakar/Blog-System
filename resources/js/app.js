import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Character counter
const contentTextarea = document.getElementById('content');
const charCount = document.getElementById('charCount');

contentTextarea.addEventListener('input', function () {
    const count = this.value.length;
    charCount.textContent = count + ' character' + (count !== 1 ? 's' : '');
});

// Prevent double submission
document.getElementById('createPostForm').addEventListener('submit', function (e) {
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');

    if (submitBtn.disabled) {
        e.preventDefault();
        return false;
    }

    submitBtn.disabled = true;
    submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
    btnText.textContent = 'Publishing...';
});

// Auto-save draft to localStorage (optional enhancement)
const titleInput = document.getElementById('title');
const contentInput = document.getElementById('content');

// Load saved draft
if (localStorage.getItem('post_draft_title')) {
    if (!titleInput.value) titleInput.value = localStorage.getItem('post_draft_title');
}
if (localStorage.getItem('post_draft_content')) {
    if (!contentInput.value) contentInput.value = localStorage.getItem('post_draft_content');
    contentInput.dispatchEvent(new Event('input')); // Update char count
}

// Save draft on input
titleInput.addEventListener('input', () => {
    localStorage.setItem('post_draft_title', titleInput.value);
});

contentInput.addEventListener('input', () => {
    localStorage.setItem('post_draft_content', contentInput.value);
});

// Clear draft on successful submit
document.getElementById('createPostForm').addEventListener('submit', function () {
    setTimeout(() => {
        localStorage.removeItem('post_draft_title');
        localStorage.removeItem('post_draft_content');
    }, 500);
});

// Refresh CSRF token before form submission
async function refreshCsrfToken() {
    try {
        const response = await fetch('/refresh-csrf', {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        const data = await response.json();
        document.querySelector('input[name="_token"]').value = data.token;
        document.getElementById('csrf-token').value = data.token;
    } catch (error) {
        console.error('Failed to refresh CSRF token:', error);
    }
}

// Set initial count
function updateCharCount() {
    const count = contentTextarea.value.length;
    charCount.textContent = count + ' character' + (count !== 1 ? 's' : '');
}

updateCharCount(); // Initial count on page load

contentTextarea.addEventListener('input', updateCharCount);

// Prevent double submission with multiple safeguards
let isSubmitting = false;
const form = document.getElementById('editPostForm');

form.addEventListener('submit', async function (e) {
    e.preventDefault(); // Prevent default submission

    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');

    // Check if already submitting
    if (isSubmitting || submitBtn.disabled) {
        return false;
    }

    // Set submitting flag
    isSubmitting = true;

    // Disable button and show loading state
    submitBtn.disabled = true;
    submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
    btnText.textContent = 'Updating...';

    // Disable the entire form
    const formElements = form.querySelectorAll('input, textarea, button');
    formElements.forEach(element => {
        element.disabled = true;
    });

    // Refresh CSRF token before submission
    await refreshCsrfToken();

    // Submit the form
    form.submit();
});

// Track changes to warn user about unsaved changes
let originalTitle = document.getElementById('title').value;
let originalContent = document.getElementById('content').value;
let hasChanges = false;

function checkForChanges() {
    const currentTitle = document.getElementById('title').value;
    const currentContent = document.getElementById('content').value;
    hasChanges = (currentTitle !== originalTitle) || (currentContent !== originalContent);
}

document.getElementById('title').addEventListener('input', checkForChanges);
document.getElementById('content').addEventListener('input', checkForChanges);

// Warn user about unsaved changes
window.addEventListener('beforeunload', function (e) {
    if (hasChanges && !isSubmitting) {
        e.preventDefault();
        e.returnValue = '';
        return '';
    }
});

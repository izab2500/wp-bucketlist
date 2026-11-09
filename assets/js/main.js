
document.addEventListener('DOMContentLoaded', () => {
    // Mobile navigation
    const menuToggle = document.getElementById('menuToggle');
    const mainNavigation = document.getElementById('mainNavigation');

    if (menuToggle && mainNavigation) {
        menuToggle.addEventListener('click', () => {
            const isOpen = mainNavigation.classList.toggle('open');

            menuToggle.setAttribute('aria-expanded', String(isOpen));
            menuToggle.setAttribute(
                'aria-label',
                isOpen ? 'Close navigation menu' : 'Open navigation menu'
            );
        });

        // Close menu when a navigation link is clicked
        const navigationLinks = mainNavigation.querySelectorAll('a');

        navigationLinks.forEach(link => {
            link.addEventListener('click', () => {
                mainNavigation.classList.remove('open');
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.setAttribute('aria-label', 'Open navigation menu');
            });
        });

        // Close menu with Escape
        document.addEventListener('keydown', event => {
            if (event.key === 'Escape') {
                mainNavigation.classList.remove('open');
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.setAttribute('aria-label', 'Open navigation menu');
                menuToggle.focus();
            }
        });

        // Close menu when clicking outside
        document.addEventListener('click', event => {
            const clickedInsideMenu = mainNavigation.contains(event.target);
            const clickedToggle = menuToggle.contains(event.target);

            if (!clickedInsideMenu && !clickedToggle) {
                mainNavigation.classList.remove('open');
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.setAttribute('aria-label', 'Open navigation menu');
            }
        });
    }

    // Confirm before deleting a bucketlist item
    const deleteForms = document.querySelectorAll('.delete-form');

    deleteForms.forEach(form => {
        form.addEventListener('submit', event => {
            const confirmed = window.confirm(
                'Are you sure you want to remove this item from your bucketlist?'
            );

            if (!confirmed) {
                event.preventDefault();
            }
        });
    });

    // Automatically remove temporary messages
    const messages = document.querySelectorAll('.form-success');

    messages.forEach(message => {
        window.setTimeout(() => {
            message.style.transition = 'opacity 0.4s ease';
            message.style.opacity = '0';

            window.setTimeout(() => {
                message.remove();
            }, 400);
        }, 5000);
    });
});

// Preserve scroll position when submitting forms
document.querySelectorAll('form').forEach(form => {

    form.addEventListener('submit', function () {

        sessionStorage.setItem(
            'bucketlistScrollPosition',
            window.scrollY
        );

    });

});

// Restore scroll position after page reload
window.addEventListener('load', function () {

    const scrollPosition = sessionStorage.getItem(
        'bucketlistScrollPosition'
    );

    if (scrollPosition !== null) {

        window.scrollTo({
            top: parseInt(scrollPosition, 10),
            behavior: 'instant'
        });

        sessionStorage.removeItem('bucketlistScrollPosition');
    }

});
document.addEventListener('DOMContentLoaded', function() {
    const profileDropdown = document.getElementById('profileDropdown');
    const profileDropdownMenu = document.getElementById('profileDropdownMenu');

    if (profileDropdown) {
        profileDropdown.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !isExpanded);

            profileDropdownMenu.style.display = !isExpanded ? 'block' : 'none';

            // Close dropdown when clicking outside
            document.addEventListener('click', function closeDropdown(e) {
                if (!profileDropdown.contains(e.target) && !profileDropdownMenu.contains(e.target)) {
                    profileDropdownMenu.style.display = 'none';
                    profileDropdown.setAttribute('aria-expanded', 'false');
                    document.removeEventListener('click', closeDropdown);
                }
            });
        });
    }
});

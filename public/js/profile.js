
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    const tabs = document.querySelectorAll('[data-tab]');
    const sections = document.querySelectorAll('[data-section]');

    // Get active tab from session storage or default to 'overview'
    const activeTab = sessionStorage.getItem('activeProfileTab') || 'overview';
    showSection(activeTab);

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const tabName = tab.dataset.tab;
            showSection(tabName);
            sessionStorage.setItem('activeProfileTab', tabName);
        });
    });

    function showSection(sectionName) {
        // Update tab styles
        tabs.forEach(tab => {
            if (tab.dataset.tab === sectionName) {
                tab.classList.add('border-blue-500', 'text-blue-600');
                tab.classList.remove('text-gray-500', 'border-transparent');
            } else {
                tab.classList.remove('border-blue-500', 'text-blue-600');
                tab.classList.add('text-gray-500', 'border-transparent');
            }
        });

        // Show/hide sections
        sections.forEach(section => {
            section.classList.toggle('hidden', section.dataset.section !== sectionName);
        });
    }

    // Profile image upload
    const profileImageInput = document.getElementById('profile-image-input');
    const profileImagePreview = document.getElementById('profile-image-preview');

    if (profileImageInput && profileImagePreview) {
        profileImageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profileImagePreview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    }

    // Article actions menu
    document.querySelectorAll('.article-menu-button').forEach(button => {
        button.addEventListener('click', (e) => {
            e.stopPropagation();
            const menu = button.nextElementSibling;
            menu.classList.toggle('hidden');

            // Close other menus
            document.querySelectorAll('.article-menu').forEach(m => {
                if (m !== menu) m.classList.add('hidden');
            });
        });
    });

    // Close menus when clicking outside
    document.addEventListener('click', () => {
        document.querySelectorAll('.article-menu').forEach(menu => {
            menu.classList.add('hidden');
        });
    });

    // Initialize Chart.js statistics
    const ctx = document.getElementById('profileStats');
    if (ctx) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Articles', 'Products', 'Favorites'],
                datasets: [{
                    label: 'Activity Statistics',
                    data: [
                        document.querySelector('[data-stats="articles"]').value,
                        document.querySelector('[data-stats="products"]').value,
                        document.querySelector('[data-stats="favorites"]').value
                    ],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.5)',
                        'rgba(16, 185, 129, 0.5)',
                        'rgba(249, 115, 22, 0.5)'
                    ],
                    borderColor: [
                        'rgb(59, 130, 246)',
                        'rgb(16, 185, 129)',
                        'rgb(249, 115, 22)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    }
});

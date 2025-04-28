document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle functionality
    const menuItems = document.querySelectorAll('.menu li');

    menuItems.forEach(item => {
        item.addEventListener('click', function() {
            // Remove active class from all items
            menuItems.forEach(i => i.classList.remove('active'));

            // Add active class to clicked item
            this.classList.add('active');
        });
    });

    // Notification dropdown (would be implemented with more functionality)
    const notification = document.querySelector('.notification');
    notification.addEventListener('click', function() {
        alert('You have 3 new notifications');
    });

    // User profile dropdown (would be implemented with more functionality)
    const userProfile = document.querySelector('.user-profile');
    userProfile.addEventListener('click', function() {
        alert('Profile options would appear here');
    });

    // Search functionality (basic)
    const searchInput = document.querySelector('.search-bar input');
    const searchButton = document.querySelector('.search-bar button');

    searchButton.addEventListener('click', function() {
        if (searchInput.value.trim() !== '') {
            alert(`Searching for: ${searchInput.value}`);
        }
    });

    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' && searchInput.value.trim() !== '') {
            alert(`Searching for: ${searchInput.value}`);
        }
    });

    // Simulate loading data (in a real app, this would be an API call)
    setTimeout(() => {
        console.log('Data loaded successfully');
    }, 1000);
});

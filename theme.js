// Function to set a cookie
function setCookie(name, value, days) {
    const expires = new Date();
    expires.setTime(expires.getTime() + days * 24 * 60 * 60 * 1000);
    document.cookie = name + '=' + value + ';expires=' + expires.toUTCString();
}

// Function to get a cookie
function getCookie(name) {
    const keyValue = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
    return keyValue ? keyValue[2] : null;
}

// Function to apply the user's theme preference
function applyTheme() {
    const themeSelector = document.getElementById('theme-selector');
    const selectedTheme = themeSelector.options[themeSelector.selectedIndex].value;

    // Apply the selected theme
    document.body.className = selectedTheme;

    // Save the theme preference in a cookie
    setCookie('theme', selectedTheme, 365); // Save the theme preference for 1 year
}

// Apply the saved theme preference on page load
window.addEventListener('load', function () {
    const savedTheme = getCookie('theme');
    if (savedTheme) {
        // Set the theme selector to the saved theme
        const themeSelector = document.getElementById('theme-selector');
        themeSelector.value = savedTheme;

        // Apply the saved theme
        applyTheme();
    }
});

// Event listener for theme selection form submission
document.getElementById('theme-form').addEventListener('submit', function (e) {
    e.preventDefault();
    applyTheme();
});

jQuery(function () {
    var userDropdown = function () {
        let userDropDownButton = $('#page-header-user-dropdown');
        userDropDownButton.on('click', function (e) {
            e.preventDefault();
            userDropDownButton.next().toggleClass('show');
            userDropDownButton.parent().toggleClass('show');
        })
    };
    userDropdown();
});

// Function to convert UTC date to local user date on page
jQuery(function() {
    let elements = document.querySelectorAll('.js-utc-to-local');
    elements.forEach(function (element) {
        let dateString = element.innerHTML;
        let dateUtc = new Date(dateString + " UTC");
        element.innerHTML = dateUtc.toLocaleDateString() + " " + dateUtc.toLocaleTimeString();
    });
});

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

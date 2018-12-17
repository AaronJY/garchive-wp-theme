(function($) {
    var postGrid,
        search,
        searchbox;

    $(document).ready(function() {
        postGrid = $('#postGrid');
        search = $('#search');
        searchbox = $('#searchBox')

        initPostGrid(postGrid, '.gar-post-box');
        initSearch('a[data-toggle=search]', search, searchbox);
    });
    
    function initSearch(toggleSelector, search, searchbox) {
        $(toggleSelector).click(function(e) {
            e.preventDefault();

            search.toggleClass('open');
            if (search.hasClass('open')) {
                searchbox.focus();
            }
        });
    }

    function initPostGrid(grid, itemSelector) {
        // Don't init masonry if there are no items
        if (!$(itemSelector).length)
            return;
            
        grid.masonry({
            itemSelector: itemSelector,
            percentPosition: true,
            gutter: 20
        });
    }
})(jQuery);
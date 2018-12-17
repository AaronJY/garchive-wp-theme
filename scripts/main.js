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
        initTinyMCE('.rte');
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

    function initTinyMCE(editorSelector) {
        if (typeof tinymce === 'undefined')
            return;

        tinymce.init({
            selector: editorSelector,
            menu: {},
            style_formats: [
                {title: 'Heading 2', format: 'h2'},
                {title: 'Heading 3', format: 'h3'},
                {title: 'Heading 4', format: 'h4'},
                {title: 'Heading 5', format: 'h5'},
                {title: 'Heading 6', format: 'h6'},
                {title: 'Normal', block: 'p'}
            ],
            toolbar: 'undo redo | styleselect | bold italic | link | numlist bullist',
            plugins: ['lists', 'link'],
            setup: function (editor) {
                editor.on('change', function () {
                    editor.save();
                });
            }
        });
    }
})(jQuery);
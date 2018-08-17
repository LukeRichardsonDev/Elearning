var $ = require('jquery');
jQuery(document).ready(function () {
    var $button = $(".course-create");
    var $container = $(".create-container");
    $button.on('click', function (e) {
        if ($container.find('form').length === 0) {
            $.ajax({
                type: 'get',
                url: '/create-course',
                success: function (data) {
                    $container.append(data['formHtml']);
                    addButton();
                },
                error: function (jqXHR) {
                    $button.replaceWith('error');
                },
            });
        }
    });

    function addButton() {
        var $collectionHolder;
        var $addContentButton = $('<button type="button" class="add_content_link">Add more content</button>');
        var $newLinkLi = $('<li class="button"></li>').append($addContentButton);
        $collectionHolder = $('ul.content');
        $collectionHolder.append($newLinkLi);
        $collectionHolder.data('index', $collectionHolder.find(':input').length);

        $addContentButton.on('click', function (e) {
            addContentForm($collectionHolder, $newLinkLi);
        });
        $collectionHolder.find('li:not(.button)').each(function () {
            addContentFormDeleteLink($(this));
        });
    }

    function addContentForm($collectionHolder, $newLinkLi) {
        var prototype = $collectionHolder.data('prototype');
        var index = $collectionHolder.data('index');
        var newForm = prototype;

        newForm = newForm.replace(/__name__/g, index);
        $collectionHolder.data('index', index + 1);

        var $newFormLi = $('<li></li>').append(newForm);
        $newLinkLi.before($newFormLi);
        addContentFormDeleteLink($newFormLi);

        var $save = $("#save");
        $save.on('click', function (e) {
            $.ajax({
                type: 'post',
                dataType: 'x-www-form-urlencoded',
                url: '/create-course',
                data: $container.find('form').serialize(),
                success: function (data) {
                    $container.append('<p>' + data['success'] + '</p>');
                },
                error: function (jqXHR) {
                    $button.replaceWith('error');
                },
            });
        });
    }

    function addContentFormDeleteLink($contentFormLi) {
        var $removeFormButton = $('<button type="button">Delete content</button>');
        $contentFormLi.append($removeFormButton);

        $removeFormButton.on('click', function (e) {
            $contentFormLi.remove();
        });
    }

}
);
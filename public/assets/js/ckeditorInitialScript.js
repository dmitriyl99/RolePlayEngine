jQuery(function(){
    // Init full text editor
    if (jQuery('#js-ckeditor:not(.js-ckeditor-enabled)').length) {

        CKEDITOR.replace('js-ckeditor', {
            toolbar: [
                { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                { name: 'editing', groups: [ 'find', 'selection' ], items: [ 'Find', 'Replace', '-', 'SelectAll' ] },
                '/',
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
                { name: 'paragraph', groups: [ 'list', 'blocks', 'align' ], items: [ 'NumberedList', 'BulletedList', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
                { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'Smiley', 'Spoiler' ] },
                '/',
                { name: 'styles', items: ['Format', 'FontSize' ] },
                { name: 'colors', items: [ 'TextColor' ] },
                { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
                { name: 'others', items: [ '-' ] },
                { name: 'about', items: [ 'About' ] }
            ],
            language: 'ru',
            // Adding drag and drop image upload.
            extraPlugins: 'print,format,font,colorbutton,justify,uploadimage,spoiler',
            // Configure your file manager integration. This example uses CKFinder 3 for PHP.
            filebrowserUploadUrl: '/ckfinder/upload/image',
            removeDialogTabs: 'image:advanced;link:advanced,image:Link'
        });

        // Add .js-ckeditor-enabled class to tag it as activated
        jQuery('#js-ckeditor').addClass('js-ckeditor-enabled');
    }
});

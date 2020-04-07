tinymce.init({
    /* replace textarea having class .tinymce with tinymce editor */
    selector: "textarea.tinymce",
    plugin: 'a_tinymce_plugin',
    a_plugin_option: true,
    a_configuration_option: 400,
    height: 400,
    autoresize_min_height: 400,
    autoresize_max_height: 800,

    toolbar: [
        'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol '
    ],
    plugins: [
        'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
        'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
        'save table directionality emoticons template paste',
        'autoresize'
    ],
});
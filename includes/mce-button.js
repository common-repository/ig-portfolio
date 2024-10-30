(function () {
    tinymce.PluginManager.add('ig_portfolio_mce_button', function( editor, url ) {
        editor.addButton( 'ig_portfolio_mce_button' ,{
            text: 'IG Portfolio',
            icon: false,
            type: 'menubutton',
            menu: [
                // ACCORDION
                {
                    text: 'Portfolio',
                    onclick: function() {
                    editor.insertContent('[ig-portfolio image="true" meta="true" style="normal" perpage=""]');
                    },
                },
                // BUTTONS
                {
                    text: 'Portfolio gallery',
                    onclick: function() {
                    editor.insertContent('[ig-portfolio-gallery cat="" perpage=""]');
                    },
                },
            ]
        });
    });
})();

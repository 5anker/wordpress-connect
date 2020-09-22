(function( $ ) {
	'use strict';

	$(function(){
        if( $('[name="connect_options[config]"]').length ) {
            var editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};
            editorSettings.codemirror = _.extend(
                {},
                editorSettings.codemirror,
                {
                    indentUnit: 2,
                    tabSize: 2,
                    mode: 'application/json',
                }
            );
            var editor = wp.codeEditor.initialize( $('[name="connect_options[config]"]'), editorSettings );
        }
    });

})( jQuery );

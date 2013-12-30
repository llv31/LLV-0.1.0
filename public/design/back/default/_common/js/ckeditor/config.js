/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';
    config.toolbarGroups = [
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align' ] },
        { name: 'links' },
        { name: 'styles' },
//        { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
//        { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
//        { name: 'insert' },
//        { name: 'document',    groups: [ 'mode', 'document', 'doctools' ] },
//        { name: 'others' },
//        { name: 'colors' },
        { name: 'tools' }
    ];
    config.removeButtons = 'Flash,HorizontalRule,Smiley,SpecialChar,PageBreak,IFrame,Anchor,Styles,Font,FontSize';
    config.enterMode = CKEDITOR.ENTER_BR;
};

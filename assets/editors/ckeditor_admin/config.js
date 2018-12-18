/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	
	// %REMOVE_START%
	// The configuration options below are needed when running CKEditor from source files.
	config.plugins = 'dialogui,dialog,a11yhelp,dialogadvtab,basicstyles,bidi,blockquote,clipboard,button,panelbutton,panel,floatpanel,colorbutton,colordialog,templates,menu,contextmenu,div,resize,toolbar,elementspath,enterkey,entities,popup,filebrowser,find,fakeobjects,flash,floatingspace,listblock,richcombo,font,forms,format,horizontalrule,htmlwriter,iframe,wysiwygarea,image,indent,indentblock,indentlist,smiley,justify,menubutton,language,link,list,liststyle,magicline,maximize,newpage,pagebreak,pastetext,pastefromword,preview,print,removeformat,save,selectall,showblocks,showborders,sourcearea,specialchar,scayt,stylescombo,tab,table,tabletools,undo,wsc,youtube,videodetector,tableresize,qrc,lineutils,widget,placeholder,mediaembed,chart,uicolor,notification,autosave,pbckcode,codesnippet,codeTag,googledocs,gg,wordcount,videosnapshot,autocorrect,ckeditor-gwf-plugin';
	config.extraPlugins = 'videodetector,youtube,wordcount,videosnapshot,ckeditor-gwf-plugin';
	config.font_names = 'Lobster';
	config.allowedContent = true;
	config.wordcount = {
		// Whether or not you want to show the Paragraphs Count
		showParagraphs: true,
		// Whether or not you want to show the Word Count
		showWordCount: true,
		// Whether or not you want to show the Char Count
		showCharCount: false,
		// Whether or not you want to count Spaces as Chars
		countSpacesAsChars: false,
		// Whether or not to include Html chars in the Char Count
		countHTML: false,
		// Maximum allowed Word Count, -1 is default for unlimited
		maxWordCount: -1,
		// Maximum allowed Char Count, -1 is default for unlimited
		maxCharCount: -1
	};
	config.skin = 'moono';
	// %REMOVE_END%

	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	var base_path_editor = 'assets/editors/';
    config.filebrowserBrowseUrl = base_path_editor + 'ckfinder-admin-9171044bc96788340ea76907d61dfcfac1f71ff9/ckfinder.html';
    config.filebrowserImageBrowseUrl = base_path_editor + 'ckfinder-admin-9171044bc96788340ea76907d61dfcfac1f71ff9/ckfinder.html?type=Images';
    config.filebrowserFlashBrowseUrl = base_path_editor + 'ckfinder-admin-9171044bc96788340ea76907d61dfcfac1f71ff9/ckfinder.html?type=Flash';
    config.filebrowserUploadUrl = base_path_editor + 'ckfinder-admin-9171044bc96788340ea76907d61dfcfac1f71ff9/core/connector/php/connector.php?command=QuickUpload&type=Files';
    config.filebrowserImageUploadUrl = base_path_editor + 'ckfinder-admin-9171044bc96788340ea76907d61dfcfac1f71ff9/core/connector/php/connector.php?command=QuickUpload&type=Images';
    config.filebrowserFlashUploadUrl = base_path_editor + '/ckfinder-admin-9171044bc96788340ea76907d61dfcfac1f71ff9/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};

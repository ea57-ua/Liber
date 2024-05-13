import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

import Editor from '@toast-ui/editor';
import '@toast-ui/editor/dist/toastui-editor.css';

var editorElement = document.querySelector('#advancedEditor');
var editor;
if (editorElement) {
    editor = new Editor({
        el: editorElement,
        height: '500px',
        initialEditType: 'markdown',
    });
}

var submitPostModal = document.getElementById('submitPostModal');

if(submitPostModal) {
    submitPostModal.addEventListener('click', function() {
        document.getElementById('markdownContent').value = editor.getMarkdown();
        document.getElementById('postForm').submit();
    });
}

import ClassicEditor from './ckeditor';

document.addEventListener('livewire:initialized', () => {
    ClassicEditor
        // Note that you do not have to specify the plugin and toolbar configuration — using defaults from the build.
        .create( document.querySelector( '#afterText' ), {
            language: 'ru',
            removePlugins: [
                'MediaEmbedToolbar',
                'Title'
            ],
            placeholder: '',
            ckfinder: {
                uploadUrl: 'https://example.com/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&responseType=json'
            }
        })
        .then(editor => {
            editor.model.document.on('change:data', () => {
            this.set('afterText', editor.getData());
            })
        })
        .catch( error => {
            console.error( error.stack );
        } );
});


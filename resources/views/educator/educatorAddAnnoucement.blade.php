@include('educator/educatorHeader')

<article id="mainArticle">Article</article>

<div class='fullContent'>
    <center>
        <h3>Make An Annoucement</h3>
        <br />

        <form action="{{route('addAnnoucement')}}" method="post" class="form-group">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> @csrf

            <input type="hidden" name="annouce_edu" value=" {{ Session::get('username') }}">
            <input type="text" name="annouce_title" class="annoucement_title" placeholder="Annoucement Title" autocomplete="off" align='left' size='40%' required>
            <label>Choose a Subject:</label>

            <select name='annouce_subject'>
                @foreach($subjects as $s)
                <option name="annouce_subject" value="{{ $s->subject_code }}">{{ $s->subject_code  }}</option>
                @endforeach
            </select>

            <label>Choose a Class:</label>

            <select name='annouce_class'>
                @foreach($classes as $s)
                <option name="annouce_class" value="{{ $s->class_name }}">{{ $s->class_name  }}</option>
                @endforeach
            </select>

            <div class='editor_container'>
                <textarea name="annouce_content" id="editor"></textarea>
            </div>

            @if (session('pass_status'))
            <p style="text-align:center; color:green;"><b>{{ session('pass_status') }}</b></p>
            @endif

            @if (session('error_status'))
            <p style="text-align:center; color:red;"><b>{{ session('error_status') }}</b></p>
            @endif

            <button class="button submit">
                <span class="button_text">Publish Now</span>
                <i class="button_icon fa fa-caret-right fa-2x" aria-hidden="true"></i>
            </button>
        </form>

</div>

<script src="https://cdn.ckbox.io/CKBox/1.1.0/ckbox.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/super-build/ckeditor.js"></script>

<script>
    CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {  
        toolbar: {
            items: [
                'exportPDF', 'exportWord', '|',
                'findAndReplace', 'selectAll', '|',
                'heading', '|',
                'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                'bulletedList', 'numberedList', 'todoList', '|',
                'outdent', 'indent', '|',
                'undo', 'redo',
                '-',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                'alignment', '|',
                'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                'specialCharacters', 'horizontalLine', 'pageBreak', '|', 'ckbox', 'sourceEditing'
            ],
            shouldNotGroupWhenFull: true
        },
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
        heading: {
            options: [{
                    model: 'paragraph',
                    title: 'Paragraph',
                    class: 'ck-heading_paragraph'
                },
                {
                    model: 'heading1',
                    view: 'h1',
                    title: 'Heading 1',
                    class: 'ck-heading_heading1'
                },
                {
                    model: 'heading2',
                    view: 'h2',
                    title: 'Heading 2',
                    class: 'ck-heading_heading2'
                },
                {
                    model: 'heading3',
                    view: 'h3',
                    title: 'Heading 3',
                    class: 'ck-heading_heading3'
                },
                {
                    model: 'heading4',
                    view: 'h4',
                    title: 'Heading 4',
                    class: 'ck-heading_heading4'
                },
                {
                    model: 'heading5',
                    view: 'h5',
                    title: 'Heading 5',
                    class: 'ck-heading_heading5'
                },
                {
                    model: 'heading6',
                    view: 'h6',
                    title: 'Heading 6',
                    class: 'ck-heading_heading6'
                }
            ]
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
        fontFamily: {
            options: [
                'default',
                'Arial, Helvetica, sans-serif',
                'Courier New, Courier, monospace',
                'Georgia, serif',
                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
        fontSize: {
            options: [10, 'default', 14, 16, 18, 20],
            supportAllValues: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
        htmlSupport: {
            allow: [{
                name: /.*/,
                attributes: true,
                classes: true,
                styles: true
            }]
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
        htmlEmbed: {
            showPreviews: true
        },
        ckbox: {
                // The development token endpoint is a special endpoint to help you in getting started with
                // CKEditor Cloud Services.
                // Please note the development token endpoint returns tokens with the CKBox administrator role.
                // It offers unrestricted, full access to the service and will expire 30 days after being used for the first time.
                // -------------------------------------------------------------
                // !!! You should not use it on production !!!
                // -------------------------------------------------------------
                // Read more: https://ckeditor.com/docs/ckbox/latest/guides/configuration/authentication.html#token-endpoint

                // You need to provide your own token endpoint here
                tokenUrl: 'https://91867.cke-cs.com/token/dev/pe52F6ffMvYnRKLmJmJGFnLP2jbbbGTc0Dhk?limit=10'
            },
        // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
        link: {
            decorators: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
                toggleDownloadable: {
                    mode: 'manual',
                    label: 'Downloadable',
                    attributes: {
                        download: 'file'
                    }
                }
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
        mention: {
            feeds: [{
                marker: '@',
                feed: [
                    '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                    '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                    '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                    '@sugar', '@sweet', '@topping', '@wafer'
                ],
                minimumCharacters: 1
            }]
        },
        removePlugins: [
            'EasyImage',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            'MathType'
        ]
    });
</script>
<link rel="stylesheet" href="<?= asset('vendor/tagify/tagify.css') ?>">

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Category Managements</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Category</h6>
        </div>
        <div class="card-body">
            <?php if(isset($_SESSION['error'])) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $_SESSION['error'] ?>
                </div>
            <?php endif; ?>
            <form action="<?= url('/dashboard/content') ?>" method="post" id="form">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtitle4">title</label>
                        <input type="title" class="form-control" id="inputtitle4" name="title" value="<?= $post->title ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputslug4">slug</label>
                        <input type="text" class="form-control" id="inputslug4" name="slug" value="<?= $post->slug ?>" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtag">Tag</label>
                        <input name="tags" id="inputtag" value="<?= implode(',', parseObject($tagToPost, 'title')) ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputcategory">Category</label>
                        <input name="categorys" id="inputcategory" value="<?= implode(',', parseObject($categoryToPost, 'title')) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputsummary">Summary</label>
                    <textarea class="form-control" name="summary" id="inputsummary" cols="5"><?= $post->summary ?></textarea>
                </div>
                <div class="form-group">
                    <input type="hidden" id="formContent" name="content">
                    <div id="editorjs" style="border: 1px solid #ddd; padding: 20px; border-radius: 5px;"></div>
                </div>
                <button type="submit" id="create" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/paragraph@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/image@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/quote@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/raw@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/table@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/delimiter@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/warning@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/checklist@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/marker@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/inline-code@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/link@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/embed@latest"></script>

<script src="<?= asset('vendor/tagify/tagify.js') ?>"></script>

<script>
    $(document).ready(function(){
        var inputtag = document.getElementById('inputtag');
        var inputcategory = document.getElementById('inputcategory');

        const slugify = text =>
            text
            .toString()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .toLowerCase()
            .trim()
            .replace(/\s+/g, '-')
            .replace(/[^\w-]+/g, '')
            .replace(/--+/g, '-');

    $('#inputtitle4').keyup(function() {
        $('#inputslug4').val(slugify($('#inputtitle4').val()));
    });

    const configTag = {
        tagTextProp: 'value',
        autoComplete: {
            enabled: true,
            rightKey: false, 
            tabKey: false,
        },
        userInput: false,
    }

    const tag = new Tagify(inputtag, {
        ...configTag,
        whitelist: <?= json_encode($tags) ?>,
        
    });

    const category = new Tagify(inputcategory, {
        ...configTag,
        whitelist: <?= json_encode($categorys) ?>,
    });

    const editor = new EditorJS({
        holder: 'editorjs',
        tools: {
            header: {
                class: Header,
                inlineToolbar: true,
                config: {
                    placeholder: 'Header'
                },
                shortcut: 'CMD+SHIFT+H'
            },
            paragraph: {
                class: Paragraph,
                inlineToolbar: true
            },
            list: {
                class: List,
                inlineToolbar: true,
                config: {
                    defaultStyle: 'unordered'
                },
                shortcut: 'CMD+SHIFT+L'
            },
            image: {
                class: ImageTool,
                inlineToolbar: true,
                config: {
                    endpoints: {
                        byFile: '<?= url('/v1/api/upload-file') ?>', // Your backend file uploader endpoint
                        byUrl: '<?= url('/v1/api/upload-file') ?>', // Your endpoint that provides uploading by Url
                    }
                }
            },
            quote: {
                class: Quote,
                inlineToolbar: true,
                config: {
                    quotePlaceholder: 'Enter a quote',
                    captionPlaceholder: 'Quote\'s author',
                },
                shortcut: 'CMD+SHIFT+O'
            },
            raw: RawTool,
            table: {
                class: Table,
                inlineToolbar: true,
                config: {
                    rows: 2,
                    cols: 3,
                }
            },
            delimiter: Delimiter,
            warning: {
                class: Warning,
                inlineToolbar: true,
                shortcut: 'CMD+SHIFT+W',
                config: {
                    titlePlaceholder: 'Title',
                    messagePlaceholder: 'Message',
                },
            },
            checklist: {
                class: Checklist,
                inlineToolbar: true,
            },
            marker: {
                class: Marker,
                shortcut: 'CMD+SHIFT+M',
            },
            inlineCode: {
                class: InlineCode,
                shortcut: 'CMD+SHIFT+C',
            },
            linkTool: {
                class: LinkTool,
                config: {
                    endpoint: 'your-link-fetch-endpoint' // Your backend endpoint for link data
                }
            },
            embed: Embed
        },
        data: <?= fully_decode_html_entities($post->content) ?>,
        onChange: (api, event) => {
            editor.save().then((outputData) => {
                $('#formContent').val(JSON.stringify(outputData))
            })
        }
    });

    })
</script>

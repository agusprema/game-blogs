<link rel="stylesheet" href="<?= asset('vendor/tagify/tagify.css') ?>">

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Category Managements</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create Category</h6>
        </div>
        <div class="card-body">
            <?php if(isset($_SESSION['error'])) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $_SESSION['error'] ?>
                </div>
            <?php endif; ?>
            <form action="<?= url('/dashboard/content') ?>" method="post" id="form" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtitle4">title</label>
                        <input type="title" class="form-control" id="inputtitle4" name="title">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputslug4">slug</label>
                        <input type="text" class="form-control" id="inputslug4" name="slug" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtag">Tag</label>
                        <input name="tags" id="inputtag">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputcategory">Category</label>
                        <input name="categorys" id="inputcategory">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputsummary">Summary</label>
                    <textarea class="form-control" name="summary" id="inputsummary" cols="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="formFile" class="form-label">Thumbnail</label>
                    <input class="form-control" type="file" id="formFile" name="thumbnail">
                </div>
                <div class="form-group">
                    <textarea type="hidden" class="d-none" id="formContent" name="content"></textarea>
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
        maxTags: 1,
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
         data: {
        blocks: [
          {
            id: "zcKCF1S7X8",
            type: "header",
            data: {
              text: "Editor.js",
              level: 1
            }
          },
          {
            "id": "b6ji-DvaKb",
            "type": "paragraph",
            "data": {
              "text": "Hey. Meet the new Editor. On this page you can see it in action — try to edit this text. Source code of the page contains the example of connection and configuration."
            }
          },
          {
            type: "header",
            id: "7ItVl5biRo",
            data: {
              text: "Key features",
              level: 2
            }
          },
          {
            type : 'list',
            id: "SSBSguGvP7",
            data : {
              items : [
                {
                  content: 'It is a block-styled editor',
                  items: []
                },
                {
                  content: 'It returns clean data output in JSON',
                  items: []
                },
                {
                  content: 'Designed to be extendable and pluggable with a simple API',
                  items: []
                }
              ],
              style: 'unordered'
            }
          },
          {
            type: "header",
            id: "QZFox1m_ul",
            data: {
              text: "What does it mean «block-styled editor»",
              level: 2
            }
          },
          {
            type : 'paragraph',
            id: "bwnFX5LoX7",
            data : {
              text : 'Workspace in classic editors is made of a single contenteditable element, used to create different HTML markups. Editor.js <mark class=\"cdx-marker\">workspace consists of separate Blocks: paragraphs, headings, images, lists, quotes, etc</mark>. Each of them is an independent contenteditable element (or more complex structure) provided by Plugin and united by Editor\'s Core.'
            }
          },
          {
            type : 'paragraph',
            id: "mTrPOHAQTe",
            data : {
              text : `There are dozens of <a href="https://github.com/editor-js">ready-to-use Blocks</a> and the <a href="https://editorjs.io/creating-a-block-tool">simple API</a> for creation any Block you need. For example, you can implement Blocks for Tweets, Instagram posts, surveys and polls, CTA-buttons and even games.`
            }
          },
          {
            type: "header",
            id: "1sYMhUrznu",
            data: {
              text: "What does it mean clean data output",
              level: 2
            }
          },
          {
            type : 'paragraph',
            id: "jpd7WEXrJG",
            data : {
              text : 'Classic WYSIWYG-editors produce raw HTML-markup with both content data and content appearance. On the contrary, Editor.js outputs JSON object with data of each Block. You can see an example below'
            }
          },
          {
            type : 'paragraph',
            id: "0lOGNUKxqt",
            data : {
              text : `Given data can be used as you want: render with HTML for <code class="inline-code">Web clients</code>, render natively for <code class="inline-code">mobile apps</code>, create markup for <code class="inline-code">Facebook Instant Articles</code> or <code class="inline-code">Google AMP</code>, generate an <code class="inline-code">audio version</code> and so on.`
            }
          },
          {
            type : 'paragraph',
            id: "WvX7kBjp0I",
            data : {
              text : 'Clean data is useful to sanitize, validate and process on the backend.'
            }
          },
          {
            type : 'delimiter',
            id: "H9LWKQ3NYd",
            data : {}
          },
          {
            type : 'paragraph',
            id: "h298akk2Ad",
            data : {
              text : 'We have been working on this project more than three years. Several large media projects help us to test and debug the Editor, to make its core more stable. At the same time we significantly improved the API. Now, it can be used to create any plugin for any task. Hope you enjoy. 😏'
            }
          },
          {
            type: 'image',
            id: "9802bjaAA2",
            data: {
              url: 'assets/codex2x.png',
              caption: '',
              stretched: false,
              withBorder: true,
              withBackground: false,
            }
          },
        ]
      },
        onChange: (api, event) => {

            editor.save().then((outputData) => {
                $('#formContent').val(btoa(unescape(encodeURIComponent(JSON.stringify(outputData)))))
            })
        }
    });

    })
</script>
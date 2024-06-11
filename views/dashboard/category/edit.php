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
            <form action="<?= url('/dashboard/category/'. $id .'/update') ?>" method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputtitle4">title</label>
                        <input type="title" class="form-control" id="inputtitle4" name="title" value="<?= $category->title ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputslug4">slug</label>
                        <input type="slug" class="form-control" id="inputslug4" name="slug" value="<?= $category->slug ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputcontent">Content</label>
                    <textarea class="form-control" name="content" id="inputcontent" cols="5"><?= $category->content ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

<script>
    $('#inputtitle4').keyup(function() {
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

        $('#inputslug4').val(slugify($('#inputtitle4').val()));
    });
</script>

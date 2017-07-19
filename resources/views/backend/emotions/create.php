<?php require_once(__DIR__. '/../layouts/header.php'); ?>

<header class="main-header">
    <a href="../home" class="logo">
        <span class="logo-mini"><b>A</b></span><span class="logo-lg"><b>Admin</b></span>    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <?php require_once(__DIR__. '/../layouts/menu.php'); ?>
    </nav>
</header>
<aside class="main-sidebar">
    <?php require_once(__DIR__. '/../layouts/leftbar.php'); ?>
</aside>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Emotions
        </h1>
    </section>

    <section class="content">
        <ul class="alert alert-danger" style="list-style-type: none">
            <li>The name field is required.</li>
        </ul>

        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <form method="POST" action="index.php" accept-charset="UTF-8" id="emotion">
                        <input name="_token" type="hidden" value="6Jr9gEdr5E9dT88yJPD9a1iWVfa12bUrzCWf0nxP">
                        <div class="form-group">
                            <!-- Name Field -->
                            <div class="col-sm-6">
                                <label for="name">Name:</label>
                                <input class="form-control" name="name" type="text" id="name">
                            </div>
                            <!-- Code Field -->
                            <div class="col-sm-6">
                                <label for="code">Code:</label>
                                <input class="form-control" name="code" type="text" id="code">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <!-- Name Field -->
                            <div class="col-sm-6">
                                <label for="image">Image:</label>
                                <input class="form-control" name="image" type="file" id="image" onchange="viewImg(this)">
                                <br>
                                <p><img id="avartar-img-show" src="../assets/images/avatar.png" alt="avatar" class="img-responsive" width="100%"></p>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="form-group">
                            <!-- Submit Field -->
                            <div class="col-sm-12">
                                <input class="btn btn-primary" type="submit" value="Save">
                                <a href="index.php" class="btn btn-default">Back</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
  function viewImg(img) {
    var fileReader = new FileReader;
    fileReader.onload = function(img) {
      var avartarShow = document.getElementById("avartar-img-show");

      avartarShow.src = img.target.result
    }, fileReader.readAsDataURL(img.files[0])
  }
</script>

<?php require_once(__DIR__. '/../layouts/footer.php'); ?>
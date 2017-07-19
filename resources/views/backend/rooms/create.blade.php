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
            Rooms
        </h1>
    </section>

    <section class="content">
        <ul class="alert alert-danger" style="list-style-type: none">
            <li>The name field is required.</li>
        </ul>

        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <form method="POST" action="index.php" accept-charset="UTF-8" id="room">
                        <input name="_token" type="hidden" value="6Jr9gEdr5E9dT88yJPD9a1iWVfa12bUrzCWf0nxP">
                        <div class="form-group">
                            <!-- Name Field -->
                            <div class="col-sm-12">
                                <label for="name">Name:</label>
                                <input class="form-control" name="name" type="text" id="name">
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

<?php require_once(__DIR__. '/../layouts/footer.php'); ?>
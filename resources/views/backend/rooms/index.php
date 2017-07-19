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
        <h1 class="pull-left">
            Rooms
        </h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="">Add New</a>
        </h1>
    </section>

    <section class="content">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success"><p><strong>Saved successfully.</strong></p></div>
                <div class="clearfix"></div>
                <div class="box box-primary">
                    <div class="box-body table-responsive">
                        <table class="table table-responsive table-bordered" id="tours-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th class="text-center" colspan="3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>bevypex</td>
                                    <td class="text-center">
                                        <form method="POST" action="" accept-charset="UTF-8">
                                            <input name="_method" type="hidden" value="DELETE">
                                            <input name="_token" type="hidden" value="6Jr9gEdr5E9dT88yJPD9a1iWVfa12bUrzCWf0nxP">
                                            <div class='btn-group'>
                                                <a href="show.php" class='btn btn-default btn-xs'>
                                                    <i class="glyphicon glyphicon-eye-open"></i>
                                                </a>
                                                <a href="create.php" class='btn btn-default btn-xs'>
                                                    <i class="glyphicon glyphicon-edit"></i>
                                                </a>
                                                <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm(&#039;Are you sure?&#039;)">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td>bevypex</td>
                                    <td class="text-center">
                                        <form method="POST" action="" accept-charset="UTF-8">
                                            <input name="_method" type="hidden" value="DELETE">
                                            <input name="_token" type="hidden" value="6Jr9gEdr5E9dT88yJPD9a1iWVfa12bUrzCWf0nxP">
                                            <div class='btn-group'>
                                                <a href="show.php" class='btn btn-default btn-xs'>
                                                    <i class="glyphicon glyphicon-eye-open"></i>
                                                </a>
                                                <a href="create.php" class='btn btn-default btn-xs'>
                                                    <i class="glyphicon glyphicon-edit"></i>
                                                </a>
                                                <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm(&#039;Are you sure?&#039;)">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td>bevypex</td>
                                    <td class="text-center">
                                        <form method="POST" action="" accept-charset="UTF-8">
                                            <input name="_method" type="hidden" value="DELETE">
                                            <input name="_token" type="hidden" value="6Jr9gEdr5E9dT88yJPD9a1iWVfa12bUrzCWf0nxP">
                                            <div class='btn-group'>
                                                <a href="show.php" class='btn btn-default btn-xs'>
                                                    <i class="glyphicon glyphicon-eye-open"></i>
                                                </a>
                                                <a href="create.php" class='btn btn-default btn-xs'>
                                                    <i class="glyphicon glyphicon-edit"></i>
                                                </a>
                                                <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm(&#039;Are you sure?&#039;)">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer clearfix">
                        <div class="pagination-sm no-margin pull-right">
                            <ul class="pagination">
                                <li class="disabled"><span>&laquo;</span></li>
                                <li class="active"><span>1</span></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#" rel="next">&raquo;</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require_once(__DIR__. '/../layouts/footer.php'); ?>
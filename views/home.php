<div class="row">
    <h1 class="text-center">TODO</h1>
    <div class="col-md-6 col-md-offset-3">
        <?php
        if(Session::get('error'))
        {
            echo '<div class="alert alert-error" role="alert">'. Session::get('error') .'</div>';
            Session::remove('error');
        }
        else if (Session::get('success'))
        {
            echo '<div class="alert alert-success" role="alert">'. Session::get('success') .'</div>';
            Session::remove('success');
        }
        ?>
        <div class="panel panel-info">
            <div class="panel-heading">
                <form action="<?= URL ?>home/save" method="post" id="todoForm">
                    <div class="form-group">
                        <div class="col-sm-8">
                            <input type="text" id="content" name="content" class="form-control" placeholder="Add new TODO">
                        </div>
                        <button type="submit" class="btn btn-info">Add</button>
                    </div>
                    <div class="form-group">
                        <span id="errorSpan" class="alert-danger"></span>
                    </div>
                </form>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <?php
                    if(isset($data['list']) && $data['list'])
                    {
                        foreach ($data['list'] as $key => $value)
                        {
                            $checked = $value['status'] == 'finished' ? 'checked' : '';
                            echo '<li class="list-group-item alert-success clearfix"><input type="checkbox" data-url="'. URL.'ajax/toggleStatus/'. $value['id'] .'"'. $checked .'> <span id="itemContent-'. $value['id'] .'">'. $value['content'] .'</span> <a href="'. URL. 'home/delete/'. $value['id'] .'" class="btn btn-danger pull-right" id="deleteItem-'. $value['id'] .'"> Delete </a><button type="button" id="editItem-'. $value['id'] .'" class="btn btn-info pull-right" data-toggle="modal" data-target="#myModal">Edit</button></li >';
                        }
                    }
                    else
                    {
                        echo 'No items to display';
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit</h4>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="post" id="updateForm">
                            <div class="form-group">
                                <label for="editItemInput" class="control-label">Content:</label>
                                <input type="text" class="form-control" value="" id="editItemInput" name="editItem">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
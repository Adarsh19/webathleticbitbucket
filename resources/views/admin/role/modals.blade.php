<div id="edit-modal-role" class="modal fade bs-example-modal-lg modal_with_tabs" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header hidden">
                <h4 class="modal-title">
                    <span class="fa-stack fa-sm">
                        <i class="fa fa-square-o fa-stack-2x"></i>
                        <i class="fa fa-plus fa-stack-1x"></i>
                    </span>
                    Functie toevoegen
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('common.close')">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="col">
                    <div class="tabs tabs-dark">
                        <ul class="nav nav-tabs">
                            <li class="nav-item tab-add">
                                <a class="nav-link" href="#add_tab_pane" data-toggle="tab">Toevoegen</a>
                            </li>
                            <li class="nav-item tab-edit active">
                                <a class="nav-link" href="#update_tab_pane" data-toggle="tab">Wijzigen</a>
                            </li>
                            <li class="nav-item tab-delete">
                                <a class="nav-link" id="delete-tab-button">@lang('common.delete') </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="add_tab_pane" class="tab-pane tab-add-pane">
                                <form role="form" id="role_add_form" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="">
                                        <div class="form-group">
                                            <label for="days">Functie</label>
                                            <input type="text" name="role" class="form-control" id="role" value="{{ old('role') }}" placeholder="ex: days">
                                            <span class="text-danger" id="role-error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="sell_category">Functie omschrijving</label>
                                            <textarea name="rdescription" class="form-control" id="rdescription" placeholder="ex: rdescription">{{ old('rdescription') }}</textarea>
                                            <span class="text-danger" id="rdescription-error"></span>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">@lang('common.close')</button>
                                        <button type="button" class="btn btn-info btn-flat" id="store-button">Save changes</button>
                                    </div>
                                </form>
                            </div>
                            <div id="update_tab_pane" class="tab-pane  tab-edit-pane active">
                                <form role="form" id="role_edit_form" method="post" enctype="multipart/form-data">
                                    {{method_field('PATCH')}}
                                    {{csrf_field()}}
                                    <input type="hidden" name="role_id" id="edit-role-id">
                                    <div class="">
                                        <div class="form-group">
                                            <label for="days">Functie</label>
                                            <input type="text" name="role" class="form-control" id="edit-role" value="" placeholder="ex: role">
                                            <span class="text-danger" id="role-error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="sell_category">Functie omschrijving</label>
                                            <textarea name="rdescription" class="form-control" id="edit-rdescription" placeholder="ex: rdescription"></textarea>
                                            <span class="text-danger" id="rdescription-error"></span>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">@lang('common.close')</button>
                                        <button type="button" class="btn btn-info btn-flat update-button">@lang('common.update')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="add-modal-role" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <span class="fa-stack fa-sm">
                        <i class="fa fa-square-o fa-stack-2x"></i>
                        <i class="fa fa-plus fa-stack-1x"></i>
                    </span>
                    Functie toevoegen
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('common.close')">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            

        </div>
    </div>
</div>
<!-- view page modal -->
<div id="view-modal-role" class="modal fade bs-example-modal-lg print-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-group pull-right no-print">
                    <div class="btn-group">
                        <button class="tip btn btn-default btn-flat btn-sm" id="print-button" data-toggle="tooltip" data-original-title="Print">
                            <i class="fa fa-print"></i>
                            <span class="hidden-sm hidden-xs"></span>
                        </button>
                    </div>
                    <div class="btn-group">
                        <button class="tip btn btn-default btn-flat btn-sm" data-toggle="tooltip" data-original-title="@lang('common.close')" data-dismiss="modal" aria-label="@lang('common.close')">
                            <i class="fa fa-remove"></i>
                            <span class="hidden-sm hidden-xs"></span>
                        </button>
                    </div>
                </div>
                <h4 class="modal-title" id="view-name"></h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td>Functie</td>
                            <td id="view-role"></td>
                        </tr>
                        <tr>
                            <td>Functie omschrijving</td>
                            <td id="view-rdescription"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer no-print">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal" aria-label="@lang('common.close')">@lang('common.close')</button>
            </div>
        </div>
    </div>
</div>
<!-- /.view page modal -->

<!-- delete page modal -->
<div id="delete-modal-role" class="modal modal-danger fade" id="modal-danger">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <span class="fa-stack fa-sm">
                        <i class="fa fa-square-o fa-stack-2x"></i>
                        <i class="fa fa-trash fa-stack-1x"></i>
                    </span>
                    @lang('common.delete_modal_text')
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('common.close')">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">@lang('common.close')</button>
                <form method="post" role="form" id="delete_form">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button type="submit" class="btn btn-outline">@lang('common.delete')</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.delete page modal -->


<!-- edit page modal -->
<div id="edit-modal-2" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <span class="fa-stack fa-sm">
                        <i class="fa fa-square-o fa-stack-2x"></i>
                        <i class="fa fa-edit fa-stack-1x"></i>
                    </span>
                    Edit Functie
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('common.close')">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            

        </div>
    </div>
</div>
<!-- /.edit page modal -->

<div id="edit-permission-modal" class="modal fade bs-example-modal-lg modal_with_tabs" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header hidden">
                <h4 class="modal-title">
                    <span class="fa-stack fa-sm">
                        <i class="fa fa-square-o fa-stack-2x"></i>
                        <i class="fa fa-plus fa-stack-1x"></i>
                    </span>
                    Toegang toevoegen
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('common.close')">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="col">
                    <div class="tabs tabs-dark">
                        <ul class="nav nav-tabs">
                            <li class="nav-item tab-add">
                                <a class="nav-link" href="#add_permission" data-toggle="tab">Toevoegen</a>
                            </li>
                            <li class="nav-item tab-edit active">
                                <a class="nav-link" href="#update_permission" data-toggle="tab">Wijzigen</a>
                            </li>
                            <li class="nav-item tab-delete">
                                <a class="nav-link" id="delete-permission-tab-button">@lang('common.delete') </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="add_permission" class="tab-pane tab-add-pane">
                                <form permission="form" id="permission_add_form" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="">
                                        <div class="form-group">
                                            <label for="days">Toestemming</label>
                                            <input type="text" name="permission" class="form-control" id="permission" value="{{ old('permission') }}" placeholder="ex: permission">
                                            <span class="text-danger" id="permission-error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="route_name">Route Name</label>
                                            <input type="text" name="route_name" class="form-control" id="route_name" value="{{ old('route_name') }}" placeholder="ex: Route Name">
                                            <span class="text-danger" id="route_name-error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="days">Block Name</label>
                                            <input type="text" name="block_name" class="form-control" id="block_name" value="{{ old('block_name') }}" placeholder="ex: block name">
                                            <span class="text-danger" id="block_name-error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="days">Dependent Route</label>
                                            <input type="text" name="dependent_routes" class="form-control" id="dependent_routes" value="{{ old('dependent_routes') }}" placeholder="ex: Dependent Route">
                                            <span class="text-danger" id="dependent_routes-error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="sell_category">Toestemming omschrijving</label>
                                            <textarea name="pdescription" class="form-control" id="pdescription" placeholder="ex: pdescription">{{ old('pdescription') }}</textarea>
                                            <span class="text-danger" id="pdescription-error"></span>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">@lang('common.close')</button>
                                        <button type="button" class="btn btn-info btn-flat" id="store-permission-button">Save changes</button>
                                    </div>
                                </form>
                            </div>
                            <div id="update_permission" class="tab-pane  tab-edit-pane active">
                                <form permission="form" id="permission_edit_form" method="post" enctype="multipart/form-data">
                                    {{method_field('PATCH')}}
                                    {{csrf_field()}}
                                    <input type="hidden" name="permission_id" id="edit-permission-id">
                                    <div class="">
                                        <div class="form-group">
                                            <label for="days">Toestemming</label>
                                            <input type="text" name="permission" class="form-control" id="edit-permission" value="" placeholder="ex: permission">
                                            <span class="text-danger" id="edit-permission-error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="edit-route_name">Route Name</label>
                                            <input type="text" name="route_name" class="form-control" id="edit-route_name" value="{{ old('route_name') }}" placeholder="ex: Route Name">
                                            <span class="text-danger" id="edit-route_name-error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="days">Block Name</label>
                                            <input type="text" name="block_name" class="form-control" id="edit-block_name" value="{{ old('block_name') }}" placeholder="ex: block name">
                                            <span class="text-danger" id="edit-block_name-error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="days">Dependent Route</label>
                                            <input type="text" name="dependent_routes" class="form-control" id="edit-dependent_routes" value="{{ old('dependent_routes') }}" placeholder="ex: Dependent Route">
                                            <span class="text-danger" id="edit-dependent_routes-error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="sell_category">Toestemming omschrijving</label>
                                            <textarea name="pdescription" class="form-control" id="edit-pdescription" placeholder="ex: pdescription"></textarea>
                                            <span class="text-danger" id="edit-pdescription-error"></span>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">@lang('common.close')</button>
                                        <button type="button" class="btn btn-info btn-flat update-permission-button">@lang('common.update')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="add-permission-modal" class="modal fade bs-example-modal-lg" tabindex="-1" permission="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" permission="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <span class="fa-stack fa-sm">
                        <i class="fa fa-square-o fa-stack-2x"></i>
                        <i class="fa fa-plus fa-stack-1x"></i>
                    </span>
                    Toegang toevoegen
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('common.close')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            

        </div>
    </div>
</div>
    <!-- /.add page modal -->

    <!-- view page modal -->
    <div id="view-permission-modal" class="modal fade bs-example-modal-lg print-modal" tabindex="-1" permission="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" permission="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="btn-group pull-right no-print">
                        <div class="btn-group">
                            <button class="tip btn btn-default btn-flat btn-sm" id="print-button" data-toggle="tooltip" data-original-title="Print">
                                <i class="fa fa-print"></i>
                                <span class="hidden-sm hidden-xs"></span>
                            </button>
                        </div>
                        <div class="btn-group">
                            <button class="tip btn btn-default btn-flat btn-sm" data-toggle="tooltip" data-original-title="@lang('common.close')" data-dismiss="modal" aria-label="@lang('common.close')">
                                <i class="fa fa-remove"></i>
                                <span class="hidden-sm hidden-xs"></span>
                            </button>
                        </div>
                    </div>
                    <h4 class="modal-title" id="view-name"></h4>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td>Toestemming</td>
                                <td id="view-permission-permission"></td>
                            </tr>
                            <tr>
                                <td>Toestemming omschrijving</td>
                                <td id="view-permission-pdescription"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer no-print">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal" aria-label="@lang('common.close')">@lang('common.close')</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.view page modal -->

    <!-- delete page modal -->
    <div id="delete-permission-modal" class="modal modal-danger fade" id="modal-danger">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <span class="fa-stack fa-sm">
                            <i class="fa fa-square-o fa-stack-2x"></i>
                            <i class="fa fa-trash fa-stack-1x"></i>
                        </span>
                        @lang('common.delete_modal_text')
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="@lang('common.close')">
                    <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">@lang('common.close')</button>
                    <form method="post" permission="form" id="delete_permission_form">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button type="submit" class="btn btn-outline">@lang('common.delete')</button>
                    </form>
                </div>
            </div>
                <!-- /.modal-content -->
        </div>
            <!-- /.modal-dialog -->
    </div>
    <div class="modal fade bulk-delete-modal" id="delete-role-modal-bulk" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
             <form method="GET" action="{{ url('admin/bulk-delete/roles')}}" id="delete-role-form-bulk">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="text-align: center;">
                <!-- <input type="hidden" name="_method" value="DELETE"> -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <textarea name="ids" class="checkboxes_field"></textarea>
                <p>Really want to delete these Roles?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">@lang('common.close')</button>
              <button type="submit" class="btn btn-danger" >@lang('common.delete')</button>
            </div>
            </form>
          </div>
        </div>
    </div>
    <div class="modal fade bulk-delete-modal" id="delete-permission-modal-bulk" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
             <form method="GET" action="{{ url('admin/bulk-delete/permissions')}}" id="delete-permission-form-bulk">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="text-align: center;">
                <!-- <input type="hidden" name="_method" value="DELETE"> -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <textarea name="ids" class="checkboxes_field"></textarea>
                <p>Really want to delete these Permissions?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">@lang('common.close')</button>
              <button type="submit" class="btn btn-danger" >@lang('common.delete')</button>
            </div>
            </form>
          </div>
        </div>
    </div>


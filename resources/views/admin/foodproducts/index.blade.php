@extends('layouts.admin_layout')
@section('title','Food-Products')
@section('style')
    <link rel="stylesheet" href="{{ asset('exercises/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_files/vendor/jquery-ui/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin_files/vendor/bootstrap-datepicker/css/bootstrap-datepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('/admin_files/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css') }}" />
    {{--<link rel="stylesheet" href="{{ asset('/admin_files/vendor/select2/css/select2.css') }}" />--}}


    <style>
        .cus-height{height: 250px;}
        .cus-height-textarea{
            height:115px;}
        .cus-wid-edi{    width: 96px;}
        .cus-wid-up{
            margin-left: 0px !important;
            width: 90%;
        }
        .img-cus{
            width: 60px;
            height: 60px;
            object-fit: cover;
            margin-right: 29px;
        }
        .cus-mar-right{margin-right:10px}
        .text-right{
            text-align:right;
        }

        .group-links{
            padding-right: 34px;
        }
        .editbuttons{
            margin-top: -30px;
            margin-right: 5px;
        }
        .pointer{cursor: pointer;color: #0088cc}
        .imagesize_logo {
            height: 40px;
            width: 40px;
        }

        .progress-bar-info{height:34px !important;}
        .cus-margin{margin-bottom: 5px !important;}

    </style>

@endsection
@section('content')



    <section service="main" class="content-body">

        <header class="page-header">
            <h2>Food Products</h2>
            @include('admin.includes.header')
        </header>




        @if(Request::segment(3)=="nutrition")
            <section class="content-header">
                <ol class="breadcrumb" style="padding: 40px 0 10px 0;font-size: 17px;">

                    <?php
                    $gr_id=\App\ProductGroups::select('id')
                        ->where('user_id',$user->id)
                        ->where('group_type','foodproducts')
                        ->first();
                    ?>

                    <li><a href="{{route('admin.showProductsViewRqst',[$user->id,$gr_id->id])}}" style="text-decoration: none;color: #5c5757;"><i
                                    class="fa fa-grav active"></i>&nbsp; Food Products</a></li>
                    <li><a href="" style="text-decoration: none;color: #5c5757;"><i
                                    class="fa fa-grav active"></i>&nbsp;<small>Nutrition</small> </a></li>
                </ol>
            </section>
            @else

            <section class="content-header">
                <ol class="breadcrumb" style="padding: 40px 0 10px 0;font-size: 17px;">
                    <li><a href="/admin/dashboard" style="text-decoration: none;color: #5c5757;"><i
                                    class="fa fa-grav active"></i>&nbsp; Food Products</a></li>
                </ol>
            </section>
            @endif


        {{--inside row tag content here--}}

        <div class="row">

            @if(Request::segment(3) !="nutrition")
            <div class="col-md-12 black-side-bg">

                <div style="" id="LoadingOverlayApi" data-loading-overlay>
                    <div class="dropcontent"></div>
                    @include('admin.foodproducts.droparea')
                </div>
           </div>
            @endif

            <div class="col-md-12">





                @if(Request::segment(3)=="nutrition")


                  @include('admin.foodproducts.nutrition_tracking')

                @else
                    <div class="exercises-grid1">


                        <div class="tabs  foodtabs">
                            <ul class="nav nav-tabs tabs-primary justify-content-end">

                                @foreach($groups as $key=>$group)
                                    <li class="nav-item">



                                        <a href="{{route('admin.showProductsViewRqst',[$user->id,$group->gid])}}" class="group-links nav-link @if($group->gid==Request::segment(4))active @endif " >{{$group->gname}}


                                        </a>
                                        <div class="tools pull-right editbuttons" >
                                            <i class="fa fa-trash-o pointer" data-toggle="modal" data-target="#delete-products-group-modal{{$group->gid }}"></i>
                                            <i class="fa fa-edit pointer" data-toggle="modal" data-target="#edit-products-group-modal{{$group->gid }}"></i>
                                        </div>


                                    </li>

                                    <div class="modal fade" id="edit-products-group-modal{{$group->gid }}" tabindex="-2" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form method="POST" action="{{ route('admin.editGroupRqst',$group->gid)}}">
                                                    {{ csrf_field() }}
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Groep toevoegen</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="groupname">Group name</label>
                                                            <input type="text" name="groupname" class="form-control" id="groupname"
                                                                   aria-describedby="grpnameHelp" value="{{$group->gname}}"
                                                                   placeholder="Enter group name" required>
                                                            <small id="grpnameHelp" class="form-text text-muted"></small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-info">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="delete-products-group-modal{{$group->gid }}" class="modal modal-danger fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <h4 class="modal-title">
							<span class="fa-stack fa-sm">
								<i class="fa fa-square-o fa-stack-2x"></i>
								<i class="fa fa-trash fa-stack-1x"></i>
							</span>
                                                        Are you sure want to delete this ?
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                                    <form method="post" role="form" id="delete_form" action=" {{ route('admin.deleteGroupRqst',$group->gid ) }}">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}
                                                        <button type="submit" class="btn btn-outline">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>

                                @endforeach
                                <li class="nav-item ">
                                    {{--<a  onclick="showpredefinedview('{{$user->id}}')" class="nav-link" href="#popular7" data-toggle="tab"> Opgeslagen schema’s </a>--}}

                                    <a href="{{route('admin.nutritiontrackingRqst',[$user->id,\Carbon\Carbon::now()->format("Y-m-d")])}}"
                                       class="nav-link"> Meals </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="modal" data-target="#groupModal" href="#groupModal"
                                       data-toggle="tab">Groep toevoegen </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" data-toggle="modal" data-target="#productModaladd"
                                       href="#productModaladd" data-toggle="tab">Oefening toevoegen
                                    </a>
                                </li>
                                @if(\Illuminate\Support\Facades\Auth::user()->role=="admin")
                                    <li class="dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"><i
                                                    class="fa fa-search"></i> Seach By Company <span
                                                    class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            @foreach($companies as $company)
                                                <li>
                                                    <a class="dropdown-item"
                                                       href="{{route('admin.showProductsViewRqst',[$company->user_id,Request::segment(4)])}}">{{$company->company_name}}


                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            </ul>
                            <div class="tab-content">
                                <div id="ftab19" class="tab-pane active">

                                    <table class="table table-responsive-md table-striped mb-0">
                                        <tbody>
                                            @include('admin.foodproducts.products_grid')




                                        </tbody>
                                    </table>

                                    @if(!empty($products))
                                    <div class="pagination mt-5">
                                        {!! $products->links('vendor.pagination.bootstrap-4')  !!}`
                                    </div>
                                        @endif




                                 </div>
                             </div>



                    </div>
                @endif


            </div>



        </div>
                @if(Request::segment(3) !="nutrition")
        <div class="modal fade" id="groupModal" tabindex="-2" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('admin.addFoodProductGroupRqst',Request::segment(3))}}">
                        {{ csrf_field() }}
                        <div class="modal-header">
                            <h5 class="modal-title">Groep toevoegen</h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="groupname">Group name</label>
                                <input type="text" name="groupname" class="form-control" id="groupname"
                                       aria-describedby="grpnameHelp"
                                       placeholder="Enter group name" required>
                                <small id="grpnameHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
         <div class="modal fade" id="dropgroupModal" tabindex="-2" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('admin.addDropGroupRqst',Request::segment(3))}}">
                            {{ csrf_field() }}
                            <div class="modal-header">
                                <h5 class="modal-title">Groep toevoegen</h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="groupname">Group name</label>
                                    <input type="text" name="groupname" class="form-control" id="groupname"
                                           aria-describedby="grpnameHelp"
                                           placeholder="Enter group name" required>
                                    <small id="grpnameHelp" class="form-text text-muted"></small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <div class="modal fade " id="productModaladd" tabindex="-2" role="dialog" aria-hidden="true" >
            <div class="modal-dialog modal-block modal-block-lg " role="document">
                <div class="modal-content">

                    <section class="card">
                        <header class="card-header">
                            <h2 class="card-title">Add Food Product</h2>
                        </header>


                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data" action="{{route('admin.addFoodProductRqst',$user->id)}}" id="product-form">
                               {{csrf_field()}}
                                <div class="col-lg-12">
                                <div class="col-lg-4">

                                    <section class="card">
                                        <div class="card-body">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div>
                                                <div>
                                                    <span class="btn btn-default btn-file cus-wid-up">
                                                    <span class="btn btn-file">
                                                        <span class="fileupload-new">Select image</span>
                                                        <span class="fileupload-exists">Change</span>
                                                        <input type="file" name="path" />
                                                    </span>
                                                    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                    </span>
                                                </div>
                                            </div>


                                        </div>
                                    </section>




                                </div>


                                <div class="col-lg-8">



                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label class="col-form-label" for="formGroupExampleInput">Name</label>
                                                <input type="text" class="form-control" id="formGroupExampleInput" name="name" placeholder="Name">
                                            </div>


                                            <div class="form-group">
                                                <label class="col-form-label" for="formGroupExampleInput">Merk</label>
                                                <input type="text" class="form-control" id="merk" name="merk" placeholder="Merk">
                                            </div>
                                                <label class="col-form-label">Category</label>
                                                <div class="form-group">
                                                    <select data-plugin-selectTwo class="form-control category" name="category">
                                                        <option value="">Kies...</option>
                                                        <option value="14">Diversen, overige</option>
                                                        <option value="11">Dranken</option>
                                                        <option value="3">Groente, fruit en vegetarisch</option>
                                                        <option value="2">Kaas, melk- en ei-producten</option>
                                                        <option value="10">Kruiden en specerijen</option>
                                                        <option value="6">Noten, zaden en snacks</option>
                                                        <option value="1">Pasta en (ontbijt)graanproducten</option>
                                                        <option value="13">Restaurant-gerechten</option>
                                                        <option value="7">Soepen, sauzen, vetten en oliën</option>
                                                        <option value="9">Taart, Gebak en koek</option>
                                                        <option value="5">Visproducten</option>
                                                        <option value="4">Vleesproducten</option>
                                                        <option value="12">Warme maaltijden</option>
                                                        <option value="8">Zoetwaren en snoep</option>
                                                    </select>
                                                </div>

                                    </div>
                                        <div class="col-lg-6">

                                                <div class="form-group">
                                                <label class="col-form-label" for="formGroupExampleInput">Beshchrijving</label>
                                                <textarea name="beshchrijving" class="form-control cus-height-textarea" rows="5" placeholder="Beshchrijving"></textarea>
                                            </div>





                                                    <div class="form-group">
                                                        <label class="col-form-label">Select Group</label>
                                                    <select multiple="" data-plugin-selecttwo="" class="form-control groups" name="groups[]">
                                                        <optgroup label="Groups">
                                                            @foreach($groups as $gp)
                                                            <option value="{{$gp->gid}}">{{$gp->gname}}</option>
                                                                @endforeach
                                                        </optgroup>

                                                    </select>
                                                </div>



                                        </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="formGroupExampleInput">Synoniemen</label>
                                            <input type="text" class="form-control" id="formGroupExampleInput" name="synoniemen" placeholder="Synoniemen">
                                        </div>
                                    </div>
                                </div>

                                    <div class="col-lg-12">
                                        <div class="row">   <h2>Voedingswaarden</h2></div>
                                    <div class="page_content no_top_radius no_bottom_radius page_content_grey">
                                        <div class="clear">


                                            <table class="table table_transparent clear" style="margin-top: 10px;">
                                                <tbody><tr>
                                                    <th style="width: 18%;" class="nowrap">Voedingswaarden per</th>
                                                    <td style="width: 12%;"><input name="nutrition_grams" class="form-control" style="  text-align:right;" type="text" value="100">&nbsp;g</td>
                                                    <th style="width: 18%;">&nbsp;</th>
                                                    <td style="width: 12%;">&nbsp;</td>
                                                    <th style="width: 18%;">&nbsp;</th>
                                                    <td style="width: 12%;">&nbsp;</td>
                                                </tr>
                                                </tbody></table>

                                            <table class="table table_transparent">
                                                <tbody>
                                                <tr>
                                                    <th style="width: 18%;" class="nowrap" title="Kcal">Kcal</th>
                                                    <td style="width: 12%;">

                                                        <input name="kal" class="form-control" style=" text-align:right;" type="text" value="0"></td>


                                                    <th style="width: 18%;" class="nowrap" title="Eiwit">Eiwit</th>
                                                    <td style="width: 12%;"><input name="eiwit" class="form-control" type="text" value="0">&nbsp;g</td>


                                                    <th style="width: 18%;" class="nowrap" title="Vet (totaal)">Vet (totaal)</th>
                                                    <td style="width: 12%;"><input name="totaal" class="form-control" style=" text-align:right;" type="text" value="0">&nbsp;g</td>


                                                </tr>									<tr>					<th style="width: 18%;" class="nowrap" title="Koolhydraten">Koolhydraten</th>
                                                    <td style="width: 12%;"><input name="koolhydraten" class="form-control"  type="text" value="0">&nbsp;g</td>


                                                    <th style="width: 18%;" class="nowrap" title="Waarvan suikers">Waarvan suikers</th>
                                                    <td style="width: 12%;"><input name="suikers" class="form-control" style=" text-align:right;" type="text" value="0">&nbsp;g</td>


                                                    <th style="width: 18%;" class="nowrap" title="Waarvan verzadigd vet">Waarvan verzadigd vet</th>
                                                    <td style="width: 12%;"><input name="verzadigd" class="form-control" style=" text-align:right;" type="text" value="0">&nbsp;g</td>


                                                </tr>							</tbody></table>

                                            <table  style="display: none;" class="table table_transparent morenutrition">
                                                <tbody><tr>					<th style="width: 18%;" class="nowrap" title="Kilojoule">Kilojoule</th>
                                                    <td style="width: 12%;">
                                                        <input style=" text-align:right;" class="form-control" name="kilojoule" type="text" value="0">&nbsp;kJ
                                                    </td>
                                                    <th style="width: 18%;" class="nowrap" title="Voedingsvezels">Voedingsvezels</th>
                                                    <td style="width: 12%;">
                                                        <input style=" text-align:right;" class="form-control" name="voedingsvezels" type="text" value="0">&nbsp;g
                                                    </td>
                                                    <th style="width: 18%;" class="nowrap" title="Calcium">Calcium</th>
                                                    <td style="width: 12%;">
                                                        <input style=" text-align:right;" class="form-control" name="calcium" type="text" value="0">&nbsp;mg
                                                    </td>
                                                </tr>									<tr>					<th style="width: 18%;" class="nowrap" title="IJzer">IJzer</th>
                                                    <td style="width: 12%;">
                                                        <input style=" text-align:right;" class="form-control" name="ijzer" type="text" value="0">&nbsp;mg
                                                    </td>
                                                    <th style="width: 18%;" class="nowrap" title="Magnesium">Magnesium</th>
                                                    <td style="width: 12%;">
                                                        <input style=" text-align:right;" class="form-control" name="magnesium" type="text" value="0">&nbsp;mg
                                                    </td>
                                                    <th style="width: 18%;" class="nowrap" title="Fosfor">Fosfor</th>
                                                    <td style="width: 12%;">
                                                        <input style=" text-align:right;" class="form-control" name="fosfor" type="text" value="0">&nbsp;mg
                                                    </td>
                                                </tr>									<tr>					<th style="width: 18%;" class="nowrap" title="Kalium">Kalium</th>
                                                    <td style="width: 12%;">
                                                        <input style=" text-align:right;" class="form-control" name="kalium" type="text" value="0">&nbsp;mg
                                                    </td>
                                                    <th style="width: 18%;" class="nowrap" title="Natrium">Natrium</th>
                                                    <td style="width: 12%;">
                                                        <input style=" text-align:right;" class="form-control" name="natrium" type="text" value="0">&nbsp;mg
                                                    </td>
                                                    <th style="width: 18%;" class="nowrap" title="Zink">Zink</th>
                                                    <td style="width: 12%;">
                                                        <input style=" text-align:right;" class="form-control" name="zink" type="text" value="0">&nbsp;mg
                                                    </td>
                                                </tr>									<tr>					<th style="width: 18%;" class="nowrap" title="Koper">Koper</th>
                                                    <td style="width: 12%;">
                                                        <input style=" text-align:right;" class="form-control" name="koper" type="text" value="0">&nbsp;mg
                                                    </td>
                                                    <th style="width: 18%;" class="nowrap" title="Selenium">Selenium</th>
                                                    <td style="width: 12%;">
                                                        <input style=" text-align:right;" class="form-control" name="selenium" type="text" value="0">&nbsp;mg
                                                    </td>
                                                    <th style="width: 18%;" class="nowrap" title="Vitamine C">Vitamine C</th>
                                                    <td style="width: 12%;">
                                                        <input style=" text-align:right;" class="form-control" name="vitc" type="text" value="0">&nbsp;mg
                                                    </td>
                                                </tr>									<tr>					<th style="width: 18%;" class="nowrap" title="Vitamine B1">Vitamine B1</th>
                                                    <td style="width: 12%;">
                                                        <input style=" text-align:right;" class="form-control" name="vitb1" type="text" value="0">&nbsp;mg
                                                    </td>
                                                    <th style="width: 18%;" class="nowrap" title="Vitamine B2">Vitamine B2</th>
                                                    <td style="width: 12%;">
                                                        <input style=" text-align:right;" class="form-control" name="vitb2" type="text" value="0">&nbsp;mg
                                                    </td>
                                                    <th style="width: 18%;" class="nowrap" title="Vitamine B6">Vitamine B6</th>
                                                    <td style="width: 12%;">
                                                        <input style=" text-align:right;" class="form-control" name="vitb6" type="text" value="0">&nbsp;mg
                                                    </td>
                                                </tr>									<tr>					<th style="width: 18%;" class="nowrap" title="Foliumzuur">Foliumzuur</th>
                                                    <td style="width: 12%;">
                                                        <input style=" text-align:right;" class="form-control" name="foliumzuur" type="text" value="0">&nbsp;mcg
                                                    </td>
                                                    <th style="width: 18%;" class="nowrap" title="Vitamine B12">Vitamine B12</th>
                                                    <td style="width: 12%;">
                                                        <input style=" text-align:right;" class="form-control" name="vitb12" type="text" value="0">&nbsp;mcg
                                                    </td>
                                                    <th style="width: 18%;" class="nowrap" title="Vitamine A">Vitamine A</th>
                                                    <td style="width: 12%;">
                                                        <input style=" text-align:right;" class="form-control" name="vita" type="text" value="0">&nbsp;mcg
                                                    </td>
                                                </tr>									<tr>					<th style="width: 18%;" class="nowrap" title="Vitamine E">Vitamine E</th>
                                                    <td style="width: 12%;">
                                                        <input style=" text-align:right;" class="form-control" name="vite" type="text" value="0">&nbsp;mg
                                                    </td>
                                                    <th style="width: 18%;" class="nowrap" title="Vitamine D">Vitamine D</th>
                                                    <td style="width: 12%;">
                                                        <input style=" text-align:right;" class="form-control" name="vitd" type="text" value="0">&nbsp;mcg
                                                    </td>
                                                    <th style="width: 18%;" class="nowrap" title="Onverzadigde vetzuren">Onverzadigde vetzuren</th>
                                                    <td style="width: 12%;">
                                                        <input style=" text-align:right;" class="form-control" name="onverzadigdevetzuren" type="text" value="0">&nbsp;g
                                                    </td>
                                                </tr>									<tr>					<th style="width: 18%;" class="nowrap" title="Cholesterol">Cholesterol</th>
                                                    <td style="width: 12%;">
                                                        <input style=" text-align:right;" class="form-control" name="cholesterol" type="text" value="0">&nbsp;mg
                                                    </td>
                                                    <th style="width: 18%;" class="nowrap" title="Alcohol">Alcohol</th>
                                                    <td style="width: 12%;">
                                                        <input style=" text-align:right;" class="form-control" name="alcohol" type="text" value="0">&nbsp;g
                                                    </td>
                                                    <th style="width: 18%;" class="nowrap" title="Enkelv. onverz. vet">Enkelv. onverz. vet</th>
                                                    <td style="width: 12%;">
                                                        <input style=" text-align:right;" class="form-control" name="onverzvet" type="text" value="0">&nbsp;g
                                                    </td>
                                                </tr>									<tr>					<th style="width: 18%;" class="nowrap" title="Meerv. onverz. vet">Meerv. onverz. vet</th>
                                                    <td style="width: 12%;">
                                                        <input style=" text-align:right;" class="form-control" name="meervonverzvet" type="text" value="0">&nbsp;g
                                                    </td>
                                                    <th style="width: 18%;" class="nowrap" title="Transvet">Transvet</th>
                                                    <td style="width: 12%;">
                                                        <input style=" text-align:right;" class="form-control" name="transvet" type="text" value="0">&nbsp;g
                                                    </td>
                                                </tr></tbody></table>

                                            <div id="foodline" style="width:100%; margin-top:10px; margin-bottom: 20px; border-top:2px solid #dcdcdc;">
                                                <div id="morenutr" style="cursor:pointer; width:100%; line-height:30px;">
                                                    <div class="nutrtoggleinfo"> Toon micro nutriënten</div>
                                                    <input type="hidden" name="nutrtoggle" id="nutrtoggle" value="true">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>



                                    <div class="col-lg-12">

                                        <div class="row"><h2>Units</h2></div>
                                        <table id="foodunits" class="table table_transparent clear">
                                            <thead>
                                            <tr>
                                                <th style="width: 200px;">Name
                                                    <div class="tooltip_icon" tooltip="(Bijvoorbeeld: stuk)"></div>
                                                </th>
                                                <th style="width: 300px;">Weight</th>
                                                <th>Standard unit</th>
                                            </tr>
                                            </thead>
                                            <tbody class="unitstbody">

                                            </tbody>
                                        </table>
                                        <button type="button" onclick="addUnitRow()" class="btn btn-info"> Add Units</button>

                                    </div>


                                </div>



                            </form>
                        </div>
                        <footer class="card-footer">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-info" onclick="$('#product-form').submit()">Save</button>
                                    <button class="btn btn-default modal-dismiss" onclick="$('#productModaladd').modal('hide')">Cancel</button>
                                </div>
                            </div>
                        </footer>
                    </section>

                </div>
            </div>
        </div>
            <div class="modal fade " id="productModaledit" tabindex="-2" role="dialog" aria-hidden="true" >
                <div class="modal-dialog modal-block modal-block-lg " role="document">
                    <div class="modal-content">



                    </div>
                </div>
            </div>
                    @endif


</div>
    </section>



@endsection
@section('site_scripts')

    <script type="text/javascript" src="{{asset('foodproducts/foodproducts.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin_files/vendor/jquery-ui/jquery-ui.min.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('/admin_files/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

    <script src="{{asset('/admin_files/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js')}}"></script>
{{--    <script src="{{asset('/admin_files/vendor/select2/js/select2.js')}}"></script>--}}


    <script>
        $(function () {
//            $( ".category" ).select2()
//            $( ".groups" ).select2()

            var user_id = '{{$user->id}}';
//            loaduserbar(user_id);


//            loadDropable(user_id,null);

            searchbarKeyup(user_id);



            var user_id='{{Request::segment(3)}}';
            var group_id='{{Request::segment(4)}}';
//           $('.foodtabs').on('shown.bs.tab', function (e) {
////                var scheduleid=$(this).attr('caltabid')
//                var url= BASE_URL+"/admin/food-products/"+user_id+"/"+group_id;
//                alert(url)
//                window.location.href = url;
//
//
//
//            });


//            $('.nav-tabs a').on('shown.bs.tab', function (e) {
//                var url= BASE_URL+"/admin/food-products/"+user_id+"/"+group_id;
//console.log(url);
//                window.location.href = url;
//            })

//           console.log('#ftab'+group_id);
//            $('#ftab'+group_id).trigger('click');


//            if(window.location.hash != "") {
//                $('#ftab'+group_id).tab('show');
//            }




            $('.nutrtoggleinfo').click(function(){

                $('.morenutrition').toggle();
            });





        });

        function showeditModal(uid,pid){


            $("#productModaledit .modal-content").load(BASE_URL+"/admin/food-products/get-food-product/"+uid+"/"+pid);
            $('#productModaledit').modal('show');
            $('#nutrtoggleinfo').click(function(){

                $('#morenutrition').toggle();
            });

        }

        function loadmore() {
            $('.morenutrition').toggle();
        }













    </script>



@endsection
@section('scripts')
@endsection
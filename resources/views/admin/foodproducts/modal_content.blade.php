<section class="card">
    <header class="card-header">
        <h2 class="card-title">Edit Food Product {{$products->name}}</h2>
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
        <form method="post" enctype="multipart/form-data"
              action="{{route('admin.editFoodProductRqst',[$products->id,Request::segment(4)])}}"
              id="product-form-edit">
            {{csrf_field()}}
            <div class="col-lg-12">
                <div class="col-lg-4">


                    <section class="card">
                        <div class="card-body">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;">

                                    <img src="{{ asset('admin/images/groups/foodproducts/'.$products->path)}}">
                                </div>
                                <div>
                                                    <span class="btn btn-default btn-file cus-wid-up">
                                                    <span class="btn btn-file">
                                                        <span class="fileupload-new">Select image</span>
                                                        <span class="fileupload-exists">Change</span>
                                                        <input type="file" name="path"/>
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
                            <input type="text" class="form-control" id="formGroupExampleInput" name="name"
                                   placeholder="Name" value="{{$products->name}}">
                        </div>


                        <div class="form-group">
                            <label class="col-form-label" for="formGroupExampleInput">Merk</label>
                            <input type="text" class="form-control" id="merk" name="merk" placeholder="Merk"
                                   value="{{$products->merk}}">
                        </div>
                        <label class="col-form-label">Category</label>
                        <div class="form-group">
                            <select data-plugin-selectTwo class="form-control category" name="category">
                                <option value="">Kies...</option>
                                <option @if($products->category==14) selected @endif value="14">Diversen, overige
                                </option>
                                <option @if($products->category==11) selected @endif value="11">Dranken</option>
                                <option @if($products->category==3) selected @endif value="3">Groente, fruit en
                                    vegetarisch
                                </option>
                                <option @if($products->category==2) selected @endif value="2">Kaas, melk- en
                                    ei-producten
                                </option>
                                <option @if($products->category==10) selected @endif value="10">Kruiden en specerijen
                                </option>
                                <option @if($products->category==6) selected @endif value="6">Noten, zaden en snacks
                                </option>
                                <option @if($products->category==1) selected @endif value="1">Pasta en
                                    (ontbijt)graanproducten
                                </option>
                                <option @if($products->category==13) selected @endif value="13">Restaurant-gerechten
                                </option>
                                <option @if($products->category==7) selected @endif value="7">Soepen, sauzen, vetten en
                                    oliën
                                </option>
                                <option @if($products->category==9) selected @endif value="9">Taart, Gebak en koek
                                </option>
                                <option @if($products->category==5) selected @endif value="5">Visproducten</option>
                                <option @if($products->category==4) selected @endif value="4">Vleesproducten</option>
                                <option @if($products->category==12) selected @endif value="12">Warme maaltijden
                                </option>
                                <option @if($products->category==8) selected @endif value="8">Zoetwaren en snoep
                                </option>
                            </select>
                        </div>

                    </div>
                    <div class="col-lg-6">

                        <div class="form-group">
                            <label class="col-form-label" for="formGroupExampleInput">Beshchrijving</label>
                            <textarea name="beshchrijving" class="form-control cus-height-textarea" rows="5"
                                      placeholder="Beshchrijving">{{ $products->beshchrijving }}</textarea>
                        </div>


                        <div class="form-group">
                            <label class="col-form-label">Select Group</label>
                            <select multiple="" data-plugin-selecttwo="" class="form-control groups" name="groups[]">
                                <optgroup label="Groups">
                                    @foreach($groups as $gp)
                                        <option @if($products->group_id == $gp->gid) selected
                                                @endif value="{{$gp->gid}}">{{$gp->gname}}</option>
                                    @endforeach
                                </optgroup>

                            </select>
                        </div>


                    </div>


                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="col-form-label" for="formGroupExampleInput">Synoniemen</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" name="synoniemen"
                                   placeholder="Synoniemen" value="{{$products->synoniemen}}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row"><h2>Voedingswaarden</h2></div>
                    <div class="page_content no_top_radius no_bottom_radius page_content_grey">
                        <div class="clear">


                            <table class="table table_transparent clear" style="margin-top: 10px;">
                                <tbody>
                                <tr>
                                    <th style="width: 18%;" class="nowrap">Voedingswaarden per</th>
                                    <td style="width: 12%;"><input name="nutrition_grams" class="form-control"
                                                                   style="  text-align:right;" type="text"
                                                                   value="{{$products->nutrition_grams}}">&nbsp;g
                                    </td>
                                    <th style="width: 18%;">&nbsp;</th>
                                    <td style="width: 12%;">&nbsp;</td>
                                    <th style="width: 18%;">&nbsp;</th>
                                    <td style="width: 12%;">&nbsp;</td>
                                </tr>
                                </tbody>
                            </table>

                            <table class="table table_transparent">
                                <tbody>
                                <tr>
                                    <th style="width: 18%;" class="nowrap" title="Kcal">Kcal</th>
                                    <td style="width: 12%;">

                                        <input name="kal" class="form-control  text-right" type="text"
                                               value="{{$products->kal}}"></td>


                                    <th style="width: 18%;" class="nowrap" title="Eiwit">Eiwit</th>
                                    <td style="width: 12%;"><input name="eiwit" class="form-control  text-right"
                                                                   type="text" value="{{$products->eiwit}}">&nbsp;g
                                    </td>


                                    <th style="width: 18%;" class="nowrap" title="Vet (totaal)">Vet (totaal)</th>
                                    <td style="width: 12%;"><input name="totaal" class="form-control  text-right"
                                                                   type="text" value="{{$products->totaal}}">&nbsp;g
                                    </td>


                                </tr>
                                <tr>
                                    <th style="width: 18%;" class="nowrap" title="Koolhydraten">Koolhydraten</th>
                                    <td style="width: 12%;"><input name="koolhydraten" class="form-control  text-right"
                                                                   type="text" value="{{$products->koolhydraten}}">&nbsp;g
                                    </td>


                                    <th style="width: 18%;" class="nowrap" title="Waarvan suikers">Waarvan suikers</th>
                                    <td style="width: 12%;"><input name="suikers" class="form-control  text-right"
                                                                   type="text" value="{{$products->suikers}}">&nbsp;g
                                    </td>


                                    <th style="width: 18%;" class="nowrap" title="Waarvan verzadigd vet">Waarvan
                                        verzadigd vet
                                    </th>
                                    <td style="width: 12%;"><input name="verzadigd" class="form-control  text-right"
                                                                   type="text" value="{{$products->verzadigd}}">&nbsp;g
                                    </td>


                                </tr>
                                </tbody>
                            </table>

                            <table style="display: none;" class="table table_transparent morenutrition">
                                <tbody>
                                <tr>
                                    <th style="width: 18%;" class="nowrap" title="Kilojoule">Kilojoule</th>
                                    <td style="width: 12%;">
                                        <input class="form-control  text-right" name="kilojoule" type="text"
                                               value="{{$products->kilojoule}}">&nbsp;kJ
                                    </td>
                                    <th style="width: 18%;" class="nowrap" title="Voedingsvezels">Voedingsvezels</th>
                                    <td style="width: 12%;">
                                        <input class="form-control  text-right" name="voedingsvezels" type="text"
                                               value="{{$products->voedingsvezels}}">&nbsp;g
                                    </td>
                                    <th style="width: 18%;" class="nowrap" title="Calcium">Calcium</th>
                                    <td style="width: 12%;">
                                        <input class="form-control  text-right" name="calcium" type="text"
                                               value="{{$products->calcium}}">&nbsp;mg
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 18%;" class="nowrap" title="IJzer">IJzer</th>
                                    <td style="width: 12%;">
                                        <input class="form-control  text-right" name="ijzer" type="text"
                                               value="{{$products->ijzer}}">&nbsp;mg
                                    </td>
                                    <th style="width: 18%;" class="nowrap" title="Magnesium">Magnesium</th>
                                    <td style="width: 12%;">
                                        <input class="form-control  text-right" name="magnesium" type="text"
                                               value="{{$products->magnesium}}">&nbsp;mg
                                    </td>
                                    <th style="width: 18%;" class="nowrap" title="Fosfor">Fosfor</th>
                                    <td style="width: 12%;">
                                        <input class="form-control  text-right" name="fosfor" type="text"
                                               value="{{$products->fosfor}}">&nbsp;mg
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 18%;" class="nowrap" title="Kalium">Kalium</th>
                                    <td style="width: 12%;">
                                        <input class="form-control  text-right" name="kalium" type="text"
                                               value="{{$products->kalium}}">&nbsp;mg
                                    </td>
                                    <th style="width: 18%;" class="nowrap" title="Natrium">Natrium</th>
                                    <td style="width: 12%;">
                                        <input class="form-control  text-right" name="natrium" type="text"
                                               value="{{$products->natrium}}">&nbsp;mg
                                    </td>
                                    <th style="width: 18%;" class="nowrap" title="Zink">Zink</th>
                                    <td style="width: 12%;">
                                        <input class="form-control  text-right" name="zink" type="text"
                                               value="{{$products->zink}}">&nbsp;mg
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 18%;" class="nowrap" title="Koper">Koper</th>
                                    <td style="width: 12%;">
                                        <input class="form-control  text-right" name="koper" type="text"
                                               value="{{$products->koper}}">&nbsp;mg
                                    </td>
                                    <th style="width: 18%;" class="nowrap" title="Selenium">Selenium</th>
                                    <td style="width: 12%;">
                                        <input class="form-control  text-right" name="selenium" type="text"
                                               value="{{$products->selenium}}">&nbsp;mg
                                    </td>
                                    <th style="width: 18%;" class="nowrap" title="Vitamine C">Vitamine C</th>
                                    <td style="width: 12%;">
                                        <input class="form-control  text-right" name="vitc" type="text"
                                               value="{{$products->vitc}}">&nbsp;mg
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 18%;" class="nowrap" title="Vitamine B1">Vitamine B1</th>
                                    <td style="width: 12%;">
                                        <input class="form-control  text-right" name="vitb1" type="text"
                                               value="{{$products->vitb1}}">&nbsp;mg
                                    </td>
                                    <th style="width: 18%;" class="nowrap" title="Vitamine B2">Vitamine B2</th>
                                    <td style="width: 12%;">
                                        <input class="form-control  text-right" name="vitb2" type="text"
                                               value="{{$products->vitb2}}">&nbsp;mg
                                    </td>
                                    <th style="width: 18%;" class="nowrap" title="Vitamine B6">Vitamine B6</th>
                                    <td style="width: 12%;">
                                        <input class="form-control  text-right" name="vitb6" type="text"
                                               value="{{$products->vitb6}}">&nbsp;mg
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 18%;" class="nowrap" title="Foliumzuur">Foliumzuur</th>
                                    <td style="width: 12%;">
                                        <input class="form-control  text-right" name="foliumzuur" type="text"
                                               value="{{$products->foliumzuur}}">&nbsp;mcg
                                    </td>
                                    <th style="width: 18%;" class="nowrap" title="Vitamine B12">Vitamine B12</th>
                                    <td style="width: 12%;">
                                        <input class="form-control  text-right" name="vitb12" type="text"
                                               value="{{$products->vitb12}}">&nbsp;mcg
                                    </td>
                                    <th style="width: 18%;" class="nowrap" title="Vitamine A">Vitamine A</th>
                                    <td style="width: 12%;">
                                        <input class="form-control  text-right" name="vita" type="text"
                                               value="{{$products->vita}}">&nbsp;mcg
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 18%;" class="nowrap" title="Vitamine E">Vitamine E</th>
                                    <td style="width: 12%;">
                                        <input class="form-control  text-right" name="vite" type="text"
                                               value="{{$products->vite}}">&nbsp;mg
                                    </td>
                                    <th style="width: 18%;" class="nowrap" title="Vitamine D">Vitamine D</th>
                                    <td style="width: 12%;">
                                        <input class="form-control  text-right" name="vitd" type="text"
                                               value="{{$products->vitd}}">&nbsp;mcg
                                    </td>
                                    <th style="width: 18%;" class="nowrap" title="Onverzadigde vetzuren">Onverzadigde
                                        vetzuren
                                    </th>
                                    <td style="width: 12%;">
                                        <input class="form-control  text-right" name="onverzadigdevetzuren" type="text"
                                               value="{{$products->onverzadigdevetzuren}}">&nbsp;g
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 18%;" class="nowrap" title="Cholesterol">Cholesterol</th>
                                    <td style="width: 12%;">
                                        <input class="form-control  text-right" name="cholesterol" type="text"
                                               value="{{$products->cholesterol}}">&nbsp;mg
                                    </td>
                                    <th style="width: 18%;" class="nowrap" title="Alcohol">Alcohol</th>
                                    <td style="width: 12%;">
                                        <input class="form-control  text-right" name="alcohol" type="text"
                                               value="{{$products->alcohol}}">&nbsp;g
                                    </td>
                                    <th style="width: 18%;" class="nowrap" title="Enkelv. onverz. vet">Enkelv. onverz.
                                        vet
                                    </th>
                                    <td style="width: 12%;">
                                        <input class="form-control  text-right" name="onverzvet" type="text"
                                               value="{{$products->onverzvet}}">&nbsp;g
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 18%;" class="nowrap" title="Meerv. onverz. vet">Meerv. onverz.
                                        vet
                                    </th>
                                    <td style="width: 12%;">
                                        <input class="form-control  text-right" name="meervonverzvet" type="text"
                                               value="{{$products->meervonverzvet}}">&nbsp;g
                                    </td>
                                    <th style="width: 18%;" class="nowrap" title="Transvet">Transvet</th>
                                    <td style="width: 12%;">
                                        <input class="form-control  text-right" name="transvet" type="text"
                                               value="{{$products->transvet}}">&nbsp;g
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <div id="foodline"
                                 style="width:100%; margin-top:10px; margin-bottom: 20px; border-top:2px solid #dcdcdc;">
                                <div id="morenutr" style="cursor:pointer; width:100%; line-height:30px;">
                                    <div class="nutrtoggleinfo" onclick="loadmore()"> Toon micro nutriënten</div>
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

                        @foreach($units as $unit)

                            <tr>
                                <td>
                                    <input class="form-control" type="text" name="foodunit[]" value="{{$unit->foodunit}}">
                                </td>
                                <td>
                                    <input class="form-control" type="text" style="float:left; width: 100px; margin-right: 5px;" name="amounts[]"
                                    value="{{$unit->amount}}">
                                    <select class="form-control" name="foodweights[]" style="height: 33px;width: 100px">
                                        <option @if($unit->weight=="gramml") selected @endif value="gramml">gram / ml</option>
                                          <option @if($unit->weight=="gram") selected @endif value="gram" selected="selected">gram</option>
                                          <option @if($unit->weight=="ml") selected @endif value="ml">ml</option>
                                           </select>
                                </td>
                                  <td>
                                      <input class="form-control" @if($unit->setdefault) checked @endif  type="radio" name="sel_default" checked="checked" value="'+val+'"  style="margin-top: 3px; margin-left: 5px;">
                                      {{--<input type="hidden" name="unitexists[]" value="0">--}}
                                       <label id="default_label" style="margin-left: 5px;">Standardunit</label>
                                       </td>
                                   </tr>
                        @endforeach
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
                <button class="btn btn-info" onclick="$('#product-form-edit').submit()">Save</button>
                <button class="btn btn-default modal-dismiss" onclick="$('#productModaledit').modal('hide')">Cancel
                </button>
            </div>
        </div>
    </footer>
</section>
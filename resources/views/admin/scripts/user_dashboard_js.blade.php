        <!-- Specific Page Vendor -->
<script src="{{ asset('admin_files/vendor/jquery-ui/jquery-ui.js')}}"></script>
<script src="{{ asset('admin_files/vendor/jqueryui-touch-punch/jqueryui-touch-punch.js')}}"></script>
<script src="{{ asset('admin_files/vendor/jquery-appear/jquery-appear.js')}}"></script>
<script src="{{ asset('admin_files/vendor/bootstrap-multiselect/bootstrap-multiselect.js')}}"></script>
<script src="{{ asset('admin_files/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js')}}"></script>
<script src="{{ asset('admin_files/vendor/flot/jquery.flot.js')}}"></script>
<script src="{{ asset('admin_files/vendor/flot.tooltip/flot.tooltip.js')}}"></script>
<script src="{{ asset('admin_files/vendor/flot/jquery.flot.pie.js')}}"></script>
<script src="{{ asset('admin_files/vendor/flot/jquery.flot.categories.js')}}"></script>
<script src="{{ asset('admin_files/vendor/flot/jquery.flot.resize.js')}}"></script>
<script src="{{ asset('admin_files/vendor/jquery-sparkline/jquery-sparkline.js')}}"></script>
<script src="{{ asset('admin_files/vendor/raphael/raphael.js')}}"></script>
<script src="{{ asset('admin_files/vendor/morris/morris.js')}}"></script>
<script src="{{ asset('admin_files/vendor/gauge/gauge.js')}}"></script>
<script src="{{ asset('admin_files/vendor/snap.svg/snap.svg.js')}}"></script>
<script src="{{ asset('admin_files/vendor/liquid-meter/liquid.meter.js')}}"></script>
<script src="{{ asset('admin_files/vendor/jqvmap/jquery.vmap.js')}}"></script>
<script src="{{ asset('admin_files/vendor/jqvmap/data/jquery.vmap.sampledata.js')}}"></script>
<script src="{{ asset('admin_files/vendor/jqvmap/maps/jquery.vmap.world.js')}}"></script>
<script src="{{ asset('admin_files/vendor/jqvmap/maps/continents/jquery.vmap.africa.js')}}"></script>
<script src="{{ asset('admin_files/vendor/jqvmap/maps/continents/jquery.vmap.asia.js')}}"></script>
<script src="{{ asset('admin_files/vendor/jqvmap/maps/continents/jquery.vmap.australia.js')}}"></script>
<script src="{{ asset('admin_files/vendor/jqvmap/maps/continents/jquery.vmap.europe.js')}}"></script>
<script src="{{ asset('admin_files/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js')}}"></script>
<script src="{{ asset('admin_files/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js')}}"></script>

<!-- Specific Page Vendor -->
    
<script src="{{ asset('admin_files/vendor/chartist/chartist.js')}}"></script>
<script src="{{ asset('admin_files/js/examples/examples.charts.js')}}"></script>
<script src="{{ asset('admin_files/vendor/datatables/media/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset('admin_files/vendor/datatables/media/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{ asset('admin_files/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{ asset('admin_files/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{ asset('admin_files/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js')}}"></script>
        <script src="{{ asset('admin_files/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js')}}"></script>
        <script src="{{ asset('admin_files/vendor/datatables/extras/TableTools/JSZip-2.5.0//jszip.min.js')}}"></script>
        <script src="{{ asset('admin_files/vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js')}}"></script>

    <script type="text/javascript">
    var datatableInit_test = function() {
        var $table = $('.test-table');
        var table = $table.dataTable({
            bDestroy: true,
            responsive:true,
            dom: 'Bfrtip',
            buttons: [
            {
                extend:    'print',
                text:      '<span class="hvr-grow-shadow"><i class="fa fa-file-text-o"></i> Print</span>',
                titleAttr: 'print'
            },
            {
                extend:    'excelHtml5',
                text:      '<span class="hvr-grow-shadow"><i class="fa fa-file-excel-o"></i> Excel</span>',
                titleAttr: 'Excel'
            },
            {
                extend:    'pdfHtml5',
                text:      '<span class="hvr-grow-shadow"><i class="fa fa-file-pdf-o"></i> PDF</span>',
                titleAttr: 'PDF'
            },
        ],
            fnDrawCallback: function() {
                var $paginate = this.siblings('.dataTables_paginate');

                if (this.api().data().length <= this.fnSettings()._iDisplayLength){
                    $paginate.hide();
                }
                else{
                    $paginate.show();
                }
            }
        });
    };


$(document).ready(function(){
    if($('#sleep_q3').val()=='1'){
        $('.sleep').show();
    }
    else{
        $('.sleep').hide();
    }

    datatableInit_test();
    $('.daily_food').click(function(){
        openModal('add-user-daily-food');
    });
    $('#sleep_q3').change(function(){
        if($('#sleep_q3').val()=='1'){
            $('.sleep').show();
        }
        else{
            $('.sleep').hide();
        }
    });
    var Chart_data = {

        <?php

            $months = ["Januari", "Februari", "Maart", "April", "Mei", "Juni", "Juli", "Augustus", "September", "Oktober", "November", "December"];
            $lbl = $dt = $kl =$sl = '';
        for ($i = 0; $i < count($sectionData['weightvals']); $i++) {
            $lbl .= '"' . $sectionData['sleepdates'][$i] . ' ' . $months[date('n') - 1] . '",';
            $dt .= $sectionData['weightvals'][$i] . ',';
            $kl .= $sectionData['kcalvals'][$i] . ',';
            $sl .= $sectionData['sleepvals'][$i] . ',';
        }

            $lbl = trim($lbl, ",");
            $dt = trim($dt, ",");
            $kl = trim($kl, ",");
            $sl = trim($sl, ",");
        ?>
        labels: [{!! $lbl !!}],
        series: [
            {
                name: 'Slaaphygiene',
                data: [{{ $sl }}]
            },
            {
                name: 'Gewicht',
                data: [{{$dt}}]
            },
            {
                name: 'Kcal Inname',
                data: [{{ $kl }}]
            }
        ]
    };
   
    // user Chat init
    if( $('.sleep-graph').get(0) ) {

        var colors = ["#0088cc", "#d2322d", "#47a447"];
        chart = new Chartist.Line('.sleep-graph', Chart_data);
        chart.on('draw', function(context) {

            if(context.type=="line" && typeof colors[context.index] != "undefined"){
                context.element.attr({
                      style: 'stroke: '+colors[context.index]
                    });
            }
            if(context.type=="point" && typeof colors[context.seriesIndex] != "undefined"){
                context.element.attr({
                      style: 'stroke: '+colors[context.seriesIndex]
                    });
            }
        });

    }



/*  Sparkline: Bar*/
 // var range_map = $.range_map({
  //   '1:': '#D9A348',
  //   '2': '#D9A348',
  //   '3:': '#86B63A',
  //   '4': '#86B63A',
  //   '5': '#3F9BDB',
  //   '6': '#E73164',
  //   '7': '#E73164',
  // })
    if( $('#sparklineBar').get(0) ) {
        $("#sparklineBar").sparkline(sparklineBarData, {
            type: 'bar',
            //width: '100',
            height: '30',
            //colorMap: range_map,
            negBarColor: '#B20000'
        });
    }
    @for ($i = 0; $i < count($sectionData['sleepdates']); $i++) 
        if( $('#sparklineBar{{$i}}').get(0) ) {
            var sparklineBarData = [{{$sectionData['kcalvals'][$i]}},{{$sectionData['weightvals'][$i]}}, {{$sectionData['sleepvals'][$i]}} ];

            $("#sparklineBar{{$i}}").sparkline(sparklineBarData, {
                type: 'bar',
                //width: '100',
                height: '30',
                //colorMap: range_map,
                negBarColor: '#B20000'
            });
        }
    @endfor
        $("table").on("click", ".add-row", function () {
            var markup = '<tr>\n' +
                '<td style="padding: 5px"><input type="hidden" class="form-control" value="0" name="exid[]"><input type="date" class="form-control" value="' + datum + '" name="datum[]"></td> ' +
                '<td style="padding: 5px"><input type="text" class="form-control" value="' + backsquat + '" name="backsquat[]"></td> ' +
                '<td style="padding: 5px"><input type="text" class="form-control" value="' + benchpress + '" name="benchpress[]"></td> ' +
                '<td style="padding: 5px"><input type="text" class="form-control" value="' + deadlift + '" name="deadlift[]"></td> ' +
                '<td style="padding: 5px"><input type="text" class="form-control" value="' + chinups + '" name="chinups[]"></td> ' +
                '<td style="padding: 5px"><input type="text" class="form-control" value="' + shoulderpress + '" name="shoulderpress[]"></td>' +
                '<td align="center"><span class="btn btn-danger delete-row"><i class="fa fa-remove"></i></span></td>\n' +
                '</tr>';
            $("table#tbl-tabone tbody").append(markup);

        });


        $("table").on("click", ".delete-row-three", function () {
            $(this).closest("tr").remove();
        });

        $("table").on("click", ".add-row-three", function () {
            var datum = $("#datumv").val();
            var borst = $("#borstv").val();
            var heup = $("#heupv").val();
            var buik = $("#buikv").val();
            var onderrug = $("#onderrugv").val();
            var quadricep = $("#quadricepv").val();
            var adductoren = $("#adductorenv").val();
            var kuiten = $("#kuitenv").val();


            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!

            var yyyy = today.getFullYear();
            if (dd < 10) {
                dd = '0' + dd;
            }
            if (mm < 10) {
                mm = '0' + mm;
            }
            var today = yyyy + '-' + mm + '-' + dd;

            var datum = $("#datumv").val();
            var borst = $("#borstv").val();
            var heup = $("#heupv").val();
            var buik = $("#buikv").val();
            var onderrug = $("#onderrugv").val();
            var quadricep = $("#quadricepv").val();
            var adductoren = $("#adductorenv").val();
            var kuiten = $("#kuitenv").val();

            $("#datumv").val(today);
            $("#borstv").val("0");
            $("#heupv").val("0");
            $("#buikv").val("0");
            $("#onderrugv").val("0");
            $("#quadricepv").val("0");
            $("#adductorenv").val("0");
            $("#kuitenv").val("0");

            var markup = '<tr>' +
                '<td style="padding: 5px"><input type="hidden" class="form-control" value="0" name="exid[]"><input type="date" class="form-control" value="'+ datum +'" name="datumv[]"></td>' +
                '<td style="padding: 5px"><input type="number" class="form-control" value="'+ borst +'" name="borstv[]" ></td>' +
                '<td style="padding: 5px"><input type="number" class="form-control" value="'+ heup +'" name="heupv[]" ></td>' +
                '<td style="padding: 5px"><input type="number" class="form-control" value="'+ buik +'" name="buikv[]"></td>' +
                '<td style="padding: 5px"><input type="number" class="form-control" value="'+ onderrug +'" name="onderrugv[]"></td>' +
                '<td style="padding: 5px"><input type="number" class="form-control" value="'+ quadricep +'" name="quadricepv[]"></td>' +
                '<td style="padding: 5px"><input type="number" class="form-control" value="'+ adductoren +'" name="adductorenv[]"></td>' +
                '<td style="padding: 5px"><input type="number" class="form-control" value="'+ kuiten +'" name="kuitenv[]"></td>' +
                '<td align="center"><span class="btn btn-danger delete-row-three"><i class="fa fa-remove"></i></span></td>' +
                '</tr>';
            $("table#tbl-tabthree tbody").append(markup);

        });


        $("table").on("click", ".delete-row-four", function () {
            $(this).closest("tr").remove();
        });

        $("table").on("click", ".add-row-four", function () {
            var datum = $("#datumo").val();
            var borst = $("#borsto").val();
            var schouder = $("#schoudero").val();
            var buik = $("#buiko").val();
            var armlinks = $("#armlinkso").val();
            var armrechts = $("#armrechtso").val();
            var bovenbeenlinks = $("#bovenbeenlinkso").val();
            var bovenbeenrechts = $("#bovenbeenrechtso").val();


            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!

            var yyyy = today.getFullYear();
            if (dd < 10) {
                dd = '0' + dd;
            }
            if (mm < 10) {
                mm = '0' + mm;
            }
            var today = yyyy + '-' + mm + '-' + dd;

            $("#datumo").val(today);
            $("#borsto").val("0");
            $("#schoudero").val("0");
            $("#buiko").val("0");
            $("#armlinkso").val("0");
            $("#armrechtso").val("0");
            $("#bovenbeenlinkso").val("0");
            $("#bovenbeenrechtso").val("0");

            var markup = '<tr>' +
                '<td style="padding: 5px"><input type="hidden" class="form-control" value="0" name="exid[]"><input type="date" class="form-control" value="'+ datum +'" name="datumo[]"></td>' +
                '<td style="padding: 5px"><input type="number" class="form-control" value="'+ borst +'" name="borsto[]" ></td>' +
                '<td style="padding: 5px"><input type="number" class="form-control" value="'+ schouder +'" name="schoudero[]" ></td>' +
                '<td style="padding: 5px"><input type="number" class="form-control" value="'+ buik +'" name="buiko[]"></td>' +
                '<td style="padding: 5px"><input type="number" class="form-control" value="'+ armlinks +'" name="armlinkso[]"></td>' +
                '<td style="padding: 5px"><input type="number" class="form-control" value="'+ armrechts +'" name="armrechtso[]"></td>' +
                '<td style="padding: 5px"><input type="number" class="form-control" value="'+ bovenbeenlinks +'" name="bovenbeenlinkso[]"></td>' +
                '<td style="padding: 5px"><input type="number" class="form-control" value="'+ bovenbeenrechts +'" name="bovenbeenrechtso[]"></td>' +
                '<td align="center"><span class="btn btn-danger delete-row-four"><i class="fa fa-remove"></i></span></td>' +
                '</tr>';
            $("table#tbl-tabfour tbody").append(markup);

        });

        /** Update **/
        $(".update-button").click(function () {
            var id = $('#edit-user-id').val();
            var url = "";
            url = url.replace("id", id);
            var user_edit_form = $("#user_edit_form");
            var form_data = user_edit_form.serialize();
            $('.role-error').html("");
            $('.activation-status-error').html("");
            $.ajax({
                url: url,
                type: 'POST',
                data: form_data,
                success: function (data) {
                    console.log(data);
                    if (data.errors) {
                        if (data.errors.role) {
                            $('.role-error').html(data.errors.role[0]);
                        }
                        if (data.errors.activation_status) {
                            $('.activation-status-error').html(data.errors.activation_status[0]);
                        }
                    }
                    if (data.success) {
                        window.location.href = '';
                    }
                },
            });
        });

        /** Update **/
        $(".add-kcal-button").click(function () {
            var id = $('#user_id').val();
            var url = "";
            url = url.replace("id", id);
            var user_meta_add_form = $("#user_meta_add_form");

            var formData = new FormData(); //user_meta_add_form.serialize();
            $.each($(user_meta_add_form).find("input[type='file']"), function (i, tag) {
                $.each($(tag)[0].files, function (i, file) {
                    formData.append(tag.name, file);
                });
            });
            var params = $(user_meta_add_form).serializeArray();
            $.each(params, function (i, val) {
                formData.append(val.name, val.value);
            });

            $.ajax({
                url: url,
                cache: false,
                contentType: false,
                processData: false,
                timeout: 50000,
                type: 'POST',
                data: formData,
                success: function (data) {
                    console.log(data);
                    if (data.success) {
                        window.location.href = '';
                    }
                },
            });
        });

        $('#edit-kcal-inname-modal').on('hide.bs.modal', function (e) {
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!

            var yyyy = today.getFullYear();
            if (dd < 10) {
                dd = '0' + dd;
            }
            if (mm < 10) {
                mm = '0' + mm;
            }
            var today = yyyy + '-' + mm + '-' + dd;

            $('#edit-date').val(today);
            $('#edit-weight').val("");
            $('#edit-kcal').val("");
            $('#edit-sleepq1').val("");
            $('#edit-sleepq2').val("");
            $('#edit-sleepq3').val("");
            $('#edit-sleepq4').val("");
            $('#edit-daily_note').val("");
        });

        $(".usermeta-update").click(function () {
            var id = $(this).data("id");

            var url = "";
            url = url.replace("id", id);
            $.ajax({
                url: url,
                method: "GET",
                dataType: "json",
                success: function (data) {
                    $('#edit-kcal-inname-modal').modal('show');
                    $('#edit-date').val(data['date']);
                    $('#edit-weight').val(data['weight']);
                    $('#edit-kcal').val(data['kcal']);
                    $('#edit-sleepq1').val(data['sleep_q1']);
                    $('#edit-sleepq2').val(data['sleep_q2']);
                    $('#edit-sleepq3').val(data['sleep_q3']);
                    $('#edit-sleepq4').val(data['sleep_q4']);
                    $('#edit-daily_note').val(data['daily_note']);
                }
            });
        });


        /** User View **/
        $(".user-view-button").click(function () {
            var id = $(this).data("id");
            var url = "";
            url = url.replace("id", id);
            $.ajax({
                url: url,
                method: "GET",
                dataType: "json",
                success: function (data) {
                    var src = '{{ asset('public/avatar') }}/';
                    var default_avatar = '{{ asset('public/avatar/user.png') }}';
                    $('#user-view-modal').modal('show');

                    $('#view-name').text(data['name']);
                    $('#view-username').text(data['username']);
                    $('#view-email').text(data['email']);
                    $("#view-avatar").attr("src", src + data['avatar']);
                    if (data['avatar']) {
                        $("#view-avatar").attr("src", src + data['avatar']);
                    } else {
                        $("#view-avatar").attr("src", default_avatar);
                    }
                    if (data['gender'] == 'm') {
                        $('#view-gender').text('Male');
                    } else {
                        $('#view-gender').text('Female');
                    }
                    $('#view-phone').text(data['phone']);
                    $('#view-address').text(data['address']);
                    $('#view-facebook').text(data['facebook']);
                    $('#view-twitter').text(data['twitter']);
                    $('#view-google-plus').text(data['google_plus']);
                    $('#view-linkedin').text(data['linkedin']);
                    $('#view-about').text(data['about']);
                    if (data['role'] == 'admin') {
                        $('#view-role').text('Admin');
                    } else {
                        $('#view-role').text('User');
                    }
                    if (data['activation_status'] == 1) {
                        $('#view-status').text('Active');
                    } else {
                        $('#view-status').text('Block');
                    }
                }
            });
        });
 

// document end 
 });
</script>

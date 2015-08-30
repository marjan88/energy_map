$(document).ready(function () {

    $.ajaxSetup(
            {
                headers:
                        {
                            'X-CSRF-Token': $('input[name="_token"]').val()
                        }
            });

    $(function ()
    {

        $("#q").autocomplete({
            source: function (request, response) {
                $.post("/user/search/autocomplete", request, response);
            },
            minLength: 3,
            select: function (event, ui) {

                $('#id').val(ui.item.value);
                
            }
        });

        $("#suche").autocomplete({
            source: "/user/search/anlagenregister",
            minLength: 3,
            select: function (event, ui) {

                $('#id').val(ui.item.value);
                $('#search').submit();
            }
        });
        var loading = $("#preloader-1");
        var table = $('#table');
        $(document).ajaxStart(function () {
            loading.show();
        });

        $(document).ajaxStop(function () {
            loading.hide();

        });

        var selected = [];
        $("#search").submit(function (e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "/user/search/anlagenregister",
                data: $('#search').serialize(),
                success: function (data) {
                    if (data.fail) {
                        $('.searchError').html('<strong>Error:</strong> Search field is required!').show('slow');
                        setTimeout(function () {
                            $('.searchError').hide('slow')
                        }, 3000);
                    } else {

                        var html = '';
                        var modal = ''
                        $.each(data, function (index, value) {

                            html += '<tr id="' + value.id + '"><td>' + value.year + '</td><td>' + value.value + '</td><td>' + value.ort + '</td>\n\
                                    <td>' + value.strasse + '</td><td>' + value.type + '</td>\n\
                                    <td>' + value.leistung + '</td><td>' + value.energietraeger + '</td>\n\
                                    <td>' + value.netzbetreiber + '</td><td><input class="checkbox" id="' + value.id + '" type="checkbox" name="id[]" value="' + value.id + '"></td>\n\
                                    <td><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal' + value.id + '">View</button></td></tr>';

                            modal += '<div class="modal fade" id="modal' + value.id + '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">\n\
                                <div class="modal-dialog">\n\
                                <div class="modal-content">\n\
                                <div class="modal-header">\n\
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>\n\
                                  <h4 class="modal-title" id="myModalLabel">PLZ: ' + value.value + '</h4>\n\
                                </div>\n\
                                <div class="modal-body"><table id="table" class="table table-striped table-hover "><tbody>\n\
                                    <tr><td><strong>Inbetriebnahme:</strong></td>\n\
                                        <td>' + value.year + '</td>\n\
                                    </tr><tr><td><strong>Postleitzahl:</strong></td>\n\
                                        <td>' + value.value + '</td>\n\
                                    </tr><tr><td><strong>Bundesland:</strong></td>\n\
                                        <td>' + value.bundesland + '</td>\n\
                                    </tr><tr><td><strong>Ort:</strong></td>\n\
                                        <td>' + value.ort + '</td></tr>\n\
                                    <tr><td><strong>Strasse:</strong></td>\n\
                                        <td> ' + value.strasse + '</td></tr>\n\
                                    <tr><td><strong>Anlagentyp:</strong></td>\n\
                                        <td> ' + value.Anlagentyp + '</td></tr>\n\
                                    <tr><td><strong>kWh 2013:</strong></td>\n\
                                        <td> ' + value.kWh_2013 + '</td></tr>\n\
                                     <tr><td><strong>kWh Average:</strong></td>\n\
                                        <td> ' + value.kWh_average + '</td></tr>\n\
                                    <tr><td><strong>DSO:</strong></td>\n\
                                        <td>' + value.DSO + '</td></tr>\n\
                                    <tr><td><strong>TSO:</strong></td>\n\
                                        <td>' + value.TSO + '</td></tr>\n\
                                    <tr><td><strong>Anlagenschluessel:</strong></td>\n\
                                        <td>' + value.key + '</td></tr>\n\
                                    <tr><td><strong>installierte Leistung KwP:</strong></td>\n\
                                        <td>' + value.leistung + '</td></tr>\n\
                                    <tr><td><strong>Energietraeger:</strong></td>\n\
                                        <td>' + value.energietraeger + '</td></tr>\n\
                                    <tr><td><strong>Netzbetreiber:</strong></td>\n\
                                        <td>' + value.netzbetreiber + '</td></tr>\n\
                                    <tr><td><strong>Anschrift:</strong></td>\n\
                                        <td>' + value.anschrift + '</td></tr>\n\
                                    <tr><td><strong>Anlagenhersteller:</strong></td>\n\
                                        <td> ' + value.anlagenhersteller + '</td></tr>\n\
                                    <tr><td><strong>Anlagennummer:</strong></td>\n\
                                        <td> ' + value.anlagennummer + '</td></tr>\n\
                                </tbody></table></div>\n\
                                <div class="modal-footer">\n\
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>\n\
                                  </div></div></div></div>';

                        });

                        $('.data').html(html);
                        $('.modalDiv').html(modal);
                        table.show();
                        var selected = [];
                         $('#table').dataTable({
                            "rowCallback": function (row, data) {
                                if ($.inArray(data.DT_RowId, selected) !== -1) {
                                    $(row).addClass('selected');
                                }
                            }
                        });
                        $('#table tbody').on('click', 'tr', function () {
                            var id = this.id;
                            var index = $.inArray(id, selected);

                            if (index === -1) {
                                selected.push(id);

                            } else {
                                selected.splice(index, 1);
                            }
                            $(this).toggleClass('selected');
                            $('#' + id + ' input').attr('checked', true);

                            $('#arrayData').val(selected)

                        });
                        $('#myModal').modal('toggle');
                        $('#id').val("");
                        $('#suche').val("");
                    }

                }
            }, "json");
        });

       

    });
});
        
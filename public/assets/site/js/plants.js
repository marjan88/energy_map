$(document).ready(function () {
    var loading = $("#loading");

    $(document).ajaxStart(function () {
        loading.show();

    });

    $(document).ajaxStop(function () {
        loading.hide();

    });

    $.ajax({
        type: "GET",
        url: "/user/home/data",
        success: function (data) {
//                  
            var html = '';

            $.each(data, function (index, value) {

                html += '<tr><td>' + value.value + '</td><td>' + value.ort + '</td>\n\
                                    <td>' + value.strasse + '</td><td>' + value.type + '</td>\n\
                                    <td>' + value.leistung + '</td><td>' + value.energietraeger + '</td>\n\
                                    <td>' + value.netzbetreiber + '</td>\n\
                                    <td><a class="btn btn-sm btn-primary" href="' + base + '/' + value.id + '/show">View</a></td></tr>';


            });

            $('.data').html(html);

            $('#plants').dataTable();



        }
    }, "json");
});



     
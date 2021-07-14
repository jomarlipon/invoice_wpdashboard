$(document).ready(function() {


    $('i.fa-cloud-download').click(function() {

        alert('Downloading invoices is coming for our next feature.');

    });
    $('.button-markpaid').click(function() {
        alert('Soon it will be available');
    });

    $('li.nav-item a').click(function() {

        let status = $(this).data('invstatus');
        let formData = { action: 'get_invdash', "status": status };
        $("#invtable").dataTable().fnDestroy();
        ajaxLoad(formData);

    }).eq(0).click();

    $('#searchInvoice').keyup(function() {
        table = ajaxLoad();
        table.search($(this).val()).draw();
    });

    function ajaxLoad(formData = "") {
        // jQuery.ajax({
        //     type: "post",
        //     dataType: "html",
        //     url: invdash_ajax.ajax_url,
        //     data: formData,
        //     beforeSend: function() {
        //         $(".image-overlayload").show();
        //     },
        //     success: function(response) {
        //         $(".image-overlayload").hide();
        //         $('.inv-contentTable').html(response);
        //     }
        // });


        var table = $('#invtable').DataTable({

            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": invdash_ajax.ajax_url + '?action=' + formData.action + '&status=' + formData.status,
                "type": "POST",
            },
            paging: false,
            searching: false,
            pageLength: 12,
            bRetrieve: true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>'
            },
            "bInfo": false,
            "lengthChange": false,
            "ordering": false,
            "createdRow": function(row, data, dataIndex) {
                //console.log(data);
                if (data['3'] == "ongoing") {
                    $(row).addClass('ongoing');
                }
                if (data[3] == "verified") {
                    $(row).addClass('verified');
                }
                if (data[3] == "pending") {
                    $(row).addClass('pending');
                }
                if (data[3] == "paid") {
                    $(row).addClass('paid');
                }
            },
            "columns": [
                { "data": null, defaultContent: '', orderable: false },
                { "data": "invoiceid", orderable: false },
                { "data": "restaurant" },
                {
                    "data": "invoicestatus",
                },
                { "data": "invstartdate" },
                { "data": "invenddate" },
                { "data": "invtotal" },
                { "data": "invfee" },
                { "data": "invtransfer" },
                { "data": "invorders" },
                {
                    data: null,
                    defaultContent: '<i class="fa fa-cloud-download" aria-hidden="true"></i>',
                    className: 'column-download dt-center',
                    orderable: false
                },

            ],
            columnDefs: [{
                    className: 'select-checkbox',
                    orderable: false,
                    targets: 0,
                    width: '5%',
                },
                { width: "8%", "targets": 1 }, { width: "15%", "targets": 2 }, { width: "10%", "targets": 3 }, { width: "10%", "targets": 4 }, { width: "10%", "targets": 5 }, { width: "10%", "targets": 6 }, { width: "10%", "targets": 7 }, { width: "10%", "targets": 8 }, { width: "6%", "targets": 9 }, { width: "7%", "targets": 10 }

            ],
            order: [
                [1, 'asc']
            ],
            select: {
                style: 'os',
                selector: 'td:first-child'
            }
        });

        return table;
    }
});
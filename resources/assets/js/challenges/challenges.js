'use strict';

let tableName = '#challengesTable';
$(tableName).DataTable({
    scrollX: true,
    deferRender: true,
    scroller: true,
    processing: true,
    serverSide: true,
    'order': [[0, 'asc']],
    ajax: {
        url: recordsURL,
    },
    columnDefs: [
        {
            'targets': [8],
            'orderable': false,
            'className': 'text-center',
            'width': '8%',
        },
    ],
    columns: [
        {
            data: 'challenger_id',
            name: 'challenger_id'
        },{
            data: 'challenged_id',
            name: 'challenged_id'
        },{
            data: 'week_id',
            name: 'week_id'
        },{
            data: 'winner_id',
            name: 'winner_id'
        },{
            data: 'challenged_at',
            name: 'challenged_at'
        },{
            data: 'challenger_rank',
            name: 'challenger_rank'
        },{
            data: 'challenged_rank',
            name: 'challenged_rank'
        },{
            data: 'video',
            name: 'video'
        },
        {
            data: function (row) {
                let url = recordsURL + row.id;
                let data = [
                {
                    'id': row.id,
                    'url': url + '/edit',
                }];
                                
                return prepareTemplateRender('#challengesTemplate',
                    data);
            }, name: 'id',
        },
    ],
});

$(document).on('click', '.delete-btn', function (event) {
    let recordId = $(event.currentTarget).data('id');
    deleteItem(recordsURL + recordId, tableName, 'Challenge');
});

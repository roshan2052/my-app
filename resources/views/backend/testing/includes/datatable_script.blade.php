<script>
$( document ).ready(function() {
    let testingTable = $('#testing_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            "url": "{{ route('backend.testing.data') }}",
            'type': 'POST',
            data: function(d) {
                d._token = "{{ csrf_token() }}";
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
            {data: "test", name: "test.title"},
            {data: "title", name: "title"},
            {data: "created_at", name: "created_at"},
            {data: "image", name: "image"},
            {data: "action", name: "action", searchable: false, orderable: false}
        ]
    });
});
</script>

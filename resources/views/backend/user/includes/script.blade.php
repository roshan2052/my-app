<script>

    $( document ).ready(function() {
        
        $('form#main_form').on('submit', function(event) {
            event.preventDefault();
            let route = $(this).attr('action');
            let method = $(this).attr('method');
            let data = new FormData(this);

            $.ajax({
                url: route,
                data: data,
                method: method,
                dataType: "JSON",
                contentType: false,
                cache: false,
                processData: false,
                success: function(res) {
                    window.location.href = "{{route($base_route.'profile')}}";
                },
                error: function(err) {
                    $('span.text-danger').remove();
                    if (err.responseJSON.errors) {
                        $.each(err.responseJSON.errors, function(key, value) {
                            let splitted_key = key.split('.');
                            $('#' + key).after("<span class='text-danger'>" + value + "<br></span>");
                        });
                    }
                },
            });
        });

        $('#profile_image').change(function() {
            var file = $("input[type=file]").get(0).files[0];

            if(file){
                var reader = new FileReader();
                reader.onload = function(){
                    $("#preview_img").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        });
    });

</script>

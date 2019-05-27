 $( "#sortable" ).sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('#sortable>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateOrder(selectedData);
        }
    });


    function updateOrder(data) {
        $.ajax({
            url:"task.php",
            type:'post',
            data:{position:data},
            success:function(){
                alert('your change successfully saved');
            }
        })
    }

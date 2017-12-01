$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
});

$(document).ready(function(){
 

    $('#form_value').submit(function(e){
        
        var key_attr = $('#keyAttribute').val();
        var value_attr = $('#valueAttribute').val();
        var id = $('#product_id').val();
        e.preventDefault();
        $.post('/ajax_insert_value_post',{key:key_attr,value:value_attr,id:id},function(data){
                // something doing
        });
        $.post('/ajax_insert_value_post_1',{key:key_attr,value:value_attr,id:id},function(data){
            // something doing
    
            var resuft = "";
            $.each($.parseJSON(data), function() {
                $('#dataAttribute').html("");
                resuft+='<tr style="text-align:center"><td>'+this.id+'</td><td>'+this.name+'</td><td>'+this.value+'</td></tr>';
                
            });
            $('#dataAttribute').html(resuft);
           //alert(data);
         });
    });




});
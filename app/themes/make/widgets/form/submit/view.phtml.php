<div id="widget_<?php echo $widget->id; ?>"   > <?php echo $controls; ?><div>

</br></br>
<button id="w_<?php echo $widget->id; ?>" onclick="getSubmit()" class="form-control">
Submit
</button
</div><script>

function getSubmit()
{
    alert("Successfully Posted Data");
var result ={}; 

<?php foreach ($parm['process_parms'] as $par => $key) { ?>

result.<?php echo $par; ?> = submit_<?php echo $key; ?>(false);


<?php } ?>

$.post("/ProcessScheduled/ExecuteProcess/<?php echo $parm['process_id']; ?>",result,function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
    });

}

</script><?php echo $this->getContent(); ?></div>

                    <h5>Date
                                        <span class="semi-bold">Range</span>
                                    </h5>
                    <br>
                    <div class="input-daterange input-group" id="datepicker-range">
                      <input type="text" class="input-sm form-control" name="start" />
                      <span class="input-group-addon">to</span>
                      <input type="text" class="input-sm form-control" name="end" />
                    </div><script>
$('#datepicker-range').datepicker();
</script><?php echo $this->getContent(); ?>
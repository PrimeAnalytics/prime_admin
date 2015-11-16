<div id="portlet_<?php echo $portlet->id; ?>" class="<?php echo $parm['width']; ?>" >  <style type="text/css">
.met_accordion > .met_accordion_content {
    display: block!important;    /* undo display:none          */
    height: 0;          /* height:0 is also invisible */ 
    overflow-y: hidden; /* no-overflow                */
}
.met_accordion_on > .met_accordion_content{
    height: auto;       /* let the content decide it  */
}   
 </style>
                    


  <div >
      <?php $tabs = explode(',', $parm['tabs']) ?>
					<div class="met_accordions">
					 <?php foreach ($tabs as $key => $tab) { ?>
					 
					 <div class="met_accordion">
							<div class="met_accordion_head clearfix">
								<span class="met_accordion_icon met_bgcolor_transition"><i class="plus">&#43;</i></span>
								<span class="met_accordion_title"><?php echo $tab; ?></span>
							</div>
							<div class="met_accordion_content">
								<?php echo $region[$key]; ?>
							</div>
						</div>

                    <?php } ?>
					</div>
				</div>
				
  <script>
$(function(){
		$('.met_accordion.met_accordion_on .met_accordion_content').slideDown();
		$('.met_accordion.met_accordion_on').find('.plus').removeClass('plus').addClass('minus').html('-');

		$('.met_accordion_head').click(function(){
			var thisAccordion         = $(this);
			var thisAccordionParent   = thisAccordion.parent();
			var accordionContainer   = thisAccordionParent.parent();

			if(thisAccordionParent.hasClass('met_accordion_on')){
				thisAccordionParent.removeClass('met_accordion_on');
				thisAccordion.next().slideUp();
				thisAccordion.find('.minus').removeClass('minus').addClass('plus').html('+');
			}else{
				accordionContainer.find('.met_accordion_on').removeClass('met_accordion_on').children('.met_accordion_content').slideUp().parent().find('.minus').removeClass('minus').addClass('plus').html('+');
				thisAccordionParent.addClass('met_accordion_on').children('.met_accordion_content').slideDown().parent().find('.plus').removeClass('plus').addClass('minus').html('-');
			}
		});
	});
  </script><?php echo $this->getContent(); ?></div>
<article id="portlet_<?php echo $portlet->id; ?>" class="<?php echo $parm['width']; ?>" class=" isotope-item" > <a class="met_bl_preview">
                     						<div class="row">
						    <?php echo $region[0]; ?>
						</div>
						<div class="row">
						</div>
                     </a>

					
						
							<div class="met_bl_item_details">
							
								<div class="met_blid_title_misc">
									<a><h3 class="met_color_transition"><?php echo $parm['title']; ?></h3></a>
									<br><div class="met_blidtm_bottom_border"></div>
								</div>

								<div class="met_blid_excerpt"><p><?php echo $parm['description']; ?></p></div>

							</div>
						<?php echo $this->getContent(); ?></article>
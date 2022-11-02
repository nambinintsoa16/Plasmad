<div class="sidebar sidebar-style-2" data-background-color="dark">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">  
            <ul class="nav nav-primary">
			
			    <?php $i=1; foreach ($list_menu as $menu):?>
				   <?php if (isset($menu->sous_menu)): ?>
				     <li class="nav-item">
					 <a data-toggle="collapse" href="#link_<?=$i?>" class="nav-link"> 
                        <i class="fa fa-mortar-board"></i>
                        <p><?=$menu->text?></p>
                        <span class="caret"></span>
                    </a>
					 <?php if (isset($menu->sous_menu)): ?>
						
                          <div class="collapse" id="link_<?=$i?>">
                               <ul class="nav nav-collapse">
							    <?php foreach ($menu->sous_menu as $sous_menu): ?>
                                  <li>
                                     <a href="<?=base_url().$sous_menu->link?>">
                                       <span class="sub-item"><?=$sous_menu->text?></span>
                                     </a>
                                   </li>
                                <?php endforeach;?>  
                        </ul>
                    </div>
					 <?php endif ?>  
                </li>
				<?php $i++; else: ?>
			      <li class="nav-item">
					 <a  href="<?=base_url().$menu->link?>" class="nav-link"> 
                        <i class="<?=$menu->icon?>"></i>
                        <p><?=$menu->text?></p>      
                    </a> 
                </li>
                       				
			<?php endif?>
          <?php endforeach?>				

            </ul>
        </div>
    </div>
</div>
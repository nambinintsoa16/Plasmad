<div class="sidebar sidebar-style-2 shadow" data-background-color="" >
  <div class="sidebar-background"></div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="sidebar-content">
        <ul class="nav nav-<?=$nav_color?>" >
          <li class="nav-section">
            <span class="sidebar-mini-icon">
              <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section"><b>MENU</b></h4>
          </li>
          <?php $i=1; foreach ($list_menu as $menu): ?>
           <?php if (isset($menu->sous_menu)): ?>
             <li class="nav-item 
             <?php 
              if (count($uri)==1 && $menu->text==$type_user){
                  echo "active";
              }else if(count($uri)>1){
                  
                 if(trim(strtoupper(str_replace(" ","",$menu->text))) == trim(strtoupper(str_replace("_","",$uri[2])))){
                    echo "active";
                 }                  
              }                
            ?>"> 
          <a data-toggle="collapse" href="#link_<?=$i?>" class="nav-link"> 
                            <i class="<?=$menu->icon?>"></i>      
                            <p><?=$menu->text?></p>
                            <span class="caret"></span>     
                                               
                </a>          
           <?php if (isset($menu->sous_menu)): ?>
              <div class="collapse" id="link_<?=$i?>">
               <ul class="nav nav-collapse text-white">
                  <?php
                  $p=1;
                  foreach ($menu->sous_menu as $sous_menu): ?>
                       <?php if(isset($sous_menu->sous_sous_menu)):?>
                   <li> 
                    <a data-toggle="collapse" href="#<?=$sous_menu->text.$p?>">
                      <span class="sub-item"><?=$sous_menu->text?></span>
                      <span class="caret"></span>
                    </a>
                    <div class="collapse" id="<?php echo $sous_menu->text.$p; $p++;?>">
                      <ul class="nav nav-collapse subnav">
                          <?php foreach ($sous_menu->sous_sous_menu as $sous_sous_menu): ?>
                        <li
                        <?php 
                           $bd="";
                           $df="";
                           $bg="";
                          if(count($uri) > 2)  {     
                           if(trim(strtoupper($sous_sous_menu->text))==trim(strtoupper(str_replace("_"," ",$uri[3])))){
                              echo "class='active'";
                              $bg="text-primary";
                              $bd="<blink>";
                              $df="</blink>";
                           }   
                          } ?>
                        >
                          <a href="<?=base_url($sous_sous_menu->link)?>">
                            <span class="sub-item"><?=$sous_sous_menu->text?></span>
                            
                          </a>
                        </li>
                         <?php endforeach;?>  
                        </ul>
                    </div>
                  </li>
                        <?php else:?>     
                          <li <?php 
                           $bd="";
                           $df="";
                           $bg="";
                          if(count($uri) > 2)  {     
                           if(trim(strtoupper($sous_menu->text))==trim(strtoupper(str_replace("_"," ",$uri[3])))){
                              echo "class='active'";
                              $bg="text-primary";
                              $bd="<blink>";
                              $df="</blink>";
                           }   
                          } ?>>   
                       
                          <a href="<?=base_url($sous_menu->link)?>">
                                       <span class="sub-item <?=$bg?>"><?=$bd.$sous_menu->text.$df?></span>
                                  
                                     </a> 
                                      
                                   </li>
                           <?php endif;?>         
                                <?php endforeach;?>  
                        </ul>
                    </div>
           <?php endif ?>  
                </li>
        <?php  else: ?>
            <li class="nav-item menu-items menu-list 
        <?php if($i==1):
          if (count($uri)==1){
                  echo "active";
              }
         endif;
        if(isset($uri[2]) && $uri[2]=="Discussions" && $menu->text=="Tache"){
          echo "active";

        }else if(isset($uri[2]) && ( $uri[2]=="calendrier" OR  $uri[2]=="calendrier_de_livraison") && $menu->text=="Etat_de_ventes" ){
          echo "active";
        }


      if(count($uri)>1)  {   
        if(trim(strtoupper(strtoupper($menu->text)))==trim(strtoupper(strtoupper(str_replace("_"," ",$uri[2]))))){
                 echo "active";
                }
      }          
            ?>
           ">
                    <a  href="<?=base_url($menu->link)?>" class="nav-link"> 
                         <span class="letter-icon"><i class="<?=$menu->icon?>"></i></span>
                        <p><?=$menu->text?> </p>  
                    </a> 
                </li> 
                               
      <?php endif?>
  <?php $i++; endforeach?>        

      </ul>
    </div>
  </div>
</div>

  
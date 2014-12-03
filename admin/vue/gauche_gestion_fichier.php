
            <div class="panel-group" id="accordion" style="padding: 4%">
            <?php 
            $i = 0;
            foreach($listeThemes as $theme)
            {
         	?>
                <div class="panel panel-default" id="panel-theme-accordion-<?php echo $theme->getId();?>">
                    <div class="panel-heading" style="background-color: white;">
                        <h4 class="panel-title"  >
                            <a data-toggle="collapse" class="title" data-parent="#accordion" href="<?php echo '#'.$theme->getId(); ?>"><span data-id="<?php echo $i; ?>" class="icon glyphicon glyphicon-plus-sign"></a>
                            <a class="accordion-theme" id="theme-accordion-<?php echo $theme->getId();?>" data-id-theme="<?php echo $theme->getId();?>" href="#T<?php echo $theme->getId(); ?>"><?php echo Outils::raccourcirChaine($theme->getTitre(), 15); ?></a>
                        </h4>
                    </div>
                    
                    <div id="<?php echo $theme->getId(); ?>" class="panel-collapse collapse">
                   
                        <div class="panel-body">
                            <table class="table">
                            <?php 
                            $listeExos = $daoExercice->getByAllByTheme($theme->getId());
                            $num_exos = 0;
                            foreach($listeExos as $exos)
                            {
                            ?>
                                <tr>
                                    <td class="cut-text" style="max-width: 50px; <?php if ($num_exos == 0) echo " border-top: none;"?>background-color: white;">
                                        <span><?php echo $exos->getNumero(); ?>  </span><a id="exo-accordion-<?php echo $exos->getId();?>" data-toggle="collapse" data-target="#bloc-<?php echo $exos->getId(); ?>" href="#E<?php echo $exos->getId(); ?>" title="<?php echo $exos->getTitre(); ?>"><?php echo $exos->getTitre(); ?></a>
                                    </td>
                                </tr>
                            <?php   
                            	$num_exos++;
                            }
                            ?>
                            </table>
                        </div>
                    </div>
                </div>
              <?php 
              $i++;
              }
              ?>
            </div>

            
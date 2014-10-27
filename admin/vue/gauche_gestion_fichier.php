
            <div class="panel-group" id="accordion">
            <?php 
            $i = 0;
            foreach($listeThemes as $theme)
            {
         	?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" class="title" data-parent="#accordion" href="<?php echo '#'.$theme->getId(); ?>"><span data-id="<?php echo $i; ?>" class="icon glyphicon glyphicon-plus-sign"></a>
                            <a href="#T<?php echo $theme->getId(); ?>"><?php echo $theme->getTitre(); ?></a>
                        </h4>
                    </div>
                    <div id="<?php echo $theme->getId(); ?>" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                            <?php 
                            $listeExos = $daoExercice->getByAllByTheme($theme->getId());
                            foreach($listeExos as $exos)
                            {
                            ?>
                                <tr>
                                    <td class="cut-text" style="max-width: 50px;">
                                        <span><?php echo $exos->getNumero(); ?></span>   <a href="#E<?php echo $exos->getId(); ?>"><?php echo $exos->getTitre(); ?></a>
                                    </td>
                                </tr>
                            <?php   
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

            
<h5 class="center-text bold">10 dernière réponses</h5>
<?php
include_once ('voir_sujet_forum.php');
?>
<hr>
<div class="row">
	<div class="col-xs-3"></div>
	<div class="col-xs-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-pencil"></i> Répondre
				</h3>
			</div>
			<div class="panel-body">
				<div class="form-wrap">
					<form role="form" method="post" action="../../forum/controleur/ajout_reponse.php" id="form_reponse">
						<div class="form-group">
							<textarea name="message" rows="10" cols="68"></textarea>
						</div>
						<input type="hidden" name="sujet" value="<?php echo $_GET['s']; ?>"/>
						<input type="submit" name="submit" id="btn-login"
							class="btn btn-primary btn-lg btn-block" value="Poster">
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-3"></div>
</div>

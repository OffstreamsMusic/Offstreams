<!--
<div class='bandHeaderWrapper' style="height: 200px; width: 100%;">
	<div class='bandHeaderImageWrapper' style="height: inherit; width: 100%; background: #fff; box-shadow: 1px 1px 3px #333;">
		<!-- BAND HEADER IMAGE GOES HERE --><!--
		<img src="<?php #echo $imgHeaderLoc; ?>" style="<?php #echo $imgHeaderStyle; ?>" />
	</div>
	<div class='bandNameContainer'>
		<!-- BAND NAME --><!--
		<p><?php #echo $view->band_name; ?></p>
	</div>
</div>
-->
<!-- BAND INFO -->
<div class='bandInfoWrapper'>
	<div class='bandImageContainer'>
		<div class='bandImageWrapper'>
			<!-- BAND IMAGE -->
			<img src="<?php echo $imgLoc; ?>" style="<?php echo $imgStyle; ?>" />
		</div>
		<!-- BAND MORE INFO DROP DOWN BUTTON -->
		<div id='bandDropInfoButtonContainer'>
			<img src='<?php echo BASE_URI . "images/bandDropInfoButton.png"; ?>' id='bandDropInfoButton'/>
		</div>
	</div>
	<div class='bandInfoContainer'>
		<div class="bandInfoLeftCol">
			<?php echo $view->bandInfoTitles("title", $infoTitles); ?>
		</div>
		<div class="bandInfoRightCol">
			<?php echo $view->bandInfoTitles("info", $infoTitles); ?>
		</div>
	</div>
</div>

<!-- POLL -->
<div style="<?php echo $polls->setFloat("right"); ?>">
	<?php require(BASEPATH . "polls/bootstrap/pollBootstrap.php"); ?>
</div>
	
<!-- ALBUMS -->
<div style="clear: both;">
	<h1 style="margin-left: 100px;">Albums</h1>
</div>

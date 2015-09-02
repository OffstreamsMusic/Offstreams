<div class='bandHeaderWrapper' style="height: 200px; width: 100%;">
	<div class='bandHeaderImageWrapper' style="height: inherit; width: 100%; background: #fff; box-shadow: 1px 1px 3px #333;">
		<!-- BAND HEADER IMAGE GOES HERE -->
		<img src="<?php echo $imgHeaderLoc; ?>" style="<?php echo $imgHeaderStyle; ?>" />
	</div>
	<div class='bandNameContainer'>
		<!-- BAND NAME -->
		<p><?php echo $view->band_name; ?></p>
	</div>
</div>
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
</div>
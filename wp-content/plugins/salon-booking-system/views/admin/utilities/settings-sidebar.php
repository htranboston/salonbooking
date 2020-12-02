<div class="sln-admin-sidebar <?php if (!defined("SLN_VERSION_PAY") || !SLN_VERSION_PAY) {echo " sln-admin-sidebar--free";}?>">
	<div class="sln-update-settings__wrapper">
		<div class="sln-btn sln-btn--main sln-btn--big sln-btn--icon sln-icon--save sln-update-settings">
			<input type="submit" name="submit" id="submit" class="" value="Update Settings">
		</div>
	</div>
	<!--
	<div class="sln-toolbox">
		<button class="sln-btn sln-btn--mainmedium sln-btn--big sln-btn--icon sln-icon--tools sln-toolbox-trigger visible-md-inline-block visible-lg-inline-block">Tools </button>
		<a href="edit.php?post_type=sln_booking" class="sln-btn sln-btn--main sln-btn--big sln-btn--icon sln-icon--booking">Manage bookings </a>
		<a href="admin.php?page=salon" class="sln-btn sln-btn--main sln-btn--big sln-btn--icon sln-icon--calendar">Check calendar </a>
		<a href="edit.php?post_type=sln_attendant" class="sln-btn sln-btn--main sln-btn--big sln-btn--icon sln-icon--assistants">Active assistants </a>
	</div>
	<button class="sln-btn sln-btn--main sln-btn--small--round sln-btn--icon sln-icon--tools sln-toolbox-trigger-mob
	hidden-md hidden-lg">Tools </button>
	-->
	<?php if (!defined("SLN_VERSION_PAY") || !SLN_VERSION_PAY) {?>
	<div class="sln-admin-banner">
		<h1><?php _e('Unlock all the features of Salon Booking System for only <strong>69,00</strong> € / year ', 'salon-booking-system')?></h1>
		<h3><?php _e('Online payments, mobile app, free access to all ad-ons, priority support, and much more.. ', 'salon-booking-system')?></h3>
		<div class="sln-admin-banner__actions">
			<a href="https://www.salonbookingsystem.com/plugin-pricing/" class="sln-btn sln-btn--borderonly--w sln-btn--banner__cta sln-btn--icon sln-icon--toggle" target="blank"><?php _e('Switch to Business Plan', 'salon-booking-system')?></a>
		</div>
	</div>
	<?php }?>
	<div class="sln-help-button__block">
		<button class="sln-help-button sln-btn sln-btn--nobkg sln-btn--big sln-btn--icon sln-icon--helpchat sln-btn--icon--al visible-md-inline-block visible-lg-inline-block"><?php _e('Do you need help ?', 'salon-booking-system')?></button>
    	<button class="sln-help-button sln-btn sln-btn--mainmedium sln-btn--small--round sln-btn--icon  sln-icon--helpchat sln-btn--icon--al hidden-md hidden-lg"><?php _e('Do you need help ?', 'salon-booking-system')?> </button>
	</div>
</div>
<div class="clearfix"></div>
//Google Review Box by Phat Tran & Huy Tran of HTSwipe Inc
<?php
$user = wp_get_current_user();
$customer = new SLN_Wrapper_Customer($user->ID);
$bookings = $customer->getCompletedBookings();
$feedback_url = home_url() . '?sln_customer_login=' . $customer->getHash() . '&feedback_id=' . $bookings[0]->getId();
echo $feedback_url;
?>
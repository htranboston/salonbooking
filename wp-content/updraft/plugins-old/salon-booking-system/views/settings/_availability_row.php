<?php

$alert = __(
	'This rule represents your open and close days, your open and close shift. Set carefully as it will affect your reservation system.',
	'salon-booking-system'
);

if (empty($row) || !isset($row['from'])) {
	$row = array('from' => array('9:00', '14:00'), 'to' => array('13:00', '19:00'));
}
if (empty($rulenumber)) {
	$rulenumber = 'New';
}
$dateFrom = new SLN_DateTime(isset($row['from_date']) ? $row['from_date'] : null);
$dateTo = new SLN_DateTime(isset($row['to_date']) ? $row['to_date'] : null);
$row['always'] = isset($row['always']) ? ($row['always'] ? true : false) : true;
?>
<div class="col-xs-12 sln-box--sub sln-booking-rule" data-n="<?php echo $rulenumber ?>">
    <h2 class="sln-box-title"><?php _e('Rule', 'salon-booking-system');?> <strong><?php echo $rulenumber; ?></strong> <span class="block"><?php echo $alert ?></span>
    </h2>
    <h3 class="sln-box-title--sec "><?php _e('Available days', 'salon-booking-system');?>
        <span class="block"><?php _e('Available days checked and green.', 'salon-booking-system');?></span>
    </h3>
    <div class="sln-checkbutton-group">
        <?php foreach (SLN_Func::getDays() as $k => $day): ?>
            <div class="sln-checkbutton">
                <?php SLN_Form::fieldCheckboxButton(
	$prefix . "[days][{$k}]",
	(isset($row['days'][$k]) ? 1 : null),
	$label = substr($day, 0, 3)
)?>
            </div>
        <?php endforeach?>
        <div class="clearfix"></div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h3 class="sln-box-title--sec "><?php _e('Available days', 'salon-booking-system');?>
                <span class="block">
                    <?php _e('Available days checked and green.', 'salon-booking-system');?>
                </span>
            </h3>
        </div>
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-12 col-md-6 sln-slider-wrapper sln-slider-wrapper-first-shift">
                    <div class="sln-slider ">
                        <h2 class="sln-box-title"><?php _e('First shift', 'salon-booking-system');?></h2>
                        <div class="sln-slider__inner">
                            <div class="col col-time">
                                <h2 class="sln-slider--title col-time-title"><em><strong class="slider-time-from">9:00</strong>
                                to <strong class="slider-time-to">16:00</strong></em></h2>
                                <input type="text" name="<?php echo $prefix ?>[from][0]" id=""
                                       value="<?php echo $row['from'][0] ? $row['from'][0] : "9:00" ?>"
                                       class="slider-time-input-from hidden">
                                <input type="text" name="<?php echo $prefix ?>[to][0]" id=""
                                       value="<?php echo $row['to'][0] ? $row['to'][0] : "13:00" ?>"
                                       class="slider-time-input-to hidden">
                            </div>
                            <div class="sliders_step1 col col-slider">
                                <div class="slider-range"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 sln-slider-wrapper sln-slider-wrapper-second-shift" <?php if (isset($row['disable_second_shift']) && $row['disable_second_shift']) {echo 'hidden';}?> >
                    <div class="sln-slider sln-second-shift">
                        <h2 class="sln-box-title"><?php _e('Second shift', 'salon-booking-system');?></h2>
                        <div class="sln-slider__inner">
                            <div class="col col-time">
                                <h2 class="sln-slider--title col-time-title" <?php if (isset($row['disable_second_shift']) && $row['disable_second_shift']) {echo 'hidden';}?> >
                                <em><strong class="slider-time-from">9:00</strong> to <strong class="slider-time-to">16:00</strong></em></h2>
                                <input type="text" name="<?php echo $prefix ?>[from][1]" id=""
                                       value="<?php echo isset($row['from'][1]) && $row['from'][1] ? $row['from'][1] : "14:00" ?>"
                                       class="slider-time-input-from hidden" <?php if (isset($row['disable_second_shift']) && $row['disable_second_shift']) {echo 'disabled="disabled"';}?>>
                                <input type="text" name="<?php echo $prefix ?>[to][1]" id=""
                                       value="<?php echo isset($row['to'][1]) && $row['to'][1] ? $row['to'][1] : "19:00" ?>"
                                       class="slider-time-input-to hidden" <?php if (isset($row['disable_second_shift']) && $row['disable_second_shift']) {echo 'disabled="disabled"';}?>>
                            </div>
                            <div class="sliders_step1 col col-slider">
                                <div class="slider-range"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="sln-switch sln-switch--inverted sln-switch--bare sln-disable-second-shift">
                        <?php SLN_Form::fieldCheckboxSwitch(
	$prefix . '[disable_second_shift]', isset($row['disable_second_shift']) ? $row['disable_second_shift'] : false, __('Shift enabled', 'salon-booking-system'), __('Shift disabled', 'salon-booking-system'));?>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xs-12 col-md-4 col-md-push-6">

        </div>
        <div class="clearfix"></div>
        <div class="col-xs-12 col-md-4 form-group sln-switch">
            <?php SLN_Form::fieldCheckboxSwitch(
	$prefix . '[always]',
	$row['always'],
	__('This rule is always Enabled', 'salon-booking-system'), __('Not always Enabled', 'salon-booking-system'),
	array('attrs' => array(
		'data-unhide' => '#' . SLN_Form::makeID($prefix . '[always]' . 'unhide'),
	))
);?>
        </div>
        <div id="<?php echo SLN_Form::makeID($prefix . '[always]' . 'unhide') ?>" class="col-xs-12">
            <div class="row sln-box--tertiary">
            <div class="col-xs-12">
                <h3 class="sln-box-title--sec ">
                    <?php _e('Set a time range for this rule', 'salon-booking-system')?>:
                </h3>
            </div>
            <div class="col-xs-12 col-md-4 sln-input--simple sln-input--datepicker">
                <label><?php _e('Apply from', 'salon-booking-system')?></label>
                <?php SLN_Form::fieldJSDate($prefix . "[from_date]", $dateFrom)?>
            </div>
            <div class="col-xs-12 col-md-4 sln-input--simple sln-input--datepicker">
                <label><?php _e('Until', 'salon-booking-system')?></label>
                <div class="sln_datepicker"><?php SLN_Form::fieldJSDate($prefix . "[to_date]", $dateTo)?></div>
            </div>
            </div>
        </div>
        <div class="col-xs-12 sln-booking-rules__actions">
            <button class="sln-btn sln-btn--problem sln-btn--big sln-btn--icon sln-icon--trash"
                    data-collection="remove"><?php echo __('Remove this rule', 'salon-booking-system') ?></button>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

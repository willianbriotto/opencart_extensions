<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons">
		<a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a>
		<a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a>
	  </div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
		<table class="form">
			<tbody>
				<tr>
					<td><label><?php echo $entry_header ?></label></td>
					<td><input type="text" name="header_title" value="<?php echo ($modules['header_title']) ? $modules['header_title'] : ''; ?>" ></td>
				</tr>
				<tr>
					<td><label><?php echo $entry_popup; ?></label></td>
					<td><input type="text" name="popup_title" value="<?php echo ($modules['popup_title']) ? $modules['popup_title'] : ''; ?>" ></td>
				</tr>
				<tr>
					<td><?php echo $geo_need; ?></td>
					<td>
						<?php if ($modules['geo_need']) { ?>
						<input type="radio" name="geo_need" value="1" checked="checked" />
						<?php echo $text_yes; ?>
						<input type="radio" name="geo_need" value="0" />
						<?php echo $text_no; ?>
						<?php } else { ?>
						<input type="radio" name="geo_need" value="1" />
						<?php echo $text_yes; ?>
						<input type="radio" name="geo_need" value="0" checked="checked" />
						<?php echo $text_no; ?>
						<?php } ?>
					</td>
				</tr>
				<tr>
					<td><?php echo $entry_enabled; ?></td>
					<td class="left">
						<select name="enabled">
							<?php if ($modules['enabled']) { ?>
							<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
							<option value="0"><?php echo $text_disabled; ?></option>
							<?php } else { ?>
							<option value="1"><?php echo $text_enabled; ?></option>
							<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="7"></td>
					<td class="left"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a></td>
				</tr>
			</tfoot>
		</table>
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?>
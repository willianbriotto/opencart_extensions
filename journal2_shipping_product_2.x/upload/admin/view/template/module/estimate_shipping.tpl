<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-account" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-estimate-shipping" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_header ?></label>
            <div class="col-sm-10">
              <input type="text" name="estimate_shipping_header_title" value="<?php echo $estimate_shipping_header_title; ?>" placeholder="<?php echo $entry_header; ?>" id="input-header-title" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_popup ?></label>
            <div class="col-sm-10">
              <input type="text" name="estimate_shipping_popup_title" value="<?php echo $estimate_shipping_popup_title; ?>" placeholder="<?php echo $entry_popup; ?>" id="input-popup-title" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $geo_need; ?></label>
            <div class="col-sm-10">
                <?php if ($estimate_shipping_geo) { ?>
				<input type="radio" name="estimate_shipping_geo" value="1" checked="checked" />
				<?php echo $text_yes; ?>
				<input type="radio" name="estimate_shipping_geo" value="0" />
				<?php echo $text_no; ?>
				<?php } else { ?>
				<input type="radio" name="estimate_shipping_geo" value="1" />
				<?php echo $text_yes; ?>
				<input type="radio" name="estimate_shipping_geo" value="0" checked="checked" />
				<?php echo $text_no; ?>
				<?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="estimate_shipping_status" id="input-status" class="form-control">
                <?php if ($estimate_shipping_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>

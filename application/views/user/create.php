<?php require APPPATH.'config/myconf'.EXT; ?>
<div class="col-xs-4">
<div class="well">

<form method="POST" class="form-horizontal">
<div class="page-header">
	<h3><?= $STRINGTABLE['user.create.newUser'] ?></h3>
</div>
<? if ($message) : ?>
	<div class="alert alert-warning">
		<?= $message; ?>
	</div>
<? endif; ?>

<div class="form-group">
	<label class="col-xs-4"><?= $STRINGTABLE['user.create.username'] ?></label>
	<div class="col-xs-8">
		<input autocomplete="off" type="text" name="username" class="form-control" value="<?= HTML::chars(Arr::get($_POST, 'username')); ?>">
		<?php if (Arr::get($errors, 'username')) { ?>
			<div class="alert alert-danger">
				<?= Arr::get($errors, 'username'); ?>
			</div>
		<?php } ?>
	</div>
</div>

<div class="form-group">
	<label class="col-xs-4"><?= $STRINGTABLE['user.create.email'] ?></label>
	<div class="col-xs-8">
		<input autocomplete="off" type="email" name="email" class="form-control" value="<?= HTML::chars(Arr::get($_POST, 'email')); ?>">
		<?php if (Arr::get($errors, 'email')) { ?>
			<div class="alert alert-danger">
				<?= Arr::get($errors, 'email'); ?>
			</div>
		<?php } ?>
	</div>
</div>

<div class="form-group">
	<label class="col-xs-4"><?= $STRINGTABLE['user.create.password'] ?></label>
	<div class="col-xs-8">
		<input autocomplete="off" type="password" name="password" class="form-control">
		<?php if (Arr::path($errors, '_external.password')) { ?>
			<div class="alert alert-danger">
				<?= Arr::path($errors, '_external.password'); ?>
			</div>
		<?php } ?>
	</div>
</div>

<div class="form-group">
	<label class="col-xs-4"><?= $STRINGTABLE['user.create.passwordRepeat'] ?></label>
	<div class="col-xs-8">
		<input autocomplete="off" type="password" name="password_confirm" class="form-control">
		<?php if (Arr::path($errors, '_external.password_confirm')) { ?>
			<div class="alert alert-danger">
				<?= Arr::path($errors, '_external.password_confirm'); ?>
			</div>
		<?php } ?>
	</div>
</div>

<div class="form-group">
	<label for="" class="col-xs-4"><?= $STRINGTABLE['user.create.roles'] ?></label>
	<div class="col-xs-8"><input autocomplete="off" type="checkbox" value="1" name="role_login" <?php if(HTML::chars(Arr::get($_POST, 'role_login')) == "1") { echo 'checked="checked"'; }; ?>> Login</div>
	<div class="col-xs-8"><input autocomplete="off" type="checkbox" value="1" name="role_admin" <?php if(HTML::chars(Arr::get($_POST, 'role_admin')) == "1") { echo 'checked="checked"'; }; ?>> Admin</div>
</div>

<div class="form-group">
	<label for="" class="col-xs-4"><?= $STRINGTABLE['user.create.commonNotification'] ?></label>
	<div class="col-xs-8"><input autocomplete="off" type="checkbox" value="1" name="common_note" <?php if(HTML::chars(Arr::get($_POST, 'common_note')) == "1") { echo 'checked="checked"'; }; ?>></div>
</div>

<div class="form-group">
	<label for="" class="col-xs-4"><?= $STRINGTABLE['user.create.evictionNotification'] ?></label>
	<div class="col-xs-8"><input autocomplete="off" type="checkbox" value="1" name="eviction_note" <?php if(HTML::chars(Arr::get($_POST, 'eviction_note')) == "1") { echo 'checked="checked"'; }; ?>></div>
</div>

<div class="form-group">
<div class="col-xs-8 col-md-offset-4"><input autocomplete="off" type="submit" class="btn btn-primary"></div>
</div>

<?= Form::close(); ?>
</div>
</div>

<div class="col-xs-8">
<table class="table table-striped">
	<tr>
		<th><?= $STRINGTABLE['user.create.username'] ?></th>
		<th><?= $STRINGTABLE['user.create.email'] ?></th>
		<th><?= $STRINGTABLE['user.create.numberOfLogins'] ?></th>
		<th><?= $STRINGTABLE['user.create.lastLogin'] ?></th>
		<th><?= $STRINGTABLE['user.create.roles'] ?></th>
		<th><?= $STRINGTABLE['user.create.an'] ?></th>
		<th><?= $STRINGTABLE['user.create.rn'] ?></th>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
	</tr>
	<?php foreach($users as $user) { ?>
		<tr>
			<td><?php echo $user->username; ?></td>
			<td><?= $user->email; ?></td>
			<td><?= $user->logins; ?></td>
			<td><?= Date::fuzzy_span($user->last_login); ?></td>
			<td>
				<?php foreach ($user->roles->find_all() as $role) {
					echo $role->name . ', ';
				} ?>
			</td>
			<td><?php if($user->common_note){ echo '<span class="glyphicon glyphicon-ok"></span>'; } ?></td>
			<td><?php if($user->eviction_note){ echo '<span class="glyphicon glyphicon-ok"></span>'; } ?></td>
			<td>
				<a href="/user/update/<?= $user->id; ?>" class="user_update btn btn-warning">
					<span class="glyphicon glyphicon-edit"></span>
				</a>
			</td>
			<td>
				<a href="/user/delete/<?= $user->id; ?>" class="user_delete btn btn-danger">
					<span class="glyphicon glyphicon-remove"></span>
				</a>
			</td>
		</tr>
	<?php } ?>
</table>
</div>
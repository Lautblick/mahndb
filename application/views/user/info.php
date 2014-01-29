<?php $strings = unserialize(STRINGTABLE);?>
<h2><?= $strings['user.info.header']; ?>"<?= $user->username; ?>"</h2>

<ul>
	<li><?= $strings['user.info.email']; ?><?= $user->email; ?></li>
	<li><?= $strings['user.info.numberOfLogins']; ?><?= $user->logins; ?></li>
	<li><?= $strings['user.info.lastLogin']; ?><?= Date::fuzzy_span($user->last_login); ?></li>
</ul>

<?= HTML::anchor('user/logout', $strings['user.info.logout']); ?>
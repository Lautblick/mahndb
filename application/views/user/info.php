<h2><?= $STRINGTABLE['user.info.header'] ?>"<?= $user->username; ?>"</h2>

<ul>
	<li><?= $STRINGTABLE['user.info.email'] ?><?= $user->email; ?></li>
	<li><?= $STRINGTABLE['user.info.numberOfLogins'] ?><?= $user->logins; ?></li>
	<li><?= $STRINGTABLE['user.info.lastLogin'] ?><?= Date::fuzzy_span($user->last_login); ?></li>
</ul>

<?= HTML::anchor('user/logout', $STRINGTABLE['user.info.logout']); ?>
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth Lang - English
*
* Author: Ben Edmunds
* 		  ben.edmunds@gmail.com
*         @benedmunds
*
* Location: http://github.com/benedmunds/ion_auth/
*
* Created:  03.14.2010
*
* Description:  English language file for Ion Auth messages and errors
*
*/

// Account Creation
$lang['account_creation_successful'] 	  	 = 'Benutzer erfolgreich erstellt.';
$lang['account_creation_unsuccessful'] 	 	 = 'Benutzer konnte nicht erstellt werden.';
$lang['account_creation_duplicate_email'] 	 = 'Die angegebene E-Mail Adresse ist entweder bereits vergeben oder ungültig';
$lang['account_creation_duplicate_username'] = 'Der Benutzername ist bereits vergeben';

// Password
$lang['password_change_successful'] 	 	 = 'Das Passwort wurde erfolgreich geändert';
$lang['password_change_unsuccessful'] 	  	 = 'Das Passwort konnte nicht geändert werden.';
$lang['forgot_password_successful'] 	 	 = 'Password Reset Email Sent';
$lang['forgot_password_unsuccessful'] 	 	 = 'Unable to Reset Password';

// Activation
$lang['activate_successful'] 		  	     = 'Account aktiviert';
$lang['activate_unsuccessful'] 		 	     = 'Account konnte nicht aktiviert werden';
$lang['deactivate_successful'] 		  	     = 'Account deaktiviert';
$lang['deactivate_unsuccessful'] 	  	     = 'Account konnte nicht deaktiviert werden';
$lang['activation_email_successful'] 	  	 = 'Aktivierungsmail wurde versandt';
$lang['activation_email_unsuccessful']   	 = 'Aktivierungsmail konnte nicht versendet werden.';

// Login / Logout
$lang['login_successful'] 		  	         = 'Sie haben sich erfolgreich eingeloggt';
$lang['login_unsuccessful'] 		  	     = 'Logindaten inkorrekt';
$lang['login_unsuccessful_not_active'] 		 = 'Ihr Account ist inaktiv';
$lang['login_timeout']                       = 'Temporarily Locked Out.  Try again later.';
$lang['logout_successful'] 		 	         = 'Logout erfolgreich';

// Account Changes
$lang['update_successful'] 		 	         = 'Account Informationen wurden erfolgreich aktualisiert';
$lang['update_unsuccessful'] 		 	     = 'Die Account Informationen konnten nicht gespeichert werden.';
$lang['delete_successful']               = 'Benutzer erfolgreich gelöscht';
$lang['delete_unsuccessful']           = 'Benutzer konnte nicht gelöscht werden.';

// Groups
$lang['group_creation_successful']  = 'Group created Successfully';
$lang['group_already_exists']       = 'Group name already taken';
$lang['group_update_successful']    = 'Group details updated';
$lang['group_delete_successful']    = 'Group deleted';
$lang['group_delete_unsuccessful'] 	= 'Unable to delete group';
$lang['group_name_required'] 		= 'Group name is a required field';

// Activation Email
$lang['email_activation_subject']            = 'Account Activation';
$lang['email_activate_heading']    = 'Activate account for %s';
$lang['email_activate_subheading'] = 'Please click this link to %s.';
$lang['email_activate_link']       = 'Activate Your Account';

// Forgot Password Email
$lang['email_forgotten_password_subject']    = 'Forgotten Password Verification';
$lang['email_forgot_password_heading']    = 'Reset Password for %s';
$lang['email_forgot_password_subheading'] = 'Please click this link to %s.';
$lang['email_forgot_password_link']       = 'Reset Your Password';

// New Password Email
$lang['email_new_password_subject']          = 'New Password';
$lang['email_new_password_heading']    = 'New Password for %s';
$lang['email_new_password_subheading'] = 'Your password has been reset to: %s';

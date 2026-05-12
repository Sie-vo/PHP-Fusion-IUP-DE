<?php
// Member Management Options
$locale['400'] = "Benutzer Verwaltung";
$locale['401'] = "User";
$locale['402'] = "Benutzer hinzuf&uuml;gen";
$locale['403'] = "Benutzertyp";
$locale['404'] = "Optionen";
$locale['405'] = "Betrachten";
$locale['406'] = "Bearbeiten";
$locale['407'] = "Aktivieren";
$locale['408'] = "Entbannen";
$locale['409'] = "Bannen";
$locale['410'] = "L&ouml;schen";
$locale['411'] = "Keine Mitglieder mit Suchkriterium &quot;%s&quot;";
$locale['412'] = " beginnend mit ";
$locale['413'] = " &uuml;bereinstimmend ";
$locale['414'] = "Alle zeigen";
$locale['415'] = "Suche nach Benutzer:";
$locale['416'] = "Suchen";
$locale['417'] = "Aktion w&auml;hlen";
$locale['418'] = "Abbrechen";
$locale['419'] = "Reinstate";
// Ban/Unban/Delete Member
$locale['420'] = "Bann gespeichert";
$locale['421'] = "Bann entfernt";
$locale['422'] = "Mitglied gel&ouml;scht";
$locale['423'] = "Willst du diesen Benutzer wirklich löschen?";
$locale['424'] = "Benutzer aktiviert";
$locale['425'] = "<h2>Warnung!</h2><br />
Du bist im Begriff den Benutzer <strong>%s</strong> zu l&ouml;schen!<br />
Folgende <u>von diesem Benutzer</u> verfassten Inhalte auf der Webseite werden ebenfalls gel&ouml;scht, wenn du fortf&auml;hrst:<br />
- Artikel<br />
- News<br />
- Forum-Themen. Beachte dass auch die Beitr&auml;ge anderer Benutzer im Thema gel&ouml;scht werden, das dieser Benutzer er&ouml;ffnet hatte (auch darin evtl. enthaltene Umfragen und Abstimmungsergebnisse).<br />
- Foren-Beitr&auml;ge<br />
- Foren-Anh&auml;nge<br />
- Kommentare<br />
- Gesendete und erhaltene Private Nachrichten<br />
- Abgegebene Stimmen un Umfragen<br />
- Abgegebene Bewertungen<br />
Sollte es sich bei diesem Benutzer nicht zwingend um einen Spammer handeln wird stattdessen empfohlen, ihn zu bannen, suspendieren, anonymisieren oder abzubrechen.<br />
<br />
Willst du diesen benutzer wirklich l&ouml;schen?<br />";
$locale['426'] = "Ja";
$locale['427'] = "Nein";
// Edit Member Details
$locale['430'] = "Benutzer bearbeiten";
$locale['431'] = "Benutzerdetails aktualisiert";
$locale['432'] = "Zur&uuml;ck zur Benutzer Verwaltung";
$locale['433'] = "Zur&uuml;ck zum Admin Index";
$locale['434'] = "Fehler beim Aktualisieren der Benutzer-Details:";
// Extra Edit Member Details form options
$locale['440'] = "&Auml;nderungen speichern";
// Update Profile Errors
$locale['450'] = "Der prim&auml;re Administrator kann nicht bearbeitet werden.";
$locale['451'] = "Du musst einen Benutzernamen und eine eMail-Adresse angeben.";
$locale['452'] = "Der Benutzername enth&auml;lt ung&uuml;ltige Zeichen.";
$locale['453'] = "Der Benutzername ".(isset($_POST['user_name']) ? $_POST['user_name'] : "")." wird bereits verwendet.";
$locale['454'] = "Ung&uuml;ltige eMail-Adresse.";
$locale['455'] = "Die eMail-Adresse ".(isset($_POST['user_email']) ? $_POST['user_email'] : "")." wird bereits verwendet.";
$locale['456'] = "Die neuen Passw&ouml;rter stimmen nicht &uuml;berein";
$locale['457'] = "Ung&uuml;ltiges Passwort, bitte nur alphanumerische Zeichen verwenden.<br />
Das Passwort muss mindestens 8 Zeichen lang sein.";
$locale['458'] = "<strong>Warnung:</strong> Unerwartete Script-Ausf&uuml;hrung.";
// View Member Profile
$locale['470'] = "Benutzerprofil";
$locale['472'] = "Statistiken";
$locale['473'] = "Benutzergruppen";
// Add Member Errors
$locale['480'] = "Benutzer hinzuf&uuml;gen";
$locale['481'] = "Der Benutzeraccount wurde erstellt.";
$locale['482'] = "Der Benutzeraccount konnte nicht erstellt werden.";
// Suspension Log 
$locale['510s'] = "Suspendierungs-Log f&uuml;r ";
$locale['511s'] = "Es existieren keine Aufzeichnungen im Suspendierungs-Log dieses Benutzers.";
$locale['512s'] = "Fr&uuml;here Suspendierungen des Benutzers ";
$locale['513'] = "Nr."; // as in number
$locale['514'] = "Datum";
$locale['515'] = "Begr&uuml;ndung";
$locale['516'] = "Suspendierung durch Administrator";
$locale['517'] = "System-Aktion";
$locale['518'] = "Zur&uuml;ck zum Benutzerprofil";
$locale['519'] = "Suspendierungs-Log dieses Benutzers ";
$locale['520'] = "Aufgehoben: ";
$locale['521'] = "IP: ";
$locale['522'] = "Noch nicht aufgehoben";
$locale['540'] = "Fehler";
$locale['541'] = "Fehler: Es muss eine Begr&uuml;ndung f&uuml;r die Suspendierung angegeben werden!";
$locale['542'] = "Fehler: Es muss eine Begr&uuml;ndung f&uuml;r den System-Bann angegeben werden!";
// User Management Admin
$locale['550'] = "Benutzer suspendieren: ";
$locale['551'] = "Dauer in Tagen:";
$locale['552'] = "Grund:";
$locale['553'] = "Suspendieren";
$locale['554'] = "Es gib keine Aufzeichnungen &uuml;ber Suspendierungen dieses Benutzers";
$locale['555'] = "Falls du der Meinung bist, dass dieser Benutzer gebannt werden soll, dann klicke auf 'Bannen'";
$locale['556'] = "Aufhebung der Suspendierung f&uuml;r: ";
$locale['557'] = "Aufhebung der Suspendierung ";
$locale['558'] = "Aufhebung des Banns von: ";
$locale['559'] = "Aufhebung des Banns ";
$locale['560'] = "Aufhebung der Sicherheitssperre f&uuml;r: ";
$locale['561'] = "Aufhebung der Sicherheitssperre ";
$locale['562'] = "Benutzer bannen: ";
$locale['563'] = "Sicherheitssperre f&uuml;r Benutzer: ";
$locale['585a'] = "Bitte einen Grund angeben warum du sperrst/entsperrst ";

$locale['566'] = "Bann aufgehoben";
$locale['568'] = "Sicherheitssperre gesetzt";
$locale['569'] = "Sicherheitssperre aufgehoben";
$locale['572'] = "Benutzer suspendiert";
$locale['573'] = "Suspendierung aufgehoben";
$locale['574'] = "Benutzer deaktiviert";
$locale['575'] = "Benutzer reaktiviert";
$locale['576'] = "Account geschlossen";
$locale['577'] = "Account-Schlie&szlig;ung revidiert";
$locale['578'] = "Account gesclossen und anonymisiert";
$locale['579'] = "Account-Anonymisierung revidiert";
$locale['580'] = "Inaktive Benutzer deaktivieren";
$locale['581'] = "Es gibt mehr als 50 inaktive benutzer, die zu deaktivieren sind. Dieser Vorgang muss daher <strong>%d mal</strong> wiederholt werden.";
$locale['582'] = "Reaktivieren";
$locale['583'] = "Re-instate";
$locale['584'] = "neuen Status w&auml;hlen";
$locale['585'] = "Dieser Benutzer wurde urspr&uuml;nglich aus Sicherheitsgr&uuml;nden gesperrt! Bist du sicher, dass du diese Sperre aufheben m&ouml;chtest?";

$locale['590'] = "Suspendieren";
$locale['591'] = "Suspendierung aufheben";
$locale['592'] = "Suspendieren";
$locale['593'] = "Aufheben der Suspendierung";
$locale['594'] = "Bitte einen Grund angeben f&uuml;r das ";
$locale['595'] = " des Benutzers ";
$locale['596'] = "Dauer:";

$locale['600'] = "Sicherheitssperre";
$locale['601'] = "Sicherheitssperre";
$locale['602'] = "Entsperrung";
$locale['603'] = "entsperren";
$locale['604'] = "Begr&uuml;ndung:";
// Deactivation System
$locale['610'] = "<strong>%d Benutzer</strong> war(en) nicht eingeloggt seit <strong>%d Tag(en)</strong> und wurde(n) als inaktiv markiert. 
Bei Deaktivierung dieser Benutzer haben diese <strong>%d Tag(e)</strong> Zeit bis zur %s.";
$locale['611'] = "Please note that some users may have submitted content to your site such as forum posts, comments, photos etc.
these will be deleted when deactivated users are beeing deleted.";
$locale['612'] = "Benutzer";
$locale['613'] = "Benutzer";
$locale['614'] = "Deaktivierung";
$locale['615'] = "dauerhaft gel&ouml;scht";
$locale['616'] = "Anonymisierung";
$locale['617'] = "Warnung:";
$locale['618'] = "Es wird dringend empfohlen, die Deaktivierungs-Aktion auf Anonymisierung statt L&ouml;schung festzulegen, um das Risiko unerw&uuml;nschter Datenl&ouml;schung (Beiträge, News, Artikel, Votings etc.) zu vermeiden!";
$locale['619'] = "Dies kannst du hier tun.";
$locale['620'] = "anonymisieren";
$locale['621'] = "Automatische Deaktivierung inaktiver Benutzer";
?>
import app from 'flarum/admin/app';
import MailerSettingsPage from "./components/MailerSettingsPage";

app.initializers.add('foskym/flarum-multi-mailer', () => {
  app.extensionData
    .for('foskym-multi-mailer')
    .registerPage(MailerSettingsPage);
});

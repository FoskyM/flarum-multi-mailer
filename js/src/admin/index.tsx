import app from 'flarum/admin/app';
import { extend, override } from 'flarum/common/extend';
import MailPage from 'flarum/admin/components/MailPage';
import LinkButton from 'flarum/common/components/LinkButton';
import MailerSettingsPage from './components/MailerSettingsPage';

app.initializers.add('foskym/flarum-multi-mailer', () => {
  app.extensionData.for('foskym-multi-mailer').registerPage(MailerSettingsPage);

  override(MailPage.prototype, 'content', function (original) {
    let content = original();
    if (this.setting('mail_driver')() !== 'multi-smtp') {
      return content;
    }
    content.children = content.children.concat([
      <LinkButton
        className="Button"
        href={app.route('extension', {
          id: 'foskym-multi-mailer',
        })}
      >
        Settings for Multi Mailer
      </LinkButton>,
    ]);
    return content;
  });
});

import app from 'flarum/admin/app';
import Modal from 'flarum/common/components/Modal';
import Button from 'flarum/common/components/Button';
import Stream from 'flarum/common/utils/Stream';
export default class MailerModal extends Modal {
  oninit(vnode) {
    super.oninit(vnode);

    this.mailer = this.attrs.mailer;
    this.fields = [
      'mail_suffix',
      'mail_host',
      'mail_port',
      'mail_username',
      'mail_password',
      'mail_encryption',
      'mail_from'
    ];

    this.values = this.fields.reduce((values, key) => {
      values[key] = Stream(this.mailer[key]() || '');
      return values;
    }, {});
  }

  className() {
    return 'MailerModal Modal--large';
  }

  title() {
    return 'Edit';
  }

  content() {
    return (
      <div className="Modal-body">
        <form onsubmit={this.onsubmit.bind(this)}>

          {this.fields.map(key => (
            <div className="Form-group">
              <label className="MailerModal-label">{app.translator.trans(`core.admin.email.${key}_label`)}</label>
              <input
                className="FormControl"
                bidi={this.values[key]}
                placeholder={key}
                disabled={key === 'mail_suffix' && this.mailer.id() === 1}
              />
            </div>
          ))}

          <div className="Form-group">
            {Button.component({
              type: 'submit',
              className: 'Button Button--primary Button--block MailerModal-save',
              loading: this.loading,
            }, app.translator.trans('core.admin.settings.submit_button'))}
          </div>
        </form>
      </div>
    );
  }

  onsubmit(e) {
    e.preventDefault();

    this.loading = true;

    const mailerData = this.fields.reduce((data, key) => {
      data[key] = this.values[key]();
      return data;
    }, {});

    this.mailer.save(mailerData).then(() => {
      this.loading = false;
      m.redraw();
      this.hide();
    });
  }
}

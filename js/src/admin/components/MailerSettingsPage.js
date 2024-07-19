import app from 'flarum/admin/app';
import ExtensionPage from 'flarum/admin/components/ExtensionPage';
import Button from 'flarum/common/components/Button';
import MailerModal from "./MailerModal";

export default class MailerSettingsPage extends ExtensionPage {
  oninit(vnode) {
    super.oninit(vnode);
    this.loading = true;
    this.records = [];
    app.store.find('multi-mailer').then(records => {
      this.records = records;
      this.loading = false;
      m.redraw();
    });
  }

  content() {
    return (
      <div className="container MultiMailer-container">
        <table className="MailerSettingsPage-table">
          <thead>
          <tr>
            <th>Mail Suffix</th>
            <th>Mail Host</th>
            <th>Mail Port</th>
            <th>Mail Username</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
          {this.records.map(record => (
            <tr>
              <td>{record.mail_suffix()}</td>
              <td>{record.mail_host()}</td>
              <td>{record.mail_port()}</td>
              <td>{record.mail_username()}</td>
              <td>
                <Button
                  className={"Button Button--icon"}
                  icon={"fas fa-edit"}
                  onclick={() => {
                    app.modal.show(MailerModal, {mailer: record});
                  }}
                />
                <Button
                  className={"Button Button--icon"}
                  icon={"fas fa-trash"}
                  disabled={this.records.length === 1 || this.loading || record.id() === 1}
                  onclick={() => {
                    record.delete().then(() => {
                      this.records = this.records.filter(r => r !== record);
                      m.redraw();
                    });
                  }}
                />
              </td>
            </tr>
          ))}
          <tr>
            <td colspan="4">
              <Button
                className={"Button Button--block"}
                onclick={() => {
                  app.store.createRecord('multi-mailer')
                    .save({
                      mail_suffix: 'new.com',
                      mail_port: 465,
                      mail_encryption: 'ssl',
                    })
                    .then(mailer => {
                      this.records.push(mailer);
                      app.modal.show(MailerModal, {mailer});
                    });
                }}
              >
                <i className="fas fa-plus"></i> Add
              </Button>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    );
  }
}

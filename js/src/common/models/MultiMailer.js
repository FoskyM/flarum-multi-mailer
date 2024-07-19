import Model from 'flarum/common/Model';

export default class MultiMailer extends Model {
  id = Model.attribute('id');
  mail_suffix = Model.attribute('mail_suffix');
  mail_host = Model.attribute('mail_host');
  mail_port = Model.attribute('mail_port');
  mail_username = Model.attribute('mail_username');
  mail_password = Model.attribute('mail_password');
  mail_encryption = Model.attribute('mail_encryption');
  mail_from = Model.attribute('mail_from');
}

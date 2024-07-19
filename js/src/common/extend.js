import Extend from 'flarum/common/extenders';
import MultiMailer from "./models/MultiMailer";

export default [
  new Extend.Store()
    .add('multi-mailer', MultiMailer)
];

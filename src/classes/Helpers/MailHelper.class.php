<?php

	final class MailHelper extends StaticFactory
	{
		public static function add(Model $model)
		{
			if (!$model->has('user'))
				throw new WrongArgumentException('No user');

			if (!$model->has('template'))
				throw new WrongArgumentException('No template');

			$resolver = MultiPrefixPhpViewResolver::create()->
				setViewClassName('SimplePhpView')->
				addPrefix(PATH_TEMPLATES.'templates'.DS)->
				setPostfix(EXT_TPL);

			if (!$view = $resolver->resolveViewName($model->get('template')))
				throw new WrongArgumentException('No template');

			$body = $view->toString($model);
			$user = $model->get('user');
			
			$subject = $model->has('subject')
				? $model->get('subject')
				: 'Cyprus Realestate Website';

			$mail = MailQueue::create()->
				setUser($user)->
				setEmail($user->getEmail())->
				setCreated(Timestamp::makeNow())->
				setSubject($subject)->
				setBody($body);

			try {
				$mail->dao()->add($mail);
			} catch (DatabaseException $e) {
				return false;
			}
			
			return true;
		}

		public static function send(Model $model)
		{
			if (!$model->has('user'))
				throw new WrongArgumentException('No user');

			if (!$model->has('template'))
				throw new WrongArgumentException('No template');

			$resolver = MultiPrefixPhpViewResolver::create()->
				setViewClassName('SimplePhpView')->
				addPrefix(PATH_TEMPLATES.'templates'.DS)->
				setPostfix(EXT_TPL);

			if (!$view = $resolver->resolveViewName($model->get('template')))
				throw new WrongArgumentException('No template');

			$body = $view->toString($model);
			$user = $model->get('user');

			$subject = $model->has('subject')
				? $model->get('subject')
				: 'Cyprus Realestate Website';

			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=utf-8\r\n";
			$headers .= "To: ".$user->getFullName()." <".$user->getEmail().">\r\n";
			$headers .= "From: Realestate.cy <".DEFAULT_EMAIL.">\r\n";

			return mail($user->getEmail(), $subject, $body, $headers);
		}
	}
?>
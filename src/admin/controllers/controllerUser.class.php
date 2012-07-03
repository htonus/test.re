<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of main
 *
 * @author htonus
 */
final class controllerUser extends PrototypedEditor
{
	public function __construct()
	{
		parent::__construct(User::create());

		$this->map->addSource('id', RequestType::post());

		$this->setMethodMapping('index', 'doIndex')->
			setDefaultAction('index');

		$this->getForm()->
			get('password')->
			addImportFilter(Filter::hash());
	}

	protected function doIndex(HttpRequest $request)
	{
		try {
			$list = User::dao()->getPlainList();
		} catch (ObjectNotFoundException $e) {
			$list = array();
		}
		
		$model = Model::create()->
			set('list', $list)->
			set('subject', $this->subject);

		return ModelAndView::create()->
			setModel($model);
	}
}

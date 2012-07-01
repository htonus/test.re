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
		$this->
			setMethodMappingList(
				array(
					'index'	=> 'actionIndex',
				)
			)->
			setDefaultAction('index');
	}
	
	public function actionIndex(HttpRequest $request)
	{
		$model = Model::create();
		
		$list = User::dao()->getPlainList();
		
		$model->set('list', $list);
		
		$mav = ModelAndView::create()->
			setModel($model);
		
		return $mav;
	}
	
	protected function actionEdit(HttpRequest $request)
	{
		$this->getForm()->
			import($request->getGet())->
			importMore($request->getPost());
		
		if ($this->getForm()->getErrors()) {
			
		}
	}
}

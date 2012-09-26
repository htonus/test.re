<?php
/******************************************************************************
 *   Copyright (C) 2012 by Mikhail Cherviakov                                 *
 *   email: htonus@gmail.com                                                  *
 ******************************************************************************/
/* $Id$ */


/**
 * User management controller
 *
 * @author htonus
 */
class CommonEditor extends PrototypedEditor
{
	const PER_PAGE = 20;

	public function __construct($subject)
	{
		parent::__construct($subject);

		$this->map->addSource('id', RequestType::post());

		$this->setMethodMapping('index', 'doIndex')->
			setDefaultAction('index');
	}

	public function handleRequest(HttpRequest $request)
	{
		$mav = parent::handleRequest($request);
		$model = $mav->getModel();
		$request->setAttachedVar('layout', 'default');
		
		if (
			$model->has('editorResult')
			&& $model->get('action') != 'edit'
		) {
			if ($model->get('editorResult') == self::COMMAND_SUCCEEDED)
				return ModelAndView::create()->
					setView(
						RedirectView::create(
							$request->getAttachedVar('urlMapper')->
								getAreaUrl(
									StringHelper::lcfirst(get_class($this->subject))
								)
						)
					);
			
			$model->set('action', 'edit');
		}
		
		$this->attachCollections($model);

		return $mav;
	}

	public function doIndex(HttpRequest $request)
	{
		$model = Model::create();

		try {
			$criteria = $this->getListCriteria($request, $model);
			$request->setAttachedVar('criteria', $criteria);

			// paging stuff
			PagerHelper::create($request)->
				setPerPage($this::PER_PAGE)->
				page($model);
			
		} catch (ObjectNotFoundException $e) {
			$model->set('list', array());
		}
		
		$model->
//			set('list', $list)-> // pager does
			set('subject', $this->subject);

		return ModelAndView::create()->
			setModel($model);
	}

	/**
	 * Returns base list criteria
	 * @param HttpRequest $request
	 * @param Model $model
	 * @return Criteria $criteria
	 */
	protected function getListCriteria(HttpRequest $request, Model $model)
	{
		$criteria = Criteria::create($this->subject->dao());

		return $criteria;
	}

	protected function attachCollections(Model $model)
	{
		$fieldList = $this->subject->proto()->
			getExpandedPropertyList();

		foreach ($fieldList as $name => $field) {
			if (
				in_array(
					$field->getRelationId(),
					array(MetaRelation::ONE_TO_ONE, MetaRelation::ONE_TO_MANY)
				)
			) {
				try {
					switch($field->getType()) {
						case 'identifier':
						case 'integerIdentifier':
							$dao = call_user_func(array($field->getClassName(), 'dao'));
							$total = $dao->getTotalCount();
							$model->set($name.'Total', $total);

							if ($total < 50)
								$model->set($name.'List', $dao->getPlainList());
							else
								$model->set($name.'Lookup', $field->getClassName());

							break;
						case 'identifierList':
							if ($this->getForm()->getValue('id')) {
								$dao = $this->getForm()->getValue('id')->
									{$field->getGetter()}();

								$model->set($name.'List', $dao->getList());
								$model->set($name.'Total', $dao->getCount());
							} else {
								$model->set($name.'List', array());
								$model->set($name.'Total', 0);
							}

							break;

						case 'enumeration':
							$className = $field->getClassName();
							$class = new $className(
								call_user_func(array($className, 'getAnyId'))
							);
							$model->set($name.'List', $class->getObjectList());
							$model->set($name.'Total', count($model->get($name.'List')));


							break;
					}
				} catch (ObjectNotFoundException $e) {
					$model->set($name.'List', array());
				}
			}
		}

		return $this;
	}
}

<?php

	final class PagerHelper
	{
		const PER_PAGE = 20;

		private $request	= null;
		private $perPage	= self::PER_PAGE;

		public function __construct(HttpRequest $request)
		{
			$this->request = $request;
		}

		public function setPerPage($perPage)
		{
			$this->perPage = $perPage;
			return $this;
		}

		public function doPage(Model $model)
		{
			$form = Form::create()->
				add(
					Primitive::integer('page')->
						setMin(1)->
						setDefault(1)
				)->
				add(
					Primitive::integer('perPage')->
						setMin($this->perPage)->
						setDefault($this->perPage)
				)->
				add(
					Primitive::string('order')
				)->
				add(
					Primitive::string('way')
				)->
				import($this->request->getGet())->
				importMore($this->request->getPost());

			$page		= $form->getActualValue('page');
			$perPage	= $form->getActualValue('perPage');

			$criteria = $this->request->getAttachedVar('criteria');
			$countCriteria = clone $criteria;

			
		}
	}

<?php

namespace Charcoal\Admin;

use \InvalidArgumentException;

use \Pimple\Container;

use \Charcoal\Translation\TranslationString;
use \Charcoal\App\App;
use \Charcoal\App\Template\AbstractWidget;
use \Charcoal\Widget\WidgetView;

/**
 * The base Widget for the `admin` module.
 */
class AdminWidget extends AbstractWidget
{
    /**
     * @var string $widgetId
     */
    public $widgetId;

    /**
     * @var string $type
     */
    private $type;

    /**
     * @var string $ident
     */
    private $ident = '';

    /**
     * @var mixed $label
     */
    private $label;

    /**
     * @var string $lang
     */
    private $lang;

    /**
     * @var bool $showLabel
     */
    private $showLabel;

    /**
     * @var bool $showActions
     */
    private $showActions;

    /**
     * @var integer $priority
     */
    private $priority;

    /**
     * @var FactoryInterface $modelFactory
     */
    private $modelFactory;

    /**
     * @param Container $container Pimple DI container.
     * @return void
     */
    public function setDependencies(Container $container)
    {
        $this->modelFactory = $container['model/factory'];
        parent::setDependencies($container);
    }

    /**
     * @param FactoryInterface $factory The factory used to create models.
     * @return AdminScript Chainable
     */
    protected function setModelFactory(FactoryInterface $factory)
    {
        $this->modelFactory = $factory;
        return $this;
    }

    /**
     * @return FactoryInterface The model factory.
     */
    protected function modelFactory()
    {
        return $this->modelFactory;
    }

    /**
     * Provide a `template()` method to fullfill UIItem interface.
     *
     * @return string
     */
    public function template()
    {
        return $this->type();
    }

    /**
     * @param string $widgetId The widget identifier.
     * @return AdminWidget Chainable
     */
    public function setWidgetId($widgetId)
    {
        $this->widgetId = $widgetId;
        return $this;
    }

    /**
     * @return string
     */
    public function widgetId()
    {
        if (!$this->widgetId) {
            $this->widgetId = 'widget_'.uniqid();
        }
        return $this->widgetId;
    }

    /**
     * @param string $type The widget type.
     * @throws InvalidArgumentException If the argument is not a string.
     * @return AdminWidget Chainable
     */
    public function setType($type)
    {
        if (!is_string($type)) {
            throw new InvalidArgumentException(
                'Template ident must be a string'
            );
        }
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function type()
    {
        return $this->type;
    }

    /**
     * @param string $ident The widget ident.
     * @throws InvalidArgumentException If the ident is not a string.
     * @return AdminWidget (Chainable)
     */
    public function setIdent($ident)
    {
        if (!is_string($ident)) {
            throw new InvalidArgumentException(
                __CLASS__.'::'.__FUNCTION__.'() - Ident must be a string.'
            );
        }
        $this->ident = $ident;
        return $this;
    }

    /**
     * @return string
     */
    public function ident()
    {
        return $this->ident;
    }

    /**
     * @param mixed $label The label.
     * @return AdminWidget Chainable
     */
    public function setLabel($label)
    {
        $this->label = new TranslationString($label);
        return $this;
    }

    /**
     * @return string
     */
    public function label()
    {
        if ($this->label === null) {
            // Generate label from ident
            $label = ucwords(str_replace(['_', '.', '/'], ' ', $this->ident()));
            $this->label = new TranslationString($label);
        }
        return $this->label;
    }

    /**
     * @return array
     */
    public function actions()
    {
        return [];
    }

    /**
     * @param boolean $show The show actions flag.
     * @return AdminWidget Chainable
     */
    public function setShowActions($show)
    {
        $this->showActions = !!$show;
        return $this;
    }

    /**
     * @return boolean
     */
    public function showActions()
    {
        if ($this->showActions !== false) {
            return (count($this->actions()) > 0);
        } else {
            return false;
        }
    }

    /**
     * @param boolean $show The show label flag.
     * @return AdminWidget Chainable
     */
    public function setShowLabel($show)
    {
        $this->showLabel = !!$show;
        return $this;
    }

    /**
     * @return boolean
     */
    public function showLabel()
    {
        if ($this->showLabel !== false) {
            return ((string)$this->label() == '');
        } else {
            return false;
        }
    }


    /**
     * @return string
     */
    public function adminUrl()
    {
        $adminPath = App::instance()->getContainer()->get('charcoal/admin/config')->basePath();

        return rtrim($this->baseUrl(), '/').'/'.rtrim($adminPath, '/').'/';
    }

    /**
     * @return string
     */
    public function baseUrl()
    {
        $appConfig = App::instance()->config();

        if ($appConfig->has('URL')) {
            return $appConfig->get('URL');
        } else {
            $uri = App::instance()->getContainer()->get('request')->getUri();

            return rtrim($uri->getBaseUrl(), '/').'/';
        }
    }

    /**
     * @param integer $priority The widget's sorting priority.
     * @return AdminWidget Chainable
     */
    public function setPriority($priority)
    {
        $this->priority = (int)$priority;
        return $this;
    }

    /**
     * @return integer
     */
    public function priority()
    {
        return $this->priority;
    }
}

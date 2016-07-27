<?php

namespace Charcoal\Admin\Template\Object;

// Dependencies from `PHP`
use \Exception;
use \InvalidArgumentException;

// Dependency from `pimple`
use \Pimple\Container;

// Dependency from 'charcoal-translation'
use \Charcoal\Translation\TranslationString;

// Dependency from 'charcoal-factory'
use \Charcoal\Factory\FactoryInterface;

// Dependency from `charcoal-ui`
use \Charcoal\Ui\DashboardBuilder;

// Intra-module (`charcoal-admin`) dependencies
use \Charcoal\Admin\AdminTemplate;
use \Charcoal\Admin\Ui\DashboardContainerInterface;
use \Charcoal\Admin\Ui\DashboardContainerTrait;
use \Charcoal\Admin\Ui\ObjectContainerInterface;
use \Charcoal\Admin\Ui\ObjectContainerTrait;
use \Charcoal\Admin\Widget\SidemenuWidget;

/**
 * Object Edit Template
 */
class EditTemplate extends AdminTemplate implements
    DashboardContainerInterface,
    ObjectContainerInterface
{
    use DashboardContainerTrait;
    use ObjectContainerTrait;

    /**
     * @var SideMenuWidgetInterface $sidemenu
     */
    private $sidemenu;

    /**
     * @var FactoryInterface $widgetFactory
     */
    private $widgetFactory;

    /**
     * @var DashboardBuilder $dashboardBuilder
     */
    private $dashboardBuilder;

    /**
     * @param Container $container DI container.
     * @return void
     */
    public function setDependencies(Container $container)
    {
        parent::setDependencies($container);

        // Required ObjectContainerInterface dependencies
        $this->setModelFactory($container['model/factory']);

        // Required dependencies.
        $this->setWidgetFactory($container['widget/factory']);
        $this->dashboardBuilder = $container['dashboard/builder'];
    }


    /**
     * @param FactoryInterface $factory The widget factory, to create the dashboard and sidemenu widgets.
     * @return EditTemplate Chainable
     */
    protected function setWidgetFactory(FactoryInterface $factory)
    {
        $this->widgetFactory = $factory;
        return $this;
    }

    /**
     * @throws Exception If the widget factory was not set before being accessed.
     * @return FactoryInterface
     */
    protected function widgetFactory()
    {
        if ($this->widgetFactory === null) {
            throw new Exception(
                'Model factory not set'
            );
        }
        return $this->widgetFactory;
    }

    /**
     * @param DashboardBuilder $builder A builder to create customized Dashboard objects.
     * @return CollectionTemplate Chainable
     *
     */
    public function setDashboardBuilder(DashboardBuilder $builder)
    {
        $this->dashboardBuilder = $builder;
        return $this;
    }

    /**
     * @throws Exception If the dashboard builder dependency was not previously set / injected.
     * @return DashboardBuilder
     */
    public function dashboardBuilder()
    {
        if ($this->dashboardBuilder === null) {
            throw new Exception(
                'Dashboard builder was not set.'
            );
        }
        return $this->dashboardBuilder;
    }

    /**
     * @param array $data Optional dashboard data.
     * @return Dashboard
     * @see DashboardContainerTrait::createDashboard()
     */
    public function createDashboard(array $data = null)
    {
        unset($data);
        $dashboardConfig = $this->objEditDashboardConfig();
        $dashboard = $this->dashboardBuilder->build($dashboardConfig);
        return $dashboard;
    }

    /**
     * @return SidemenuWidgetInterface
     */
    public function sidemenu()
    {
        $dashboardConfig = $this->objEditDashboardConfig();
        ;
        if (!isset($dashboardConfig['sidemenu'])) {
            return null;
        }

        $sidemenuConfig = $dashboardConfig['sidemenu'];

        $GLOBALS['widget_template'] = 'charcoal/admin/widget/sidemenu';
        if (isset($sidemenuConfig['widget_type'])) {
            $widgetType = $sidemenuConfig['widget_type'];
        } else {
            $widgetType = 'charcoal/admin/widget/sidemenu';
        }
        $sidemenu = $this->widgetFactory()->create($widgetType);

        if (isset($sidemenuConfig['widget_options'])) {
            $sidemenu->setData($sidemenuConfig['widget_options']);
        }
        return $sidemenu;
    }

    /**
     * @throws Exception If the dashboard config can not be loaded.
     * @return array
     */
    private function objEditDashboardConfig()
    {
        $obj = $this->obj();
        $metadata = $obj->metadata();
        $dashboardIdent = $this->dashboardIdent();
        $dashboardConfig = $this->dashboardConfig();

        $admin_metadata = isset($metadata['admin']) ? $metadata['admin'] : null;
        if ($admin_metadata === null) {
            throw new Exception(
                'No dashboard for object'
            );
        }

        if ($dashboardIdent === null || $dashboardIdent === '') {
            if (!isset($admin_metadata['default_edit_dashboard'])) {
                throw new Exception(
                    'No default edit dashboard defined in object admin metadata'
                );
            }
            $dashboardIdent = $admin_metadata['default_edit_dashboard'];
        }
        if ($dashboardConfig === null || empty($dashboardConfig)) {
            if (!isset($admin_metadata['dashboards']) || !isset($admin_metadata['dashboards'][$dashboardIdent])) {
                throw new Exception(
                    'Dashboard config is not defined.'
                );
            }
            $dashboardConfig = $admin_metadata['dashboards'][$dashboardIdent];
        }

        return $dashboardConfig;
    }

    /**
     * @return string|TranslationString
     */
    public function title()
    {
        $config = $this->objEditDashboardConfig();

        if (isset($config['title'])) {
            return new TranslationString($config['title']);
        } else {
            $obj      = $this->obj();
            $objId    = $this->objId();
            $objLabel = $this->objType();
            $metadata = $obj->metadata();

            if (isset($metadata['admin'])) {
                $metadata    = $metadata['admin'];
                $formIdent   = ( isset($metadata['default_form']) ? $metadata['default_form'] : '' );
                $objFormData = ( isset($metadata['forms'][$formIdent]) ? $metadata['forms'][$formIdent] : [] );

                if (isset($objFormData['label']) && TranslationString::isTranslatable($objFormData['label'])) {
                    $objLabel = new TranslationString($objFormData['label']);
                }
            }

            $objLabel = sprintf(
                '%1$s #%2$s',
                $objLabel,
                $objId
            );

            $this->title = sprintf('Edit Object: %s', $objLabel);
        }

        return $this->title;
    }
}
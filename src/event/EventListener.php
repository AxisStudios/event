<?php
/**
 * This file is part of SoloProyectos common library.
 *
 * @author  Gonzalo Chumillas <gchumillas@email.com>
 * @license https://github.com/soloproyectos-php/event/blob/master/LICENSE The MIT License (MIT)
 * @link    https://github.com/soloproyectos-php/event
 */
namespace soloproyectos\event;

/**
 * Class EventListener.
 *
 * @package Event
 * @author  Gonzalo Chumillas <gchumillas@email.com>
 * @license https://github.com/soloproyectos-php/event/blob/master/LICENSE The MIT License (MIT)
 * @link    https://github.com/soloproyectos-php/event
 */
class EventListener
{
    /**
     * Event type.
     * @var string
     */
    private $_type;

    /**
     * Event listener.
     * @var Callable
     */
    private $_listener;

    /**
     * Constructor.
     *
     * @param string  $type     Event type
     * @param Closure $listener Event listener
     *
     * @return void
     */
    public function __construct($type, $listener)
    {
        $this->_type = $type;
        $this->_listener = $listener;
    }

    /**
     * Gets the event type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * Gets the listener.
     *
     * @return Callable
     */
    public function getListener()
    {
        return $this->_listener;
    }
}

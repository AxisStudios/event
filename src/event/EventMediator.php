<?php
/**
 * This file is part of SoloProyectos common library.
 *
 * @author  Gonzalo Chumillas <gchumillas@email.com>
 * @license https://github.com/soloproyectos-php/event/blob/master/LICENSE The MIT License (MIT)
 * @link    https://github.com/soloproyectos-php/event
 */
namespace soloproyectos\event;
use soloproyectos\event\EventListener;

/**
 * Class EventMediator.
 * 
 * Any class able to dispatch or listen events.
 * This class implements the "mediator pattern". See for example:
 * http://blog.ircmaxell.com/2012/03/handling-plugins-in-php.html
 *
 * @package Event
 * @author  Gonzalo Chumillas <gchumillas@email.com>
 * @license https://github.com/soloproyectos-php/event/blob/master/LICENSE The MIT License (MIT)
 * @link    https://github.com/soloproyectos-php/event
 */
class EventMediator
{
    /**
     * Event listeners.
     * @var array of EventListener
     */
    private $_eventListeners = array();
    
    /**
     * Is the event process stopped?
     * @var boolean
     */
    private $_isStop = false;
    
    /**
     * Adds an event listener.
     *
     * @param string   $eventType Event type
     * @param Callable $listener  Listener
     *
     * @return void
     */
    public function on($eventType, $listener)
    {
        array_push($this->_eventListeners, new EventListener($eventType, $listener));
    }
    
    /**
     * Removes an event listener.
     * 
     * When $listener is null, this function removes all listeners linked to the event type.
     *
     * @param string   $eventType Event type
     * @param Callable $listener  Listener (not required)
     *
     * @return void
     */
    public function off($eventType, $listener = null)
    {
        foreach ($this->_eventListeners as $i => $l) {
            if ($l->getType() == $eventType) {
                if ($listener === null || $l->getListener() === $listener) {
                    unset($this->_eventListeners[$i]);
                }
            }
        }
    }
    
    /**
     * Dispatches an event.
     *
     * @param string $eventType Event type or a list of event types
     * @param array  $data      Additional data (not required)
     *
     * @return void
     */
    public function trigger($eventType, $data = array())
    {
        $this->_isStop = false;
        foreach ($this->_eventListeners as $eventListener) {
            if ($this->_isStop) {
                break;
            }
            if ($eventListener->getType() == $eventType) {
                call_user_func_array($eventListener->getListener(), $data);
            }
        }
    }
    
    /**
     * Stops the event process.
     * 
     * The listeners are called in the same order as they were registered. This function stops that
     * process.
     * 
     * @return void
     */
    public function stop()
    {
        $this->_isStop = true;
    }
}

<?php
/**
 * @package johnpancoast/data-validator
 * @copyright (c) 2015 John Pancoast
 * @author John Pancoast <johnpancoaster@gmail.com>
 * @license MIT
 */

namespace Pancoast\DataValidator\Field;

use Pancoast\DataValidator\AbstractField;

/**
 * A model field accepting a callable to be used in field value extraction
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
class CallableField extends AbstractField
{
    /**
     * Callable for handling logic to retrieve data for this field from
     * an iteration of input data
     *
     * This callable should share the same signature as {@see Pancoast\DataValidator\FieldInterface::extractValue()}.
     *
     *    @#param mixed $iterationInput One iteration of input to pull the specific value from
     *    @#return mixed The value to be assigned to the field
     *
     * @see FieldInterface::extractValue()
     * @var callable
     */
    private $handler;

    /**
     * Constructor
     * @param $name
     * @param array $constraints
     * @param callable $handler
     * @param mixed $defaultValue Default value if field is empty
     */
    public function __construct($name, array $constraints, callable $handler, $defaultValue = '')
    {
        parent::__construct($name, $constraints, $defaultValue);
        $this->handler = $handler;
    }

    /**
     * @inheritDoc
     */
    public function extractValue($iterationInput)
    {
        return call_user_func($this->handler, $iterationInput);
    }
}
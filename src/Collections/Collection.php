<?php

namespace Vision\Collections;

use UnitEnum;
use ArrayAccess;
use Traversable;
use JsonSerializable;
use Vision\Traits\Macroable;

class Collection implements ArrayAccess
{

    use Macroable;

    protected $items;

    public function __construct($items = [])
    {
        $this->items = $this->getArrayableItems($items);
    }

    /**
     * Results array of items from Collection or Arrayable.
     *
     * @param  mixed  $items
     * @return array<TKey, TValue>
     */
    protected function getArrayableItems($items)
    {
        if (is_array($items))
        {
            return $items;
        }
        elseif ($items instanceof Collection)
        {
            return $items->toArray();
        }
        elseif ($this->isJson($items))
        {
            return json_decode($items, true);
        }
        elseif ($items instanceof JsonSerializable)
        {
            return (array) $items->jsonSerialize();
        }
        elseif ($items instanceof Traversable)
        {
            return iterator_to_array($items);
        }
        elseif ($items instanceof UnitEnum)
        {
            return [$items];
        }

        return (array) $items;
    }

    /**
     * Determine if an item exists at an offset.
     *
     * @param  TKey  $key
     * @return bool
     */
    public function offsetExists($key): bool
    {
        return isset($this->items[$key]);
    }

    /**
     * Get an item at a given offset.
     *
     * @param  TKey  $key
     * @return TValue
     */
    public function offsetGet($key): mixed
    {
        return $this->items[$key];
    }

    /**
     * Set the item at a given offset.
     *
     * @param  TKey|null  $key
     * @param  TValue  $value
     * @return void
     */
    public function offsetSet($key, $value): void
    {
        if (is_null($key))
        {
            $this->items[] = $value;
        }
        else
        {
            $this->items[$key] = $value;
        }
    }

    /**
     * Unset the item at a given offset.
     *
     * @param  TKey  $key
     * @return void
     */
    public function offsetUnset($key): void
    {
        unset($this->items[$key]);
    }

    public function toArray()
    {
        return (array) $this->items;
    }

    public function isJson($item)
    {
        json_decode($item);
        return json_last_error() === JSON_ERROR_NONE;
    }

    public function get($key, $default = null)
    {
        if (array_key_exists($key, $this->items))
        {
            return $this->items[$key];
        }

        return $default;
    }

    public function all()
    {
        return $this->items;
    }

    public function add($key, $value = null)
    {
        $this->items[$key] = $value;

        return $this;
    }
}

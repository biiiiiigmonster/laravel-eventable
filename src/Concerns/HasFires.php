<?php

namespace BiiiiiigMonster\Fireable\Concerns;

use BiiiiiigMonster\Fireable\FireManager;
use Illuminate\Database\Eloquent\Model;

/**
 * Trait HasFires
 *
 * @property array<string, mixed> $fires The attributes that should be event for save.
 */
trait HasFires
{
    /**
     * Auto register fires.
     */
    protected static function bootHasFires(): void
    {
        static::saved(fn(Model $model) => FireManager::make($model)->handle());
    }

    /**
     * Get fires.
     *
     * @return array
     */
    public function getFires(): array
    {
        return $this->fires ?? [];
    }

    /**
     * Set the fires attributes for the model.
     *
     * @param array $fires
     * @return $this
     */
    public function setFires(array $fires): static
    {
        $this->fires = $fires;

        return $this;
    }

    /**
     * Make the given, typically visible, attributes fires.
     *
     * @param array $fire
     * @return $this
     */
    public function fire(array $fire): static
    {
        $this->fires = array_merge($this->getFires(), $fire);

        return $this;
    }
}

<?php

namespace Tests\Browser\MagicActions;

use Illuminate\Support\Facades\View;
use Livewire\Component as BaseComponent;

class Component extends BaseComponent
{
    public $active = false;
    public $foo = ['bar' => ['baz' => false]];
    public $append = [];

    public function render()
    {
        return
<<<'HTML'
<div>
    <div dusk="output">{{ $active ? "true" : "false" }}</div>
    <button wire:click="$toggle('active')" dusk="toggle">Toggle Property</button>

    <div dusk="outputNested">{{ $foo['bar']['baz'] ? "true" : "false" }}</div>
    <button wire:click="$toggle('foo.bar.baz')" dusk="toggleNested">Toggle Nested</button>

    <div dusk="append">
        @foreach($append as $index => $item)
            <span dusk="appendItem{{ $item }}">{{ $item }}</span>
        @endforeach
    </div>
    <button wire:click="$set('append[]', 'foo')" dusk="appendTrigger">Append Item</button>
</div>
HTML;
    }
}
